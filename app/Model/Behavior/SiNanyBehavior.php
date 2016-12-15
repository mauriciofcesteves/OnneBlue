<?php
/**
 * siNany Behavior
 *
 * This file formats the date
 *
 * PHP 5
 *
 * @author 		Renato França
 * @copyright   Copyright (c) 2014, Renato França
 * @link        http://si.renato-franca.com/sinany-behavior
 * @since       SiNany v1.0.2
 */
class SiNanyBehavior extends ModelBehavior {

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
 * Formats the data to save on database
 * 
 * @return $data
 */
	public function toDatabase($data, $settings) {
		global $_settings;
		$_settings = $settings;

		$dateToDatabase = function(&$item, $key) {
			global $_settings;
			if (isset($_settings['values'])) {
				if (in_array($key, $_settings['values'])) {
					if (isset($_settings['type'])) {
						$type = $_settings['type'];
						$dateAlreadyFormated = false;
						$dateAndHour = explode(' ', $item);
						if (isset($dateAndHour[0])) {
							if (strstr($dateAndHour[0], '-')) {
								$dateNotFormated = explode('-', $dateAndHour[0]);
								$dateAlreadyFormated = true;
							} else if (strstr($dateAndHour[0], '/')) {
								$dateNotFormated = explode('/', $dateAndHour[0]);
							}
						}
						if (isset($dateAndHour[1])) {
							$hourNotFormated = explode(':', $dateAndHour[1]);
						}

						if (!$dateAlreadyFormated) {
							switch ($type) {
								case 1:
									if (isset($dateNotFormated[0]) && isset($dateNotFormated[1]) && isset($dateNotFormated[2])) {
										$item = $dateNotFormated[2] . '-' . $dateNotFormated[1] . '-' . $dateNotFormated[0];
									}
									break;
								case 2:
									if (isset($dateNotFormated[0]) && isset($dateNotFormated[1]) && isset($dateNotFormated[2]) && isset($dateAndHour[1])) {
										$item = $dateNotFormated[2] . '-' . $dateNotFormated[1] . '-' . $dateNotFormated[0] . ' ' . $dateAndHour[1];
									}
									break;
								case 3:
									if (isset($dateNotFormated[0]) && isset($dateNotFormated[1]) && isset($dateNotFormated[2])) {
										$item = $dateNotFormated[2] . '-' . $dateNotFormated[1] . '-' . $dateNotFormated[0];
									}
									break;
								
								default:
									break;
							}
						}
					}
				}
			}
		};
		array_walk_recursive($data, $dateToDatabase);
		return $data;
	}

/**
 * toView
 * 
 * Formats the date to display on view
 * 
 * @return $data
 */
	public function toView($data, $settings) {
		global $_settings;
		$_settings = $settings;

		$dateToView = function(&$item, $key) {
			global $_settings;
			if (isset($_settings['values'])) {
				if (in_array($key, $_settings['values'])) {
					if (isset($_settings['type'])) {
						$type = $_settings['type'];

						$dateAndHour = explode(' ', $item);
						if (isset($dateAndHour[0])) {
							$dateNotFormated = explode('-', $dateAndHour[0]);
						}
						if (isset($dateAndHour[1])) {
							$hourNotFormated = explode(':', $dateAndHour[1]);
						}

						switch ($type) {
							case 1:
								$item = $dateAndHour[0];
								break;
							case 2:
								if (isset($dateNotFormated[0]) && isset($dateNotFormated[1]) && isset($dateNotFormated[2]) && isset($dateAndHour[1])) {
									$item = $dateNotFormated[2] . '/' . $dateNotFormated[1] . '/' . $dateNotFormated[0] . ' ' . $dateAndHour[1];
								}
								break;
							case 3:
								if (isset($dateNotFormated[0]) && isset($dateNotFormated[1]) && isset($dateNotFormated[2])) {
									$item = $dateNotFormated[2] . '/' . $dateNotFormated[1] . '/' . $dateNotFormated[0];
								}
								break;
							
							default:
								break;
						}
					}
				}
			}
		};
		array_walk_recursive($data, $dateToView);
		return $data;
	}

}