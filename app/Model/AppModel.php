<?php
/**
 * AppModel Model
 *
 * @package   Model
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
App::uses('Model', 'Model');
App::import('Vendor', 'reCAPTCHA', array('file' => 'reCAPTCHA'.DS.'recaptchalib.php'));
/**
 * App Model
 *
 * App model business rules.
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
class AppModel extends Model
{

    /**
     * Private key for reCAPTCHA.
     *
     * @var $_privatekey
     * @access private
     */
    private $_privatekey = '6Lfq1vsSAAAAAApJX8RYUb5EyyMxDxyXEzvURLbU';

    /**
     * Business model to check.
     *
     * @var $public
     * @access public
     */
    public $checkBusinessId
        = array(
           'Group',
           'User',
           'Category',
           'Customer',
           'Product',
           'Supplier',
           'UnitsMeasure',
           'InputsOutput',
          );

    /**
     * Application behaviors.
     *
     * @var array
     * @access public
     */
    public $actsAs
        = array(
           'SiNany' => array(
                        'values' => array(
                                     'expiration_date',
                                     'created',
                                     'modified',
                                     'movimentation_date',
                                     'adjustment_date',
                                     'due_date'
                                    ),
                        'type'   => 3,
                       ),
           'SiCoxi' => array(
                        'values' => array(
                                     'sell_value',
                                     'purchase_value',
                                     'new_value',
                                     'price',
                                    ),
                        'prefix' => 'R$ ',
                       ),
          );


    /**
     * beforeDelete
     *
     * Not allow exclusions of registers that is in use for another model. Returns false for that case.
     *
     * @param boolean $cascade Cascade delete.
     *
     * @return boolean
     */
    public function beforeDelete($cascade=false)
    {
        $hasKeyHasMany = array_filter($this->hasMany);
        $hasKeyHasAndBelongsToMany = array_filter($this->hasAndBelongsToMany);
        if (empty($hasKeyHasMany) === true && empty($hasKeyHasAndBelongsToMany) === true) {
            return true;
        }//end if
        if (empty($hasKeyHasMany) === false) {
            foreach ($this->hasMany as $key => $value) {
                $result = $this->$key->find('count', array('conditions' => array($this->alias.'.id' => $this->id)));

                if ($result > 0) {
                    return false;
                }
            }
        }

        if (empty($hasKeyHasAndBelongsToMany) === false) {
            foreach ($this->hasAndBelongsToMany as $key => $value) {
                $model  = $this->hasAndBelongsToMany[$key]['with'];
                $field  = $this->hasAndBelongsToMany[$key]['associationForeignKey'];
                $result = $this->{$this->hasAndBelongsToMany[$key]['with']}->find(
                    'count',
                    array(
                     'conditions' => array(
                                      $model.'.'.$field => $this->id,
                                     )
                    )
                );

                if ($result > 0) {
                    return false;
                }
            }
        }

        return true;

    }//end beforeDelete()


    /**
     * beforeFind
     *
     * Before find data.
     *
     * @param array $query Query data.
     *
     * @return array
     */
    public function beforeFind($query)
    {
        if (isset($query['global']) === false) {
            $query['global'] = false;
        }//end if
        $businessId = CakeSession::read('Auth.User.Business.id');
        if (in_array($this->alias, $this->checkBusinessId) === true
            && isset($businessId) === true && $query['global'] === false
        ) {
            $conditions = array($this->alias.'.business_id' => $businessId);
            if (empty($query['conditions']) === true) {
                $query['conditions'] = $conditions;
            } else {
                $query['conditions'] = array_merge($query['conditions'], $conditions);
            }
        }

        return $query;

    }//end beforeFind()


    /**
     * beforeSave
     *
     * Before save data.
     *
     * @param array $options Before save options.
     *
     * @return boolean
     */
    public function beforeSave($options=array())
    {
        $businessId = CakeSession::read('Auth.User.Business.id');
        if (in_array($this->alias, $this->checkBusinessId) === true && isset($businessId) === true) {
            $conditions = array($this->alias.'.business_id' => $businessId);

            $this->data[$this->alias]['business_id'] = $businessId;
        }

        return true;

    }//end beforeSave()


    /**
     * existsAntiHack
     *
     * Check if the user is trying to use hack.
     *
     * @return boolean
     */
    public function existsAntiHack()
    {
        $existGlobal = $this->find(
            'first',
            array(
             'conditions' => array("{$this->alias}.id" => $this->id),
             'global'     => true,
             'recursive'  => 0,
            )
        );
        $exist       = $this->findById($this->id);

        if (($existGlobal === true && empty($exist) === true) || empty($existGlobal) === true) {
            return false;
        }

        return true;

    }//end existsAntiHack()


    /**
     * flag
     *
     * Flag select.
     *
     * @return array
     */
    public function flag()
    {
        $status
            = array(
               1 => __('Yes'),
               0 => __('No'),
              );
        return $status;

    }//end flag()


    /**
     * getList
     *
     * Get list.
     *
     * @return array
     */
    public function getList()
    {
        $empty = array(0 => '-');
        $data  = $this->find('list');
        $data  = array_replace($empty, $data);

        return $data;

    }//end getList()


    /**
     * recaptchaCheck
     *
     * reCAPTCHA check.
     *
     * @param array $data ReCaptcha values.
     *
     * @return boolen
     */
    public function recaptchaCheck($data)
    {
        $result = recaptcha_check_answer(
            $this->_privatekey,
            $_SERVER['REMOTE_ADDR'],
            $_POST['recaptcha_challenge_field'],
            $data['User']['recaptcha']
        );

        if ($result->is_valid === true) {
            return true;
        }//end if
        return false;

    }//end recaptchaCheck()


    /**
     * status
     *
     * Active and inactive select.
     *
     * @param string $empty Empty description.
     *
     * @return array
     */
    public function status($empty='Select an status')
    {
        $status
            = array(
               ' '        => __($empty),
               'Active'   => __('Active'),
               'Inactive' => __('Inactive'),
              );
        return $status;

    }//end status()


    /**
     * saveManyModels
     *
     * Method called by XLS import and save and validate every Models, one by one.
     *
     * @param Model $model  Model.
     * @param Model $models Models.
     *
     * @return type
     */
    public function saveManyModels($model=null, $models=null)
    {
        $ds = $model->getDataSource();
        $ds->begin();
        $errors = null;
        $line   = 2;

        if (isset($models) === true) {
            foreach ($models as $key => $toPersist) {
                $model->create(false);
                $model->set($toPersist);

                if ($model->save($toPersist) === false) {
                    $index = 0;
                    foreach ($model->validationErrors as $key => $erro) {
                        $errors[$index] = __('Error on line %s. Please, verify: ', $line).reset($erro);
                        $index++;
                    }

                    $ds->rollback();

                    break;
                }

                $line++;
            }//end foreach
        }//end if

        if ($errors === null) {
            $ds->commit();
        } else {
            return $errors;
        }

    }//end saveManyModels()


}//end class

?>