<?php
/**
 * SiLanguage Component
 *
 * @package   Controller.Component
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
class SiLanguageComponent extends Component
{

    /**
     * User components.
     *
     * @var array
     * @access public
     */
    public $components = array('Session');


    /**
     * setLanguage
     *
     * Sets the OnneBlue language
     *
     * @return array
     */
    public function setLanguage()
    {
        $acceptLanguages = array('pt-br');
        $browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $sessionLanguage = $this->Session->read('onneblue_language');
        $urlLanguage     = explode('.', $_SERVER['SERVER_NAME']);

        if (isset($sessionLanguage) === false && in_array($urlLanguage[0], $acceptLanguages) === false) {
            $language = $browserLanguage;
        } else if (isset($sessionLanguage) === true && in_array($urlLanguage[0], $acceptLanguages) === false) {
            $language = $sessionLanguage;
        } else {
            if (isset($urlLanguage[0]) === true) {
                $language = $urlLanguage[0];
            }//end if
        }//end if

        $siLanguage = array();
        switch ($language) {
            case 'eng':
            case 'en':
                $siLanguage['iso-639-1'] = 'eng';
                $siLanguage['iso-639-2'] = 'en';
                $siLanguage['lang']      = 'en';
                $siLanguage['name']      = 'English';
                break;
            case 'por':
            case 'pt':
            case 'pt-br':
                $siLanguage['iso-639-1'] = 'por';
                $siLanguage['iso-639-2'] = 'pt';
                $siLanguage['lang']      = 'pt-br';
                $siLanguage['name']      = 'Português';
                break;
            default:
                $siLanguage['iso-639-1'] = 'por';
                $siLanguage['iso-639-2'] = 'pt';
                $siLanguage['lang']      = 'pt-br';
                $siLanguage['name']      = 'Português';
                break;
        }//end switch
        Configure::write('Config.language', $siLanguage['iso-639-1']);

        return $siLanguage;

    }//end setLanguage()


    /**
     * changeLanguage
     *
     * Changes the OnneBlue language
     *
     * @param string $language   Language
     * @param string $currentUrl Current Url
     *
     * @return string
     */
    public function changeLanguage($language, $currentUrl)
    {
        $siLanguage = array();
        switch ($language) {
            case 'eng':
                $siLanguage['iso-639-1'] = 'eng';
                $siLanguage['iso-639-2'] = 'en';
                $siLanguage['lang']      = 'en';
                $siLanguage['name']      = 'English';
                break;
            case 'por':
                $siLanguage['iso-639-1'] = 'por';
                $siLanguage['iso-639-2'] = 'pt';
                $siLanguage['lang']      = 'pt-br';
                $siLanguage['name']      = 'Português';
                break;
            default:
                $siLanguage['iso-639-1'] = 'por';
                $siLanguage['iso-639-2'] = 'pt';
                $siLanguage['lang']      = 'pt-br';
                $siLanguage['name']      = 'Português';
                break;
        }//end switch

        $this->Session->write('onneblue_language', $siLanguage['iso-639-1']);
        $referer = $currentUrl;

        return $referer;

    }//end changeLanguage()


}//end class

?>