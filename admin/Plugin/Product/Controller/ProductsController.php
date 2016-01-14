<?php
class ProductsController  extends ProductAppController  {
	
	
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Products';
	
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
			
	public function index($dropdown_type='Products') {
		
		$dropdown_type=__('Products');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		
		$pageHeading	=	__('Product');
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['admin_id'] = $this->Auth->user('id');
		$this->paginate = array(
		'conditions' => $parsedConditions,
		//'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$result= $this->paginate();

		$this->set('result', $result);
	}

	function add($dropdown_type='Products') {
		$dropdown_type=__('Products');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add New').' '.$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		$pageHeading	=	__('Add Product');
		$this->set('pageHeading',$pageHeading);
			if (!empty($this->data)) {
				$data = $this->data;
				$data['Product']['admin_id'] = $this->Auth->user('id');
				$this->{$this->modelClass}->set($data);
				if($this->{$this->modelClass}->validates()) {
					// pr($	data); die;
					if ($this->{$this->modelClass}->save($data)) {
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
			$dropdown_type=__('Products');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['name'], true));
			$pageHeading	=	__('Edit Product');
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
				$data = $this->data;
				$data['Product']['admin_id'] = $this->Auth->user('id');
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {				
					if ($this->{$this->modelClass}->save($data)) {
						$this->Session->setFlash(__($singularize .' has been updated.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
			}
	}
	
 function deleted($id=null) {
	 $dropdown_type=__('Products');
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
			 $dropdown_type=__('Products');
				
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
		$header = array(__('Product Name'),__('Created'));
			$productdata = $this->{$this->modelClass}->find('all');
			$data = array();
			foreach($productdata as $key => $ddata){
				$data[$key]['name']		=	$ddata['Product']['name'];
				$data[$key]['created']	=	date('m-d-Y',$ddata['Product']['created']);
			}
			$this->export_file($header,$data,'csv');
		exit;
		
	}
	
	public function generate_pdf(){
			
			$results	=	$this->{$this->modelClass}->find('all');
			$header_row = array(__("Product Name"),__("Created"));
			foreach($results as $key => $ddata){
				$data[$key]['name']		=	$ddata['Product']['name'];
				$data[$key]['created']	=	date('m-d-Y',$ddata['Product']['created']);
			}
			$this->export_file($header_row,$data,'pdf');
				
			die;
	}
	
	
}
