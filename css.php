<?php
(!defined('THEMEPATH')) ? exit : '';

class theme_css
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


	// BOOTSTRAP STYLES ---->	
	private function _bootstrap_css($idx = array())
	{
		$loc = $this->lokasi();
		$css = array(
			'bootstrap-3'			=> $loc . 'bootstrap/css/bootstrap.min.css',
		);

		$check = array_filter($idx);
		if (!empty($check)) {
			foreach ($idx as $key) {
				$css[$key];
			}
		}

		return $css;
	}

	// SASI-UI THEME STYLES ---->
	private function _sasi_css($idx = array())
	{
		$loc = $this->lokasi();
		$css = array(
			'SASI-UI'		=> $loc . 'sasi/css/sasi-ui.css',
		);

		$check = array_filter($idx);
		if (!empty($check)) {
			foreach ($idx as $key) {
				$css[$key];
			}
		}

		return $css;
	}

	// PLUGIN THEME STYLES ---->
	private function _plugin_css($idx = array())
	{
		$loc = $this->lokasi();
		$css = array(
			'font-awesome-4'		=> $loc . 'plugin/font-awesome-4/font-awesome.min.css',
			'slick-carousel'		=> $loc . 'plugin/slick-carousel/slick/slick.min.css',
		);

		$check = array_filter($idx);
		if (!empty($check)) {
			foreach ($idx as $key) {
				$css[$key];
			}
		}

		return $css;
	}
}
