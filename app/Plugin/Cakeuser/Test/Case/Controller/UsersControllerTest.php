<?php
App::uses('UsersController', 'Cakeuser.Controller');
App::uses('AuthComponent', 'Controller/Component');

/**
 * UsersController Test Case
 *
 */
class UsersControllerTestCase extends ControllerTestCase {
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

/**
 * testRegister method
 *
 * @return void
 */
	public function testRegister() {
		//new page
		$this->testAction('/cakeuser/users/register',
								array('return'=>'contents'));
		$this->assertRegExp('/<html/', $this->contents);
		$this->assertRegExp('/<form/', $this->view);
		//post to register
		$data['User']['email']     = 'test@gmail.com';
		$data['User']['password']  = 'test';
		$data['User']['password2'] = 'test';
		$this->testAction('/cakeuser/users/register',
				array('return'=>'contents','data'=>$data,'method'=>'POST'));
		$this->assertRegExp('/<html/', $this->contents);
		$this->assertRegExp('/<form/', $this->view);
		
	}
	
/**
 * testRegister method
 *
 * @return void
 */
    public function testVerify() {      
        $this->testAction('/cakeuser/users/verify/123456',
                                array('return'=>'contents'));
                            
        $this->assertContains('/users/register', $this->headers['Location']);
    }
	    
    public function testLogin() {
    	
    	$email    = 'thedilab@gmail.com';
    	$password = AuthComponent::password('1234564789');
    	$data = array(
            'email' => $email,
            'password' => $password,          
            'status' => 1
        ); 
        $this->User->create();       
        $this->User->save($data);
        
     
        //success login
        $postData['User']['email']    = $email;
        $postData['User']['password'] = $password;        
        $this->testAction('/cakeuser/users/login',
                array('return'=>'contents','data'=>$postData,'method'=>'POST'));
        $this->assertContains('/users/profile', $this->headers['Location']);   
        
        //logout
         $this->testAction('/cakeuser/users/logout',
                array('return'=>'contents'));
        
        //fail login
        $postData2['User']['email']    = $email;
        $postData2['User']['password'] = '123';
        
        $this->testAction('/cakeuser/users/login',
                array('return'=>'view','data'=>$postData2,'method'=>'POST'));
               
        $this->assertRegExp('/<form/', $this->view);
        
        
        
        //logout
         $this->testAction('/cakeuser/users/logout',
                array('return'=>'contents'));
      
                
         //inactive user login
                   
        $email    = 'another@gmail.com';
        $password = AuthComponent::password('1234564789');
        $data = array(
            'email' => $email,
            'password' => $password,          
            'status' => 0
        ); 
        $this->User->create();       
        $this->User->save($data);
        
        $postData3['User']['email']    = $email;
        $postData3['User']['password'] = $password;
        
        $this->testAction('/cakeuser/users/login',
                array('return'=>'view','data'=>$postData3,'method'=>'POST'));
               
        $this->assertRegExp('/<form/', $this->view);
    }
    
    public function testLogout() {            
        $this->testAction('/cakeuser/users/logout',
                array('return'=>'contents'));
        $this->assertContains('/users/login', $this->headers['Location']);   
    }
    
    public function testForgetPassword() {
    	//new page
    	$this->testAction('/cakeuser/users/forget_password',
    			array('return'=>'view','method'=>'GET'));
    	
    	$this->assertRegExp('/<form/', $this->view);
    	
    	//post
    	//post to forget_password
		$data['User']['email']     = 'test@gmail.com';
		$this->testAction('/cakeuser/users/forget_password',
				array('return'=>'contents','data'=>$data,'method'=>'POST'));
		//debug( $this->contents); ob_flush();
		$this->assertRegExp('/<html/', $this->contents);
		$this->assertRegExp('/<form/', $this->view);
    }
    
    public function testResetPassword() {
    	//new page
    	$this->testAction('/cakeuser/users/reset_password/1234',
    			array('return'=>'view','method'=>'GET'));
    	//debug($this->headers); ob_flush();
    	$this->assertEqual(null!=$this->headers, true);
    
    }
}
