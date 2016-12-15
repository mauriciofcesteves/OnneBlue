<?php
/**
 * SiAcl Acl Component
 *
 * @package   Controller.Component
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
class SiAclComponent extends Component
{


    /**
     * defineAcos
     *
     * Description
     *
     * @param array $acos Acos.
     *
     * @return type
     */
    public function defineAcos($acos)
    {
        $controllers = array();
        foreach ($acos as $userAcoKey => $userAcoValue) {
            $controllerAco = explode('/', $userAcoKey);
            if ($userAcoValue === '1') {
                $acos[$controllerAco[0]] = '1';
                $controllers[] = $controllerAco[0];
            }
        }//end foreach
        ksort($acos);

        return $acos;

    }//end defineAcos()


}//end class

?>