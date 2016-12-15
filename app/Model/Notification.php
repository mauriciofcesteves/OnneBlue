<?php
/**
 * Notification Model
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
 * Notification Model
 *
 * Notification model business rules.
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
class Notification extends AppModel
{

    /**
    * We can use this field with 'order by' clause.
    */
    public $virtualFields = array(
        'created_month' => "DATE_FORMAT(Notification.created, '%M')"
    );

    /*
     * alreadyExist
     *
     * Check if the notifications already exist
     *
     * @params array $notifications Notificatinos to check.
     *
     * @return array
     */
    public function alreadyExist($notifications)
    {
        foreach ($notifications as $notificationKey => $notificationvalue) {
            $hasNotification = $this->find(
                'first',
                array(
                    'conditions' => array(
                        'Notification.entity_id'   => $notificationvalue['Notification']['entity_id'],
                        'Notification.business_id' => $notificationvalue['Notification']['business_id'],
                        'Notification.module_id'   => $notificationvalue['Notification']['module_id'],
                    ),
                    'fields' => array(
                        'Notification.id'
                    )
                )
            );

            if (empty($hasNotification) === false) {
                unset($notifications[$notificationKey]);
            }
        }//end forearch

        return $notifications;

    }//end alreadyExist()


    public function getLatest()
    {
        return $this->find(
            'all',
            array(
                'joins' => array(
                    array(
                        'table' => 'is_inputs_outputs',
                        'alias' => 'InputsOutput',
                        'type'  => 'LEFT',
                        'conditions' => array(
                            'InputsOutput.id = Notification.entity_id'
                        )
                    ),
                    array(
                        'table' => 'is_products',
                        'alias' => 'Product',
                        'type'  => 'LEFT',
                        'conditions' => array(
                            'Product.id = InputsOutput.product_id'
                        )
                    )
                ),
                'fields' => array(
                    'InputsOutput.product_id',
                    'Notification.*',
                    'Product.name'
                ),
                'limit' => 5,
                'order' => 'Notification.created DESC',
            )
        );

    }//end getLatest()


    public function getAll()
    {
        return $this->find(
            'all',
            array(
                'joins' => array(
                    array(
                        'table' => 'is_inputs_outputs',
                        'alias' => 'InputsOutput',
                        'type'  => 'LEFT',
                        'conditions' => array(
                            'InputsOutput.id = Notification.entity_id'
                        )
                    ),
                    array(
                        'table' => 'is_products',
                        'alias' => 'Product',
                        'type'  => 'LEFT',
                        'conditions' => array(
                            'Product.id = InputsOutput.product_id'
                        )
                    )
                ),
                'fields' => array(
                    'InputsOutput.product_id',
                    'InputsOutput.expiration_date',
                    'Notification.*',
                    'Product.name',
                ),
                'order' => 'Notification.created DESC'
            )
        );

    }//end getAll()


    public function get($id)
    {
        return $this->find(
            'first',
            array(
                'joins' => array(
                    array(
                        'table' => 'is_inputs_outputs',
                        'alias' => 'InputsOutput',
                        'type'  => 'LEFT',
                        'conditions' => array(
                            'InputsOutput.id = Notification.entity_id'
                        )
                    ),
                    array(
                        'table' => 'is_products',
                        'alias' => 'Product',
                        'type'  => 'LEFT',
                        'conditions' => array(
                            'Product.id = InputsOutput.product_id'
                        )
                    )
                ),
                'fields' => array(
                    'InputsOutput.product_id',
                    'InputsOutput.expiration_date',
                    'Notification.*',
                    'Product.name',
                ),
                'conditions' => array(
                    'Notification.id' => $id
                )
            )
        );

    }//end getA()


    /*
     * changeToRead()
     */
    public function changeToRead($id)
    {
        $this->save(
            array(
                'Notification' => array(
                    'id'      => $id,
                    'is_read' => 1
                )
            )
        );

    }//end changeToRead()


}//end class

?>