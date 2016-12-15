<?php
/**
 * GroupsController Groups Controller
 *
 * @package   Controller
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
/**
 * Group Controller
 *
 * Process the group data and send to view
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
class GroupsController extends AppController
{

    /**
     * User Behaviors.
     *
     * @var array
     * @access public
     */
    public $actsAs = array('Acl' => array('type' => 'requester'));

    /**
     * User components.
     *
     * @var array
     * @access public
     */
    public $components = array('SiAcl');

    /**
     * Paginate component.
     *  
     * @var array
     * @access public
     */
    public $paginate = array('limit' => 10);


    /**
     * admin_add
     *
     * Inserts a new group on database
     *
     * @return void
     */
    public function admin_add()
    {
        $this->set('title_for_layout', __('Add Group'));
        $permissions = $this->SiPermission->check();
        $this->set(compact('permissions'));
        $this->set('plugins', Configure::read('OnneBlue.plugins'));

        if ($this->request->is('post') === true) {
            if (isset($this->data['Group']['aco']) === false) {
                $this->Session->setFlash(
                    __('Choose at least one permission'),
                    'flash_alert'
                );
                $this->redirect(array('action' => 'add'));
            }//end if
            $this->Group->create();
            if ($this->Group->save($this->request->data) !== false) {
                $lastInsertedGroupId = $this->Group->getInsertID();
                $group = $this->Group;
                $group->id = $lastInsertedGroupId;
                $this->Acl->deny($group, 'controllers');
                $acos = $this->SiAcl->defineAcos($this->data['Group']['aco']);

                if (empty($acos) === false) {
                    foreach ($acos as $thisDataKey => $thisDataValue) {
                        if ($thisDataValue === 1) {
                            $this->Acl->allow($group, $thisDataKey);
                        } else {
                            $this->Acl->deny($group, $thisDataKey);
                        }
                    }
                }

                $this->Session->setFlash(__('The group has been saved'), 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'), 'flash_alert');
            }//end if
        }//end if
        $groups = $this->Group->find('list');
        $this->set(compact('groups'));

    }//end admin_add()


    /**
     * admin_delete
     *
     * Deletes the group with the id passed as parameter from database.
     *
     * @param int $id Group id.
     *
     * @throws NotFoundException if the user is not found.
     * @return void
     */
    public function admin_delete($id=null)
    {
        $this->Group->id = $id;
        if ($this->Group->existsAntiHack() === false) {
            throw new NotFoundException(__('Invalid group'));
        }//end if
        if ($id === '1') {
            $this->Session->setFlash(__("You don't have permission to delete the group"), 'flash_alert');
            $this->redirect(array('action' => 'index'));
        }//end if
        $this->request->onlyAllow('post', 'delete');
        if ($this->Group->delete() === true) {
            $this->Session->setFlash(__('Group deleted'), 'flash_success');
            $this->redirect(array('action' => 'index'));
        }//end if
        $this->Session->setFlash(__('Group was not deleted'), 'flash_alert');
        $this->redirect(array('action' => 'index'));

    }//end admin_delete()


    /**
     * admin_edit
     *
     * Edits the group with the id passed as parameter.
     *
     * @param int $id Group id.
     *
     * @throws NotFoundException if the user is not found.
     * @return void
     */
    public function admin_edit($id=null)
    {
        $this->set('title_for_layout', __('Edit Group'));
        $this->Group->id = $id;
        if ($this->Group->existsAntiHack() === false) {
            throw new NotFoundException(__('Invalid group'));
        }//end if
        if ($id === '1') {
            $this->Session->setFlash(__("You don't have permission to edit the group"), 'flash_alert');
            $this->redirect(array('action' => 'index'));
        }//end if
        $permissions = $this->SiPermission->check($id);

        $this->set(compact('permissions'));
        $this->set('plugins', Configure::read('OnneBlue.plugins'));

        if ($this->request->is('post') === true || $this->request->is('put') === true) {
            if (isset($this->data['Group']['aco']) === false) {
                $this->Session->setFlash(
                    __('Choose at least one permission'),
                    'flash_alert'
                );
                $this->redirect(array('action' => 'edit/'.$id));
            }//end if
            $this->request->data['Group']['id'] = $id;
            if ($this->Group->save($this->request->data) !== false) {
                $aroId = $this->Acl->Aro->find(
                    'first',
                    array(
                     'conditions' => array(
                                      'foreign_key' => $id,
                                      'model'       => 'Group',
                                     ),
                     'fields'     => array('id'),
                     'recursive'  => 0,
                    )
                );
                $this->loadModel('ArosAco');
                $aroId = $aroId['Aro']['id'];
                $this->ArosAco->deleteAll(array('ArosAco.aro_id' => $aroId), false);
                $group     = $this->Group;
                $group->id = $id;
                $this->Acl->deny($group, 'controllers');

                if (empty($this->data['Group']['aco']) === false) {
                    foreach ($this->data['Group']['aco'] as $thisDataKey => $thisDataValue) {
                        if ($thisDataValue === '1') {
                            $this->Acl->allow($group, $thisDataKey);
                        } else {
                            $this->Acl->deny($group, $thisDataKey);
                        }
                    }
                }

                $dir   = new Folder(CACHE);
                $files = $dir->read(true, array('files', 'index.php'));

                foreach ($files[1] as $key => $value) {
                    if (strstr($value, 'cake_cache_db_acl') !== false) {
                        $value = str_replace('cake_cache_db_acl', 'CacheDbAcl', $value);
                        Cache::delete($value);
                    }
                }

                $this->SiPermission->generate(true, $id);
                $this->Session->setFlash(__('The group has been saved'), 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'), 'flash_alert');
            }//end if
        } else {
            $options = array('conditions' => array('Group.'.$this->Group->primaryKey => $id));
            $this->request->data = $this->Group->find('first', $options);
        }//end if
        $groups = $this->Group->find('list');
        $this->set(compact('groups'));

    }//end admin_edit()


    /**
     * admin_edit
     *
     * List groups.
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('title_for_layout', __('Groups'));
        $this->Group->recursive = 0;

        $paginate = $this->paginate();
        $this->set('groups', $paginate);

        parent::admin_table_search();
        $pageCount = $this->params['paging']['Group']['pageCount'];
        $this->set(compact('pageCount'));

    }//end admin_index()


    /**
     * admin_view
     *
     * Displays data of group with the id passed as parameter.
     *
     * @param int $id Group id.
     *
     * @throws NotFoundException if the user is not found.
     * @return void
     */
    public function admin_view($id=null)
    {
        $this->set('title_for_layout', __('View Group'));
        $this->Group->id = $id;
        if ($this->Group->existsAntiHack() === false) {
            throw new NotFoundException(__('Invalid group'));
        }//end if
        $permissions = $this->SiPermission->check($id);
        $this->set(compact('permissions'));
        $this->set('plugins', Configure::read('OnneBlue.plugins'));

        $options = array('conditions' => array('Group.'.$this->Group->primaryKey => $id));
        $this->set('group', $this->Group->find('first', $options));
        $this->set('switchDisabled', true);

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

    }//end beforeFilter()


    /**
     * parentNode
     *
     * Used for Auth component
     *
     * @return null
     */
    public function parentNode()
    {
        return null;

    }//end parentNode()


}//end class

?>