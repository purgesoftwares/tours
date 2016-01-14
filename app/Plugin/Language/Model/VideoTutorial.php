<?php
/**
 * Copyright 2012, Gempulse Infotech Pvt. Ltd. (http://www.fullestop.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://www.fullestop.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cms App Model
 *
 * @package Cms
 * @subpackage cms.models
 */
class VideoTutorial extends FaqAppModel {

/**
 * Name
 *
 * @var string
 */
	public $name = 'VideoTutorial';
	

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable','Search.Searchable');
						  
						  
						  

/**
 * Additional Find methods
 *
 * @var array
 */
	public $_findMethods = array('search' => true);

/**
 * @todo comment me
 *
 * @var array
 */
	public $filterArgs = array(
			array('name' => 'title', 
				  'type' => 'string'
			)
	  );

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'faq';

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array();

/**
 * Validation parameters
 *
 * @var array
 */
	public $validate = array();

/**
 * Constructor
 *
 * @param string $id ID
 * @param string $table Table
 * @param string $ds Datasource
 */
	 public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		//validation for cms updation
		$this->validate = array('title' => array('rule' 	=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter title.', true)
												),
								'description' => array('rule' 		=> 'notEmpty',
								'required' 	=> true,
								'message' 	=> __('Please enter description.', true)
								),
								 'video' => array(
										'rule1' => array(
												'rule' => 'checkEmpty',
												'message' => 'Please upload a video.',
												'last'=>true
											),
										'rule2' => array(
												'rule' => array('extension',array('mp4','avi','flv','mov')),
												'message' => 'Please upload only avi, flv, mov and mp4 type videos',
												'last'=>true										
											),
										'rule3' => array(
												'rule' => 'isValidFileSize',
												'message' => 'File size exceed the limit 40Mb.',
												'last'=>true										
											)
										),
		
		                      ); 
		} 
		
		
public function checkEmpty($data){
	if(isset($data['video']['size']) && $data['video']['size']==0){
		
			return false;
	}
	else{
			return true;
	}
}
	
public function isValidImageFile($data){
		$valid_types = array('jpeg', 'png', 'gif','jpg');
		$file		=	$data['video']['name'];
		$ext 		=	strtolower(substr($file,strrpos($file,".") + 1));
		if(isset($this->data[$this->alias]['new_user']) && $this->data[$this->alias]['new_user'] == ''){
			return true;
		}else if (!in_array($ext,$valid_types)) {
				return false;	
			}
			else{ 
				return true;
			}
	}
public function isValidFileSize($data){
		$filesize	=	$data['video']['size'];
		if(isset($this->data[$this->alias]['new_user']) && $this->data[$this->alias]['new_user'] == ''){
			return true;
		}else if($filesize > 40485760)
				return false;
			else
				return true;
	}
}
