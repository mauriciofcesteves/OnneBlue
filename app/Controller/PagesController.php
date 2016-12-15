<?php
/**
 * PagesController Page Controller
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
/**
 * Page Controller
 *
 * Process the page data and send to view
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
class PagesController extends AppController
{

    /**
     * This controller does not use a model
     *
     * @var $uses
     * @access public
     */
    public $uses = array();

    /**
     * Pages components.
     *
     * @var array
     * @access public
     */
    public $components = array('SiStayConnected');


    /**
     * about
     *
     * About public page.
     *
     * @return void
     */
    public function about()
    {
        $this->set('title_for_layout', __('About'));
        $this->seo_description = __('We developed OnneBlue to fit your needs.');
        $this->seo_keywords    = __('about, manage, analyze, make decisions, business, simplicity, system, mobile');

    }//end about()


    /**
     * admin_contact
     *
     * Contact public page.
     *
     * @return void
     */
    public function admin_contact()
    {
        $this->set('title_for_layout', __('Contact'));
        $this->SiLanguage->setLanguage();
        if ($this->request->is('post') === true) {
            $this->loadModel('Contact');
            $this->Contact->set($this->data);
            if ($this->Contact->validates() === true) {
                $user = $this->Auth->user();
                $this->request->data['Contact']['name']  = $user['name'];
                $this->request->data['Contact']['email'] = $user['email'];
                if ($this->Contact->send($this->request->data) === true) {
                    $this->Session->setFlash(
                        __('Email sent successfully'),
                        'flash_info'
                    );
                    $this->redirect(
                        array(
                         'action'     => 'contact',
                         'admin'      => true,
                         'controller' => 'pages',
                        )
                    );
                }//end if
            } else {
                $this->Session->setFlash(__('The email could not be sent. Please, try again.'), 'flash_alert');
            }//end if
        }//end if

    }//end admin_contact()


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
        $this->Auth->allow();

    }//end beforeFilter()


    /**
     * contact
     *
     * Contact public page.
     *
     * @return void
     */
    public function contact()
    {
        $this->set('title_for_layout', __('Contact'));
        $this->seo_description = __('Contact us');
        $this->seo_keywords    = __('contact, manage, analyze, make decisions, business, simplicity, system, mobile');
        $this->set('simple_footer', true);
        $this->SiLanguage->setLanguage();
        if ($this->request->is('post') === true) {
            $this->loadModel('Contact');
            $this->Contact->set($this->data);
            if ($this->Contact->validates() === true) {
                if ($this->Contact->send($this->request->data) === true) {
                    $this->Session->setFlash(
                        __('Email sent successfully'),
                        'flash_info'
                    );
                    $this->redirect(
                        array(
                         'action'     => 'contact',
                         'admin'      => false,
                         'controller' => 'pages',
                        )
                    );
                }//end if
            } else {
                $this->Session->setFlash(__('The email could not be sent. Please, try again.'), 'flash_alert');
            }//end if
        }//end if

    }//end contact()


    /**
     * index
     *
     * Initial public page.
     *
     * @return void
     */
    public function index()
    {
        $this->set('title_for_layout', 'OnneBlue');
        $this->SiStayConnected->readData();
        $user = $this->Auth->user();

        if (empty($user) === false) {
            $this->redirect('/admin');
        }

    }//end index()


    /**
     * language
     *
     * Language public page
     *
     * @param string $language System language.
     *
     * @return void
     */
    public function language($language)
    {
        $this->set('title_for_layout', __('Language'));

        $currentUrl = $this->referer(array('action' => 'index'));
        $referer    = $this->SiLanguage->changeLanguage($language, $currentUrl);

        $this->redirect($referer);

    }//end language()


    /**
     * prices
     *
     * Prices page.
     *
     * @return void
     */
    public function prices()
    {
        $this->set('title_for_layout', __('Prices'));
        $this->seo_description = __('Transform the way you manage your business');
        $this->seo_keywords    = __('prices, manage, analyze, make decisions, business, simplicity, system, mobile');
        $this->loadModel('Plan');
        $this->set('plans', $this->Plan->getPlans());

    }//end prices()


    /**
     * tour
     *
     * Tour public page.
     *
     * @return void
     */
    public function tour()
    {
        $this->set('title_for_layout', __('Tour'));
        $this->seo_description = __('Learn a little of the system');
        $this->seo_keywords    = __('tour, manage, analyze, make decisions, business, simplicity, system, mobile');

    }//end tour()


}//end class

?>