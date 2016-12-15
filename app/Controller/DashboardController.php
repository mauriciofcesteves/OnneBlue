<?php
/**
 * DashboardController Dashboard Controller
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
 * Dashboard Controller
 *
 * Process the user data and send to view
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
class DashboardController extends AppController
{

    /**
     * User components.
     *
     * @var array
     * @access public
     */
    public $components
        = array(
           'SiStayConnected',
          );

    /**
     * This controller does not use a model
     *
     * @var array
     * @access public
     */
    public $uses = array();


    /**
     * admin_index
     *
     * Dashboard initial page logic
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('title_for_layout', __('Dashboard'));

        $user = $this->Session->read('Auth.User');
        if (isset($user) === false) {
            $this->redirect(
                array(
                 'controller' => 'users',
                 'action'     => 'login',
                 'admin'      => true,
                )
            );
        }

        $this->SiStayConnected->readData();
        $this->set(compact('user'));

    }//end admin_index()


    /**
     * beforeFilter
     *
     * Called before the controller action.
     *
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('admin_index');

    }//end beforeFilter()


}//end class

?>