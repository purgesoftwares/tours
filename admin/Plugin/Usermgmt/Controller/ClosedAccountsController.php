<?php
class ClosedAccountsController extends UsermgmtAppController {


	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'ClosedAccounts';
	
	/**
	 * Helpers
	 *
	 * @var array
	 */
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');

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
		array('field' => 'company_name', 'type' => 'value'),
		//array('field' => 'suggested_by', 'type' => 'value'),
		//array('field' => 'country', 'type' => 'value')
		
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
	public function index() {
		// Breadcrumb
		$pageHeading = __('Closed Account');
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
	
		$breadcrumb = array('pages' => $pages, 'active' =>$pageHeading);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('pageHeading', $pageHeading);
		
		//check limit for show records on page
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		
		$this->{$this->modelClass}->virtualFields  = array(
			'reactivate_account_status'=> "SELECT field_value  FROM user_details WHERE user_id=".$this->modelClass.".id AND field_name='User.reactivate_account'",
			); 
		
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		
		
		$this->{$this->modelClass}->data[$this->modelClass]	= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		/* $parsedConditions['user_role_id'] = Configure::read('user_roles.partner');
		*/
		// $parsedConditions['is_deleted'] = 1; 
		$parsedConditions['is_closed'] = 1; 
		$this->paginate = array(
			'conditions' => $parsedConditions,
			'limit' => $limit,
			'order'=>	array($this->modelClass . '.created' => 'desc')	
		);
		$result= $this->paginate();
		// pr($result);
		$this->set('result', $result);
		// $reactivate_account_status		=	'0';
		// if(!empty($result)){
			// foreach($result[0]['UserDetail'] as $val){
				// if($val['field_name'] == 'User.reactivate_account'){
					// if($val['field_value'] == '1'){
						// $reactivate_account_status		=	'1';
					// }
				// }
			// }
		// }
		// $this->set('reactivate_account_status', $reactivate_account_status);

		////////notification
		$this->loadModel('Notification');
		$notification = $this->Notification->find('first',array('conditions'=>array('user_id'=>1,'menu'=>'suggest partner')));
			//pr($notification); die;
			if($notification['Notification']['notifications']>0){
				$nots['notifications'] =  0;
				$this->Notification->id = $notification['Notification']['id'];
				$this->Notification->save($nots,false);
			}
	}	
	
	
	public function reactive_account($userId = ''){

		$this->loadModel('UserDetail');
		$user_details	=	$this->UserDetail->find('first',array('conditions'=>array('user_id'=>$userId,'field_name'=>'User.reactivate_account')));
		$detail_data		=	array();
		$detail_data['field_name']		=	'User.reactivate_account';
		$detail_data['field_value']		=	'0';
		
		$this->UserDetail->id	=	$user_details['UserDetail']['id'];
		$this->UserDetail->save($detail_data,false);
		
		$data		=	array();
		// $data['is_deleted']		=	'0';
		$data['is_closed']		=	'0';
		$this->{$this->modelClass}->id=$userId;
		$this->{$this->modelClass}->save($data,false);
		$this->Session->setFlash(__('User account has been reactivated.'), 'success');
		$this->redirect(array('action' => 'index'));
	}
	
		
}