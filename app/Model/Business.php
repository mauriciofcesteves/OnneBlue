<?php
/**
 * Business Model
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
 * Business Model
 *
 * Business model business rules.
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
class Business extends AppModel
{

    /**
     * Association hasMany.
     *
     * @var array
     * @access public
     */
    public $hasMany
        = array(
           'User',
           'InputsOutput',
          );

    /**
     * Association belongsTo.
     *
     * @var array
     * @access public
     */
    public $belongsTo = array('Plan');

    /**
     * Application virtual fields.
     *
     * @var array
     * @access public
     */
    public $virtualFields = array('created_utc' => 'Business.created');


    /**
     * calculateEvaluation
     *
     * Calculate business evaluation.
     *
     * @param date $createdDate Created date.
     *
     * @return array
     */
    public function calculateEvaluation($createdDate)
    {
        $today = date('Y-m-d H:i:s');

        $evaluationTime        = ((strtotime($createdDate) + 1814400) - strtotime($today));
        $evaluation['days']    = (int) ceil($evaluationTime / 86400);
        $evaluation['hours']   = (int) ceil($evaluationTime / 3600) - ceil($evaluationTime / 86400) * 24;
        $evaluation['minutes'] = (int) ceil($evaluationTime / 60 - ceil($evaluationTime / 3600) * 60);
        $evaluation['seconds'] = (int) ($evaluationTime - ceil($evaluationTime / 60) * 60);
        $evaluation['expired'] = false;

        if ($evaluation['days'] <= 0) {
            $evaluation['expired'] = true;
        }

        return $evaluation;

    }//end calculateEvaluation()


    /**
     * getCreatedDate()
     *
     * Get created date.
     *
     * @param int $id Business id.
     *
     * @return void
     */
    public function getCreatedDate($id)
    {
        $this->recursive = 0;
        return $this->find(
            'first',
            array(
             'fields'     => array(
                              'created',
                              'created_utc',
                             ),
             'conditions' => array('Business.id' => $id)
            )
        );

    }//end getCreatedDate()


    /**
     * updateTour()
     *
     * Updates the tour value.
     *
     * @param int $value Tour value.
     * @param int $id    Business id.
     *
     * @return void
     */
    public function updateTour($value, $id)
    {
        return $this->updateAll(
            array('Business.tour' => 0),
            array('Business.id' => $id)
        );

    }//end updateTour()


    public function removeNotificationAlert($businessId)
    {
        $updateNotification
            = $this->save(
                array(
                    'Business' => array(
                        'id' => $businessId,
                        'has_notification' => 0
                    )
                )
            );
        
        return $updateNotification;

    }//end removeNotificationAlert()


}//end class

?>