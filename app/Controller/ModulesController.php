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
 * Module Controller
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
class ModulesController extends AppController
{


    /**
     * admin_subscriptions()
     *
     * List subscriptions.
     *
     * @return void
     */
    public function admin_subscriptions()
    {
        $userAuth  = $this->Auth->user();
        $myModules = $userAuth['Modules'];
        $modules   = $this->Module->getModules();

        $this->set(compact('myModules', 'modules'));

    }//end admin_subscriptions()


}//end class

?>