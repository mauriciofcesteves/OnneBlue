<?php
/**
 * Group Model
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
 * Group Model
 *
 * Group model business rules.
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
class Group extends AppModel
{

    /**
     * Application behaviors.
     *
     * @var array
     * @access public
     */
    public $actsAs
        = array('Acl' => array('type' => 'requester'));

    /**
     * Association hasMany.
     *
     * @var array
     * @access public
     */
    public $hasMany = array('User');

    /**
     *  validations.
     *
     * @var array
     * @access public
     */
    public $validate
        = array(
           'name' => array(
                      'notempty' => array(
                                     'rule'    => array('notempty'),
                                     'message' => 'Please enter a name',
                                    ),
                      'unique'   => array(
                                     'rule'    => 'isUnique',
                                     'message' => 'This group name has already been taken',
                                    ),
                     ),
          );


    /**
     * beforeDelete
     *
     * Called before the register delete.
     *
     * @param boolean $cascade Delete cascade.
     *
     * @return void
     */
    public function beforeDelete($cascade=false)
    {
        $count = $this->User->find(
            'count',
            array(
             'conditions' => array('User.group_id' => $this->id)
            )
        );

        if ($count === 0) {
            return true;
        } else {
            return false;
        }

    }//end beforeDelete()


    /**
     * parentNode
     *
     * Used for Auth component.
     *
     * @return null
     */
    public function parentNode()
    {
        return null;

    }//end parentNode()


}//end class

?>