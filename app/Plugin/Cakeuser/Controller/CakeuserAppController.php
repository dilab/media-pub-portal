<?php
class CakeuserAppController extends AppController {
	
	public $components = array('Auth');
	public $helpers    = array('Html','Js','Session');
	
    public function beforeFilter() {
    	parent::beforeFilter();
    	
    	$this->Auth->loginAction =array(
                'controller' => 'users',
                'action' => 'login',
                'plugin' => 'cakeuser');
    	
        $this->Auth->authenticate    = array(
                'Form' => array(
                    'userModel' =>'Cakeuser.User',
                    'fields' => array('username' => 'email'),
                    'scope'  => array('User.status'=>1)
                )
        );
        
        //role based login url
       /* if($this->request->params['action']=='admin_login') {
            $this->Auth->authenticate['Form']['scope']    = array('User.role' =>ADMIN,'User.status'=>1);
        } elseif($this->request->params['action']=='login'){
            $this->Auth->authenticate['Form']['scope']    = array('User.role' =>MEMBER,'User.status'=>1);
        }*/
    }
    
    public function _beforeRegister($postData) {
        //use this callback to perform own bussiness logic
        if (method_exists('AppController', '_beforeRegister')) {
            return parent::_beforeRegister($postData);
        }
        return true;
    }
        
    public function _afterRegister($user,$postData) {
        //use this callback to perform own bussiness logic
        if (method_exists('AppController', '_afterRegister')) {
            parent::_afterRegister($user,$postData);
        }       
    }
    
    public function _redirect() {
        //use this callback to perform own bussiness logic
        if (method_exists('AppController', '_redirect')) {
            return parent::_redirect();
        } 
    }
    
    
    /*
     * For remember me to work
     * Add function below to AppController beforeFilter()
     */
    /*    
    public function restoreLoginFromCookie() { 
        $this->Cookie->name = 'rememberMe';
        $cookie = $this->Cookie->read('User'); 
        if (!empty($cookie) && !$this->Auth->user()) {
            $data['User']['email'] = $cookie['email'];
            $data['User']['password'] = $cookie['password'];          
            $this->Auth->login($data);
        }
    }*/
}