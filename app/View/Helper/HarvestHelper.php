<?php
/**
 * Harvest Helper
 *
 * @package   View.Helper
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
App::uses('AppHelper', 'View/Helper');
App::uses('SiPermission', 'Controller/Component');
/**
 * Harvest Helper
 *
 * Process the harvest helper data
 *
 * @package   View.Helper
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @version   v0.1.0
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 * @since     v0.1.0
 *
 */
class HarvestHelper extends AppHelper
{

    /**
     * App helpers.
     *
     * @var array
     * @access public
     */
    public $helpers
        = array(
           'Html',
           'Form',
          );

    /**
     * User Behaviors.
     *
     * @var array
     * @access public
     */
    public $actsAs
        = array(
           'siCoxi' => array(
                        'values' => array(
                                     'sell_value',
                                     'purchase_value',
                                    ),
                        'prefix' => 'R$ ',
                       )
          );

/*
 * booleanFormat method
 */
    public function booleanFormat($value) {

        $formatedValue = __('No');
        if ($value) {
            $formatedValue = __('Yes');
        }

        return $formatedValue;
    }

/*
 * profit method
 */
    public function profit($purchaseValue, $sellValue) {
        $profit = (float)$this->moneyToDatabase($sellValue) - (float)$this->moneyToDatabase($purchaseValue);
        $profit = 'R$ ' . number_format($profit, 2, ',', '.');

        return $profit; 
    }

/*
 * profit method
 */
    public function moneyToDatabase($value) {
        $value = preg_replace('/(\s|[R\$]|[a-zA-Z])/', '', $value);
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        
        return $value;
    }

    public function website($site) {
        $name = preg_replace('/^http:(.*)|http:\/\/|https:|https:\/\/|\/\//i', '', $site);
        return $this->Html->link($name, 'http://'.$name);
    }


    /**
     * hasPermission
     *
     * Check if has permission
     *
     * @param string $controller Controller name.
     * @param string $action     Action name.
     * @param string $plugin     Plugin name.
     *
     * @return type
     */
    public function hasPermission($controller, $action=null, $plugin=null)
    {
        if (isset($_SESSION['Auth']['User']['group_id']) === true) {
            $permissions = Cache::read('si_permissions_group_'.$_SESSION['Auth']['User']['group_id'], 'long');

            if (isset($plugin) === true) {
                if (isset($permissions['@plugin'][Inflector::camelize($plugin)][$controller][$action]['active']) === true) {
                    return true;
                }
            } else {
                if (isset($permissions['@core'][$controller][$action]['active']) === true) {
                    return true;
                }
            }
        }

        return false;

    }//end hasPermission()


    public function link($title, $url=null, $options=array(), $confirmMessage=false)
    {
        $collection   = new ComponentCollection();
        $siPermission = new SiPermissionComponent($collection);
        $permissions  = $siPermission->check();
        $pluginName   = false;

        if (isset($url['controller']) === false) {
            $url['controller'] = $this->params['controller'];
        }

        if (isset($url['admin']) === true && $url['admin'] === true) {
            $url['action'] = 'admin_'.$url['action'];
        }//end if

        if (isset($url['plugin']) === true) {
            $pluginName = Inflector::camelize($url['plugin']);
        }

        if ((isset($permissions['@core'][$url['controller']][$url['action']]['active']) === true
            && $permissions['@core'][$url['controller']][$url['action']]['active'] === true)
            || (isset($permissions['@plugin'][$pluginName][$url['controller']][$url['action']]['active']) === true
            && $permissions['@plugin'][$pluginName][$url['controller']][$url['action']]['active'] === true)
        ) {
            return $this->Html->link($title, $url, $options, $confirmMessage);
        }

    }//end link()


    public function info($text) {
        return $this->Html->link('<i class="fa fa-info-circle"></i>', '#!',
            array(
                'class' => 'has-popover',
                'data-toggle' => 'popover',
                'data-placement' => 'top',
                'data-content' => __($text),
                'escape' => false
            )
        );
    }

    public function tour($type, $userData) {
        if (isset($userData) === true && ($userData['Business']['tour'] === '1' || (isset($this->params['named']['tour']) === true &&$this->params['named']['tour'] === '1'))) {
            echo $this->Html->script('tour.'.$type);
            $_SESSION['Auth']['User']['Business']['tour'] = 0;
        }
    }

    /**
     * isCnpjName
     *
     * Check if is CNPJ or CPF and prints the name
     *
     * @param string $isCnpj Is cnpj flag.
     *
     * @return string
     */
    public function isCnpjName($isCnpj)
    {
        if ($isCnpj === '0') {
            return __('CPF');
        } else if ($isCnpj === '1') {
            return __('CNPJ');
        } else {
            return __('N/A');
        }

    }//end isCnpjName()


    /**
     * isCnpjValue
     *
     * Check if is CNPJ or CPF and prints the name
     *
     * @param string $isCnpj Is cnpj flag.
     * @param string $value  The value.
     *
     * @return string
     */
    public function isCnpjValue($isCnpj, $value)
    {
        if ($isCnpj === '0') {
            return '<span class="cpf-mask">'.$value.'</span>';
        } else if ($isCnpj === '1') {
            return '<span class="cnpj-mask">'.$value.'</span>';
        } else {
            return __('The client has no CNPJ/CPF');
        }//end if

    }//end isCnpjValue()


    /**
     * cnpjCnpf
     *
     * Prints the CNPJ/CPF radio
     *
     * @param array $data Customer data.
     *
     * @return string
     */
    public function cnpjCnpf($data)
    {
        $isCnpjValue = 1;
        if (isset($data) === true) {
            $isCnpjValue = $data['Customer']['is_cnpj'];
        }//end if
        echo $this->Form->label('is_cnpj', __('Type of Person'));
        echo $this->Form->radio(
            'is_cnpj',
            array(
             '1' => 'CNPJ',
             '0' => 'CPF',
             '2' => 'N/A',
            ),
            array(
             'legend' => false,
             'draft'  => 'is_cnpj',
             'value'  => $isCnpjValue,
             'id'     => 'IsCnpj',
            )
        );

    }//end cnpjCnpf()


    /**
     * isBeta
     *
     * Check if is in beta domain
     *
     * @return boolean
     */
    public function isBeta()
    {
        $url  = $_SERVER['SERVER_NAME'];
        $host = explode('.', $url);
        if (isset($host) === true && is_array($host) === true) {
            $subdomain = $host[0];
            if ($subdomain === 'beta') {
                return true;
            }
        }//end if
        return false;

    }//end isBeta()


    /**
     * PagSeguroStatus
     *
     * Get PagSeguro status code and return string description
     *
     * @param string $status PagSeguro status code.
     *
     * @return string
     */
    public function PagSeguroStatus($status)
    {
        switch ($status) {
            case '1':
                $statusDescription = __('Waiting payment');
                break;
            case '2':
                $statusDescription = __('In analysis');
                break;
            case '3':
                $statusDescription = __('Paid');
                break;
            case '4':
                $statusDescription = __('Available');
                break;
            case '5':
                $statusDescription = __('In Dispute');
                break;
            case '6':
                $statusDescription = __('Refunded');
                break;
            case '7':
                $statusDescription = __('Cancelled');
                break;
            default:
                $statusDescription = __('Being processed');
                break;
        }//end switch

        return $statusDescription;

    }//end PagSeguroStatus()


    /**
     * planPeriod
     *
     * Creates the period radio
     *
     * @param double $value Plan value.
     *
     * @return array
     */
    public function planPeriod($value, $data)
    {
        CakeNumber::addFormat('BRL_2', array('before' => 'R$<span class="price-lg">', 'thousands' => '.', 'decimals' => '</span>,', 'escape' => false));

        switch ($data['type']) {
            case 'Monthly':
                $descriptionOne = __('Total: %s', CakeNumber::currency($value, 'BRL'));
                $descriptionTwo = __('Recurrent');
                $price = CakeNumber::currency($value, 'BRL_2');
                break;
            case 'Semiannual':
                $price          = CakeNumber::currency(($value - ($value * $data['discount'])), 'BRL_2');
                $discount       = (($value * 6) * $data['discount']);
                $total          = (($value * 6) - $discount);
                $descriptionOne = __('Total: %s', CakeNumber::currency($total, 'BRL'));
                $descriptionTwo = __('Save: %s', CakeNumber::currency($discount, 'BRL'));
                break;
            case 'Annual':
                $price          = CakeNumber::currency(($value - ($value * $data['discount'])), 'BRL_2');
                $discount       = (($value * 12) * $data['discount']);
                $total          = (($value * 12) - $discount);
                $descriptionOne = __('Total: %s', CakeNumber::currency($total, 'BRL'));
                $descriptionTwo = __('Save: %s', CakeNumber::currency($discount, 'BRL'));
                break;
            default:
                $notFound = true;
        }//end switch

        if (isset($notFound) === false) {
            return '<label class="btn btn-pay-period">
                <input type="radio" name="period" value="'.$data['type'].'" autocomplete="off">
                <span class="title">'.__($data['type']).'</span>
                <span class="price">'.$price.'</span>
                <span class="description">'.$descriptionOne.'</span>
                <span class="description">'.$descriptionTwo.'</span>
            </label>';
        }

    }//end planPeriod()


}//end class

?>