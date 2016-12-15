<?php
/**
 * SiCoxi Behavior
 *
 * This file formats the money
 *
 * PHP 5
 *
 * @author 		Renato França
 * @copyright   Copyright (c) 2014, Renato França
 * @link        http://si.renato-franca.com/sicoxi-behavior/
 * @since       SiCoxi v1.0.2
 */
class SiCoxiBehavior extends ModelBehavior {

	public function setup(Model $Model, $settings = array()) {
		$this->settings = $settings;
	}

/**
 * beforeSave
 * 
 * Called before save the data on database
 * 
 * @return void
 */
	public function beforeSave(Model $Model, $options = array()) {
		$Model->data = $this->toDatabase($Model->data, $this->settings);
		return true;
	}

/**
 * afterFind
 * 
 * Called after retrieve the data from database
 * 
 * @return $results
 */
	public function afterFind(Model $Model, $results, $primary = false) {
		$results = $this->toView($results, $this->settings);
		return $results;
	}

/**
 * toDatabase
 * 
 * Formats the money to save on database
 * 
 * @return $data
 */
	public function toDatabase($data, $settings) {
		global $_settings;
		$_settings = $settings;

		$moneyToDatabase = function(&$item, $key) {
			global $_settings;
			if (isset($_settings['values'])) {
				if (in_array($key, $_settings['values'])) {
					if (strstr($item, ',')) {
						$moneyNoDot = str_replace('.', '', $item);
						$moneyFormated = str_replace(',', '.', $moneyNoDot);
						$item = $moneyFormated;
					}
				}
			}
		};
		array_walk_recursive($data, $moneyToDatabase);
		return $data;
	}

/**
 * toView
 * 
 * Formats the money to display on view
 * 
 * @return $data
 */
	public function toView($data, $settings) {
		global $_settings;
		$_settings = $settings;
		$moneyToView = function(&$item, $key) {
			$forbiddenPages = explode('/', $_SERVER['REQUEST_URI']);
			global $_settings;
			if (isset($_settings['values'])) {
				if ($item != null && in_array($key, $_settings['values']) && !in_array('edit', $forbiddenPages)) {
					$item = number_format($item, 2, ',', '.');
					if (isset($_settings['prefix'])) {
						$item = $_settings['prefix'] . $item;
					}
					if (isset($_settings['postfix'])) {
						$item = $item . $_settings['postfix'];
					}
				}
			}
		};
		array_walk_recursive($data, $moneyToView);
		return $data;
	}

}