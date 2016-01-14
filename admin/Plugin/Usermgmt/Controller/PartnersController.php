<?php
App::import('Vendor', 'invoicexpress');
App::import('Vendor', 'Excel/excel_reader2'); //import statement
class PartnersController extends UsermgmtAppController {


	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'Partners';
	
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
		//array('field' => 'upgradationtype', 'type' => 'value'),
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
		$pageHeading = __('Partners');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
	
		$breadcrumb = array('pages' => $pages, 'active' =>$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		$this->loadModel('PartnerUpgradation');
		$this->loadModel('PartnerNormal');
		
		$PartnerNormal = $this->PartnerNormal->find('list',array('conditions'=>array('status'=>1),'fields'=>array('id','name')));
		$this->set('PartnerNormal',$PartnerNormal);
		
		$premium_account = $this->PartnerUpgradation->find('list',array('conditions'=>array('upgradation_type'=>1,'status'=>1),'fields'=>array('id','name')));
		$this->set('premium_account',$premium_account);
		
		$additional_resource  = $this->PartnerUpgradation->find('list',array('conditions'=>array('upgradation_type'=>2,'status'=>1),'fields'=>array('id','name')));
		$this->set('additional_resource',$additional_resource);
		
		$additional_news_item  = $this->PartnerUpgradation->find('list',array('conditions'=>array('upgradation_type'=>3,'status'=>1),'fields'=>array('id','name')));
		$this->set('additional_news_item',$additional_news_item);
		
		$upgradationtime = $this->PartnerUpgradation->find('list',array('fields'=>array('id','number')));
		$this->set('upgradationtime',$upgradationtime);
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
		$this->{$this->modelClass}->virtualFields  = array(
			'upgradationtype'=> "SELECT field_value FROM user_details WHERE user_id=Partner.id AND field_name = 'User.upgradationtype' LIMIT 1",
			'accountupgradeted'=> "SELECT field_value  FROM user_details WHERE user_id=Partner.id AND field_name = 'User.accountupgradeted'",
			'subscriptiontype'=> "SELECT field_value  FROM user_details WHERE user_id=Partner.id AND field_name = 'User.subscriptiontype'",
			'max_resource'=> "SELECT field_value  FROM user_details WHERE user_id=Partner.id AND field_name = 'User.max_resource'",
			'max_package'=> "SELECT field_value  FROM user_details WHERE user_id=Partner.id AND field_name = 'User.max_package'",
			'max_news'=> "SELECT field_value  FROM user_details WHERE user_id=Partner.id AND field_name = 'User.news'",
			'max_images'=> "SELECT field_value  FROM user_details WHERE user_id=Partner.id AND field_name = 'User.max_images'",
			'max_library_pdf'=> "SELECT field_value  FROM user_details WHERE user_id=Partner.id AND field_name = 'User.max_library_pdf'",
			'max_library_ppt'=> "SELECT field_value  FROM user_details WHERE user_id=Partner.id AND field_name = 'User.max_library_ppt'",
			'max_library_video'=> "SELECT field_value  FROM user_details WHERE user_id=Partner.id AND field_name = 'User.max_library_video'",
			); 
			$upgradationtype = null;
		if(isset($this->passedArgs['upgradationtypee'])){
			$upgradationtype = $this->passedArgs['upgradationtypee'];
			unset($this->passedArgs['upgradationtypee']);
		}
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['user_role_id'] = Configure::read('user_roles.partner');
		
		if(isset($upgradationtype) && $upgradationtype!=null){
			if($upgradationtype==1){
				//$parsedConditions['upgradationtype !='] = 0;
				$parsedConditions["upgradationtype !="] = "";
			}elseif($upgradationtype==0){
				$parsedConditions["upgradationtype"] = null;
			}
		}
		$parsedConditions['is_deleted']   = 0;
		$parsedConditions['is_potential'] = 0;
		// pr($parsedConditions); 	
		$this->paginate = array(
			'conditions' => $parsedConditions,
			// 'limit' => $limit,
			'limit' => -1,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$result= $this->paginate();
		// pr($result);
		$this->set('result', $result);

		////////notification
		$this->loadModel('Notification');
		$notification = $this->Notification->find('first',array('conditions'=>array('user_id'=>1,'menu'=>'register partner')));
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
			
			$rdata 	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.partner'),'is_deleted'=>0,'is_potential'=>0)));
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
			
			$rdata 	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.partner'),'is_deleted'=>0,'is_potential'=>0)));
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
	
	public function change_account_type(){
		$this->layout	=	false;
		
		if(!empty($this->data)){
			$this->loadModel('Usermgmt.UserDetail');
			if($this->data[$this->modelClass]['accounttype']==0){ // for normal account
				$this->loadModel('PartnerNormal');
				$save_data[$this->modelClass]['max_resource']		=	$this->data[$this->modelClass]['max_resource'];
				$save_data[$this->modelClass]['max_package']		=	$this->data[$this->modelClass]['max_package'];
				$save_data[$this->modelClass]['max_news']			=	$this->data[$this->modelClass]['max_news'];	
				$save_data[$this->modelClass]['max_images']			=	$this->data[$this->modelClass]['max_images'];	
				$save_data[$this->modelClass]['max_library_video']	=	$this->data[$this->modelClass]['max_library_video'];	
				$save_data[$this->modelClass]['max_library_ppt']	=	$this->data[$this->modelClass]['max_library_ppt'];	
				$save_data[$this->modelClass]['max_library_pdf']	=	$this->data[$this->modelClass]['max_library_pdf'];	
				$save_data[$this->modelClass]['accountupsubscribed']=	time();		
				$save_data[$this->modelClass]['subscriptiontype']=	$this->data[$this->modelClass]['PartnerNormal'];
				$this->UserDetail->subscribeaccount($this->data[$this->modelClass]['id'],$save_data);
			}else if($this->data[$this->modelClass]['accounttype']==1){ // for premium accoun upgradations
				$save_data['User']['accountupgradeted']		=	time();		
				$save_data['User']['upgradationtype']		=	$this->data[$this->modelClass]['premium_account'];
				$this->UserDetail->upgradeaccount($this->data[$this->modelClass]['id'],$save_data);
			}else if($this->data[$this->modelClass]['accounttype']==2){ // for additiona resources
				$this->loadModel('PartnerUpgradation');
				$additional_resource		=	$this->PartnerUpgradation->findById($this->data[$this->modelClass]['additional_resource']);
				$save_data['User']['accountaddresource']		=	time();		
				$save_data['User']['additionalresourceadded']	=	$additional_resource['PartnerUpgradation']['number'];
				$save_data['User']['resourceaddedtype']			=	$this->data[$this->modelClass]['additional_resource'];
				$this->UserDetail->resourceaddedupgrades($this->data[$this->modelClass]['id'],$save_data);
				
			}else if($this->data[$this->modelClass]['accounttype']==3){ // for additional news item
				$this->loadModel('PartnerUpgradation');
				$additional_news_item		=	$this->PartnerUpgradation->findById($this->data[$this->modelClass]['additional_news_item']);
				$save_data['User']['accountaddnewsitem']		=	time();		
				$save_data['User']['additionalnewsadded']		=	$additional_news_item['PartnerUpgradation']['number'];
				$save_data['User']['newsitemaddedtype']			=	$this->data[$this->modelClass]['additional_news_item'];
				$this->UserDetail->newsitemaddedupgrades($this->data[$this->modelClass]['id'],$save_data);
			}
			$this->Session->setFlash(__('Partner has been successfully Updated.'), 'success');
			$this->redirect($this->referer());
		  }
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
		$pageHeading = __('Partner');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Partners', true)] = array('action' => 'index');
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add').' '.$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		
			$this->loadModel('County');
			$this->loadModel('District');
			$counties = $this->County->find('list',array('order'=>'name asc'));
			$districts = $this->District->find('list',array('order'=>'name asc'));
			$this->set('counties',$counties);
			$this->set('districts',$districts);
			
		$this->loadModel('Localemodel');
		$locals	=	$this->Localemodel->find('list',array('fields'=>array('id','name'),'conditions'=>array()));	
		$this->set('locals',$locals);
		
		//Read values from database and edit  the record
		if (!empty($this->data)) {
			$this->{$this->modelClass}->set($this->data);			
			// check validations
			if($this->{$this->modelClass}->PartnerValidate()) {	
			
				$passwd	=	$this->request->data[$this->modelClass]['password'];
				$this->request->data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.partner');
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
				// save user data
				
				if ($this->{$this->modelClass}->save($this->data, array('validate'=>false))) {
				
					$userId		=	$this->{$this->modelClass}->id;
					// save user details fields
					$this->request->data[$this->modelClass]['promoter_id']=	$user_id;
					$this->request->data[$this->modelClass]['promoter_id']=	$user_id;
					
					$this->{$this->modelClass}->UserDetail->savePartnerProfile($userId,$this->request->data);
					//show message and redirect to listings
					
					$client_data['name']		=	$this->data[$this->modelClass]['first_name'];
					$client_data['code']		=	$userId;
					$client_data['email']		=	$this->data[$this->modelClass]['email'];
					$client_data['address']		=	'';
					
					$invoicexpress	=	new invoicexpress(Configure::read('Invoice.screen_name'),Configure::read('Invoice.api_key'));
					$data1			=	$invoicexpress->client_create($client_data,1);	
					$arrdata	=	$invoicexpress->convertxml_to_array($data1);	
					
					//pr($arrdata); die;
					
					$clientiddata['client_id']			=	$arrdata['id'];
					$this->{$this->modelClass}->id		=	$userId;
					$this->{$this->modelClass}->save($clientiddata,false); 
					
					
					
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
						
						$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail',  array('message' => $message), "", 'html', $bcc = array());
					} else {
						$verify_validate_string	=	Security::hash($this->request->data[$this->modelClass]['email'].time(), 'sha1', true);
							
						$validate['validate_string']	= 	$verify_validate_string;
						$this->{$this->modelClass}->id	=	$userId;
						$this->{$this->modelClass}->save($validate);
					}
					
					$this->Session->setFlash(__('Partner record has been added.'), 'success');
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
			$this->redirect(array('controller' => 'partners', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'partners', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		// Breadcrumb
			$this->loadModel('County');
			$this->loadModel('District');
			$counties = $this->County->find('list',array('order'=>'name asc'));
			$districts = $this->District->find('list',array('order'=>'name asc'));
			$this->set('counties',$counties);
			$this->set('districts',$districts);
		
		$this->loadModel('Localemodel');
		$locals	=	$this->Localemodel->find('list',array('fields'=>array('id','name'),'conditions'=>array()));	
		$this->set('locals',$locals);
		
		$AdminData = $user[$this->modelClass]['email'];
		$UserName  = $user[$this->modelClass]['username'];
		$last_file_name = isset($user[$this->modelClass]['user_image']) ? $user[$this->modelClass]['user_image'] : '';
		$this->set('last_file_name', $last_file_name);
		$this->set('AdminData',$AdminData);
		$this->set('UserName',$UserName);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pageHeading = __('Partners');
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($user['Partner']['username'], true));
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
			// pr($this->data); die;
		}else{ // form is submited
			$old_data			= 	$this->{$this->modelClass}->read();
			$data				=	$this->data;
			$last_user_image	=	isset($old_data[$this->modelClass]['user_image'])?$old_data[$this->modelClass]['user_image']:'';
			if($data[$this->modelClass]['user_image']['name']==''){ // check if image is not uploaded
				unset($data[$this->modelClass]['user_image']);
			}
			$this->data			=	$data;
			//pr($this->data);die;
			$this->{$this->modelClass}->set($this->data);
			// check validation	
			if($this->{$this->modelClass}->PartnerEditValidate()) {
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
					$this->{$this->modelClass}->UserDetail->savePartnerProfile($id,$this->request->data);
					
					if(!empty($old_data[$this->modelClass]['client_id'])){
						$client_data['name']		=	$this->data[$this->modelClass]['first_name'];
						$client_data['code']		=	$id;
						$client_data['email']		=	$this->data[$this->modelClass]['email'];
						$client_data['address']		=	'';
						
						
						$invoicexpress	=	new invoicexpress(Configure::read('Invoice.screen_name'),Configure::read('Invoice.api_key'));
						$data1			=	$invoicexpress->client_update($client_data,1,$old_data[$this->modelClass]['client_id']);	
					}
					
					$this->Session->setFlash(__('Partner record has been updated.'), 'success');
					$this->redirect(array('action' => 'index'));
					// $this->redirect(array('action' => 'edit',$id));
				}
			}
		}
	}
	function change_password($id = null) {
			   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'partners', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);

		if(empty($user)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'partners', 'action' => 'index'));
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
		$pageHeading = 'Partners';
		$pages[__($pageHeading, true)] = array('action' => 'index');
			
		$breadcrumb = array('pages' => $pages, 'active' => __($user['Partner']['username'], true));
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
					$this->Session->setFlash(__('Partner Password has been updated.'), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
		
		
	public function delete(){
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null){
				$userId				=	$this->data['id'];
				$data['is_deleted']	=	1;	
				/** PRODUCTS **/
				/* $this->loadModel('Product');
				$this->loadModel('ProductDetail');
				$this->loadModel('ProductRating');
				$this->loadModel('ProductSchedule');
				$userProducts = $this->Product->find('all',array('fields'=>array('id'),'conditions'=>array('user_id'=> $userId)));
				if(!empty($userProducts)){
					foreach($userProducts as $uproducts){
						$productDetailDeleted = $this->ProductDetail->deleteAll(array(
							  'ProductDetail.product_id' => $uproducts['Product']['id']
						), false);
						$productRatingDeleted = $this->ProductRating->deleteAll(array(
							  'ProductRating.product_id' => $uproducts['Product']['id']
						), false);
						$productScheduleDeleted = $this->ProductSchedule->deleteAll(array(
							  'ProductSchedule.product_id' => $uproducts['Product']['id']
						), false);
					}
					$productDeleted = $this->Product->deleteAll(array(
						'Product.user_id' => $userId
					), false);
				} */
				/** PRODUCTS **/
				
				/** VOUCHERS **/
					$this->loadModel('Voucher');
					$voucherDeleted = $this->Voucher->deleteAll(array(
						'Voucher.user_id' => $userId
					), false);
				/** VOUCHERS **/
				
				/** PACKAGES **/
					/* $this->loadModel('Package');
					$this->loadModel('PackageDetail');
					$userPackages = $this->Package->find('all',array('fields'=>array('id'),'conditions'=>array('user_id'=> $userId)));
					if(!empty($userPackages)){
						foreach($userPackages as $upackages){
							$userPackageDetailDeleted = $this->PackageDetail->deleteAll(array(
								'PackageDetail.package_id' => $upackages['Package']['id']
							), false);
						}
					}
					$userPackageDeleted = $this->Package->deleteAll(array(
						'Package.user_id' => $userId
					), false); */
				/** PACKAGES **/
				
				/** NEWS **/
					$this->loadModel('News');
					$userNewsDeleted = $this->News->deleteAll(array(
						'News.user_id' => $userId
					), false);
				/** NEWS **/

				/** MEDIA **/
					/* $this->loadModel('Media');
					$userMediaDeleted = $this->Media->deleteAll(array(
						'Media.user_id' => $userId
					), false); */
				/** MEDIA **/
				
				/** TEMPLATES **/
					$this->loadModel('RequestTemplate');
					$userTemplateDeleted = $this->RequestTemplate->deleteAll(array(
						'RequestTemplate.user_id' => $userId
					), false);
				/** TEMPLATES **/
				
				//$this->{$this->modelClass}->id	=	$this->data['id'];
				$this->loadModel('UserDetail');
				$userDetailDeleted = $this->UserDetail->deleteAll(array(
						'user_id' => $this->data['id']
					), false);
				if($this->{$this->modelClass}->delete($this->data['id'], false)){
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
				$this->Session->setFlash(__('Partner record has been updated.'), 'success');
		}	
		exit;
  }	
  
	/*
	function to list type of upgradations
	*/
	function type_of_upgradation(){
		$this->loadModel('PartnerUpgradation');
		
		$result	=	$this->PartnerUpgradation->find('all');
		$this->set('result',$result);
	}
	
	/*
	function to list type of normal account
	*/
	function type_of_normal(){
		$this->loadModel('PartnerNormal');
		
		$result	=	$this->PartnerNormal->find('all');
		$this->set('result',$result);
	}	
	
	/*
	function to edit upgrade types for all partner
	*/
	
	public function edit_upgradation_type($id=null) {
		
		$pages[__('Dashboard', true)]			=	array('plugin' => '', 'controller' => '/');
		$pages[__('Partner Upgradations', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'partners', 'action' => 'type_of_upgradation');
		$breadcrumb 							=	 array('pages' => $pages, 'active' => __('Edit Upgradation', true));
		$this->set('breadcrumb', $breadcrumb);

		$this->set('id', $id);	   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('plugin'=>'usermgmt','controller' => 'partners', 'action' => 'index'));
		}
		$this->loadModel('PartnerUpgradation');
		$upgradation_types = $this->PartnerUpgradation->findById($id);
		if(empty($upgradation_types)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
		$this->PartnerUpgradation->set($upgradation_types);
		// Breadcrumb
		if(empty($this->data)){ // if form not submited
			$this->data = $this->PartnerUpgradation->read(); 
			
		}else{ // form is submited
			$old_data			= 	$this->PartnerUpgradation->read();
			
			$this->PartnerUpgradation->set($this->data);
			$this->PartnerUpgradation->id=$id;
			$newImage = '';
			if($this->PartnerUpgradation->validates()) {
				$this->PartnerUpgradation->save($this->data,false);
				$this->Session->setFlash(__('Upgradation has been updated.'), 'success');
				$this->redirect(array('action' => 'type_of_upgradation'));
			}
		}
	}
	
	/*
	function to edit norma account types for all partner
	*/
	
	public function edit_normal_type($id=null) {
		
		$pages[__('Dashboard', true)]			=	array('plugin' => '', 'controller' => '/');
		$pages[__('Partner Upgradations', true)]		=	array('plugin' => 'usermgmt', 'controller' => 'partners', 'action' => 'type_of_normal');
		$breadcrumb 							=	 array('pages' => $pages, 'active' => __('Edit normal account type', true));
		$this->set('breadcrumb', $breadcrumb);

		$this->set('id', $id);	   
		if(!isset($id) || $id == '' ){
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('plugin'=>'usermgmt','controller' => 'partners', 'action' => 'index'));
		}
		$this->loadModel('PartnerNormal');
		$upgradation_types = $this->PartnerNormal->findById($id);
		if(empty($upgradation_types)) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'products', 'action' => 'index'));
		}
		$this->PartnerNormal->set($upgradation_types);
		// Breadcrumb
		if(empty($this->data)){ // if form not submited
			$this->data = $this->PartnerNormal->read(); 
			
		}else{ // form is submited
			$old_data			= 	$this->PartnerNormal->read();
			
			$this->PartnerNormal->set($this->data);
			$this->PartnerNormal->id=$id;
			$newImage = '';
			if($this->PartnerNormal->validates()) {
				$this->PartnerNormal->save($this->data,false);
				$this->Session->setFlash(__('Normal has been updated.'), 'success');
				$this->redirect(array('action' => 'type_of_normal'));
			}
		}
	}
	
	/**
   * Display the content of example.xls
   */
	function import_partners_from_excel() {
	
		if(!empty($this->data)){
			//pr($this->data);die;	
			$user_id			=	$this->Auth->user('id');
			$excel_data		 	= 	new Spreadsheet_Excel_Reader(WEBSITE_APP_WEBROOT_ROOT_PATH.'example.xls', true);
			$partners 			= 	$excel_data->dumptoarray();
			$partner_data_array	=	array(
										'name',
										'email',
										'password',
										'country',
										'zipcode',
										'county',
										'district',
										'telephone',
										'mobile',
										'address',
										'observations',
										'site_url',
										'nif_nipc',
										'facebook_link',
										'google_link',
										'twitter',
										'linkedIn',
										'legal_form',
										'social_capital',
										'activities_description',
										'creation_date'
									);
			
			array_shift($partners);	
			$result							=	array();
			//pr($partners); die;
			foreach($partners as $user_detials){
				$partner_details['Partner']	=	array_combine($partner_data_array,$user_detials);
				$this->data					=	$partner_details;
				$this->{$this->modelClass}->set($this->data);			
				$userName					= $this->data[$this->modelClass]['name'];
				if($this->{$this->modelClass}->PotentialValidate()) {
					
					$finddata	=	$this->{$this->modelClass}->find('first',array('conditions'=>array('email'=>$partner_details['Partner']['email'])));
					//pr($finddata); die;
					if(empty($finddata)){
						$data										=	$partner_details;
						$data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.partner');
						$data[$this->modelClass]['is_approved']		=	1;
						$data[$this->modelClass]['is_potential']	=	1;
						$data[$this->modelClass]['verified_potential']	=	1;
						//$this->request->data[$this->modelClass]['parent_id'] =	$this->data[$this->modelClass]['parent_id'];
						$data[$this->modelClass]['promoter_id']		=	$user_id;
						$data[$this->modelClass]['username']		=	$partner_details[$this->modelClass]['name'];
						$data[$this->modelClass]['password']		=	$this->Auth->password($partner_details[$this->modelClass]['password']);
						$partner_details							=	$data;
					}
					$this->{$this->modelClass}->create();
			if ($this->{$this->modelClass}->save($partner_details, array('validate'=>false))) {
				//pr($this->data); 
					//pr($partner_details); die;
					$userId		=	$this->{$this->modelClass}->id;
					$partnerdata['Comercial']	=	$partner_details['Partner'];
					//pr($partnerdata); die;
					$this->{$this->modelClass}->UserDetail->savePotentialPartnerAdmin($userId,$partnerdata);
					$this->Session->setFlash(__('Potential Partner record has been added.'), 'success');
					$this->render('import_partners_from_excel');
				}
			}else{
				$validationserrors					=	array_values($this->{$this->modelClass}->validationErrors);
					if($userName != '')
					$result['notadded'][$userName]		=	$validationserrors[0];
				}
			}	
			$this->set('result',$result);
		}else{
			$this->Session->setFlash(__('Please upload a excel file.'), 'error');
			$this->redirect(array('action' => 'import_partner'));
		}
	}
	
	
	
	/* function import_partner() {
	
		if(!empty($this->data)){
			//pr($this->data);die;	
			$user_id			=	$this->Auth->user('id');
			$excel_data		 	= 	new Spreadsheet_Excel_Reader(WEBSITE_APP_WEBROOT_ROOT_PATH.'example.xls', true);
			$partners 			= 	$excel_data->dumptoarray();
			$partner_data_array	=	array(
										'name',
										'email',
										'country',
										'zipcode',
										'county',
										'district',
										'telephone',
										'mobile',
										'address',
										'observations',
										'site_url',
										'nif_nipc',
										'facebook_link',
										'google_link',
										'twitter',
										'linkedIn',
										'legal_form',
										'social_capital',
										'activities_description',
										'creation_date'
									);
			
			array_shift($partners);	
			$result							=	array();
			foreach($partners as $user_detials){
				$partner_details['Partner']	=	array_combine($partner_data_array,$user_detials);
				$this->data					=	$partner_details;
				$this->{$this->modelClass}->set($this->data);			
				$userName					=	$this->data[$this->modelClass]['first_name']." ".$this->data[$this->modelClass]['last_name'];
				if($this->{$this->modelClass}->PotentialValidate()) {	
				
				$this->request->data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.partner');
				$this->request->data[$this->modelClass]['is_approved']	=	1;
				$this->request->data[$this->modelClass]['is_potential']	=	1;
				$this->request->data[$this->modelClass]['verified_potential']	=	1;
				//$this->request->data[$this->modelClass]['parent_id'] =	$this->data[$this->modelClass]['parent_id'];
				$this->request->data[$this->modelClass]['promoter_id']=	$user_id;
				
				// save user data
				//$this->{$this->modelClass}->save($this->data, array('validate'=>false))
				if ($this->{$this->modelClass}->save($this->data, array('validate'=>false))) {
				//pr($this->data); 
					$userId		=	$this->{$this->modelClass}->id;
					
					$this->{$this->modelClass}->UserDetail->savePotentialPartnerAdmin($userId,$this->request->data);
					$this->Session->setFlash(__('Potential Partner record has been added.'), 'success');
					$this->redirect(array('action' => 'potential_partner'));
				}
			}else{
					$validationserrors					=	array_values($this->{$this->modelClass}->validationErrors);
					$result['notadded'][$userName]		=	$validationserrors[0];
				}
			}	
			$this->set('result',$result);
		}else{
			$this->Session->setFlash(__('Please upload a excel file.'), 'error');
			$this->redirect(array('action' => 'import_partner'));
		}
	} */
	
	
	function import_partner(){
		if(!empty($this->data)){
			
			if($this->{$this->modelClass}->ExcelValidate()){
				$data				=	$this->data;
				$user_id			=	$this->Auth->user('id');
				$excel_data		 	= 	new Spreadsheet_Excel_Reader($data[$this->modelClass]['user_image']['tmp_name'], true);
				
				$this->data			=	array();
				$result		=	array();
				
				$partners 			= 	$excel_data->dumptoarray();
				$partner_data_array	=	array(
										'name',
										'email',
										'password',
										'country',
										'zipcode',
										'county',
										'district',
										'city',
										'telephone',
										'mobile',
										'address',
										'observations',
										'site_url',
										'nif_nipc',
										'facebook_link',
										'google_link',
										'twitter',
										'linkedIn',
										'legal_form',
										'social_capital',
										'activities_description',
										'social_designation',
										'creation_date'
									);
				
				array_shift($partners);	
				$this->Partner->data[$this->modelClass]=array();

				
				foreach($partners as $user_detials){
					$check_data							=		array_filter($user_detials);
				
					if(!empty($check_data)){
						$this->loadModel('County');
						$this->loadModel('District');
							
						$partner_details[$this->modelClass]	=	array_combine($partner_data_array,$user_detials);
						$this->{$this->modelClass}->set($partner_details);	
						$userName					=		$partner_details['Partner']['name'];
						$this->{$this->modelClass}->set($partner_details);
						if($this->{$this->modelClass}->PotentialValidate()) {
							// pr($partner_details);
							$partner_details['Partner']['address']	=	html_entity_decode(utf8_decode($partner_details['Partner']['address']));
							// pr($partner_details);die;
							$finddata	=	$this->{$this->modelClass}->find('first',array('conditions'=>array('email'=>$partner_details['Partner']['email'])));
							
							$county_id = $this->County->find('first',array('conditions'=>array('name'=>trim($partner_details['Partner']['county']))));
							$district_id = $this->District->find('first',array('conditions'=>array('name'=>trim($partner_details['Partner']['district']))));
							if(!empty($county_id)){
								$partner_details['Partner']['county'] = $county_id['County']['id'];
							}else{
								$partner_details['Partner']['county'] = 1;
							}
							if(!empty($district_id)){
								$partner_details['Partner']['district'] = $district_id['District']['id'];
							}else{
								$partner_details['Partner']['district'] = 1;
							}
							// pr($partner_details); die;
							
							if(empty($finddata)){
								$data										=	$partner_details;
								$data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.partner');
								$data[$this->modelClass]['is_approved']		=	1;
								$data[$this->modelClass]['is_potential']	=	1;
								$data[$this->modelClass]['verified_potential']	=	1;
								$data[$this->modelClass]['promoter_id']		=	$user_id;
								$data[$this->modelClass]['username']		=	$partner_details[$this->modelClass]['name'];
								$data[$this->modelClass]['password']		=	$this->Auth->password($partner_details[$this->modelClass]['password']);
								$partner_details							=	$data;
								$this->{$this->modelClass}->create();
								if ($this->{$this->modelClass}->save($partner_details, array('validate'=>false))) {
									//pr($this->data); 
										//pr($partner_details); die;
										$userId		=	$this->{$this->modelClass}->id;
										$partnerdata['Comercial']	=	$partner_details['Partner'];
										//pr($partnerdata); die;
										$this->{$this->modelClass}->UserDetail->savePotentialPartnerAdmin($userId,$partnerdata);
										$this->Session->setFlash(__('Potential Partner record has been added.'), 'success');
										$this->render('import_partners_from_excel');
									}
							}else {
								$validationserrors					=	array('0'=>'This Email already exist');
								if($userName != '')
								$result['notadded'][$userName]		=	$validationserrors;
							
							}
						}else{
							$validationserrors						= 	array_values($this->{$this->modelClass}->validationErrors);
							$validationserrora						=	($validationserrors);
							$result['notadded'][$userName]			=	$validationserrora;
						
						}
					}
				}
				
			// pr($result);	 die;
				$this->set('result',$result);	
				$this->set('pageHeading',"Partner Import Messages");	
				$this->render('import_partners_from_excel');
			}
		}
	} 
	
	
	/* function import_partner(){
		if(!empty($this->data)){
			$this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->ExcelValidate()){
				$data				=	$this->data;
				$user_id			=	$this->Auth->user('id');
				$excel_data		 	= 	new Spreadsheet_Excel_Reader($data[$this->modelClass]['user_image']['tmp_name'], true);
				
				$this->data			=	array();
				
				$partners 			= 	$excel_data->dumptoarray();
				$partner_data_array	=	array(
											'user_type',
											'partner_type',
											'first_name',
											'last_name',
											'email',
											'commercial_code',
											'password',
											'nif',
											'nib',
											'country',
											'county',
											'district',
											'city',
											'address',
											'zipcode',
											'lat_long',
											'mobile'
										);
				
				array_shift($partners);	
				$this->Partner->data[$this->modelClass]=array();
				
				$result							=	array();
				foreach($partners as $user_detials){
					$partner_details['Partner']	=	array_combine($partner_data_array,$user_detials);
					$this->{$this->modelClass}->set($partner_details);			
					$userName					=	$partner_details[$this->modelClass]['first_name']." ".$partner_details[$this->modelClass]['last_name'];
					if($this->{$this->modelClass}->PartnerValidate()) {	
						$data										=	$partner_details;
						$passwd										=	$partner_details[$this->modelClass]['password'];
						$data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.partner');
						$data[$this->modelClass]['is_verified']	=	1;
						$data[$this->modelClass]['active']	=	1;
						$data[$this->modelClass]['username']		=	$userName;
						$data[$this->modelClass]['password']		=	$this->Auth->password($partner_details[$this->modelClass]['password']);
						$data[$this->modelClass]['promoter_id']		=	$user_id;
						$partner_details									=	$data;	
						$this->{$this->modelClass}->create();
						if ($this->{$this->modelClass}->save($partner_details, array('validate'=>false))) {
							$userId		=	$this->{$this->modelClass}->id;
							// save user details fields
							$this->{$this->modelClass}->UserDetail->savePartnerProfile($userId,$partner_details);
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
								
							$reg_succ_id	=	Configure::read('global_ids.email_template.verification_email');
							
							$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

							$action 		= $email_template['EmailTemplate']['action'];
							
							$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
							
							$cons = explode(',',$action['EmailAction']['options']);
							$constants = array();
							foreach($cons as $key=>$val){
								$constants[] = '{'.$val.'}';
							}
							$full_name   	=   $partner_details[$this->modelClass]['first_name'].' '.$partner_details[$this->modelClass]['last_name'];
							
							$userName   	=   $partner_details[$this->modelClass]['username'];
							
							$varify_link    =   '<a href="'.WEBSITE_URL.'">Click here</a>';
							$website_url    =   WEBSITE_URL;
							$rep_Array = array($userName,$partner_details[$this->modelClass]['email'],$varify_link,$full_name,$passwd,$website_url); 
						
							$to 				= $partner_details[$this->modelClass]['email'];
							$from_email 		= $settingsEmail['Setting']['value'];
							$from_name 			= $settingstitle['Setting']['value'];
							$from 				= $from_name . "<" . $from_email . ">";
							$replyTo 			= "";
							$subject 			= $email_template['EmailTemplate']['subject'];
							$message 			= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);
							// $this->_sendMail($to, $from, $replyTo, $subject, 'sendmail',  array('message' => $message), "", 'html', $bcc = array());
							$result['added'][$userName][]		=	"Partner successfully inserted";
						}else{
							$result['notadded'][$userName][]	=	"Some error occured while inserting";
						}
					}else{
						$validationserrors					=	array_values($this->{$this->modelClass}->validationErrors);
						$result['notadded'][$userName]		=	$validationserrors[0];
					}
				}	
				$this->set('result',$result);	
				$this->set('pageHeading',"Partner Import Messages");	
				$this->render('import_partners_from_excel');
			}
		}
	}  */

	public function potential_partner() {
		// Breadcrumb
		$pageHeading = __('Potential Partners');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
	
		$breadcrumb = array('pages' => $pages, 'active' =>$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->virtualFields  = array(
			'commercial_agent'=> "SELECT username  FROM users WHERE id=".$this->modelClass.".parent_id",
			'comercial_code'=> "SELECT code  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id",
			'name'=> "SELECT field_value  FROM user_details WHERE user_id=".$this->modelClass.".id AND field_name='User.name'",
			'discount'=> "SELECT discount  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id",
			'end_date'=> "SELECT end_date  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id"
			
			); 
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		
		if(isset($this->passedArgs['name']) && !empty($this->passedArgs['name'])){
			$parsedConditions['name']	=		$this->passedArgs['name']; 
		} 
		$parsedConditions['user_role_id'] = Configure::read('user_roles.partner');
		$parsedConditions['is_deleted']   				= 0;
		$parsedConditions['is_potential']   			= 1;
		$parsedConditions['m_success_create_partner'] 	= 0;
		$this->paginate = array(
			'conditions' => $parsedConditions,
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$result= $this->paginate();
		//pr($result);
		$this->set('result', $result);		
	}
	
	
	public function generatereport_potential(){ 
			
			
			ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large

			//create a file
			$filename = "export_".date("Y.m.d").".csv";
			$csv_file = fopen('php://output', 'w');

			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			
			$this->{$this->modelClass}->virtualFields  = array(
			'commercial_agent'=> "SELECT username  FROM users WHERE id=".$this->modelClass.".parent_id",
			'comercial_code'=> "SELECT code  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id",
			'name'=> "SELECT field_value  FROM user_details WHERE user_id=".$this->modelClass.".id AND field_name='User.name'",
			'discount'=> "SELECT discount  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id",
			'end_date'=> "SELECT end_date  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id"
			
			); 
			$results	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.partner'),'is_deleted'=>0,'is_potential'=>1,'m_success_create_partner'=>0)));
			//$results = $this->Resource->query($sql);	// This is your sql query to pull that data you need exported
			//or
				//$results = $this->ModelName->find('all', array());
			
			// The column headings of your .csv file
			$header_row = array(__("User Id"),__("Name"), __("Commercial Agent"),__("Commercial code"), __("Discount"), __("End Date"),__("Email"),__("Created"));
			fputcsv($csv_file,$header_row,',','"');

			// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
			foreach($results as $result)
			{
				// Array indexes correspond to the field names in your db table(s)
				$row = array(
					$result[$this->modelClass]['id'],
					$result[$this->modelClass]['name'],
					$result[$this->modelClass]['commercial_agent'],
					$result[$this->modelClass]['comercial_code'],
					$result[$this->modelClass]['discount'],
					
					$result[$this->modelClass]['end_date'],
					$result[$this->modelClass]['email'],
					$result[$this->modelClass]['created']
				);

				fputcsv($csv_file,$row,',','"');
			}

			fclose($csv_file);
			die;
	}
	
	public function generate_pdf_potential(){
			$this->{$this->modelClass}->virtualFields  = array(
			'commercial_agent'=> "SELECT username  FROM users WHERE id=".$this->modelClass.".parent_id",
			'comercial_code'=> "SELECT code  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id",
			'name'=> "SELECT field_value  FROM user_details WHERE user_id=".$this->modelClass.".id AND field_name='User.name'",
			'discount'=> "SELECT discount  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id",
			'end_date'=> "SELECT end_date  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id"
			
			); 
			$results	=	$this->{$this->modelClass}->find('all',array('conditions'=>array('user_role_id'=>Configure::read('user_roles.partner'),'is_deleted'=>0,'is_potential'=>1,'m_success_create_partner'=>0)));
			
			///set header of pdf
			$header_row = array(__("User Id"),__("Name"), __("Commercial Agent"),__("Commercial code"), __("Discount"), __("End Date"),__("Email"),__("Created"));
				$detail = PDF_HEADER_HTML;
				foreach($header_row as $header_item){
					$detail .= '<th style="border:1px solid #000;">'.$header_item.'</th>';
				}
				$detail .= '</tr>';
			
				foreach($results as $key=>$result){
					$detail .= '<tr >';
					
					$detail .= '<td style="border:1px solid #000;">'.$result[$this->modelClass]['id'].'</td>';
					$detail .= '<td style="border:1px solid #000;">'.$result[$this->modelClass]['name'].'</td>';
					$detail .= '<td style="border:1px solid #000;">'.$result[$this->modelClass]['commercial_agent'].'</td>';
					$detail .= '<td style="border:1px solid #000;">'.$result[$this->modelClass]['comercial_code'].'</td>';
					$detail .= '<td style="border:1px solid #000;">'.$result[$this->modelClass]['discount'].'</td>';
					$detail .= '<td style="border:1px solid #000;">'.$result[$this->modelClass]['end_date'].'</td>';
					$detail .= '<td style="border:1px solid #000;">'.$result[$this->modelClass]['email'].'</td>';
					$detail .= '<td style="border:1px solid #000;">'.$result[$this->modelClass]['created'].'</td>';
					
					$detail .= '</tr>';
				}
			$detail .= '</table>'.PDF_FOOTER_HTML;
			
		require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
				$this->dompdf = new DOMPDF();
				$papersize = "legal";
				$orientation = "landscape";
				$this->dompdf->load_html($detail);
				
				//$this->dompdf->load_html($html);
				$this->dompdf->render();
				$filename = "pdf_".date("Y.m.d").".pdf";
				$this->dompdf->stream($filename);
				//$this->dompdf->set_paper($papersize, $orientation);
				//$this->dompdf->render();
				//$output = $this->dompdf->output();
				//file_put_contents('userorder/'.$name.'.pdf', $output);
			die;
	}
	
	
	
	public function assign_comercial_agent($potential_partner_id = null){
	
		$pageHeading = __('Assign Comercial agent');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
	
		$breadcrumb = array('pages' => $pages, 'active' =>$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
	
		$comercial_agent	=	$this->{$this->modelClass}->find('list',array('fields'=>array('id','username'),'conditions'=>array('user_role_id'=>Configure::read('user_roles.comercial_agent'),'is_deleted'=>0)));	
		$this->set('comercial_agent',$comercial_agent);
		//pr($comercial_agent); die;
		
		if(!empty($this->data)){
			
			$this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->AComercialValidate()){
				
				$data['parent_id']	=	$this->data['Partner']['comercial_agent'];
				
				$this->{$this->modelClass}->id	=	$potential_partner_id;
				$this->{$this->modelClass}->save($data,false);
				
				$this->Session->setFlash(__('Comercial Agent successfully assigned'), 'success');
				$this->redirect(array('action' => 'potential_partner'));
			}
		
		}
	
	}
	
	public function add_potential_partner(){
	
		$user_id	=	$this->Auth->user('id');
		$pageHeading = __('Potential Partner');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Potential Partner', true)] = array('action' => 'potential_partner');
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add').' '.$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		
			$this->loadModel('County');
			$this->loadModel('District');
			$counties = $this->County->find('list',array('order'=>'name asc'));
			$districts = $this->District->find('list',array('order'=>'name asc'));
			$this->set('counties',$counties);
			$this->set('districts',$districts);
		$comercial_agent	=	$this->{$this->modelClass}->find('list',array('fields'=>array('id','username'),'conditions'=>array('user_role_id'=>Configure::read('user_roles.comercial_agent'),'is_deleted'=>0)));	
		$this->set('comercial_agent',$comercial_agent);
		$this->set('mode', $this->Auth->user('user_role_id'));
		//Read values from database and edit  the record
		if (!empty($this->data)) {
			$this->{$this->modelClass}->set($this->data);			
			// check validations
			//pr($this->data); die;
			if($this->{$this->modelClass}->PotentialValidate()) {	
				
				$this->request->data[$this->modelClass]['user_role_id']	=	Configure::read('user_roles.partner');
				$this->request->data[$this->modelClass]['is_approved']	=	1;
				$this->request->data[$this->modelClass]['is_potential']	=	1;
				$this->request->data[$this->modelClass]['verified_potential']	=	1;
				$this->request->data[$this->modelClass]['parent_id'] =	$this->data[$this->modelClass]['parent_id'];
				$this->request->data[$this->modelClass]['promoter_id']=	$user_id;
				
				// save user data
				//$this->{$this->modelClass}->save($this->data, array('validate'=>false))
				if ($this->{$this->modelClass}->save($this->data, array('validate'=>false))) {
				//pr($this->data); 
					$userId		=	$this->{$this->modelClass}->id;
					
					$this->{$this->modelClass}->UserDetail->savePotentialPartnerAdmin($userId,$this->request->data);
					$this->Session->setFlash(__('Potential Partner record has been added.'), 'success');
					$this->redirect(array('action' => 'potential_partner'));
				}
			}
		}
	}
	
	function edit_potential_partner($id = null) {
			  
		if(!isset($id) || $id == '' ){
			
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'partners', 'action' => 'index'));
		}
		$user = $this->{$this->modelClass}->findById($id);
		//pr($user); die;
		if(empty($user)) {
		
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'partners', 'action' => 'index'));
		}
		$this->{$this->modelClass}->set($user);
		// Breadcrumb
			$this->loadModel('County');
			$this->loadModel('District');
			$counties = $this->County->find('list',array('order'=>'name asc'));
			$districts = $this->District->find('list',array('order'=>'name asc'));
			$this->set('counties',$counties);
			$this->set('districts',$districts);
			
		$comercial_agent	=	$this->{$this->modelClass}->find('list',array('fields'=>array('id','username'),'conditions'=>array('user_role_id'=>Configure::read('user_roles.comercial_agent'),'is_deleted'=>0)));	
		$this->set('comercial_agent',$comercial_agent);	
		$AdminData = $user[$this->modelClass]['email'];
		$this->set('AdminData',$AdminData);
		$pageHeading = __('Potential Partner');
			
		$pageHeading = __('Potential Partner');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Potential Partner', true)] = array('action' => 'potential_partner');
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Edit').' '.$pageHeading);
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
			//pr($this->data);
		}else{
		
			$old_data			= 	$this->{$this->modelClass}->read();
			
			$this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->PotentialValidate()) {
				//$rand_number 	=	$this->rand_string(8);
				if ($this->{$this->modelClass}->save($this->data,false)) {
					//$this->request->data[$this->modelClass]['commercial_code']	=	$old_data[$this->modelClass]['commercial_code'];
					$this->{$this->modelClass}->UserDetail->savePotentialPartnerAdmin($id,$this->request->data);
					$this->Session->setFlash(__('Potential Partner record has been updated.'), 'success');
					$this->redirect(array('action' => 'potential_partner'));
				}
			}
		}
	}
	
	public function view_potential_partner_detail($id = null) {
		// Breadcrumb
		$pageHeading = __('Potential Partner Detail');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
	
		$breadcrumb = array('pages' => $pages, 'active' =>$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->virtualFields  = array(
			'commercial_agent'=> "SELECT username  FROM users WHERE id=".$this->modelClass.".parent_id",
			'comercial_code'=> "SELECT code  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id",
			'name'=> "SELECT field_value  FROM user_details WHERE user_id=".$this->modelClass.".id AND field_name='User.name'",
			'discount'=> "SELECT discount  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id",
			'end_date'=> "SELECT end_date  FROM comercial_codes WHERE partner_id=".$this->modelClass.".id"
			
			); 
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		
		if(isset($this->passedArgs['name']) && !empty($this->passedArgs['name'])){
			$parsedConditions['name']	=		$this->passedArgs['name']; 
		} 
		
		$parsedConditions['id'] 	= $id;
		$this->paginate = array(
			'conditions' => $parsedConditions,
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$result= $this->paginate();
		$this->set('result', $result);		
	}
	
	public function upgradation_detials($type) {
		
		$this->loadModel('PartnerUpgradation');
		$result	=	$this->PartnerUpgradation->find('all',array('conditions'=>array('upgradation_type'=>$type)));
		$this->set('result',$result);
	}
	
	public function add_upgradations($type=1) {
		
		
		$page_headings	=	__("Add Ugradation type");
		$upgradations	=	Configure::read('upgradation_types');
		$pages[__('Dashboard', true)]			=	array('plugin' => '', 'controller' => '/');
		$pages[$upgradations[$type]]			=	array('plugin' => 'usermgmt', 'controller' => 'partners', 'action'=>'upgradation_detials',$type);
		$breadcrumb 							=	 array('pages' => $pages, 'active' => $page_headings);
		$this->set('breadcrumb', $breadcrumb);

		$this->loadModel('Usermgmt.PartnerUpgradation');
		// Breadcrumb
		if(!empty($this->data)){ // if form submited
			
			$this->PartnerUpgradation->set($this->data);
			
			if($this->PartnerUpgradation->PartnerUpgradationValidate($this->data)) {
				$data			=	$this->data;
				$data['PartnerUpgradation']['upgradation_type']	=	$type;
				$data['PartnerUpgradation']['type']				=	'';
				$this->data										=	$data;
				$this->PartnerUpgradation->save($this->data,false);
				$this->Session->setFlash(__('Upgradation has been added.'), 'success');
				$this->redirect(array('action' => 'upgradation_detials',$type));
				exit;
			}	
		}
		$this->set('page_headings',$page_headings);
		$this->set('type',$type);
	}
	
	public function delete_upgradations($id=1) {
		
		$this->loadModel('Usermgmt.PartnerUpgradation');
		if($this->request->is('Ajax')){
			if($this->data['id'] != null){
				if($this->PartnerUpgradation->delete($this->data['id'])){
					echo 'Success';
				}else{
					echo 'error';
				}
		    }	
		}	
		exit;
	}
	
	function downloadReport($filename = null) {
  
		
	  $file = ALBUM_UPLOAD_IMAGE_PATH.$filename;
	//  echo $file; die;
	  if (!is_file($file)) { die("<b>404 File not found!</b>"); }

	 //Gather relevent info about file
	 $len 		= 	filesize($file);
	 $filename 	= 	basename($file);
	 $file_extension = strtolower( substr( strrchr( $filename, "." ), 1 ) );
	
	 //This will set the Content-Type to the appropriate setting for the file
	 switch( $file_extension ) {
	   case "pdf": $ctype 	= "application/pdf"; break;
	   case "exe": $ctype 	= "application/octet-stream"; break;
	   case "zip": $ctype 	= "application/zip"; break;
	   case "docx": $ctype 	= "application/vnd.openxmlformats-officedocument.wordprocessingml.document"; break;
	   case "doc": $ctype 	= "application/msword"; break;
	   case "xlsx": $ctype 	= "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; break;
	   case "xls": $ctype 	= "application/vnd.ms-excel"; break;
	   case "ppt": $ctype 	= "application/vnd.ms-powerpoint"; break;
	   case "gif": $ctype 	= "image/gif"; break;
	   case "png": $ctype 	= "image/png"; break;
	   case "jpeg":
	   case "jpg": $ctype 	= "image/jpg"; break;
	   case "mp3": $ctype 	= "audio/mpeg"; break;
	   case "wav": $ctype 	= "audio/x-wav"; break;
	   case "mpeg":
	   case "mpg":
	   case "mpe": $ctype 	= "video/mpeg"; break;
	   case "mov": $ctype 	= "video/quicktime"; break;
	   case "avi": $ctype 	= "video/x-msvideo"; break;
	
	   //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
	   case "php":
	   case "htm":
	   case "html": die("<b>Cannot be used for " . $file_extension . " files!</b>"); break;
	
	   default: $ctype = "application/force-download";
	 }
	
	 //Begin writing headers
	 header("Pragma: public");
	 header("Expires: 0");
	 header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	 header("Cache-Control: public"); 
	 header("Content-Description: File Transfer");
	 
	 //Use the switch-generated Content-Type
	 header("Content-Type: $ctype");
	
	 //Force the download
	 // if($alt_name==''){ $alt_name = $filename;}else{ $alt_name = $alt_name . '.' . $file_extension;}
	 $header="Content-Disposition: attachment; filename=" . $filename . ";";
	 header($header );
	 header("Content-Transfer-Encoding: binary");
	 header("Content-Length: " . $len);
	 @readfile($file);
	 exit();
	}
	public function change_status(){
		if($this->request->is('Ajax')){
				if($this->data['id'] != null){
				$data	=	array();
						$status	=	$this->{$this->modelClass}->find('first',array('conditions'=>array('id'=>$this->data['id'])));
						if($status[$this->modelClass]['is_suspend'] == 1){
							$data['is_suspend']	=	0;
							
							$this->{$this->modelClass}->id	=	$this->data['id'];
							$this->{$this->modelClass}->save($data,false);
							echo 'Not Suspended'; exit;
						}else {
							$data['is_suspend']	=	1;
							$this->{$this->modelClass}->id	=	$this->data['id'];
							$this->{$this->modelClass}->save($data,false);
							echo 'Suspended'; exit;
						}
						
					$this->Session->setFlash(__('Partner record has been updated.'), 'success');
					}
			}	
			exit;
	  }		
}