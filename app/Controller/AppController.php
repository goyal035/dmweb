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
class AppController extends Controller{
	public $components = array(
		'Auth',
		'Session',
		'Cookie',
		'RequestHandler',
		'Custom'
	);
	
	public $helpers = array(
		//'Html',
		//'Form',
		//'Js',
		//'Image',
		//'Session',
		//'Text',
		//'Time',
	);
	
	public function beforeFilter(){
		//sendemail();
		parent::beforeFilter();
        //$this->Auth->allow(array('admin_login', 'admin_logout','home'));
        $this->Auth->allow(array('admin_login', 'admin_logout','home','logout'));
        $this->Auth->authorize = 'controller';
		
		if(isset($this->request->params['admin'])){
			$this->layout = "admin";
			AuthComponent::$sessionKey = "Auth.Admin";
			$this->Auth->loginAction = array('admin'=>true,'controller'=>'users','action'=>'login');
			$this->Auth->loginRedirect = array('admin'=>true,'controller'=>'users','action'=>'dashboard');
			$this->Auth->logoutRedirect = array('admin'=>true,'controller'=>'users','action'=>'login');
		}else{
			$this->layout = "default";
			$this->Auth->loginAction = array('controller'=>'users','action'=>'login');
			$this->Auth->loginRedirect = array('controller'=>'users','action'=>'dashboard');
			$this->Auth->logoutRedirect = array('controller'=>'users','action'=>'login');
			
		}

		/*$user['id'] = 1;
		$user['name'] = "Goyal";
		$this->Auth->login($user);
		pr($this->Session->read('Auth'));exit;*/
		/*AuthComponent::$sessionKey = "Auth.User";
		$this->Auth->logout();*/

		$params = $this->request->params;
		$currUrl = $params['controller'].'/'.$params['action'];
		$this->set(compact('currUrl','fullBaseUrl'));
		$this->setting();
	}
	
	public function checkAccess(){ 
		$prefix = isset($this->request->params['prefix']) ? ucfirst($this->request->params['prefix']) : ""; 
		$url = $prefix;
		$url .= isset($this->request->params['controller']) ? ucfirst($this->request->params['controller']) : "";
		$url .= isset($this->request->params['action']) ? ucfirst($this->request->params['action']) : "";
		$this->loadModel('Acoo');
		$data = $this->Acoo->find("first",array(
			'conditions'=>array('Acoo.aro_rule'=>$url,'Acoo.user_role'=>$this->Session->read('Auth.User.role'))
		));

		if($data) {
			return true;
		} else {
			$this->Session->setFlash("Sorry, Access not allowed",'error');
			return false;
			//$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		//pr($this->Session->read('Auth.User.role')); exit;
	}

	public function isAuthorized($user){ 
		$prefix = isset($this->request->params['prefix']) ? ucfirst($this->request->params['prefix']) : ""; 
		if($prefix == "Admin"){
			return true;
		}else{
			if($this->Session->check('Auth.User') && $this->checkAccess()){ 
				return true;
			}else{
				$this->Session->setFlash("Sorry, Access not allowed",'error');
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			}
		}
	}

	public function setting(){
		$this->loadModel('Setting');
		$setting = $this->Setting->find("all",array(
			//'conditions'=>array('Setting.status'=>1)
			));
		foreach($setting as $k=>$v){
			Configure::write($v['Setting']['keyword'], $v['Setting']['title']);
		}	
	}
}
