@extends('layouts.master')
@section('title', 'Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.css') }}">

<script src="{{ asset('assets/js/plugins/highcarts/highstock.js')}}"></script>
<script src="{{ asset('assets/js/plugins/highcarts/exporting.js')}}"></script>
<script src="{{ asset('assets/js/plugins/highcarts/accessibility.js')}}"></script>
@endsection

@section('content')
@include('layouts.components.alert')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Log Aktivitas Pengguna</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(12px, 28px, 0px);">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-log-activity" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    @if (auth()->user()->peran->nama == 'Super Admin')
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Peran</th>
                                    @endif
                                    <th>Deskripsi</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-log" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-logLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-c-blue">
                        <h5 class="modal-title text-white" id="modal-logLabel">Detail Log Aktivitas Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <tr>
                                        <td style="white-space: normal; vertical-align: middle;">
                                            <img id="avatar-detail-log" src="{{ url('/storage/noavatar.png') }}" class="img-radius wid-40" alt="Foto Profil">
                                        </td>
                                        <td style="white-space: normal; vertical-align: middle;">
                                            <span id="nama-detail-log" class="badge badge-success"></span>
                                        </td>
                                        <td style="white-space: normal; vertical-align: middle;">
                                            <span id="peran-detail-log" class="badge badge-warning"></span>
                                        </td>
                                        <td style="white-space: normal; vertical-align: middle;">
                                            <span id="description-detail-log" class="badge badge-primary"></span>
                                        </td>
                                        <td style="white-space: normal; vertical-align: middle;">
                                            <span id="created_at-detail-log" class="badge badge-danger"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-striped">
                                        <thead>
                                            <tr><th colspan="3" class="px-2">Data Lama</th></tr>
                                        </thead>
                                        <tbody id="table-data-lama">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-striped">
                                        <thead>
                                            <tr><th colspan="3" class="px-2">Data Baru</th></tr>
                                        </thead>
                                        <tbody id="table-data-baru">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="peran" name="peran" value="{{ auth()->user()->peran->nama }}">
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        if ($("#peran").val() == 'Super Admin') {
            $("#table-log-activity").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": BASEURL + "/dashboard",
                "columns": [
                    {data: 'avatar',    name: 'avatar',                     orderable: false,   searchable:false},
                    {data: 'nama',      name: 'data_pribadi.nama',          orderable: false},
                    {data: 'peran',     name: 'peran.nama',                 orderable: false},
                    {data: 'deskripsi', name: 'description',                orderable: false},
                    {data: 'waktu',     name: 'activity_log.created_at',    searchable: false},
                ],
                "order": [[ 4, "desc" ]],
                "language": LANGUAGE,
            });
        } else {
            $("#table-log-activity").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": BASEURL + "/dashboard",
                "columns": [
                    {data: 'deskripsi', name: 'description',                orderable: false},
                    {data: 'waktu',     name: 'activity_log.created_at',    searchable: false},
                ],
                "order": [[ 1, "desc" ]],
                "language": LANGUAGE,
            });

        }
        $('[data-toggle="tooltip"]').tooltip()

        $(document).on('click',".detail-log",function () {
            const btn = this;
            $(btn).html(`<div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>`);
            $.get(BASEURL + '/log-activity/' + $(btn).data('id'), function (response) {
                $(btn).html('<i class="fas fa-eye"></i>');
                $("#modal-log").modal('show');
                $('#avatar-detail-log').attr('src', response.avatar);
                $('#avatar-detail-log').attr('alt', 'Foto Profil ' + response.avatar);
                $('#nama-detail-log').html(response.nama);
                $('#peran-detail-log').html(response.peran);
                $('#description-detail-log').html(response.description);
                $('#created_at-detail-log').html(response.created_at);
                $("#table-data-lama").html('');
                $("#table-data-baru").html('');
                $.each(response.data_lama, function (key, item) {
                    $("#table-data-lama").append(`
                        <tr>
                            <td class="px-2">${key}</td>
                            <td class="px-0" width="10px">:</td>
                            <td class="pl-0 pr-3">${item}</td>
                        </tr>
                    `);
                });
                $.each(response.data_baru, function (key, item) {
                    $("#table-data-baru").append(`
                        <tr>
                            <td class="px-2">${key}</td>
                            <td class="px-0" width="10px">:</td>
                            <td class="px-2">${item}</td>
                        </tr>
                    `);
                });
            });
        });

        let pie = {
            chart: {
                type: 'pie'
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y:f}%'
                    }
                },
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    showInLegend: true
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px"></span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}%</b><br/><span style="color:{point.color}">Jumlah: <b>{point.jumlah}</b></span>'
            },

            series: [
                {
                    name: "Persentase",
                    colorByPoint: true,
                    shadow:1,
                    border:1,
                    data: []
                }
            ]
        }

        let column2 = {
            chart: {
                type: 'column'
            },
            xAxis: {
                type: 'category'
            },
            legend: {
                enabled: false
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Persentase'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: `<tr>
                    <td style="color:{series.color};padding:0">{series.name}: </td>
                    <td style="padding:0"><b> {point.y}%</b></td>
                </tr>
                <tr>
                    <td style="color:{series.color};padding:0">Jumlah: </td>
                    <td style="padding:0"><b> {point.jumlah}</b></td>
                </tr>`,
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },

            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}%'
                    }
                }
            },

            series: [{
                name:"",
                colorByPoint: true,
                data:[]
            }]
        };
        let column = {
            chart: {
                type: 'column'
            },
            xAxis: {
                type: 'category'
            },
            legend: {
                enabled: false
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Persentase'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: `<tr>
                    <td style="color:{series.color};padding:0">{series.name}: </td>
                    <td style="padding:0"><b> {point.y}%</b></td>
                </tr>
                <tr>
                    <td style="color:{series.color};padding:0">Sudah Input: </td>
                    <td style="padding:0"><b> {point.ada} Desa</b></td>
                </tr>
                <tr>
                    <td style="color:{series.color};padding:0">Belum Input: </td>
                    <td style="padding:0"><b> {point.belum} Desa</b></td>
                </tr>`,
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },

            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}%'
                    }
                }
            },

            series: [{
                name:"",
                colorByPoint: true,
                data:[]
            }]
        };
    });
</script>
@endpush
