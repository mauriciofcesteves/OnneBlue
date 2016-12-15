<?php
/**
 * SiPermission Component
 *
 * @package   Controller.Component
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
class SiPermissionComponent extends Component
{

    public $components = array('Acl');


    /**
     * defineAcos
     *
     * Generate permissions
     *
     * @param boolean $update  If true, reload the aco's.
     * @param boolean $groupId Group id.
     *
     * @return array
     */
    public function generate($update=false, $groupId=false)
    {
        if (isset($_SESSION['Auth']['User']['Group']['id']) === true) {
            $acos = Cache::read('si_acos', 'long');
            if ($acos === false || $update === true) {
                $acos = $this->Acl->Aco->find(
                    'all',
                    array(
                     'recursive' => 0,
                     'order'     => 'Aco.order ASC',
                    )
                );
                Cache::write('si_acos', $acos, 'long');
            }//end if

            if ($groupId === false) {
                $groupId = $_SESSION['Auth']['User']['Group']['id'];
            }

            $plugins           = Configure::read('OnneBlue.plugins');
            $permissions       = array();
            $pluginsController = array();

            $acosPlugins = $this->Acl->Aco->find(
                'list',
                array(
                 'conditions' => array(
                                  'Aco.alias' => $plugins
                                 ),
                 'fields'     => array(
                                  'Aco.id',
                                  'Aco.alias'
                                 ),
                 'recursive'  => 0
                )
            );

            $pluginsController = array_keys($acosPlugins);


            foreach ($acos as $controllerKey => $controllerValue) {
                if (in_array($controllerValue['Aco']['alias'], $plugins) === true) {
                    unset($acos[$controllerKey]);
                }//end if

                if (($controllerValue['Aco']['parent_id'] === '1'
                    || in_array($controllerValue['Aco']['parent_id'], $pluginsController) === true)
                    && in_array($controllerValue['Aco']['alias'], $plugins) === false
                ) {
                    $controllerPermission = $this->Acl->check(
                        array(
                         'model'       => 'Group',
                         'foreign_key' => $groupId,
                        ),
                        $controllerValue['Aco']['alias']
                    );

                    if (in_array($controllerValue['Aco']['parent_id'], $pluginsController) === true) {
                        $permissions['@plugin'][$acosPlugins[$controllerValue['Aco']['parent_id']]][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['id'] = $controllerValue['Aco']['id'];
                        $permissions['@plugin'][$acosPlugins[$controllerValue['Aco']['parent_id']]][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['active'] = $controllerPermission;
                        $permissions['@plugin'][$acosPlugins[$controllerValue['Aco']['parent_id']]][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['show'] = $controllerValue['Aco']['show'];
                        $permissions['@plugin'][$acosPlugins[$controllerValue['Aco']['parent_id']]][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['name'] = $controllerValue['Aco']['name'];
                        $permissions['@plugin'][$acosPlugins[$controllerValue['Aco']['parent_id']]][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['description'] = $controllerValue['Aco']['description'];
                    } else {
                        $permissions['@core'][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['id'] = $controllerValue['Aco']['id'];
                        $permissions['@core'][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['active'] = $controllerPermission;
                        $permissions['@core'][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['show'] = $controllerValue['Aco']['show'];
                        $permissions['@core'][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['name'] = $controllerValue['Aco']['name'];
                        $permissions['@core'][Inflector::underscore($controllerValue['Aco']['alias'])]['root']['description'] = $controllerValue['Aco']['description'];
                    }//end if
                    unset($acos[$controllerKey]);
                }//end if

                foreach ($acos as $actionKey => $actionValue) {
                    if ($controllerValue['Aco']['id'] === $actionValue['Aco']['parent_id']) {
                        $actionPermission = $this->Acl->check(
                            array(
                             'model'       => 'Group',
                             'foreign_key' => $groupId,
                            ),
                            $controllerValue['Aco']['alias'].'/'.$actionValue['Aco']['alias']
                        );
                        $alias = Inflector::underscore($controllerValue['Aco']['alias']);

                        if (in_array($controllerValue['Aco']['alias'], $plugins) === false) {
                            if (in_array($controllerValue['Aco']['parent_id'], $pluginsController) === true) {
                                $permissions['@plugin'][$acosPlugins[$controllerValue['Aco']['parent_id']]][$alias][$actionValue['Aco']['alias']]
                                    = array(
                                       'active'      => $actionPermission,
                                       'show'        => $actionValue['Aco']['show'],
                                       'name'        => $actionValue['Aco']['name'],
                                       'description' => $actionValue['Aco']['description'],
                                      );
                            } else {
                                $permissions['@core'][$alias][$actionValue['Aco']['alias']]
                                    = array(
                                       'show'        => $actionValue['Aco']['show'],
                                       'active'      => $actionPermission,
                                       'name'        => $actionValue['Aco']['name'],
                                       'description' => $actionValue['Aco']['description'],
                                      );
                            }//end if
                        }//end if
                        unset($acos[$actionKey]);
                    }//end if
                }//end foreach
            }//end foreach
            unset($permissions['@core']['controllers']);
            ksort($permissions['@plugin']);
            Cache::write('si_permissions_group_'.$groupId, $permissions, 'long');

            return $permissions;

        }//end if

    }//end generate()


    /**
     * check
     *
     * Checks the permission cache
     *
     * @param boolean $groupId Group id.
     *
     * @return array
     */
    public function check($groupId=false)
    {
        if (isset($_SESSION['Auth']['User']['Group']['id']) === true) {
            if ($groupId === false) {
                $groupId = $_SESSION['Auth']['User']['Group']['id'];
            }//end if

            $cache = Cache::read('si_permissions_group_'.$groupId, 'long');

            if ($cache === false) {
                return $this->generate(false, $groupId);
            }

            return $cache;
        }

    }//end check()


}//end class

?>