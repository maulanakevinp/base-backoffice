@extends('layouts.master')
@section('title', 'Kelola Submenu')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    @include('layouts.components.alert')
    @include('layouts.components.breadcrumb', [
        'title' => 'Kelola Submenu',
        'breadcrumb' => '
            <li class="breadcrumb-item"><a href="'. route('menu.index') .'">Kelola Menu</a></li>
            <li class="breadcrumb-item"><a href="#">'. $menu->nama .'</a></li>
        '
    ])

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Kelola Submenu</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item"><a href="#modal-submenu" id="tambah-submenu" data-toggle="modal"><i class="feather icon-plus"></i> tambah</a></li>
                                <li class="dropdown-item"><a href="#" id="hapus-submenu" data-toggle="modal"><i class="feather icon-trash"></i> hapus terpilih</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-submenu table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="10px"><input type="checkbox" name="check_all-submenu" id="check_all-submenu"></th>
                                    <th width="10px">#</th>
                                    <th>Nama</th>
                                    <th>URL</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-submenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-submenuLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-submenu" class="form" autocomplete="off" action="{{ route('submenu.store') }}" method="post" enctype="multipart/form-data">
                    @csrf @method('post')
                    <div class="modal-header bg-c-blue">
                        <h5 class="modal-title text-white" id="modal-submenuLabel">Tambah Kelola Submenu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="menu_id" name="menu_id" value="{{ request()->segment(2) }}">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Masukkan URL">
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
<script>
    function urutan (id, urutan) {
        $.ajax({
            url: BASEURL + '/menu/submenu/urutan',
            method: 'post',
            data: {
                _token: CSRF,
                id: id,
                urutan: urutan
            },
            success: function(response) {
                $(".table-submenu").DataTable().ajax.reload();
                alertSuccess(response.message);
                setTimeout(() => {
                    $(".notifikasi").html('');
                }, 2000);
            }
        });
    }
    $(document).ready(function () {
        // $("body").tooltip({ selector: '[data-toggle=tooltip]' });

        $("table").dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": BASEURL + "/menu/"+ $("#menu_id").val() +"/submenu",
            "columns": [
                {data: 'check', name: 'check',  orderable: false, searchable:false},
                {data: 'urutan',name: 'urutan'},
                {data: 'nama',  name: 'nama'},
                {data: 'url',   name: 'url'},
                {data: 'edit',  name: 'edit',   orderable: false,searchable:false,},
            ],
            "order": [[ 1, "asc" ]],
            "language": LANGUAGE,
        });

        $("#tambah-submenu").click(function () {
            $("#fontawesome").attr('class', '');
        });

        formCRUD('Kelola Submenu', 'menu/submenu', 'submenu', function (response) {
            $.each(response.data, function(key, item) {
                $(`[name="${key}"]`).val(item);
            });

            $("#fontawesome").attr('class', response.data.icon);
        });

        $("#icon").on('keyup', function () {
            $("#fontawesome").attr('class', $(this).val());
        });

        $(document).on("click",".atas",function (event) {
            event.preventDefault();
            urutan($(this).data('id'), 'atas');
        });

        $(document).on("click",".bawah",function (event) {
            event.preventDefault();
            urutan($(this).data('id'), 'bawah');
        });
    });
</script>
@endpush
