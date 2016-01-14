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
 * Usermgmt Plugin Partner Model
 *
 * @package Usermgmt
 * @subpackage Usermgmt.models
 */
 //App::uses('Security', 'Utility');
class ClosedAccount extends UsermgmtAppModel {

/**
 * Name
 *
 * @var string
 */
	public $name = 'ClosedAccount';
	public $useTable='users';
	public $virtualFields  = array();

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
						array('name' => 'first_name', 
						  'type' => 'string'
							),
						array('name' => 'email', 
							  'type' => 'string'
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
	//public $hasMany = array();
	public $hasMany = array(
					'UserDetail' => array('className' => 'Usermgmt.UserDetail','foreignkey' => 'user_id')
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
		$this->virtualFields  = array(
			/* 'company'=> "SELECT field_value  FROM  user_details WHERE user_id=".$this->alias.".id AND  field_name = 'User.company'",'contact_person'=> "SELECT field_value  FROM  user_details WHERE user_id=".$this->alias.".id AND  field_name = 'User.contact_person'" */
			);
			
		}
	
	
	/**
 * afterFind callback
 *
 * @param array $results Result data
 * @param mixed $primary Primary query
 * @return array
 */
	public function afterFind($results, $primary = false) {
		//pr($results);exit;
		
		foreach ($results as &$row) {
			
			if (isset($row['UserDetail']) && (is_array($row))) {
				$row[$this->alias]['first_name']	= 	'';
				$row[$this->alias]['last_name']		= 	'';
				$row[$this->alias]['gender']		= 	'';
				$row[$this->alias]['dob']			= 	'';
				$row[$this->alias]['industry']		= 	'';
				$row[$this->alias]['phone_no']		= 	'';
				$row[$this->alias]['address']		= 	'';
				$row[$this->alias]['country']		= 	'';
				$row[$this->alias]['state']			= 	'';
				$row[$this->alias]['city']			= 	'';
				$row[$this->alias]['zipcode']			= 	'';
				
				if(!empty($row['UserDetail'])){
					foreach($row['UserDetail'] as $details) {
					$fields = explode('.', $details['field_name']);
					if(count($fields) == 3){
						$row[$this->alias][$fields[1]][$fields[2]] = $details['field_value'];
					}else{
							$row[$this->alias][$fields[1]] = $details['field_value'];
					}
				} 
					
				}
				
			}
			
		}

		return $results;
	}
}

