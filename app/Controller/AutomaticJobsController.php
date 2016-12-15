<?php
/**
 * AutomaticJobsController Automatic Jobs Controller
 *
 * @package   Controller
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Automatic Jobs Controller
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
class AutomaticJobsController extends AppController
{

    /**
     * This controller does not use a model
     *
     * @var array
     * @access public
     */
    public $uses = array();

    /**
     * User components.
     *
     * @var array
     * @access public
     */
    public $components
        = array('SiStayConnected');


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
        $this->Auth->allow();

    }//end beforeFilter()


    /**
     * call_job_expiration_date name
     *
     * This method will alert the user when Minimum Stock
     * Insert a cron job with this command:
     * curl --silent http://beta.onneblue.com/call_job_expiration_date
     *
     * @return return type
     */
    public function call_job_expiration_date()
    {
        $Email->from(array('mauricio.fc.esteves@gmail.com' => 'Harvest'));
        $Email->to('mauricio.fc.esteves@gmail.com');
        $Email->subject('Teste');
        $Email->send('Teste');
        $this->render('/pages/index');

    }//end call_job_expiration_date()


}//end class

?>