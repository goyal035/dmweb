<?php
App::uses('AuthComponent', 'Controller/Component');
App::uses('Model', 'Model');
class User extends AppModel {
    // other code.

   /* public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password(
          $this->data['User']['password']
        );
        if(isset($this->data['User']['id']) && $this->data['User']['id'] ==""){
        	$this->data['User']['created'] = date('Y-m-d H:i:s'); 	
        }
        $this->data['User']['modified'] = date('Y-m-d H:i:s');
        return true;
    }*/

    public $validate = array(
            'email'=>array(
                array(
                    'rule'=>'notBlank',
                    'message'=>'This field is required.'
                ),
                array(
                    'rule'=>array('email'),
                    'message'=>'Please enter valid email address.'
                ),
                array(
                    'rule'=>'isUniquee',
                    'message'=>'User with this email already registered'
                )
            ),

          
            'fname'=>array(
                array(
                    'rule'=>'notBlank',
                    'message'=>'This field is required.'
                )
            ),
            'lname'=>array(
                array(
                    'rule'=>'notBlank',
                    'message'=>'This field is required.'
                )
            ),

            'password'=>array(
                array(
                        'allowEmpty'=>true,
                        'rule'=>array('between',6,15),
                        'message'=>'Enter 6-15 charecters'
                )
            ),
            'cpassword'=>array(
                array(
                        'rule'=>'comparepwd',
                        'message'=>'Password does not match'
                )
            )   
            /*'email'=>array(
                'required'=>array(
                    'rule'=>'notEmpty',
                    'message'=>'Field is required'
                ),
                'email'=>array(
                    'rule'=>'email',
                    'message'=>'Enter valid email'
                )
            ),
            
            'password'=>array(
                'required'=>array(
                    'rule'=>'notEmpty',
                    'message'=>'Field is required'
                ),
                'length'=>array(
                    'rule'=>array('minLength',6),
                    'message'=>'Field is required'
                ),
                'number'=>array(
                    'rule'=>'numeric',
                    'message'=>'Field is required'
                )
            ),
            
            'confirm_password'=>array(
                'compare'=>array(
                    'rule'=>'myvalid',
                    'message'=>'Confirm password must be same as password'
                )
            ),
            
            'fname'=>array(
                'required'=>array(
                    'rule'=>'notEmpty',
                    'message'=>'Field is required'
                )
            ),
            
            'lname'=>array(
                'required'=>array(
                    'rule'=>'notEmpty',
                    'message'=>'Field is required'
                )
            )*/
        );
        
        public function isUniquee($dd){
            $e_data = $this->find('first',array('conditions'=>array('email'=>$this->data['User']['email'])));
            //prd($this->data); exit;
            if(empty($e_data)){
                return true;
            }else if($e_data['User']['id']==$this->data['User']['id']){
                return true;
            }else{
                return false;
            }
        }
        
        public function comparepwd($dd){ 
            if($this->data['User']['password']!="" && $this->data['User']['password'] != $this->data['User']['cpassword']){
                return false;
            }else{
                return true;
            }
        }
        
        public function beforeSave($options = array()){
            if(isset($this->data['User']['id']) && $this->data['User']['id'] ==""){
                $this->data['User']['created'] = date('Y-m-d H:i:s');   
            }
            $this->data['User']['modified'] = date('Y-m-d H:i:s');

            if(isset($this->data['User']['password']) && $this->data['User']['password'] !="")
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
            else
                unset($this->data['User']['password']);
            //prd($this->data['User']);
        }
}