<?php

(!defined('THEMEPATH')) ? exit : '';

define('_theme_name', 'dashboard_layout');
define('_theme_folder', basename(__DIR__));

require dirname(__FILE__) . '/css.php';
require dirname(__FILE__) . '/js.php';

class dashboard_layout extends dashboard_template
{

    protected static $data = [];

    public static function load_here($data = [])
    {
?>
        <div class="container-fluid">
            <?php self::header($data) ?>
            <?php self::body($data) ?>
        </div>
    <?php
        self::$data = $data;

        self::_data_json();
        self::alert();
        self::_content();
        self::custom_script();
    }

    public static function header($data = [])
    {
        $base_url = SITE . '://' . HOSTNAME . '/' . URL . '/theme/' . _theme_folder . '/assets/';
        $base_url = $base_url .  "image/";

        $day = date('N');
        $day = self::indo_day($day);
        $date = date('d');
        $month = date('m');
        $month = self::short_month($month);
        $year = date('Y');
    ?>
        <div class="head-section">
            <div class="row">
                <div class="col-xs-6">
                    <?= isset($data['title']) ? $data['title'] : '' ?>
                    <div>
                        <img width="400px" src="<?= $base_url ?>icon/ic-sobad-group.png" alt="">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="bg-gradient-purple radius-md pl-sm pr-sm">
                        <img width="411px" class="bg-time" src="<?= $base_url ?>background/bg-time.png" alt="">
                        <div class="row">
                            <div class="col-xs-4 p-xs">
                                <div class="radius-md bg-light purple pt-xs pb-xs text-center">
                                    <h6 class="semi-bold"><?= $day ?></h6>
                                    <h2 class="bold"><?= $date ?></h2>
                                    <h6 class="semi-bold"><?= $month . ' ' . $year ?></h6>
                                </div>
                            </div>
                            <div class="col-xs-8 light">
                                <div class="flex align-center justify-center" style="height: 138px;">
                                    <h1 id="hour" class="bold">-</h1>
                                    <h1 id="sparator" class="bold" style="padding-bottom: 6px;">:</h1>
                                    <h1 id="minute" class="bold">-</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    public static function body($data)
    {
        $class = 'dashboard_template';
        $function =  $data['func'];
    ?>
        <div class="content-section">
            <?php
            if (!is_callable(array('dashboard_template', $function))) {
                die(_error::_alert_db("function " . $function . " does not exist !!!"));
            } else {
                $class::{$function}($data['data']);
            }
            ?>
        </div>
    <?php
    }

    public static function alert()
    {
        $base_url = SITE . '://' . HOSTNAME . '/' . URL . '/theme/' . _theme_folder . '/assets/';
        $base_url = $base_url .  "image/";
    ?>
        <div id="alert_global" class="allert-overlay">
            <div class="quest-allert absolute">
                <div class="quest-allert-header radius-top-md ">
                    <img class="absolute" width="833px" src="<?= $base_url ?>background/bg-allert.png" alt="">
                    <div class="row flex align-center justify-center m-0">
                        <div class="col-xs-6 w-20 p-0">
                            <img id="alert_img_employ" width="100%" src="" alt="">
                        </div>
                        <div class="col-xs-6 w-20 p-0">
                            <h4 id="alert_name_employe" class="light space"></h4>
                            <h6 id="alert_divisi_employe" class="light space"></h6>
                        </div>
                    </div>
                    <button id="close_alert" class="btn-close" onclick="close_alert()"><img src="<?= $base_url ?>icon/ic-x.png" alt=""></button>
                </div>
                <div class="quest-allert-body radius-bottom-md grid align-center">
                    <div class="col-xs-12 text-center ">
                        <h2 id="alert_title" class="bold"></h2>
                        <h6 id="alert_sub_title" class="semi-bold space dark-grey"></h6>
                        <div id="alert_button" class="flex align-center justify-center">

                            <a href="javascript:void(0)" onclick="go_out_city(this)" id="out_city" class="change-time">
                                <div class="flex align-center">
                                    <img class="icon-btn-alert" width="23px" src="<?= $base_url ?>icon/ic-plane.png" alt="">
                                    <p class="space">Luar Kota</p>
                                </div>
                            </a>

                            <a href="javascript:void(0)" onclick="out(this)" id="out" class="change-time">
                                <div class="flex align-center">
                                    <img class="icon-btn-alert" width="17px" src="<?= $base_url ?>icon/ic-out.png" alt="">
                                    <p class="space">Ke Luar</p>
                                </div>
                            </a>

                            <a href="javascript:void(0)" onclick="workout(this)" id="workout" class="change-time">
                                <div class="flex align-center">
                                    <img class="icon-btn-alert" width="17px" src="<?= $base_url ?>icon/ic-workout.png" alt="">
                                    <p class="space">Tugas Luar</p>
                                </div>
                            </a>

                            <a href="javascript:void(0)" onclick="change_time(this)" id="change_time" class="change-time">
                                <div class="flex align-center">
                                    <img class="icon-btn-alert" width="23px" src="<?= $base_url ?>icon/ic-time.png" alt=""> Ya,
                                    <p class="space">Ganti Jam</p>
                                </div>
                            </a>

                            <a href="javascript:void(0)" onclick="permit(this)" id="permit" class="change-time">
                                <div class="flex align-center">
                                    <img class="icon-btn-alert" width="13px" src="<?= $base_url ?>icon/ic-permit.png" alt="">
                                    <p class="space">Izin</p>
                                </div>
                            </a>


                            <a href="javascript:void(0)" onclick="sick_permit(this)" id="sick_permit" class="change-time">
                                <div class="flex align-center">
                                    <img class="icon-btn-alert" width="17px" src="<?= $base_url ?>icon/ic-sick.png" alt="">
                                    <p class="space">Sakit</p>
                                </div>
                            </a>

                            <a href="javascript:void(0)" onclick="home_permit(this)" id="home_permit" class="change-time">
                                <div class="flex align-center">
                                    <img class="icon-btn-alert" width="13px" src="<?= $base_url ?>icon/ic-home.png" alt="">
                                    <p class="space">Pulang</p>
                                </div>
                            </a>

                            <a href="javascript:void(0)" onclick="permit_change_time(this)" id="permit_change_time" class="change-time">
                                <div class="flex align-center">
                                    <img class="icon-btn-alert" width="20px" src="<?= $base_url ?>icon/ic-change-time.png" alt="">
                                    <p class="space">Ganti Jam</p>
                                </div>
                            </a>

                            <a href="javascript:void(0)" onclick="cuti(this)" id="cuti" class="change-time">
                                <div class="flex align-center">
                                    <img class="icon-btn-alert" width="16px" src="<?= $base_url ?>icon/ic-cuti.png" alt="">
                                    <p class="space">Cuti</p>
                                </div>
                            </a>
                        </div>
                        <input type="hidden" id="alert_data" value="">
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="scan_alert">
            <div id="warning_scan" class="alert sasi-alert-warning bg-warning radius-md bold  flex align-center" role="alert" style="font-size:larger; display:none;"></div>
            <div id="success_scan" class="alert sasi-alert-success bg-success radius-md bold flex align-center" role="alert" style="font-size:larger; display:none;"></div>
            <div id="danger_scan" class="alert sasi-alert-danger bg-danger radius-md bold  flex align-center" role="alert" style="font-size:larger; display:none;"></div>
        </div>
    <?php
    }

    public static function custom_script()
    {
        $script = isset(self::$data['script']) ? self::$data['script'] : '';
        echo $script;
    }



    public static function _data_json()
    {
        $data = self::$data['args'];

        $notwork_data = json_encode($data['notwork_data'], JSON_FORCE_OBJECT);
        $work_data = json_encode($data['work_data'], JSON_FORCE_OBJECT);
        $outcity_data = json_encode($data['outcity_data'], JSON_FORCE_OBJECT);
        $workout_data = json_encode($data['workout_data'], JSON_FORCE_OBJECT);
        $tugas_data = json_encode($data['tugas_data'], JSON_FORCE_OBJECT);
        $permit_data = json_encode($data['permit_data'], JSON_FORCE_OBJECT);
        $cuti_data = json_encode($data['cuti_data'], JSON_FORCE_OBJECT);
        $sick_data = json_encode($data['sick_data'], JSON_FORCE_OBJECT);
        $birthday_data = json_encode($data['birthday_data'], JSON_FORCE_OBJECT);
        $announcement_data = json_encode($data['announcement_data'], JSON_FORCE_OBJECT);

        $count_employe = json_encode($data['count_employes']);
        $count_internship = $data['count_internship'] == null ? 0 : $data['count_internship'];
        $count_workout = $data['count_tugas'];

    ?>
        <script>
            var notwork_data = <?= $notwork_data ?>;
            var work_data = <?= $work_data ?>;
            var outcity_data = <?= $outcity_data ?>;
            var tugas_data = <?= $tugas_data ?>;
            var workout_data = <?= $workout_data ?>;
            var permit_data = <?= $permit_data ?>;
            var cuti_data = <?= $cuti_data ?>;
            var sick_data = <?= $sick_data ?>;
            var birthday_data = <?= $birthday_data ?>;
            var announcement_data = <?= $announcement_data ?>;

            var count_employe = <?= $count_employe ?>;
            var count_internship = <?= $count_internship; ?>;
            var count_workout = <?= $count_workout; ?>;
        </script>
    <?php
    }

    public static function _content()
    {
        $base_url = SITE . '://' . HOSTNAME . '/' . URL . '/theme/' . _theme_folder . '/assets/';
    ?>
        <script>
            var url = "https://s.soloabadi.com/system-absen/asset/img/user/";

            var base_url = "<?= $base_url ?>"

            function load_content() {
                notwork_content();
                work_content();
                workout_content();
                permit_content();
                cuti_content();
                sick_content();
                dom_count_team();
                birthday_now_content();
                birthday_next_content();
                announcement_content();

                dom_ammount_work();
                dom_ammount_sickpermit();
                dom_ammount_outcity();
                dom_ammount_permit();
                dom_ammount_cuti();
                dom_ammount_employe();
                dom_ammount_internship();
                dom_ammount_workout();

                refreshAt(19, 32, 00);
            }

            function notwork_content() {
                var html = '';
                $.each(notwork_data, function(key, val) {
                    $(".footer-carousel").append(notwork_html(key, val));
                });
            }

            function notwork_html(key, val) {
                name = val.name;
                const nickname = name.split(" ");
                var html = '';
                html += '<div id="' + key + '-notwork" class="' + key + '-notwork col-xs-2 space">'
                html += ' <div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="100%" height="100%" src="' + url + val.image + '" alt="">'
                html += '</div>'
                html += '<div class="space text-center">'
                html += ' <span class="light">' + nickname[0] + '</span>'
                html += '</div>'
                html += '</div>'

                return html;
            }

            function work_content() {
                $.each(work_data, function(key, val) {
                    if (val.group == val.group) {
                        $("#" + val.group + "").append(work_html(key, val));
                    }
                });
            }

            function work_html(key, data) {
                name = data.name;
                const nickname = name.split(" ");
                if (data.exclude == 1) {
                    var time_html = '';
                } else {
                    if (data.punish == '0') {
                        var time_html = '<div class="text-small black">' + data.time + '</div>'
                    } else {
                        var time_html = '<div class="text-small red">' + data.time + '</div>'
                    }
                }
                var html = '';
                html += '<div id="' + key + '-work" class="' + key + '-work col-xs-4 space">'
                html += ' <div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="48px" height="48px" src="' + url + data.image + '" alt="">'
                html += '</div>'
                html += '<div class="space text-center">'
                html += ' <span class="black">' + nickname[0] + '</span>'
                html += time_html
                html += '</div>'
                html += '</div>'
                return html;
            }

            function permit_content() {
                $.each(permit_data, function(key, val) {
                    $("#permit_content").append(permit_html(key, val));
                });
            }

            function permit_html(key, data) {
                name = data.name;
                const nickname = name.split(" ");
                var html = '';
                html += '<div id="' + key + '-permit" class="' + key + '-permit col-xs-6 w-20 space">'
                html += '<div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="85%"src="' + url + data.image + '">'
                html += ' </div>'
                html += '<div class="text-center">'
                html += '<span class="black">' + nickname[0] + '</span>'
                html += ' </div>'
                html += ' </div>'
                return html;
            }

            function cuti_content() {
                $.each(cuti_data, function(key, val) {
                    $("#cuti_content").append(cuti_html(key, val));
                });
            }

            function cuti_html(key, data) {
                name = data.name;
                const nickname = name.split(" ");
                var html = '';
                html += '<div id="' + key + '-permit" class="' + key + '-permit col-xs-6 w-20 space">'
                html += '<div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="85%" src="' + url + data.image + '">'
                html += ' </div>'
                html += '<div class="text-center">'
                html += '<span class="black">' + nickname[0] + '</span>'
                html += ' </div>'
                html += ' </div>'
                return html;
            }

            function workout_content() {
                $.each(workout_data, function(key, val) {
                    $("#workout_content").append(workout_html(key, val));
                });
            }

            function workout_html(key, data) {
                name = data.name;
                const nickname = name.split(" ");
                var html = '';
                html += '<div id="' + key + '-permit" class="' + key + '-permit col-xs-6 w-20 space">'
                html += '<div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="90%"src="' + url + data.image + '">'
                html += ' </div>'
                html += '<div class="text-center">'
                html += '<span class="black">' + nickname[0] + '</span>'
                html += ' </div>'
                html += ' </div>'
                return html;
            }

            function sick_content() {
                $.each(sick_data, function(key, val) {
                    $("#sick_content").append(sick_html(key, val));
                });
            }

            function sick_html(key, data) {
                name = data.name;
                const nickname = name.split(" ");
                var html = '';
                html += '<div id="' + key + '-permit" class="' + key + '-permit col-xs-6  space">'
                html += '<div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="90%" src="' + url + data.image + '">'
                html += ' </div>'
                html += '<div class="text-center">'
                html += '<span class="black">' + nickname[0] + '</span>'
                html += ' </div>'
                html += ' </div>'
                return html;
            }

            function birthday_now_content() {
                $('#announcement-title').html('Birthday This Month');
                $.each(birthday_data, function(key, val) {
                    if (val.status == 1) {
                        $("#birth_now").append(birthday_html(key, val));
                    }
                });
            }

            function birthday_next_content() {
                $('#announcement-title').html('Birthday This Month');
                $.each(birthday_data, function(key, val) {
                    if (val.status == 0) {
                        $("#birth_next").append(birthday_html(key, val));
                    }
                });
            }

            function birthday_html(key, data) {
                name = data.name;
                const nickname = name.split(" ");
                var html = '';
                html += '<div class="col-xs-6 space birthday">'
                html += '<div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="100%" src="' + url + data.image + '">'
                html += '</div>'
                html += '<div class="space text-center">'
                html += '<span class="light">' + nickname[0] + '</span>'
                html += '</div>'
                return html
            }

            function announcement_content() {
                var data = announcement_data;
                $("#announcement").append(announcement_html(data));
            }

            function announcement_html(data) {
                var html = '';
                html += '<div id="announ-info" class="col-xs-12 p-0">'
                html += '<div class="flex align-center">'
                html += '<img width="22px" src="' + base_url + 'image/icon/ic-date-star.png" alt="">'
                html += '<h6 class="p-xs light">' + data.date + '</h6>'
                html += '</div>'
                html += '<div class="flex align-center">'
                html += '<img width="22px" src="' + base_url + 'image/icon/ic-circle-time.png" alt="">'
                html += '<h6 class="p-xs light">' + data.start + ' - ' + data.end + '</h6>'
                html += '</div>'
                html += '<div class="flex align-center">'
                html += '<img width="22px" src="' + base_url + 'image/icon/ic-location.png" alt="">'
                html += '<h6 class="p-xs light">' + data.location + '</h6>'
                html += '</div>'
                html += '<h6 class="light" style="font-size: 16px; margin-top:10px">' + data.title + '</h6>'
                html += '</div>'
                return html
            }

            function close_alert() {
                $('#alert_global').fadeOut();
            }

            function count_team_work(group) {
                var team_work = {}
                $.each(work_data, function(key, val) {
                    if (val.group == group) {
                        team_work[key] = val;
                    } else {
                        return 0;
                    }
                });
                var count_work = Object.keys(team_work).length;
                return count_work;
            }

            function dom_count_team(group) {
                var work = Object.keys(work_data).length;
                if (work > 0) {
                    $.each(work_data, function(key, val) {
                        if (typeof(group) != "undefined" && group !== null) {
                            ammount_working = count_team_work(group);
                            $('#' + group + '-mount-work').html(ammount_working);
                        } else {
                            ammount_working = count_team_work(val.group);
                            $('#' + val.group + '-mount-work').html(ammount_working);
                        }
                    });
                } else {
                    $('#' + group + '-mount-work').html('0');
                }
            }

            function dom_ammount_work() {
                var count = Object.keys(work_data);
                var ammount = count.length;
                $('#ammount-work').html(ammount)
            }

            function dom_ammount_outcity(data) {
                var count = Object.keys(outcity_data);
                var ammount = count.length;
                $('#ammount-outcity').html(ammount)
            }

            function dom_ammount_permit() {
                var count = Object.keys(permit_data);
                var ammount = count.length;
                $('#ammount-permit').html(ammount)
            }

            function dom_ammount_sickpermit() {
                var count = Object.keys(sick_data);
                var ammount = count.length;
                $('#ammount-sick').html(ammount)
            }

            function dom_ammount_cuti() {
                var count = Object.keys(cuti_data);
                var ammount = count.length;
                $('#ammount-cuti').html(ammount)
            }

            function dom_ammount_employe() {
                $('#ammount-employe').html(count_employe)
            }

            function dom_ammount_internship() {
                $('#ammount-internship').html(count_internship)
            }

            function dom_ammount_workout() {
                var count = Object.keys(tugas_data);
                var ammount = count.length;
                $('#ammount-workout').html(ammount)
            }

            // REFRESH CARAOUSEL AGAR BISA SLIDER KETIKA SCAN
            function reinit_carousel(clas) {
                if ($('.' + clas + '-carousel').hasClass('slick-initialized')) {
                    $('.' + clas + '-carousel').slick('unslick');
                    switch (clas) {
                        case '20':
                            $(".20-carousel").slick({
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '26':
                            $(".26-carousel").slick({
                                slidesToShow: 4,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '33':
                            $(".33-carousel").slick({
                                slidesToShow: 5,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '40':
                            $(".40-carousel").slick({
                                slidesToShow: 6,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '46':
                            $(".46-carousel").slick({
                                slidesToShow: 7,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '53':
                            $(".53-carousel").slick({
                                slidesToShow: 8,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '60':
                            $(".60-carousel").slick({
                                slidesToShow: 9,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '66':
                            $(".66-carousel").slick({
                                slidesToShow: 10,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '73':
                            $(".73-carousel").slick({
                                slidesToShow: 11,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '73':
                            $(".73-carousel").slick({
                                slidesToShow: 11,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '86':
                            $(".86-carousel").slick({
                                slidesToShow: 13,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '93':
                            $(".93-carousel").slick({
                                slidesToShow: 13,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case '100':
                            $(".100-carousel").slick({
                                slidesToShow: 17,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;

                        case 'permit':
                            $(".permit-carousel").slick({
                                slidesToShow: 5,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        case 'footer':
                            $(".footer-carousel").slick({
                                slidesToShow: 17,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                prevArrow: $(".next"),
                                nextArrow: $(".prev"),
                            });
                            break;
                        case 'permit-split':
                            $(".permit-split-carousel").slick({
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                autoplay: true,
                                autoplaySpeed: 2000,
                                arrows: false,
                            });
                            break;
                        default:
                            // code block
                    }
                }
            }

            // ALERT KETIKA DOUBLE SCAN
            function alert_already_scan(data) {
                var mesage = '';
                mesage += '<i class="icon-Caution" style="font-size: 39px;margin-right: 10px;"></i>'
                mesage += '<h5 style="font-size: 28px;">You’re already scan</h5>'
                $('#warning_scan').html(mesage);
                $('#warning_scan').fadeIn();
                setTimeout(function() {
                    $("#warning_scan").fadeOut();
                }, 3000);
            }

            // ALLERT KETIKA SUKSES SCAN
            function alert_success_scan(data) {
                var mesage = '';
                mesage += '<i class="icon-Success" style="font-size: 39px;margin-right: 10px;"></i>'
                mesage += '<h5 style="font-size: 28px;">Your Scan is success</h5>'
                $('#success_scan').html(mesage);
                $('#success_scan').fadeIn();
                setTimeout(function() {
                    $("#success_scan").fadeOut();
                }, 3000);
            }

            function alert_failed_scan(data) {
                var mesage = '';
                mesage += '<i class="icon-Not-Allowed" style="font-size: 39px;margin-right: 10px;"></i>'
                mesage += '<h5 style="font-size: 28px;">NIK isn’t Registered</h5>'
                $('#danger_scan').html(mesage);
                $('#danger_scan').fadeIn();
                setTimeout(function() {
                    $("#danger_scan").fadeOut();
                }, 3000);
            }

            function sasi_alert(title, type) {
                var mesage = '';
                mesage += '<i class="icon-Not-Allowed" style="font-size: 39px;margin-right: 10px;"></i>'
                mesage += '<h5 style="font-size: 28px;">' + title + '</h5>'
                $('#' + type + '').html(mesage);
                $('#' + type + '').fadeIn();
                setTimeout(function() {
                    $('#' + type + '').fadeOut();
                }, 3000);
            }

            // ALLERT GLOBAL
            function alert_scan(nik, data) {
                name = data.name;
                const nickname = name.split(" ");
                var allert_title = "Mau Kemana?"
                var allert_sub_title = "Tekan pilihan tombol di bawah"
                var url_img_employe = url + data.image
                $('#alert_global').fadeIn();
                $('#alert_data').val(nik);
                $('#alert_img_employ').attr('src', url_img_employe);
                $('#alert_name_employe').html(nickname[0]);
                $('#alert_divisi_employe').html(data.divisi);
                $('#alert_title').html(allert_title);
                $('#allert_sub_title').html(allert_sub_title);
                $('#out').show();
                $('#permit').show();
                $('#home_permit').show();
                $('#sick_permit').hide();
                $('#permit_change_time').hide();
                $('#cuti').hide();
                $('#workout').hide();
                $('#out_city').hide();

                setTimeout(function() {
                    $('#alert_global').fadeOut();
                }, 60000);
            }

            // ALLERT GLOBAL SECONDARY
            function second_alert_scan(nik, data) {
                name = data.name;
                const nickname = name.split(" ");
                var allert_title = "Mau Kemana?"
                var allert_sub_title = "Tekan pilihan tombol di bawah"
                var url_img_employe = url + data.image
                $('#alert_global').fadeIn();
                $('#alert_data').val(nik);
                $('#alert_img_employ').attr('src', url_img_employe);
                $('#alert_name_employe').html(nickname[0]);
                $('#alert_divisi_employe').html(data.divisi);
                $('#alert_title').html(allert_title);
                $('#allert_sub_title').html(allert_sub_title);
                $('#sick_permit').show();
                $('#permit_change_time').show();
                $('#cuti').show();
                $('#out').hide();
                $('#permit').hide();
                $('#home_permit').hide();
                $('#workout').hide();

                setTimeout(function() {
                    $('#alert_global').fadeOut();
                }, 60000);
            }

            function out_alert_scan(nik, data) {
                name = data.name;
                const nickname = name.split(" ");
                var allert_title = "Mau Kemana?"
                var allert_sub_title = "Tekan pilihan tombol di bawah"
                var url_img_employe = url + data.image
                $('#alert_global').fadeIn();
                $('#alert_data').val(nik);
                $('#alert_img_employ').attr('src', url_img_employe);
                $('#alert_name_employe').html(nickname[0]);
                $('#alert_divisi_employe').html(data.divisi);
                $('#alert_title').html(allert_title);
                $('#allert_sub_title').html(allert_sub_title);
                $('#out_city').show();
                $('#workout').show();
                $('#out').hide();
                $('#permit').hide();
                $('#home_permit').hide();

                setTimeout(function() {
                    $('#alert_global').fadeOut();
                }, 60000);
            }

            function refreshAt(hours, minutes, seconds) {
                var now = new Date();
                var then = new Date();

                if (now.getHours() > hours ||
                    (now.getHours() == hours && now.getMinutes() > minutes) ||
                    now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() >= seconds) {
                    then.setDate(now.getDate() + 1);
                }
                then.setHours(hours);
                then.setMinutes(minutes);
                then.setSeconds(seconds);

                var timeout = (then.getTime() - now.getTime());
                setTimeout(function() {
                    window.location.reload(true);
                }, timeout);
            }

            load_content();
        </script>
<?php
    }

    // DATE - YEAR CONVERSION =================
    // ========================================
    public static function indo_day($day)
    {
        $hari = array(
            1 =>   'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu',
        );
        // $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return  $hari[(int)$day];
    }

    public static function simple_date_indo($tanggal)
    {

        $bulan = array(
            1 =>   'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sept',
            'Oct',
            'Nov',
            'Dec'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return  $pecahkan[0] . ' ' . $bulan[(int)$pecahkan[1]];
    }

    public static function short_month($month)
    {
        $bulan = array(
            1 =>   'Jan',
            'Feb',
            'Mar',
            'April',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sept',
            'Oct',
            'Nov',
            'Dec'
        );
        // $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return  $bulan[(int)$month];
    }

    // ===================================
    // ===================================
}
