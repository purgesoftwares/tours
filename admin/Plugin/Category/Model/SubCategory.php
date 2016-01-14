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
class SubCategory extends CategoryAppModel {

/**
 * Name
 *
 * @var string
 */
	public $name = 'SubCategory';
	public $useTable = 'categories';
	

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Tree','Containable','Search.Searchable',
						   'Utils.Sluggable' => array(
								'label' => 'name',
								'method' => 'multibyteSlug'));
						  
						  
						  

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
									array('name' => 'name', 
										  'type' => 'string'
										 )
							  );

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'SubCategory';
	
	

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
		$this->validate = array( 
								'name' => array(
											'valid' => array(
													'rule' => 'notEmpty',
													'required' => true,
													'allowEmpty' => false,
													'message' => __('Please enter a value for Sub Category name.')
											),
											'duplicate' => array(
													'rule' => 'isUnique',
													'on' => 'create',
													'message' => __('This Sub Category name is already exist.')
											)
									),
									'image_name' => array(
											'rule' => array('extension',array('jpeg','jpg','png','gif','pjpeg')),
											'required' => false,
											'on' => 'create',
											'allowEmpty' => true,
											'message' => __('Please upload valid image')
										)
								); 
		} 
}
