<?php
/**
 * Copyright 2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Usermgmt Plugin Customer Model
 *
 * @package Usermgmt
 * @subpackage Usermgmt.models
 */
 //App::uses('Security', 'Utility');
class Customer extends UsermgmtAppModel {

/**
 * Name
 *
 * @var string
 */
	public $name = 'Customer';
	public $useTable='users';
	public $virtualFields  = array();

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable','Search.Searchable','Utils.Sluggable' => array('label' => 'first_name','method' => 'multibyteSlug'));
						  
						  
						  

/**
 * Additional Find methods
 *
 * @var array
 */
	public $_findMethods = array('search' => true);

/**
 * @todo comment me
 *
 * @var array
 */
	public $filterArgs = array(
						array('name' => 'first_name', 
						  'type' => 'string'
							),
						array('name' => 'email', 
							  'type' => 'string'
							 ),
						array('name' => 'username', 
							  'type' => 'string'
							 )
						);

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'name';

/**
 * hasMany associations
 *
 * @var array
 */
	//public $hasMany = array();
	public $hasMany = array('UserDetail' => array('className' => 'Usermgmt.UserDetail','foreignkey' => 'user_id'));

/**
 * Validation parameters
 *
 * @var array
 */
	public $validate = array();

/**
 * Constructor
 *
 * @param string $id ID
 * @param string $table Table
 * @param string $ds Datasource
 */
	  public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		//validation for cms updation
		$this->virtualFields  = array(
			/* 'company'=> "SELECT field_value  FROM  user_details WHERE user_id=".$this->alias.".id AND  field_name = 'User.company'",'contact_person'=> "SELECT field_value  FROM  user_details WHERE user_id=".$this->alias.".id AND  field_name = 'User.contact_person'" */
			);
			
		}
	function CustomerValidate() {
			$validate1 = array(
				'first_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter first name.')
					)
				),
				'last_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter last name.')
					)
				),
				'password'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter password.')
					)
				),
				'cpassword'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter confirm password.')
					),
					'mustMatch'=>array(
						'rule' => 'matchpassword',
						'message'=> __('Both passwords did not matched.')
					),
				),
				'user_image'=>array(
					'rule1' => array(
						'rule' => 'checkEmpty',
						'message' => __('Please upload a image.'),
						'on'=>'create',
						'last'=>true
					),
					'rule2' => array(
						'rule' => 'isValidImageFile',
						'message' => __('File type not allowed.'),
						'on'=>'create',
						'last'=>true										
					)/* ,
					'rule3' => array(
						'rule' => 'isValidFileSize',
						'message' => __('File size exceed the limit.'),
						'on'=>'create',
						'last'=>true										
					) */
				) ,	
				'username'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter username.',
						'last'=>true),
				/* 	'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>'This username is already registered.',
					) */
				) /*,	
				'dob'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please select date of birth.')
					)
				) ,
				'telephone'=> array(
					'mustNumeric'=>array(
						'rule' => 'numeric',
						'allowEmpty'=>true,
						'message'=> __('Please enter valid telephone number.')
					)
				),
				'lat_long'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please fill lat long')
					)
				),
				'mobile'=> array(
					'mustNumeric'=>array(
						'rule' => 'numeric',
						'allowEmpty'=>true,
						'message'=> __('Please enter mobile number.')
					)
				) */,
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter email.'),
						'last'=>true),
					'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => __('Please enter valid email.'),
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'checkunique',
						'message' =>__('This email is already registered.'),
					)
				),
				/* 'country'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please select country.')
					),
				'city'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please select city.')
				),
				'state'=>array(
						'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter state.')
				),*/
				'bond_limit'=>array(
					'mustNumeric'=>array(
					'rule' => 'numeric',
					'allowEmpty'=>true,
					'message'=> __('Please enter numeric bond limit.'))
				) 
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	function CustomerEditValidate() {
			$validate1 = array(
				'first_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter first name.')
					)
				),
				'last_name'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter last name.')
					)
				),
				'user_image'=>array(
					'rule1' => array(
						'rule' => 'checkEmpty',
						'message' => __('Please upload a image.'),
						'on'=>'create',
						'last'=>true
					),
					'rule2' => array(
						'rule' => 'isValidImageFile',
						'message' => __('File type not allowed.'),
						'on'=>'create',
						'last'=>true										
					),
					'rule3' => array(
						'rule' => 'isValidFileSize',
						'message' => __('File size exceed the limit.'),
						'on'=>'create',
						'last'=>true										
					)
				)/* ,	
				'username'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter username.',
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'isUnique',
						'message' =>'This username is already registered.',
					)
				) */,	
				'dob'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please select date of birth.')
					)
				),
				'telephone'=> array(
					'mustNumeric'=>array(
						'rule' => 'numeric',
						'allowEmpty'=>true,
						'message'=> __('Please enter valid telephone number.')
					)
				),
				'lat_long'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please fill lat long')
					)
				),
				'mobile'=> array(
					'mustNumeric'=>array(
						'rule' => 'numeric',
						'allowEmpty'=>true,
						'message'=> __('Please enter mobile number.')
					)
				),
				'email'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter email.'),
						'last'=>true),
					'mustBeEmail'=> array(
						'rule' => array('email'),
						'message' => __('Please enter valid email.'),
						'last'=>true),
					'mustUnique'=>array(
						'rule' =>'checkunique',
						'message' =>__('This email is already registered.'),
					)
				),
				/* 'country'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please select country.')
					),
				'city'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please select city.')
				),
				'state'=>array(
						'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> 'Please enter state.')
				),
				'zipcode'=>array(
					'mustNumeric'=>array(
					'rule' => 'numeric',
					'allowEmpty'=>true,
					'message'=> __('Please enter valid zipcode.'))
				) */
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	
	function promoterPasswordValidate() {
			$validate1 = array(
				'password'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter password.')
					)
				),
				'cpassword'=> array(
					'mustNotEmpty'=>array(
						'rule' => 'notEmpty',
						'message'=> __('Please enter confirm password.')
					),
					'mustMatch'=>array(
						'rule' => 'matchpassword',
						'message'=> __('Both passwords did not matched.')
					),
				) 
			);
		$this->validate=$validate1;
		return $this->validates();
	}
	
	public function checkuniquemailadd() {
		
		$check_role_id = 2;
		
		$this->MyModel = ClassRegistry::init('User');
		$this->MyModel->recursive = -1;
		
		$user = $this->MyModel->find('count',array('conditions'=>array('email'=>$this->data['Customer']['email'],'user_role_id !=' => $check_role_id )));
		
		if($user== 0)
			return true;
		else
			return false; 
	}
	
	public function checkuniquemail() {
		$this->MyModel = ClassRegistry::init('User');
		$this->MyModel->recursive = -1;
		
		$user = $this->MyModel->find('count',array('conditions'=>array('email'=>$this->data['Customer']['email'],'id !='=>$this->data['Customer']['id'] )));
		if($user== 0)
			return true;
		else
			return false; 
	}
	public function checkEmpty($data){
	
		if(isset($data['user_image']) && $data['user_image']['size']==0){
			return false;
		}
		else{
			return true;
		}
	}
	public function isValidImageFile($data){
		$valid_types 	= 	Configure::read('valid_image_types');
		$file			=	$data['user_image']['name'];
		$ext 			=	strtolower(substr($file,strrpos($file,".") + 1));
		if (isset($data['user_image']) && !in_array($ext,$valid_types)) {
			return false;	
		}
		else{ 
			return true;
		}
	}	
	public function isValidFileSize($data){
		$filesize	=	$data['user_image']['size'];
		if(isset($data['user_image']) && $filesize > Configure::read('valid_image_size'))
			return false;
		else
			return true;
	}		
	
	/**
 * afterFind callback
 *
 * @param array $results Result data
 * @param mixed $primary Primary query
 * @return array
 */
	public function afterFind($results, $primary = false) {
		//pr($results);exit;
		
		foreach ($results as &$row) {
			
			if (isset($row['UserDetail']) && (is_array($row))) {
				$row[$this->alias]['first_name']	= 	'';
				$row[$this->alias]['last_name']		= 	'';
				$row[$this->alias]['gender']		= 	'';
				$row[$this->alias]['dob']			= 	'';
				$row[$this->alias]['industry']		= 	'';
				$row[$this->alias]['phone_no']		= 	'';
				$row[$this->alias]['address']		= 	'';
				$row[$this->alias]['country']		= 	'';
				$row[$this->alias]['state']			= 	'';
				$row[$this->alias]['city']			= 	'';
				$row[$this->alias]['zipcode']			= 	'';
				
				if(!empty($row['UserDetail'])){
					foreach($row['UserDetail'] as $details) {
					$fields = explode('.', $details['field_name']);
					if(count($fields) == 3){
						$row[$this->alias][$fields[1]][$fields[2]] = $details['field_value'];
					}else{
							$row[$this->alias][$fields[1]] = $details['field_value'];
					}
				} 
					
				}
				
			}
			
		}

		return $results;
	}
	
	public function validDate(){
		$month	=	$this->data['Customer']['dob']['month'];
		$day	=	$this->data['Customer']['dob']['day'];
		$year	=	$this->data['Customer']['dob']['year'];
		if(checkdate( $month, $day , $year ))
			return true;
		else
			return false;
	}	
	
	public function matchpassword(){
		$password		=	$this->data['Customer']['password'];
		$temppassword	=	$this->data['Customer']['cpassword'];
		if($password==$temppassword)
			return true;
		else
			return false;
	
	}
	
	public function checkunique(){
		//$this->id;
		if($this->id!=""){
			$userdata	=	$this->find('count',array('conditions'=>array('email'=>$this->data['Customer']['email'],'is_deleted'=>0,'is_potential'=>0,'id !='=>$this->id)));
		}else{
			$userdata	=	$this->find('count',array('conditions'=>array('email'=>$this->data['Customer']['email'],'is_deleted'=>0,'is_potential'=>0)));
		}
	
		if($userdata == 0){
				return true;
			}
		else{
				return false;
		}
	
	}
	
	
	
	
	
	
}

