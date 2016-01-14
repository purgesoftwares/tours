<?php
class PhotographersController extends UsermgmtAppController {


	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'Photographers';
	
	/**
	 * Helpers
	 *
	 * @var array
	 */
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');

	/**
	 * $presetVars
	 *
	 * @var array $presetVars
	 */
	public $presetVars = array(
		array('field' => 'first_name', 'type' => 'value'),
		array('field' => 'email', 'type' => 'value'),
		array('field' => 'username', 'type' => 'value'),
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
	 * Admin Index
	 *
	 * @return void
	 */	
	public function index() {
		// Breadcrumb
		$pageHeading = __('Photographers');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
	
		$breadcrumb = array('pages' => $pages, 'active' =>$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['Photographer.user_role_id'] = Configure::read('user_roles.photographer');
		
		if($this->Auth->user('id') != 1 && $this->Auth->user('user_role_id')!=4){
		$parsedConditions['Photographer.parent_id'] = $this->Auth->user('id');
		}
		
		$this->paginate = array(
			'conditions' => $parsedConditions,
			'limit' => -1,
			//'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$result= $this->paginate();
		// pr($result);
		$this->set('result', $result);		
	}	
		
	public function generatereport(){ 
			
			$this->layout	= false;
			$header = array(__("User Id"),__("First Name"), __("Last Name"), __("User Name"), __("Email"),__("Created"),__("Modified"));
			
			$rdata 	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.photographer'),'is_deleted'=>0)));
				$data = array();
				foreach($rdata as $key => $ddata){
					
					$data[$key]['id']					=	$ddata[$this->modelClass]['id'];
					$data[$key]['first_name']			=	$ddata[$this->modelClass]['first_name'];
					$data[$key]['last_name']			=	$ddata[$this->modelClass]['last_name'];
					$data[$key]['username']				=	$ddata[$this->modelClass]['username'];
					$data[$key]['email']				=	$ddata[$this->modelClass]['email'];
					$data[$key]['created']				=	$ddata[$this->modelClass]['created'];
					$data[$key]['modified']				=	$ddata[$this->modelClass]['modified'];
				}
				$this->export_file($header,$data,'csv');
			exit;
			
			
	}
	
	public function generate_pdf(){
			
			$this->layout	= false;
			$header = array(__("User Id"),__("First Name"), __("Last Name"), __("User Name"), __("Email"),__("Created"),__("Modified"));
			
			$rdata 	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.photographer'),'is_deleted'=>0)));
				$data = array();
				foreach($rdata as $key => $ddata){
					
					$data[$key]['id']					=	$ddata[$this->modelClass]['id'];
					$data[$key]['first_name']			=	$ddata[$this->modelClass]['first_name'];
					$data[$key]['last_name']			=	$ddata[$this->modelClass]['last_name'];
					$data[$key]['username']				=	$ddata[$this->modelClass]['username'];
					$data[$key]['email']				=	$ddata[$this->modelClass]['email'];
					$data[$key]['created']				=	$ddata[$this->modelClass]['created'];
					$data[$key]['modified']				=	$ddata[$this->modelClass]['modified'];
				}
				$this->export_file($header,$data,'pdf');
			exit;
	}
	
	
	/**
	 * Add a new photographer in the system
	 * 
	 * @param integer void
	 * @return void
	 */

	function add($id = null) {
		// Breadcrumb
		$pageHeading = 'photographer';
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Photographers', true)] = array('action' => 'index');
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add').' '.$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		$this->set('drop_downs', $this->getDropDown(array('photographer_types')));
		$this->set('states', $this->getStatesList());
		
		//Read values from database and edit  the record
		if (!empty($this->data)) {
			$this->{$this->modelClass}->set($this->data);			
			// check validations
			if($this->{$this->modelClass}->photographerValidate()) {	
				//pr($this->data); die;
				// $passwd	=	$this->request->data[$this->modelClass]['password'];
				$this->request->data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.photographer');
				// $this->request->data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
				
				$data =  $this->data;
				$data[$this->modelClass]['parent_id'] = $this->Auth->user('id');
				$data[$this->modelClass]['last_activity'] = time();
				
				if ($this->{$this->modelClass}->save($data, array('validate'=>false))) {
					$userId		=	$this->{$this->modelClass}->id;
					$this->{$this->modelClass}->UserDetail->savephotographerProfile($userId,$this->request->data);
					//show message and redirect to listings
					
					 /* if($this->request->data[$this->modelClass]['is_verified'] == 1) {
						$this->loadModel('EmailTemplate');
						$this->loadModel('Setting');
						$this->loadModel('EmailAction');
						$settingsEmail = $this->Setting->find('first', array(
												'conditions' => array(
												'Setting.key ' =>  'Site.email',
												)
										));
						$settingstitle = $this->Setting->find('first', array(
									'conditions' => array(
									'Setting.key ' =>  'Site.title',
									)
							));	
							
						$reg_succ_id	=	Configure::read('global_ids.email_template.verification_email');
						
						$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

						$action 		= $email_template['EmailTemplate']['action'];
						
						$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
						
						$cons = explode(',',$action['EmailAction']['options']);
						$constants = array();
						foreach($cons as $key=>$val){
							$constants[] = '{'.$val.'}';
						}
						$full_name   	=   $this->request->data[$this->modelClass]['first_name'];
						
						$userName   	=   $this->request->data[$this->modelClass]['first_name'];
						
						$varify_link    =   '<a href="'.WEBSITE_URL.'">Click here</a>';
						$website_url    =   WEBSITE_URL;
						$rep_Array = array($userName,$this->request->data[$this->modelClass]['email'],$varify_link,$full_name,$passwd,$website_url); 
					
						$to 				= $this->request->data[$this->modelClass]['email'];
						$from_email 		= $settingsEmail['Setting']['value'];
						$from_name 			= $settingstitle['Setting']['value'];
						$from 				= $from_name . "<" . $from_email . ">";

						$replyTo 			= "";
						$subject 			= $email_template['EmailTemplate']['subject'];
						
						$message 			= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);
						
						//pr($message); die;
						$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
					} else {
						$verify_validate_string	=	Security::hash($this->request->data[$this->modelClass]['email'].time(), 'sha1', true);
							
						$validate['validate_string']	= 	$verify_validate_string;
						$this->{$this->modelClass}->id	=	$userId;
						$this->{$this->modelClass}->save($validate);
					 } */
					
					$this->Session->setFlash(__('photographer record has been added.'), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
	/**
	 * Admin Edit Photographers
	 *
	 * @param integer $id user id
	 * @return void
	 */
	function edit($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Photographers', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user) && ($this->Auth->user('id') != $user[$this->modelClass]['parent_id'])) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Photographers', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		
		$this->set('drop_downs', $this->getDropDown(array('photographer_types')));
		$this->set('states', $this->getStatesList());
		// Breadcrumb
			
			
		$AdminData = $user[$this->modelClass]['email'];
		$UserName  = $user[$this->modelClass]['first_name'];
		
		$this->set('AdminData',$AdminData);
		$this->set('UserName',$UserName);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pageHeading = 'Photographers';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($user['Photographer']['first_name'], true));
		/* code start for users messages */
			
		$this->{$this->modelClass}->id = $id; 
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);

		$this->set('id', $id);
		if(empty($this->data)){ // if form not submited
			
			$data = $this->{$this->modelClass}->read(); 
			// unset($data[$this->modelClass]['password']); // unset password
			// pr($data); die;
			$this->data			=	$data;
		}else{ // form is submited
			$old_data			= 	$this->{$this->modelClass}->read();
			$data				=	$this->data;
			
			$data[$this->modelClass]['last_activity'] = time();
			$this->data			=	$data;
			//pr($this->data);die;
			$this->{$this->modelClass}->set($this->data);
			// check validation	
			if($this->{$this->modelClass}->PhotographerEditValidate()) {
			//pr($this->data); die;
				
				//pr($this->data); die;
				if ($this->{$this->modelClass}->save($this->data,false)) {
					$this->{$this->modelClass}->UserDetail->savephotographerProfile($id,$this->request->data);
					$this->Session->setFlash(__('photographer record has been updated.'), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
	
	/**
	 * Admin view Photographers profile
	 *
	 * @param integer $id user id
	 * @return void
	 */
	function profile($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Photographers', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user) && ($this->Auth->user('id') != $user[$this->modelClass]['parent_id'])) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Photographers', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		
		$this->set('drop_downs', $this->getDropDown(array('photographer_types')));
		$this->set('states', $this->getStatesList());
		// Breadcrumb
			
			
		$AdminData = $user[$this->modelClass]['email'];
		$UserName  = (!empty($user[$this->modelClass]['company'])?$user[$this->modelClass]['company']:$user[$this->modelClass]['first_name']);
		$this->set('AdminData',$AdminData);
		$this->set('UserName',$UserName);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pageHeading = 'Profile';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($UserName, true));
		/* code start for users messages */
			
		$this->{$this->modelClass}->id = $id; 
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);

		$this->set('id', $id);
		
		$data = $this->{$this->modelClass}->read(); 
		// unset($data[$this->modelClass]['password']); // unset password
		// pr($data); die;
		$this->data			=	$data;
	}
	
	
	function change_password($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Photographers', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Photographers', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		// Breadcrumb
			
			
		$AdminData = $user[$this->modelClass]['email'];
		$UserName  = $user[$this->modelClass]['username'];
		$last_file_name = $user[$this->modelClass]['user_image'];
		$this->set('last_file_name', $last_file_name);
		$this->set('AdminData',$AdminData);
		$this->set('UserName',$UserName);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pageHeading = 'Photographers';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($user['Photographer']['username'], true));
		/* code start for users messages */
			
		$this->{$this->modelClass}->id = $id; 
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);

		$this->set('id', $id);
		if(empty($this->data)){ // if form not submited
			
			$data = $this->{$this->modelClass}->read(); 
			unset($data[$this->modelClass]['password']); // unset password
			$this->data			=	$data;
		}else{ // form is submited
			$old_data			= 	$this->{$this->modelClass}->read();
			$data				=	$this->data;
			
			$this->data			=	$data;
			$this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->photographerPasswordValidate()) {
			//pr($this->data); die;
				
				$this->request->data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
				//pr($this->data); die;
				if ($this->{$this->modelClass}->save($this->data,false)) {
					$this->Session->setFlash(__('photographer Password has been updated.'), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
		
	public function delete(){
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null){
				//$data['is_deleted']	=	1;	
				//$this->{$this->modelClass}->id	=	$this->data['id'];
				$this->loadModel('UserDetail');
				$userDetailDeleted = $this->UserDetail->deleteAll(array(
						'user_id' => $this->data['id']
					), false);
				if($this->{$this->modelClass}->delete($this->data['id'])){
					echo 'Success';
				}else{
					echo 'error';
				}
		    }	
		}	
		exit;
	}
	
	public function status_inactive(){
	if($this->request->is('Ajax')){
			if($this->data['id'] != null){
			$data	=	array();
					$status	=	$this->{$this->modelClass}->find('first',array('conditions'=>array('id'=>$this->data['id'])));
					if($status[$this->modelClass]['active'] == 1){
						$data['active']	=	0;
					}else {
						$data['active']	=	1;
					}
					$this->{$this->modelClass}->id	=	$this->data['id'];
					$this->{$this->modelClass}->save($data,false);
					echo 'Success';
				}
				$this->Session->setFlash(__('Photographer record has been updated.'), 'success');
		}	
		exit;
  }	
  
  
 	function addstates(){
		$json = '{"states":{"state":[{"name":"Alabama","shortCode":"AL"},{"name":"Alaska","shortCode":"AK"},{"name":"American Samoa","shortCode":"AS"},{"name":"Arizona","shortCode":"AZ"},{"name":"Arkansas","shortCode":"AR"},{"name":"Armed Forces Europe","shortCode":"AE"},{"name":"Armed Forces Pacific","shortCode":"AP"},{"name":"Armed Forces the Americas","shortCode":"AA"},{"name":"California","shortCode":"CA"},{"name":"Colorado","shortCode":"CO"},{"name":"Connecticut","shortCode":"CT"},{"name":"Delaware","shortCode":"DE"},{"name":"District of Columbia","shortCode":"DC"},{"name":"Federated States of Micronesia","shortCode":"FM"},{"name":"Florida","shortCode":"FL"},{"name":"Georgia","shortCode":"GA"},{"name":"Guam","shortCode":"GU"},{"name":"Hawaii","shortCode":"HI"},{"name":"Idaho","shortCode":"ID"},{"name":"Illinois","shortCode":"IL"},{"name":"Indiana","shortCode":"IN"},{"name":"Iowa","shortCode":"IA"},{"name":"Kansas","shortCode":"KS"},{"name":"Kentucky","shortCode":"KY"},{"name":"Louisiana","shortCode":"LA"},{"name":"Maine","shortCode":"ME"},{"name":"Marshall Islands","shortCode":"MH"},{"name":"Maryland","shortCode":"MD"},{"name":"Massachusetts","shortCode":"MA"},{"name":"Michigan","shortCode":"MI"},{"name":"Minnesota","shortCode":"MN"},{"name":"Mississippi","shortCode":"MS"},{"name":"Missouri","shortCode":"MO"},{"name":"Montana","shortCode":"MT"},{"name":"Nebraska","shortCode":"NE"},{"name":"Nevada","shortCode":"NV"},{"name":"New Hampshire","shortCode":"NH"},{"name":"New Jersey","shortCode":"NJ"},{"name":"New Mexico","shortCode":"NM"},{"name":"New York","shortCode":"NY"},{"name":"North Carolina","shortCode":"NC"},{"name":"North Dakota","shortCode":"ND"},{"name":"Northern Mariana Islands","shortCode":"MP"},{"name":"Ohio","shortCode":"OH"},{"name":"Oklahoma","shortCode":"OK"},{"name":"Oregon","shortCode":"OR"},{"name":"Pennsylvania","shortCode":"PA"},{"name":"Puerto Rico","shortCode":"PR"},{"name":"Rhode Island","shortCode":"RI"},{"name":"South Carolina","shortCode":"SC"},{"name":"South Dakota","shortCode":"SD"},{"name":"Tennessee","shortCode":"TN"},{"name":"Texas","shortCode":"TX"},{"name":"Utah","shortCode":"UT"},{"name":"Vermont","shortCode":"VT"},{"name":"Virgin Islands, U.S.","shortCode":"VI"},{"name":"Virginia","shortCode":"VA"},{"name":"Washington","shortCode":"WA"},{"name":"West Virginia","shortCode":"WV"},{"name":"Wisconsin","shortCode":"WI"},{"name":"Wyoming","shortCode":"WY"}]}}';
		
		$states = json_decode($json,true);
		// pr($states); die;
		$this->loadModel('State');
		foreach($states['states']['state'] as $state){
			$state['short_code'] = $state['shortCode'];
			$this->State->create();
			$this->State->save($state, true);
		
		}
		
	} 
  
		
}