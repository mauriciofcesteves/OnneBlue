<?php
/**
 * Mask Remover Behavior
 *
 * This file removes the mask applied to the field
 *
 * PHP 5
 *
 * @author 		Maurício Esteves
 * @copyright   Copyright (c) 2014, Harvest Sistemas
 */

App::uses('ModelBehavior', 'Model');
App::uses('I18n', 'I18n');
App::uses('I18nModel', 'Model');

class MaskRemoverBehavior extends ModelBehavior {

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
		$Model->data = $this->removeMask($Model->data, $this->settings);
		return true;
	}

/**
 * removeMask
 * 
 * Remove the mask from the field
 * 
 * @return $data
 */
	public function removeMask($data, $settings) {
		global $_settings;
		$_settings = $settings;

		$fieldWithoutMask = function(&$item, $key) {
			global $_settings;
			foreach ($_settings as $value) {
				//compara se o valor eh identico, nao estah nulo e nem vazio
				if ($key === $value && $item != null && !empty($item)) {
					$removing1 = str_replace('-', '', $item);
					$removing2 = str_replace('.', '', $removing1);
					$removing3 = str_replace('(', '', $removing2);
					$removing4 = str_replace(')', '', $removing3);
					$removing5 = str_replace('/', '', $removing4);
					$item = $removing5;
				}
			}
		};
		array_walk_recursive($data, $fieldWithoutMask);
		return $data;
	}
}