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
    <?php
    }

    public static function header($data = [])
    {
    ?>
        <div class="head-section">
            <div class="row">
                <div class="col-xs-6">
                    <?= isset($data['title']) ? $data['title'] : '' ?>
                    <div>
                        <img width="400px" src="assets/image/icon/ic-sobad-group.png" alt="">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="bg-gradient-purple radius-md pl-sm pr-sm">
                        <img width="411px" class="bg-time" src="assets/image/background/bg-time.png" alt="">
                        <div class="row">
                            <div class="col-xs-4 p-xs">
                                <div class="radius-md bg-light purple pt-xs pb-xs text-center">
                                    <h6 class="semi-bold">Senin</h6>
                                    <h2 class="bold">16</h2>
                                    <h6 class="semi-bold">March 2022</h6>
                                </div>
                            </div>
                            <div class="col-xs-8 light">
                                <div class="grid align-center justify-center" style="height: 138px;">
                                    <h1 class="bold">08:00</h1>
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
}
