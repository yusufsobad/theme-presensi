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
                <div class="col-xs-12 bg-dark-blue radius-md" style="height: 100px;">
                    <div class="row carousel-footer" style="padding: 19px;">
                        <?php
                        foreach ($data as $value) :
                            $img = isset($value['url_img']) ? $value['url_img'] : 'https://cdn.vectorstock.com/i/1000x1000/30/97/flat-business-man-user-profile-avatar-icon-vector-4333097.webp';
                            $title = isset($value['title']) ? $value['title'] : '-';
                        ?>

                            <div id="carousel_not_work" class="col-xs-2 space">
                                <div class="bg-deep-grey radius-xs text-center">
                                    <img class="radius-xs" width="48px" height="48px" src="<?= $img ?>" alt="">
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

    public static function card_company($data = [])
    {
        $color = isset($data['color']) ? $data['color'] : 'light';
        $title = isset($data['title']) ? $data['title'] : '';
        $logo = isset($data['logo']) ? $data['logo'] : '';
        $count = isset($data['count']) ? $data['count'] : 0;
        $size_logo = isset($data['size_logo']) ? $data['size_logo'] : '50%';
        $id = isset($data['id']) ? $data['id'] : '';
    ?>
        <div id="<?= $id ?>" class="row mt-xs">
            <div class="flex justify-between align-flex-end">
                <div class="col-xs-7 p-0">
                    <div class="row flex align-center">
                        <div class="col-xs-6 w-fit">
                            <div class="card-title bg-<?= $color ?> text-center ">
                                <h5 class="semi-bold"><?= $title ?></h5>
                            </div>
                        </div>
                        <div class="col-xs-6 p-0">
                            <img width="<?= $size_logo ?>" src="<?= $logo ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="card-title bg-<?= $color ?> text-center">
                    <div class="bg-gradient-purple radius-sm">
                        <h6 class="bold p-xs light"><?= $count ?></h6>
                    </div>
                </div>
            </div>
            <div class="card-container bg-light radius-bottom-md">
                <div class="row">
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
        </div>
        <?php
    }

    public static function card_divisi($data = [])
    {
        foreach ($data as $key => $val) {
            $title = isset($val['title']) ? $val['title'] : '';
            $width = isset($val['width']) ? $val['width'] : '20';
            $qty = isset($val['qty']) && $val['qty'] !== '' ? $val['qty'] : 0;
            $color = isset($val['color']) ? $val['color'] : 'grey';
            $id = isset($val['id']) ? $val['id'] : '';
            $class = isset($val['class']) ? $val['class'] : '';
        ?>
            <div class="col-xs-2 w-<?= $width ?> space">
                <div class="bg-light-grey radius-md p-xs" style="height:154px;">
                    <div class="row">
                        <div class="col-xs-8 flex align-center">
                            <div class="team-mark bg-<?= $color ?> mr-xs"></div>
                            <p><?= $title ?></p>
                        </div>
                        <div class="col-xs-4 p-0">
                            <div class="flex count-section justify-flex-end">
                                <div class="leaf-number radius-bottom-left-md radius-top-right-md bg-deep-grey grid align-center text-center grey" style="margin-right: -12px; margin-left: -7px;">
                                    <p id="<?= $id ?>-mount-work">0</p>
                                </div>
                                <div class="leaf-number radius-bottom-left-md radius-top-right-md bg-<?= $color ?> grid align-center text-center light">
                                    <p><?= $qty ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="<?= $id ?>" class="row m-0 pt-xs <?= $width ?>-carousel <?= $class ?>">
                        <?php foreach ($val['content'] as $vals) {
                            $image = isset($vals['image']) ? $vals['image'] : '';
                            $title = isset($vals['title']) ? $vals['title'] : '';
                            $time_in = isset($vals['time_in']) ? $vals['time_in'] : '00.00';
                        ?>
                            <div class="col-xs-4 space">
                                <div class="bg-deep-grey radius-xs text-center">
                                    <img class="radius-xs" width="48px" height="48px" src="<?= $image ?>" alt="">
                                </div>
                                <div class="space text-center">
                                    <span class="black"><?= $title ?></span>
                                    <div class="text-small black"><?= $time_in ?></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
        }
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
        $base_url = SITE . '://' . HOSTNAME . '/' . URL . '/theme/' . _theme_folder . '/assets/';
        $base_url = $base_url .  "image/background/";
        ?>
        <div class="bg-<?= $data['color'] ?> radius-md p-sm card-information">
            <img width="50%" class="bg-announ" src="<?= $base_url ?>bg-speaker.png" alt="">
            <h5 class="light-grey">Announcement</h5>
            <br>
            <h6 class="light-grey">Birthday This Month</h6>
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
