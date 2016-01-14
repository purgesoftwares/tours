<?php
class CategoriesController extends MasterAppController {
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Categories';	
/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time','Fck', 'Text');
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
		array('field' => 'details', 'type' => 'value'),
		array('field' => 'active', 'type' => 'value')
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
			
	public function index($dropdown_type='services') {
		
		
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);	
		$this->set('pageHeading', $humanize);		
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
		$parsedConditions['dropdown_type'] = $dropdown_type;		
		$this->paginate = array(
								'conditions' => $parsedConditions,
								'limit' => $limit,
								'order'=>	array($this->modelClass . '.created' => 'desc')	
								);		
		$result= $this->paginate();
		$this->set('result', $result);
	}
	
	/*  function for add services  */
	function add($dropdown_type='services') {
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add New ').$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		$this->set('pageHeading', $humanize);
		
		
			if (!empty($this->data)) {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {
					if ($this->{$this->modelClass}->save($this->data)) {
						$this->Session->setFlash($singularize . __(' has been added.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
			}
		}
	
	public function addandget(){
		
		$this->layout = false;
		$this->autoRender = false;
		$response =	array('status'=>false,'message'=>'Failed! Please try again.','data'=>'');
		
		if (!empty($this->data)) {
				$data  =  $this->data;
				$data['dropdown_type']  =  'client_types';
		
				$this->{$this->modelClass}->set($data);
				if($this->{$this->modelClass}->validates()) {
					if ($this->{$this->modelClass}->save($data)) {
						
						$response =	array('status'=>true,'message'=>'New Client was Successfully added','client_types'=>$this->getDropDown(array('client_types')));
					}
				}
			}
		return json_encode($response);
	}
	/*  function for edit services  */
	function edit($dropdown_type='services',$id = null) {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash('Invalid Access.', 'error');
			 $this->redirect(array('controller' => 'globalusers', 'action' => 'index'));
		  }
			$user = $this->{$this->modelClass}->findById($id);
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			$this->set('pageHeading', $humanize);
			
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
						$this->Session->setFlash($singularize .__(' has been updated.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
			}
	}
	
	/*  function for delete services */
	function delete($dropdown_type='services',$id=null) {
		if($id==null){
			die("No ID received");
		}else{	
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			$this->{$this->modelClass}->delete($id);
			$this->Session->setFlash($singularize.__(' has been deleted.'),'success');
			$this->redirect(array('action'=>'index',$dropdown_type));
		}
	}
	/*  function for get categories  */
	public function get_categories($filed1='id',$dropdown_type='services') {
		$list	=	$this->{$this->modelClass}->find('list',array('fields'=>array($filed1,'name'),'conditions'=>array('dropdown_type'=>$dropdown_type),'order'=>'name'));
		return $list;
		
	}
}