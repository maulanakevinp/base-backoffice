@extends('layouts.master')
@section('title', $title)

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/select2.min.css') }}">
@endsection

@section('content')
    @include('layouts.components.alert')
    <!-- profile header start -->
    <div class="user-profile user-card mb-4">
        <div class="card-header border-0 p-0 pb-0" style="border-radius: 0;background-image: url({{ asset('assets/images/profile/cover.jpg') }}); height: 300px; background-repeat: no-repeat; background-size: cover; height: 300px;"></div>
        <div class="card-body py-0">
            <div class="user-about-block m-0">
                <div class="row">
                    <div class="col-md-4 text-center mt-n5">
                        <div class="change-profile text-center">
                            <div class="dropdown w-auto d-inline-block">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="profile-dp">
                                        <div class="position-relative d-inline-block">
                                            <img id="img-avatar" class="img-radius img-fluid wid-100" src="{{ asset(Storage::url($data_pribadi->avatar)) }}" alt="User image">
                                        </div>
                                        <div class="overlay">
                                            <span>change</span>
                                        </div>
                                    </div>
                                    <div class="certificated-badge">
                                        <i class="fas fa-certificate text-c-blue bg-icon"></i>
                                        <i class="fas fa-check front-icon text-white"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu">
                                    <a id="btn-ganti-avatar" class="dropdown-item" href="#"><i class="feather icon-upload-cloud mr-2"></i>upload new</a>
                                    <a class="dropdown-item" href="{{ asset(Storage::url($data_pribadi->avatar)) }}" data-fancybox><i class="feather icon-image mr-2"></i>preview</a>
                                    <a id="btn-hapus-avatar" class="dropdown-item" href="#"><i class="feather icon-trash-2 mr-2"></i>remove</a>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="avatar" id="input-avatar" style="display: none">
                        <h5 class="mb-1">{{ $data_pribadi->nama }}</h5>
                    </div>
                    <div class="col-md-8 mt-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="clearfix"></div>
                                @if ($data_pribadi->user)
                                    <a href="mailto:{{ $data_pribadi->user->email }}" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i>{{ $data_pribadi->user->email }}</a>
                                @endif
                                <div class="clearfix"></div>
                                <a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary">{!! $data_pribadi->detail_kontak->telepon_seluler ? '<i class="feather icon-phone mr-2 f-18"></i> ' . $data_pribadi->detail_kontak->telepon_seluler : '' !!}</a>
                            </div>
                            <div class="col-md-6">
                                <div class="media">
                                    @if ($data_pribadi->detail_kontak->alamat)
                                        <i class="feather icon-map-pin mr-2 mt-1 f-18"></i>
                                    @endif
                                    <div class="media-body">
                                        <p class="mb-0 text-muted">{{ $data_pribadi->detail_kontak->alamat ?? '' }}</p>
                                        <p class="mb-0 text-muted">{{ $data_pribadi->detail_kontak->kota ?? '' }}{{ $data_pribadi->detail_kontak->provinsi ? ', ' .  $data_pribadi->detail_kontak->provinsi : '' }}{{ $data_pribadi->detail_kontak->kode_pos ? ', ' . $data_pribadi->detail_kontak->kode_pos : ''  }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs profile-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ request('tab') == 'data-pribadi' ? 'active' : (request('tab') ? '' : 'active') }}" href="{{ URL::current() }}?tab=data-pribadi"><i class="fas fa-address-card"></i> Data Pribadi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('tab') == 'kontak' ? 'active' : '' }}" href="{{ URL::current() }}?tab=kontak"><i class="fas fa-address-book"></i> Detail Kontak</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- profile header end -->

    <!-- profile body start -->
    <div class="row">
        <div class="col">
            @switch(request('tab'))
                @case('kontak')
                    @include('user.kontak',['data_pribadi' => $data_pribadi])
                    @break
                @default
                    @include('user.data-pribadi',['data_pribadi' => $data_pribadi])
                    @break
            @endswitch
        </div>
    </div>
    <!-- profile body end -->
@endsection

@push('scripts')
<script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.form-select').select2({
            placeholder: 'Pilih',
            allowClear: true,
            width: '100%'
        });

        $('[name="jawab[]"]').click(function () {
            const jawaban = $(this).parent().siblings('.jawaban').val();
            if ($(this).prop('checked') == true) {
                $(this).parent().siblings('.jawaban').val(jawaban + $(this).val() + ',');
            } else {
                $(this).parent().siblings('.jawaban').val(jawaban.replace($(this).val() + ",", ''));
            }
        });

        $('#btn-hapus-avatar').on('click', function (event) {
            event.preventDefault();
            let formData = new FormData();
            $.ajax({
                url: "{{ route('update-avatar', $data_pribadi->id) }}",
                method: 'patch',
                data: {
                    '_token' : CSRF,
                    'hapus'  : '1'
                },
                beforeSend: function () {
                    $('#img-avatar').attr('src', "{{ url('/storage/loading.gif') }}");
                },
                success: function (response) {
                    if (response.success) {
                        alertSuccess(response.message);
                        setTimeout(() => {
                            $(".notifikasi").html('');
                        }, 3000);
                        location.reload();
                    }
                }
            });
        });

        $('#btn-ganti-avatar').on('click', function (event) {
            event.preventDefault();
            $('#input-avatar').click();
        });

        $('#input-avatar').on('change', function () {
            if (this.files && this.files[0]) {
                let formData = new FormData();
                let oFReader = new FileReader();
                formData.append("avatar", this.files[0]);
                formData.append("_method", "patch");
                formData.append("_token", "{{ csrf_token() }}");
                oFReader.readAsDataURL(this.files[0]);

                $.ajax({
                    url: "{{ route('update-avatar', $data_pribadi->id) }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#img-avatar').attr('src', "{{ url('/storage/loading.gif') }}");
                    },
                    success: function (data) {
                        if (data.error) {
                            $('#img-avatar').attr('src', $("#img-avatar").attr('alt'));
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        });
    });
</script>
@endpush
