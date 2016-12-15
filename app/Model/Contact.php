<?php
/**
 * Contact Model
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
 * Contact Model
 *
 * Contact model business rules.
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
class Contact extends AppModel
{

    /**
     * Table entity.
     *
     * @var boolena
     * @access public
     */
    public $useTable = false;

    /**
     * Contact validations.
     *
     * @var array
     * @access public
     */
    public $validate
        = array(
           'name'    => array(
                         'notempty' => array(
                                        'rule'    => array('notempty'),
                                        'message' => 'The name is required',
                                       ),
                        ),
           'email'   => array(
                         'notempty' => array(
                                        'rule'    => array('notempty'),
                                        'message' => 'The email is required',
                                       ),
                         'email'    => array(
                                        'rule'    => array(
                                                      'email',
                                                      true,
                                                     ),
                                        'message' => 'Not a valid email',
                                       ),
                        ),
           'subject' => array(
                         'notempty' => array(
                                        'rule'    => array('notempty'),
                                        'message' => 'Subject is required',
                                       ),
                        ),
           'message' => array(
                         'notempty' => array(
                                        'rule'    => array('notempty'),
                                        'message' => 'Message is required',
                                       ),
                        ),
          );


    /**
     * send
     *
     * Send a contact email.
     *
     * @param array $data Contact form data.
     *
     * @return boolean
     */
    public function send($data)
    {
        $Email = new CakeEmail();
        $Email->config('contact');
        $Email->viewVars(
            array('title' => __('Contact'))
        );
        $Email->from(array($data['Contact']['email'] => $data['Contact']['name']));
        $Email->subject(__('[OnneBlue Contact] ').$data['Contact']['subject']);
        $Email->send();

        return true;

    }//end send()


}//end class

?>