@extends('layouts.master')
@section('title', 'Peran')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
    @include('layouts.components.alert')
    @include('layouts.components.breadcrumb', [
        'title' => 'Peran',
        'breadcrumb' => '
            <li class="breadcrumb-item"><a href="#!">Admin</a></li>
            <li class="breadcrumb-item"><a href="#!">Pekerjaan</a></li>
        '
    ])

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Peran</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item"><a href="#modal-peran" id="tambah-peran" data-toggle="modal"><i class="feather icon-plus"></i> tambah</a></li>
                                <li class="dropdown-item"><a href="#" id="hapus-peran" data-toggle="modal"><i class="feather icon-trash"></i> hapus terpilih</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-peran table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="10px"><input type="checkbox" name="check_all-peran" id="check_all-peran"></th>
                                    <th>Nama</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-peran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-peranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-peran" class="form" autocomplete="off" action="{{ route('peran.store') }}" method="post" enctype="multipart/form-data">
                    @csrf @method('post')
                    <div class="modal-header bg-c-blue">
                        <h5 class="modal-title text-white" id="modal-peranLabel">Tambah Peran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Peran">
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
    $(document).ready(function () {
        $("table").dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": BASEURL + "/peran",
            "columns": [
                {data: 'check', name: 'check',  orderable: false, searchable:false},
                {data: 'nama',  name: 'nama'},
                {data: 'edit',  name: 'edit',   orderable: false,searchable:false,},
            ],
            "order": [[ 1, "asc" ]],
            "language": LANGUAGE,
        });
        formCRUD('Peran', 'peran', 'peran');

        $(document).on('click',".kunci-peran",function (event) {
            event.preventDefault();
            const btn = $(this);
            $.ajax({
                url: BASEURL + '/peran/update-kunci/' + $(btn).data('id'),
                method: 'post',
                data : { _token : CSRF },
                beforeSend: function () {
                    $(btn).attr('disabled', 'disabled');
                    $(btn).html(`<span class="spinner-border spinner-border-sm" role="status"></span>`);
                },
                success: function (response) {
                    if (response.success) {
                        alertSuccess(response.message);
                        setTimeout(() => {
                            $('.alert-dismissible').remove();
                        }, 2000);
                        $("table").DataTable().ajax.reload();
                    }
                }
            })
        });
    });
</script>
@endpush
