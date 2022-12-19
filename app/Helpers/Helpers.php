<?php

use Illuminate\Support\Facades\Http;
use League\Flysystem\Config;

if (! function_exists('tgl')) {
    function tgl($tanggal)
    {
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}
if (! function_exists('bulan')) {
    function bulan($bulan)
    {
        $data = array (
            '01'    =>  'Januari',
            '02'    =>  'Februari',
            '03'    =>  'Maret',
            '04'    =>  'April',
            '05'    =>  'Mei',
            '06'    =>  'Juni',
            '07'    =>  'Juli',
            '08'    =>  'Agustus',
            '09'    =>  'September',
            '10'    =>  'Oktober',
            '11'    =>  'November',
            '12'    =>  'Desember'
        );
        return $data[$bulan];
    }
}

if (! function_exists('status_badge')) {
    function status_badge($data, $title = null, $ada = null, $belum = null)
    {
        return $data > 0 ? '<span class="badge badge-success" '. ($title ? 'data-toggle="tooltip" title="'. $title .' Ada"' : '') .'>'.($ada ?? 'Ada').'</span>' : '<span class="badge badge-danger" '. ($title ? 'data-toggle="tooltip" title="'. $title .' Belum Input"' : '') .'>'.($belum ?? 'Belum Input').'</span>';
    }
}

if (! function_exists('status')) {
    function status($data, $ada = null, $belum = null)
    {
        return $data > 0 ? ($ada ?? 'Ada') : ($belum ?? 'Belum Input');
    }
}

if (! function_exists('status_kolom')) {
    function status_kolom($data, $ada = null, $belum = null)
    {
        return $data > 0 ? '<td style="border: 1px solid black; background-color: green; text-align: center;">' . ($ada ?? 'Ada') . '</td>' : '<td style="border: 1px solid black; background-color: red; text-align: center;">' . ($belum ?? 'Belum Input') . '</td>';
    }
}

if (! function_exists('file_upload')) {
    function file_upload($file, $path, $old_file = null)
    {
        $file_name = time() . "_" . $file->getClientOriginalName();
        if (move_uploaded_file($file->getPathName(),storage_path('app/'.$path.'/'.$file_name))) {
            if ($old_file) {
                unlink(storage_path('app/'.$path . '/' . $old_file));
            }
            return $path.'/'. $file_name;
        }
        return false;
    }
}

if (! function_exists('file_upload_other_server')) {
    function file_upload_other_server($file, $path, $old_file = null)
    {
        $upload = Http::attach('file', file_get_contents($file->getPathName()), time() . "_" . $file->getClientOriginalName())
                    ->post(env('URL_FILE_UPLOAD_OTHER_SERVER'),['path' => $path, 'upload_file' => 1, 'old_file' => $old_file]);
        return $upload->body();
    }
}

if (! function_exists('file_remove_other_server')) {
    function file_remove_other_server($path)
    {
        $upload = Http::post(env('URL_FILE_UPLOAD_OTHER_SERVER'),['path' => $path, 'remove_file' => 1]);
        return $upload->body();
    }
}

if (! function_exists('gdrive_upload')) {
    function gdrive_upload($file)
    {
        $client = new \Google_Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));
        $service = new \Google_Service_Drive($client);
        $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, env('GOOGLE_DRIVE_FOLDER_ID'));
        $config  = new Config(['mimetype', $file->getClientMimeType()]);
        $currentFile = $adapter->write(time() . "_" . $file->getClientOriginalName(),file_get_contents($file->getPathName()), $config);
        return $currentFile['path'];
    }
}

if (! function_exists('backup')) {
    function backup($file)
    {
        $conn = mysqli_connect(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
        $templine = '';
        $lines = file($file);
        foreach ($lines as $key => $line) {
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            $templine .= $line;
            if (substr(trim($line), -1, 1) == ';') {
                $conn->query($templine);
                $templine = '';
            }
        }
        mysqli_close($conn);
    }
}

if (! function_exists('kriteria')) {
    function kriteria($request){
        switch ($request->kriteria) {
            case 'periode':
                $request->validate([
                    'periode' => ['required'],
                ]);
                break;

            case 'rentang-waktu':
                $request->validate([
                    'tanggal_awal'  => ['required','date'],
                    'tanggal_akhir' => ['required','date'],
                ]);
                break;

            case 'bulan':
                $request->validate([
                    'bulan' => ['required','date_format:Y-m'],
                ]);
                break;

            case 'tahun':
                $request->validate([
                    'tahun' => ['required','date_format:Y'],
                ]);
                break;
        }
    }
}

if (! function_exists('jurnal')) {
    function jurnal($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $tahun, $akun) {
        switch ($kriteria) {
            case 'periode':
                switch ($periode) {
                    case '1-tahun-terakhir':
                        return App\Models\Jurnal::where('akun_id', $akun->id)->whereBetween('tanggal', [date('Y-m-d', strtotime('-365 day')), date('Y-m-d')])->orderBy('tanggal','asc')->get();
                        break;

                    case '1-bulan-terakhir':
                        return App\Models\Jurnal::where('akun_id', $akun->id)->whereBetween('tanggal', [date('Y-m-d', strtotime('-30 day')), date('Y-m-d')])->orderBy('tanggal','asc')->get();
                        break;

                    case '1-minggu-terakhir':
                        return App\Models\Jurnal::where('akun_id', $akun->id)->whereBetween('tanggal', [date('Y-m-d', strtotime('-7 day')), date('Y-m-d')])->orderBy('tanggal','asc')->get();
                        break;
                }
                break;

            case 'rentang-waktu':
                return App\Models\Jurnal::where('akun_id', $akun->id)->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])->orderBy('tanggal','asc')->get();
                break;

            case 'bulan':
                return App\Models\Jurnal::where('akun_id', $akun->id)->whereMonth('tanggal', date('m',strtotime($bulan)))->whereYear('tanggal',date('Y',strtotime($bulan)))->orderBy('tanggal','asc')->get();
                break;

            case 'tahun':
                return App\Models\Jurnal::where('akun_id', $akun->id)->whereYear('tanggal',$tahun)->orderBy('tanggal','asc')->get();
                break;

            default:
                return $akun->jurnal;
                break;
        }

    }
}

if (! function_exists('neraca')) {
    function neraca($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $tahun, $akun, $saldo = 0, $penyesuaian = 0) {
        $jurnal = jurnal($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $tahun, $akun);

        foreach ($jurnal as $item) {
            if ($item->umum_atau_penyesuaian == 1) {
                $saldo = saldo($item, $saldo);
            } else {
                $penyesuaian += $item->nilai;
            }
        }

        if ($akun->post_saldo == $akun->post_penyesuaian) {
            $disesuaikan = $saldo + $penyesuaian;
        } else {
            $disesuaikan = $saldo - $penyesuaian;
        }

        return [
            'saldo'         => $saldo,
            'penyesuaian'   => $penyesuaian,
            'disesuaikan'   => $disesuaikan
        ];
    }
}

if (! function_exists('neraca_akun')) {
    function neraca_akun($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $tahun, $akun) {
        $saldo= 0; $penyesuaian = 0; $disesuaikan = 0; $data = null;
        foreach($akun as $item) {
            $data = neraca($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $tahun, $item, $saldo, $penyesuaian);
            $saldo = $data['saldo'];
            $penyesuaian = $data['penyesuaian'];
        }
        if ($data) {
            $disesuaikan = $data['disesuaikan'];
        }
        return $disesuaikan;
    }
}

if (! function_exists('rasio')) {
    function rasio($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $tahun, $where, $where_value, $posisi_saldo) {
        $debit = 0;
        $kredit = 0;
        foreach (App\Models\Akun::where($where, $where_value)->orderBy('kode')->get() as $item) {
            $data = neraca($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $tahun, $item);
            if ($item->post_saldo == $posisi_saldo) {
                $debit += $data['disesuaikan'];
            } else {
                $kredit += $data['disesuaikan'];
            }
        }
        return $debit - $kredit;;
    }
}

if (! function_exists('total_rasio')) {
    function total_rasio($jumlah1, $jumlah2) {
        try {
            $total_rasio = round($jumlah1/$jumlah2, 2) .'%';
        } catch (\Throwable $th) {
            $total_rasio = '∞';
        }
        return $total_rasio;
    }
}

if (! function_exists('saldo')) {
    function saldo($jurnal_umum, $saldo = 0) {
        if ($jurnal_umum->debit_atau_kredit == $jurnal_umum->akun->post_saldo) {
            $saldo += $jurnal_umum->nilai;
        } else {
            $saldo -= $jurnal_umum->nilai;
        }
        return $saldo;
    }
}

if(!function_exists('menit')){
    function menit($mulai,$berakhir) {
        $selisih = $mulai->diff($berakhir);
        $menit = $selisih->days * 24 * 60;
        $menit += $selisih->h * 60;
        $menit += $selisih->i;
        return $menit;
    }
}

if(!function_exists('telat')){
    function telat($data_pribadi,$waktu_masuk,$informasi_umum,$hari) {
        if ($data_pribadi->minggu_kerja['tipe_'.$hari] == 1) {
            if ($data_pribadi->minggu_kerja['waktu_masuk_'.$hari]) {
                if ($waktu_masuk > $data_pribadi->minggu_kerja['waktu_masuk_'.$hari]) {
                    $mulai = new DateTime($data_pribadi->minggu_kerja['waktu_masuk_'.$hari]);
                    $berakhir = new DateTime($waktu_masuk);
                    $waktu = menit($mulai,$berakhir);
                    $kelipatan = 0;
                    if ($informasi_umum->waktu_telat && $data_pribadi->gaji->mata_uang->jumlah_potongan) {
                        for ($i=1; $i < $waktu; $i++) {
                            if ($i % $informasi_umum->waktu_telat == 0) {
                                $kelipatan++;
                            }
                        }
                        return $data_pribadi->gaji->mata_uang->jumlah_potongan * $kelipatan;
                    }
                }
            }
        }

        return 0;
    }
}

if(!function_exists('lembur')){
    function lembur($data_pribadi,$waktu_pulang,$informasi_umum,$hari) {
        if ($data_pribadi->minggu_kerja['tipe_'.$hari] == 1) {
            if ($data_pribadi->minggu_kerja['waktu_keluar_'.$hari]) {
                if ($waktu_pulang > $data_pribadi->minggu_kerja['waktu_keluar_'.$hari]) {
                    $mulai = new DateTime($data_pribadi->minggu_kerja['waktu_keluar_'.$hari]);
                    $berakhir = new DateTime($waktu_pulang);
                    $waktu = menit($mulai,$berakhir);
                    $kelipatan = 0;
                    if ($informasi_umum->waktu_lembur && $data_pribadi->gaji->mata_uang->lembur) {
                        for ($i=1; $i <= $waktu; $i++) {
                            if ($i % $informasi_umum->waktu_lembur == 0) {
                                $kelipatan++;
                            }
                        }
                        return $data_pribadi->gaji->mata_uang->lembur * $kelipatan;
                    }
                }
            }
        }

        return 0;
    }
}

if (! function_exists('telat_lembur')) {
    function telat_lembur($data_pribadi, $kehadiran, $lembur, $telat, $informasi_umum) {
        $hari = date('w', strtotime($kehadiran->waktu_masuk));
        $waktu_masuk = date('H:i:s',strtotime($kehadiran->waktu_masuk));
        $waktu_pulang = date('H:i:s',strtotime($kehadiran->waktu_pulang));
        switch ($hari) {
            case 0:
                if ($data_pribadi->minggu_kerja->waktu_masuk_minggu && $data_pribadi->minggu_kerja->waktu_keluar_minggu) {
                    $lembur += lembur($data_pribadi,$waktu_pulang,$informasi_umum,'minggu');
                    $telat += telat($data_pribadi,$waktu_masuk,$informasi_umum,'minggu');
                }
                break;
            case 1:
                if ($data_pribadi->minggu_kerja->waktu_masuk_senin && $data_pribadi->minggu_kerja->waktu_keluar_senin) {
                    $lembur += lembur($data_pribadi,$waktu_pulang,$informasi_umum,'senin');
                    $telat += telat($data_pribadi,$waktu_masuk,$informasi_umum,'senin');
                }
                break;
            case 2:
                if ($data_pribadi->minggu_kerja->waktu_masuk_selasa && $data_pribadi->minggu_kerja->waktu_keluar_selasa) {
                    $lembur += lembur($data_pribadi,$waktu_pulang,$informasi_umum,'selasa');
                    $telat += telat($data_pribadi,$waktu_masuk,$informasi_umum,'selasa');
                }
                break;
            case 3:
                if ($data_pribadi->minggu_kerja->waktu_masuk_rabu && $data_pribadi->minggu_kerja->waktu_keluar_rabu) {
                    $lembur += lembur($data_pribadi,$waktu_pulang,$informasi_umum,'rabu');
                    $telat += telat($data_pribadi,$waktu_masuk,$informasi_umum,'rabu');
                }
                break;
            case 4:
                if ($data_pribadi->minggu_kerja->waktu_masuk_kamis && $data_pribadi->minggu_kerja->waktu_keluar_kamis) {
                    $lembur += lembur($data_pribadi,$waktu_pulang,$informasi_umum,'kamis');
                    $telat += telat($data_pribadi,$waktu_masuk,$informasi_umum,'kamis');
                }
                break;
            case 5:
                if ($data_pribadi->minggu_kerja->waktu_masuk_jumat && $data_pribadi->minggu_kerja->waktu_keluar_jumat) {
                    $lembur += lembur($data_pribadi,$waktu_pulang,$informasi_umum,'jumat');
                    $telat += telat($data_pribadi,$waktu_masuk,$informasi_umum,'jumat');
                }
                break;
            case 6:
                if ($data_pribadi->minggu_kerja->waktu_masuk_sabtu && $data_pribadi->minggu_kerja->waktu_keluar_sabtu) {
                    $lembur += lembur($data_pribadi,$waktu_pulang,$informasi_umum,'sabtu');
                    $telat += telat($data_pribadi,$waktu_masuk,$informasi_umum,'sabtu');
                }
                break;
        }
        return [
            'lembur'    => $lembur,
            'telat'     => $telat,
        ];
    }
}

if (! function_exists('total_gaji')) {
    function total_gaji($data_pribadi, $kehadiran, $informasi_umum) {
        $mata_uang = '';
        if ($data_pribadi->gaji->mata_uang) {
            $mata_uang = $data_pribadi->gaji->mata_uang->tipe_mata_uang->kode;
        }
        $total_gaji = jumlah_gaji($data_pribadi,$kehadiran,$informasi_umum);
        return $mata_uang .' '. substr(number_format($total_gaji, 2, ',' , '.'),0,-3);
    }
}

if (! function_exists('jumlah_gaji')) {
    function jumlah_gaji($data_pribadi, $kehadiran, $informasi_umum) {
        if ($data_pribadi->gaji->mata_uang) {
            $gaji = $data_pribadi->gaji->mata_uang;
            $lembur = 0;
            $telat = 0;

            foreach ($kehadiran as $item) {
                $telat_lembur = telat_lembur($data_pribadi,$item,$lembur,$telat,$informasi_umum);
                $telat += $telat_lembur['telat'];
                $lembur += $telat_lembur['lembur'];
            }

            $total_gaji = $gaji->gaji_pokok + $gaji->tunjangan_jabatan + $gaji->tunjangan_fungsional + (($gaji->uang_hadir + $gaji->uang_makan) * count($kehadiran)) + $lembur - ($gaji->jamsostek + $gaji->bpjs + $telat);
        } else {
            $total_gaji = 0;
        }
        return $total_gaji;
    }
}
