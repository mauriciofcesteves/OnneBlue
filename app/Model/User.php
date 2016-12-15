<?php
/**
 * AppModel User Model
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
 * User Model
 *
 * User model business rules.
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
class User extends AppModel
{

    /**
     * Association belongsTo.
     *
     * @var array
     * @access public
     */
    public $belongsTo
        = array(
           'Group',
           'Business',
          );

    /**
     * Application behaviors.
     *
     * @var array
     * @access public
     */
    public $actsAs
        = array('Acl' => array('type' => 'requester', 'enabled' => false));

    /**
     * Application virtual fields.
     *
     * @var array
     * @access public
     */
    public $virtualFields = array('name' => "CONCAT(User.first_name, ' ', User.last_name)");

    /**
     * User validations.
     *
     * @var array
     * @access public
     */
    public $validate
        = array(
           'first_name' => array(
                            'notempty'  => array(
                                            'rule'    => array('notempty'),
                                            'message' => 'Please enter a first name',
                                           ),
                            'minLength' => array(
                                            'rule'    => array(
                                                          'minLength',
                                                          2,
                                                         ),
                                            'message' => 'Minimum 2 characters long',
                                           )
                           ),
           'last_name'  => array(
                            'notempty'  => array(
                                            'rule'    => array('notempty'),
                                            'message' => 'Please enter a last name',
                                           ),
                            'minLength' => array(
                                            'rule'    => array(
                                                          'minLength',
                                                          2,
                                                         ),
                                            'message' => 'Minimum 2 characters long',
                                           )
                           ),
           'email'      => array(
                            'unique'     => array(
                                             'rule'    => 'isUnique',
                                             'message' => 'This email has already been taken',
                                            ),
                            'uniqueEdit' => array(
                                             'rule'    => 'isUniqueEdit',
                                             'message' => 'This email has already been taken',
                                            ),
                            'notempty'   => array(
                                             'rule'    => array('notempty'),
                                             'message' => 'Please enter an email',
                                            ),
                            'minLength'  => array(
                                             'rule'    => array(
                                                           'minLength',
                                                           4,
                                                          ),
                                             'message' => 'Minimum 4 characters long',
                                            ),
                            'email'      => array(
                                             'rule'    => array(
                                                           'email',
                                                           true,
                                                          ),
                                             'message' => 'Please supply a valid email address',
                                            )
                           ),
           'password'   => array(
                            'notempty'  => array(
                                            'rule'    => array('notempty'),
                                            'message' => 'Please enter a password',
                                           ),
                            'minLength' => array(
                                            'rule'    => array(
                                                          'minLength',
                                                          6,
                                                         ),
                                            'message' => 'Minimum 6 characters long',
                                           )
                           ),
           'repassword' => array(
                            'notempty' => array(
                                           'rule'    => array('notempty'),
                                           'message' => 'Please enter a confirm password',
                                          ),
                            'equal'    => array(
                                           'rule'    => array('equalPassword'),
                                           'message' => 'Password do not match',
                                          )
                           ),
           'newpass'    => array(
                            'notempty'  => array(
                                            'rule'    => array('notempty'),
                                            'message' => 'Please enter a password',
                                           ),
                            'minLength' => array(
                                            'rule'    => array(
                                                          'minLength',
                                                          6,
                                                         ),
                                            'message' => 'Minimum 6 characters long',
                                           )
                           ),
           'newrepass'  => array(
                            'notempty' => array(
                                           'rule'    => array('notempty'),
                                           'message' => 'Please enter a confirm password',
                                          ),
                            'equal'    => array(
                                           'rule'    => array('equalNewPassword'),
                                           'message' => 'Password do not match',
                                          )
                           ),
           'group_id'   => array(
                            'numeric' => array(
                                          'rule'     => array('numeric'),
                                          'message'  => 'Please select a group',
                                          'required' => true,
                                         ),
                           ),
           'recaptcha'  => array(
                            'notempty'  => array(
                                            'rule'    => array('notempty'),
                                            'message' => 'Please enter the reCAPTCHA',
                                           ),
                            'recaptcha' => array(
                                            'rule'    => array('recaptcha'),
                                            'message' => "The reCAPTCHA wasn't entered correctly.",
                                           )
                           )
          );


    /**
     * recaptcha
     *
     * reCAPTCHA check.
     *
     * @return boolen
     */
    public function recaptcha()
    {
        $result = $this->recaptchaCheck($this->data);

        if ($result === true) {
            return true;
        }//end if
        return false;

    }//end recaptcha()


    /**
     * changePassword
     *
     * Check the user password.
     *
     * @param array $user User data.
     * @param array $data Account data.
     *
     * @return boolen
     */
    public function changePassword($user, $data)
    {
        if (empty($data['User']['newpass']) === true && empty($data['User']['repassword']) === true) {
            unset($data['User']['newpass']);
            unset($data['User']['newrepass']);
        }//end if

        return $data;

    }//end changePassword()


    /**
     * checkPassword
     *
     * Check the user password.
     *
     * @param int   $id   User id.
     * @param array $data Account data.
     *
     * @return boolen
     */
    public function checkPassword($id, $data)
    {
        $user = $this->find(
            'first',
            array(
             'conditions' => array('User.id' => $id),
             'fields'     => array(
                              'id',
                              'password',
                             )
            )
        );
        if ($user['User']['password'] === AuthComponent::password($data['User']['password'])) {
            return true;
        }//end if
        return false;

    }//end checkPassword()


    /**
     * isUniqueEdit
     *
     * Check if the email already exists
     *
     * @param string $email User's email.
     *
     * @return boolean
     */
    public function isUniqueEdit($email)
    {
        if (isset($_SESSION['Auth']['User']['email']) === true && empty($_SESSION['Auth']['User']['email']) === false) {
            $hasEmail = $this->find(
                'first',
                array(
                 'fields'     => array('email'),
                 'conditions' => array('User.email' => $email['email']),
                 'global'     => true,
                )
            );
            if (empty($hasEmail) === true || $email['email'] === $_SESSION['Auth']['User']['email']) {
                $_SESSION['Auth']['User']['email'] = $email['email'];
                return true;
            }//end if
            return false;
        } else {
            return true;
        }

    }//end isUniqueEdit()


    /**
     * equalNewPassword
     *
     * Check if the passwords are equals
     *
     * @param string $password New password to check.
     *
     * @return boolean
     */
    public function equalNewPassword($password)
    {
        if ($this->data['User']['newpass'] === $this->data['User']['newrepass']) {
            return true;
        }//end if
        return false;

    }//end equalNewPassword()


    /**
     * equalPassword
     *
     * Check if the passwords are equals
     *
     * @param string $password Password to check.
     *
     * @return boolean
     */
    public function equalPassword($password)
    {
        if (($this->data['User']['password'] === $this->data['User']['repassword'])
            || isset($this->data['User']['repassword']) === false
        ) {
            return true;
        }//end if
        return false;

    }//end equalPassword()


    /**
     * afterRegister
     *
     * Call functions after user registration.
     *
     * @param array $data Register form data.
     *
     * @return void
     */
    public function afterRegister($data)
    {
        if (Configure::read('MyApp.mode') !== 'beta') {
            $this->sendEmailConfirmation($data);
        } else {
            $this->sendEmailPreRegistration($data);
        }

    }//end afterRegister()


    /**
     * beforeRegister
     *
     * Call functions before user registration.
     *
     * @param array $data Register form data.
     *
     * @return array
     */
    public function beforeRegister($data)
    {
        $this->setGroupId($data);
        $this->setEmailToken($data);
        $this->setPlan($data);
        return $data;

    }//end beforeRegister()


    /**
     * beforeSave
     *
     * Function executed after model data validation.
     *
     * @param array $options Save options.
     *
     * @return boolean
     */
    public function beforeSave($options=array())
    {
        parent::beforeSave();
        if (empty($this->data['User']['password']) === false) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }//end if
        if (isset($this->data['User']['newpass']) === true && isset($this->data['User']['newrepass']) === true) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['newpass']);
        }//end if
        return true;

    }//end beforeSave()


    /**
     * getByEmail
     *
     * Get user by email
     *
     * @param string $email User's email.
     *
     * @return array
     */
    public function getByEmail($email)
    {
        return $this->find(
            'first',
            array(
             'fields'     => array(
                              'User.id',
                              'User.group_id',
                              'User.business_id',
                              'User.email',
                              'User.email_confirmed',
                              'User.email_token',
                              'User.email_token_expires',
                              'User.first_name',
                              'User.last_name',
                             ),
             'conditions' => array('User.email' => $email)
            )
        );

    }//end getByEmail()


    /**
     * getUserData
     *
     * Get the user data.
     *
     * @param array $conditions Find conditions.
     *
     * @return type
     */
    public function getUserData($conditions=array())
    {
        return $this->find(
            'first',
            array(
             'conditions' => array($conditions)
            )
        );

    }//end getUserData()


    /**
     * getAccount
     *
     * Get the user data for account.
     *
     * @param int $id User id.
     *
     * @return type
     */
    public function getAccount($id)
    {
        return $this->find(
            'first',
            array(
             'conditions' => array('User.id' => $id),
             'fields'     => array(
                              'User.id',
                              'User.first_name',
                              'User.last_name',
                              'User.email',
                             )
            )
        );

    }//end getAccount()


    /**
     * getAttempt
     *
     * Get access attempt quantity
     *
     * @param string $email User email.
     *
     * @return int
     */
    public function getAttempts($email)
    {
        $user = $this->find(
            'first',
            array(
             'fields'     => array(
                              'User.email',
                              'User.access_attempts',
                             ),
             'conditions' => array('User.email' => $email)
            )
        );

        if (isset($user['User']['access_attempts']) === true) {
            return (int) $user['User']['access_attempts'];
        }

    }//end getAttempts()


    /**
     * incrementAttempt
     *
     * Increments access attempt to prevent brute force
     *
     * @param string $email User email.
     *
     * @return int
     */
    public function incrementAttempt($email)
    {
        if (empty($email) === false) {
            $user = $this->find(
                'first',
                array(
                 'fields'     => array(
                                  'User.email',
                                  'User.access_attempts',
                                 ),
                 'conditions' => array('User.email' => $email)
                )
            );

            if (empty($user) === false) {
                $this->updateAll(
                    array(
                     'User.access_attempts' => ((int) $user['User']['access_attempts'] + 1),
                     'User.last_attempt'    => "'".date('Y-m-d H:i:s')."'",
                    ),
                    array('User.email' => $user['User']['email'])
                );

                return ($user['User']['access_attempts'] + 1);
            } else {
                return true;
            }//end if

        }//end if

    }//end incrementAttempt()


    /**
     * parentNode
     *
     * Used for CakePHP ACL to determine childs relationships permission.
     *
     * @return array
     */
    public function parentNode()
    {
        if ($this->id === false && empty($this->data) === true) {
            return null;
        }//end if

        if (isset($this->data['User']['group_id']) === true) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }//end if

        if ($groupId === false) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }//end if

    }//end parentNode()


    /**
     * bindNode
     *
     * For permissions
     *
     * @param array $user User data.
     *
     * @return array
     */
    public function bindNode($user)
    {
        return array(
                'model'       => 'Group',
                'foreign_key' => $user['User']['group_id'],
               );

    }//end bindNode()


    /**
     * resetAttempt
     *
     * Reset access attempt to prevent brute force
     *
     * @param string $email User email.
     *
     * @return int
     */
    public function resetAttempt($email)
    {
        if (empty($email) === false) {
            $user = $this->find(
                'first',
                array(
                 'fields' => array(
                              'User.email',
                              'User.access_attempts',
                             )
                ),
                array(
                 'conditions' => array('User.email' => $email)
                )
            );

            if (empty($user) === false) {
                $this->updateAll(
                    array(
                     'User.access_attempts' => (int) 0,
                    ),
                    array('User.email' => $user['User']['email'])
                );

                return $user['User']['access_attempts'];
            }//end if

        }//end if

    }//end resetAttempt()


    /**
     * sendEmailChangePassword
     *
     * Send an email for set a new password
     *
     * @param array $data User data.
     *
     * @return boolean
     */
    public function sendEmailChangePassword($data)
    {
        $token = bin2hex(
            Security::cipher(
                strtotime(date('Y-m-d H:i:s')).'@'.$data['User']['id'].'@'.$data['User']['group_id'],
                Configure::read('Security.salt'),
                'encrypt'
            )
        );

        $Email = new CakeEmail();
        $Email->config('onneBlue');
        $Email->template('change_password');
        $Email->viewVars(
            array(
             'name'  => $data['User']['name'],
             'email' => $data['User']['email'],
             'title' => __('Change Password'),
             'token' => $token,
            )
        );
        $Email->to(array($data['User']['email'] => $data['User']['name']));
        $Email->subject(__('Change Password'));
        $Email->send();

        return true;

    }//end sendEmailChangePassword()


    /**
     * sendEmailConfirmation
     *
     * Send an email confirmation.
     *
     * @param array &$data Register form data.
     *
     * @return void
     */
    public function sendEmailConfirmation(&$data)
    {
        $Email = new CakeEmail();
        $Email->config('gmail');
        $Email->template('account_confirmation');
        $Email->viewVars(
            array(
             'name'     => $data['User']['first_name'],
             'hash'     => $data['User']['email_token'],
             'username' => $data['User']['email'],
            )
        );
        $Email->to(array($data['User']['email'] => $data['User']['first_name'].' '.$data['User']['last_name']));
        $Email->subject(__('Account Confirmation'));
        $Email->send();

    }//end sendEmailConfirmation()


    /**
     * sendEmailPreRegistration
     *
     * Send an email of pre-registration.
     *
     * @param array &$data Register form data.
     *
     * @return void
     */
    public function sendEmailPreRegistration(&$data)
    {
        $Email = new CakeEmail();
        $Email->config('gmail');
        $Email->template('account_pre_registration');
        $Email->viewVars(
            array('username' => $data['User']['email'])
        );
        $Email->to(array($data['User']['email']));
        $Email->subject(__('Account Pre-Registration'));
        $Email->send();

    }//end sendEmailPreRegistration()


    /**
     * setEmailToken
     *
     * Creates a token that will be send from email to confirmation the user.
     *
     * @param array &$data Register form data.
     *
     * @return void
     */
    public function setEmailToken(&$data)
    {
        $hash = Security::hash(strtotime(date('Y-m-d H:i:s'))).Security::hash($data['User']['email']);
        $data['User']['email_token'] = $hash;
        $tomorrow = date('Y-m-d H:i:s', (time() + 86400));
        $data['User']['email_token_expires'] = $tomorrow;
        $data['User']['email_confirmed']     = false;

    }//end setEmailToken()


    /**
     * setGroupId
     *
     * Set the group id for new user. Group id 2 for Owner.
     *
     * @param array &$data Register form data.
     *
     * @return type
     */
    public function setGroupId(&$data)
    {
        $data['User']['group_id'] = 2;

    }//end setGroupId()


    /**
     * setPlan
     *
     * Set the user's plan.
     *
     * @param array &$data Register form data.
     *
     * @return void
     */
    public function setPlan(&$data)
    {
        $data['Business']['plan_id'] = 1;

    }//end setPlan()


    /**
     * addUser
     *
     * Adds one or more users
     *
     * @param int $quantity   Quantity of users.
     * @param int $businessId Business id.
     * @param int $groupId    Group id.
     *
     * @return type
     */
    public function addUser($quantity, $businessId, $groupId)
    {
        $update = $this->Business->updateAll(
            array('Business.additional_users' => "Business.additional_users + $quantity"),
            array('Business.id' => $businessId)
        );

        $totalUsers = $this->Business->User->find(
            'count',
            array(
             'conditions' => array('User.business_id' => $businessId)
            )
        );

        if ($update === true) {
            for ($i = 0; $i < $quantity; $i++) {
                $data
                    = array(
                       'User' => array(
                                  'group_id'    => $groupId,
                                  'business_id' => $businessId,
                                  'first_name'  => __('Additional'),
                                  'last_name'   => __('User'),
                                  'email'       => __('user@additional%s.com', ($totalUsers + $i)),
                                  'password'    => '0nN3!3luE_',
                                  'repassword'  => '0nN3!3luE_',
                                 )
                      );
                $this->save($data);
            }//end for
        }//end if

    }//end addUser()


}//end class

?>