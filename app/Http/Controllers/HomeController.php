<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        if (request()->ajax()) {
            $activity_log = ActivityLog::select('activity_log.*')
                                        ->join('users','users.id','=','activity_log.causer_id')
                                        ->join('data_pribadi','data_pribadi.id','=','users.data_pribadi_id')
                                        ->join('peran','peran.id','=','users.peran_id')
                                        ->when(auth()->user()->peran->nama != 'Super Admin', function ($query) {
                                            return $query->where('causer_id',auth()->user()->id);
                                        });
            return datatables()->of($activity_log)
                ->addColumn('avatar', function ($data) {
                    return '<img src="'. asset(Storage::url($data->user->data_pribadi->avatar)) .'" class="img-radius wid-40" alt="Foto profil '. $data->user->data_pribadi->nama .'">';
                })
                ->editColumn('nama', function ($data) {
                    return '<div style="white-space:normal">'.$data->user->data_pribadi->nama. '</div>';
                })
                ->addColumn('peran', function ($data) {
                    return $data->user->peran->nama;
                })
                ->addColumn('deskripsi', function ($data) {
                    $html = $data->description;
                    if ($data->properties != '[]') {
                        $html .= '<button class="btn btn-sm detail-log" title="Detail" data-id="'. $data->id .'"><i class="fas fa-eye"></i></button>';
                    }
                    return '<div style="white-space:normal">'.$html. '</div>';
                })
                ->addColumn('waktu', function ($data) {
                    return Carbon::parse($data->created_at)->diffForHumans();
                })
                ->rawColumns(['avatar','nama','peran','deskripsi','waktu'])
                ->make(true);
        }

        return view('dashboard.index');
    }

    public function log_activity(ActivityLog $activity_log)
    {
        $properties = json_decode($activity_log->properties);
        return response()->json([
            'avatar'        => url(Storage::url($activity_log->user->data_pribadi->avatar)),
            'nama'          => $activity_log->user->data_pribadi->nama,
            'peran'         => $activity_log->user->peran->nama,
            'description'   => $activity_log->description,
            'created_at'    => Carbon::parse($activity_log->created_at)->diffForHumans(),
            'data_lama'     => $properties->old,
            'data_baru'     => $properties->attributes,
        ]);
    }

    public function notifikasi()
    {
        $total_notifikasi = 0;
        return response()->json([
            'total_notifikasi'  => $total_notifikasi,
            'peran'             => auth()->user()->peran->nama,
            'data'              => []
        ]);
    }
}
