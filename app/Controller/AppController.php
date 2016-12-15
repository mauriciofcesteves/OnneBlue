<?php
/**
 * Application level Controller
 *
 * @package   Controller
 * @author    Harvest Sistemas <contato@harvestsistemas.com.br>
 * @copyright 2014 Harvest Sistemas
 * @license   http://creativecommons.org/licenses/by-nd/4.0/ Attribution-NoDerivatives 4.0 International
 * @link      http://harvestsistemas.com.br Harvest Sistemas
 *
 */
App::uses('Controller', 'Controller');
App::import('Vendor', 'php-excel-reader/excel_reader2');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers will inherit them.
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
class AppController extends Controller
{

    /**
     * App components.
     *
     * @var array
     * @access public
     */
    public $components
        = array(
           'Acl',
           'Auth'         => array(
                              'authorize'    => array(
                                                 'Actions' => array('actionPath' => 'controllers')
                                                ),
                              'authenticate' => array(
                                                 'Form' => array(
                                                            'fields' => array(
                                                                         'username' => 'email',
                                                                         'password' => 'password',
                                                                        )
                                                           )
                                                )
                             ),
           'Cookie',
           'Session',
           'SiLanguage',
           'SiPermission'
          );

    /**
     * App helpers.
     *
     * @var array
     * @access public
     */
    public $helpers
        = array(
           'Harvest',
           'Html',
           'Form',
           'Session',
          );


    /**
     * download_spreadsheet
     *
     * Downloads the spreadsheet
     *
     * @param string $english   Spreadsheet name in english.
     * @param string $portugues Spreadsheet name in portuguese.
     *
     * @return type
     */
    public function download_spreadsheet($english, $portugues)
    {
        $this->autoRender = false;

        $path = "files/spreadsheet/en/$english.xls";
        $lang = $this->Session->read('onneblue_language');

        $file_name = __("$english.xls");
        if ($lang === null || strpos($lang, 'por') !== false) {
            $path      = "files/spreadsheet/pt/$portugues.xls";
            $file_name = __("$portugues.xls");
        }

        return $this->download_spreadsheet_for_import($path, $file_name);

    }//end download_spreadsheet()


    /**
     * admin_set_draft()
     *
     * Defines draft session
     *
     * @return void
     */
    public function admin_set_draft()
    {
        $this->autoRender = false;
        $name             = $_POST['name'];
        $value            = $_POST['value'];
        $controller       = $this->params['controller'];
        $model = Inflector::classify($this->params['controller']);
        $this->Session->write('Onneblue.draft.'.$controller.'.'.$model.'.'.$name, $value);

    }//end admin_set_draft()


    /**
     * admin_table_search
     *
     * Performs the table search
     *
     * @param string $setName Controller name.
     *
     * @return array
     */
    public function admin_table_search($setName=null)
    {
        if ($this->request->is('post') === true && isset($this->data['Search']) === true) {
            $this->redirect(
                array(
                 'controller' => $this->params['controller'],
                 'action'     => $this->params['action'],
                 'search'     => $this->data['Search'],
                )
            );
        } else {
            if (empty($this->params['named']['search']) === false) {
                $options = array();
                foreach ($this->params['named']['search'] as $searchKey => $searchValue) {
                    $field = $this->modelClass.'.'.str_replace('-', '.', $searchKey);

                    if (strstr($searchKey, '-') !== false) {
                        $field = str_replace('-', '.', $searchKey);
                    }//end if
                    if (empty($searchValue) === false) {
                        $options[] = array($field.' LIKE' => "%$searchValue%");
                    }
                }//end foreach
                $paginate = $this->paginate(array($options));

                $set = $this->params['controller'];
                if ($setName !== null) {
                    $set = $setName;
                }//end if
                $this->set($set, $paginate);
                if (empty($paginate) === true) {
                    $this->set('emptySearch', true);
                }//end if
                $this->set('search', $this->params['named']['search']);

                return $paginate;
            }//end if
        }//end if

    }//end admin_table_search()


    /**
     * beforeFilter
     *
     * Called before the controller action.
     *
     * @return void
     */
    public function beforeFilter()
    {
        $user = $this->Auth->user();
        CakeNumber::addFormat('BRL', array('before' => 'R$', 'thousands' => '.', 'decimals' => ',', 'escape' => false));

        if ($this->Session->read('Auth.User') !== null) {
            $permissions = Cache::read('si_permissions_group_'.$_SESSION['Auth']['User']['Group']['id'], 'long');
            $this->set('globalPermissions', $permissions);
        }

        $siLanguage = $this->SiLanguage->setLanguage();
        $this->set(compact('siLanguage', 'user'));

        $this->Auth->allow('admin_set_draft');
        $this->Auth->loginAction
            = array(
               'controller' => 'users',
               'action'     => 'login',
              );
        $this->Auth->logoutRedirect
            = array(
               'controller' => 'pages',
               'action'     => 'index',
               'admin'      => false,
              );
        $this->Auth->loginRedirect  = '/admin';

        $this->Auth->authError = __('You are not authorized to access that location.');

    }//end beforeFilter()


    /**
     * beforeRender
     *
     * Called after the controller action is run, but before the view is rendered
     *
     * @return void
     */
    public function beforeRender()
    {
        $admin = $this->params['admin'];
        $url   = $this->params->url;
        if ($this->params['action'] === 'admin_login' || $this->params['action'] === 'register') {
            $this->layout = 'clean';
        } else if (isset($admin) === true && $admin === true) {
            $this->layout = 'admin';
            $this->SiPermission->check();
            $this->notifications();
        } else if (isset($this->params['hq']) === true && $this->params['hq'] === true) {
            $this->layout = 'hq';
        } else {
            $this->layout = 'public';
        }

        $this->set('userData', $this->Auth->user());

        if (isset($this->seo_description) === true) {
            $this->set('seo_description', $this->seo_description);
        } else {
            $this->set(
                'seo_description',
                __('Manage, analyze and make decisions for your business from anywhere: OnneBlue.')
            );
        }

        if (isset($this->seo_keywords) === true) {
            $this->set('seo_keywords', $this->seo_keywords);
        } else {
            $this->set(
                'seo_keywords',
                __('harvest, erp, manage, analyze, make decisions, business, simplicity, system, mobile')
            );
        }

    }//end beforeRender()

    public function notifications() {
        $this->loadModel('Notification');
        $menuNotifications = $this->Notification->getLatest();
        $hasNotifications  = $this->Auth->user('Business.has_notification');
        $this->set(compact('menuNotifications', 'hasNotifications'));
    }


    /**
     * download_spreadsheet_for_import
     *
     * Make a download of spreasheet file
     *
     * @param string $path      Path of file.
     * @param string $file_name File name.
     *
     * @return Object
     */
    public function download_spreadsheet_for_import($path=null, $file_name=null)
    {
        $this->response->file(
            $path,
            array(
             'download' => true,
             'name'     => $file_name,
            )
        );

        return $this->response;

    }//end download_spreadsheet_for_import()


    /**
     * read_excel
     *
     * Read the excel content into an $arr and returns it
     *
     * @param array $file File data.
     *
     * @return array
     */
    public function read_excel($file=null)
    {
        if ($file['size'] === 0) {
            $this->Session->setFlash(__('Please, select a spreadsheet model to import.'), 'flash_alert');
            return;
        }

        $path = $file['tmp_name'];
        $data = new Spreadsheet_Excel_Reader($path, true, 'ISO8859-1');
        $temp = $data->dumptoarray();

        return $temp;

    }//end read_excel()


    /**
     * Read the excel content into an $arr and save it to database
     *
     * @param $file Spreadsheet Model File
     * @param $model_infos Columns Names and Model Name
     * @param $model Model used to save the sheet imported
     */
    /**
     * read_and_save_excel_to_database
     *
     * Read the excel content into an $arr and save it to database
     *
     * @param array $file        File data.
     * @param array $model_infos Information of the model.
     * @param array $model       Model.
     *
     * @return type
     */
    public function read_and_save_excel_to_database($file=null, $model_infos=null, $model=null)
    {
        if (strcmp($file['type'], 'application/octet-stream') !== 0) {
            $this->Session->setFlash(__('Please, select a XLS file to upload.'), 'flash_alert');
            return;
        }

        $sheet = $this->read_excel($file);
        $total_sheet_lines = count($sheet, 1);
        $total_columns     = $model_infos['sheet_number_lines'];

        if ($total_sheet_lines > $total_columns) {
            $this->Session->setFlash(__('Please, import a sheet with only 100 lines at time.'), 'flash_alert');
            return;
        }//end if
        if (empty($sheet) === false) {
            $first_iteration = -1;
            $index_error     = 0;

            $models  = null;
            $index_x = 0;
            $erros   = null;

            $model_name = $model_infos['model_name'];
            foreach ($sheet as $key => $line) {
                $index_y = 0;
                if ($first_iteration === -1) {
                    $first_iteration++;
                    $total_columns      = $model_infos['sheet_number_header_columns'];
                    $total_sheet_header = count($line, 1);

                    if ($total_columns !== $total_sheet_header) {
                        $this->Session->setFlash(
                            __('Please, you have to upload our spreadsheet model.'),
                            'flash_alert'
                        );
                        return;
                    }//end if
                    continue;
                }

                foreach ($line as $key => $column_value) {
                    if (empty($column_value) === false) {
                        $column_value = html_entity_decode($column_value);
                    }

                    $column_name     = $this->getModelInfoValue($model_infos[$index_y], 'column_name');
                    $is_required     = $this->getModelInfoValue($model_infos[$index_y], 'required');
                    $is_unique       = $this->getModelInfoValue($model_infos[$index_y], 'is_unique');
                    $is_email        = $this->getModelInfoValue($model_infos[$index_y], 'is_email');
                    $is_numeric_mask = $this->getModelInfoValue($model_infos[$index_y], 'is_numeric_mask');
                    $is_cnpj_cpf     = $this->getModelInfoValue($model_infos[$index_y], 'is_cnpj_cpf');
                    $is_phone_number = $this->getModelInfoValue($model_infos[$index_y], 'is_phone_number');
                    $is_site         = $this->getModelInfoValue($model_infos[$index_y], 'is_site');

                    $this->validateRequiredField(
                        $is_required,
                        $model_name,
                        $column_name,
                        $column_value,
                        $erros,
                        $index_error,
                        $index_x
                    );
                    $this->validateIsUnique(
                        $is_unique,
                        $model,
                        $model_name,
                        $column_name,
                        $column_value,
                        $erros,
                        $index_error
                    );
                    $this->validateModelField(
                        $is_email,
                        $model,
                        $model_name,
                        $column_name,
                        $column_value,
                        $erros,
                        $index_error
                    );
                    $this->validateModelField(
                        $is_site,
                        $model,
                        $model_name,
                        $column_name,
                        $column_value,
                        $erros,
                        $index_error
                    );
                    $this->validateIsNumericMask(
                        $is_numeric_mask,
                        $model_name,
                        $column_name,
                        $column_value,
                        $erros,
                        $index_error
                    );

                    if (empty($erros) === true) {
                        if ($is_cnpj_cpf !== false) {
                            $len = strlen($column_value);

                            $column_name_cpf_cnpj = $this->getModelInfoValue(
                                $model_infos[$index_y],
                                'column_name_cpf_cnpj'
                            );

                            if ($len === 14) {
                                $models[$index_x][$model_name][$column_name_cpf_cnpj] = false;
                            } else if ($len === 11) {
                                $models[$index_x][$model_name][$column_name_cpf_cnpj] = true;
                            } else if ($len === 10) {
                                $models[$index_x][$model_name][$column_name_cpf_cnpj] = true;
                                $column_value = '0'.$column_value;
                            } else if ($len === 13) {
                                $models[$index_x][$model_name][$column_name_cpf_cnpj] = false;
                                $column_value = '0'.$column_value;
                            }
                        } else if ($is_phone_number !== false) {
                            $len = strlen($column_value);
                            if ($len === 8 || $len === 9) {
                                $column_value = '00'.$column_value;
                            }
                        }//end if

                        $models[$index_x][$model_name][$column_name] = $column_value;
                    }//end if

                    $index_y++;
                    $index_error++;
                }//end foreach

                $index_x++;
            }//end foreach

            if (empty($erros) === true) {
                $erros = $model->saveManyModels($model, $models);

                if (empty($erros) === false) {
                    $this->set('messages', $erros);
                    return;
                }//end if

            } else {
                $this->set('messages', $erros);
                return;
            }

            $this->Session->setFlash(__('The import has been finished.'), 'flash_success');
        }//end if

    }//end read_and_save_excel_to_database()


    /**
     * getModelInfoValue
     *
     * Returns the model info value or false, when does not have value.
     *
     * @param array  $model_info_value Information values of model.
     * @param string $name             Model name.
     *
     * @return string
     */
    public function getModelInfoValue($model_info_value=null, $name=null)
    {
        if (isset($model_info_value[$name]) === true) {
            return $model_info_value[$name];
        } else {
            return false;
        }

    }//end getModelInfoValue()


    /**
     * validateRequiredField
     *
     * Required validation.
     *
     * @param string $model_name   description.
     * @param string $column_name  description.
     * @param string $column_value description.
     * @param string &$error       description.
     * @param string $index_error  description.
     * @param string $index_x      description.
     * @param string $is_required  description.
     *
     * @return type
     */
    public function validateRequiredField(
        $model_name,
        $column_name,
        $column_value,
        &$error,
        $index_error,
        $index_x,
        $is_required=false
    ) {
        if ($is_required !== false && empty($column_value) === true) {
            $index_x = ($index_x + 2);
            $error[$index_error] = __('Every "%s" field is required. Please, see line %s.', $column_name, $index_x);
        }

    }//end validateRequiredField()


    /**
     * validateIsUnique
     *
     * Make a count whether has another register with the same value. Returns true when $total greater than 0.
     *
     * @param string $is_unique    description.
     * @param string $model        description.
     * @param string $model_name   description.
     * @param string $column_name  description.
     * @param string $column_value description.
     * @param string &$error       description.
     * @param string $index_error  description.
     *
     * @return type
     */
    public function validateIsUnique(
        $is_unique,
        $model,
        $model_name,
        $column_name,
        $column_value,
        &$error,
        $index_error
    ) {
        if ($is_unique !== false && empty($column_value) === false) {
            $concat = $model_name.'.'.$column_name;
            $total  = $model->find(
                'count',
                array(
                 'conditions' => array($concat => $column_value)
                )
            );

            if ($total > 0) {
                $error[$index_error] = __(
                    'The value "%s" already have been registered for the field "%s". Please, change it.',
                    $column_value,
                    __($column_name)
                );
            }
        }

    }//end validateIsUnique()


    /**
     * validateModelField
     *
     * Validate model fields. For example: email and website fields.
     *
     * @param string $is_email     description.
     * @param string $model        description.
     * @param string $model_name   description.
     * @param string $column_name  description.
     * @param string $column_value description.
     * @param string &$error       description.
     * @param string $index_error  description.
     *
     * @return type
     */
    public function validateModelField(
        $is_email,
        $model,
        $model_name,
        $column_name,
        $column_value,
        &$error,
        $index_error
    ) {
        if ($is_email !== false && empty($column_value) === false) {
            $model->create(false);
            $creating_model[$model_name][$column_name] = $column_value;
            $model->set($creating_model);

            if (!$model->validates(array('fieldList' => array($column_name)))) {
                $error[$index_error] = __('Invalid %s: "%s". Please, change it.', $column_name, $column_value);
            }
        }

    }//end validateModelField()


    /**
     * validateIsNumericMask
     *
     * Validate only numeric.
     *
     * @param string $is_numeric_mask description.
     * @param string $model_name      description.
     * @param string $column_name     description.
     * @param string &$column_value   description.
     * @param string &$error          description.
     * @param string $index_error     description.
     *
     * @return type
     */
    public function validateIsNumericMask(
        $is_numeric_mask,
        $model_name,
        $column_name,
        &$column_value,
        &$error,
        $index_error
    ) {
        if ($is_numeric_mask !== false && empty($column_value) === false) {
            $replace1 = str_replace('-', '', $column_value);
            $replace2 = str_replace('.', '', $replace1);
            $replace3 = str_replace('/', '', $replace2);
            $replace4 = str_replace('(', '', $replace3);
            $replace5 = str_replace(')', '', $replace4);
            $replace6 = str_replace(' ', '', $replace5);

            if (is_numeric($replace6) === false) {
                $error[$index_error] = __('The fields %s must be numeric only: %s', $column_name, $column_value);
            } else {
                $column_value = $replace6;
            }
        }

    }//end validateIsNumericMask()


    /**
     * is_valid_currency
     *
     * Returns true when the currency number is valid.
     * For example: 1000,00 is valid, but 1.000,00 is invalid.
     *
     * @param decimal $number Currency value.
     *
     * @return string
     */
    public function is_valid_currency($number=null)
    {
        return preg_match('/^-?[0-9]+(?:\,[0-9]{1,2})?$/', $number);

    }//end is_valid_currency()


    /**
     * date_converter
     *
     * Converts date from 01/01/2000 to 2000-01-01
     *
     * @param date $date Date to be converted.
     *
     * @return type
     */
    public function date_converter($date=null)
    {
        $format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
        if ($date !== null && preg_match($format, $date, $partes) === 1) {
            return $partes[3].'-'.$partes[2].'-'.$partes[1];
        }//end if
        return false;

    }//end date_converter()


}//end class

?>