<?php
/**
 * Module Model
 *
 * @package   Model
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
App::uses('AppModel', 'Model');
/**
 * Module Model
 *
 * Module model business rules.
 *
 * @package   Model
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @version   v2.3.0
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 * @since     v1.0.0
 *
 */
class Module extends AppModel
{

    /**
     * Association hasMany.
     *
     * @var array
     * @access public
     */
    public $hasMany = array('Plan');


    /**
     * getModules
     *
     * Get Modules.
     *
     * @return array
     */
    public function getModules()
    {
        return $this->find(
            'all',
            array('conditions' => array('status' => 'Active'))
        );

    }//end getModules()


}//end class

?>