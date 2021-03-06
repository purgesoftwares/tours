<?php
class SubCategoriesController extends CategoryAppController {
	
	
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'SubCategories';
	
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
			
	public function index($dropdown_type='Sub Categories') {
		
		$dropdown_type=__('Sub Categories');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		$language =  $this->Session->read('Config.language');
		$this->{$this->modelClass}->virtualFields = array('parent_category'=>"SELECT name_".$language." FROM categories WHERE id=SubCategory.parent_id");
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		$pageHeading = __('Sub Categories');
		$this->set('pageHeading',$pageHeading);
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		
		$parsedConditions['parent_id !='] = 0;
		$this->paginate = array(
		'conditions' => $parsedConditions,
		'limit' => '-1',
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$result= $this->paginate();

		$this->set('result', $result);
	}

	function add($dropdown_type='Sub Categories'){
	
		$dropdown_type=__('Sub Categories');
		
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add New').' '.$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		$pageHeading = __('Sub Categories');
		$this->set('pageHeading',$pageHeading);
		
		$language =  $this->Session->read('Config.language');
		 
		$categories 	=	$this->{$this->modelClass}->find('list',array('conditions'=>array('parent_id'=>0),'fields'=>array('id','name_'.$language)));
		//pr($categories);
		$this->set('categories',$categories);
		
			if (!empty($this->data)) {
			
				$this->{$this->modelClass}->set($this->data);
				if(1) {
				
				
				$data1 					=	array();
				$data 					= 	$this->data;
			
				$filename  				= 	$data{$this->modelClass}['image_name']['name'];
				$tempPath  				= 	$data{$this->modelClass}['image_name']['tmp_name'];
				$new_file_name 			=	time().'_'.$filename;
				
				if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH.$new_file_name)){
					}else{
						$new_file_name  	= 	'';
						
					}
					$data[$this->modelClass]['image_name']	= 	$new_file_name; 
					
					if(empty($data[$this->modelClass]['name_en'])){
						$data[$this->modelClass]['name_en']	=	$data[$this->modelClass]['name_pt'];
					}
					if(empty($data[$this->modelClass]['name_sp'])){
						$data[$this->modelClass]['name_sp']	=	$data[$this->modelClass]['name_pt'];
					}
					
					if(empty($data[$this->modelClass]['description_en'])){
						$data[$this->modelClass]['description_en']	=	$data[$this->modelClass]['description_pt'];
					}
					if(empty($data[$this->modelClass]['description_sp'])){
						$data[$this->modelClass]['description_sp']	=	$data[$this->modelClass]['description_pt'];
					}
					
					if(empty($data[$this->modelClass]['credit_en'])){
						$data[$this->modelClass]['credit_en']	=	$data[$this->modelClass]['credit_pt'];
					}
					if(empty($data[$this->modelClass]['credit_sp'])){
						$data[$this->modelClass]['credit_sp']	=	$data[$this->modelClass]['credit_pt'];
					}
					$data[$this->modelClass]['type']	=	1;
					//pr($data); die;
					$this->{$this->modelClass}->create();
					if($this->{$this->modelClass}->save($data, false))
					{
						$this->Session->setFlash(__($singularize .' has been added.'), 'success');
						$this->redirect(array('action' => 'index'));
					}else{	
						$this->Session->setFlash(__($singularize .' not be added.'), 'success');
					}
				}
			}
	}
	function edit($id = null) {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect(array('controller' => 'globalusers', 'action' => 'index'));
		  }
			
			$user = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Sub Categories');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['name_pt'], true));
			
			$this->{$this->modelClass}->id = $id; 
			$this->set('breadcrumb', $breadcrumb);
			
			$this->set('dropdown_type', $dropdown_type);
			$this->set('humanize', $humanize);
			$this->set('singularize', $singularize);
			$this->set('id', $id);
			
			$language =  $this->Session->read('Config.language');
		 
			$categories 	=	$this->{$this->modelClass}->find('list',array('conditions'=>array('parent_id'=>0),'fields'=>array('id','name_'.$language)));
			
			$this->set('categories',$categories);
			
			$pageHeading = __('Sub Categories');
			$this->set('pageHeading',$pageHeading);
		
				$parentdata = 	$this->{$this->modelClass}->read();
				$this->set("image_title",$parentdata{$this->modelClass}['name_pt']);
				$this->set("image_name",$parentdata{$this->modelClass}['image_name']);
				// pr($parentdata); die;
				
			$same_data = $this->{$this->modelClass}->read(null, $id);
			
			if (empty($this->data)) {
				$this->data = $same_data;
				
			 } else {
				$this->{$this->modelClass}->set($this->data);
				if(1) {	

					$data			=	$this ->data;			
					if(isset($data{$this->modelClass}['image_name']) && $data{$this->modelClass}['image_name']['name'] != ''){
						$filename  				= 	$data{$this->modelClass}['image_name']['name'];
						$tempPath  				= 	$data{$this->modelClass}['image_name']['tmp_name'];
						$new_file_name 			=	time().'_'.$filename;
						
						if(move_uploaded_file($tempPath,ALBUM_UPLOAD_IMAGE_PATH.$new_file_name))
							{}else{
								$new_file_name  	= 	'';
							}
							$data[$this->modelClass]['image_name']	= 	$new_file_name; 
					}else{
						$data{$this->modelClass}['image_name']		= 	$parentdata{$this->modelClass}['image_name'];
					}
					
					
					if(empty($data[$this->modelClass]['name_en'])){
						$data[$this->modelClass]['name_en']	=	$data[$this->modelClass]['name_pt'];
					}
					if(empty($data[$this->modelClass]['name_sp'])){
						$data[$this->modelClass]['name_sp']	=	$data[$this->modelClass]['name_pt'];
					}
					
					if(empty($data[$this->modelClass]['description_en'])){
						$data[$this->modelClass]['description_en']	=	$data[$this->modelClass]['description_pt'];
					}
					if(empty($data[$this->modelClass]['description_sp'])){
						$data[$this->modelClass]['description_sp']	=	$data[$this->modelClass]['description_pt'];
					}
					
					if(empty($data[$this->modelClass]['credit_en'])){
						$data[$this->modelClass]['credit_en']	=	$data[$this->modelClass]['credit_pt'];
					}
					if(empty($data[$this->modelClass]['credit_sp'])){
						$data[$this->modelClass]['credit_sp']	=	$data[$this->modelClass]['credit_pt'];
					}
					$data[$this->modelClass]['type']	=	1;
					$data[$this->modelClass]['modified']	=	time();
					//pr($data); die;
					$this->{$this->modelClass}->id	=	$id; 
					if($this->{$this->modelClass}->save($data, false))
					{
						$this->Session->setFlash(__('Sub Categories has been edited'),'success');
					}else{	
						$this->Session->setFlash(__('Sub Categories not be edited.'),'error');
					}
				
				$this->redirect(array('action'=>'index'));
					
				}
			}
	}
	
	
	function details($parent_id=0){		
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/');
		$pages[__('Sub Categories', true)] = array('plugin' => 'category', 'controller' => 'sub_categories', 'action' => 'index','admin'=>true);
		$breadcrumb 		= 	array('pages' => $pages, 'active' => 'Sub Category Deatils');
		$this->{$this->modelClass}->virtualFields  = array(
				'parent_name_en'=> "SELECT name_en  FROM categories WHERE id=".$this->modelClass.".parent_id",
				'parent_name_pt'=> "SELECT name_pt  FROM categories WHERE id=".$this->modelClass.".parent_id"
			); 
		$parentdata 		= 	$this->{$this->modelClass}->read(null, $parent_id);
		
		$this->set('breadcrumb', $breadcrumb);
		$language =  $this->Session->read('Config.language');
		$condition					=	array('parent_id'=>$parent_id);

		$categories 				= 	$this->{$this->modelClass}->generateTreeList($condition, null, null, ''); 

		$condition_array			=	array_flip($categories);
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		} else {
			$this->Prg->commonProcess();
		}
		
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');	
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		
		$pageHeading = 'Category Details';
		
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$this->paginate = array(
        'conditions' => array($this->modelClass.'.id'=>$condition_array,$parsedConditions ),
       // 'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$this->{$this->modelClass}->recursive = 0;
		$this->set('pageHeading', Inflector::singularize($pageHeading));
		$this->set('back', $pageHeading);
		$this->set('category_result', $parentdata);
		$this->set('subcategory_result', $this->paginate());
		$this->set("parent_id",$parent_id);
		//pr($parentdata);
		$this->set("id",$parent_id);
		$this->set("image_title",$parentdata{$this->modelClass}['name_'.$language]);
		$this->set("image_name",$parentdata{$this->modelClass}['image_name']);
		
		$categories								=	$this->{$this->modelClass}->find('list', array('fields' => array('name_'.$language))); // to get list for dropdowns

		$this->set("categories",$categories);		
	}
	
 function delete() {
	if($this->request->is('Ajax')){
		if($this->data['id']==null){
			echo 'error';
		}else{	
				$this->{$this->modelClass}->id = $this->data['id'];
				if($this->SubCategory->deleteAll(array('or'=>array('id'=>$this->data['id'],'parent_id'=>$this->data['id'])))==true){
					echo 'Success';
				}else{
					echo 'error';
				}
			}
		}	
	 exit;
	}
	
	
}
	