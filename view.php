<?php

(!defined('THEMEPATH')) ? exit : '';

define('_theme_name', 'dashboard_layout');
define('_theme_folder', basename(__DIR__));

require dirname(__FILE__) . '/css.php';
require dirname(__FILE__) . '/js.php';

class dashboard_layout extends dashboard_template
{
    public static function load_here($data = [])
    {
?>
        <div class="container-fluid">
            <?php self::header($data) ?>
            <?php self::body($data) ?>
        </div>
        <?php self::_vendor(); ?>
        <?php self::data_json($data['args']); ?>
        <?php self::alert(); ?>
        <?php self::_content(); ?>

        <?php self::custom_script($data) ?>

    <?php
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
                            <button onclick="go_out_city(this)" id="out_city" class="change-time"><img width="23px" src="<?= $base_url ?>icon/ic-plane.png" alt="">
                                Luar Kota</button>

                            <button onclick="change_time(this)" id="change_time" class="change-time"><img width="23px" src="<?= $base_url ?>icon/ic-time.png" alt=""> Ya,
                                Ganti
                                Jam</button>

                            <button onclick="permit(this)" id="permit" class="change-time"><img width="17px" src="<?= $base_url ?>icon/ic-permit.png" alt="">
                                Izin</button>

                            <button onclick="sick_permit(this)" id="sick_permit" class="change-time"><img width="23px" src="<?= $base_url ?>icon/ic-sick.png" alt="">
                                Sakit</button>

                            <button onclick="home_permit(this)" id="home_permit" class="change-time"><img width="20px" src="<?= $base_url ?>icon/ic-home.png" alt="">
                                Pulang</button>

                            <button onclick="permit_change_time(this)" id="permit_change_time" class="change-time"><img width="23px" src="<?= $base_url ?>icon/ic-change-time.png" alt="">
                                Ganti Jam</button>

                            <button onclick="cuti(this)" id="cuti" class="change-time"><img width="23px" src="<?= $base_url ?>icon/ic-cuti.png" alt="">
                                Cuti</button>

                            <input type="hidden" id="alert_data" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="scan_alert">
            <div id="warning_scan" class="alert bg-warning radius-md bold" role="alert" style="font-size:larger; display:none;"></div>
            <div id="success_scan" class="alert bg-success radius-md bold" role="alert" style="font-size:larger; display:none;"></div>
            <div id="danger_scan" class="alert bg-danger radius-md bold" role="alert" style="font-size:larger; display:none;"></div>
        </div>
    <?php
    }

    public static function custom_script($data)
    {
        $script = isset($data['script']) ? $data['script'] : '';
    ?>
        <?= $script ?>
    <?
    }



    public static function data_json($data)
    {
        $data = json_encode($data);
    ?>
        <script>
            var data = <?= $data ?>;
            var notwork_data = data;
            var work_data = {};
            var outcity_data = {};
            var permit_data = {};
            var cuti_data = {};
            var sick_data = {};
        </script>
    <?php
    }

    public static function _content()
    {
    ?>
        <script>
            var url = "https://s.soloabadi.com/system-absen/asset/img/user/";

            function load_content() {
                notwork_content();
                work_content();
                outcity_content();
                permit_content();
                cuti_content();
                sick_content();
                // dom_count_team();
            }

            function notwork_content() {
                var html = '';
                $.each(notwork_data, function(key, val) {
                    html += '<div id="' + key + '-notwork" class="col-xs-2 space">'
                    html += ' <div class="bg-deep-grey radius-xs text-center">'
                    html += '<img class="radius-xs" width="48px" height="48px" src="' + url + val.image + '" alt="">'
                    html += '</div>'
                    html += '<div class="space text-center">'
                    html += ' <span class="light">' + val.name + '</span>'
                    html += '</div>'
                    html += '</div>'
                });
                $(".carousel-footer").append(html);
            }

            function work_content() {
                $.each(work_data, function(key, val) {
                    if (val.group == val.group) {
                        $("#" + val.group + "").append(work_html(key, val));
                    }
                });
            }

            function work_html(key, data) {
                if (data.type == 1) {
                    var time_html = '<div class="text-small red">' + data.time + '</div>'
                } else {
                    var time_html = '<div class="text-small black">' + data.time + '</div>'
                }
                var html = '';
                html += '<div id="' + key + '-work" class="col-xs-4 space">'
                html += ' <div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="48px" height="48px" src="' + url + data.image + '" alt="">'
                html += '</div>'
                html += '<div class="space text-center">'
                html += ' <span class="black">' + data.name + '</span>'
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
                var html = '';
                html += '<div id="' + key + '-permit" class="col-xs-6 w-20 space">'
                html += '<div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="85%"src="' + url + data.image + '">'
                html += ' </div>'
                html += '<div class="text-center">'
                html += '<span class="black">' + data.name + '</span>'
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
                var html = '';
                html += '<div id="' + key + '-permit" class="col-xs-6 w-20 space">'
                html += '<div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="85%" src="' + url + data.image + '">'
                html += ' </div>'
                html += '<div class="text-center">'
                html += '<span class="black">' + data.name + '</span>'
                html += ' </div>'
                html += ' </div>'
                return html;
            }

            function outcity_content() {
                $.each(outcity_data, function(key, val) {
                    $("#out_city_content").append(outcity_html(key, val));
                });
            }

            function outcity_html(key, data) {
                var html = '';
                html += '<div id="' + key + '-permit" class="col-xs-6 w-20 space">'
                html += '<div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="90%"src="' + url + data.image + '">'
                html += ' </div>'
                html += '<div class="text-center">'
                html += '<span class="black">' + data.name + '</span>'
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
                var html = '';
                html += '<div id="' + key + '-permit" class="col-xs-6  space">'
                html += '<div class="bg-deep-grey radius-xs text-center">'
                html += '<img class="radius-xs" width="90%" src="' + url + data.image + '">'
                html += ' </div>'
                html += '<div class="text-center">'
                html += '<span class="black">' + data.name + '</span>'
                html += ' </div>'
                html += ' </div>'
                return html;
            }

            function close_alert() {
                $('#alert_global').fadeOut();
            }

            function count_team_work(group) {
                var team_work = {}
                $.each(work_data, function(key, val) {
                    if (val.group == group) {
                        team_work[key] = val;
                    }
                });

                var count_work = Object.keys(team_work);
                return count_work.length;
            }

            function dom_count_team() {
                $.each(work_data, function(key, val) {
                    ammount_working = count_team_work(val.group);
                    $('#' + val.group + '-mount-work').html(ammount_working)
                });
            }

            function dom_ammount_work() {
                var count = Object.keys(work_data);
                var ammount = count.length;
                $('#ammount-work').html(ammount)
            }

            function dom_ammount_outcity() {
                var count = Object.keys(outcity_data);
                var ammount = count.length;
                $('#ammount-outcity').html(ammount)
            }

            function dom_ammount_permit() {
                var count = Object.keys(permit_data);
                var ammount = count.length;
                $('#ammount-permit').html(ammount)
            }

            load_content();
        </script>
    <?php
    }

    public static function _vendor()
    {
        $loc = SITE . '://' . HOSTNAME . '/' . URL . '/theme/' . _theme_folder . '/assets/';
    ?>
        <script src="<?= $loc . 'vendor/jquery/jquery-3-5-0.min.js' ?>"></script>
        <script src="<?= $loc . 'sasi/js/sasi-carousel.js' ?>"></script>
        <!-- <script src="<?= $loc . 'plugin/slick-carousel/slick/slick.min.js' ?>"></script> -->
<?php
    }

    // DATE - YEAR CONVERSION =================
    // ========================================
    function indo_day($day)
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

    function simple_date_indo($tanggal)
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

    function short_month($month)
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
