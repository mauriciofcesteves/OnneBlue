<?php
/**
 * NotificationsController Modules Controller
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
 * Notification Controller
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
class NotificationsController extends AppController
{


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
        $this->Auth->allow('check');

    }//end beforeFilter()


    /**
     * admin_index()
     *
     * Lists all notifications.
     *
     * @return void
     */
    public function admin_index()
    {
        $notifications = $this->Notification->getAll();
        $this->set(compact('notifications'));

    }//end admin_index()


    /**
     * admin_view
     *
     * Displays data of notification with the id passed as parameter.
     *
     * @param int $id Notification id.
     *
     * @throws NotFoundException if the notification is not found.
     * @return void
     */
    public function admin_view($id=null)
    {
        $this->set('title_for_layout', __('Notification'));
        $this->Notification->id = $id;
        if ($this->Notification->existsAntiHack() === false) {
            throw new NotFoundException(__('Invalid notification'));
        }//end if

        $notification = $this->Notification->get($id);
        $this->set(compact('notification'));
        $this->Notification->changeToRead($id);

    }//end admin_view()


    /**
     * check()
     *
     * Checks for notifications.
     *
     * @return void
     */
    public function check()
    {
        $this->autoRender = false;
        $this->inputsNearExpirationDate();

    }//end check()


    /**
     * inputsNearExpirationDate()
     *
     * Checks for products near to expiration date.
     *
     * @return array
     */
    private function inputsNearExpirationDate()
    {
        $this->loadModel('InventorySystem.InputsOutput');
        $inputs = $this->InputsOutput->getForDaysExpiration(30);

        $notifications = array();
        foreach ($inputs as $inputKey => $inputValue) {
            $notifications[]
                = array(
                    'Notification' => array(
                                       'entity_id'   => $inputValue['InputsOutput']['id'],
                                       'business_id' => $inputValue['InputsOutput']['business_id'],
                                       'module_id'   => 1,
                                       'type'        => 'Input expiration',
                    )
                );
        }
        $notifications = $this->Notification->alreadyExist($notifications);

        if (empty($notifications) === false) {
            $this->Notification->saveAll($notifications);
        }

    }//end inputsNearExpirationDate()


}//end class

?>