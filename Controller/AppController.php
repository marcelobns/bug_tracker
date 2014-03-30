<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Auth' => array(
            'loginAction' => array('controller' => 'users', 'action' => 'signin'),
            'loginRedirect' => array('controller' => 'pages', 'action' => 'home'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'home'),
//            'authorize' => array('Controller')
        ),
        'Session',
//        'DebugKit.Toolbar'
    );

    public function beforeFilter() {
        if ($this->Session->check('Config.language')) {
            Configure::write('Config.language', $this->Session->read('Config.language'));
        }
    }

    public function beforeRender(){
        if ($this->Session->check('Message.flash')) {
            $flash = $this->Session->read('Message.flash');

            if ($flash['element'] == 'default') {
                $flash['element'] = 'flash.default';
                $this->Session->write('Message.flash', $flash);
            }
        }
    }

    public function arrayFromDB($dbarr) {
        $arr = substr($dbarr, 1, strlen($dbarr) - 2);
        $elements = array();
        $i = $j = 0;
        $in_quotes = false;
        while ($i < strlen($arr)) {
            $char = substr($arr, $i, 1);
            if ($char == '"' && ($i == 0 || substr($arr, $i - 1, 1) != '\\')) {
                $in_quotes = !$in_quotes;
            } else if ($char == ',' && !$in_quotes) {
                $elements[] = substr($arr, $j, $i - $j);
                $j = $i + 1;
            }
            $i++;
        }
        $elements[] = substr($arr, $j);
        for ($i = 0; $i < sizeof($elements); $i++) {
            $v = $elements[$i];
            if (strpos($v, '"') === 0) {
                $v = substr($v, 1, strlen($v) - 2);
                $v = str_replace('\\"', '"', $v);
                $v = str_replace('\\\\', '\\', $v);
                $elements[$i] = $v;
            }
        }
        return $elements;
    }

    public function arrayToDB($array) {
        if($array === NULL)
            return NULL;

        $arrayDB = '{';
        foreach($array as $item){

            $arrayDB = $arrayDB.$item.',';
        }
        $arrayDB[strlen($arrayDB)-1] = '}';
        return $arrayDB;
    }
}
