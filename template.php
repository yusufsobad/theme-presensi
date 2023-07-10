<?php

(!defined('THEMEPATH')) ? exit : '';

require dirname(__FILE__) . '/template/grid.php';

abstract class dashboard_template
{
    public static function carousel_user($data = [])
    {
?>
        <div class="">
            <div class="row mt-xs footer-section">
                <div class="col-xs-12 bg-dark-blue radius-md pl-md pr-md pt-xs">
                    <div class="row carousel-footer">
                        <?php 
                            foreach ($data['data'] as $value) : 
                                $img = isset($value['url_img']) ? $value['url_img'] : 'https://cdn.vectorstock.com/i/1000x1000/30/97/flat-business-man-user-profile-avatar-icon-vector-4333097.webp';
                                $title = isset($value['title']) ? $value['title'] : '-';
                            ?>

                            <div class="col-xs-2 space">
                                <div class="bg-deep-grey radius-xs text-center">
                                    <img class="radius-xs" width="100%" src="<?= $img ?>" alt="">
                                </div>
                                <div class="space text-center">
                                    <span class="light"><?= $title ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button aria-label="Previous" class="prev"></button>
                    <button aria-label="Next" class="next"></button>
                </div>
            </div>
        </div>
    <?php
    }

    public static function card_container($data = [])
    {
        $color = isset($data['color']) ? $data['color'] : 'light';
        $title = isset($data['title']) ? $data['title'] : '';
        $logo = isset($data['logo']) ? $data['logo'] : '';
        $count = isset($data['count']) ? $data['count'] : 0;
    ?>
        <div class="row mt-xs">
            <div class="flex justify-between align-flex-end">
                <div class="col-xs-7 p-0">
                    <div class="row flex align-center">
                        <div class="col-xs-6 w-fit">
                            <div class="card-title bg-<?= $color ?> text-center ">
                                <h5 class="semi-bold"><?= $title ?></h5>
                            </div>
                        </div>
                        <div class="col-xs-6 p-0">
                            <img width="50%" src="<?= $logo ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="card-title bg-<?= $color ?> text-center">
                    <div class="bg-gradient-purple radius-sm">
                        <h6 class="bold p-xs light"><?= $count ?></h6>
                    </div>
                </div>
            </div>
            <div class="card-container bg-<?= $color ?> radius-bottom-md">
                <?php
                $func = isset($data['func']) ? $data['func'] : '';
                if (method_exists('dashboard_template', $func)) {
                    self::{$func}($data['data']);
                } else {
                    echo 'Function ' . $func . ' Not Exist !!!';
                }
                ?>
            </div>
        </div>
    <?php
    }

    public static function card_division($data = [])
    {
        $color = isset($data['color']) ? $data['color'] : 'light';
        $title = isset($data['title']) ? $data['title'] : '';
        $color_division = isset($data['color_division']) ? $data['color_division'] : 'deep_grey';
        $ammount_ready = isset($data['ammount_ready']) ? $data['ammount_ready'] : 0;
        $ammount_employe = isset($data['ammount_employe']) ? $data['ammount_employe'] : 0;
        $carousel =  isset($data['carousel']) ? $data['carousel'] : '';
    ?>
        <div class="bg-<?= $color ?> radius-md p-xs">
            <div class="row">
                <div class="col-xs-8 flex align-center">
                    <div class="team-mark bg-<?= $color_division ?> mr-xs"></div>
                    <p><?= $title ?></p>
                </div>
                <div class="col-xs-4 p-0">
                    <div class="flex count-section justify-flex-end">
                        <div class="leaf-number radius-bottom-left-md radius-top-right-md bg-deep-grey grid align-center text-center grey" style="margin-right: -12px; margin-left: -7px;">
                            <p><?= $ammount_ready ?></p>
                        </div>
                        <div class="leaf-number radius-bottom-left-md radius-top-right-md bg-<?= $color_division ?> grid align-center text-center light">
                            <p><?= $ammount_employe ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-0 pt-xs <?= $carousel ?>">
                <?php foreach ($data['data'] as $val) { ?>
                    <div class="col-xs-4 space">
                        <div class="bg-deep-grey radius-xs text-center">
                            <img class="radius-xs" width="100%" src="<?= $val['url_img'] ?>" alt="">
                        </div>
                        <div class="space text-center">
                            <span class="black"><?= $val['employe_name'] ?></span>
                            <div class="text-small black"><?= $val['enter_time'] ?></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }


    public static function user_card($data = [])
    {
        foreach ($data as $val) {
        ?>
            <div class="col-xs-3 space">
                <div class="bg-deep-grey radius-xs text-center">
                    <img class="radius-xs" width="100%" src="<?= $val['img_url'] ?>" alt="">
                </div>
                <div class="space text-center">
                    <span class="light"><?= $val['title'] ?></span>
                </div>
            </div>
        <?php
        }
    }

    public static function card_birthday($data = [])
    {
        ?>
        <div class="bg-<?= $data['color'] ?> radius-md p-sm card-information">
            <img width="50%" class="bg-announ" src="assets/image/background/bg-speaker.png" alt="">
            <h5 class="light-grey">Announcement</h5>
            <br>
            <h6 class="light-grey">Birthday This Mount</h6>
            <div class="row pl-xs mt-xs">
                <?php
                $func = isset($data['func']) ? $data['func'] : '';
                if (method_exists('dashboard_template', $func)) {
                    self::{$func}($data['data']);
                } else {
                    echo 'Function ' . $func . ' Not Exist !!!';
                }
                ?>
            </div>
        </div>
    <?php
    }

    public static function free_html($data = '')
    {
        echo $data;
    }

    public static function card($data = [])
    {
        $color = isset($data['color']) && $data['color'] !== '' ? $data['color'] : 'light';
        $class = isset($data['class']) ? $data['class'] : '';
    ?>
        <div class="bg-<?= $color ?> radius-md <?= $class ?>">
            <?php
            $func = isset($data['func']) ? $data['func'] : '';
            if (method_exists('dashboard_template', $func)) {
                self::{$func}($data['data']);
            } else {
                echo 'Function ' . $func . ' Not Exist !!!';
            }
            ?>
        </div>
<?php
    }

    //--------------------------------------------
    //Grid System---------------------------------
    //--------------------------------------------

    public static function sobad_grid($args = array())
    {
        sobad_grid::create_grid($args);
    }
}
