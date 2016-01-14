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
class Transaction extends TransactionAppModel {

/**
 * Name
 *
 * @var string
 */
	public $name = 'Transaction';
	

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
	public $displayField = 'transaction';

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array();
	
	public $belongsTo = array('Seller' => array('className'=>"Usermgmt.Client",'foreignKey'=>'seller'),
								'Transporter' => array('className'=>"Usermgmt.Client",'foreignKey'=>'transporter'),
								'Employee' => array('className'=>"Usermgmt.Employee",'foreignKey'=>'employee_id'),
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
		$this->validate = array(
								'seller' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please select seller.', true)
												),
								'transporter' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please select transporter.', true)
												),
								'load_location' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter Load Location.', true)
												),
								'unload_location' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter Unload Location.', true)
												),
								'money_in' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter Money In.', true),
												'rule' 		=> 'numeric',
												'required' 	=> true,
											    'message' 	=> __('Please enter numeric price.', true)
												),
								'money_out' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please enter Money Out.', true),
												'rule' 		=> 'numeric',
												'required' 	=> true,
											    'message' 	=> __('Please enter numeric price.', true)
												),
								'currency' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please select currency.', true)
												),
								'status' => array('rule' 		=> 'notEmpty',
												'required' 	=> true,
											    'message' 	=> __('Please select status.', true)
												),
		                      ); 
		} 
}
