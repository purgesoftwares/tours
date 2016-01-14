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
	public $components = array('Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler',"AIM");

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
			
	public function index() {
		
		
		$client_id = ($this->Auth->user('Parent.user_role_id')==3)?$this->Auth->user('parent_id'):$this->Auth->user('id');
		$dropdown_type=__('Invoices');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		
		
		if(!$client_id){
			$this->Session->setFlash(__('Please login to see invoices'), 'success');
			$this->redirect('/');
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
		$parsedConditions['client_id'] = $client_id;
		
		$this->paginate = array(
		'conditions' => $parsedConditions,
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$result= $this->paginate();
		// pr($result);
		$this->set('result', $result);
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
	
	function pay($id = null) {
	
		$id = base64_decode($id);
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
			
		  $this->set('states', $this->getStatesList());
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
	
	
	function pay_cc() {
	
		
		$this->layout	=	false;
		$this->autoRender	=	false;
		// pr($this->data); die;
		
		$id = $this->data["payment"]["id"];
		  if(!isset($id) || $id == '' ) {
			 // $this->Session->setFlash(__('Invalid Access.'), 'error');
			 // $this->redirect('/');
			 $responce = array("success"=>false,"message"=>"Invalid Access.");
			 return json_encode($responce);
		  }
			
			$responce = array();
			
			
			$this->{$this->modelClass}->belongsTo = array(
										"Client"=>array('className'=>'Usermgmt.Client','foreignKey'=>'client_id'),
										"Gallery"=>array('className'=>'Gallery','foreignKey'=>'gallery_id'),
										"Shoot"=>array('className'=>'Shoot','foreignKey'=>'shoot_id'),
										"Product"=>array('className'=>'Product.Product','foreignKey'=>'product_id')
										);
			$invoice = $this->{$this->modelClass}->findById($id);
			
			
			$this->loadModel('Usermgmt.Client');
			$client = $this->Client->findById($invoice[$this->modelClass]['client_id']);
			$this->set('client',$client);
			
			
			$this->{$this->modelClass}->id = $id; 
			
			$this->set('id', $id);
			if (empty($this->data)) {
				// $this->data = $this->{$this->modelClass}->read();
				$responce = array("success"=>false,"message"=>"Invalid Access.");
				 // $this->Session->setFlash(__('Invalid Access.'), 'error');
				// $this->redirect($this->referer);
			 } else {
				
				
				$remailing_amount = $invoice[$this->modelClass]['total']-$invoice[$this->modelClass]['discount_amount']-$invoice[$this->modelClass]['paid'];
				
			$card_details =	array(
							'Billing' => $this->data["Billing"],
							'CreditCard' => array(
								'number'            => $this->data["CreditCard"]["number"],
								'expiration'        => $this->data["CreditCard"]["expiration"]["month"]["month"].$this->data["CreditCard"]["expiration"]["year"]["year"]
							),
							'Transaction'   => array(
								'amount'            => $remailing_amount,
								'description'       => "Payment for shoot ".$invoice[$this->modelClass]['title'],
								'invoice_number'    => $invoice[$this->modelClass]['id'],
							)
						);
			$aim = new AIMComponent(new ComponentCollection());	
			
			// $aim->login_id = 
			
				
				$payment_details = $aim->auth_capture($card_details);
				
				// pr($payment_details); die;
				$responce_codes = array("1"=>"Approved","2"=>"Declined","3"=>"Error","4"=>"Held for Review");
				$responce_code_texts = array("1"=>"This transaction has been approved.","2"=>"This transaction has been declined.","3"=>"There has been an error processing this transaction.","4"=>"This transaction is being held for review.");
				
				if($payment_details[0]==1){
				
					
					$this->loadModel("Transaction");
					$transaction = array();
					$transaction['transaction_id'] = $payment_details[6];
					$transaction['invoice_id'] = $id;
					$transaction['invoice_no'] = $payment_details[37];
					$transaction['paid'] = $remailing_amount;
					$transaction['method'] = $payment_details[10];
					$transaction['payment_date'] = date("m-d-Y");
					$transaction['description'] = $payment_details[8];
					$transaction['details'] = json_encode($card_details);
					$transaction['auth_code'] = $payment_details[4];
					$transaction['status'] = 1;
					$this->Transaction->save($transaction,false);
					
					// $this->{$this->modelClass}->id = $this->data["Payment"]['invoice_id'];
					// $invoice = $this->{$this->modelClass}->read();
					$this->{$this->modelClass}->belongsTo = array();
					$this->{$this->modelClass}->save(array('paid'=>$invoice["Invoice"]['paid']+$transaction['paid'],'status'=>($invoice["Invoice"]['paid']+$transaction['paid']+$invoice["Invoice"]['discount_amount']==$invoice["Invoice"]['total'])),false);
					
					$responce = array("success"=>true,"message"=>$payment_details[3]);
					
					/* Send payment success email */
					if($invoice["Invoice"]['paid']+$transaction['paid']+$invoice["Invoice"]['discount_amount']==$invoice["Invoice"]['total']){
					
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
					
				}else{
					$responce = array("success"=>false,"message"=>$payment_details[3]);
				}
				
				
				// pr($payment_details);
				// pr($invoice); 
				// pr($this->data); die;
				
				
			}
				return json_encode($responce);
	}
	
	public function do_payment($lid = null){
			$lid = base64_decode($lid);
			if($lid != null){
				$this->{$this->modelClass}->belongsTo = array(
										"Client"=>array('className'=>'Usermgmt.Client','foreignKey'=>'client_id'),
										"Product"=>array('className'=>'Product.Product','foreignKey'=>'product_id')
										);
				$invoice = $this->{$this->modelClass}->findById($lid);
				// pr($invoice);die;
				$key = 'Invoice';
				$remailing_amount = $invoice[$this->modelClass]['total']-$invoice[$this->modelClass]['discount_amount']-$invoice[$this->modelClass]['paid'];
				
				$paypalArray[$key]["title"] = $invoice[$this->modelClass]['title'];
				$paypalArray[$key]["price"] = $remailing_amount;
				$paypalArray[$key]["description"] = "Payment for shoot ".$invoice[$this->modelClass]['title'];
				// $paypalArray[$key]["duration"] = $value["SubscriptionLevel"]["duration"];
				$paypalArray[$key]["qty"] = 1;
				$paypalArray[$key]["shipping_cost"] = 0;
							
				$total = $paypalArray[$key]["price"];
				
				$paypalArray[$key]["amount"] = $total;
				
				$ids["id"] = $lid;
				$this->_dealPayment($paypalArray, $total, $ids);
			}
		}
		
		function _dealPayment($data = null, $total, $ids) {

			if ($data) {
				App::import('Component', 'Paypal');
				$Paypal = new PaypalComponent();
				$Paypal->dealPayment($data, $total, $ids);
				$this->autoRender = false;
			} else {
				$this->Session->setFlash(__('We could not proceed your payment', true), 'error');
				$this->redirect(array('plugin' => 'invoice', 'controller' => 'invoices', 'action' => 'index'));
			}
		}
		
		function paypal_response() {

			$this->autoRender = false;
			$this->layout = false;
			$status = "Completed";
			if (Configure::read('Payment.paypal_sandbox')) {
				$status = "Pending";
			}
			// pr($this->data); die;
			if (!empty($this->data) && (strtolower($this->data['payment_status']) == strtolower($status)) || (strtolower($this->data['payment_status']) == 'pending')){
			
				$response = $this->data;
					
					$this->{$this->modelClass}->belongsTo = array(
										"Client"=>array('className'=>'Usermgmt.Client','foreignKey'=>'client_id'),
										"Gallery"=>array('className'=>'Gallery','foreignKey'=>'gallery_id'),
										"Shoot"=>array('className'=>'Shoot','foreignKey'=>'shoot_id'),
										"Product"=>array('className'=>'Product.Product','foreignKey'=>'product_id')
										);
					$invoice = $this->{$this->modelClass}->findById($response['custom']);
			
					$this->loadModel("Transaction");
					$transaction = array();
					$transaction['transaction_id'] = $response['txn_id'];
					$transaction['invoice_id'] = $response['custom'];
					$transaction['paid'] = $response["mc_gross"];
					$transaction['method'] = "paypal";
					$transaction['payment_date'] = date("m-d-Y");
					$transaction['description'] = $response["item_name1"];
					$transaction['details'] = json_encode($response);
					$transaction['auth_code'] = $response["auth"];
					$transaction['status'] = 1;
					$this->Transaction->save($transaction,false);
					
					$this->loadModel('PaymentTransaction');
					$this->{$this->modelClass}->id 	=	$response['custom'];
					$this->{$this->modelClass}->belongsTo = array();
					$this->{$this->modelClass}->save(array('paid'=>$invoice["Invoice"]['paid']+$transaction['paid'],'status'=>($invoice["Invoice"]['paid']+$transaction['paid']+$invoice["Invoice"]['discount_amount']==$invoice["Invoice"]['total'])),false);
					
					
					/* Send payment success email */
					if($invoice["Invoice"]['paid']+$transaction['paid']+$invoice["Invoice"]['discount_amount']==$invoice["Invoice"]['total']){
					
						
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
					
					/* Send payment success email */
					
					$this->Session->setFlash(__('Your payment has been approved.', true), 'success');
					$this->redirect(array('plugin' => 'invoice', 'controller' => 'invoices', 'action' => 'view',$response['custom']));
					exit;
				
				
			} else {
				$this->Session->setFlash(__('Your payment is failed. Please try again or contact to the sales team.', true), 'error');
				$this->redirect(array('plugin' => 'invoice', 'controller' => 'invoices', 'action' => 'view',$response['custom']));
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
		
		$this->loadModel('User');
		$this->loadModel('Product');
		$this->set('product_list', $this->Product->find('list',array('fields'=>array('id','name'))));
		$this->set('product_price_list', $this->Product->find('list',array('fields'=>array('id','price'))));
		$this->set('client_list', $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.client")),'fields'=>array('id','first_name'))));
		
		$this->User->virtualFields = array('comment'=>'(SELECT `field_value` as price from `user_details` WHERE `user_details`.`field_name`="User.comment" AND `user_details`.`user_id`=User.id)');
		$this->set('client_comment_list', $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.client")),'fields'=>array('id','comment'))));
		
		$this->set('photographer_list', $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.photographer")),'fields'=>array('id','first_name'))));
		
		$this->User->virtualFields = array('price'=>'(SELECT `field_value` as price from `user_details` WHERE `user_details`.`field_name`="User.price" AND `user_details`.`user_id`=User.id)');
		$photographer_price_list = $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.photographer")),'fields'=>array('id','User.price')));
		
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
	function edit($id = null) {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
			$user = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Invoices');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['name'], true));
			$pageHeading	=	__('Edit Invoice');
			$this->set('pageHeading',$pageHeading);
			$this->{$this->modelClass}->id = $id; 
			$this->set('breadcrumb', $breadcrumb);
			$this->set('dropdown_type', $dropdown_type);
			$this->set('humanize', $humanize);
			$this->set('singularize', $singularize);
			$this->set('id', $id);
			if (empty($this->data)) {
				$this->data = $this->{$this->modelClass}->read();
			 } else {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {				
					if ($this->{$this->modelClass}->save($this->data)) {
						$this->Session->setFlash(__($singularize .' has been updated.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
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
