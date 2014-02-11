<?php
App::uses('CakeuserAppModel', 'Cakeuser.Model');
App::uses('Security', 'Utility');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 */
class User extends CakeuserAppModel {
	
	
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
			'email' => array(
					'email' => array(
							'rule' => array('email'),
							'message' => 'Invalid email address.',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
					'unique' => array(
							'rule' => array('isUnique'),
							'message' => 'This email address has already been taken.',
					)
			),
			'username' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => 'Please enter username',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
				'unique' => array(
						'rule' => 'isUnique',
						'message' => 'This username has already been taken.',
				),
				'alphanumeric' => array(
						'rule' => 'alphanumeric',
						'message' => 'Usernames must only contain letters and numbers.'
				)
			),
			'password' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Password can not be empty'
					),
					'length' => array(
							 'rule'    => array('minLength', '6'),
            				 'message' => 'Minimum 6 characters long'
					),
			),
			'password2' => array(
					'notmatch' => array(
							'rule' => array('compareFields','password','password2'),
							'message' => 'Passwords do not match',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					)
			),
			'status' => array(
							'boolean' => array(
							'rule' => array('boolean'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
						),
			),
			'facebook_id' => array(
					'unique' => array(
							'rule' => array('isUnique'),
							'message' => 'This facebook account has already been taken.',
					)
			),
	);

	public function beforeSave($options = array()) {
		if (isset($this->data['User']['password'] )) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}
	
/**
 * callback afterlogin
 * @param 
 * @return bool
 */
	public function afterLogin($userId) {
		// record last login
		$this->create();
		$this->id = $userId;
		$this->saveField('last_login', date('Y-m-d'));
	}
	
/**
 * change password 
 * @param array $postData data posted from controller
 * @return bool
 */
    public function changePwd($postData) {
        //validate fields
       $this->set($postData);
       if ($this->validates(array('fieldList' => array('id', 'password', 'password2')))) {
            //save to database
            $this->create();
            return $this->save($postData,array('validate'=>false, 'fieldList'=>array('password')));
        }
        return false;
    }
	
/**
 * Validation method to compare two fields
 *
 * @param mixed $field1 Array or string, if array the first key is used as fieldname
 * @param string $field2 Second fieldname
 * @return boolean True on success
 */
	public function compareFields($field1, $field2) {
		if (is_array($field1)) {
			$field1 = key($field1);
		}
		if (isset($this->data[$this->alias][$field1]) && isset($this->data[$this->alias][$field2]) &&
				$this->data[$this->alias][$field1] == $this->data[$this->alias][$field2]) {
			return true;
		}
		return false;
	}

/**
 * register an account
 * @param array $postData data posted from controller
 * @return null/array user record
 */
	public function register($postData) {
		//validate fields
		$this->set($postData);
		if ($this->validates()) {
			//process some data
			$hash 		= Security::hash(time());

			$postData['User']['verification_code'] = $hash;
			$postData['User']['status']			   = 0;
			$postData['User']['role']			   = MEMBER;
			//save to database
			$this->create();
			if ($this->save($postData)) {
				$this->recursive = -1;
				return $this->read(null,$this->id);
			}
		}
		return null;
	}
	
/**
 * verify an user account by verification code
 * 
 * @param string @code verification code
 * @return bool	
 */
	public function verify($code=null) {
	   if (null==$code) {
	   	   return false;
	   } 
	   $user = $this->find('first',array('conditions'=>array('User.verification_code'=>$code),
                                         'contain'=>false));       
       if (null==$user) {
           	return false;
       }
       //already verified user
       if (1==$user['User']['status']) {
       	    return false;
       } else {
       	    $user['User']['status'] = 1;
       	    return $this->save($user,array('fieldList'=>array('status')));
       }
	}
	
/**
 * forget password function
 * 
 * @param email
 * @return null/array
 */
	public function forgetPassword($email) {
		$user = $this->find('first',array('conditions'=>array('User.email'=>trim($email)),
										  'contain'=>false));
		//invalid email
		if (null==$user) {
			$this->invalidate('email',__('Email address does not exsit'));
			return null;
		}
		//unverified user
		if(0==$user['User']['status']) {
			$this->invalidate('email',__('Please verify your account first'));
			return null;
		}
		//reset verification code
		$vCode = Security::hash(time());
		$this->id = $user['User']['id'];
		$this->saveField('verification_code', $vCode);
		$this->saveField('last_email_sent',date('Y-m-d H:i:s',time()));
		
		$this->recursive=-1;
		return $this->read(null,$user['User']['id']);
	}	
	
/**
 * reset password function
 * 
 * @param string $code
 * @return null/array
 */
	public function resetPassword($code=null,$postData) {
		$user = $this->find('first',array('conditions'=>array('User.verification_code'=>$code,'User.status'=>1),
										  'contain'=>false));
		if (null!=$user) {
			$this->set($postData);
			if ($this->validates()) {
				$user['User']['password'] = $postData['User']['password'];
				$user['User']['verification_code'] = null;
				return $this->save($user,false,array('password','verification_code'));
			}
		} 
		return null;
	}

/**
 * check reset password code
 * 
 * @param string 
 * @return null/array
 */
	public function checkResetPassword($code=null) {
		$user = $this->find('first',array('conditions'=>array('User.verification_code'=>$code,'User.status'=>1),
										  'contain'=>false));
		//invalid verification code
		if (null==$user) {
			return null;
		} 
		//link expired
		$oneMinute = 60;
		if (strtotime($user['User']['last_email_sent'])-time() >
							($oneMinute*Configure::read('ResetPasswordExpire')) ) {
			return null;
		}
		return $user;		
	}
	
}
