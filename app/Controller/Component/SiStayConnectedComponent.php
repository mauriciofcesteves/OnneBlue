<?php
/**
 * SiStayConnected Component
 *
 * Performs automatic connection
 *
 * @package   Component
 * @author    Renato França <ceo@sicoode.com>
 * @copyright 2014 Sicoode
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @version   v1.1.1
 * @link      http://sicoode.com Sicoode
 * @since     v0.1.0
 *
 */
class SiStayConnectedComponent extends Component
{

    /**
     * SiStayConnected components.
     *
     * @var array Cookies Component that allows to use cookies
     * @access public
     */
    public $components = array('Session');


    /**
     * startup
     *
     * Component startup
     *
     * @param Controller $controller Controller object.
     *
     * @return void
     */
    public function startup(Controller $controller=null)
    {
        if ($controller === false) {
            $controller = new Controller(new CakeRequest());
        }//end if
        $this->controller = $controller;

    }//end startup()


    /**
     * readData
     *
     * Read the connection data
     *
     * @return string
     */
    public function readData()
    {
        $myApp = Configure::read('MyApp.name');
        $stayConnected = $this->Session->read($myApp.'.User');
        $this->controller->set('stayConnectedEmail', $stayConnected['email']);
        $this->controller->set('stayConnectedRememberMe', $stayConnected['remember_me']);
        $stayConnectedPassword = '';
        if (isset($stayConnected['password']) === true && empty($stayConnected['password']) === false) {
            $stayConnectedPassword = '********';
        }//end if
        $this->controller->set('stayConnectedPassword', $stayConnectedPassword);
        $this->Session->delete('siMarta.User');

        return $stayConnected['password'];

    }//end readData()


    /**
     * writeData
     *
     * Write the connection data
     *
     * @param array $data User data.
     *
     * @return void
     */
    public function writeData($data)
    {
        $myApp = Configure::read('MyApp.name');
        $stayConnected = $this->Session->read($myApp.'.User');

        if (isset($data['User']['remember_me']) === true && $data['User']['remember_me'] === '1') {
            $stayConnectedData = array(
                                  'User' => array(
                                             'email'       => $data['User']['email'],
                                             'password'    => $data['User']['password'],
                                             'remember_me' => true,
                                            )
                                 );
            $this->Session->write($myApp, $stayConnectedData, false);
        } else {
            $this->reset();
        }

    }//end writeData()


    /**
     * reset
     *
     * Reset the connection data
     *
     * @return void
     */
    public function reset()
    {
        $myApp = Configure::read('MyApp.name');
        $this->Session->write($myApp, null);

    }//end reset()


}//end class

?>