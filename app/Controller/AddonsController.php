<?php
/**
 * AddonsController Addon Controller
 *
 * @package   Controller
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
App::uses('AppController', 'Controller');
/**
 * Addon Controller
 *
 * Process the addon data and send to view
 *
 * @package   Controller
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @version   v0.1.0
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 * @since     v0.1.0
 *
 */
class AddonsController extends AppController
{


    /**
     * admin_get_value
     *
     * Get the addon value
     *
     * @return void
     */
    public function admin_get_value()
    {
        $this->autoRender = false;
        $addonId          = $_POST['addonId'];
        $addonValue       = $this->Addon->getValue($addonId);

        echo json_encode($addonValue);

    }//end admin_get_value()


}//end class

?>