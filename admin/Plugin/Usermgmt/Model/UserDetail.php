<?php
App::uses('Security', 'Utility');
/**
 * Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Users Plugin User Model
 *
 * @package User
 * @subpackage User.Model
 */
class UserDetail extends UsermgmtAppModel {
/**
 * Name
 *
 * @var string
 */
	public $name = 'UserDetail';
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
		
		}
	function savePartnerProfile($userId,$postData){
		
		if(isset($postData['Partner']['first_name']))
			$userDetails['User.first_name']			= 	$postData['Partner']['first_name'];
		if(isset($postData['Partner']['last_name']))	
			$userDetails['User.last_name']			= 	$postData['Partner']['last_name'];
		if(isset($postData['Partner']['user_image']))	
			$userDetails['User.user_image']			= 	$postData['Partner']['user_image'];
		if(isset($postData['Partner']['address']))
			$userDetails['User.address']			= 	$postData['Partner']['address'];
		if(isset($postData['Partner']['nib']))	
			$userDetails['User.nib']				= 	$postData['Partner']['nib'];
		if(isset($postData['Partner']['nif']))	
			$userDetails['User.nif']				= 	$postData['Partner']['nif'];
		if(isset($postData['Partner']['company_name']))	
			$userDetails['User.company_name']		= 	$postData['Partner']['company_name'];
		if(isset($postData['Partner']['brand']))	
			$userDetails['User.brand']				= 	$postData['Partner']['brand'];
		if(isset($postData['Partner']['country']))	
			$userDetails['User.country']			= 	$postData['Partner']['country'];
		if(isset($postData['Partner']['county']))	
			$userDetails['User.county']				= 	$postData['Partner']['county'];
		if(isset($postData['Partner']['local']))	
			$userDetails['User.local']				= 	$postData['Partner']['local'];
		if(isset($postData['Partner']['district']))	
			$userDetails['User.district']			= 	$postData['Partner']['district'];
		if(isset($postData['Partner']['state']))	
			$userDetails['User.state']				= 	$postData['Partner']['state'];
			
		if(isset($postData['Partner']['invoice_address']))	
			$userDetails['User.invoice_address']			= 	$postData['Partner']['invoice_address'];
			
		if(isset($postData['Partner']['invoice_zipcode']))	
			$userDetails['User.invoice_zipcode']				= 	$postData['Partner']['invoice_zipcode'];
			
		if(isset($postData['Partner']['invoice_city']))	
			$userDetails['User.invoice_city']			= 	$postData['Partner']['invoice_city'];
			
		if(isset($postData['Partner']['url']))	
			$userDetails['User.url']				= 	$postData['Partner']['url'];
			
		if(isset($postData['Partner']['city']))	
			$userDetails['User.city']				= 	$postData['Partner']['city'];
		if(isset($postData['Partner']['lat_long']))	
			$userDetails['User.lat_long']			= 	$postData['Partner']['lat_long'];
		if(isset($postData['Partner']['zipcode']))	
			$userDetails['User.zipcode']			= 	$postData['Partner']['zipcode'];
		if(isset($postData['Partner']['telephone']))	
			$userDetails['User.telephone']			= 	$postData['Partner']['telephone'];
		if(isset($postData['Partner']['mobile']))	
			$userDetails['User.mobile']				= 	$postData['Partner']['mobile'];
		if(isset($postData['Partner']['about_me']))	
			$userDetails['User.about_me']			= 	$postData['Partner']['about_me'];
		if(isset($postData['Partner']['user_image_folder']))
			$userDetails['User.user_image_folder']	= 	$postData['Partner']['user_image_folder'];
		if(isset($postData['Partner']['general_email']))
			$userDetails['User.general_email']		= 	$postData['Partner']['general_email'];
		if(isset($postData['Partner']['marketing_email']))
			$userDetails['User.marketing_email']		= 	$postData['Partner']['marketing_email'];
		if(isset($postData['Partner']['cell_phone']))
			$userDetails['User.cell_phone']			= 	$postData['Partner']['cell_phone'];
		if(isset($postData['Partner']['mobile_phone']))
			$userDetails['User.mobile_phone']			= 	$postData['Partner']['mobile_phone'];
		if(isset($postData['Partner']['mobile_phone']))
			$userDetails['User.mobile_phone']			= 	$postData['Partner']['mobile_phone'];
		if(isset($postData['Partner']['contact_1_name']))
			$userDetails['User.contact_1_name']			= 	$postData['Partner']['contact_1_name'];
		if(isset($postData['Partner']['contact_1_phone']))
			$userDetails['User.contact_1_phone']		= 	$postData['Partner']['contact_1_phone'];
		if(isset($postData['Partner']['contact_1_job']))
			$userDetails['User.contact_1_job']			= 	$postData['Partner']['contact_1_job'];
		if(isset($postData['Partner']['contact_2_name']))
			$userDetails['User.contact_2_name']			= 	$postData['Partner']['contact_2_name'];
		if(isset($postData['Partner']['contact_2_phone']))
			$userDetails['User.contact_2_phone']		= 	$postData['Partner']['contact_2_phone'];
		if(isset($postData['Partner']['contact_2_job']))
			$userDetails['User.contact_2_job']			= 	$postData['Partner']['contact_2_job'];
		if(isset($postData['Partner']['contact_3_name']))
			$userDetails['User.contact_3_name']			= 	$postData['Partner']['contact_3_name'];
		if(isset($postData['Partner']['contact_3_phone']))
			$userDetails['User.contact_3_phone']		= 	$postData['Partner']['contact_3_phone'];
		if(isset($postData['Partner']['contact_3_job']))
			$userDetails['User.contact_3_job']			= 	$postData['Partner']['contact_3_job'];
		if(isset($postData['Partner']['partner_type']))
			$userDetails['User.partner_type']			= 	$postData['Partner']['partner_type'];
		if(isset($postData['Partner']['partner_state']))
			$userDetails['User.partner_state']			= 	$postData['Partner']['partner_state'];
		
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	
	function saveemployeeProfile($userId,$postData){
		$userDetails['User.first_name']			= 	$postData['Employee']['first_name'];
		$userDetails['User.last_name']			= 	$postData['Employee']['last_name'];
		$userDetails['User.user_image']			= 	$postData['Employee']['user_image'];
		$userDetails['User.telephone']			= 	$postData['Employee']['telephone'];
		$userDetails['User.mobile']				= 	$postData['Employee']['mobile'];
		$userDetails['User.zipcode']				= 	$postData['Employee']['zipcode'];
		$userDetails['User.dob']				= 	$postData['Employee']['dob'];
		$userDetails['User.city']				= 	$postData['Employee']['city'];
		if(isset($postData['Employee']['user_image_folder']))
			$userDetails['User.user_image_folder']	= 	$postData['Employee']['user_image_folder'];
		
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	
	
	function saveCustomerProfile($userId,$postData){
		$userDetails['User.first_name']			= 	$postData['Customer']['first_name'];
		$userDetails['User.last_name']			= 	$postData['Customer']['last_name'];
		$userDetails['User.user_image']			= 	$postData['Customer']['user_image'];
		$userDetails['User.dob']				= 	$postData['Customer']['dob'];
		if(isset($postData['Customer']['gender']))
		$userDetails['User.gender']				= 	$postData['Customer']['gender'];
		$userDetails['User.country']			= 	$postData['Customer']['country'];
		$userDetails['User.county']				= 	$postData['Customer']['county'];
		$userDetails['User.district']			= 	$postData['Customer']['district'];
		$userDetails['User.state']				= 	$postData['Customer']['state'];
		$userDetails['User.city']				= 	$postData['Customer']['city'];
		$userDetails['User.lat_long']			= 	$postData['Customer']['lat_long'];
		$userDetails['User.zipcode']			= 	$postData['Customer']['zipcode'];
		$userDetails['User.telephone']			= 	$postData['Customer']['telephone'];
		$userDetails['User.address']			= 	$postData['Customer']['address'];
		$userDetails['User.nif']				= 	$postData['Customer']['nif'];
		$userDetails['User.mobile']				= 	$postData['Customer']['mobile'];
		$userDetails['User.about_me']			= 	$postData['Customer']['about_me'];
		$userDetails['User.rating']				= 	1;
		
		if(isset($postData['Customer']['user_type']))
			$userDetails['User.user_type']		= 	$postData['Customer']['user_type'];
		
		if(isset($postData['Customer']['user_image_folder']))
			$userDetails['User.user_image_folder']	= 	$postData['Customer']['user_image_folder'];
		
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	function saveclientProfile($userId,$postData){
		if(isset($postData['Client']['first_name']))
		$userDetails['User.first_name']			= 	$postData['Client']['first_name'];
		if(isset($postData['Client']['last_name']))
		$userDetails['User.last_name']			= 	$postData['Client']['last_name'];
		
		if(isset($postData['Client']['city']))
		$userDetails['User.city']				= 	$postData['Client']['city'];
		if(isset($postData['Client']['state']))
		$userDetails['User.state']				= 	$postData['Client']['state'];
		if(isset($postData['Client']['company']))
		$userDetails['User.company']			= 	$postData['Client']['company'];
		if(isset($postData['Client']['comment']))
		$userDetails['User.comment']			= 	$postData['Client']['comment'];
		if(isset($postData['Client']['address']))
		$userDetails['User.address']			= 	$postData['Client']['address'];
		if(isset($postData['Client']['zipcode']))
		$userDetails['User.zipcode']			= 	$postData['Client']['zipcode'];
		if(isset($postData['Client']['telephone']))
		$userDetails['User.telephone']			= 	$postData['Client']['telephone'];
		if(isset($postData['Client']['mobile']))
		$userDetails['User.mobile']				= 	$postData['Client']['mobile'];
		
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	function saveadminProfile($userId,$postData){
		if(isset($postData['Admin']['first_name']))
		$userDetails['User.first_name']			= 	$postData['Admin']['first_name'];
		if(isset($postData['Admin']['last_name']))
		$userDetails['User.last_name']			= 	$postData['Admin']['last_name'];
		
		if(isset($postData['Admin']['city']))
		$userDetails['User.city']				= 	$postData['Admin']['city'];
		if(isset($postData['Admin']['state']))
		$userDetails['User.state']				= 	$postData['Admin']['state'];
		if(isset($postData['Admin']['company']))
		$userDetails['User.company']			= 	$postData['Admin']['company'];
		if(isset($postData['Admin']['comment']))
		$userDetails['User.comment']			= 	$postData['Admin']['comment'];
		if(isset($postData['Admin']['address']))
		$userDetails['User.address']			= 	$postData['Admin']['address'];
		if(isset($postData['Admin']['zipcode']))
		$userDetails['User.zipcode']			= 	$postData['Admin']['zipcode'];
		if(isset($postData['Admin']['telephone']))
		$userDetails['User.telephone']			= 	$postData['Admin']['telephone'];
		if(isset($postData['Admin']['mobile']))
		$userDetails['User.mobile']				= 	$postData['Admin']['mobile'];
		
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	function savephotographerProfile($userId,$postData){
		$userDetails['User.first_name']			= 	$postData['Photographer']['first_name'];
		$userDetails['User.last_name']			= 	$postData['Photographer']['last_name'];
		
		$userDetails['User.city']				= 	$postData['Photographer']['city'];
		$userDetails['User.state']				= 	$postData['Photographer']['state'];
		$userDetails['User.price']				= 	$postData['Photographer']['price'];
		$userDetails['User.comment']			= 	$postData['Photographer']['comment'];
		$userDetails['User.address']			= 	$postData['Photographer']['address'];
		$userDetails['User.zipcode']			= 	$postData['Photographer']['zipcode'];
		$userDetails['User.telephone']			= 	$postData['Photographer']['telephone'];
		$userDetails['User.mobile']				= 	$postData['Photographer']['mobile'];
		
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
		
	}
	function saveChangePartnerProfile($userId,$postData){
	
		if(isset($postData['Partner']['upgradationtype']))
			$userDetails['User.upgradationtype']			= 	$postData['Partner']['upgradationtype'];
		if(isset($postData['Partner']['accountupgradeted']))	
			$userDetails['User.accountupgradeted']			= 	$postData['Partner']['accountupgradeted'];
		if(isset($postData['Partner']['max_resource']))
			$userDetails['User.max_resource']				= 	$postData['Partner']['max_resource'];
		if(isset($postData['Partner']['max_package']))
			$userDetails['User.max_package']				= 	$postData['Partner']['max_package'];
		if(isset($postData['Partner']['max_news']))
			$userDetails['User.max_news']					= 	$postData['Partner']['max_news'];
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	function saveChangeOtherPartnerProfile($userId,$postData){
		$userDetails['User.upgradationtype']			= 	$postData['OtherPartner']['upgradationtype'];
		$userDetails['User.accountupgradeted']			= 	$postData['OtherPartner']['accountupgradeted'];
		$userDetails['User.max_resource']				= 	$postData['OtherPartner']['max_resource'];
		$userDetails['User.max_package']				= 	$postData['OtherPartner']['max_package'];
		$userDetails['User.max_news']					= 	$postData['OtherPartner']['max_news'];
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	
	function saveComercialProfile($userId,$postData){
		$userDetails['User.first_name']			= 	$postData['Comercial']['first_name'];
		$userDetails['User.last_name']			= 	$postData['Comercial']['last_name'];
		$userDetails['User.user_image']			= 	$postData['Comercial']['user_image'];
		$userDetails['User.dob']				= 	$postData['Comercial']['dob'];
		$userDetails['User.gender']				= 	$postData['Comercial']['gender'];
		$userDetails['User.country']			= 	$postData['Comercial']['country'];
		$userDetails['User.county']				= 	$postData['Comercial']['county'];
		$userDetails['User.district']			= 	$postData['Comercial']['district'];
		$userDetails['User.state']				= 	$postData['Comercial']['state'];
		$userDetails['User.city']				= 	$postData['Comercial']['city'];
		$userDetails['User.lat_long']			= 	$postData['Comercial']['lat_long'];
		$userDetails['User.zipcode']			= 	$postData['Comercial']['zipcode'];
		$userDetails['User.telephone']			= 	$postData['Comercial']['telephone'];
		$userDetails['User.mobile']				= 	$postData['Comercial']['mobile'];
		$userDetails['User.about_me']			= 	$postData['Comercial']['about_me'];
		if(isset($postData['Comercial']['user_image_folder']))
			$userDetails['User.user_image_folder']	= 	$postData['Comercial']['user_image_folder'];
		
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	
	function savePotentialPartnerProfile($userId,$postData){
	
		$userDetails['User.name']				= 	$postData['Comercial']['name'];
		$userDetails['User.country']			= 	$postData['Comercial']['country'];
		$userDetails['User.county']				= 	$postData['Comercial']['county'];
		$userDetails['User.district']			= 	$postData['Comercial']['district'];
		$userDetails['User.zipcode']			= 	$postData['Comercial']['zipcode'];
		$userDetails['User.telephone']			= 	$postData['Comercial']['telephone'];
		$userDetails['User.mobile']				= 	$postData['Comercial']['mobile'];
		$userDetails['User.district']			= 	$postData['Comercial']['district'];
		$userDetails['User.address']			= 	$postData['Comercial']['address'];
		$userDetails['User.activities_description']			= 	$postData['Comercial']['activities_description'];
		$userDetails['User.site_url']			= 	$postData['Comercial']['site_url'];
		$userDetails['User.observations']		= 	$postData['Comercial']['observations'];
		$userDetails['User.nif_nipc']			= 	$postData['Comercial']['nif_nipc'];
		$userDetails['User.facebook_link']		= 	$postData['Comercial']['facebook_link'];
		$userDetails['User.google_link']		= 	$postData['Comercial']['google_link'];
		$userDetails['User.twitter']			= 	$postData['Comercial']['twitter'];
		$userDetails['User.linkedIn']			= 	$postData['Comercial']['linkedIn'];
		$userDetails['User.legal_form']			= 	$postData['Comercial']['legal_form'];
		$userDetails['User.social_capital']		= 	$postData['Comercial']['social_capital'];
		$userDetails['User.county']				= 	$postData['Comercial']['county'];
		$userDetails['User.creation_date']		= 	$postData['Comercial']['creation_date'];
		
		if(isset($postData['Comercial']['city'])){
			$userDetails['User.city']				= 	$postData['Comercial']['city'];
		}
		if(isset($postData['Comercial']['social_designation'])){
			$userDetails['User.social_designation']		= 	$postData['Comercial']['social_designation'];
		}
		
		
		
		
		/* if(isset($postData['Comercial']['commercial_code']) && !empty($postData['Comercial']['commercial_code'])){
			$userDetails['User.commercial_code']	= 	$postData['Comercial']['commercial_code'];
		} */
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	
	function savePotentialPartnerAdmin($userId,$postData){
	
	//pr($postData); die;
	
		if(isset($postData['Comercial']['name'])){
			$userDetails['User.name']				= 	$postData['Comercial']['name'];
		}	
		if(isset($postData['Comercial']['country'])){
			$userDetails['User.country']			= 	$postData['Comercial']['country'];
		}
		if(isset($postData['Comercial']['city'])){
			$userDetails['User.city']				= 	$postData['Comercial']['city'];
		}
		if(isset($postData['Comercial']['social_designation'])){
			$userDetails['User.social_designation']		= 	$postData['Comercial']['social_designation'];
		}
		if(isset($postData['Comercial']['county'])){
			$userDetails['User.county']				= 	$postData['Comercial']['county'];
		}
		if(isset($postData['Comercial']['district'])){
			$userDetails['User.district']				= 	$postData['Comercial']['district'];
		}
		if(isset($postData['Comercial']['zipcode'])){
			$userDetails['User.zipcode']				= 	$postData['Comercial']['zipcode'];
		}
		if(isset($postData['Comercial']['telephone'])){
			$userDetails['User.telephone']				= 	$postData['Comercial']['telephone'];
		}	
		if(isset($postData['Comercial']['mobile'])){
			$userDetails['User.mobile']				= 	$postData['Comercial']['mobile'];
		}	
	
		if(isset($postData['Comercial']['district'])){
			$userDetails['User.district']				= 	$postData['Comercial']['district'];
		}
		
		if(isset($postData['Comercial']['address'])){
			$userDetails['User.address']				= 	$postData['Comercial']['address'];
		}
		
		if(isset($postData['Comercial']['activities_description'])){
			$userDetails['User.activities_description']				= 	$postData['Comercial']['activities_description'];
		}
	
		if(isset($postData['Comercial']['social_designation'])){
			$userDetails['User.social_designation']				= 	$postData['Comercial']['social_designation'];
		}
	
		if(isset($postData['Comercial']['city'])){
			$userDetails['User.city']				= 	$postData['Comercial']['city'];
		}
	
		if(isset($postData['Comercial']['site_url'])){
			$userDetails['User.site_url']				= 	$postData['Comercial']['site_url'];
		}
		
		if(isset($postData['Comercial']['observations'])){
			$userDetails['User.observations']				= 	$postData['Comercial']['observations'];
		}
		
		if(isset($postData['Comercial']['nif_nipc'])){
			$userDetails['User.nif_nipc']				= 	$postData['Comercial']['nif_nipc'];
		}
		
		if(isset($postData['Comercial']['facebook_link'])){
			$userDetails['User.facebook_link']			= 	$postData['Comercial']['facebook_link'];
		}
		
		if(isset($postData['Comercial']['google_link'])){
			$userDetails['User.google_link']			= 	$postData['Comercial']['google_link'];
		}

		if(isset($postData['Comercial']['twitter'])){
			$userDetails['User.twitter']			= 	$postData['Comercial']['twitter'];
		}
	
		if(isset($postData['Comercial']['linkedIn'])){
			$userDetails['User.linkedIn']			= 	$postData['Comercial']['linkedIn'];
		}
		
		if(isset($postData['Comercial']['legal_form'])){
			$userDetails['User.legal_form']			= 	$postData['Comercial']['legal_form'];
		}
		
		if(isset($postData['Comercial']['social_capital'])){
			$userDetails['User.social_capital']			= 	$postData['Comercial']['social_capital'];
		}
		
		if(isset($postData['Comercial']['county'])){
			$userDetails['User.county']			= 	$postData['Comercial']['county'];
		}

		if(isset($postData['Comercial']['creation_date'])){
			$userDetails['User.creation_date']			= 	$postData['Comercial']['creation_date'];
		}
		/* if(isset($postData['Partner']['commercial_code']) && !empty($postData['Partner']['commercial_code'])){
			$userDetails['User.commercial_code']	= 	$postData['Partner']['commercial_code'];
		} */
		
		//pr($userDetails); die;
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	
	
	function upgradeaccount($userId,$postData){
		
		$userDetails['User.accountupgradeted']			= 	$postData['User']['accountupgradeted'];
		$userDetails['User.upgradationtype']			= 	$postData['User']['upgradationtype'];
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	
	function resourceaddedupgrades($userId,$postData){
		
		$userDetails['User.accountaddresource']			= 	$postData['User']['accountaddresource'];
		$userDetails['User.additionalresourceadded']	= 	$postData['User']['additionalresourceadded'];
		$userDetails['User.resourceaddedtype']			= 	$postData['User']['resourceaddedtype'];
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id','field_value')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				
				if($field=='User.additionalresourceadded'){
					$this->id = $detail['UserDetail']['id'];
					$this->saveField('field_value', $detail['UserDetail']['field_value']+$value);	
				}else if($field=="User.resourceaddedtype"){
					$this->id = $detail['UserDetail']['id'];
					$this->saveField('field_value', $detail['UserDetail']['field_value'].",".$value);	
				}else{
					$this->id = $detail['UserDetail']['id'];
					$this->saveField('field_value', $value);	
				}
			}
		}
	}
	
	
	function resourceadded($userId,$postData,$type="resource"){
	
		if($type=="resource")
			$userDetails['User.resourcecreated']	= 	$postData;
		else if($type=="news")
			$userDetails['User.newscreated']		= 	$postData;
		else if($type=="package")
			$userDetails['User.packagecreated']		= 	$postData;
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id')));
			$newDetail = array();			
			
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				
				$this->id = $detail['UserDetail']['id'];
				$this->saveField('field_value', $value);	
			}
		}	
	}
	
	
	function newsitemaddedupgrades($userId,$postData){
		
		$userDetails['User.accountaddnewsitem']			= 	$postData['User']['accountaddnewsitem'];
		$userDetails['User.additionalnewsadded']		= 	$postData['User']['additionalnewsadded'];
		$userDetails['User.newsitemaddedtype']			= 	$postData['User']['newsitemaddedtype'];
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id','field_value')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] = $userId;
				$newDetail['UserDetail']['field_name'] = $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				if($field=='User.additionalnewsadded'){
					$this->id = $detail['UserDetail']['id'];
					$this->saveField('field_value', $detail['UserDetail']['field_value']+$value);	
				}else if($field=="User.newsitemaddedtype"){
					$this->id = $detail['UserDetail']['id'];
					$this->saveField('field_value', $detail['UserDetail']['field_value'].",".$value);	
				}else{
					$this->id = $detail['UserDetail']['id'];
					$this->saveField('field_value', $value);	
				}
			}
		}	
	}
	
	function subscribeaccount($userId,$postData){
		if(isset($postData['Partner']['max_resource']))
			$userDetails['User.max_resource']					= 	$postData['Partner']['max_resource'];
		if(isset($postData['Partner']['max_package']))
			$userDetails['User.max_package']					= 	$postData['Partner']['max_package'];
		if(isset($postData['Partner']['max_news']))
			$userDetails['User.max_news']						= 	$postData['Partner']['max_news'];
		if(isset($postData['Partner']['accountupsubscribed']))
			$userDetails['User.accountupsubscribed']			= 	$postData['Partner']['accountupsubscribed'];
		if(isset($postData['Partner']['subscriptiontype']))
			$userDetails['User.subscriptiontype']				= 	$postData['Partner']['subscriptiontype'];
		if(isset($postData['Partner']['max_images']))
			$userDetails['User.max_images']						= 	$postData['Partner']['max_images'];
		if(isset($postData['Partner']['max_library_video']))
			$userDetails['User.max_library_video']				= 	$postData['Partner']['max_library_video'];
		if(isset($postData['Partner']['max_library_ppt']))
			$userDetails['User.max_library_ppt']				= 	$postData['Partner']['max_library_ppt'];
		if(isset($postData['Partner']['max_library_pdf']))
			$userDetails['User.max_library_pdf']				= 	$postData['Partner']['max_library_pdf'];
		
		
		foreach($userDetails as $field => $value){
			$detail = $this->find('first', array(
											'recursive' => -1,
											'conditions' => array(
											'user_id' => $userId,
											'field_name' => $field),
											'fields' => array('id','user_id','field_value')));
			$newDetail = array();								
			if (empty($detail)) {
				$this->create();
				$newDetail['UserDetail']['user_id'] 	= $userId;
				$newDetail['UserDetail']['field_name'] 	= $field;
				$newDetail['UserDetail']['field_value'] = $value;
				$this->save($newDetail, false);		
			} else {
				
				if($field!="User.accountupsubscribed"){
					$this->id = $detail['UserDetail']['id'];
					$this->saveField('field_value', $value);	
				}else{
					if($detail['UserDetail']['field_value']<time()){
						$this->id = $detail['UserDetail']['id'];
						$this->saveField('field_value', $value);	
					}
				}
			}
		}	
	}
}
