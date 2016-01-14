<?php
class ClientsController extends UsermgmtAppController {


	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'Clients';
	
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
		$pageHeading = __('Clients');
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
		$parsedConditions['Client.user_role_id'] = Configure::read('user_roles.client');
		
		if($this->Auth->user('id') != 1 && $this->Auth->user('user_role_id')!=4){
		$parsedConditions['Client.parent_id'] = $this->Auth->user('id');
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
			
			$rdata 	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.client'),'is_deleted'=>0)));
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
			
			$rdata 	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.client'),'is_deleted'=>0)));
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
	 * Add a new client in the system
	 * 
	 * @param integer void
	 * @return void
	 */

	function add($id = null) {
		// Breadcrumb
		$pageHeading = 'client';
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Clients', true)] = array('action' => 'index');
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add').' '.$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		$this->set('drop_downs', $this->getDropDown(array('client_types')));
		$this->set('states', $this->getStatesList());
		
		//Read values from database and edit  the record
		if (!empty($this->data)) {
			$this->{$this->modelClass}->set($this->data);			
			// check validations
			if($this->{$this->modelClass}->clientValidate()) {	
				//pr($this->data); die;
				// $passwd	=	$this->request->data[$this->modelClass]['password'];
				$this->request->data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.client');
				// $this->request->data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
				
				$data =  $this->data;
				$data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
				$data[$this->modelClass]['parent_id'] = $this->Auth->user('id');
				$data[$this->modelClass]['last_activity'] = time();
				
				// if (1) {
				if ($this->{$this->modelClass}->save($data, array('validate'=>false))) {
					$userId		=	$this->{$this->modelClass}->id;
					$this->{$this->modelClass}->UserDetail->saveclientProfile($userId,$this->request->data);
					//show message and redirect to listings
					
					 
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
							
						$reg_succ_id	=	Configure::read('global_ids.email_template.contact_added');
						
						$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

						$action 		= $email_template['EmailTemplate']['action'];
						
						$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
						
						$cons = explode(',',$action['EmailAction']['options']);
						$constants = array();
						foreach($cons as $key=>$val){
							$constants[] = '{'.$val.'}';
						}
						//FIRST_NAME,LAST_NAME,EMAIL,PHONE_NUMBER,WEBSITE_URL
						$first_name   	=   $this->request->data[$this->modelClass]['first_name'];
						
						$last_name   	=   $this->request->data[$this->modelClass]['last_name'];
						$email   		=   $this->request->data[$this->modelClass]['email'];
						$password   		=   $this->request->data[$this->modelClass]['password'];
						$telephone   		=   $this->request->data[$this->modelClass]['telephone'];
						
						$varify_link    =   '<a href="'.WEBSITE_URL.'">Click here</a>';
						$website_url    =   WEBSITE_URL;
						$rep_Array = array($first_name,$last_name,$email,$telephone, $password,$website_url); 
					
						$to 				= $this->request->data[$this->modelClass]['email'];
						$from_email 		= $settingsEmail['Setting']['value'];
						$from_name 			= $settingstitle['Setting']['value'];
						$from 				= $from_name . "<" . $from_email . ">";

						$replyTo 			= "";
						$subject 			= $email_template['EmailTemplate']['subject'];
						
						$message 			= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);
						
						// pr($message); die;
						$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
					
					
					$this->Session->setFlash(__('client record has been added.'), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
	/**
	 * Admin Edit Clients
	 *
	 * @param integer $id user id
	 * @return void
	 */
	function edit($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Clients', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user) && ($this->Auth->user('id') != $user[$this->modelClass]['parent_id'])) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Clients', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		
		$this->set('drop_downs', $this->getDropDown(array('client_types')));
		$this->set('states', $this->getStatesList());
		// Breadcrumb
			
			
		$AdminData = $user[$this->modelClass]['email'];
		$UserName  = $user[$this->modelClass]['first_name'];
		
		$this->set('AdminData',$AdminData);
		$this->set('UserName',$UserName);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pageHeading = 'Clients';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($user['Client']['first_name'], true));
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
			
			$this->loadModel('Contact');
			$contact_data = $this->Contact->findAllByClientId($data[$this->modelClass]['id']);
			$this->set('contact_data',$contact_data);
			// pr($contact_data); die;
			if(!empty($contact_data)){
				$data['Contacts'] = $contact_data;
			}
			// pr($data); die;
			$this->data			=	$data;
		}else{ // form is submited
			$old_data			= 	$this->{$this->modelClass}->read();
			$data				=	$this->data;
			
			$data[$this->modelClass]['last_activity'] = time();
			$this->data			=	$data;
			// pr($this->data);die;
			$client_data = array('Client'=>$this->data['Client']);
			$contact_data = $this->data['Contacts'];
			$this->{$this->modelClass}->set($client_data);
			// check validation	
			if($this->{$this->modelClass}->ClientEditValidate()) {
			//pr($this->data); die;
				
				//pr($this->data); die;
				if ($this->{$this->modelClass}->save($client_data,false)) {
					$this->{$this->modelClass}->UserDetail->saveclientProfile($id,$this->request->data);
					if(!empty($contact_data)){
						$this->loadModel('Contact');
						$remains_ids = array();
						// pr($contact_data); die;
						foreach($contact_data as $contact){
							if(isset($contact['Contact']['id'])){
								$check = $this->Contact->findById($contact['Contact']['id']);
							}else{
								$check = '';
							}
							$contact['Contact']['client_id'] = $id;
							if(!empty($check)){
								$this->Contact->id = $contact['Contact']['id'];
								$this->Contact->save($contact,false);
							}else{
								$this->Contact->create();
								$this->Contact->save($contact,false);
								
									
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
										
									$reg_succ_id	=	Configure::read('global_ids.email_template.contact_added');
									
									$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

									$action 		= $email_template['EmailTemplate']['action'];
									
									$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
									
									$cons = explode(',',$action['EmailAction']['options']);
									$constants = array();
									foreach($cons as $key=>$val){
										$constants[] = '{'.$val.'}';
									}
									//FIRST_NAME,LAST_NAME,EMAIL,PHONE_NUMBER,WEBSITE_URL
									$first_name   	=   $contact["Contact"]['first_name'];
									
									$last_name   	=   $contact["Contact"]['last_name'];
									$email   		=   $contact["Contact"]['email'];
									$telephone   		=   $contact["Contact"]['phone'];
									
									$varify_link    =   '<a href="'.WEBSITE_URL.'">Click here</a>';
									$website_url    =   WEBSITE_URL;
									$rep_Array = array($first_name,$last_name,$email,$telephone,$website_url); 
								
									$to 				= $email;
									$from_email 		= $settingsEmail['Setting']['value'];
									$from_name 			= $settingstitle['Setting']['value'];
									$from 				= $from_name . "<" . $from_email . ">";

									$replyTo 			= "";
									$subject 			= $email_template['EmailTemplate']['subject'];
									
									$message 			= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);
									
									// pr($message); die;
									$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
									
									
							}
							$remains_ids[] 	= $this->Contact->id;
						}
						
						if(count($remains_ids)==1){
							$this->Contact->deleteAll(array('client_id'=>$id,'id !='=>$remains_ids[0]));
						}elseif(count($remains_ids)>1){
							$this->Contact->deleteAll(array('client_id'=>$id,'id !='=>$remains_ids));
						}else{
							$this->Contact->deleteAll(array('client_id'=>$id));
						}
					}
					$this->Session->setFlash(__('client record has been updated.'), 'success');
					$this->redirect(array('action' => 'profile',$id));
				}
			}
		}
	}
	
	/**
	 * Admin view Clients profile
	 *
	 * @param integer $id user id
	 * @return void
	 */
	function profile($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Clients', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user) && ($this->Auth->user('id') != $user[$this->modelClass]['parent_id'])) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Clients', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		
		$this->set('drop_downs', $this->getDropDown(array('client_types')));
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
		$this->loadModel('Contact');
			$contact_data = $this->Contact->findAllByClientId($data[$this->modelClass]['id']);
			$this->set('contact_data',$contact_data);
			// pr($contact_data); die;
			if(!empty($contact_data)){
				$data['Contacts'] = $contact_data;
			}
			
		$this->data			=	$data;
	}
	
	function get_contacts($client_id=0,$format = 0){
		$this->layout	=	false;
		$this->autoRender	=	false;
		$this->loadModel('Contact');
		if($client_id){
		$client = $this->{$this->modelClass}->find('first',array('conditions'=>array('Client.id'=>$client_id)));
		// pr($client);
		$this->Contact->virtualFields  = array(
											'full_name' => 'CONCAT(Contact.first_name, " ", Contact.last_name)'
										);
		$contact_list	=	$this->Contact->find('list',array('conditions'=>array('client_id'=>$client_id),'fields'=>array('id','full_name')));
		// pr($contact_list);
		$contact_list[$client_id] = $client[$this->modelClass]['first_name']." ".$client[$this->modelClass]['last_name'];
		// $contact_list  = array_merge($contact_list,array($client_id,$client[$this->modelClass]['first_name']));
		if($format){
			return $contact_list;
		}else{
			return json_encode($contact_list);
		}
		
		}else{ return false; }
		exit;
	}
	
	
	public function addandget_client(){
		
		$this->layout = false;
		$this->autoRender = false;
		$response =	array('status'=>false,'message'=>'Failed! Please try again.','data'=>'');
		
		if (!empty($this->data)) {
				$data  =  $this->data;
				$data['user_role_id']  =  Configure::read("user_role_id.client");
				$data['Client'] = $data;
				$this->request->data = $data;
				$this->{$this->modelClass}->set($data);
				if($this->{$this->modelClass}->clientValidate()) {
					$data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
					$data[$this->modelClass]['parent_id'] = $this->Auth->user('id');
					$data[$this->modelClass]['active'] = 1;
					$data[$this->modelClass]['last_activity'] = time();
					// pr($data); die;
					if ($this->{$this->modelClass}->save($data["Client"], array('validate'=>false))) {
							$userId		=	$this->{$this->modelClass}->id;
							$this->{$this->modelClass}->UserDetail->saveclientProfile($userId,$this->request->data);
					
						
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
							
						$reg_succ_id	=	Configure::read('global_ids.email_template.contact_added');
						
						$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

						$action 		= $email_template['EmailTemplate']['action'];
						
						$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
						
						$cons = explode(',',$action['EmailAction']['options']);
						$constants = array();
						foreach($cons as $key=>$val){
							$constants[] = '{'.$val.'}';
						}
						//FIRST_NAME,LAST_NAME,EMAIL,PHONE_NUMBER,WEBSITE_URL
						$first_name   	=   $this->request->data[$this->modelClass]['first_name'];
						
						$last_name   	=   $this->request->data[$this->modelClass]['last_name'];
						$email   		=   $this->request->data[$this->modelClass]['email'];
						$password   		=   $this->request->data[$this->modelClass]['password'];
						$telephone   		=   $this->request->data[$this->modelClass]['telephone'];
						
						$varify_link    =   '<a href="'.WEBSITE_URL.'">Click here</a>';
						$website_url    =   WEBSITE_URL;
						$rep_Array = array($first_name,$last_name,$email,$telephone,$password,$website_url); 
					
						$to 				= $this->request->data[$this->modelClass]['email'];
						$from_email 		= $settingsEmail['Setting']['value'];
						$from_name 			= $settingstitle['Setting']['value'];
						$from 				= $from_name . "<" . $from_email . ">";

						$replyTo 			= "";
						$subject 			= $email_template['EmailTemplate']['subject'];
						
						$message 			= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);
						
						// pr($message); die;
						$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
						
					
					$this->Client->virtualFields  = array(
											'full_name' => 'CONCAT(Client.first_name, " ", Client.last_name)'
										);
										
						$response =	array('status'=>true,'message'=>'New Client was Successfully added','clients'=>$this->Client->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.client"),'parent_id'=>$this->Auth->user()),'fields'=>array('id','full_name'))));
					}
				}else{
					$errors = $this->{$this->modelClass}->validationErrors;
					$verrors = '';
					if(empty($errors)){
						foreach($errors as $errors){
							$verrors[] = implode(', ',$errors);
						}
					}else{
						$verrors = "Validation Error";
					}
					$response['message'] = $verrors;
				}
			}
		return json_encode($response);
	}
	
	public function addandget_contact(){
		
		$this->layout = false;
		$this->autoRender = false;
		$response =	array('status'=>false,'message'=>'Failed! Please try again.','data'=>'');
		// pr($this->data); die;
		if (!empty($this->data)) {
				$data  =  $this->data;
				$data['user_role_id']  =  Configure::read("user_role_id.contact");
				$data['Client'] = $data;
				$this->request->data = $data;
				$this->{$this->modelClass}->set($data);
				if($this->{$this->modelClass}->clientValidate()) {
					$data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
					// $data[$this->modelClass]['parent_id'] = $this->Auth->user('id');
					$data[$this->modelClass]['active'] = 1;
					$data[$this->modelClass]['last_activity'] = time();
					// pr($data); die;
					if ($this->{$this->modelClass}->save($data["Client"], array('validate'=>false))) {
							$this->loadModel("Contact");
							$contact = $this->data;
							$contact['client_id'] = $contact["parent_id"];
							$contact['phone'] = $contact["telephone"];
							
							$this->Contact->create();
								$this->Contact->save($contact,false);
								
							$userId		=	$this->{$this->modelClass}->id;
							$this->{$this->modelClass}->UserDetail->saveclientProfile($userId,$this->request->data);
					
						
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
							
						$reg_succ_id	=	Configure::read('global_ids.email_template.contact_added');
						
						$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

						$action 		= $email_template['EmailTemplate']['action'];
						
						$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
						
						$cons = explode(',',$action['EmailAction']['options']);
						$constants = array();
						foreach($cons as $key=>$val){
							$constants[] = '{'.$val.'}';
						}
						//FIRST_NAME,LAST_NAME,EMAIL,PHONE_NUMBER,WEBSITE_URL
						$first_name   	=   $this->request->data[$this->modelClass]['first_name'];
						
						$last_name   	=   $this->request->data[$this->modelClass]['last_name'];
						$email   		=   $this->request->data[$this->modelClass]['email'];
						$password   		=   $this->request->data[$this->modelClass]['password'];
						$telephone   		=   $this->request->data[$this->modelClass]['telephone'];
						
						$varify_link    =   '<a href="'.WEBSITE_URL.'">Click here</a>';
						$website_url    =   WEBSITE_URL;
						$rep_Array = array($first_name,$last_name,$email,$telephone,$password,$website_url); 
					
						$to 				= $this->request->data[$this->modelClass]['email'];
						$from_email 		= $settingsEmail['Setting']['value'];
						$from_name 			= $settingstitle['Setting']['value'];
						$from 				= $from_name . "<" . $from_email . ">";

						$replyTo 			= "";
						$subject 			= $email_template['EmailTemplate']['subject'];
						
						$message 			= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);
						
						// pr($message); die;
						$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
						
					
					$this->Client->virtualFields  = array(
											'full_name' => 'CONCAT(Client.first_name, " ", Client.last_name)'
										);
										
						// $response =	array('status'=>true,'message'=>'New Contact was Successfully added','clients'=>$this->Client->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.contact")),'fields'=>array('id','full_name'))));
						$response =	array('status'=>true,'message'=>'New Contact was Successfully added','clients'=>$this->get_contacts($this->data['parent_id'],1));
					}
				}else{
					$errors = $this->{$this->modelClass}->validationErrors;
					$verrors = '';
					if(empty($errors)){
						foreach($errors as $errors){
							$verrors[] = implode(', ',$errors);
						}
					}else{
						$verrors = "Validation Error";
					}
					$response['message'] = $verrors;
				}
			}
		return json_encode($response);
	}
	
	
	
	function change_password($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Clients', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Clients', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		// Breadcrumb
			
			
		$AdminData = $user[$this->modelClass]['email'];
		$UserName  = $user[$this->modelClass]['username'];
		$this->set('AdminData',$AdminData);
		$this->set('UserName',$UserName);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pageHeading = 'Clients';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($user['Client']['username'], true));
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
			if($this->{$this->modelClass}->clientPasswordValidate()) {
			//pr($this->data); die;
				
				$this->request->data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
				//pr($this->data); die;
				if ($this->{$this->modelClass}->save($this->data,false)) {
					$this->Session->setFlash(__('client Password has been updated.'), 'success');
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
				$this->Session->setFlash(__('Client record has been updated.'), 'success');
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