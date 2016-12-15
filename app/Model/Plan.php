<?php
/**
 * Plan Model
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
 * Plan Model
 *
 * Plan model business rules.
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
class Plan extends AppModel
{

    /**
     * Association hasMany.
     *
     * @var array
     * @access public
     */
    public $hasMany
        = array(
           'ModulesPlan',
           'Transaction',
           'PlansPeriod',
           'PlansFeature',
          );

    public $actsAs
        = array('Containable');

    /**
     * Application virtual fields.
     *
     * @var array
     * @access public
     */
    public $virtualFields
        = array('price_float' => 'Plan.price');


    /**
     * getModules
     *
     * Get plan modules.
     *
     * @param int $planId Plan id.
     *
     * @return array
     */
    public function getModules($planId)
    {
        $this->recursive = 2;
        return $this->find(
            'first',
            array('conditions' => array('Plan.id' => $planId))
        );

    }//end getModules()


    /**
     * getById
     *
     * Get plan data by id
     *
     * @param int    $planId Plan id.
     * @param string $type   Plan type.
     *
     * @return array
     */
    public function getById($planId, $type=false)
    {
        $this->recursive = 0;
        $conditions[]    = array('PlansPeriod.status' => 'Active');
        if ($type !== false) {
            $conditions[] = array('PlansPeriod.type' => $type);
        }//end if
        return $this->find(
            'first',
            array(
             'contain'    => array(
                              'PlansPeriod' => array(
                                                'conditions' => $conditions,
                                                'order'      => 'PlansPeriod.order ASC',
                                               )
                             ),
             'fields'     => array(
                              'Plan.id',
                              'Plan.price',
                              'Plan.price_float',
                              'Plan.name',
                             ),
             'conditions' => array('Plan.id' => $planId)
            )
        );

    }//end getById()


    /**
     * getPlans
     *
     * Get plans.
     *
     * @return array
     */
    public function getPlans()
    {
        $this->recursive = 0;
        return $this->find(
            'all',
            array(
             'contain'    => array(
                              'PlansFeature' => array('order' => 'PlansFeature.order ASC'),
                              'PlansPeriod'
                             ),
             'conditions' => array('status' => 'Active')
            )
        );

    }//end getPlans()


    /**
     * getValue
     *
     * Get plan value
     *
     * @param int $planId Plan id.
     *
     * @return array
     */
    public function getValue($planId)
    {
        $this->recursive = 0;
        return $this->find(
            'first',
            array(
             'fields'     => array(
                              'Plan.id',
                              'Plan.value',
                              'Plan.name',
                             ),
             'conditions' => array('Plan.id' => $planId)
            )
        );

    }//end getValue()


}//end class

?>