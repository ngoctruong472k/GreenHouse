@php
$logo = DB::table('photos')
    ->where('type', 'logo')
    ->first();
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';
$urlLogo = $protocol . $_SERVER['HTTP_HOST'] . '/public/upload/images/photo/thumb/' . $logo->photo;
@endphp
@extends('site.layout')
@section('SEO_title', $settings['SEO_TITLE'])
@section('SEO_keywords', $settings['SEO_KEYWORDS'])
@section('PHOTO', $urlLogo)
@if (isset($image->mimeType) && isset($image->width) && isset($image->height))
    @section('mimeType', $image->mimeType)
    @section('width', $image->width)
    @section('height', $image->height)
@endif
@section('SEO_description', $settings['SEO_DISCRIPTION'])
@section('content')
    <div class="content">

        <!-- Banner - menu -->
        {{-- silder --}}
        @include('site.inc.slide')
        <!-- content -->

        <!-- <div class="clears"></div>
                                                                                                    <div class="service-blocks">
                                                                                                        <div class="owl-carousel owl-theme">
                                                                                                            @foreach ($service as $key => $item)
    <div class="item">
                                                                                                                <div class="card" style="width: 18rem;">
                                                                                                                    <img class="card-img-top" src="{{ asset('public/upload/images/service/thumb/' . $item->photo) }}"
                                                                                                                        alt="{{ $item->title }}">
                                                                                                                    <div class="card-body">
                                                                                                                        <p class="card-title" style="text-transform: uppercase;"><a
                                                                                                                                href="/dich-vu/{{ $item->slug }}">{{ $item->title }}</a></p>
                                                                                                                        <p class="card-text">
                                                                                                                                                    @if (strlen($item->description) > 122)
    {{ substr($item->description, 0, 122) . '...' }}
@else
    {{ $item->description }}
    @endif
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
    @endforeach
                                                                                                        </div>
                                                                                                    </div> -->
        <div class="container home-sell">
            <h1 class="title-center-home">Bất động sản hot</h1>
            <div class="boder-img">
                {{-- <img src="{{ asset('public/site/images/HGH_border_bottom.png') }}" alt="img"> --}}
            </div>
            <div class="row service-box-truong">
               
                    @foreach ($service as $key => $item)
                        <div class="col col-md-4">
                            <div class="box-product">
                                <a href="">
                                    <img class="card-img-top"
                                        src="{{ asset('public/upload/images/service/thumb/' . $item->photo) }}"
                                        alt="{{ $item->title }}">
                                </a>
                                <p class="home-title"><a href="/dich-vu/{{ $item->slug }}">{{ $item->title }}</a>
                                </p>
                                <div class="box-price-bds">
                                    <img style="width: 25px;height: 25px; margin-right: 10px; margin-top: -6px;"
                                        src="{{ asset('public/site/images/house-money.png') }}">
                                    <span id="box-inner-price">85 tỉ</span>
                                    <span>-&nbsp;805m<sup>2</sup></span>
                                    <div class="date-post">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                                            xmlns="http://www.w3.org/2000/svg" class="clock-eight">
                                            <path
                                                d="M12,6a.99974.99974,0,0,0-1,1v4.38379L8.56934,12.60693a.99968.99968,0,1,0,.89843,1.78614l2.98145-1.5A.99874.99874,0,0,0,13,12V7A.99974.99974,0,0,0,12,6Zm0-4A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8.00917,8.00917,0,0,1,12,20Z" />
                                        </svg>
                                        29/03/2022
                                    </div>
                                </div>
                                <div class="box-time-bds" style="width: 100%; text-align: right; padding-top: 7px; ">
                                    <span>Biệt thự</span>
                                </div>
                                <div class="box-adress-bds"><span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                            class="map">
                                            <path
                                                d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                                        </svg>
                                        Thảo Điền, Quận 2</span></div>
                            </div>
                        </div>
                    @endforeach
    
                
            </div>
            <p class="read-more"><button class="next-xemthem" id="btn_read_more">Xem thêm
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="down">
                    <path
                        d="M169.4 278.6C175.6 284.9 183.8 288 192 288s16.38-3.125 22.62-9.375l160-160c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0L192 210.8L54.63 73.38c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L169.4 278.6zM329.4 265.4L192 402.8L54.63 265.4c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25l160 160C175.6 476.9 183.8 480 192 480s16.38-3.125 22.62-9.375l160-160c12.5-12.5 12.5-32.75 0-45.25S341.9 252.9 329.4 265.4z" />
                </svg></button>
        </p>

        </div>
        <div class="regional-estate">
            <div class="container">
                <div class="grid_duan">
                    @foreach ($service as $key => $item)
                        <div class="album_item">
                            <span>{{ $item->title }} </span>
                            <a href=""><img src="{{ asset('public/upload/images/service/thumb/' . $item->photo) }}"
                                    alt="CÔNG TY TNHH KIẾN TRÚC NHẬT AN PHÁT">
                            </a>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="land-blocks">
                <div class="container">
                    <div class="row partner">
                        <div class="owl-carousel owl-theme">
                            @foreach ($service as $key => $item)
                                <div class="item">
                                    <div class="col-md-4 partner-option col-6 img-flucol-6">
                                        <a href="#">{{ $item->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="box-center mt-5">
                <div class="row">
                    <div class="col-md-6 box-logo">
                        <div class="box-tintuc-head-mt">Tin tức & sự kiện</div>
                        <div class="bor"></div>
                        <div class="box-tintuc-ct-mt">
                            <div class="row">
                                <div class="col-md-5 left-news">
                                    <a href="">
                                        <img class="card-img-top"
                                            src="{{ asset('public/upload/images/news/thumb/' . $news[0]->photo) }}"
                                            alt="{{ $news[0]->title }}"></a>
                                    <a href="">
                                        <p>{{ $news[0]->title }}</p>
                                    </a>
                                    <p>{{ substr($news[0]->description, 0, 200) . '...' }}</p>
                                </div>
                                <div class="col-md-7">
                                    <ul id="scroller">
                                        @foreach ($news as $item)
                                            <li>
                                                <div class="border-content">
                                                    <div class="img-news">
                                                        <a href="/tin-tuc/{{ $item->slug }}"><img
                                                                src="public/upload/images/news/thumb/{{ $item->photo }}"
                                                                alt="{{ $item->title }}"></a>
                                                    </div>
                                                    <div class="text-news">
                                                        <h4 class="title-news">
                                                            <a
                                                                href="/tin-tuc/{{ $item->slug }}">{{ $item->title }}</a>
                                                        </h4>
                                                        <p class="des-news">
                                                            {{ substr($item->description, 0, 100) . '...' }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 box-logo">
                        <div class="box-tintuc-head-mt">Video clips</div>
                        <div class="bor"></div>
                        <div class="row video-clip-blocks box-tintuc-ct-mt">
                            <div class="col-md-12">
                                <iframe style="width: 100%;"
                                    src="https://www.youtube.com/embed/{{ $video[0]->link_youtube }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="partner-blocks">
            <div class="container">
                <div class="row partner">
                    <div class="owl-carousel owl-theme">
                        @foreach ($partner as $key => $item)
                            <div class="item">
                                <div class="col-md-4 partner-option col-6 img-flucol-6">
                                    <a href="#"><img class="eeee"
                                            src="{{ asset('public/upload/images/photo/thumb/' . $item->photo) }}"
                                            alt="GIÁ CẢ CẠNH TRANH"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="banner-criteria">
                                                                                                        <div class="container">
                                                                                                            <h2 class="distance">{{ __('lang.criteria') }}</h2>
                                                                                                            <p class="discription">{{ __('lang.title_criteria') }}</p>
                                                                                                            <div class="row criteria-blocks">
                                                                                                                <div class="owl-carousel owl-theme">
                                                                                                                    @foreach ($standard as $key => $item)
    <div class="item">
                                                                                                                        <div class="col-md-4 criteria-option col-6 img-flucol-6">
                                                                                                                            <div class="hinh_chonct">
                                                                                                                                <a href="#"><img class="eeee"
                                                                                                                                        src="{{ asset('public/upload/images/standard/thumb/' . $item->photo) }}"
                                                                                                                                        alt="GIÁ CẢ CẠNH TRANH"></a>
                                                                                                                            </div>
                                                                                                                            <div class="wrapper">
                                                                                                                                <h4 class="third after">{{ $item->title }}</h4>
                                                                                                                            </div>
                                                                                                                            <p class="standard-content">{{ $item->description }}</p>
                                                                                                                        </div>
                                                                                                                    </div>
    @endforeach
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div> -->

        <!-- <div class="banner-criteria banner-imgall">
                                                                                                    <div class="container">
                                                                                                        <h2 class="distance">{{ __('lang.album_hinhanh') }}</h2>
                                                                                                        <div class="album-hinh-anh" style="margin-top: 35px;">
                                                                                                            <div class="owl-carousel owl-theme">
                                                                                                                @foreach ($album as $item)
    <div class="item">
                                                                                                                    <div class="col-md-3 criteria-option col-6 img-flucol-6">
                                                                                                                        <div class="img_all">
                                                                                                                            <img class="eeee" src="{{ asset('public/upload/images/photo/thumb/' . $item->photo) }}"
                                                                                                                                alt="{{ asset('public/upload/images/photo/thumb/' . $item->photo) }}">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
    @endforeach
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> -->
        <!-- <div id="bando_footer">
                                                                                                    {!! $settings['MAP_IFRAME'] !!}
                                                                                                </div> -->

        <!-- Modal -->
        <div class="modal fade" id="modal_map" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Bản đồ</h5>
                        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script_site')
        <script>
            var page = 1;
            $('#btn_read_more').click(function() {
                var truong_aiu = $('.service-box-truong');
                page = page + 1;
                console.log(page);
                $.ajax({
                    url: "{{ route('get.read.more') }}",
                    type: "GET",
                    data: {
                        page: page
                    },
                    success: function(data) {
                        truong_aiu.append(data);
                    }
                });
            });

            $("#btn_send").click(function() {
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data_form = $("#form_contact").serialize();
                var name = document.getElementById('ten');
                var mail = document.getElementById('email1');
                var content = document.getElementById('noidung');
                var phone = document.getElementById('dienthoai');


                $.ajax({
                    url: "{{ route('post.page.dang.ky') }}",
                    type: "POST",
                    data: "_token=" + _token + "&" + data_form,
                    beforeSend: function() {
                        $(".error_name").hide();
                        $(".error_phone").hide();
                        $(".error_email").hide();
                        $(".error_content").hide();
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.status == 1) {
                            swal("Sucessfuly, Thank you!", "We're will contact soon!",
                                "success").then((value) => {
                                if (value) {
                                    name.value = "";
                                    mail.value = "";
                                    content.value = "";
                                    phone.value = "";
                                }
                                if (value == null) {
                                    name.value = "";
                                    mail.value = "";
                                    content.value = "";
                                    phone.value = "";
                                }
                            });
                        } else {
                            data.error.name != undefined ? $(".error_name").html(
                                data.error.name).show() : "";
                            data.error.email != undefined ? $(".error_email").html(data.error
                                .email).show() : "";

                            data.error.phone != undefined ? $(".error_sdt").html(data.error
                                .phone).show() : "";

                            data.error.content != undefined ? $(".error_content").html(data
                                .error
                                .content).show() : "";
                        }
                    },
                });
            })
            $('.video-clip-blocks .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });

            $('.partner-blocks .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 4
                    },
                    1000: {
                        items: 6
                    }
                }
            });

            $('.album-hinh-anh .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                dots: false,
                nav: false,
                autoplay: true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });

            $('.doitac-tintuc .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 4000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });

            $('.land-blocks .owl-carousel').owlCarousel({
                items: 4,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 1000,
                autoplayHoverPause: true
            });
        </script>
    @endpush
