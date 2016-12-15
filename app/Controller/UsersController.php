<?php
/**
 * UsersController User Controller
 *
 * @package   Controller
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'PagSeguroLibrary', array('file' => 'PagSeguroLibrary'.DS.'PagSeguroLibrary.php'));
/**
 * User Controller
 *
 * Process the user data and send to view
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
class UsersController extends AppController
{

    /**
     * User Behaviors.
     *
     * @var array
     * @access public
     */
    public $actsAs = array('Permission');

    /**
     * Public key for reCAPTCHA.
     *
     * @var $publickey
     * @access public
     */
    public $publickey = '6Lfq1vsSAAAAAMifjT4PlLkVxGb8oxaTfiA8J6wm';

    /**
     * User components.
     *
     * @var array
     * @access public
     */
    public $components = array('SiStayConnected');

    /**
     * Paginate component.
     *  
     * @var array
     * @access public
     */
    public $paginate = array('limit' => 10);


    /**
     * admin_account
     *
     * User account edit.
     *
     * @throws NotFoundException if the user is not found.
     * @return void
     */
    public function admin_account()
    {
        $this->set('title_for_layout', __('Account'));
        $user = $this->Auth->user();
        if ($this->User->exists($user['id']) === false) {
            throw new NotFoundException(__('Invalid user'));
        }//end if
        if ($this->request->is('post') === true || $this->request->is('put') === true) {
            if ($this->User->checkPassword($user['id'], $this->data) === true) {
                $this->request->data['User']['id']       = $user['id'];
                $this->request->data['User']['group_id'] = $this->Auth->user('group_id');
                $this->request->data = $this->User->changePassword($user, $this->data);
                if ($this->User->save($this->request->data) !== false) {
                    $this->Session->setFlash(__('The user has been saved'), 'flash_success');
                    $this->redirect(array('action' => 'account'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_alert');
                }
            } else {
                $this->Session->setFlash(__('Current password incorrect.'), 'flash_alert');
            }
        } else {
            $this->request->data = $this->User->getAccount($user['id']);
        }//end if
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));

        $this->loadModel('Transaction');
        $transactions = $this->Transaction->get($user['business_id'], 5);
        $this->set(compact('transactions'));

    }//end admin_account()


    /**
     * admin_add
     *
     * Adds a new user.
     *
     * @return void
     */
    public function admin_add()
    {
        $this->set('title_for_layout', __('Add User'));
        if ($this->request->is('post') === true) {
            $this->User->create();
            if ($this->User->save($this->request->data) !== false) {
                $this->Session->setFlash(__('The user has been saved'), 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_alert');
            }
        }//end if
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));

    }//end admin_add()


    /**
     * admin_delete
     *
     * Deletes an user.
     *
     * @param int $id User id.
     *
     * @throws NotFoundException if the user is not found.
     * @return void
     */
    public function admin_delete($id=null)
    {
        $this->User->id = $id;
        if ($this->User->exists() === false) {
            throw new NotFoundException(__('Invalid user'));
        }//end if

        if ($id === '1' || $id === $this->Auth->user('id')) {
            $this->Session->setFlash(__("You don't have permission to delete the user"), 'flash_alert');
            $this->redirect(array('action' => 'index'));
        }//end if

        $this->request->onlyAllow('post', 'delete');

        if ($this->User->delete() === true) {
            $this->Session->setFlash(__('User deleted'), 'flash_success');
            $this->redirect(array('action' => 'index'));
        }//end if
        $this->Session->setFlash(__('User was not deleted'), 'flash_alert');
        $this->redirect(array('action' => 'index'));

    }//end admin_delete()


    /**
     * admin_edit
     *
     * Edits an user.
     *
     * @param int $id User id.
     *
     * @throws NotFoundException if the user is not found.
     * @return void
     */
    public function admin_edit($id=null)
    {
        $this->set('title_for_layout', __('Edit User'));
        if ($this->User->exists($id) === false) {
            throw new NotFoundException(__('Invalid user'));
        }//end if

        if ($id === '1') {
            $this->Session->setFlash(__("You don't have permission to edit the user"), 'flash_alert');
            $this->redirect(array('action' => 'index'));
        }//end if

        if ($this->request->is('post') === true || $this->request->is('put') === true) {
            $this->request->data['User']['id'] = $id;
            if ($this->User->save($this->request->data) !== false) {
                $this->Session->setFlash(__('The user has been saved'), 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_alert');
            }
        } else {
            $options = array('conditions' => array('User.'.$this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }//end if
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));

    }//end admin_edit()


    /**
     * admin_groups_select()
     *
     * Get group select data
     *
     * @return void
     */
    public function admin_groups_select()
    {
        $this->autoRender = false;

        $offset = 0;
        if ($_GET['page'] > 1) {
            $offset = (($_GET['page'] - 1) * $_GET['limit']);
        }

        $countOptions = array();
        $options['fields']
            = array(
               'Group.id',
               'Group.name',
              );
        $options['order']  = 'Group.name ASC';
        $options['offset'] = $offset;
        $options['limit']  = $_GET['limit'];

        if (isset($_GET['term']) === true && empty($_GET['term']) === false) {
            $term = $_GET['term'];
            $countOptions['conditions'] = array('Group.name LIKE' => "%$term%");
            $options['conditions']      = array('Group.name LIKE' => "%$term%");
        }

        $this->User->Group->recursive = 0;
        $count = $this->User->Group->find('count', $countOptions);
        $groups = $this->User->Group->find('all', $options);

        echo json_encode(compact('groups', 'count'));

    }//end admin_groups_select()


    /**
     * admin_groups_select_init
     *
     * Get group selected data
     *
     * @return void
     */
    public function admin_groups_select_init()
    {
        $this->autoRender = false;

        $groups = $this->User->Group->find(
            'first',
            array(
             'fields'     => array(
                              'Group.id',
                              'Group.name',
                             ),
             'conditions' => array('Group.id' => $_GET['id'])
            )
        );

        echo json_encode(compact('groups'));

    }//end admin_groups_select_init()


    /**
     * admin_index
     *
     * List users
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('title_for_layout', __('Users'));
        $this->User->recursive = 0;

        $this->set('users', $this->paginate());
        $groups = $this->User->Group->getList();
        $this->set(compact('groups'));

        parent::admin_table_search();
        $pageCount = $this->params['paging']['User']['pageCount'];
        $this->set(compact('pageCount'));

    }//end admin_index()


    /**
     * admin_login
     *
     * Performs the login.
     *
     * @return void
     */
    public function admin_login()
    {
        $this->set('title_for_layout', __('Login'));
        $myApp = Configure::read('MyApp.name');
        $stayConnectedPassword = $this->SiStayConnected->readData();
        $reCaptchaOk = true;

        if ($this->request->is('post') === true) {
            if (isset($stayConnectedPassword) === true && empty($stayConnectedPassword) === false
                && $this->data['User']['password'] === '********'
            ) {
                $this->request->data['User']['password'] = $stayConnectedPassword;
            }//end if
            if (empty($this->data['User']['email']) === false && empty($this->data['User']['password']) === false) {
                $attempts = $this->User->getAttempts($this->data['User']['email']);

                if ($attempts > 4 && isset($this->data['User']['recaptcha']) === true) {
                    $resp = $this->User->recaptchaCheck($this->data);
                    if (isset($resp) === true && $resp === false) {
                        $reCaptchaOk = false;
                        $this->Session->setFlash(
                            __("The reCAPTCHA wasn't entered correctly. Please, try it again."),
                            'flash_alert'
                        );
                    }
                }//end if
                if ($reCaptchaOk === true && $this->Auth->login() === true) {
                    $this->User->resetAttempt($this->data['User']['email']);
                    $this->_afterLogin();
                } else {
                    $this->SiStayConnected->reset();
                    $attempts = $this->User->incrementAttempt($this->data['User']['email']);
                    if ((int) $attempts > 4) {
                        $this->set('publickey', $this->publickey);
                    }//end if
                    $this->Session->setFlash(__('Your username or password was incorrect.'), 'flash_alert');
                }//end if
            } else {
                $this->User->incrementAttempt($this->data['User']['email']);
                $this->Session->setFlash(__('Your username or password was incorrect.'), 'flash_alert');
            }//end if
        }//end if
        if ($this->Session->read('Auth.User') !== null) {
            $this->Session->setFlash(__('You are logged in!'), 'flash_default');
            $this->redirect('/admin');
        }

    }//end admin_login()


    /**
     * admin_logout
     *
     * Performs the user logout
     *
     * @return void
     */
    public function admin_logout()
    {
        $this->redirect($this->Auth->logout());

    }//end admin_logout()


    /**
     * admin_view
     *
     * User admin view.
     *
     * @param int $id User id.
     *
     * @throws NotFoundException if the user is not found.
     * @return void
     */
    public function admin_view($id=null)
    {
        $this->set('title_for_layout', __('View User'));
        if ($this->User->exists($id) === false) {
            throw new NotFoundException(__('Invalid user'));
        }//end if

        $options = array(
                    'conditions' => array('User.'.$this->User->primaryKey => $id)
                   );
        $this->set('user', $this->User->find('first', $options));

    }//end admin_view()


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
        $this->Auth->allow(
            'register',
            'admin_logout',
            'forgot_password',
            'change_password',
            'verify',
            'send_confirmation'
        );

    }//end beforeFilter()


    /**
     * change_password
     *
     * Change the user's password.
     *
     * @param string $token Change password token.
     *
     * @return void
     */
    public function change_password($token=null)
    {
        $this->set('title_for_layout', __('Change Password'));
        $this->set('simple_footer', true);
        if (isset($token) === true) {
            $decryptedToken = explode(
                '@',
                Security::cipher(hex2bin($token), Configure::read('Security.salt'), 'decrypt')
            );
            $userId         = $decryptedToken[1];
            $groupId        = $decryptedToken[2];
            $decryptedToken = $decryptedToken[0];
        }

        if (($decryptedToken + 2592000) < strtotime(date('Y-m-d H:i:s'))) {
            $this->Session->setFlash(__('The link has expired'), 'flash_alert');
            $this->redirect(
                array(
                 'action'     => 'index',
                 'admin'      => false,
                 'controller' => 'pages',
                )
            );
        }

        $this->loadModel('User');
        if ($this->request->is('post') === true || $this->request->is('put') === true) {
            $this->User->create();
            $this->request->data['User']['id']       = $userId;
            $this->request->data['User']['group_id'] = $groupId;

            $data = $this->User->findById($userId);
            $user = $data['User'];
            $user['Group']    = $data['Group'];
            $user['Business'] = $data['Business'];
            if ($user['email_confirmed'] === '1') {
                $this->request->data['User']['email_confirmed'] = 1;
                if ($this->User->save($this->request->data) !== false) {
                    if ($this->Auth->login($user) === true) {
                        $this->Session->setFlash(__('The password has been saved'), 'flash_success');
                        $this->_afterLogin();
                    }//end if
                } else {
                    $this->Session->setFlash(__('The password could not be saved. Please, try again.'), 'flash_alert');
                }//end if
            } else {
                $this->Session->write('user_email', $user['email']);
                $url = Router::url(
                    array(
                     'controller' => 'users',
                     'action'     => 'send_confirmation',
                     'admin'      => false,
                    )
                );
                $this->Session->setFlash(
                    sprintf(
                        __(
                            'You have not confirmed your email. 
                            <a href="%s">Click here</a> to resend a confirmation email.',
                            $url
                        )
                    )
                );
            }//end if
        }//end if

    }//end change_password()


    /**
     * forgot_password
     *
     * Sends an email to set a new password.
     *
     * @return void
     */
    public function forgot_password()
    {
        $this->set('title_for_layout', __('Forgot Password'));
        $this->set('simple_footer', true);
        if ($this->request->is('post') === true) {
            if (empty($this->data['User']['email']) === false) {
                $userData = $this->User->getUserData(
                    array('email' => $this->data['User']['email'])
                );

                if (Configure::read('MyApp.mode') === 'beta' && empty($user['User']['first_name']) === true) {
                    $this->Session->setFlash(__('Your pre-registration has not yet been released.'), 'flash_alert');
                    $this->redirect(
                        array(
                         'action'     => 'login',
                         'admin'      => true,
                         'controller' => 'users',
                        )
                    );
                }

                if (empty($userData) === false) {
                    if ($this->User->sendEmailChangePassword($userData) === true) {
                        $this->Session->setFlash(
                            __(
                                'An email was sent to %s',
                                $this->data['User']['email']
                            ),
                            'flash_info'
                        );
                        $this->redirect(
                            array(
                             'action'     => 'login',
                             'admin'      => true,
                             'controller' => 'users',
                            )
                        );
                    }
                } else {
                    $this->Session->setFlash(__('The email was not found. Please, try again.'), 'flash_alert');
                }//end if
            } else {
                $this->Session->setFlash(__('Please, enter an email.'), 'flash_alert');
            }//end if
        }//end if

    }//end forgot_password()


    /**
     * register
     *
     * Register a new user
     *
     * @return void
     */
    public function register()
    {
        $this->set('title_for_layout', __('Register'));
        $this->set('simple_footer', true);
        $this->set('publickey', $this->publickey);

        if ($this->request->is('post') === true || $this->request->is('put') === true) {
            $this->request->data = $this->User->beforeRegister($this->data);
            if ($this->User->saveAll($this->request->data, array('deep' => true)) !== false) {
                $this->User->afterRegister($this->request->data);
                if (Configure::read('MyApp.mode') !== 'beta') {
                    $this->Session->setFlash(
                        __('Your account has been created. Please, check your email for confirmation.'),
                        'flash_success'
                    );
                    $this->redirect('/login');
                } else {
                    $this->Session->setFlash(
                        __('Thank you! Pre-registration done.'),
                        'flash_success'
                    );
                    $this->redirect('/register');
                }
            } else {
                $this->Session->setFlash(__('The account could not be created. Please, try again.'), 'flash_alert');
            }//end if
        }//end if

    }//end register()


    /**
     * send_confirmation
     *
     * Resend the confirmation email.
     *
     * @return void
     */
    public function send_confirmation()
    {
        $this->autoRender = false;
        $email = $this->Session->read('user_email');
        if (empty($email) === false) {
            $results = $this->User->getByEmail($email);
            if (empty($results) === false) {
                $this->User->setEmailToken($results);
                $this->User->sendEmailConfirmation($results);
                $this->User->save($results);

                $this->Session->setFlash(__('The link has been sent. Please, check your e-mail.'), 'flash_success');
                $this->redirect('/admin');
            } else {
                $this->Session->setFlash(__('Email not found.'), 'flash_alert');
                $this->redirect('/login');
            }//end if
        } else {
            $this->Session->setFlash(
                __('An error has occurred. If the error persists, please contact support.'),
                'flash_alert'
            );
            $this->redirect('/login');
        }

    }//end send_confirmation()


    /**
     * verify
     *
     * Verify the user through confirmation e-mail.
     *
     * @return type
     */
    public function verify()
    {
        $this->autoRender = false;
        if (empty($this->passedArgs['n']) === false && empty($this->passedArgs['t']) === false) {
            $email     = $this->passedArgs['n'];
            $tokenhash = $this->passedArgs['t'];
            $results   = $this->User->getByEmail($email);

            if (isset($results['User']['email_confirmed']) === true) {
                if ($results['User']['email_confirmed'] === '0') {
                    if ($results['User']['email_token'] === $tokenhash) {
                        $date  = $results['User']['email_token_expires'];
                        $today = date('Y-m-d H:i:s');

                        if (strtotime($date) < strtotime($today)) {
                            $url = Router::url(
                                array(
                                 'controller' => 'users',
                                 'action'     => 'send_confirmation',
                                 'admin'      => false,
                                )
                            );
                            $this->Session->write('user_email', $email);
                            $this->Session->setFlash(
                                sprintf(
                                    __(
                                        'Sorry, this link is expired. <a href="%s">Click here</a> to get a new one.',
                                        $url
                                    )
                                )
                            );
                            $this->redirect('/login');
                        } else {
                            $results['User']['email_confirmed']     = 1;
                            $results['User']['email_token']         = null;
                            $results['User']['email_token_expires'] = null;
                            if ($this->User->save($results) !== false) {
                                $this->Session->setFlash(__('Your registration is complete'), 'flash_success');
                                $data = $this->User->findById($results['User']['id']);
                                $user = $data['User'];
                                $user['Group']    = $data['Group'];
                                $user['Business'] = $data['Business'];
                                if ($this->Auth->login($user) === true) {
                                    $this->_afterLogin();
                                }
                            } else {
                                $this->redirect('/login');
                            }
                        }//end if
                    } else {
                        $this->Session->setFlash(
                            __('An error has occurred. If the error persists, please contact support.'),
                            'flash_alert'
                        );
                        $this->redirect('/login');
                    }//end if
                } else {
                    $this->Session->setFlash(__('Your account already been confirmed'), 'flash_info');
                    $this->redirect('/login');
                }//end if
            } else {
                $this->Session->setFlash(
                    __('The account could not be activated. The email does not exist.'),
                    'flash_alert'
                );
                $this->redirect('/login');
            }//end if
        }//end if

    }//end verify()


    /**
     * afterLogin
     *
     * Executed after login.
     *
     * @return void
     */
    private function _afterLogin()
    {
        $user = $this->Auth->user();
        if ($user['email_confirmed'] === '1') {
            $this->SiStayConnected->writeData($this->data);
            $modules = $this->User->Business->Plan->getModules($user['Business']['plan_id']);
            $this->Session->write('Auth.User.Modules', $modules['ModulesPlan']);
            if ($user['Business']['tour'] === '1') {
                $this->User->Business->updateTour(0, $user['Business']['id']);
            }//end if
            $this->redirect('/admin');
        } else {
            $this->Auth->logout();
            $this->Session->write('user_email', $this->request->data['User']['email']);
            $url = Router::url(
                array(
                 'controller' => 'users',
                 'action'     => 'send_confirmation',
                 'admin'      => false,
                )
            );
            $this->Session->setFlash(
                sprintf(
                    __(
                        'Please, access your e-mail to active the user or 
                        <a href="%s">click here</a> to get a new link',
                        $url
                    )
                )
            );
        }//end if

    }//end _afterLogin()


}//end class

?>