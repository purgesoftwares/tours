<?php
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Users Plugin User Model
 *
 * @package User
 * @subpackage User.Model
 */
class User extends AppModel {

/**
 * Name
 *
 * @var string
 */
	public $name = 'User';


/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'username';
	public $actsAs = array('Containable','Search.Searchable','Utils.Sluggable' => array('label' => 'first_name','method' => 'multibyteSlug'));

/**
* Additional Find methods
*
* @var array
*/
public $findMethods = array('search' => true);


/**
* All search fields need to be configured in the Model::filterArgs array.
*
* @var array
* @link https://github.com/CakeDC/search
*/




public $filterArgs = array(
array('name' => 'username', 'type' => 'string'),
array('name' => 'email', 'type' => 'string'),
array('name' => 'first_name', 'type' => 'string'),
array('name' => 'last_name', 'type' => 'string'));


/**
* hasMany associations
*
* @var array
*/
public $hasMany = array(
'UserDetail' => array(
'className' => 'UserDetail',
'foreignkey' => 'user_id'));

public $belongsTo = array(
'Parent' => array(
'className' => 'User',
'foreignkey' => 'parent_id'));



/**
 * Validation parameters
 *
 * @var array
 */
 
	/* public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		//validation for cms updation
		$this->validate = array(
						'name' => array(
							'required' => array(
								'rule' => array('notEmpty'),
								'required' => true, 'allowEmpty' => false,
								'message' => 'Please enter a name.')),
						'password' => array(
							'required' => array(
								'rule' => array('notEmpty'),
								'required' => true, 'allowEmpty' => false,
								'message' => 'Please enter a password.'))
				); 
		}  */
	
	 public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		//validation for cms updation
		$this->validate = array(
							'name' => array(
								'required' => array(
									'rule' => array('notEmpty'),
									'required' => true, 'allowEmpty' => false,
									'message' => __('Please enter a name.')
										)
									),
							'password' => array(
								'required' => array(
														'rule' => array('notEmpty'),
														'required' => true, 'allowEmpty' => false,
														'message' => __('Please enter a password.')
													)
												)
								); 
		} 
		

	

/**
 * Constructor
 *
 * @param string $id ID
 * @param string $table Table
 * @param string $ds Datasource
 */
	/* public function __construct($id = false, $table = null, $ds = null) {
		$this->_setupBehaviors();
		//pr($this);
		parent::__construct($id, $table, $ds);
		
		
	} */

/**
 * Setup available plugins
 *
 * This checks for the existence of certain plugins, and if available, uses them.
 *
 * @return void
 * @link https://github.com/CakeDC/search
 * @link https://github.com/CakeDC/utils
 */
	protected function _setupBehaviors() {
		if (App::import('Behavior', 'Search.Searchable')) {
			$this->actsAs[] = 'Search.Searchable';
		}
		if (App::import('Sluggable', 'Utils.Model/Behavior')) {
			$this->actsAs['Utils.Sluggable'] = array(
				'label' => 'name',
				'slug'=> 'slug',
				'method' => 'multibyteSlug');
		}


		
	}
	/**
	 * model validation array
	 *
	 * @var array
	 */
	function LoginValidate() {
		$validate1 = array(
				'username'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter username'))
					),
				'passwd'=>array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter password'))
					)
			);
			
		$this->validate=$validate1;
		return $this->validates();
	}
	/**
	 * model validation array
	 *
	 * @var array
	 */
	 function ForgotPasswordValidate() {
		$validate1 = array(
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter email'))
					)
				
			);
			
		$this->validate=$validate1;
		return $this->validates();
	}
	function ResetPasswordValidate(){
		$validate1	=	array(
							'password'=>array(
								'mustNotEmpty'=>array(
								'rule' => 'notEmpty',
								'message'=> __('Please enter password'),
								'on' => 'create',
								'last'=>true)
								),
							'temppassword'=>array('rule1'=>array(
								'rule' => 'notEmpty',
								'message'=> __('Please enter confirm password'),
								'on' => 'create'
								),
								'rule2'=>array(
								'rule'=>'matchpassword',
								'message'=> __('password and confirm password must be matched.')
								)											
							)
								
						);
		$this->validate=$validate1;
		return $this->validates();
	}
	public function matchpassword(){
		$password		=	$this->data['User']['password'];
		$temppassword	=	$this->data['User']['temppassword'];
		if($password==$temppassword)
			return true;
		else
			return false;
	
	}
	/**
	 * model validation array
	 *
	 * @var array
	 */
	function RegisterValidate() {
		$validate1 = array(
				'username'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter username'),
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>__('This username already taken'),
					'last'=>true),
					'mustBeLonger'=>array(
						'rule' => array('minLength', 4),
						'message'=> __('Username must be greater than 3 characters'),
						'last'=>true),
					),
				'first_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter first name'))
					),
				'last_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'on' => 'create',
						'message'=> __('Please enter last name'))
					),
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter email'),
						'last'=>true),
					'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => __('Please enter valid email'),
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>__('This email is already registered'),
						)
					),
				'password'=>array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter password'),
						'on' => 'create',
						'last'=>true),
					'mustBeLonger'=>array(
						'rule' => array('minLength', 6),
						'message'=> __('Password must be greater than 5 characters'),
						'on' => 'create',
						'last'=>true),
					'mustMatch'=>array(
						'rule' => array('verifies'),
						'message' => __('Both passwords must match')),
						//'on' => 'create'
					)
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	/**
	 * model validation array
	 *
	 * @var array
	 */
	function EditValidate() {
		$validate1 = array(
				'username'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter username'),
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>__('This username already taken'),
					'last'=>true),
					'mustBeLonger'=>array(
						'rule' => array('minLength', 4),
						'message'=> __('Username must be greater than 3 characters'),
						'last'=>true),
					),
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter email'),
						'last'=>true),
					'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => __('Please enter valid email'),
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>__('This email is already registered'),
						)
					),
					/* 'password'=>array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter password',
						'on' => 'create',
						'last'=>true),
					'mustBeLonger'=>array(
						'rule' => array('minLength', 6),
						'message'=> 'Password must be greater than 5 characters',
						'on' => 'create',
						'last'=>true),
					'mustMatch'=>array(
						'rule' => array('verifies'),
						'message' => 'Both passwords must match'),
						//'on' => 'create'
					) */
					'old_password'=>array(
						'rule1' => array(
							'rule' => 'notEmpty',
							'message' => __('Please enter your old password'),
							'last'=>true
						),
						'rule2' => array(
							'rule' => 'checkpassword',
							'message' => __('Please enter correct old password'),
							'last'=>true
						)
					), 
					'password'=>array(
						'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter password'),
						'last'=>true)
					),
					'cpassword'=>array('rule1'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter confirm password'),
						),
						'rule2'=>array(
						'rule'=>'matchuserspassword',
						'message'=> __('Password and confirm password does not match.')
						)											
					)
				
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	
	public function checkpassword(){
	
		// pr($this->data); die;
	
		$password	=	$this->data['User']['old_password'];
		$user_pass	=	$this->data['User']['user_pass'];
		
		if(Security::hash($password, 'sha1', true) == $user_pass) {
			return true;
		} else {
			return false;
		}
	}
	
	public function matchuserspassword(){
		$password		=	$this->data['User']['password'];
		$temppassword	=	$this->data['User']['cpassword'];
		if($password==$temppassword)
			return true;
		else
			return false;
	
	}
	
	
	/**
	 * Used to match passwords
	 *
	 * @access protected
	 * @return boolean
	 */
	protected function verifies() {
		return ($this->data['User']['password']===$this->data['User']['cpassword']);
	}
/**
	 * Used to send registration mail to user
	 *
	 * @access public
	 * @param array $user user detail array
	 * @return void
	 */
	public function sendRegistrationMail($user) {
		// send email to newly created user
		$userId=$user['User']['id'];
		$email = new CakeEmail();
		$fromConfig = Configure::read('site.emailFromAddress');
		$fromNameConfig = Configure::read('site.emailFromName');
		$email->from(array( $fromConfig => $fromNameConfig));
		$email->sender(array( $fromConfig => $fromNameConfig));
		$email->to($user['User']['email']);
		$email->subject(__('Your registration is complete'));
		//$email->transport('Debug');
		$body= __("Welcome ").$user['User']['first_name'].__(", Thank you for your registration on ").Router::url("/",true)." \n\n".__(" Thanks,")."\n".Configure::read('site.emailFromName');
		try{
			$result = $email->send($body);
		} catch (Exception $ex) {
			// we could not send the email, ignore it
			$result=__("Could not send registration email to userid-").$userId;
		}
		$this->log($result, LOG_DEBUG);
	}
	/**
	 * Used to send email verification mail to user
	 *
	 * @access public
	 * @param array $user user detail array
	 * @return void
	 */
	public function sendVerificationMail($user) {
		$userId=$user['User']['id'];
		$email = new CakeEmail();
		$fromConfig = Configure::read('Site.email');
		$fromNameConfig = Configure::read('site.emailFromName');
		$email->from(array( $fromConfig => $fromNameConfig));
		$email->sender(array( $fromConfig => $fromNameConfig));
		$email->to($user['User']['email']);
		$email->subject('Email Verification Mail');
		$activate_key = $this->getActivationKey($user['User']['passwd']);
		$link = Router::url("user_verification/$userId/$activate_key",true);
		
		$body=__("Hi ").$user['User']['first_name'].__(", Click the link below to complete your registration")." \n\n ".$link;
		try{
			$result = $email->send($body);
			$this->updateAll(array('email_token' =>"'".$activate_key."'"),array('id'=>$userId));
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result=__("Could not send verification email to userid-").$userId;
		}
		$this->log($result, LOG_DEBUG);
	}
	/**
	 * Used to generate activation key
	 *
	 * @access public
	 * @param string $password user password
	 * @return hash
	 */
	public function getActivationKey($password) {
		$salt = Configure::read ( "Security.salt" );
		return md5(md5($password).$salt);
	}
	/**
	 * Used to send forgot password mail to user
	 *
	 * @access public
	 * @param array $user user detail
	 * @return void
	 */
	public function forgotPassword($user) {
		$userId=$user['User']['id'];
		$email = new CakeEmail();
		$fromConfig = Configure::read('Site.email');
		$fromNameConfig = Configure::read('site.emailFromName');
		$email->from(array( $fromConfig => $fromNameConfig));
		$email->sender(array( $fromConfig => $fromNameConfig));
		$email->to($user['User']['email']);
		$email->subject( Configure::read('site.emailFromName').': Request to Reset Your Password');
		$activate_key = $this->getActivationKey($user['User']['passwd']);
		$link = Router::url("activate_password/$userId/$activate_key",true);
		
		$body= __("Welcome ").$user['User']['first_name'].__(", let's help you get signed in
You have requested to have your password reset on "). Configure::read('site.emailFromName').__(". Please click the link below to reset your password now :
").$link.__("
If above link does not work please copy and paste the URL link (above) into your browser address bar to get to the Page to reset password

Choose a password you can remember and please keep it secure.

Thanks,")."\n".Configure::read('site.emailFromName');
		try{
			$result = $email->send($body);
			$this->updateAll(array('password_key' =>"'".$activate_key."'"),array('id'=>$userId));
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result= __("Could not send forgot password email to userid-").$userId;
		}
		$this->log($result, LOG_DEBUG);
	}

	/**
	 * Used to get name by user id
	 *
	 * @access public
	 * @param integer $userId user id
	 * @return string
	 */
	public function getNameById($userId) {
		$res = $this->findById($userId);
		$name=(!empty($res)) ? ($res['User']['first_name'].' '.$res['User']['last_name']) : '';
		return $name;
	}
	
	/**
 * afterFind callback
 *
 * @param array $results Result data
 * @param mixed $primary Primary query
 * @return array
 */
	/* public function afterFind($results, $primary = false) {
		
		foreach ($results as &$row) {
			
			if (isset($row['User']) && (is_array($row))) {
				
				if(!empty($row['User'])){
					foreach($row['User'] as $details) {
					$fields = explode('.', $details['field']);
					if(count($fields) == 3){
						$row[$fields[0]][$fields[1]][$fields[2]] = $details['value'];
					}else{
					$row[$fields[0]][$fields[1]] = $details['value'];
					}
				} 
					
				}else {
					$row['User']['first_name'] = '';
					$row['User']['last_name'] = '';
				}
				
			}
			
		}
		return $results;
	} */


}
