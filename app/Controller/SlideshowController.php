<?php
/**
 * Static content controller.
 *
 * This file will render views from views/Slideshow/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/Slideshow-controller.html
 */
class SlideshowController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	public $components 	= 	array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('language','index','brand','xml');
		$this->set('model',$this->modelClass);
	
	}
	

	public function index($id) {
	
		$this->layout = "slideshow";
		
		$id = base64_decode($id);
		if (!$id) {
			return $this->redirect('/');
		}
			$this->loadModel("Gallery");
			$this->loadModel("Shoot.Shoot");
			$this->Shoot->belongsTo = array("Photographer"=>array('className'=>"Usermgmt.Photographer",'foreignKey'=>'photographer_id'));
			$this->Gallery->hasMany = array('GalleryImage'=>array('className'=>"GalleryImage",'foreignKey'=>'gallery_id'));
			$this->Gallery->hasOne = array(
										'Invoice'=>array('className'=>"Invoice.Invoice",'foreignKey'=>'gallery_id'),
										'Shoot'=>array('className'=>"Shoot.Shoot",'foreignKey'=>'gallery_id')
										);
			$this->Gallery->belongsTo = array(
										'Client'=>array('className'=>"User",'foreignKey'=>'client_id')
										);	
			$this->Gallery->recursive = 2;
			$gallery = $this->Gallery->find('first',array("conditions"=>array("Gallery.id"=>$id)));
		// pr($gallery); die;
		$first_image = USER_IMAGE_STORE_PATH.$gallery["GalleryImage"][0]["image_folder"].DS.$gallery["GalleryImage"][0]["image"];
		$file_path		=	USER_IMAGE_STORE_PATH.$gallery["GalleryImage"][0]['image_folder'].DS;
		$file_name		=	$gallery["GalleryImage"][0]['image'];
		$first_image_url		=	Router::url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',800,800,base64_encode($file_path),$file_name),true);
		
		if(empty($gallery)){
			return $this->redirect('/');
		}
		
		/* $user_ids = $this->Auth->user('id');
		if (empty($user_ids) || !$user_ids) {
			return $this->redirect(array('controller'=>'users','action'=>'login'));
		}  */
		
		$page = $subpage = $title_for_layout = $gallery["Gallery"]["gallery_title"];
		
		$this->set("first_image_url",$first_image_url);
		$this->set("gallery",$gallery);
		$this->set("title_for_layout",$title_for_layout);
		$this->set("id",$id);
		// pr($gallery); die;
		$this->render('home');
	
		
	}
	
	public function nonBranded($id) {
	
		$this->layout = "slideshow";
		
		$id = base64_decode($id);
		if (!$id) {
			return $this->redirect('/');
		}
			$this->loadModel("Gallery");
			$this->loadModel("User");
			$this->loadModel("Shoot.Shoot");
			$this->Shoot->belongsTo = array("Photographer"=>array('className'=>"Usermgmt.Photographer",'foreignKey'=>'photographer_id'));
			$this->Gallery->hasMany = array('GalleryImage'=>array('className'=>"GalleryImage",'foreignKey'=>'gallery_id'));
			$this->Gallery->hasOne = array(
										'Invoice'=>array('className'=>"Invoice.Invoice",'foreignKey'=>'gallery_id'),
										'Shoot'=>array('className'=>"Shoot.Shoot",'foreignKey'=>'gallery_id')
										);
			$this->Gallery->recursive = 2;
			$gallery = $this->Gallery->find('first',array("conditions"=>array("Gallery.id"=>$id)));
			
		// pr($gallery); die;
		$first_image = USER_IMAGE_STORE_PATH.$gallery["GalleryImage"][0]["image_folder"].DS.$gallery["GalleryImage"][0]["image"];
		$file_path		=	USER_IMAGE_STORE_PATH.$gallery["GalleryImage"][0]['image_folder'].DS;
		$file_name		=	$gallery["GalleryImage"][0]['image'];
		$first_image_url		=	Router::url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',800,800,base64_encode($file_path),$file_name),true);
		
		if(empty($gallery)){
			return $this->redirect('/');
		}
		
		/* $user_ids = $this->Auth->user('id');
		if (empty($user_ids) || !$user_ids) {
			return $this->redirect(array('controller'=>'users','action'=>'login'));
		}  */
		
		$page = $subpage = $title_for_layout = $gallery["Gallery"]["gallery_title"];
		
		$this->set("first_image_url",$first_image_url);
		$this->set("gallery",$gallery);
		// $this->set("realtor",$realtor);
		$this->set("title_for_layout",$title_for_layout);
		$this->set("id",$id);
		// pr($gallery); die;
		$this->render('non-brand');
	
		
	}
	
	public function xml($id) {
	
		$this->layout = false;
		$this->autoRender = false;
		
		$id = base64_decode($id);
		if (!$id) {
			return $this->redirect('/');
		}
			$this->loadModel("Gallery");
			$this->loadModel("Shoot.Shoot");
			$this->Shoot->belongsTo = array("Photographer"=>array('className'=>"Usermgmt.Photographer",'foreignKey'=>'photographer_id'));
			$this->Gallery->hasMany = array('GalleryImage'=>array('className'=>"GalleryImage",'foreignKey'=>'gallery_id'));
			$this->Gallery->hasOne = array(
										'Invoice'=>array('className'=>"Invoice.Invoice",'foreignKey'=>'gallery_id'),
										'Shoot'=>array('className'=>"Shoot.Shoot",'foreignKey'=>'gallery_id')
										);
			$this->Gallery->recursive = 2;
			$gallery = $this->Gallery->find('first',array("conditions"=>array("Gallery.id"=>$id)));
		
		// if(empty($gallery)){
			// return $this->redirect('/');
		// }
		
		// $xml = new SimpleXMLElement('<xml/>');
		$xml = "<juiceboxgallery>
		";

			if(isset($gallery["GalleryImage"]) && !empty($gallery["GalleryImage"])){
											foreach($gallery["GalleryImage"] as $gallery_image){
												$file_path		=	USER_IMAGE_STORE_PATH.$gallery_image['image_folder'].DS;
												$file_name		=	$gallery_image['image'];
												$image_url		=	Router::url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',100,100,base64_encode($file_path),$file_name),true);
												$big_image_url		=	Router::url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',800,800,base64_encode($file_path),$file_name),true);
												if(is_file($file_path . $file_name)) {
												$xml .= '<image imageURL="'.$big_image_url.'" thumbURL="'.$big_image_url.'" />
												
												';
												// $track = $xml->addChild('image');
												// $track->addChild('imageURL', $big_image_url);
												// $track->addChild('thumbURL', $big_image_url);
												
												}
											}
										} 
			
			$xml .= "</juiceboxgallery>";
			/* for ($i = 1; $i <= 8; ++$i) {
				$track = $xml->addChild('track');
				$track->addChild('path', "song$i.mp3");
				$track->addChild('title', "Track $i - Track Title");
			} */

			Header('Content-type: text/xml');
			// print($xml->asXML());
			print($xml);
		
		// $this->set("gallery",$gallery);
		// pr($gallery); die;
		// $this->render('home');
	
		
	}
	
	
	public function language($lang= null){
			$this->layout	=	false;
			$this->Session->write('Config.language',$lang);
			
				switch($lang){
					case 'en':
					$language_id = 1;
					break;
					case 'pt':
					$language_id = 2;
					break;
					case 'sp':
					$language_id = 3;
					break;
					default:
					$language_id = 1;
				}
			$this->Session->write('Config.language_id',$language_id);
			$this->redirect($this->referer());
	}
	
	
}
