<?php
session_start();
use Carbon\Carbon;
function getIPAddress()
{
    //whether ip is from the share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


$time_out = 180; //giay
$ip = getIPAddress();
$id_online = session_id();
$check_id = DB::table('user_online')->where('id', $id_online)->get();

//dem truy cap
if(!session()->has('id_counter')){
    $created_counter =  DB::table('counter')->insert([['ip' => $ip, 'created_at' => Carbon::now()]]);
    session()->put('id_counter', $id_online);
}

if (count($check_id) != 0) {
    DB::table('user_online')->where('id', $id_online)->update(['last_visit' => time(),'ip'=> $ip]);
} else {
    DB::table('user_online')->insert([['id' => $id_online, 'ip' => $ip, 'last_visit' => time()]]);
}

$all_user_online = DB::table('user_online')->get();
foreach ($all_user_online as $key => $value) {
    $last_visit = $value->last_visit;
    $time = time() - $last_visit;
    if($time > $time_out){
        $delete_user_online =  DB::table('user_online')->where('id',$value->id)->delete();
    }
}

//đếm truy cập tuần
$day = date('d');
$month = date('n');
$year = date('Y');
$daystart = mktime(0, 0, 0, $month, $day, $year);
// weekstart
$weekday = date('w');
$weekday--;

if ($weekday < 0) {
    $weekday = 7;
}
$weekday = $weekday * 24 * 60 * 60;
$weekstart = $daystart - $weekday;
$format_weekstart =  date('Y-m-d H:i:s',$weekstart);

$online_week = DB::table('counter')->whereDate('created_at', '>=',$format_weekstart)->count() -1;

//Đếm truy cập trong tháng
$myMonth = date('m');
$myYear =  date('Y');
$countMonth = DB::table('counter')->whereMonth('created_at', $myMonth)->whereYear('created_at', $myYear)->count();

$user_online = count($all_user_online);


// tong so truy cap
$counter = DB::table('counter')->count();
?>
<div class="blocks-contact">
    <div class="container">

    </div>
</div>
<footer>

    {{-- <div class="bg-black"></div> --}}
    <a class="btn-effect btn-contact-block" href="tel:{{ $settings['PHONE'] }}">
        <div class="child-nth-1 animate__animated animate__zoomIn"></div>
        <div class="child-nth-2 animate__animated animate__pulse"></div>
        <p class="btn-img">
            <img src="{{ asset('public/site/images/hl.png') }}" alt="">
        </p>
    </a>
    <a class="btn-effect btn-contact-block" href="https://zalo.me/{{ $settings['ZALO'] }}">
        <div class="child-nth-1 animate__animated animate__zoomIn"></div>
        <div class="child-nth-2 animate__animated animate__pulse"></div>
        <p class="btn-img">
            <img src="{{ asset('public/site/images/zl.png') }}" alt="">
        </p>
    </a>

    <div class="container middle-footer">
        <div class="row">
            <div class="col-md-4 footer-item">
                <h4 class="footer-intro">{{__('lang.company_introduction')}}</h4>
                <h2 class="title-company">Thiên sơn Việt Nam</h2>
                <div class="contact-footer-block">
                    <div class="list-icon-contact">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-contact">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                        </svg>
                        <span>{{$settings['ADDRESS']}}</span>

                    </div>

                    <div class="list-icon-contact">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-contact">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z" />
                        </svg>
                        <a href="tel:{{$settings['HOTLINE']}}">{{$settings['HOTLINE']}}</a>&nbsp;-&nbsp;<a
                            href="tel:{{$settings['DTBAN'] }}">{{$settings['DTBAN']}}</a>
                    </div>

                    <div class="list-icon-contact">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-contact">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z" />
                        </svg>
                        <a
                            href="http://yellowpages.vnn.vn/lgs/1187691384/cong-ty-tnhh-mtv-dich-vu-bao-ve-nhat-khanh-phat.html#Gửi email đến công ty">
                            {{$settings['EMAIL']}}</a>
                    </div>


                    <div class="list-icon-contact">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-contact">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM57.71 192.1L67.07 209.4C75.36 223.9 88.99 234.6 105.1 239.2L162.1 255.7C180.2 260.6 192 276.3 192 294.2V334.1C192 345.1 198.2 355.1 208 359.1C217.8 364.9 224 374.9 224 385.9V424.9C224 440.5 238.9 451.7 253.9 447.4C270.1 442.8 282.5 429.1 286.6 413.7L289.4 402.5C293.6 385.6 304.6 371.1 319.7 362.4L327.8 357.8C342.8 349.3 352 333.4 352 316.1V307.9C352 295.1 346.9 282.9 337.9 273.9L334.1 270.1C325.1 261.1 312.8 255.1 300.1 255.1H256.1C245.9 255.1 234.9 253.1 225.2 247.6L190.7 227.8C186.4 225.4 183.1 221.4 181.6 216.7C178.4 207.1 182.7 196.7 191.7 192.1L197.7 189.2C204.3 185.9 211.9 185.3 218.1 187.7L242.2 195.4C250.3 198.1 259.3 195 264.1 187.9C268.8 180.8 268.3 171.5 262.9 165L249.3 148.8C239.3 136.8 239.4 119.3 249.6 107.5L265.3 89.12C274.1 78.85 275.5 64.16 268.8 52.42L266.4 48.26C262.1 48.09 259.5 48 256 48C163.1 48 84.4 108.9 57.71 192.1L57.71 192.1zM437.6 154.5L412 164.8C396.3 171.1 388.2 188.5 393.5 204.6L410.4 255.3C413.9 265.7 422.4 273.6 433 276.3L462.2 283.5C463.4 274.5 464 265.3 464 256C464 219.2 454.4 184.6 437.6 154.5H437.6z" />
                        </svg>
                        <a class="a_link" href="{{$settings['WEBSITE']}}" rel="nofollow"
                            target="_blank">{{$settings['WEBSITE']}} &nbsp;</a>
                        <a class="a_link" href="https://baovenhatkhanhphat.com/" rel="nofollow"
                            target="_blank">&nbsp;</a>
                    </div>
                </div>
                <ul class="contact-icon-block">
                    @foreach ($social_footer as $item)
                    <li><a href="{{ $item->link }}">
                            <img src="{{ asset('public/upload/images/photo/large/' . $item->photo) }}" alt="">
                        </a>
                    </li>
                    @endforeach
                    <img class="Trade" src="{{ asset('public/upload/images/photo/large/trade.png') }}" alt="">
                </ul>
            </div>
            <div class="col-md-4 Policy footer-item">
                <h4>Đăng ký nhận tin</h4>
                <form class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 form-contact validation-contact"
                    id="form_contact">
                    {{-- <div class="alert alert-danger" role="alert">
                            
                        </div> --}}
                    @csrf
                    <div class="row">
                        <div class="input-contact col-sm-12">
                            <input type="text" class="form-control" id="ten" name="name" value="{{ old('name') }}"
                                placeholder="{{ __('lang.fullname') }}*" required>
                            <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                            <p class="error_name mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                        </div>
                        <div class="input-contact col-sm-12">
                            <input type="number" class="form-control" id="dienthoai" name="phone"
                                placeholder="{{ __('lang.phone_number') }}*" required value="{{ old('phone') }}">
                            <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
                            <p class="error_sdt mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-contact col-sm-12">
                            <input type="email" value="{{ old('email') }}" class="form-control" id="email1" name="email"
                                placeholder="Email*" required>
                            <div class="invalid-feedback">Vui lòng nhập địa chỉ email</div>
                            <p class="error_email mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                        </div>
                    </div>
                    <div class="input-contact">
                        <textarea rows="4" class="form-control-te" id="noidung" name="content"
                            placeholder="{{ __('lang.content') }}*" required>{{ old('content') }}</textarea>
                        <div class="invalid-feedback">Vui lòng nhập nội dung</div>
                        <p class="error_content mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                    </div>
                    <input type="button" class="btn btn-danger" name="submit-contact" id="btn_send"
                        value="{{ __('lang.btnSubmit') }}">
                </form>

            </div>

            <div class="col-md-4 footer-item">
                <h4>Fanpage</h4>
                <p class="map">
                <div class="fb-page" data-href="{{$settings['FANPAGE']}}" data-tabs="timeline" data-width=""
                    data-height="300" data-small-header="false" data-adapt-container-width="true"
                    data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="{{$settings['FANPAGE']}}" class="fb-xfbml-parse-ignore"><a
                            href="{{$settings['FANPAGE']}}"></a></blockquote>
                </div>

                </p>

            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container ">
            <div class="copy-right">
                <div class="wapper">
                    <div class="cop-l">© Copyright 2021 company name, All rights reserved, Design by SotaGroup
                    </div>
                    <div class="cop-r"> online: <span>{{$user_online}}</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;Tuần:
                        <span>{{$online_week}}</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;Tháng:
                        <span>{{$countMonth}}</span>
                        &nbsp;&nbsp;|&nbsp;&nbsp;Tổng:
                        <span>{{$counter}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>