<?php
!defined('THEMEPATH') ? exit() : '';

class sobad_grid
{
    public static function create_grid($data = [])
    {

?>
        <div class="row">
            <?php foreach ($data as $key => $val) {
                self::grid($val);
            } ?>
        </div>
    <?php
    }

    private static function grid($data = [])
    {
        $id = isset($data['id']) ? $data['id'] : '';
        $col = isset($data['col']) ? $data['col'] : 12;
        $class = isset($data['class']) ? $data['class'] : '';
    ?>
        <div id="<?= $id ?>" class="col-xs-<?= $col ?> <?= $class ?>">
            <?php
            $func = isset($data['func']) ? $data['func'] : '';
            if (method_exists('dashboard_template', $func)) {
                dashboard_template::{$func}($data['data']);
            } else {
                self::create_grid($data['data']);
            } ?>
        </div>
<?php
    }
}
