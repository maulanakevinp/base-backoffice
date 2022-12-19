@extends('layouts.layout')
@section('title', 'DPMD Jember - Beranda')

@section('styles')
<meta name="description" content="Website Resmi Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Jember">

<link rel="stylesheet" href="{{ url('') }}/assets/css/plugins/owl.carousel.min.css">
<link rel="stylesheet" href="{{ url('') }}/assets/css/plugins/slick.css">
<link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.css') }}">
<style>
    .video > iframe {
        width: 100%;
    }
    .map iframe {
        width: 100%;
        height: 100%;
    }
</style>
@endsection

@section('content')
{{-- @php
header("Expires: Tue, 30 Sep 2021 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
@endphp --}}
@if (count($slide) > 0)
    <!-- carousel hero start -->
    <div id="headline" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($slide as $key => $item)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ $item->gambar ? (env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $item->gambar : url(Storage::url($item->gambar))) : url(Storage::url('noimage.jpg')) }}" alt="Gambar {{ $item->caption }}">
                    @if ($item->caption)
                        <div class="carousel-caption">
                            <div class="judul-caption">
                                <h5 class="mb-0">{{ $item->caption }}</h5>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#headline" role="button" data-slide="prev">
            <div class="btn-slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="black" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
            </div>
        </a>
        <a class="carousel-control-next" href="#headline" role="button" data-slide="next">
            <div class="btn-slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="black" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                </svg>
            </div>
        </a>
    </div>
    <div class="container __features">
        <div class="__features_my row d-flex justify-content-lg-center">
            <div class="col-lg-3 col-sm-12 col-md-3">
                <a href="/bidang/pemberdayaan-masyarakat" class="card text-decoration-none animate-bounce" style="background: #944E0E;">
                    <div class="card-body text-center" style="height: 170px">
                        <img width="80px" class="img-fluid" src="{{ url('') }}/assets/images/icon/bidang-pemberdayaan-masyarakat.png" alt="Pemberdayaan Masyarakat" srcset="">
                        <h5 class="card-title text-white mt-3" style="font-size: 1rem">Pemberdayaan Masyarakat</h5>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-3">
                <a href="/bidang/pengelolaan-keuangan-desa" class="card text-decoration-none animate-bounce">
                    <div class="card-body text-center" style="height: 170px">
                        <img width="80px" class="img-fluid" src="{{ url('') }}/assets/images/icon/bidang-pengelolaan-keuangan.png" alt="Pengelolaan Keuangan Desa" srcset="">
                        <h5 class="card-title text-center text-primary mt-3" style="font-size: 1rem">Pengelolaan Keuangan Desa</h5>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-3">
                <a href="/bidang/pemerintahan-desa" class="card text-decoration-none animate-bounce" style="background: #FFAA06;">
                    <div class="card-body text-center" style="height: 170px">
                        <img width="80px" class="img-fluid" src="{{ url('') }}/assets/images/icon/pemdes.png" alt="Pemerintahan Desa" srcset="">
                        <h5 class="card-title text-center text-white mt-3" style="font-size: 1rem">Pemerintahan Desa</h5>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-3">
                <a href="/bidang/sarana-dan-prasarana" class="card text-decoration-none animate-bounce" style="background: #828282;">
                    <div class="card-body text-center" style="height: 170px">
                        <img width="80px" class="img-fluid" src="{{ url('') }}/assets/images/icon/sarana-prasarana.png" alt="Sarana dan Prasarana" srcset="">
                        <h5 class="card-title text-center text-white mt-3" style="font-size: 1rem">Sarana dan Prasarana</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- carousel hero end -->
@endif

<!-- section-2 start -->
@if (count($berita) > 0 || count($agenda) > 0)
    <div class="row mx-0" style="background: linear-gradient(90deg, #000000 56.25%, #FA9600 100%);">
        @if (count($berita) > 0 || count($artikel) > 0)
            <div class="col-lg-8 px-5" style="padding: 60px 0px;">
                <h2 class="text-center text-white mb-3">Berita Terkini</h2>
                <div class="row mb-5">
                    @foreach ($berita as $key => $item)
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 rounded-0">
                                <div class="card-img-top position-relative">
                                    <img src="{{ $item->gambar ? (env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $item->gambar : url(Storage::url($item->gambar))) : url(Storage::url('noimage.jpg')) }}" class="card-img-top" alt="{{ $item->judul }}" style="border-radius: 0; height: 225px; object-fit: cover;">
                                    <div class="position-absolute text-center" style="left: 0%; bottom: 0%; background-color: white; font-weight: 800; ">
                                        <div class="px-2 pt-2 pb-1" style="background-color: #FFAA06;">
                                            <h6 class="text-white font-weight-bold">{{ date('d', strtotime($item->created_at)) }}</h6>
                                        </div>
                                        <div class="px-2 pt-2 pb-1">
                                            <h6 class="text-lighter">{{ bulan(date('m', strtotime($item->created_at))) }} {{ date('Y', strtotime($item->created_at)) }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title block-with-text" style="-webkit-line-clamp: 2; height: 50px;">{{ $item->judul }}</h5>
                                    <table style="font-weight: lighter;">
                                        <tr>
                                            <th style="width: 40px;"></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="bi bi-clock" style="font-size: 1rem !important;"></i>
                                            </td>
                                            <td>
                                                diposting pukul {{ date('H.i',strtotime($item->created_at)) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="bi bi-eye" style="font-size: 1rem !important;"></i>
                                            </td>
                                            <td>
                                                dilihat {{ $item->dilihat }} kali
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="bi bi-chat-left" style="font-size: 1rem !important;"></i>
                                            </td>
                                            <td>
                                                <a class="text-decoration-none" href="{{ $item->url() }}#wpac-comment"></a>
                                            </td>
                                        </tr>
                                    </table>
                                    <a href="{{ $item->url() }}" class="btn btn-primary mt-3 float-right">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h2 class="text-center text-white mb-3">Artikel Terkini</h2>
                <div class="row">
                    @foreach ($artikel as $key => $item)
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 rounded-0">
                                <div class="card-img-top position-relative">
                                    <img src="{{ $item->gambar ? (env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $item->gambar : url(Storage::url($item->gambar))) : url(Storage::url('noimage.jpg')) }}" class="card-img-top" alt="{{ $item->judul }}" style="border-radius: 0; height: 225px; object-fit: cover;">
                                    <div class="position-absolute text-center" style="left: 0%; bottom: 0%; background-color: white; font-weight: 800; ">
                                        <div class="px-2 pt-2 pb-1" style="background-color: #FFAA06;">
                                            <h6 class="text-white font-weight-bold">{{ date('d', strtotime($item->created_at)) }}</h6>
                                        </div>
                                        <div class="px-2 pt-2 pb-1">
                                            <h6 class="text-lighter">{{ bulan(date('m', strtotime($item->created_at))) }} {{ date('Y', strtotime($item->created_at)) }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title block-with-text" style="-webkit-line-clamp: 2; height: 50px;">{{ $item->judul }}</h5>
                                    <table style="font-weight: lighter;">
                                        <tr>
                                            <th style="width: 40px;"></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="bi bi-clock" style="font-size: 1rem !important;"></i>
                                            </td>
                                            <td>
                                                diposting pukul {{ date('H.i',strtotime($item->created_at)) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="bi bi-eye" style="font-size: 1rem !important;"></i>
                                            </td>
                                            <td>
                                                dilihat {{ $item->dilihat }} kali
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="bi bi-chat-left" style="font-size: 1rem !important;"></i>
                                            </td>
                                            <td>
                                                <a class="text-decoration-none" href="{{ $item->url() }}#wpac-comment"></a>
                                            </td>
                                        </tr>
                                    </table>
                                    <a href="{{ $item->url() }}" class="btn btn-primary mt-3 float-right">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if (count($agenda) > 0)
            <div class="col-lg-4 sidebar px-5" style="padding: 60px 0px;">
                <h2 class="text-center text-white mb-3">Agenda</h2>
                <div class="row mb-5">
                    <div class="col-md-12 mb-2">
                        <div class="card mb-3 rounded-0">
                            <div class="card-body" style="height: 460px; overflow: auto">
                                @foreach ($agenda as $item)
                                    <div class="card mb-3 border-0" style="background-color: #FFAA06;">
                                        <div class="card-body">
                                            <h4 class="mb-3">{{ $item->nama }}</h4>
                                            <table>
                                                <tr>
                                                    <td class="pr-2"><i class="fas fa-clock"></i></td>
                                                    <td>Tanggal dan Waktu</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-2"></td>
                                                    <td><p style="font-size: 0.9rem">{!! tgl(date('Y-m-d', strtotime($item->mulai))). ' - ' . date('H:i', strtotime($item->mulai)) . ($item->selesai ? '<br>s/d<br>' . tgl(date('Y-m-d', strtotime($item->selesai))). ' - ' . date('H:i', strtotime($item->selesai)) : '') !!}</p></td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-2"><i class="fas fa-map-marker-alt"></i></td>
                                                    <td>Tempat</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-2"></td>
                                                    <td><p>{{ $item->tempat }}</p></td>
                                                </tr>
                                                @if ($item->keterangan)
                                                    <tr>
                                                        <td class="pr-2"><i class="fas fa-book"></i></td>
                                                        <td>Keterangan</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pr-2"></td>
                                                        <td><p>{{ nl2br($item->keterangan) }}</p></td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="text-center text-white mb-3">Link Terkait</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3 rounded-0 bg-transparent border-0">
                            <div class="card-body" style="height: 460px; overflow: auto">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <a target="_blank" href="https://kemendagri.go.id/">
                                            <img class="img-fluid" src="{{ asset('assets/images/link/KEMENDAGRIWIDGET.png') }}" alt="KEMENDAGRI" title="KEMENDAGRI">
                                        </a>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <a target="_blank" href="https://kemendesa.go.id">
                                            <img class="img-fluid" src="{{ asset('assets/images/link/KEMENDES.png') }}" alt="KEMENDES" title="KEMENDES">
                                        </a>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <a target="_blank" href="https://idm.kemendesa.go.id" class="text-center">
                                            <img class="px-3" style="width: 15rem" src="{{ asset('assets/images/link/idm.png') }}" alt="IDM" title="IDM">
                                        </a>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <a target="_blank" href="https://spanint.kemenkeu.go.id">
                                            <img class="img-fluid" src="{{ asset('assets/images/link/omspan.png') }}" alt="OM SPAN" title="OM SPAN">
                                        </a>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <a target="_blank" href="https://jatimprov.go.id">
                                            <img class="img-fluid" src="{{ asset('assets/images/link/jatimprov.png') }}" alt="JATIM PROV" title="JATIM PROV">
                                        </a>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <a target="_blank" href="https://jemberkab.go.id">
                                            <img class="img-fluid" src="{{ asset('assets/images/link/JEMBERRR.png') }}" alt="JEMBER" title="JEMBER">
                                        </a>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <a target="_blank" href="https://lapor.go.id/instansi/pemerintah-kabupaten-jember">
                                            <img class="img-fluid" src="{{ asset('assets/images/link/lapor.png') }}" alt="lapor.go.id" title="lapor.go.id">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif
<!-- section-2 end -->

<!-- section-6 start -->
<section class="pt-5 " style="margin-top: 90px;">
    <div class="__bg_wave">
        <div class="container pt-5 pb-5 __bg_quotes_2">
            <div class="col-lg-6 mb-5 mt-5">
                <div class="position-relative" style="z-index: 2;">
                    <h1 style="color: #033808; font-weight: 700;">Quote of the Day </h1>
                </div>
                <div class="position-absolute" style="top: 0px;left: -22px;z-index: 1;">
                    <img style="width: 60px;height: auto;" src="./zohal/img/component/ellipse.svg" alt="" srcset="">
                </div>
                <div class="position-relative" style="color: #4F4F4F; padding: 30px 45px 45px 0px; background-color:rgba(255, 255, 255, 0.7) ; z-index: 0;">
                    <h3 style="font-weight: 700;">Indonesia tidak akan bercahaya karena obor besar di Jakarta, tetapi Indonesia baru akan
                        bercahaya karena lilin-lilin di desa.</h3>
                    <caption>- <b>Bung Hatta</b>, Proklamator</caption>
                </div>
            </div>
            <!-- <div class="col-lg-6">
    </div> -->
        </div>
    </div>
</section>
<!-- section-6 end -->

@if (count($galleries) >= 5)
<!-- section-7 start -->
    <section class="pb-5" style="background-image: url(./zohal/img/component/bg-section-7.svg);background-repeat: no-repeat; background-size: cover;">
        <h3 class="text-center font-40-ln-60" style="color: #033808;">Gallery</h3>
        <div class="container">
            <div class="photo-grid mt-3 ">
                @if ($galleries[0]->video_id)
                    <a class="rounded-lg card-gallery card-wide overlay" href="https://www.youtube.com/watch?v={{ $galleries[0]->video_id }}" data-fancybox="galleri" data-caption="{{ $galleries[0]->caption }}" style="background-image:url({{ $galleries[0]->gambar }})"></a>
                @else
                    <a class="rounded-lg card-gallery card-wide overlay" href="{{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[0]->gambar : url(Storage::url($galleries[0]->gambar)) }}" data-fancybox="galleri" data-caption="{{ $galleries[0]->caption }}" style="background-image:url({{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[0]->gambar : url(Storage::url($galleries[0]->gambar)) }})"></a>
                @endif
                @if ($galleries[1]->video_id)
                    <a class="rounded-lg card-gallery card-tall overlay" href="https://www.youtube.com/watch?v={{ $galleries[1]->video_id }}" data-fancybox="galleri" data-caption="{{ $galleries[1]->caption }}" style="background-image:url({{ $galleries[1]->gambar }})"></a>
                @else
                    <a class="rounded-lg card-gallery card-tall overlay" href="{{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[1]->gambar : url(Storage::url($galleries[1]->gambar)) }}" data-fancybox="galleri" data-caption="{{ $galleries[1]->caption }}" style="background-image:url({{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[1]->gambar : url(Storage::url($galleries[1]->gambar)) }})"></a>
                @endif

                @if ($galleries[2]->video_id)
                    <a class="rounded-lg card-gallery overlay" href="https://www.youtube.com/watch?v={{ $galleries[2]->video_id }}" data-fancybox="galleri" data-caption="{{ $galleries[2]->caption }}" style="background-image:url({{ $galleries[2]->gambar }})"></a>
                @else
                    <a class="rounded-lg card-gallery overlay" href="{{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[2]->gambar : url(Storage::url($galleries[2]->gambar)) }}" data-fancybox="galleri" data-caption="{{ $galleries[2]->caption }}" style="background-image:url({{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[2]->gambar : url(Storage::url($galleries[2]->gambar)) }})"></a>
                @endif

                @if ($galleries[3]->video_id)
                    <a class="rounded-lg card-gallery card-wide overlay" href="https://www.youtube.com/watch?v={{ $galleries[3]->video_id }}" data-fancybox="galleri" data-caption="{{ $galleries[3]->caption }}" style="background-image:url({{ $galleries[3]->gambar }})"></a>
                @else
                    <a class="rounded-lg card-gallery card-wide overlay" href="{{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[3]->gambar : url(Storage::url($galleries[3]->gambar)) }}" data-fancybox="galleri" data-caption="{{ $galleries[3]->caption }}" style="background-image:url({{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[3]->gambar : url(Storage::url($galleries[3]->gambar)) }})"></a>
                @endif

                @if ($galleries[4]->video_id)
                    <a class="rounded-lg card-gallery overlay" href="https://www.youtube.com/watch?v={{ $galleries[4]->video_id }}" data-fancybox="galleri" data-caption="{{ $galleries[4]->caption }}" style="background-image:url({{ $galleries[4]->gambar }})"></a>
                @else
                    <a class="rounded-lg card-gallery overlay" href="{{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[4]->gambar : url(Storage::url($galleries[4]->gambar)) }}" data-fancybox="galleri" data-caption="{{ $galleries[4]->caption }}" style="background-image:url({{ env('URL_FILE_UPLOAD_OTHER_SERVER') ? env('URL_FILE_UPLOAD_OTHER_SERVER'). '/' . $galleries[4]->gambar : url(Storage::url($galleries[4]->gambar)) }})"></a>
                @endif
            </div>
            <div class="text-center mt-5">
                <a href="{{ route("gallery") }}" class="btn btn-outline-secondary px-2">Lihat semua <i class="bi-arrow-right"></i></a>
            </div>
        </div>
    </section>
    <!-- section-7 end -->
@endif

<!-- section-8 start -->
<section class="__section_8">
    <div class="pb-5">
        <div class="py-4 px-lg-4 w-600">
            <h3 class="text-white sm-center">Kontak dan Saran</h3>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-1">
                    <i class="bi bi-geo-alt text-primary" style="font-size: 1.5rem !important;"></i>
                </div>
                <div class="col-11">
                    <p class="mb-0">
                        <b>Alamat :</b> {{ $informasi_umum->alamat }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <i class="bi bi-telephone text-primary" style="font-size: 1.5rem !important;"></i>
                </div>
                <div class="col-11">
                    <p class="mt-2 mb-0">
                        <b>Telepon :</b> <a href="tel:{{ $informasi_umum->telepon }}">{{ $informasi_umum->telepon }}</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <i class="bi bi-envelope text-primary" style="font-size: 1.5rem !important;"></i>
                </div>
                <div class="col-11">
                    <p class="mt-2 mb-0">
                        <b>E-mail :</b> <a href="mail:{{ $informasi_umum->email }}">{{ $informasi_umum->email }}</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <i class="bi bi-whatsapp text-primary" style="font-size: 1.5rem !important;"></i>
                </div>
                <div class="col-11">
                    <p class="mt-2 mb-0">
                        <b>WhatsApp :</b> <a href="https://wa.me/+62{{ $informasi_umum->whatsapp }}">{{ $informasi_umum->whatsapp ? '+62' . $informasi_umum->whatsapp : '' }}</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <i class="bi bi-globe text-primary" style="font-size: 1.5rem !important;"></i>
                </div>
                <div class="col-11">
                    <p class="mt-2 text-wrap overflow-auto">
                        <b>Website :</b> <a href="{{ $informasi_umum->website }}">{{ $informasi_umum->website }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="map">
        {!! $informasi_umum->link_maps !!}
    </div>
</section>
<!-- section-8 end -->
@endsection

@push('scripts')
<script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ url('') }}/assets/js/plugins/owl.carousel.min.js"></script>
<script src="{{ url('') }}/assets/js/plugins/slick.min.js"></script>
<script>
    $(document).ready(function () {
        $('#link-tekait').owlCarousel({
            loop:true,
            autoplay:true,
            autoplayTimeout:3000,
            smartSpeed:1000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:3
                }
            }
        });
    });
</script>
@endpush
