<?php
class CountriesController  extends CountryAppController  {
	
	
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Countries';
	
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
			
	public function index($dropdown_type='Countries') {
		
		$dropdown_type=__('Countries');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		$countries = $this->{$this->modelClass}->find('all');		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		
		$pageHeading	=	__('Country');
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		//$this->set('limitValue', $limitValue);
	  	//$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		
		$this->paginate = array(
		'conditions' => $parsedConditions,
		//'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$result= $this->paginate();
		$result= $countries;
		
		$this->set('result', $result);
	}

	function add($dropdown_type='Countries') {
		$dropdown_type=__('Countries');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add New').' '.$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		$pageHeading	=	__('Country');
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
			  $this->loadModel('District');
			$districts = $this->District->find('list',array('fields'=>array('id','name')));
			$this->set('districts',$districts);
			$user = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Countries');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			$pageHeading	=	__('Country');
			$this->set('pageHeading',$pageHeading);
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['name'], true));
			
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
	
	function delete() {
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null){
			 $dropdown_type=__('Districts');
				
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
		$header = array(__('Country Name'),__('ISO3166_1'),__('Origin'));
			$districtdata = $this->{$this->modelClass}->find('all');
			$data = array();
			foreach($districtdata as $key => $ddata){
				$data[$key]['name']			=	$ddata['Country']['name'];
				$data[$key]['iso3166_1']	=	$ddata['Country']['iso3166_1'];
				$data[$key]['origin']		=	$ddata['Country']['origin'];
				//$data[$key]['created']		=	date('m-d-Y',$ddata['Country']['created']);
			}
	
			$this->export_file($header,$data,'csv');
		exit;
		
	}
	
	public function generate_pdf(){
			
			$results	=	$this->{$this->modelClass}->find('all');
			$header = array(__('Country Name'),__('ISO3166_1'),__('Origin'));
			foreach($results as $key => $ddata){
				$data[$key]['name']			=	$ddata['Country']['name'];
				$data[$key]['iso3166_1']	=	$ddata['Country']['iso3166_1'];
				$data[$key]['origin']		=	$ddata['Country']['origin'];
				//$data[$key]['created']		=	date('m-d-Y',$ddata['Country']['created']);
			}
			$this->export_file($header,$data,'pdf');
			die;
	}
	
}
