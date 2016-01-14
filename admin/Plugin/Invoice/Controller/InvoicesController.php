<?php
class InvoicesController  extends InvoiceAppController  {
	
	
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Invoices';
	
/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time','Fck');

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
 * Admin Index
 *
 * @return void
 */	
			
	public function index($client_id=0) {
		
		
		$dropdown_type=__('Invoices');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		
		
		if(!$client_id){
			$this->Session->setFlash(__('Please select a client for invoices'), 'success');
			$this->redirect(array('plugin'=>'usermgmt','controller'=>'clients','action' => 'index'));
		}
		$this->loadModel('Usermgmt.Client');
		$client = $this->Client->findById($client_id);
		$this->set('client_id',$client_id);
		
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($client['Client']['first_name'].(!empty($client['Client']['last_name'])?' '.$client['Client']['last_name']:'')."'s Invoices", true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}else {
			$this->Prg->commonProcess();
		}		
		
		$pageHeading	=	$client['Client']['first_name'].(!empty($client['Client']['last_name'])?' '.$client['Client']['last_name']:'')."'s Invoices";
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['Invoice.client_id'] = $client_id;
		
		$this->paginate = array(
		'conditions' => $parsedConditions,
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$result= $this->paginate();
		// pr($result);
		$this->set('result', $result);
	}
	
	public function apply_discount() {
		
		// pr($this->data); die;
		
		if(!empty($this->data) && isset($this->data["Discount"]['discount_amount'])){
			$this->{$this->modelClass}->id = $this->data["Discount"]['invoice_id'];
			$discount = array();
			$discount = $this->data["Discount"];
			// pr($discount); die;
			unset($discount['invoice_id']);
			if($this->{$this->modelClass}->save($discount,false)){
				$this->Session->setFlash(__('Discount applied successfully.'), 'success');
				$this->redirect(array('action' => 'view',$this->{$this->modelClass}->id));
			}
		}else{
			$this->redirect($this->referer);
		}
	}
	
	public function manual_payment() {
		
		// pr($this->data); die;
		/* $this->{$this->modelClass}->belongsTo = array(
										"Client"=>array('className'=>'Usermgmt.Client','foreignKey'=>'client_id'),
										"Gallery"=>array('className'=>'Gallery','foreignKey'=>'gallery_id'),
										"Shoot"=>array('className'=>'Shoot','foreignKey'=>'shoot_id'),
										"Product"=>array('className'=>'Product.Product','foreignKey'=>'product_id')
										); */
										
		if(!empty($this->data) && isset($this->data["Payment"]['amount'])){
			$this->loadModel("Transaction");
			$transaction = array();
			$transaction['transaction_id'] = $this->data["Payment"]['transaction_id'];
			$transaction['invoice_id'] = $this->data["Payment"]['invoice_id'];
			$transaction['paid'] = $this->data["Payment"]['amount'];
			$transaction['method'] = $this->data["Payment"]['method'];
			$transaction['payment_date'] = $this->data["Payment"]['payment_date'];
			$transaction['status'] = 1;
			$this->Transaction->save($transaction,false);
			
			
										
			$this->{$this->modelClass}->id = $this->data["Payment"]['invoice_id'];
			$invoice = $this->{$this->modelClass}->read();
			
			if($this->{$this->modelClass}->save(array('paid'=>$invoice["Invoice"]['paid']+$this->data["Payment"]['amount'],'status'=>($invoice["Invoice"]['paid']+$this->data["Payment"]['amount']+$invoice["Invoice"]['discount_amount']==$invoice["Invoice"]['total'])),false)){
			
				/* Send payment success email */
				
					if($invoice["Invoice"]['paid']+$transaction['paid']+$invoice["Invoice"]['discount_amount']>=$invoice["Invoice"]['total']){
					// pr($transaction);
				// pr($invoice);
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
								
							$reg_succ_id	=	Configure::read('global_ids.email_template.invoice_paid_email');
							
							$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

							$action 		= $email_template['EmailTemplate']['action'];
							
							$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
							
							$cons = explode(',',$action['EmailAction']['options']);
							$constants = array();
							foreach($cons as $key=>$val){
								$constants[] = '{'.$val.'}';
							}
							//SHOOT_TITLE,SHOOT_TIME,FIRST_NAME,LAST_NAME,RELEASE_DATE,PAYMENT
							$shoot_title   	=   $invoice["Shoot"]['title'];
							$shoot_time   	=   $invoice["Shoot"]['date']." ".$invoice["Shoot"]['hour'].":".$invoice["Shoot"]['min'].$invoice["Shoot"]['meridian'];
							
							$first_name 	=	$invoice["Client"]['first_name']; 
							$last_name 		=	$invoice["Client"]['last_name']; 
							$release_date	=	isset($invoice["Gallery"]['date'])?$invoice["Gallery"]['date']:$invoice["Shoot"]['date']; 
							// $payment		=	$invoice["Invoice"]['payment']-$invoice["Invoice"]['discount_amount']-$invoice["Invoice"]['paid']; 
							$payment		=	$invoice["Invoice"]['total']; 
							$email   		=   $invoice["Client"]["email"];
							
							$rep_Array = array($shoot_title,$shoot_time,$first_name,$last_name, $release_date, $payment ); 
						
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
			
			
				$this->Session->setFlash(__('Manual Payment applied successfully.'), 'success');
				$this->redirect(array('action' => 'view',$this->{$this->modelClass}->id));
			}
		}else{
			$this->redirect($this->referer);
		}
	}
	
	
	function view($id = null) {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
			
		  
			$this->{$this->modelClass}->belongsTo = array(
										"Client"=>array('className'=>'Usermgmt.Client','foreignKey'=>'client_id'),
										"Product"=>array('className'=>'Product.Product','foreignKey'=>'product_id')
										);
			$invoice = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Invoices');
			
			$this->loadModel('Usermgmt.Client');
			$client = $this->Client->findById($invoice[$this->modelClass]['client_id']);
			$this->set('client',$client);
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$invoice[$this->modelClass]['client_id']);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($invoice[$this->modelClass]['title'], true));
			$pageHeading	=	$invoice[$this->modelClass]['title'];
			$this->set('pageHeading',$pageHeading);
			$this->{$this->modelClass}->id = $id; 
			$this->set('breadcrumb', $breadcrumb);
			$this->set('dropdown_type', $dropdown_type);
			$this->set('humanize', $humanize);
			$this->set('singularize', $singularize);
			$this->set('id', $id);
			if (empty($this->data)) {
				$this->data = $this->{$this->modelClass}->read();
				$this->loadModel("ShootProduct");
				$this->loadModel("Product");
				$soot_products = $this->ShootProduct->find("list",array('conditions'=>array("shoot_id"=>$this->data[$this->modelClass]["shoot_id"]),'fields'=>array("product_id")));
				// pr($soot_products);
				if(count($soot_products)>1){
					$products = $this->Product->find("all",array('conditions'=>array("Product.id IN "=>$soot_products)));
				}else{
					$soot_products[] = 0;
					$products = $this->Product->find("all",array('conditions'=>array("Product.id IN "=>$soot_products)));
				}
				// pr($products);
				// pr($this->data); die;
				$this->set("products", $products);
			 } else {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {				
					if ($this->{$this->modelClass}->save($this->data)) {
						$this->Session->setFlash(__($singularize .' has been updated.'), 'success');
						$this->redirect(array('action' => 'index',$invoice[$this->modelClass]['client_id']));
					}
				}
			}
	}
	
	
	public function add($client_id = null) {		
		$dropdown_type=__('Invoice');
		$pageHeading=__('Create Invoice');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('pageHeading', $pageHeading);
		$this->set('client_id', $client_id);
		$this->set('singularize', $singularize);
		$this->set('states', $this->getStatesList());
		
		$admin_id = $this->Auth->user('id');
		$this->loadModel('User');
		$this->loadModel('Product');
		$product_list = $this->Product->find('list',array('fields'=>array('id','name'),'conditions'=>array('admin_id'=>$admin_id)));
		$this->set('product_list', $product_list);
		$this->set('product_price_list', $this->Product->find('list',array('fields'=>array('id','price'),'conditions'=>array('admin_id'=>$admin_id))));
		$this->User->virtualFields  = array(
											'full_name' => 'CONCAT(User.first_name, " ", User.last_name)'
										);
		$this->set('client_list', $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.client"),'parent_id'=>$admin_id),'fields'=>array('id','full_name'),'order'=>"last_name asc")));
		
		$this->User->virtualFields = array('comment'=>'(SELECT `field_value` as price from `user_details` WHERE `user_details`.`field_name`="User.comment" AND `user_details`.`user_id`=User.id)');
		$this->set('client_comment_list', $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.client"),'parent_id'=>$admin_id),'fields'=>array('id','comment'))));
		$photographer_list = $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.photographer"),'parent_id'=>$admin_id),'fields'=>array('id','first_name')));
		$this->set('photographer_list', $photographer_list);
		
		$this->User->virtualFields = array('price'=>'(SELECT `field_value` as price from `user_details` WHERE `user_details`.`field_name`="User.price" AND `user_details`.`user_id`=User.id)');
		$photographer_price_list = $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.photographer"),'parent_id'=>$admin_id),'fields'=>array('id','User.price')));
		
		$this->set('photographer_price_list', $photographer_price_list);
		
		
		$this->loadModel("Shoot");
		if (!empty($this->data)) {
				// $this->Shoot->set($this->data);
					// pr($this->data); die;
				if($this->Shoot->validates()) {
					// pr($this->data); 
					
					$data = $this->data;
					$data["Shoot"]['hour'] 	= 	$data["Shoot"]['time']['hour'];
					$data["Shoot"]['min'] 	= 	$data["Shoot"]['time']['min'];
					$data["Shoot"]['meridian'] 	= 	$data["Shoot"]['time']['meridian'];
					unset($data["Shoot"]['time']);
					
					$data['Gallery']['client_id'] 	= 	$data["Shoot"]['client_id'];
					$data['Gallery']['hour'] 	= 	$data['Gallery']['time']['hour'];
					$data['Gallery']['min'] 	= 	$data['Gallery']['time']['min'];
					$data['Gallery']['meridian'] 	= 	$data['Gallery']['time']['meridian'];
					unset($data['Gallery']['time']);
					// pr($data); 
					if ($this->Shoot->save($data,false)) {
						$shoot_id = $this->Shoot->id;
						$this->loadModel('Gallery');
						$this->Gallery->save($data,false);
						$gallery_id = $this->Gallery->id;
						$this->Shoot->save(array("gallery_id"=>$gallery_id),false);
						
						/* Save Invoices */
						if($data['Invoice']['create_invoice']){
						
							$invoice	=	array();
							$invoice['title']		=	$data['Shoot']['title'];
							$invoice['shoot_id']	=	$shoot_id;
							$invoice['gallery_id']	=	$gallery_id;
							$invoice['client_id']	=	$data['Shoot']['client_id'];
							$invoice['recipient_id']	=	$data['Invoice']['recipient'];
							$invoice['product_id']		=	$data['Shoot']['product_id'];
							$invoice['photographer_id']	=	$data['Shoot']['photographer_id'];
							$invoice['payment']			=	$data['Shoot']['price'];
							$invoice['send_confirmation']	=	$data['Invoice']['send_confirmation'];
							$invoice['due_date']	=	$data['Invoice']['due_date'];
							$invoice['send_reminder']	=	$data['Invoice']['send_reminder'];
							$invoice['status']	=	0;
							$tax = 0;
							if(isset($data['Shoot']['product_id']) && !empty($data['Shoot']['product_id'])){
								$this->loadModel("Product");
								$product = $this->Product->findById($data['Shoot']['product_id']);
								if(!empty($product) && $product['Product']['taxable']){
									$tax = Configure::read('Site.sales_tax_rate');
									if(empty($tax)) $tax  = 0;
								}
							}
							
							$invoice['tax']	=	round(($data['Shoot']['price']*($tax/100)),2);
							$invoice['total']	=	$data['Shoot']['price']+round((($data['Shoot']['price']*($tax/100))),2);
							
							$this->loadModel('Invoice');
							$this->Invoice->save($invoice,array('validate'=>false));
							
						}
						// pr($invoice); die;
						
						/* Send shoot booked email */
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
								
							$reg_succ_id	=	Configure::read('global_ids.email_template.booking_confirmation');
							
							$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

							$action 		= $email_template['EmailTemplate']['action'];
							
							$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
							
							$cons = explode(',',$action['EmailAction']['options']);
							$constants = array();
							foreach($cons as $key=>$val){
								$constants[] = '{'.$val.'}';
							}
							//SHOOT_TITLE,SHOOT_DATE,SHOOT_SIZE,SHOOT_PRICE,PRODUCT,PHOTOGRAPHER,FIRST_NAME,LAST_NAME
							$shoot_title   	=   $data['Shoot']['title'];
							$shoot_date   	=   $data['Shoot']['date'];
							$shoot_size   	=   $data['Shoot']['size'];
							$shoot_price   	=   $data['Shoot']['price'];
							$product	   	=   $product_list[$data['Shoot']['product_id']];
							$photographer  	=   $photographer_list[$data['Shoot']['photographer_id']];
							
							$client = $this->User->find("first",array("conditions"=>array("User.id"=>$data['Shoot']['client_id']),'fields'=>array("first_name","last_name","email")));
							
							$first_name   	=   $client["User"]["first_name"];
							
							$last_name   	=   $client["User"]["last_name"];
							$email   		=   $client["User"]["email"];
							
							$rep_Array = array($shoot_title,$shoot_date,$shoot_size,$shoot_price,$product,$photographer,$first_name,$last_name); 
						
							$to 				= $email;
							$from_email 		= $settingsEmail['Setting']['value'];
							$from_name 			= $settingstitle['Setting']['value'];
							$from 				= $from_name . "<" . $from_email . ">";

							$replyTo 			= "";
							$subject 			= $email_template['EmailTemplate']['subject'];
							
							$message 			= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);
							
							// pr($message); die;
							$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
						
						
						
						
						$this->Session->setFlash(__($singularize . ' has been added.'), 'success');
						$this->redirect(array('action' => 'index',$client_id));
					}
				}else{
					$this->Session->setFlash(__('Validation Errors'), 'success');
						$this->redirect(array('action' => 'index',$client_id));
				}
			}
			
			$this->set('autopassword', $this->generatePassword(8,3));
			
		
	}
	
	function generatePassword($length=9, $strength=0) {
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength >= 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength >= 2) {
			$vowels .= "AEUY";
		}
		if ($strength >= 4) {
			$consonants .= '23456789';
		}
		if ($strength >= 8 ) {
			$vowels .= '@#$%';
		}

		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$password .= $vowels[(rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $password;
	}
	

	function addd($dropdown_type='Invoices') {
		$dropdown_type=__('Invoices');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add New').' '.$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		$pageHeading	=	__('Add Invoice');
		$this->set('pageHeading',$pageHeading);
			if (!empty($this->data)) {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {
					// pr($this->data); die;
					if ($this->{$this->modelClass}->save($this->data)) {
						$this->Session->setFlash(__($singularize .' has been added.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
			}
	}
	function edit($client_id = 0, $id = null) {
		  if(!isset($id) || $id == '' || $client_id == 0 ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
			$user = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Invoices');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['title'], true));
			$pageHeading	=	__('Edit Invoice');
			$this->set('pageHeading',$pageHeading);
			$this->{$this->modelClass}->id = $id; 
			$this->set('breadcrumb', $breadcrumb);
			$this->set('dropdown_type', $dropdown_type);
			$this->set('humanize', $humanize);
			$this->set('singularize', $singularize);
			$this->set('id', $id);
			// echo $client_id; die;
			$this->set('client_id', $client_id);
			if (empty($this->data)) {
				$this->data = $this->{$this->modelClass}->read();
			 } else {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {				
					if ($this->{$this->modelClass}->save($this->data)) {
						$this->Session->setFlash(__($singularize .' has been updated.'), 'success');
						
						$this->redirect(array('action' => 'index',$client_id));
					}
				}
			}
	}
	
 function deleted($id=null) {
	 $dropdown_type=__('Invoices');
		if($id == null){
				die(__("No ID received"));
			}else{	
			
				$humanize 				= Inflector::humanize($dropdown_type);
				$singularize 			= Inflector::singularize($humanize);
				$this->{$this->modelClass}->delete($id);
				$this->Session->setFlash(__($singularize.' has been deleted.'),'success');
				$this->redirect(array('action'=>'index',$dropdown_type));
			}
		}
	function delete() {
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null){
			 $dropdown_type=__('Invoices');
				
				if($this->{$this->modelClass}->delete($this->data['id'])){
					
					echo 'success';
				}else{
					echo 'error';
				}
			}
		} exit;
	}
	
	function generatereport(){
		//echo 'fghfg'; die;
		$this->layout	= false;
		$header = array(__('Invoice Name'),__('Created'));
			$invoicedata = $this->{$this->modelClass}->find('all');
			$data = array();
			foreach($invoicedata as $key => $ddata){
				$data[$key]['name']		=	$ddata['Invoice']['name'];
				$data[$key]['created']	=	date('m-d-Y',$ddata['Invoice']['created']);
			}
			$this->export_file($header,$data,'csv');
		exit;
		
	}
	
	public function generate_pdf(){
			
			$results	=	$this->{$this->modelClass}->find('all');
			$header_row = array(__("Invoice Name"),__("Created"));
			foreach($results as $key => $ddata){
				$data[$key]['name']		=	$ddata['Invoice']['name'];
				$data[$key]['created']	=	date('m-d-Y',$ddata['Invoice']['created']);
			}
			$this->export_file($header_row,$data,'pdf');
				
			die;
	}
	
	
}
