<?php
/**
 * PlansController User Controller
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
App::uses('Xml', 'Utility');
/**
 * Plan Controller
 *
 * Process the plan data and send to view
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
class PlansController extends AppController
{

    /**
     * App helpers.
     *
     * @var array
     * @access public
     */
    public $helpers = array('Html');


    /**
     * admin_index()
     *
     * List plans.
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('title_for_layout', __('Plans'));
        $this->set('plans', $this->Plan->getPlans());

    }//end admin_index()


    /**
     * admin_pay
     *
     * Performs the payment of a plan
     *
     * @param int $planId Plan id.
     *
     * @throws NotFoundException if the plan is not found.
     * @return type
     */
    public function admin_pay($planId)
    {
        $this->set('title_for_layout', __('Payment Plan'));
        $this->Plan->id = $planId;
        if ($this->Plan->existsAntiHack() === false) {
            throw new NotFoundException(__('Invalid plan'));
        }

        if ($this->request->is('post') === true || $this->request->is('put') === true) {
            if (isset($this->data['period']) === false) {
                $this->Session->setFlash(__('Please, select a period'));
                $this->redirect(array('action' => 'pay', $planId));
            } else if (isset($this->data['payment-method']) === false) {
                $this->Session->setFlash(__('Please, select a payment method'));
                $this->redirect(array('action' => 'pay', $planId));
            } else {
                $HttpSocket = new HttpSocket();
                $plan       = $this->Plan->getById($planId, $this->data['period']);
                $user       = $this->Auth->user();
                $maxTotal   = ($plan['Plan']['price_float'] * 12);
                $reference  = $this->Plan->Transaction->preSave($user['business_id'], $user['id'], $plan['Plan']['id']);
                if ($this->data['period'] === 'Monthly') {
                    $data
                        = array(
                           'email'                       => 'cfo@onneblue.com',
                           'token'                       => '11FF5450FD9740DC86869D90F539879C',
                           'senderEmail'                 => $user['email'],
                           'preApprovalCharge'           => 'auto',
                           'preApprovalName'             => 'OnneBlue '.$plan['Plan']['name'],
                           'preApprovalAmountPerPayment' => $plan['Plan']['price_float'],
                           'preApprovalPeriod'           => 'Monthly',
                           'preApprovalFinalDate'        => '2016-12-01T00:00:000-03:00',
                           'preApprovalMaxTotalAmount'   => '480.00',
                           'reference '                  => $reference,
                          );
                    $results  = $HttpSocket->post('https://ws.pagseguro.uol.com.br/v2/pre-approvals/request', $data);
                    $xml      = Xml::toArray(Xml::build($results->body));
                    $code     = $xml['preApprovalRequest']['code'];
                    $redirect = "https://pagseguro.uol.com.br/v2/pre-approvals/request.html?code=$code";
                    $this->Plan->Transaction->update($plan['Plan']['price_float'], 'Monthly', $code, $reference);
                } else {
                    $total = ($plan['PlansPeriod'][0]['months'] * $plan['Plan']['price_float']);
                    $total = ($total - ($total * $plan['PlansPeriod'][0]['discount']));
                    $data
                        = array(
                           'email'            => 'cfo@onneblue.com',
                           'token'            => '11FF5450FD9740DC86869D90F539879C',
                           'currency'         => 'BRL',
                           'itemId1'          => $reference,
                           'itemDescription1' => 'OnneBlue '.$plan['Plan']['name'],
                           'itemAmount1'      => number_format((float) $total, 2),
                           'itemQuantity1'    => '1',
                           'reference '       => $reference,
                          );
                    $results  = $HttpSocket->post('https://ws.pagseguro.uol.com.br/v2/checkout', $data);
                    $xml      = Xml::toArray(Xml::build($results->body));
                    $code     = $xml['checkout']['code'];
                    $redirect = "https://pagseguro.uol.com.br/v2/checkout/payment.html?code=$code";
                    $this->Plan->Transaction->update(
                        number_format((float) $total, 2),
                        $this->data['period'],
                        $code,
                        $reference
                    );
                }//end if

                $this->redirect($redirect);
            }//end if
        } else {
            $plan = $this->Plan->getById($planId);
            $this->set(compact('plan'));
        }//end if

    }//end admin_pay()


}//end class

?>