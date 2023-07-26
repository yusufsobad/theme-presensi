<?php
(!defined('THEMEPATH')) ? exit : '';

class theme_js
{
    public function _get_($func = '', $idx = array())
    {
        if (is_callable(array($this, $func))) {
            $script = self::$func($idx);
        } else {
            $script = array();
        }

        return $script;
    }

    private function lokasi()
    {
        return SITE . '://' . HOSTNAME . '/' . URL . '/theme/' . _theme_folder . '/assets/';
    }


    // BOOTSTRAP JS ---->	
    private function _bootstrap_js($idx = array())
    {
        $loc = $this->lokasi();
        $js = array(
            'bootstrap-3'            => $loc . 'bootstrap/js/bootstrap.min.js',
        );

        $check = array_filter($idx);
        if (!empty($check)) {
            foreach ($idx as $key) {
                $js[$key];
            }
        }

        return $js;
    }

    // SASI-UI THEME JS ---->
    private function _sasi_js($idx = array())
    {
        $loc = $this->lokasi();
        $js = array(
            'SASI-UI'           => $loc . 'sasi/js/sasi-ui.js',
            'sasi-carousel'     => $loc . 'sasi/js/sasi-carousel.js',
            'footer-carousel'     => $loc . 'sasi/js/footer-carousel.js',
            'sasi-timer'     => $loc . 'sasi/js/sasi-timer.js',
        );

        $check = array_filter($idx);
        if (!empty($check)) {
            foreach ($idx as $key) {
                $js[$key];
            }
        }

        return $js;
    }

    // PLUGIN THEME JS ---->
    private function _plugin_js($idx = array())
    {
        $loc = $this->lokasi();
        $js = array(
            'slick-carousel'        => $loc . 'plugin/slick-carousel/slick/slick.min.js',
            // 'owl-carousel'        => $loc . 'plugin/owl-carousel/js/owl.carousel.min.js',
        );

        $check = array_filter($idx);
        if (!empty($check)) {
            foreach ($idx as $key) {
                $js[$key];
            }
        }

        return $js;
    }

    // VENDOR THEME JS ---->
    private function _vendor_js($idx = array())
    {
        $loc = $this->lokasi();
        $js = array(
            'jquery'        => $loc . 'vendor/jquery/jquery-3-5-0.min.js',
        );

        $check = array_filter($idx);
        if (!empty($check)) {
            foreach ($idx as $key) {
                $js[$key];
            }
        }

        return $js;
    }
}
