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
App::uses('HttpSocket', 'Network/Http');
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
class TransactionsController extends AppController
{

    /**
     * Paginate component.
     *  
     * @var array
     * @access public
     */
    public $paginate
        = array(
           'limit' => 10,
           'order' => 'Transaction.created DESC',
          );


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
        $this->Auth->allow('notification');

    }//end beforeFilter()


    /**
     * admin_index
     *
     * List transactions
     *
     * @return return type
     */
    public function admin_index()
    {
        $this->set('title_for_layout', __('Transactions'));

        $this->set('transactions', $this->paginate());

        parent::admin_table_search();
        $pageCount = $this->params['paging']['Transaction']['pageCount'];
        $this->set(compact('pageCount'));

    }//end admin_index()


    /**
     * notification
     *
     * PagSeguro notifications.
     *
     * @return void
     */
    public function notification()
    {
        $this->autoRender = false;

        $type             = $_POST['notificationType'];
        $notificationCode = $_POST['notificationCode'];

        $HttpSocket = new HttpSocket();
        $credentials
            = array(
               'email' => 'cfo@onneblue.com',
               'token' => '11FF5450FD9740DC86869D90F539879C',
              );
        $results
            = $HttpSocket->get(
                "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/$notificationCode",
                $credentials
            );

        $xml = Xml::toArray(Xml::build($results->body));

        if (isset($xml['transaction']['reference']) === true) {
            $referenceCode = $xml['transaction']['reference'];
        } else {
            $referenceCode = $xml['transaction']['items']['item']['id'];
        }//end if

        mail('renatofrancarpmf@gmail.com', '[OnneBlue][PagSeguro]', $type.'|'.$notificationCode);
        if ($type === 'transaction') {
            $this->Transaction->updateRequest(
                $xml['transaction']['code'],
                $notificationCode,
                $xml['transaction']['status'],
                $referenceCode
            );

            $this->Transaction->recursive = -1;
            $transaction = $this->Transaction->findById($referenceCode);

            if (isset($transaction['Transaction']['business_id']) === true) {
                $this->Transaction->User->Group->recursive = -1;
                $group = $this->Transaction->User->Group->findByBusinessId($transaction['Transaction']['business_id']);

                if ($group['Group']['id'] === '4') {
                    $this->Transaction->User->addUser(
                        1,
                        $transaction['Transaction']['business_id'],
                        $group['Group']['id']
                    );
                }//end if
            }//end if
        }//end if

    }//end notification()


}//end class

?>