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
class Report extends ReportAppModel {

/**
 * Name
 *
 * @var string
 */
	public $name = 'Report';
	

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable','Search.Searchable',
						   'Utils.Sluggable' => array(
								//'label' => 'name',
								//'method' => 'multibyteSlug'
								));
						  
						  
						  

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
	public $displayField = 'report';

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array();
	public $belongsTo = array(
										"Client"=>array('className'=>'Usermgmt.Client','foreignKey'=>'client_id'),
										"Gallery"=>array('className'=>'Gallery','foreignKey'=>'gallery_id'),
										"Shoot"=>array('className'=>'Shoot','foreignKey'=>'shoot_id'),
										"Product"=>array('className'=>'Product.Product','foreignKey'=>'product_id')
										);

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
		$this->validate = array('title' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter report title.', true)
												),
									'payment' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter report payment.', true)
												),
									'due_date' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter report due date.', true)
												)
		                      ); 
		} 
}
