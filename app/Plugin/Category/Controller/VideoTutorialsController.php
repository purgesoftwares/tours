<?php
class VideoTutorialsController  extends FaqAppController  {
	
	
/**VideoTutorialsController.php
 * Controller name
 *
 * @var string
 */
	public $name = 'VideoTutorials';
	
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
		array('field' => 'title', 'type' => 'value')
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
			
	public function index($dropdown_type='Video Tutorials') {
		
		
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
		
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		// $parsedConditions['faq_type'] = $dropdown_type;
		
		$this->paginate = array(
		'conditions' => $parsedConditions,
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$result= $this->paginate();
		$this->set('result', $result);		

	}

	function add($dropdown_type='Video Tutorials') {
	
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		$breadcrumb = array('pages' => $pages, 'active' => __('Add New').$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
			if (!empty($this->data)) {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {				
					$file		=	$this->data[$this->modelClass]['video']['name'];
					$filename	=	md5(time());
					$ext 		=	strtolower(substr($file,strrpos($file,".") + 1));
					$newVideo	=	$filename.'.'.$ext ;
					
					$directory	=	Configure::read('video_tutorials.original.rootpath').$newVideo;
					
					$data 		= 	$this->data ;
					
					if(move_uploaded_file($this->data[$this->modelClass]['video']['tmp_name'], $directory)){
						
						$imgName	= $file;
						$imgName	= str_replace(array(' ','-'), '_', $imgName);
						$uservideo	= time() .'_' . $imgName;
						
						$video_image		=	$filename.".jpg";
						$video_mp4_type		=	$filename.".mp4";
						
						exec("ffmpeg -i ".Configure::read('video_tutorials.original.rootpath') . $newVideo." -ss 0.15 -vframes 1 -vcodec mjpeg -f image2 ".Configure::read('video_tutorials.video_images.rootpath').$video_image);
						
						exec("ffmpeg -i ".Configure::read('video_tutorials.original.rootpath') . $newVideo." -sameq -s 580x396 -vcodec libx264 -vpre medium ".Configure::read('video_tutorials.mp4.rootpath') . $video_mp4_type."");
						
						
						$data[$this->modelClass]['video']		= $newVideo;
						$data[$this->modelClass]['video_mp4_type'] 	= $filename;
						$data[$this->modelClass]['video_image'] 	= $filename;
						
					}
				
					$data[$this->modelClass]['status'] 		= 1;
				
					if ($this->{$this->modelClass}->save($data)) {
						$this->Session->setFlash(__($singularize . ' has been added.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
			}
	}
	
	function edit($id = null) {
		if(!isset($id) || $id == '' ) {
		 $this->Session->setFlash(__('Invalid Access.'), 'error');
		 $this->redirect(array('controller' => 'globalusers', 'action' => 'index'));
		}
		$dropdown_type = __('Video Tutorials');
		$user = $this->{$this->modelClass}->findById($id);
		
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['title'], true));
			
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
			
			if(isset($this->data[$this->modelClass]['old_video']) && $this->data[$this->modelClass]['old_video']!='' && $this->data[$this->modelClass]['video']['name']=='') {
						
				unset($this->{$this->modelClass}->validate['video']);
				unset($data[$this->modelClass]['video']);
				
				$this->data = $data ;
				
				$this->{$this->modelClass}->set($this->data);
			
				if($this->{$this->modelClass}->validates()) {
				
					$data 		= 	$this->data ;
					
					if ($this->{$this->modelClass}->save($data)) {
						$this->Session->setFlash(__($singularize .'  has been updated.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
				
			} else {
				
				$this->data = $data ;
			
				$this->{$this->modelClass}->set($this->data);
				
				if($this->{$this->modelClass}->validates()) {
				
					
					
							
					$file		=	$this->data[$this->modelClass]['video']['name'];
					$filename	=	md5(time());
					$ext 		=	strtolower(substr($file,strrpos($file,".") + 1));
					$newVideo	=	$filename.'.'.$ext ;
					
					$directory	=	Configure::read('video_tutorials.original.rootpath').$newVideo;
					
					$data 		= 	$this->data ;
						
					if(move_uploaded_file($this->data[$this->modelClass]['video']['tmp_name'], $directory)){
						
						
						$video_image	= $filename.".jpg";
						$video_mp4_type = $filename.".mp4";
					
						exec("ffmpeg -i ".Configure::read('video_tutorials.original.rootpath') . $newVideo." -ss 0.15 -vframes 1 -vcodec mjpeg -f image2 ".Configure::read('video_tutorials.video_images.rootpath').$video_image);
								
						exec("ffmpeg -i ".Configure::read('video_tutorials.original.rootpath') . $newVideo." -sameq -s 580x396 -vcodec libx264 -vpre medium ".Configure::read('video_tutorials.mp4.rootpath') . $video_mp4_type."");
						
						$data[$this->modelClass]['video']		= $newVideo;
						$data[$this->modelClass]['video_mp4_type'] 	= $filename;
						$data[$this->modelClass]['video_image'] 	= $filename;
						
								
						if(isset($data['VideoTutorial']['old_video']) && file_exists(Configure::read('video_tutorials.original.rootpath').$data[$this->modelClass]['old_video']) ) {
						
							unlink(Configure::read('video_tutorials.original.rootpath').$data[$this->modelClass]['old_video']);
						}
						
						// echo '<pre>';print_r($this->data);die;
							
						$old_video_filename		= substr($data['VideoTutorial']['old_video'],0,strrpos($data['VideoTutorial']['old_video'],"."));
						
						if(file_exists(Configure::read('video_tutorials.video_images.rootpath').$old_video_filename.'.jpg') ){
							unlink(Configure::read('video_tutorials.video_images.rootpath').$old_video_filename.'.jpg');
						}
						
						if(file_exists(Configure::read('video_tutorials.mp4.rootpath').$old_video_filename.'.mp4') ) {
							unlink(Configure::read('video_tutorials.mp4.rootpath').$old_video_filename.'.mp4');
						}
					}
						
					if ($this->{$this->modelClass}->save($data)) {
						$this->Session->setFlash(__($singularize .'  has been updated.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
			}
		}
	}
	
	function delete($id=null) {
		if($id==null){
			die(__("No ID received"));
		}else{			
			$video_tute_data	= $this->{$this->modelClass}->find('first',array('fields'=>array('video','video_image'),'conditions'=>array('id'=>$id)));
			
			$this->{$this->modelClass}->delete($id);
			
			if(isset($video_tute_data[$this->modelClass]['video']) && file_exists(Configure::read('video_tutorials.original.rootpath').$video_tute_data[$this->modelClass]['video']) ) {
				
				unlink(Configure::read('video_tutorials.original.rootpath').$video_tute_data[$this->modelClass]['video']);
				
			}
			
			if(isset($video_tute_data[$this->modelClass]['video_image']) && file_exists(Configure::read('video_tutorials.video_images.rootpath').$video_tute_data[$this->modelClass]['video_image'].'.jpg') ) {
				
				unlink(Configure::read('video_tutorials.video_images.rootpath').$video_tute_data[$this->modelClass]['video_image'].'.jpg');
				
			}
			
			if(isset($video_tute_data[$this->modelClass]['video_image']) && file_exists(Configure::read('video_tutorials.mp4.rootpath').$video_tute_data[$this->modelClass]['video_image'].'.mp4') ) {
				
				unlink(Configure::read('video_tutorials.mp4.rootpath').$video_tute_data[$this->modelClass]['video_image'].'.mp4');
				
			}
			
			
			$this->Session->setFlash(__('Video Tutorial has been deleted.'),'success');
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function ChangeStatus($status='',$id=null) {
		if($id==null){
			die("No ID received");
		}else{
			 
			$video_tute_data = array();
			$video_tute_data[$this->modelClass]['id'] = $id;
			if($status == 1) {
				$video_tute_data[$this->modelClass]['status'] = 0;
				$state = 'inactive';
			} 
			elseif($status == 0) {
				$video_tute_data[$this->modelClass]['status'] = 1;
				$state = 'active';
			}
			if ($this->{$this->modelClass}->Save($video_tute_data,false)) {
				$this->Session->setFlash(__('Status  has been updated.'), 'success');
				
				$this->redirect(array('action' => 'index'));
			}
			exit;
		}
	}
	
	
	function set_default($id = null) {
		if(!isset($id) || $id == '' ) {
			$this->Session->setFlash(__('Invalid Access.'), 'error');
			$this->redirect(array('controller' => 'globalusers', 'action' => 'index'));
		}
		
		$this->VideoTutorial->updateAll(
			array('VideoTutorial.set_default' => 0)
		);
			
		$data 	=  array();
		
		$data[$this->modelClass]['id'] = $id;
		
		$data[$this->modelClass]['set_default'] = 1;
		
		if ($this->{$this->modelClass}->save($data,false)) {
			
			$this->Session->setFlash(__($data[$this->modelClass]['title'].' has been set as default video tutorial.'), 'success');
			$this->redirect(array('action' => 'index'));
		}
		exit;
	}
	
	
}
