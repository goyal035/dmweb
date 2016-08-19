<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow(array('admin_login', 'admin_logout'));
        //pr($this->Session->read('Auth.User'));exit;
    }

	public function login() {
		if($this->request->is('post') || $this->request->is('put')) {
			$req = $this->request->data;
			$isExist = $this->User->find("first",array('conditions'=>array('email'=>$req['User']['email'])));

			if(empty($isExist)){
				$this->Session->setFlash("Sorry, Invalid User",'error');
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			}elseif($isExist['User']['status']==0){
				$this->Session->setFlash("Sorry, Your account is not activated",'error');
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			}elseif(AuthComponent::password($req['User']['password']) != $isExist['User']['password']){
				$this->Session->setFlash("Sorry, Password Not Matched",'error');
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			}else{
				if($this->Auth->login($isExist)){
					$this->Session->setFlash("Login Successfully",'success');
					$this->redirect($this->Auth->redirectUrl());
				}
			}
	        
	    }
		$this->render('/Elements/login');
	}

	public function logout(){
		$this->Session->setFlash("Logout Successfully",'success');
		AuthComponent::$sessionKey = "Auth.User";
		$this->redirect($this->Auth->logout());
	}

	public function fblogin(){
		if($this->request->is('post') || $this->request->is('put') || $this->request->is('ajax')) {
			$req = $this->request->data;
			$isExist = $this->User->find('first',array('conditions'=>array('OR'=>array('User.fbtoken'=>$req['fbtoken'],'User.email'=>$req['email']))));
			$res['err'] = 1; $res['msg'] = "";
			if(empty($isExist)){
				$save['User']['fbtoken'] = $req['fbtoken'];
				$save['User']['email'] = $req['email'];
				if($data = $this->User->save($save)){
					$data = $this->User->findById($this->User->getLastInsertID());
					if($this->Auth->login($data)){
						$res['err'] = 0;
						$res['msg'] = "Signup Successfully";	
					}
				}else{
					$res['err'] = 1; $res['msg'] = "Sorry,There is an problem.";
				}
			}elseif($isExist['User']['status']==0){
				$res['err'] = 1; $res['msg'] = "Sorry, Your account is not activated";	
			}else{
				if($this->Auth->login($isExist)){
					$res['err'] = 0; $res['msg'] = "Login Successfully";	
				}
			}

			if($this->request->is('ajax')){
				echo json_encode($res); exit;
			}else{
				$flash_type = $res['err'] == 1 ? "error" : "success";
				$this->Session->setFlash($res['msg'],$flash_type);
				$this->redirect($this->Auth->redirectUrl());
			}
		}
	}

	public function trainer_login() {

	}

	public function admin_login(){
		//$this->layout = "admin";
		/*$save['User']['email'] = "admin@admin.com";
		$save['User']['password'] = "123456";
		$save['User']['role'] = 1;
		$this->User->save($save);*/
		//pr($this->Session->read('Auth.Admin')); exit;
		/*if($this->Session->check('Auth.Admin')){ 
			$this->redirect($this->Auth->redirectUrl());
		}*/
	
		if($this->request->is('post')){
			$data = $this->User->find("first",array(
				'conditions'=>array('User.email'=>$this->request->data['User']['email'],'User.role'=>1)
			));
			if(empty($data)){
				$this->Session->setFlash("Sorry, Wrong email entered",'error');
				$this->redirect(array('controller' => 'users', 'action' => 'login','admin'=>true));
				//$this->redirect($this->Auth->loginAction());
			}elseif(AuthComponent::password($this->request->data['User']['password']) != $data['User']['password']){
				$this->Session->setFlash("Sorry, Password Not Matched",'error');
				$this->redirect(array('controller' => 'users', 'action' => 'login','admin'=>true));
				//$this->redirect($this->Auth->loginAction());
			}else{
				if($this->Auth->login($data['User'])){
					$this->Session->setFlash("Login Successfully",'success');
					$this->redirect($this->Auth->redirectUrl());
				}
			}
			
		}
	}

	public function admin_logout(){
		$this->Session->setFlash("Logout Successfully",'success');
		AuthComponent::$sessionKey = "Auth.Admin";
		$this->redirect($this->Auth->logout());
	}

	public function admin_dashboard(){
		
	}

	public function admin_profile(){
		$title_for_layout = "Edit Admin Profile";
		$isExist = $this->User->find('first',array('id'=>$this->Session->read('Auth.Admin.id')));
		if($this->request->is('post') || $this->request->is('put')){
			if($this->User->save($this->request->data)){
 				$this->Session->setFlash("Profile updated Successfully",'success');
 				$this->redirect(array('full_base'=>true,'controller'=>'users','profile'));
			}else{
				$this->Session->setFlash("Sorry, Please try again",'error');	
			}
		}
		$this->request->data = $isExist;
		$this->set(compact('title_for_layout'));
	}

	public function admin_users(){
		$title_for_layout = "Users";
		$this->set(compact('title_for_layout'));
	}

	public function admin_user_data() {
		$request = $this->request;
        $this->autoRender = false;
        if ($request->is('ajax')) {
            $this->layout = 'ajax';
   			$page = $request->query('draw');
            $limit = $request->query('length');
            $start = $request->query('start');
            
            //for order
            $colName=$this->request->query['order'][0]['column'];
            $orderby[$this->request->query['columns'][$colName]['name']]=$this->request->query['order'][0]['dir'];
          
            $condition = array();
            $condition ['User.status !='] = 2;
            $condition ['User.role !='] = 1;
           
            //pr($this->request->query['columns']);
		    foreach ($this->request->query['columns'] as $column){
		       if (isset($column['searchable']) && $column['searchable'] == 'true') {
		        if(isset($column['name']) && $column['search']['value']!='') {
		         $condition[$column['name'].' LIKE '] = '%' .trim($column['search']['value']). '%';
		        }
		        /*if($column['name']=='User.date_added' && !empty($column['search']['value'])){
		         $condition['User.date_added LIKE '] = '%' .Sanitize::clean(date('Y-m-d',strtotime($column['search']['value']))). '%';
		        }elseif($column['name']=='User.dob' && !empty($column['search']['value'])){
		         $condition['User.dob LIKE '] = '%' .Sanitize::clean(date('Y-m-d',strtotime($column['search']['value']))). '%';
		        }elseif(isset($column['name']) && $column['search']['value']!='') {
		         $condition[$column['name'].' LIKE '] = '%' .Sanitize::clean($column['search']['value']). '%';
		        }*/
		       } 
		    }
		      //pr($condition);
                       
            $total_records = $this->User->find('count', array('conditions' => $condition));
            
            //$fields = array('User.id', 'User.fname', 'User.status', 'User.lname', 'User.email','User.dob','User.date_added');
            $userData = $this->User->find('all', array(
                      'conditions' => $condition,
                      //'fields' => $fields,
                      'order' => $orderby,
                      'limit' => $limit,
                      'offset' => $start
                  ));

            $return_result['draw'] = $page;
            $return_result['recordsTotal'] = $total_records;
            $return_result['recordsFiltered'] = $total_records;
            
    
            $return_result['data']=array();
            if (isset($userData[0])) {
             $i = $start + 1;
                foreach ($userData as $row) {
     
                 $action = '';
                 $status = '';
                 $role = $row['User']['role']==2 ? "Instroctor" : "User" ;
                 
                 /*if ($row['User']['status']==0)
                 {
                  $status .= '<i class="fa fa-circle fa-lg clr-red" onclick="changeUserStatus(' . $row['User']['id'] . ',0)" title="Change Status"></i>';
                 }
                 else if ($row['User']['status']==1)
                 {
                  $status .= '<i class="fa fa-circle fa-lg clr-green" onclick="changeUserStatus(' . $row['User']['id'] . ',1)" title="Change Status"></i>';
                 }*/
                 
                 $action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot.'admin/users/add_user/'.$row['User']['id']. '" title="Edit User"><i class="fa fa-edit fa-lg"></i></a> ';

                 //$action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot.'admin/survey/survey_detail/'.$row['User']['id']. '" title="Report Detail"><i class="fa fa-th-list fa-lg"></i></a> ';
                                
                 $action .= '&nbsp;&nbsp;&nbsp; <a href="#" onclick="change_status('.$row['User']['id'].')" title="Delete User"><i class="fa fa-trash fa-lg"></i></a>';                    
                 
                    
                    $return_result['data'][]= array(
                     $i,//$row['User']['id'],
                     $row['User']['fname'],
                     $row['User']['lname'],
                     $row['User']['email'],
                     //date(Configure::read('Site.admin_date_format'), strtotime($row['User']['dob'])),
                    //date(Configure::read('Site.admin_date_time_format'), strtotime($row['User']['date_added'])),
                     $role,
                     $action 
                    );
                    $i++;
                }
            }
           // pr($return_result);
            echo json_encode($return_result);
            exit;
            
        } else {
            $this->set('title_for_layout',__('Access Denied'));
            $this->render('/nodirecturl');
        }
    }

	public function admin_add_user($id=""){
		$title_for_layout = "Add User";
		$this->set(compact('title_for_layout'));	
		$action = $id ? "Edited" : "Added";
		if($this->request->is('post') || $this->request->is('put')){
			$req = $this->request->data;
			$isUpload = $this->Custom->uploadImage($req['User']['user_image'], $destination='images/users/', $prefix="user", $oldImg=$req['User']['image']);
			if($isUpload) $req['User']['image'] = $isUpload;
			if($this->User->save($req['User'])){
 				$this->Session->setFlash("User ".$action." Successfully",'success');
 				$this->redirect(array('full_base'=>true,'controller'=>'users','action'=>'users'));
			}else{
				$this->Session->setFlash("Sorry, Please try again",'error');	
			}
		}

		$isExist = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
		$this->request->data = $isExist;
	}

	public function admin_change_status(){
		if($this->request->is('ajax')){
			$req = $this->request->data;
			$this->loadModel($req['model']);
			$save[$req['model']]['id'] = $req['id'];
			$save[$req['model']][$req['field']] = $req['status'];
			if($this->$req['model'] ->save($save)){
				echo 1;
			}else{
				echo 0;
			}
			exit;
		}
	}

	public function admin_email_send($from="",$to="",$sub="",$temp_name='BACK_REGISTER',$lang="eng",$keyword=array("Ganpat","goyal@mailinator.com",'123456')){
		/*$this->loadModel('EmailTemplate');
		$content = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.title'=>$temp_name,'EmailTemplate.language'=>$lang)));
		if($content){
			$kword = explode(",",$content['EmailTemplate']['keyword']);
			$message =  str_replace($kword, $keyword, $content['EmailTemplate']['content']);
			//pr($message);exit;
			$Email = new CakeEmail();
			$Email->template('default', 'default')
			$Email->viewVars(array('message' => $message));
			$Email->sender($from, $sub);	
			    ->emailFormat('both')
			    ->to($to)
			    ->send();
		}*/
		//pr($content); exit;
	}

	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}
