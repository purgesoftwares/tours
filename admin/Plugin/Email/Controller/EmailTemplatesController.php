<?php
/**
 * Copyright 2012, Gempulse Infotech Pvt. Ltd. (http://www.fullestop.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://www.fullestop.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cms CmsPages Controller
 *
 * @package cms
 * @subpackage CmsPages.controllers
 */

 //uses('sanitize'); 
class EmailTemplatesController extends EmailAppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'EmailTemplates';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Fck','Text');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');

/**
 * $presetVars
 *
 * @var array $presetVars
 */
	public $presetVars = array(
		array('field' => 'name', 'type' => 'value')
	);

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('model', $this->modelClass);
	}

/**
 * Common Index action
 *
 * @return void
 */
	
	public function index() {
		$pages[__('Dashboard')] = array('plugin'=>false,'controller'=>'/');
		$breadcrumb = array('pages'=>$pages, 'active'=>__d('users','Email templates',true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->Prg->commonProcess();
		//$this->{$this->modelClass}->virtualFields	=	array('first_name' => '(SELECT value FROM user_details WHERE user_id = '.$this->modelClass.'.id and field = "User.first_name")', 'last_name' => '(SELECT value FROM user_details WHERE user_id = '.$this->modelClass.'.id and field = "User.last_name")');

		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		
		$this->Paginator->settings[$this->modelClass]['conditions'] = $parsedConditions;
		$this->Paginator->settings[$this->modelClass]['order'] = array($this->modelClass . '.created' => 'desc');
		//$this->Paginator->settings[$this->modelClass]['limit'] = 1;

		$this->{$this->modelClass}->recursive = 0;
		$this->set('result', $this->paginate());	

		$pageHeading	=	__('Email Templates');	
		$this->set('pageHeading',$pageHeading);	
	}
	/*  function for add email template  */
	public function add() {
		 $pages[__('Dashboard')] = array('plugin'=>false,'controller'=>'/');
		$pages[__d('users','Email Templates',true)] = array('plugin'=>'email','controller'=>'email_templates','action'=> 'index');
		$breadcrumb = array('pages'=>$pages, 'active'=>__d('add','Add Email template',true));		
		$this->set('breadcrumb', $breadcrumb); 
		
		if (!empty($this->data)) {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()){
					$this->{$this->modelClass}->save($this->data);
					$this->Session->setFlash(__('Your email template has been saved successfulley.'),'success');
					$this->redirect(array('action' => 'index'));
				}
				else
				{
					$this->set('data',$this->data);
				}
			
		} 
	}
	
	/*  function for edit email template  */
	
	public function edit($id = null) {
	 $pages[__('Dashboard')] = array('plugin'=>false,'controller'=>'/');
		$pages[__('Email Templates')] = array('plugin'=>'email','controller'=>'email_templates','action'=> 'index');
		$breadcrumb = array('pages'=>$pages, 'active'=>__('Edit Email template'));		
		$this->set('breadcrumb', $breadcrumb);
	
		$this->{$this->modelClass}->id = $id; 
		$this->set('id', $id);
		$pageHeading	=	__('Edit Email Templates');	
		$this->set('pageHeading',$pageHeading);	
		
		if (!empty($this->data)) {
		
			$this->{$this->modelClass}->set($this->data);
				if ($this->{$this->modelClass}->save($this->data,false)) {
			
				$this->Session->setFlash(__('Your email template has been updated successfulley.'),'success');
				$this->redirect(array('action' => 'index'));
			}  
				
		}  else {
				
				$this->data = $this->{$this->modelClass}->read();
		}  
	}
	
	/*  function for delete template  */
	
	public function delete($id = null) {
		$this->layout = false;
		if($this->request->is('Ajax')) {
		if($this->data['id'] != null){
				$this->{$this->modelClass}->id = $this->data['id']; 
				$this->{$this->modelClass}->delete($this->data['id']);
				echo 'Success';
			}	
		}
	  exit;	
	}
	
	/*  function for template constant  */
	
	public function constants() {	
		$this->layout 		= 	'ajax';
		$constant_name 	= 	$_POST['constant'];
		//echo $constant_name; die;
		 if($constant_name == 'Registration'){
			$Email_constant	= 	Configure::read('registration');
			
		} else if($constant_name == 'Forgot Password'){
			$Email_constant	= 	Configure::read('forgot_password');
			
		}else if($constant_name == 'VerificationMail'){
			$Email_constant	= 	Configure::read('register_verify');
			
		}else if($constant_name == 'UserPasswordChangedSuccessfully'){
			$Email_constant	= 	Configure::read('reset_forgot_password');
			
		}else if($constant_name == 'PersonalInboxNotification'){
			$Email_constant	= 	Configure::read('personal_inbox_notification');
			
		}else if($constant_name == 'contact_added'){
			$Email_constant	= 	Configure::read('contact_added');
			
		}else if($constant_name == 'booking_confirmation'){
			$Email_constant	= 	Configure::read('booking_confirmation');
			
		}else if($constant_name == 'editing_status_done'){
			$Email_constant	= 	Configure::read('editing_status_done');
			
		}else if($constant_name == 'invoice_reminder'){
			$Email_constant	= 	Configure::read('invoice_reminder');
			
		}else if($constant_name == 'release_email'){
			$Email_constant	= 	Configure::read('release_email');
			
		}else if($constant_name == 'invoice_past_due_email'){
			$Email_constant	= 	Configure::read('invoice_past_due_email');
			
		}else if($constant_name == 'invoice_paid_email'){
			$Email_constant	= 	Configure::read('invoice_paid_email');
			
		}else if($constant_name == 'shoot_feedback'){
			$Email_constant	= 	Configure::read('shoot_feedback');
			
		}else if($constant_name == 'partner_upgradeaddnews_confirmation'){
			$Email_constant	= 	Configure::read('partner_upgradeaddnews_confirmation');
			
		}else if($constant_name == 'partner_highlight_confirmation'){
			$Email_constant	= 	Configure::read('partner_highlight_confirmation');
			
		}else if($constant_name == 'resource_reserve_confirmation_user'){
			$Email_constant	= 	Configure::read('partner_highlight_confirmation');
			
		}else if($constant_name == 'InvoiceSent'){
			$Email_constant	= 	Configure::read('InvoiceSent');
			
		}  
		echo json_encode($Email_constant);
		exit;
	}
}
