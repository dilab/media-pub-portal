<?php
App::uses('User', 'Cakeuser.Model');
App::uses('Security', 'Utility');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User Test Case
 * @property User $User
 */
class UserTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.cakeuser.user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('Cakeuser.User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);
		parent::tearDown();
	}
	

	
	public function testRegister() {
		$data1['User']['email']     = 'test';
		$data1['User']['password']  = 'test';
		$data1['User']['password2'] = 'test';
		$result1 = $this->User->register($data1);
		
		$data2['User']['email']     = 'test@gmail.com';
		$data2['User']['password']  = 'test';
		$data2['User']['password2'] = 'test';
		$result2 = $this->User->register($data2);
		
		
		$this->assertEqual($result1,null);
		$this->assertEqual(is_array($result2), true);
	}
	
	public function testVerify() {
		$vcode = Security::hash(time());
		$data = array(
            'email' => 'thedilab@gmail.com',
            'password' => AuthComponent::password('1234564789'),
            'verification_code' => $vcode,
            'status' => 0
        );        
        $this->User->save($data);        
        
        $result = $this->User->verify($vcode);        
        $this->assertEqual(false!=$result,true);
	}
	
	public function testForgetPassword() {
		//verified user
		$email = 'thedilab@gmail.com';
		$data['User']['email']     = $email;
		$data['User']['status']    = 1;
	    $this->User->save($data,false);
	
		$result = $this->User->forgetPassword($email);
		$this->assertEqual(null!=$result, true);
		
		
		//unverified user
		$email = 'test@gmail.com';
		$data['User']['email']     = $email;
		$data['User']['status']    = 0;
		$this->User->save($data,false);
		
		$result = $this->User->forgetPassword($email);
		$this->assertEqual($result, null);
		
	}
	
	public function testCheckResetPassword() {
		$vcode = Security::hash('123456789');
		//verified user
		$email = 'thedilab@gmail.com';
		$data['User']['email']     = $email;
		$data['User']['status']    = 1;
		$data['User']['last_email_sent']      = date('Y-m-d H:i:s');
		$data['User']['verification_code']    = $vcode;
		$this->User->save($data,null);
		
		//valid
		$result = $this->User->checkResetPassword($vcode);
		$this->assertEqual(null!=$result,true);
		
		//wrong vcode
		$result = $this->User->checkResetPassword('123');
		$this->assertEqual($result,null);
		
		
		//expire link
		$vcode = Security::hash('123456789');
		$email = 'thedilab2@gmail.com';
		$data['User']['email']     = $email;
		$data['User']['status']    = 1;
		$data['User']['last_email_sent']      = date('Y-m-d '.date('H').':'.(date('i')+20).':'.date('s'));
		$data['User']['verification_code']    = $vcode;
		$this->User->save($data,null);
		
		$result = $this->User->checkResetPassword($vcode); 
		$this->assertEqual($result,null);
	}
	
	public function testResetPassword() {
		$vcode = Security::hash('123456789');
		//verified user
		$email = 'thedilab@gmail.com';
		$data['User']['email']     = $email;
		$data['User']['status']    = 1;
		$data['User']['last_email_sent']      = date('Y-m-d H:i:s');
		$data['User']['verification_code']    = $vcode;
		$this->User->save($data,false);
		
		
		//correct behavior
		$postData['User']['password']  = 'test123';
		$postData['User']['password2'] = 'test123';
		$result = $this->User->resetPassword($vcode,$postData);
		$this->assertEqual(null!=$result,true);
		
		
		//passwords do not match
		$postData['User']['password']  = 'test123';
		$postData['User']['password2'] = 'test1234';
		$result = $this->User->resetPassword($vcode,$postData);
		$this->assertEqual($result,null);
		
		//passwords empty
		$postData['User']['password']  = '';
		$postData['User']['password2'] = 'test123';
		$result = $this->User->resetPassword($vcode,$postData);
		$this->assertEqual($result,null);
		
	}
	
	
}
