<?php
/**
 * ConvertDayAndMonthToDate Behavior
 *
 * Convert dd/MM to yyyy-MM-dd Behavior
 *
 * @package   Controller.Component
 * @author    Maurício Esteves <mauricio.esteves@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
App::uses('ModelBehavior', 'Model');
App::uses('I18n', 'I18n');
App::uses('I18nModel', 'Model');
/**
 * ConvertDayAndMonthToDateBehavior
 *
 * @package   Controller.Component
 * @author    Maurício Esteves <mauricio.esteves@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
class ConvertDayAndMonthToDateBehavior extends ModelBehavior
{


    /**
     * setup
     *
     * @param Model $Model    Model.
     * @param array $settings Settings options.
     *
     * @return void
     */
    public function setup(Model $Model, $settings=array())
    {
        $this->settings = $settings;

    }//end setup()


    /**
     * beforeSave
     *
     * Function executed after model data validation.
     *
     * @param Model $Model   Model.
     * @param array $options Save options.
     *
     * @return boolean
     */
    public function beforeSave(Model $Model, $options=array())
    {
        $Model->data = $this->toDatabase($Model->data, $this->settings);
        return true;

    }//end beforeSave()


    /**
     * toDatabase
     *
     * Convert dd/MM to yyyy-MM-dd
     *
     * @param date  $data     Date.
     * @param array $settings Settings options.
     *
     * @return date
     */
    public function toDatabase($data, $settings)
    {
        global $_settings;
        $_settings = $settings;

        $fieldWithoutMask = function (&$item, $key) {
            global $_settings;
            foreach ($_settings as $value) {
                if ($key === $value && $item !== null && empty($item) === false) {
                    $value           = str_replace('/', '-', $item.'/2014');
                    $value_converted = date('Y-m-d', strtotime($value));
                    $item            = $value_converted;
                }
            }
        };
        array_walk_recursive($data, $fieldWithoutMask);
        return $data;

    }//end toDatabase()


    /**
     * afterFind
     * 
     * Called after retrieve the data from database
     * 
     * @return $results
     */


    /**
     * afterFind
     *
     * Function executed after model find.
     *
     * @param Model   $Model   Results from model.
     * @param array   $results Results from model.
     * @param boolean $primary If the current model was the query originator.
     *
     * @return boolean
     */
    public function afterFind(Model $Model, $results, $primary=false)
    {
        $results = $this->toView($results, $this->settings);
        return $results;

    }//end afterFind()


    /**
     * toView
     *
     * Formats the date to dd/MM to display on view
     *
     * @param date  $data     Date.
     * @param array $settings Settings options.
     *
     * @return type
     */
    public function toView($data, $settings)
    {
        global $_settings;
        $_settings = $settings;

        $fieldWithoutMask = function (&$item, $key) {
            global $_settings;
            foreach ($_settings as $value) {
                if ($key === $value && $item !== null && empty($item) === false) {
                    $value_converted = date('d/m', strtotime($item));
                    $item = (string) $value_converted;
                }
            }
        };
        array_walk_recursive($data, $fieldWithoutMask);
        return $data;

    }//end toView()


}//end class

?>