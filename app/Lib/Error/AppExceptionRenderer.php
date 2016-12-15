<?php
App::uses('ExceptionRenderer', 'Error');

/**
 * AppExceptionRenderer Controller
 *
 * Your exceptions messages
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 * @package       app.Controller
 * @since         siMarta v2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
class AppExceptionRenderer extends ExceptionRenderer {

/**
 * badRequest
 * 
 * Error 400
 * The request cannot be fulfilled due to bad syntax
 *
 * @return void
 */
    public function badRequest($error) {
        $url = $this->controller->referer();
        if (isset($this->controller->params['admin']) === true && $this->controller->params['admin'] === true) {
            $url = array(
                'admin' => true,
                'action' => 'index',
                'controller' => $this->controller->params['controller'],
            );
        }
        $this->controller->beforeFilter();
        $this->controller->set('title_for_layout', 'Error 400');
        $this->controller->set('name', $error->getMessage());
        $this->controller->set('url', $url);
        $this->controller->render('/Errors/error400');
        $this->controller->response->send();
    }

/**
 * forbidden
 * 
 * Error 403
 * The request was a valid request, but the server is refusing to respond to it
 *
 * @return void
 */
    public function forbidden($error) {
        $url = $this->controller->referer();
        if (isset($this->controller->params['admin']) === true && $this->controller->params['admin'] === true) {
            $url = array(
                'admin' => true,
                'action' => 'index',
                'controller' => $this->controller->params['controller'],
            );
        }
        $this->controller->beforeFilter();
        $this->controller->set('title_for_layout', 'Error 403');
        $this->controller->set('name', $error->getMessage());
        $this->controller->set('url', $url);
        $this->controller->render('/Errors/error403');
        $this->controller->response->send();
    }

/**
 * notFound
 * 
 * Error 404
 * The requested resource could not be found but may be available again in the future
 *
 * @return void
 */
    public function notFound($error) {
        $url = $this->controller->referer();
        if (isset($this->controller->params['admin']) === true && $this->controller->params['admin'] === true) {
            $url = array(
                'admin' => true,
                'action' => 'index',
                'controller' => $this->controller->params['controller'],
            );
        }
        $this->controller->beforeFilter();
        $this->controller->set('title_for_layout', 'Error 404 - Not found');
        $this->controller->set('name', $error->getMessage());
        $this->controller->set('url', $url);
        $this->controller->render('/Errors/error404');
        $this->controller->response->send();
    }

/**
 * methodNotAllowed
 * 
 * Error 405
 * A request was made of a resource using a request method not supported 
 * by that resource
 *
 * @return void
 */
    public function methodNotAllowed($error) {
        $url = $this->controller->referer();
        if (isset($this->controller->params['admin']) === true && $this->controller->params['admin'] === true) {
            $url = array(
                'admin' => true,
                'action' => 'index',
                'controller' => $this->controller->params['controller'],
            );
        }
        $this->controller->beforeFilter();
        $this->controller->set('title_for_layout', 'Error 405');
        $this->controller->set('name', $error->getMessage());
        $this->controller->set('url', $url);
        $this->controller->render('/Errors/error405');
        $this->controller->response->send();
    }

/**
 * internalError
 * 
 * Error 500
 * A generic error message, given when an unexpected condition was 
 * encountered and no more specific message is suitable.
 *
 * @return void
 */
    public function internalError($error) {
        $url = $this->controller->referer();
        if (isset($this->controller->params['admin']) === true && $this->controller->params['admin'] === true) {
            $url = array(
                'admin' => true,
                'action' => 'index',
                'controller' => $this->controller->params['controller'],
            );
        }
        $this->controller->beforeFilter();
        $this->controller->set('title_for_layout', 'Error 500');
        $this->controller->set('name', $error->getMessage());
        $this->controller->set('url', $url);
        $this->controller->render('/Errors/error500');
        $this->controller->response->send();
    }

/**
 * notImplemented
 * 
 * Error 501
 * The server either does not recognize the request method, or it lacks 
 * the ability to fulfill the request
 *
 * @return void
 */
    public function notImplemented($error) {
        $url = $this->controller->referer();
        if (isset($this->controller->params['admin']) === true && $this->controller->params['admin'] === true) {
            $url = array(
                'admin' => true,
                'action' => 'index',
                'controller' => $this->controller->params['controller'],
            );
        }
        $this->controller->beforeFilter();
        $this->controller->set('title_for_layout', 'Error 501');
        $this->controller->set('name', $error->getMessage());
        $this->controller->set('url', $url);
        $this->controller->render('/Errors/error501');
        $this->controller->response->send();
    }

    public function missingController($error) {
        $this->notFound($error);
    }
    public function missingAction($error) {
        $this->notFound($error);
    }
    public function missingView($error) {
        $this->notFound($error);
    }
    public function missingLayout($error) {
        $this->internalError($error);
    }
    public function missingHelper($error) {
        $this->internalError($error);
    }
    public function missingBehavior($error) {
        $this->internalError($error);
    }
    public function missingComponent($error) {
        $this->internalError($error);
    }
    public function missingTask($error) {
        $this->internalError($error);
    }
    public function missingShell($error) {
        $this->internalError($error);
    }
    public function missingShellMethod($error) {
        $this->internalError($error);
    }
    public function missingDatabase($error) {
        $this->internalError($error);
    }
    public function missingConnection($error) {
        $this->internalError($error);
    }
    public function missingTable($error) {
        $this->internalError($error);
    }
    public function privateAction($error) {
        $this->internalError($error);
    }
    
}