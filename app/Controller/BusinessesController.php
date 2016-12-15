<?php
/**
 * ModulesController Modules Controller
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
 * Businesses Controller
 *
 * Process the module data and send to view
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
class BusinessesController extends AppController
{


    /**
     * removeNotificationAlert()
     *
     * @return void
     */
    public function admin_removeNotificationAlert()
    {
        $this->autoRender = false;
        $businessId = $this->Auth->user('business_id');
        $remove = $this->Business->removeNotificationAlert($businessId);

        if ($remove !== false) {
            $this->Session->write('Auth.User.Business.has_notification', 0);
            echo 200;
        }

    }//end removeNotificationAlert()


}//end class

?>