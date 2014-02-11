<?php
App::uses('CakeuserAppController', 'Cakeuser.Controller');
App::uses('CakeEmail','Network/Email');
App::uses('Router','Ultility');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends CakeuserAppController {

	public $uses = array('Cakeuser.User');
	
    public function beforeFilter() {
    	parent::beforeFilter();
    	$this->Auth->allow('register','verify','login','forget_password','reset_password');
    }
	
    /**
     * change password method
     */
    public function change_pwd() {
    	
        if (($this->request->is('post'))) {
            
        	$this->request->data['User']['id'] = $this->Auth->User('id');
        	if ($this->User->changePwd($this->request->data)) {
        		$this->request->data = null;
                $this->Session->setFlash(__('Password has been updated'),
                                        'success');
        	} else {        		
                $this->Session->setFlash(__('Unable to update password'),
                                        'error');
        	}
        }
    }
    
	/**
	 * register method
	 *
	 * @return void
	 */
	public function register() {
		$this->layout='login';
		if (!empty($this->request->data)) {
		    if (!$this->_beforeRegister($this->request->data)) {             
                return;
            }            
			$user = $this->User->register($this->request->data);
			if (null!=$user) {
				 //callback
                $this->_afterRegister($user,$this->request->data);
                
				$this->_registerEmail($user);
				$this->request->data = null;
				$this->Session->setFlash(__('Thank you for registering with us, please check your email to confirm your registration'),
										'success');
			}
		}
	}

	/**
	 * _registerEmail method
	 * send registration email to user
	 * @return void
	 */
	private function _registerEmail($user) {		
		$email = new CakeEmail('default');
		$email->template('Cakeuser.registration','Cakeuser.default')
		->emailFormat('html')
		->to($user['User']['email'])
		->viewVars(array('code' => $user['User']['verification_code']))
		->send();
	}

	/**
	 * verification method
	 *
	 * @return void
	 *
	 */
	public function verify($code=null) {
        if (null==$code) {
        	throw new NotFoundException(__('Invalid verification code'));
        }         
        if ($this->User->verify($code)) {
        	$this->Session->setFlash(__('Congratulations, your account has been activated.'),
                                        'success');
        	return $this->redirect(array('action'=>'login'));
        } else {
        	$this->Session->setFlash(__('Invalid verification code'),
                                        'error');
        	return $this->redirect(array('action'=>'register'));
        }
	}

	/**
	 * login method
	 *
	 * @return void
	 *
	 */
	public function login() {
		
	   //go to home page if already login
        if (empty($this->request->data) && $this->Auth->user()) {            
            $this->redirect(array('action'=>'profile','admin'=>false));
            exit;
        }
        
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
            	// set cookie
            	$this->_setCookie();
            	// after login callback
            	$this->User->afterLogin($this->Auth->user('id'));
            	
            	$this->redirect(array('action'=>'profile','admin'=>false));
            } else {
                $this->Session->setFlash(__('Username or password is incorrect'),'error');
            }
        }
        
        $this->set('noAds',true);
	}
	
   /**
     * logout method
     *
     * @return void
     *
     */
    public function logout() {
        $this->Session->destroy();
        $this->Cookie->destroy();
        //$this->redirect($this->Auth->logout());
        $this->redirect('http://www.runsociety.com');
    }

	/**
	 * forget password method
	 *
	 * @return void
	 */
	public function forget_password() {
		$this->layout='login';
		if ($this->request->is('post')) { 
			$user = $this->User->forgetPassword($this->request->data['User']['email']);
	        if (null!=$user) {
	        	$this->_forgetPasswordEmail($user);
	        	$this->Session->setFlash(__('An email has been sent to your email, please follow instruction to reset your password'),'success');
	        	$this->request->data=null;
	        } else {
	            $this->Session->setFlash(__('Please correct the error below'),'error');
	        }
	    }
	}

	/**
	 * _forgetPasswordEmail method
	 * send registration email to user
	 */
	private function _forgetPasswordEmail($user) {
		$email = new CakeEmail('default');
		$email->template('Cakeuser.reset_password','Cakeuser.default')
		->emailFormat('html')
		->to($user['User']['email'])
		->viewVars(array('code' => $user['User']['verification_code']))
		->send();
	}
	
	/**
	 * reset password 
	 *
	 * @return void
	 */
	public function reset_password($code=null) {
		if (null==$code) {
			throw new NotFoundException(__('Invalid verification code'));
		} 
		
		//if valid code
		if (null==$this->User->checkResetPassword($code)) {
			$this->Session->setFlash(__('Invalid verification code, please register an account'),'error');
			return $this->redirect(array('action'=>'register'));
		}
		
		//if post
		if ($this->request->is('post')) {
			if (null!=$this->User->resetPassword($code,$this->request->data)) {
				$this->Session->setFlash(__('Password has been reset'),'success');
				return $this->redirect(array('action'=>'login'));
			} else {
				$this->Session->setFlash(__('Invalid verification code, please register an account'),'error');
				return $this->redirect(array('action'=>'register'));
				
			}
		}
		
		$this->set(compact('code'));
		
	}
	
    /**
     * login method
     *
     * @return void
     */
    public function profile() {
    	$this->_redirect();
    }
    
/**
     * Nice piece of work copied from https://github.com/CakeDC/users
     *
     * @param array Cookie component properties as array, like array('domain' => 'yourdomain.com')
     * @param string Cookie data keyname for the userdata, its default is "User". This is set to User and NOT using the model alias to make sure it works with different apps with different user models across different (sub)domains.
     * @return void
     * @link http://book.cakephp.org/2.0/en/core-libraries/components/cookie.html
     */
    protected function _setCookie($options = array(), $cookieKey = 'User') {
        if (empty($this->request->data['User']['remember_me'])) {
            $this->Cookie->delete($cookieKey);
           
        } else {
            $validProperties = array('domain', 'key', 'name', 'path', 'secure', 'time');
            $defaults = array(
                'name' => 'rememberMe');

            $options = array_merge($defaults, $options);
            foreach ($options as $key => $value) {
                if (in_array($key, $validProperties)) {
                    $this->Cookie->{$key} = $value;
                }
            }

            $cookieData = array(
                'email' => $this->request->data['User']['email'],
                'password' => $this->request->data['User']['password']);
            $this->Cookie->write($cookieKey, $cookieData, true, '1 Month');
        }
        unset($this->request->data['User']['remember_me']);
    }

}