<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataPribadiRequest;
use App\Http\Requests\UserRequest;
use App\Models\DataPribadi;
use App\Models\DetailKontak;
use App\Models\JenisKelamin;
use App\Models\Kebangsaan;
use App\Models\StatusPernikahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $sql = "SELECT users.id, peran.nama as peran, data_pribadi.nama, username, email, status FROM users
                        JOIN peran on users.peran_id = peran.id
                        JOIN data_pribadi on users.data_pribadi_id = data_pribadi.id
                        WHERE users.id <> 1;";
            return datatables()->of(DB::select($sql))
                ->addColumn('edit', function ($data) {
                    return '<a href="#" class="ubah-pengguna" title="Ubah" data-id="'. $data->id .'"><i class="fas fa-edit"></i></a>';
                })
                ->editColumn('status', function ($data) {
                    return $data->status ? 'Aktif' : 'Tidak Aktif';
                })
                ->addColumn('check', function ($data) {
                    return '<input type="checkbox" class="check-pengguna" value="'. $data->id .'">';
                })
                ->rawColumns(['check', 'edit', 'status'])
                ->make(true);
        }
        activity()->log('Melihat Daftar Pengguna');

        return view('pengguna.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $data_pribadi = DataPribadi::create([
            'nama'  => $request->nama
        ]);
        DetailKontak::create(['data_pribadi_id' => $data_pribadi->id]);
        $data['data_pribadi_id'] = $data_pribadi->id;
        unset($data['nama']);
        User::create($data);
        activity()->log('Menambah Data Pengguna');
        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil ditambahkan',
            'reload'  => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPribadi  $data_pribadi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_pribadi = DataPribadi::findOrFail($id);
        $title = "Detail Pengguna";
        activity()->log('Melihat Profil Pengguna');
        return view('user.profil', compact('data_pribadi','title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function show(User $pengguna)
    {
        activity()->log('Melihat Data Pengguna');
        return response()->json([
            'success'       => true,
            'data'          => [
                'user'          => $pengguna,
                'data_pribadi'  => $pengguna->data_pribadi
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $pengguna)
    {
        $data = $request->validated();

        if ($request->ganti_password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        if (!$request->karyawan) {
            DataPribadi::find($pengguna->data_pribadi_id)->update([
                'nama' => $request->nama
            ]);
            unset($data['nama']);
        }

        $data_lama = $pengguna->toArray();
        unset($data_lama['id'],$data_lama['created_at'],$data_lama['updated_at']);
        activity()->withProperties(['attributes' => $data, 'old' => $data_lama])->log('Memperbarui Data Pengguna');

        $pengguna->update($data);
        return response()->json([
            'success'   => true,
            'message'   => 'Pengguna berhasil diperbarui',
            'reload'    => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::whereIn('id', $request->id)->delete();
        activity()->log('Menghapus Data Pengguna');
        return response()->json([
            'success'   => true,
            'message'   => 'Pengguna berhasil dihapus',
        ]);
    }

    public function profil()
    {
        $data_pribadi = auth()->user()->data_pribadi;
        $title = "Profil";
        activity()->log('Melihat Profil');
        return view('user.profil', compact('data_pribadi','title'));
    }

    public function updateAvatar(Request $request, $id)
    {
        $data_pribadi = DataPribadi::findOrFail($id);
        if ($request->hapus) {
            if ($data_pribadi->avatar != 'public/noavatar.png') {
                File::delete(storage_path('app/'.$data_pribadi->avatar));
            }
            $data_pribadi->avatar = 'public/noavatar.png';
            $data_pribadi->save();
            return response()->json([
                'success'   => true,
                'message'   => 'Foto profil berhasil dihapus',
                'data'      => ['avatar' => $data_pribadi->avatar],
            ]);
        } else {
            $request->validate([
                'avatar'   => ['required', 'image', 'max:2048']
            ]);

            if ($data_pribadi->avatar != 'public/noavatar.png') {
                File::delete(storage_path('app/'.$data_pribadi->avatar));
            }
            $data_pribadi->avatar = $request->file('avatar')->store('public/user');
            $data_pribadi->save();
            activity()->log('Memperbarui Foto Profil');
            return response()->json([
                'success'   => true,
                'message'   => 'Foto profil berhasil diperbarui',
                'data'      => ['avatar' => $data_pribadi->avatar],
            ]);
        }

    }

    public function pengaturan()
    {
        activity()->log('Melihat Pengaturan Akun');
        return view('user.pengaturan');
    }

    public function updatePengaturan(Request $request, User $user)
    {
        $request->validate([
            'username'      => ['nullable','string','max:64','alpha_dash','unique:users,username,'. $user->id],
            'email'         => ['nullable','email','max:64','unique:users,email,'. $user->id],
            'password'      => ['nullable','string','min:8','confirmed'],
            'password_lama' => ['required','string','min:8'],
        ]);

        if (Hash::check($request->password_lama, $user->password)) {
            activity()->withProperties([
                'attributes' => [
                    'username'      => $request->username,
                    'email'         => $request->email,
                    'password'      => $request->password,
                ],
                'old' => [
                    'username'      => $user->username,
                    'email'         => $user->email,
                    'password'      => $request->lama,
                ]
            ])->log('Memperbarui Akun');

            if($request->email){
                $user->email = $request->email;
                $user->email_verified_at = null;
            }

            if($request->username){
                $user->username = $request->username;
            }

            if ($request->password && $request->password_confirmation) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
            return redirect()->back()->with('success','Akun berhasil diperbarui');
        } else {
            return redirect()->back()->with('error','Password yang anda masukkan salah');
        }
    }
}
