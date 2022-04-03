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
    <div class="container middle-footer">
        <div class="row">
            <div class="col-md-4 Policy footer-item">
                <h4>Nhận tư vấn</h4>
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
                    <div class="captcha" style="display: flex;">
                        <div class="input-contact" style="padding-right: 10px">
                            <input type="text" class="form-control" id="captcha" value="" name="captcha"
                                placeholder="Captcha*" required>
                            <p class="error_captcha mt-1 mb-0" style="color:#EF8D21;display:none;"></p>
                        </div>
                        <div class="img-captcha">
                            <img width="140" height="34" id="captcha_ne" src="/captcha" alt="Captcha" title="Captcha">
                        </div>
                        <div class="reset-captcha" style="padding-top: 5px; padding-left: 5px">
                            <img src="{{ asset('public/site/images/refresh.png') }}" alt="refresh captcha"
                                title="Refresh captcha">
                        </div>
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
            <div class="col-md-4 footer-item">
                <h4 class="footer-intro">Giới thiệu công ty</h4>
                {!! $footer->content !!}
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container ">
            <div class="copy-right">
                <div class="wapper">
                    <div class="cop-l">© Copyright 2022 company name, All rights reserved, Design by SotaGroup
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