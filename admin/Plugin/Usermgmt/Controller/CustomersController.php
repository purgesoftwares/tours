<?php
class CustomersController extends UsermgmtAppController {


	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'Customers';
	
	/**
	 * Helpers
	 *
	 * @var array
	 */
	public $helpers = array('Html', 'Form', 'Session', 'Time','Text');

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
		$pageHeading = __('Customers');
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
		$parsedConditions['user_role_id'] = Configure::read('user_roles.customer');
		$parsedConditions['is_deleted'] = 0;
		$this->paginate = array(
			'conditions' => $parsedConditions,
			//'limit' => $limit,
			'limit' => -1,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$result= $this->paginate();
		//pr($result);
		$this->set('result', $result);	

			////////notification
		$this->loadModel('Notification');
		$notification = $this->Notification->find('first',array('conditions'=>array('user_id'=>1,'menu'=>'register customer')));
			//pr($notification); die;
			if($notification['Notification']['notifications']>0){
				$nots['notifications'] =  0;
				$this->Notification->id = $notification['Notification']['id'];
				$this->Notification->save($nots,false);
			}

		
	}	
		
	
	
	public function generatereport(){ 
			
			$this->layout	= false;
			$header = array(__("User Id"),__("First Name"), __("Last Name"), __("User Name"), __("Email"),__("Created"),__("Modified"));
			
			$rdata 	=	 $this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.customer'),'is_deleted'=>0)));
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
			
			$rdata 	=	 $this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.customer'),'is_deleted'=>0)));
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
	 * Add a new Partner in the system
	 * 
	 * @param integer void
	 * @return void
	 */
	function add($id = null) {
		// Breadcrumb
		$user_id	=	$this->Auth->user('id');
		$pageHeading = __('Customer');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Customers', true)] = array('action' => 'index');
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add').' '.$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		
			$this->loadModel('County');
			$this->loadModel('District');
			$counties = $this->County->find('list',array('order'=>'name asc'));
			$districts = $this->District->find('list',array('order'=>'name asc'));
			$this->set('counties',$counties);
			$this->set('districts',$districts);
		//Read values from database and edit  the record
		if (!empty($this->data)) {
			$this->{$this->modelClass}->set($this->data);			
			// check validations
			if($this->{$this->modelClass}->CustomerValidate()) {	
				//pr($this->data); die;
				$passwd	=	$this->request->data[$this->modelClass]['password'];
				$this->request->data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.customer');
				$this->request->data[$this->modelClass]['is_approved']	=	1;
				$this->request->data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
				$file		=	$this->data[$this->modelClass]['user_image']['name'];
				$filename	=	md5(time());
				$ext 		=	strtolower(substr($file,strrpos($file,".") + 1));
				$newImage	=	$filename.'.'.$ext ;
				$folder		=	$this->createFloder(USER_IMAGE_STORE_PATH);
				$directory	=	$folder['path'].DS.$newImage;
				// upload image
				move_uploaded_file($this->data[$this->modelClass]['user_image']['tmp_name'], $directory);
				$this->request->data[$this->modelClass]['user_image']		=	$newImage;	
				$this->request->data[$this->modelClass]['user_image_folder']=	$folder['folder'];
				$this->request->data[$this->modelClass]['promoter_id']=	$user_id;
				if(empty($this->request->data[$this->modelClass]['bond_limit']))				
				{
					$this->request->data[$this->modelClass]['bond_limit'] = Configure::read("Site.bond_limit");
				}
				// save user data
				//pr($this->data); die;
				if ($this->{$this->modelClass}->save($this->data, array('validate'=>false))) {
					$userId		=	$this->{$this->modelClass}->id;
					// save user details fields
					$this->{$this->modelClass}->UserDetail->saveCustomerProfile($userId,$this->request->data);
					
					if($this->request->data[$this->modelClass]['is_verified'] == 1) {
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
						$full_name   	=   $this->request->data[$this->modelClass]['first_name'].' '.$this->request->data[$this->modelClass]['last_name'];
						
						$userName   	=   $this->request->data[$this->modelClass]['username'];
						
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
						$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail',  array('message' => $message), "", 'html', $bcc = array());
					} else {
						$verify_validate_string	=	Security::hash($this->request->data[$this->modelClass]['email'].time(), 'sha1', true);
							
						$validate['validate_string']	= 	$verify_validate_string;
						$this->{$this->modelClass}->id	=	$userId;
						$this->{$this->modelClass}->save($validate);
					}
					
					
					//show message and redirect to listings
					$this->Session->setFlash(__('Customer record has been added.'), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
	/**
	 * Admin Edit Partners
	 *
	 * @param integer $id user id
	 * @return void
	 */
	function edit($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'customers', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		//pr($user);
		if(empty($user)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'customers', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		// Breadcrumb
			$this->loadModel('County');
			$this->loadModel('District');
			$counties = $this->County->find('list',array('order'=>'name asc'));
			$districts = $this->District->find('list',array('order'=>'name asc'));
			$this->set('counties',$counties);
			$this->set('districts',$districts);
		$AdminData = $user[$this->modelClass]['email'];
		$UserName   	=   $user[$this->modelClass]['username'];
		$last_file_name = isset($user[$this->modelClass]['user_image']) ? $user[$this->modelClass]['user_image'] : '';
		$this->set('last_file_name', $last_file_name);
		$this->set('AdminData',$AdminData);
		$this->set('UserName',$UserName);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pageHeading = 'Customers';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($UserName, true));
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
			//pr($this->data); die;
		}else{ // form is submited
		
		//pr($this->data); die;
			$old_data			= 	$this->{$this->modelClass}->read();
			$data				=	$this->data;
			$last_user_image	=	isset($old_data[$this->modelClass]['user_image']) ? $old_data[$this->modelClass]['user_image'] : '';
			if($data[$this->modelClass]['user_image']['name']==''){ // check if image is not uploaded
				unset($data[$this->modelClass]['user_image']);
			}
			$this->data			=	$data;
			//pr($this->data);die;
			$this->{$this->modelClass}->set($this->data);
			// check validation	
			if($this->{$this->modelClass}->CustomerValidate()) {
			//pr($this->data); die;
				if(isset($this->data[$this->modelClass]['user_image']) && $this->data[$this->modelClass]['user_image']['name']!=''){
					$file		=	$this->data[$this->modelClass]['user_image']['name'];
					$filename	=	md5(time());
					$ext 		=	strtolower(substr($file,strrpos($file,".") + 1));
					$newImage	=	$filename.'.'.$ext ;
					$folder		=	$this->createFloder(USER_IMAGE_STORE_PATH);
					$directory	=	$folder['path'].DS.$newImage;
					if(move_uploaded_file($this->data[$this->modelClass]['user_image']['tmp_name'], $directory)){
						@unlink(USER_IMAGE_STORE_PATH.$last_user_image);
						$this->request->data[$this->modelClass]['user_image'] = $newImage;
						$this->request->data[$this->modelClass]['user_image_folder']=	$folder['folder'];
					} else {
						$this->request->data[$this->modelClass]['user_image'] = $last_user_image;	 
					}
				} else {
					$this->request->data[$this->modelClass]['user_image'] 	= 	$last_user_image;
				}
				
				if(empty($this->request->data[$this->modelClass]['bond_limit']))				
				{
					$this->request->data[$this->modelClass]['bond_limit'] = Configure::read("Site.bond_limit");
				}
				
				if ($this->{$this->modelClass}->save($this->data,false)) {
					$this->{$this->modelClass}->UserDetail->saveCustomerProfile($id,$this->request->data);
					$this->Session->setFlash(__('Customer record has been updated.'), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
		
	function change_password($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'customers', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'customers', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		// Breadcrumb
			
			
		$AdminData = $user[$this->modelClass]['email'];
		$UserName  = $user[$this->modelClass]['username'];
		$last_file_name ='';
		if(isset($user[$this->modelClass]['user_image']))
		$last_file_name = $user[$this->modelClass]['user_image'];
		$this->set('last_file_name', $last_file_name);
		$this->set('AdminData',$AdminData);
		$this->set('UserName',$UserName);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pageHeading = 'Customers';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($user['Customer']['username'], true));
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
			if($this->{$this->modelClass}->promoterPasswordValidate()) {
			//pr($this->data); die;
				
				$this->request->data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
				//pr($this->data); die;
				if ($this->{$this->modelClass}->save($this->data,false)) {
					$this->Session->setFlash(__('Customer Password has been updated.'), 'success');
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
		}	
		exit;
  }	
	
}