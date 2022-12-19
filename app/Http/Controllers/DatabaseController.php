<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Spatie\DbDumper\Databases\MySql as spatie;
use ZipArchive;

class DatabaseController extends Controller
{
    public function index()
    {
        return view('database.index');
    }

    public function backup()
    {
        $file_name = 'database_backup_on_' . date('y-m-d-H_i_s') . '.sql';
        spatie::create()
            // ->setDumpBinaryPath(env('DUMP_BINARY_PATH'))
            ->setDbName(env('DB_DATABASE'))
            ->setUserName(env('DB_USERNAME'))
            ->setPassword(env('DB_PASSWORD'))
            ->includeTables([
                'activity_log','jenis_kelamin','status_pernikahan',
                'peran','judul_menu','menu','submenu','sub_submenu',
                'peran_judul_menu','judul_menu_menu','menu_submenu','submenu_sub_submenu',
                'data_pribadi','password_resets','users','informasi_umum','layar',
            ])
            ->dumpToFile($file_name);

        activity()->log('Melakukan Backup HRM');
        $this->download($file_name);
    }

    public function restore(Request $request)
    {
        $request->validate([
            'sql'  => ['required','file']
        ]);

        backup($request->sql);

        activity()->log('Melakukan Restore Database');
        return response()->json([
            'success'   => true,
            'message'   => 'File sql berhasil di restore'
        ]);
    }

    public function folder_backup()
    {
        $zip = new ZipArchive;
        $fileName = 'folder_backup_on_' . date('y-m-d-H_i_s') . '.zip';
        $rootPath = realpath('storage');
        $zip = new ZipArchive();
        $zip->open(public_path($fileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($files as $name => $file)
        {
            if (basename($file) == '.gitignore' || basename($file) == 'noavatar.png' || basename($file) == 'noimage.jpg' || basename($file) == 'upload.jpg' || basename($file) == 'loading.gif' || basename($file) == 'form-kehadiran.xlsx') {
                continue;
            }

            if (!$file->isDir())
            {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
        activity()->log('Melakukan Backup Folder');
        $this->download($fileName);
    }

    public function folder_restore(Request $request)
    {
        $request->validate([
            'zip'  => ['required','file','mimes:zip']
        ]);

        $zip = new ZipArchive;
        $res = $zip->open($request->zip);
        if ($res === TRUE) {
            $zip->extractTo(storage_path('/app/public'));
            $zip->close();
            activity()->log('Melakukan Restore Folder');
            return response()->json([
                'success'   => true,
                'message'   => 'Folder Backup berhasil direstore'
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => ['Folder Backup gagal direstore']
            ]);
        }
    }

    private function download($fileName)
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($fileName));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        ob_clean();
        flush();
        readfile($fileName);
        unlink($fileName);
    }
}
