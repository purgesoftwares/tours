<?php
/**
 * Copyright 2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cms Plugin CmsPage Model
 *
 * @package Cms
 * @subpackage CmaPage.models
 */
class Category extends MasterAppModel {

/**
 * Name
 *
 * @var string
 */
	public $name = 'Category';
	public $useTable='dropdown_managers';

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable','Search.Searchable', 'Utils.Sluggable' => array(
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
										 ),
										 array('name' => 'active', 
										  'type' => 'int'
										 )
							  );

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'name';

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
		$this->validate = array('name' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter name.', true)
												)
		
		                      ); 
		} 
}