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
class Transaction extends AppModel
{

    /**
     * Association hasMany.
     *
     * @var array
     * @access public
     */
    public $belongsTo
        = array(
           'Business',
           'User',
           'Plan',
          );


    /**
     * preSave
     *
     * Prepare to save the data of PagSeguro
     *
     * @param int $businessId Business id.
     * @param int $userId     User id.
     * @param int $planId     Plan id.
     *
     * @return string
     */
    public function preSave($businessId, $userId, $planId)
    {
        $this->save(
            array(
             'Transaction' => array(
                               'business_id' => $businessId,
                               'user_id'     => $userId,
                               'plan_id'     => $planId,
                              )
            )
        );
        return $this->getLastInsertId();

    }//end preSave()


    /**
     * update
     *
     * Save the transaction
     *
     * @param double $price     Plan price.
     * @param enum   $period    Plan period.
     * @param string $code      Plan code.
     * @param int    $reference Plan reference.
     *
     * @return string
     */
    public function update($price, $period, $code, $reference)
    {
        return $this->updateAll(
            array(
             'Transaction.price'    => $price,
             'Transaction.period'   => "'".$period."'",
             'Transaction.url_code' => "'".$code."'",
            ),
            array('Transaction.id' => $reference)
        );

    }//end update()


    /**
     * get
     *
     * Get the transactions
     *
     * @param int $business_id Business id.
     * @param int $limit       Query limit.
     *
     * @return string
     */
    public function get($business_id, $limit=false)
    {
        $options['conditions'] = array('Transaction.business_id' => $business_id);
        $options['order']      = 'Transaction.created DESC';
        if (isset($limit) !== false) {
            $options['limit'] = $limit;
        }

        return $this->find(
            'all',
            $options
        );

    }//end get()


    /**
     * updateRequest
     *
     * Update the request
     *
     * @param string $transactionCode  Transaction code.
     * @param string $notificationCode Notification code.
     * @param string $requestStatus    Status.
     * @param string $referenceCode    Reference code.
     *
     * @return type
     */
    public function updateRequest($transactionCode, $notificationCode, $requestStatus, $referenceCode)
    {
        $this->updateAll(
            array(
             'Transaction.transaction_code'  => "'".$transactionCode."'",
             'Transaction.notification_code' => "'".$notificationCode."'",
             'Transaction.status'            => $requestStatus,
            ),
            array('Transaction.id' => $referenceCode)
        );

    }//end updateRequest()


}//end class

?>