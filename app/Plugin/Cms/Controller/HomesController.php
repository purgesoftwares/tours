<?php
class HomesController extends CmsAppController {


/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Homes';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time','Fck','Text');

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
		array('field' => 'name', 'type' => 'value'),
		array('field' => 'body', 'type' => 'value')
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
	function home() {
		
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Cms Pages', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Welcome To Goobond');
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		
		$this->paginate = array(
							'conditions' => array($parsedConditions),
							'limit' => $limit,
							'order'=>	array($this->modelClass . '.created' => 'desc')	
							);		
		$this->set('result', $this->paginate());
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
	}

	/**
 * Admin Edit cms
 *
 * @param integer $id Cms id
 * @return void
 */
	function edit($id = 1) {
		   //echo 'gdfgf'; die;
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect(array('controller' => 'pages', 'action' => 'index'));
		  }
			$user = $this->{$this->modelClass}->findById($id);
			$this->{$this->modelClass}->set($user);
		// Breadcrumb
		//pr($this->referer());
		$pages[__('Dashboard', true)] = array('plugin' => false, 'controller' => '/', 'action' => '');
		$pages[__('Cms Pages', true)] =  $this->referer();//array('plugin' => 'cms', 'controller' => 'pages', 'action' => 'index');
		$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['title_'.$this->Session->read('Config.language')], true));
		$this->loadModel('Language');
		$language	=	$this->Language->find('list');
		$this->set('language',$language);
		$this->{$this->modelClass}->id = $id; 
		$this->set('breadcrumb', $breadcrumb);
		$this->set('id', $id);
		$this->set('referer',$this->referer());
		$pageHeading	=	__('Edit Page');
		$this->set('pageHeading',$pageHeading);
		
		//Read values from database and edit  the record
		if (empty($this->data)) {
			$this->data = $this->{$this->modelClass}->read();
			//pr($this->data); die;
		 } else {
		 // pr($this->data); die;
			$this->{$this->modelClass}->set($this->data);
			//pr($this->data); die;
			$data	=	$this->data;
			$data[$this->modelClass]['modified']	=	time();
			$this->data	=	$data;
			if($this->{$this->modelClass}->AddCmsPageValidate()) {				
				if ($this->{$this->modelClass}->save($this->data)) {
					$this->Session->setFlash(__('CMS page has been updated.'), 'success');
					$this->redirect($this->data[$this->modelClass]['referer']);
				}
			}
		}
	}
	
	function add() {
		
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__('Cms Pages', true)] =  $this->referer();//array('plugin' => 'cms', 'controller' => 'pages', 'action' => 'index');
		$breadcrumb = array('pages' => $pages, 'active' => __("Add Cms pages"));
		$this->loadModel('Language');
		$language	=	$this->Language->find('list');
		$this->set('language',$language);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('referer',$this->referer());
		//Read values from database and edit  the record
		if (!empty($this->data)) {
			$this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->AddCmsPageValidate()) {
				if ($this->{$this->modelClass}->save($this->data)) {
					$this->Session->setFlash(__('CMS page has been add.'), 'success');
					$this->redirect($this->referer());
				}
			}
		 }
	}
		

	public function delete(){
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null){
				$data['is_deleted']	=	1;	
				if($this->{$this->modelClass}->delete($this->data['id'])){
					echo 'Success'; 
				}else{
					echo 'error'; 
				}
		    }	
		}	
		exit;
	}
	
	public function homes(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Home Page', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Manage Home Page');
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	1;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
	
	}
	
	public function about_us(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('About Us', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	3;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
	
	}
	
	
	public function terms_conditions(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		
		$breadcrumb = array('pages' => $pages, 'active' => __('Terms and Conditions', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Terms & Condition');
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	2;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		//pr($this->paginate());
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		$this->set('result', $this->paginate());
	
	}
	public function how_it_works(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('How It Works', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('How It Works');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	25;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		$this->set('result', $this->paginate());
	
	}
	
	public function hello_block(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Home Page Hello Block', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Home Page Hello Block');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	34;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		$this->set('result', $this->paginate());
	
	}
	
	public function blog(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Blog', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Blog');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	26;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		$this->set('result', $this->paginate());
	
	}
	
	public function how_to_subscribe(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('How To Subscribe', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('How To Subscribe');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	27;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		$this->set('result', $this->paginate());
	
	}
	
	
	public function who_we_are(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Who We Are', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Who We Are');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	19;
		
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);	
		$this->set('result', $this->paginate());
	
	}
	public function contacts(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Contact Us', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Contact Us');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	24;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		$this->set('result', $this->paginate());
	
	}
	
	public function being_a_partner(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Being A Partner', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Being A Partner');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	31;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
	
	}
	
	public function pricing(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Pricing', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Pricing');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	32;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
	
	}
	
	public function mission(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Mission', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Mission');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	20;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		$this->set('result', $this->paginate());
		$this->set('heading', __('Mission'));
	}
	
	public function social_responsibility(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Social Responsibility', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Social Responsibility');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	21;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		$this->set('result', $this->paginate());
	}
	
	public function pressreleases(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Press Release', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Press Release');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	22;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
	}
	
	public function recruitments(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Recruitments', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Recruitments');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	23;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
		
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
	}
	
	public function data_protection(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Data Protection', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Data Protection');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	28;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
	}
	
	public function terms_and_conditions(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Terms & Conditions', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Terms & Conditions');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	29;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		
	}
	
	public function web_site_map(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Web Site Map', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		$pageHeading	=	__('Web Site Map');
		$this->set('pageHeading',$pageHeading);
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	30;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
		$setlang	=	'';
		$setlang	=	$this->Session->read('Config.language');
		if($setlang == ''){
			$setlang	=	'pt';
		}
		
		$this->set('setlang',$setlang);
		
	}
	
	public function newsletter_desc(){
	
		// Breadcrumb
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __('Newsletter Description', true));		
		$this->set('breadcrumb', $breadcrumb);
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['page_type']	=	'cms';
		$parsedConditions['id']	=	6;
		$this->paginate = array(
		'conditions' => array($parsedConditions),
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$this->set('result', $this->paginate());
	
	}


}