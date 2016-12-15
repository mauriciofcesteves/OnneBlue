<?php
/**
 * Addon Model
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
 * Addon Model
 *
 * Addon model business rules.
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
class Addon extends AppModel
{


    /**
     * getValue
     *
     * Get addon value.
     *
     * @param int $addonId Addon id.
     *
     * @return type
     */
    public function getValue($addonId)
    {
        $this->recursive = 0;
        return $this->find(
            'first',
            array(
             'fields'     => array(
                              'Addon.id',
                              'Addon.value',
                              'Addon.name',
                             ),
             'conditions' => array('Addon.id' => $addonId)
            )
        );

    }//end getValue()


    /**
     * getValue
     *
     * Get addon values.
     *
     * @param int $addonId Addon id.
     *
     * @return type
     */
    public function getValues($addonId)
    {
        $this->recursive = 0;
        return $this->find(
            'all',
            array(
             'fields'     => array(
                              'Addon.id',
                              'Addon.value',
                              'Addon.name',
                             ),
             'conditions' => array('Addon.id' => $addonId)
            )
        );

    }//end getValues()


}//end class

?>