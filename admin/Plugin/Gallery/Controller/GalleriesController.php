<?php
class GalleriesController  extends GalleryAppController  {
	
	
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Galleries';
	
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
		array('field' => 'gallery_title', 'type' => 'value')
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
		
		
		$dropdown_type=__('Galleries');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		
		
		if(!$client_id){
			$this->Session->setFlash(__('Please select a client for galleries'), 'success');
			$this->redirect(array('plugin'=>'usermgmt','controller'=>'clients','action' => 'index'));
		}
		$this->loadModel('Usermgmt.Client');
		$this->loadModel('GalleryImage');
		$this->Gallery->hasMany = array('GalleryImage'=>array('className'=>"GalleryImage",'foreignKey'=>'gallery_id'));
		$client = $this->Client->findById($client_id);
		$this->set('client_id',$client_id);
		
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($client['Client']['first_name'].(!empty($client['Client']['last_name'])?' '.$client['Client']['last_name']:'')."'s Galleries", true));		
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
		
		$pageHeading	=	$client['Client']['first_name'].(!empty($client['Client']['last_name'])?' '.$client['Client']['last_name']:'')."'s Galleries";
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
	
	
	
	
	public function list_view($client_id=0) {
		
		
		$dropdown_type=__('Galleries');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		
		
		if(!$client_id){
			$this->Session->setFlash(__('Please select a client for galleries'), 'success');
			$this->redirect(array('plugin'=>'usermgmt','controller'=>'clients','action' => 'index'));
		}
		$this->loadModel('Usermgmt.Client');
		$this->loadModel('GalleryImage');
		$this->Gallery->hasMany = array('GalleryImage'=>array('className'=>"GalleryImage",'foreignKey'=>'gallery_id'));
		$client = $this->Client->findById($client_id);
		$this->set('client_id',$client_id);
		
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($client['Client']['first_name'].(!empty($client['Client']['last_name'])?' '.$client['Client']['last_name']:'')."'s Galleries", true));		
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
		
		$pageHeading	=	$client['Client']['first_name'].(!empty($client['Client']['last_name'])?' '.$client['Client']['last_name']:'')."'s Galleries";
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
	
	
	function save_images_order(){
	
		 if($this->request->is('Ajax')){
			 if($this->data['id'] != null){
				$this->loadModel('GalleryImage');
				$this->GalleryImage->id = $this->data['id'];
				if($this->GalleryImage->save(array('sort'=>$this->data['index']))){
					
					if($this->data['oldIndex'] > $this->data['index']){
						$ef_images = $this->GalleryImage->find('all',array('conditions'=>array('sort <='=>$this->data['oldIndex'],'sort >='=>$this->data['oldIndex'])));
						if(!empty($ef_images)){
							foreach($ef_images as $ef_image){
								$this->GalleryImage->id = $ef_image['GalleryImage']['id'];
								$ef_image['GalleryImage']['sort'] = $ef_image['GalleryImage']['sort'] + 1;
								$this->GalleryImage->save($ef_image, array('validate'=>false));
							}
						}
						
					}else{
						$ef_images = $this->GalleryImage->find('all',array('conditions'=>array('sort >='=>$this->data['oldIndex'],'sort <='=>$this->data['oldIndex'])));
						if(!empty($ef_images)){
							foreach($ef_images as $ef_image){
								$this->GalleryImage->id = $ef_image['GalleryImage']['id'];
								$ef_image['GalleryImage']['sort'] = $ef_image['GalleryImage']['sort'] - 1;
								$this->GalleryImage->save($ef_image, array('validate'=>false));
							}
						}
					}
					echo 'success';
				}else{
					echo 'error';
				}
			}
		} exit;
		
	}
	
	function upload_progress($id){
		$this->layout  = false;
			$this->autoRender  = false;
		 if($this->request->is('Ajax')){
			pr($_SESSION); die;
		 }
	}
	function save_images_gallery_order(){
	
		 if($this->request->is('Ajax')){
			 if($this->data['orderString'] != null){
				// pr($this->data['orderString']); die;
				$orders = explode(',',$this->data['orderString']);
				$order = 1;
				$this->loadModel('GalleryImage');
				if(!empty($orders)){
					foreach($orders as $id){
						$this->GalleryImage->updateAll(array('sort'=>$order++),array('GalleryImage.id'=>$id));
					}
				}
					echo 'success';
				}else{
					echo 'error';
				}
			
		} exit;
		
	}
	function upload_images() {
		
			// pr($_FILES); die;
			
			// pr($this->data); die;
			$this->layout  = false;
			$this->autoRender  = false;
			if (!empty($_FILES)) {
			$flag = false;
			$this->loadModel('GalleryImage');
			
			$pre_images = $this->GalleryImage->find('all',array('conditions'=>array('gallery_id'=>$this->data['gallery_id']),'order'=>'sort desc','limit'=>1));
			if(!empty($pre_images) && isset($pre_images[0]['GalleryImage']['sort'])){
				$psort = $pre_images[0]['GalleryImage']['sort'];
			}else{
				$psort = 0;
			}
			
			$galery = $this->{$this->modelClass}->findById($this->data['gallery_id']);
			foreach($_FILES['images']['name'] as $key=>$image){
				
				App::import('Component', 'Image');
				$data = array();
				$file		=	$image;
				// $filename	=	md5(time());
				$filename	=	'';
				$ext 		=	strtolower(substr($file,strrpos($file,".") + 1));
				 if(!in_array($ext,array('jpeg','jpg','JPEG','JPG'))){
					$responce = 'Upload Only .jpg images';
					return $responce;
				} 
				$newImage	=	$filename.$file/*. '.'.$ext */ ;
				$folder		=	$this->createFolder(USER_IMAGE_STORE_PATH, 'gallery_'.$this->data['gallery_id']);
				$folder_low		=	$this->createFolder(USER_IMAGE_STORE_PATH.'gallery_'.$this->data['gallery_id'].DS,'low');
				$directory	=	$folder['path'].DS.$newImage;
				// upload image
					
				move_uploaded_file($_FILES['images']['tmp_name'][$key], $directory);
				/* save low resulation */
										
                                        $MyImageCom = new ImageComponent();  
										$MyImageCom->prepare($directory);
										list($width, $height) = getimagesize($directory);
										$info = pathinfo($directory);
										
										if($width>700){
											$height = $height * (700/$width);
											$width = 700;
										}
										if($height>700){
											$width = $width * (700/$height);
											$height = 700;
										}
										// pr($width);
										// pr($height);
										// pr($info); die;
                                        $MyImageCom->resize($width,$height);//width,height,Red,Green,Blue
                                        $MyImageCom->save($folder['path'].DS."low".DS.$newImage);
										
				$data['image']		=	$newImage;	
				$data['image_folder']=	$folder['folder'];
				$data['gallery_id']=	$this->data['gallery_id'];						
				$data['sort']=	$psort++;						
				// save user data
				// pr($data); 
				$this->GalleryImage->create();
				if ($this->GalleryImage->save($data, array('validate'=>false))){
					$flag = true;
				}else{
					$flag = false;
				}
				
			}
			if($flag){
				$responce = 'Images successfully Uploaded';
				}else{
				$responce = "error";
				}
				
				$this->{$this->modelClass}->id = $this->data['gallery_id'];
				$this->{$this->modelClass}->save(array('status'=>2),array('validate'=>false));
				
			}
			
			return $responce;
	}
	
	
	function upload_images1() {
		
			// pr($_FILES); die;
			
			// pr($this->data); die;
			$this->layout  = false;
			$this->autoRender  = false;
			if (!empty($_FILES)) {
			$flag = false;
			$this->loadModel('GalleryImage');
			
			$pre_images = $this->GalleryImage->find('all',array('conditions'=>array('gallery_id'=>$this->data['gallery_id']),'order'=>'sort desc','limit'=>1));
			if(!empty($pre_images) && isset($pre_images[0]['GalleryImage']['sort'])){
				$psort = $pre_images[0]['GalleryImage']['sort'];
			}else{
				$psort = 0;
			}
			
			$galery = $this->{$this->modelClass}->findById($this->data['gallery_id']);
			foreach($_FILES['images']['name'] as $key=>$image){
				
				App::import('Component', 'Image');
				$data = array();
				$file		=	$image;
				// $filename	=	md5(time());
				$filename	=	'';
				$ext 		=	strtolower(substr($file,strrpos($file,".") + 1));
				 if(!in_array($ext,array('jpeg','jpg','JPEG','JPG'))){
					$this->Session->setFlash(__('Upload Only .jpg images'), 'error');
					$this->redirect(array('action'=>'index',$galery[$this->modelClass]['client_id']));
				} 
				$newImage	=	$filename.$file/*. '.'.$ext */ ;
				$folder		=	$this->createFolder(USER_IMAGE_STORE_PATH, 'gallery_'.$this->data['gallery_id']);
				$folder_low		=	$this->createFolder(USER_IMAGE_STORE_PATH.'gallery_'.$this->data['gallery_id'].DS,'low');
				$directory	=	$folder['path'].DS.$newImage;
				// upload image
					
				move_uploaded_file($_FILES['images']['tmp_name'][$key], $directory);
				/* save low resulation */
										
                                        $MyImageCom = new ImageComponent();  
										$MyImageCom->prepare($directory);
										list($width, $height) = getimagesize($directory);
										$info = pathinfo($directory);
										
										if($width>700){
											$height = $height * (700/$width);
											$width = 700;
										}
										if($height>700){
											$width = $width * (700/$height);
											$height = 700;
										}
										// pr($width);
										// pr($height);
										// pr($info); die;
                                        $MyImageCom->resize($width,$height);//width,height,Red,Green,Blue
                                        $MyImageCom->save($folder['path'].DS."low".DS.$newImage);
										
				$data['image']		=	$newImage;	
				$data['image_folder']=	$folder['folder'];
				$data['gallery_id']=	$this->data['gallery_id'];						
				$data['sort']=	$psort++;						
				// save user data
				// pr($data); 
				$this->GalleryImage->create();
				if ($this->GalleryImage->save($data, array('validate'=>false))){
					$flag = true;
				}else{
					$flag = false;
				}
				
			}
			if($flag){
				$this->Session->setFlash(__('Images successfully Uploaded'), 'success');
				}else{
				$this->Session->setFlash(__('Images not uploaded'), 'success');
				}
				
				$this->{$this->modelClass}->id = $this->data['gallery_id'];
				$this->{$this->modelClass}->save(array('status'=>2),array('validate'=>false));
				$this->redirect(array('action'=>'index',$galery[$this->modelClass]['client_id']));
			
			
			}
	}
	
	function download_image($id, $original = 1){
			
			$this->loadModel('GalleryImage');
			$image = $this->GalleryImage->findById($id);
			if($original){
						$file =  USER_IMAGE_STORE_PATH.$image['GalleryImage']['image_folder'].DS.$image['GalleryImage']['image'];
					}else{
						$file =  USER_IMAGE_STORE_PATH.$image['GalleryImage']['image_folder'].DS.'low'.DS.$image['GalleryImage']['image'];
						
						// $file =  Router::url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',1000,1000,base64_encode(USER_IMAGE_STORE_PATH.$image['GalleryImage']['image_folder'].DS),$image['GalleryImage']['image']),true);
					}
					
		// Define the name of image after downloaded  
			header('Content-Disposition: attachment; filename="'.$image['GalleryImage']['image'].'"');  

			// Read the original image file  
			readfile($file);  
	}
	
	function download_gallery_images($id, $original = 1){
			
			$this->loadModel('GalleryImage');
			$images = $this->GalleryImage->findAllByGalleryId($id);
			$gallery = $this->Gallery->findById($id);
			// pr($images); die;
			$files = array();
			if(!empty($images)){
				foreach($images as $image){
					if($original){
						$files[] =  USER_IMAGE_STORE_PATH.$image['GalleryImage']['image_folder'].DS.$image['GalleryImage']['image'];
					}else{
						// $files[] =  Router::url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',1000,1000,base64_encode(USER_IMAGE_STORE_PATH.$image['GalleryImage']['image_folder'].DS),$image['GalleryImage']['image']),true);
						$files[] =  USER_IMAGE_STORE_PATH.$image['GalleryImage']['image_folder'].DS.'low'.DS.$image['GalleryImage']['image'];
					}
				}
			}
			// pr($files); die;
				# create new zip opbject
				$zip = new ZipArchive();

				# create a temp file & open it
				$tmp_file = tempnam('.','');
				$zip->open($tmp_file, ZipArchive::CREATE);

				# loop through each file
				foreach($files as $file){

					// $zip->addFile($file);
					# download file
					$download_file = file_get_contents($file);

					// #add it to the zip
					$zip->addFromString(basename($file),$download_file);

				}

				# close zip
				$zip->close();

				# send the file to the browser as a download
				header('Content-type: application/zip');
				header('Content-disposition: attachment; filename='.(str_replace(' ','-',$gallery['Gallery']['gallery_title'])).'.zip');
				header('Content-Length: ' . filesize($tmp_file));
				readfile($tmp_file);
				
				/* header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
readfile($zipname); */
	}
	
	function download_gallery_image($id, $original = 1){
			
			$this->loadModel('GalleryImage');
			$image = $this->GalleryImage->findById($id);
			// $gallery = $this->Gallery->findById($image['GalleryImage']['gallery_id']);
			// pr($images); die;
			$files = array();
			if(!empty($image)){
				
					if($original){
						$files[] =  USER_IMAGE_STORE_PATH.$image['GalleryImage']['image_folder'].DS.$image['GalleryImage']['image'];
					}else{
						$files[] =  Router::url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',1000,1000,base64_encode(USER_IMAGE_STORE_PATH.$image['GalleryImage']['image_folder'].DS),$image['GalleryImage']['image']),true);
					}
				
			}
			// pr($files); die;
				# create new zip opbject
				$zip = new ZipArchive();

				# create a temp file & open it
				$tmp_file = tempnam('.','');
				$zip->open($tmp_file, ZipArchive::CREATE);

				# loop through each file
				foreach($files as $file){

					// $zip->addFile($file);
					# download file
					$download_file = file_get_contents($file);

					// #add it to the zip
					$zip->addFromString(basename($file),$download_file);

				}

				# close zip
				$zip->close();

				# send the file to the browser as a download
				header('Content-type: application/zip');
				header('Content-disposition: attachment; filename='.(str_replace(' ','-',(isset($image['GalleryImage']['image'])?$image['GalleryImage']['image']:time()))).'.zip');
				header('Content-Length: ' . filesize($tmp_file));
				readfile($tmp_file);
				
	}
	
	
	function save_virtual_tour(){
			
			// pr($this->data);
			// die;
			$this->layout = false;
			$this->autoRender = false;
			if(!empty($this->data)){
				$this->Gallery->id = $this->data['Gallery']['id'];
				if($this->Gallery->save($this->data,array('validate'=>false))){
					$responce = array('success'=>true,'message'=>'Created Successfully');
				}else{
					$responce = array('success'=>false,'message'=>'Not saved, Error in save');
				}
			}else{
				$responce = array('success'=>false,'message'=>'Data Not Provided');
			}
			return json_encode($responce); 
			die;
	}
	
	
	function view_gallery($id = null,$image_order = 'asc') {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
			$this->set('image_order',$image_order);
		  if($image_order=="manual"){ $sort_order = "sort asc"; }else{ $sort_order = 'image '.$image_order; } 
		  // echo $sort_order;
			$this->{$this->modelClass}->hasMany = array("Images"=>array('className'=>'GalleryImages','foreignKey'=>'gallery_id','order'=>$sort_order));
			$gallery = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Galleries');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$gallery[$this->modelClass]['client_id']);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($gallery[$this->modelClass]['gallery_title'], true));
			$pageHeading	=	$gallery[$this->modelClass]['gallery_title'];
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
						$this->redirect(array('action' => 'index',$gallery[$this->modelClass]['client_id']));
					}
				}
			}
			// pr($this->data); die;
	}
	
	
	function view_gallery_list($id = null,$image_order = 'asc') {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
			$this->set('image_order',$image_order);
		  if($image_order=="manual"){ $sort_order = "sort asc"; }else{ $sort_order = 'image '.$image_order; } 
		  // echo $sort_order;
			$this->{$this->modelClass}->hasMany = array("Images"=>array('className'=>'GalleryImages','foreignKey'=>'gallery_id','order'=>$sort_order));
			$gallery = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Galleries');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$gallery[$this->modelClass]['client_id']);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($gallery[$this->modelClass]['gallery_title'], true));
			$pageHeading	=	$gallery[$this->modelClass]['gallery_title'];
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
						$this->redirect(array('action' => 'index',$gallery[$this->modelClass]['client_id']));
					}
				}
			}
	}
	
	

	function add($client_id=0) {
		
		if(!$client_id){
			$this->Session->setFlash(__('Invalid Access'), 'error');
			$this->redirect('/');
		}
		
		if($client_id){
		$this->loadModel('Usermgmt.Client');
		$this->loadModel('Contact');
		$client = $this->Client->find('first',array('conditions'=>array('Client.id'=>$client_id)));
		// pr($client);
		$contact_list	=	$this->Contact->find('list',array('conditions'=>array('client_id'=>$client_id),'fields'=>array('id','first_name')));
		// pr($contact_list);
		$contact_list[$client_id] = $client['Client']['first_name'];
		// $contact_list  = array_merge($contact_list,array($client_id,$client[$this->modelClass]['first_name']));
		$this->set('contact_list',$contact_list);
		
		}
		
		
		$dropdown_type=__('Galleries');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$client_id);
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add New').' '.$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('client_id', $client_id);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		$pageHeading	=	__('Add Gallery');
		$this->set('pageHeading',$pageHeading);
			if (!empty($this->data)) {
					$data = $this->data;
					$data['Gallery']['client_id'] 	= 	$data[$this->modelClass]['client_id'];
					$data['Gallery']['hour'] 	= 	$data['Gallery']['time']['hour'];
					$data['Gallery']['min'] 	= 	$data['Gallery']['time']['min'];
					$data['Gallery']['meridian'] 	= 	$data['Gallery']['time']['meridian'];
					unset($data['Gallery']['time']);
					
				$this->{$this->modelClass}->set($data);
				if($this->{$this->modelClass}->validates()) {
					// pr($data); die;
					if ($this->{$this->modelClass}->save($data)) {
						$this->Session->setFlash(__($singularize .' has been added.'), 'success');
						$this->redirect(array('action' => 'index',$client_id));
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
			$dropdown_type=__('Galleries');
			
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
	 $dropdown_type=__('Galleries');
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
			 $dropdown_type=__('Galleries');
				
				if($this->{$this->modelClass}->delete($this->data['id'])){
					
					echo 'success';
				}else{
					echo 'error';
				}
			}
		} exit;
	}
	
	function delete_image() {
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null){
				$this->loadModel("GalleryImage");
				$image = $this->GalleryImage->findById($this->data['id']);
				if(!empty($image)){
					unlink(USER_IMAGE_STORE_PATH.$image["GalleryImage"]['image_folder'].DS.$image["GalleryImage"]['image']);
					
				}
				if($this->GalleryImage->delete($this->data['id'])){
					
					echo 'success';
				}else{
					echo 'error';
				}
			}
		} exit;
	}
	
	function release_now($id) {
		
		 if($id != null){
		 $this->{$this->modelClass}->belongsTo = array(
													"Client"=>array("className"=>"Usermgmt.Client","foreignKey"=>"client_id")
													);
			$this->{$this->modelClass}->hasOne = array(
												"Invoice"=>array("className"=>"Invoice.Invoice","foreignKey"=>"shoot_id"),
												"Shoot"=>array("className"=>"Shoot.Shoot","foreignKey"=>"gallery_id")
												);
		 $gallery = $this->{$this->modelClass}->findById($id);
		 // pr($gallery); die;
				$this->{$this->modelClass}->id = $id;
				if($this->{$this->modelClass}->save(array('status'=>3),array('validate'=>false))){
				
				
					/* Send shoot gallery release email */
							
							
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
								
							$reg_succ_id	=	Configure::read('global_ids.email_template.release_email');
							
							$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

							$action 		= $email_template['EmailTemplate']['action'];
							
							$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
							
							$cons = explode(',',$action['EmailAction']['options']);
							$constants = array();
							foreach($cons as $key=>$val){
								$constants[] = '{'.$val.'}';
							}
							//SHOOT_TITLE,SHOOT_TIME,FIRST_NAME,LAST_NAME,RELEASE_DATE
							$shoot_title   	=   $gallery["Shoot"]['title'];
							$shoot_time   	=   $gallery["Shoot"]['date']." ".$gallery["Shoot"]['hour'].":".$gallery["Shoot"]['min'].$gallery["Shoot"]['meridian'];
							
							$first_name 	=	$gallery["Client"]['first_name']; 
							$last_name 		=	$gallery["Client"]['last_name']; 
							$release_date	=	isset($gallery["Gallery"]['date'])?$gallery["Gallery"]['date']:$gallery["Shoot"]['date']; 
							$payment		=	$gallery["Invoice"]['payment']-$gallery["Invoice"]['discount_amount']-$gallery["Invoice"]['paid']; 
							$email   		=   $gallery["Client"]["email"];
							
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
					
					$this->Session->setFlash(__('Released Successfully'), 'success');
				}else{
					$this->Session->setFlash(__('Not Released'), 'success');
				}
			}else{
					$this->Session->setFlash(__('Id not supplied'), 'success');
				}
		$this->redirect(array('action'=>'index',$gallery[$this->modelClass]['client_id']));
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
