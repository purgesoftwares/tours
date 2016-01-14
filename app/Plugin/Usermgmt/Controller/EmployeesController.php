<?php
class EmployeesController extends UsermgmtAppController {


	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'Employees';
	
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
		$pageHeading = __('Employees');
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
		$parsedConditions['user_role_id'] = Configure::read('user_roles.employee');
		
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
			
			$rdata 	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.employee'),'is_deleted'=>0)));
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
			
			$rdata 	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.employee'),'is_deleted'=>0)));
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
	
	
	function user_permissions($id=null)	{
	
		
		$pageHeading = __('Employees');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => 'pages', 'action' => 'dashboard');
		$pages[$pageHeading] = array('plugin'=>'usermgmt','controller' => 'employees', 'action' => 'index');
		$breadcrumb = array('pages' => $pages, 'active' => __('Edit Permissions', true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->loadModel("UserPrivilege");
		
		$this->set('pageHeading', $pageHeading);
		if(!empty($this->data)){
		//pr($this->data); die;
			if($this->data['User']['resion'] == 'privillages') {
				$data	=	array();
				//query fror delete
				$this->UserPrivilege->Query('DELETE FROM user_privileges  WHERE user_id=' . $this->data['User']['id'] . ' ');
				if(!empty($this->data['User']['UserPrivilege'])) {
					$data['UserPrivilege']['user_id']	=	$this->data['User']['id'];
					foreach($this->data['User']['UserPrivilege']['Menu'] as $menuids) {
						$can_view	=	0;
						$can_add	=	0;
						$can_edit	=	0;
						$can_delete	=	0;
						if(array_key_exists('can_view',$this->data['User']['UserPrivilege'])) {
							if(in_array($menuids, $this->data['User']['UserPrivilege']['can_view'])) {
								$can_view	=	1;
							}
						}
						if(array_key_exists('can_add',$this->data['User']['UserPrivilege'])) {
							if(in_array($menuids, $this->data['User']['UserPrivilege']['can_add'])) {
								$can_add	=	1;
							}
						}
						if(array_key_exists('can_edit',$this->data['User']['UserPrivilege'])) {
							if(in_array($menuids, $this->data['User']['UserPrivilege']['can_edit'])) {
								$can_edit	=	1;
							}
						}
						if(array_key_exists('can_delete', $this->data['User']['UserPrivilege'])) {
							if(in_array($menuids, $this->data['User']['UserPrivilege']['can_delete'])) {
								$can_delete	=	1;
							}
						}
						$data['UserPrivilege']['menuId']		=	$menuids;
						$data['UserPrivilege']['can_view']		=	$can_view;
						$data['UserPrivilege']['can_add']		=	$can_add;
						$data['UserPrivilege']['can_edit']		=	$can_edit;
						$data['UserPrivilege']['can_delete']	=	$can_delete;
						$this->UserPrivilege->create(); 
						$this->UserPrivilege->save($data);
					}
					$this->Session->setFlash(__('User privileges updated successfully.', true), 'success');
					//$this->redirect("/admin/usergroups");
					//exit;		
				}
			}
		}
		$MainMenus	=	$this->requestAction(array('plugin'=>'menus','controller' => 'menus', 'action' => 'all_menus',$id));
		$this->set('MainMenus', $MainMenus);
		$this->set('id',$id);
	}
	/**
	 * Add a new employee in the system
	 * 
	 * @param integer void
	 * @return void
	 */
	function add($id = null) {
		// Breadcrumb
		$pageHeading = 'employee';
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Employees', true)] = array('action' => 'index');
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add').' '.$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		
		
		//Read values from database and edit  the record
		if (!empty($this->data)) {
			$this->{$this->modelClass}->set($this->data);			
			// check validations
			if($this->{$this->modelClass}->employeeValidate()) {	
				//pr($this->data); die;
				$passwd	=	$this->request->data[$this->modelClass]['password'];
				$this->request->data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.employee');
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
				
				
				if ($this->{$this->modelClass}->save($this->data, array('validate'=>false))) {
					$userId		=	$this->{$this->modelClass}->id;
					$this->{$this->modelClass}->UserDetail->saveemployeeProfile($userId,$this->request->data);
					//show message and redirect to listings
					
					 /*if($this->request->data[$this->modelClass]['is_verified'] == 1) {
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
						$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
					} else {
						$verify_validate_string	=	Security::hash($this->request->data[$this->modelClass]['email'].time(), 'sha1', true);
							
						$validate['validate_string']	= 	$verify_validate_string;
						$this->{$this->modelClass}->id	=	$userId;
						$this->{$this->modelClass}->save($validate);
					} 
					*/
					$this->Session->setFlash(__('employee record has been added.'), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
	/**
	 * Admin Edit Employees
	 *
	 * @param integer $id user id
	 * @return void
	 */
	function edit($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Employees', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Employees', 'action' => 'index'));
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
		$pageHeading = 'Employees';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($user['Employee']['username'], true));
		/* code start for users messages */
			
		$this->{$this->modelClass}->id = $id; 
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);

		$this->set('id', $id);
		if(empty($this->data)){ // if form not submited
			
			$data = $this->{$this->modelClass}->read(); 
			unset($data[$this->modelClass]['password']); // unset password
			// pr($data); die;
			$this->data			=	$data;
		}else{ // form is submited
			$old_data			= 	$this->{$this->modelClass}->read();
			$data				=	$this->data;
			$last_user_image	=	$old_data[$this->modelClass]['user_image'];
			if($data[$this->modelClass]['user_image']['name']==''){ // check if image is not uploaded
				unset($data[$this->modelClass]['user_image']);
			}
			$this->data			=	$data;
			//pr($this->data);die;
			$this->{$this->modelClass}->set($this->data);
			// check validation	
			if($this->{$this->modelClass}->EmployeeEditValidate()) {
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
				
				//pr($this->data); die;
				if ($this->{$this->modelClass}->save($this->data,false)) {
					$this->{$this->modelClass}->UserDetail->saveemployeeProfile($id,$this->request->data);
					$this->Session->setFlash(__('employee record has been updated.'), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
	
	function change_password($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Employees', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'Employees', 'action' => 'index'));
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
		$pageHeading = 'Employees';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($user['Employee']['username'], true));
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
			if($this->{$this->modelClass}->employeePasswordValidate()) {
			//pr($this->data); die;
				
				$this->request->data[$this->modelClass]['password']		=	$this->Auth->password($this->request->data[$this->modelClass]['password']);
				//pr($this->data); die;
				if ($this->{$this->modelClass}->save($this->data,false)) {
					$this->Session->setFlash(__('employee Password has been updated.'), 'success');
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
				$this->Session->setFlash(__('Employee record has been updated.'), 'success');
		}	
		exit;
  }	
  
  
		
}