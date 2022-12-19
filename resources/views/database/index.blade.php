@extends('layouts.master')
@section('title','Database')

@section('content')
    @include('layouts.components.alert')
    @include('layouts.components.breadcrumb', [
        'title' => 'Database',
        'breadcrumb' => ''
    ])

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>Database</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item"><a href="{{ route("database.backup") }}"><i class="feather icon-file"></i> backup HRM</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form" autocomplete="off" action="{{ route('database.restore') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label" for="sql">File (sql)</label>
                            <div class="custom-file">
                                <input type="file" accept=".sql" class="custom-file-input form-control" id="sql" name="sql" placeholder="Masukkan File sql ...">
                                <label class="custom-file-label" for="sql">Masukkan File sql</label>
                            </div>
                            <span class="invalid-feedback"></span>
                        </div>
                        <p class="text-sm mb-3 text-danger">*Pastikan file yang dimasukkan adalah hasil backupan dari backup database</p>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sync"></i> Restore Database</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>Folder</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item"><a href="{{ route("folder.backup") }}"><i class="feather icon-file"></i> backup folder</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form" autocomplete="off" action="{{ route('folder.restore') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label" for="zip">File (zip)</label>
                            <div class="custom-file">
                                <input type="file" accept=".zip" class="custom-file-input form-control" id="zip" name="zip" placeholder="Masukkan File zip ...">
                                <label class="custom-file-label" for="zip">Masukkan File zip</label>
                            </div>
                            <span class="invalid-feedback"></span>
                        </div>
                        <p class="text-sm mb-3 text-danger">*Pastikan file yang dimasukkan adalah hasil backupan dari backup folder</p>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sync"></i> Restore Folder Backup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
