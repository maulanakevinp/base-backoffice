@extends('layouts.master')
@section('title', 'Pengguna')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}">
@endsection

@section('content')
    @include('layouts.components.alert')
    @include('layouts.components.breadcrumb', [
        'title' => 'Pengguna',
        'breadcrumb' => '
            <li class="breadcrumb-item"><a href="#!">Admin</a></li>
            <li class="breadcrumb-item"><a href="#!">Kelola Pengguna</a></li>
        '
    ])

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pengguna</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item"><a href="#modal-pengguna" id="tambah-pengguna" data-toggle="modal"><i class="feather icon-plus"></i> tambah</a></li>
                                <li class="dropdown-item"><a href="#" id="hapus-pengguna" data-toggle="modal"><i class="feather icon-trash"></i> hapus terpilih</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-pengguna table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="10px"><input type="checkbox" name="check_all-pengguna" id="check_all-pengguna"></th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Peran</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-pengguna" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-penggunaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-pengguna" class="form" autocomplete="off" action="" method="post">
                    @csrf @method('post')
                    <div class="modal-header bg-c-blue">
                        <h5 class="modal-title text-white" id="modal-penggunaLabel">Tambah Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="peran_id">Peran</label>
                            <select class="form-control form-select" id="peran_id" name="peran_id">
                                <option value="">Pilih</option>
                                @foreach (App\Models\Peran::all() as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div>
                                <div class="radio radio-primary d-inline">
                                    <input type="radio" name="status" id="status1" value="1">
                                    <label for="status1" class="cr">Aktif</label>
                                </div>
                                <div class="radio radio-primary d-inline">
                                    <input type="radio" name="status" id="status2" value="0">
                                    <label for="status2" class="cr">Tidak Aktif</label>
                                </div>
                            </div>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group edit" style="display: none;">
                            <div>
                                <div class="checkbox checkbox-fill d-inline">
                                    <input type="checkbox" name="ganti_password" id="ganti_password" value="1">
                                    <label for="ganti_password" class="cr">Ganti Password</label>
                                </div>
                            </div>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group ganti_password" style="display: none;">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group ganti_password" style="display: none;">
                            <label for="konfirmasi_password">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan Password">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn  btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/form.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.form-select').select2({
            dropdownParent: $('#modal-pengguna'),
            placeholder: 'Pilih',
            allowClear: true,
            width: '100%'
        });
        $(".table-pengguna").dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": BASEURL + "/pengguna",
            "columns": [
                {data: 'check',     name: 'check',  orderable: false,searchable:false},
                {data: 'username',  name: 'username'},
                {data: 'email',     name: 'email'},
                {data: 'nama',      name: 'nama'},
                {data: 'peran',     name: 'peran'},
                {data: 'status',    name: 'status'},
                {data: 'edit',      name: 'edit',   orderable: false,searchable:false},
            ],
            "order": [[ 1, "asc" ]],
            "language": LANGUAGE,
        });

        formCRUD('Pengguna', 'pengguna', 'pengguna', function(response) {
            $(".edit").css('display','');
            $(".ganti_password").css("display",'none');
            $("#data-pribadi").css('display','none');
            $("#nama").val(response.data.data_pribadi.nama);
            $.each(response.data, function(key, item) {
                if (key == 'status') {
                    if (item == 1) {
                        $(`#status1`).prop('checked', true);
                    } else {
                        $(`#status2`).prop('checked', true);
                    }
                } else {
                    $(`[name="${key}"]`).val(item);
                }

                if ($(`[name="${key}"]`).is('select')) {
                    $(`[name="${key}"]`).trigger('change');
                }
            });
        });

        $("#tambah-pengguna").click(function () {
            $(".edit").css('display','none');
            $("#data-pribadi").css('display','');
            $(".ganti_password").css("display",'');
        });

        $("#ganti_password").click(function () {
            if ($(this).prop('checked') == true) {
                $(".ganti_password").css("display",'');
            } else {
                $(".ganti_password").css("display",'none');
            }
        });
    });
</script>
@endpush
