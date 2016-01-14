<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

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
		$this->Auth->allow('language');
		$this->set('model',$this->modelClass);
	
	}
	

	public function display() {
	
		$this->set('pageHeading','Welcome, '.$this->Auth->user("first_name")." ".$this->Auth->user("last_name"));
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		// pr($this->Auth->user());
//pr($_SESSION);
		$user_ids = $this->Auth->user('id');
		if (empty($user_ids) || !$user_ids) {
			return $this->redirect(array('controller'=>'users','action'=>'login'));
		} 
		
		$page = $subpage = $title_for_layout = null;
		
		$this->loadModel('Shoot.Shoot');
		
		$this->Shoot->belongsTo = array("Photographer"=>array('className'=>'Usermgmt.Photographer','foreignKey'=>'photographer_id'),
										"Gallery"=>array('className'=>'Gallery.Gallery','foreignKey'=>'gallery_id')
										);
		$this->Shoot->hasOne = array("Invoice"=>array('className'=>'Invoice.Invoice','foreignKey'=>'shoot_id'));
		
		$client_id = ($this->Auth->user('Parent.user_role_id')==3)?$this->Auth->user('parent_id'):$this->Auth->user('id');
		
			$due_shoots = $this->Shoot->find('all',array('conditions'=>array('Gallery.date'=>date('m-d-Y'),'Shoot.status !='=>4,'Shoot.client_id'=>$client_id)));
		$this->set('due_shoots',$due_shoots);
		// pr($due_shoots); die;
		$this->render('home');
	
		
	}
	
	
	public function filtered() {
	
		$this->set('pageHeading','Filtered Statistics');
		/* $path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		} */

//pr($_SESSION);
		$user_ids = $this->Auth->user('id');
		if (empty($user_ids) || !$user_ids) {
			return $this->redirect(array('controller'=>'users','action'=>'login'));
		} 
		
		$page = $subpage = $title_for_layout = null;
		
		$this->loadModel('Transaction');
		$this->loadModel('Usermgmt.Employee');
		/* echo date('t',strtotime('March 2014'));
		pr($this->data); die;
		 */
		$month = date('F');
		$year = date('Y');
		if(!empty($this->data)){
			if(isset($this->data['month']) && !empty($this->data['month'])){
				$month	=	$this->data['month'];
			}
			if(isset($this->data['year']) && !empty($this->data['year'])){
				$year	=	$this->data['year'];
			}
		}
		$month_year = $month.' '.$year;
		$last_day = date('t',strtotime($month_year));
		$first_day = strtotime( 'first day of ' . $month_year);
		$last_day = $first_day+($last_day*24*3600);
		$this->set(compact('month','year'));
		if($this->Auth->user('user_role_id')==1 || $this->Auth->user('user_role_id')==4){
		
			$alltimetransactons = $this->Transaction->find('all',array('conditions'=>array('completed'=>1,'complete_date >='=>$first_day,'complete_date <'=>$last_day),'fields'=>array('id','profit','money_in','money_out','currency','complete_date')));
			
			
			// $alltime_total_profit = array('RON' =>0 ,'EURO'=>0 );
		
			$monthly_total_profit = array('RON' =>0 ,'EURO'=>0);
			
			
			foreach($alltimetransactons as $alltimetransacton){
				
				// $alltime_total_profit[$alltimetransacton['Transaction']['currency']] += $alltimetransacton['Transaction']['profit'];
				if($alltimetransacton['Transaction']['complete_date'] >= $first_day){
					$monthly_total_profit[$alltimetransacton['Transaction']['currency']] += $alltimetransacton['Transaction']['profit'];
				}
				
				
			}
			
			/* 
			pr($alltime_total_profit);
			pr($pre_monthly_total_profit);
			pr($monthly_total_profit); */
			$this->Employee->virtualFields  = array(
												'ron_total' => "SELECT SUM(profit) FROM `transactions` WHERE `completed` = '1' AND `currency` = 'RON' AND `employee_id`= Employee.id ",
												'euro_total' => "SELECT SUM(profit) FROM `transactions` WHERE `completed` = '1' AND `currency` = 'EURO' AND `employee_id`= Employee.id "
												); 
			
			$employees_transactons = $this->Employee->find('all',array('conditions'=>array('active'=>1,'Employee.user_role_id'=>Configure::read('user_role_id.employee')),'fields'=>array('id','first_name','last_name',
			"(SELECT SUM(`profit`) FROM `transactions` WHERE `completed` = '1' AND `currency` = 'RON' AND `employee_id`= Employee.id) AS `ron_total`",
			"(SELECT SUM(profit) FROM `transactions` WHERE `completed` = '1' AND `currency` = 'EURO' AND `employee_id`= Employee.id) AS euro_total",
			"(SELECT SUM(`profit`) FROM `transactions` WHERE `completed` = '1' AND `currency` = 'RON' AND `employee_id`= Employee.id AND `complete_date`>=".($first_day)." AND `complete_date`<".($last_day).") AS `cur_ron_total`",
			"(SELECT SUM(profit) FROM `transactions` WHERE `completed` = '1' AND `currency` = 'EURO' AND `employee_id`= Employee.id AND `complete_date`>=".($first_day)." AND `complete_date`<".($last_day).") AS cur_euro_total",
			
			"(SELECT SUM(`profit`) FROM `transactions` WHERE `completed` = '1' AND `currency` = 'RON' AND (((SELECT `parent_id` FROM `users` WHERE users.`id` = `transactions`.seller)= Employee.id) OR ((SELECT `parent_id` FROM `users` WHERE users.`id` = `transactions`.transporter)= Employee.id) ) AND `complete_date`>=".($first_day)." AND `complete_date`<".($last_day).") AS `cur_ron_total_ref`",
			"(SELECT SUM(profit) FROM `transactions` WHERE `completed` = '1' AND `currency` = 'EURO' AND (((SELECT `parent_id` FROM `users` WHERE users.`id` = `transactions`.seller)= Employee.id) OR ((SELECT `parent_id` FROM `users` WHERE users.`id` = `transactions`.transporter)= Employee.id) ) AND `complete_date`>=".($first_day)." AND `complete_date`<".($last_day).") AS cur_euro_total_ref",
			
			),'contain'=>array()));
			
			
			// pr($employees_transactons); die;
			// $this->set('alltime_total_profit',$alltime_total_profit);
			// $this->set('pre_monthly_total_profit',$pre_monthly_total_profit);
			$this->set('monthly_total_profit',$monthly_total_profit);
			$this->set('employees_transactons',$employees_transactons);
			
		}
		
		if($this->Auth->user('user_role_id')==2){
		
			
			$this->loadModel('Usermgmt.Client');
			
			$clients = $this->Client->find('list',array('conditions'=>array('parent_id'=>$this->Auth->user('id')),'fields'=>array('id','id')));
			
			$all_in_timetransactons = $this->Transaction->find('all',array('conditions'=>array('completed'=>1,'complete_date >='=>$first_day,'complete_date <'=>$last_day,'OR'=>array('seller'=>$clients,'transporter'=>$clients)),'fields'=>array('id','profit','money_in','money_out','currency','complete_date')));
			$alltimetransactons = $this->Transaction->find('all',array('conditions'=>array('completed'=>1,'complete_date >='=>$first_day,'complete_date <'=>$last_day,'employee_id'=>$this->Auth->user('id')),'fields'=>array('id','profit','money_in','money_out','currency','complete_date')));
			
			// echo date( 'F');
			// pr($alltimetransactons);die;
			// echo $first_minute = mktime(0, 0, 0, date("n"), 1);
			// echo date("n");
			// echo $last_minute = mktime(23, 59, 0, date("n"), date("t"));
			// echo date('d-m-y',mktime(0, 0, 0, (((date("n")-1)==0)?12:date("n")-1), 1, (((date("n")-1)==0)?date('Y')-1:date('Y'))));
			
			$pre_monthly_total_profit = array('in'=>array('RON' =>0 ,'EURO'=>0 ),'dir'=>array('RON' =>0 ,'EURO'=>0 ));
			$monthly_total_profit = array('in'=>array('RON' =>0 ,'EURO'=>0 ),'dir'=>array('RON' =>0 ,'EURO'=>0 ));
			
			
			foreach($alltimetransactons as $alltimetransacton){
				
				
				if($alltimetransacton['Transaction']['complete_date'] >= $first_day){
					$monthly_total_profit['dir'][$alltimetransacton['Transaction']['currency']] += $alltimetransacton['Transaction']['profit'];
				}
				
				
			}
			
			foreach($all_in_timetransactons as $alltimetransacton){
				
				
				if($alltimetransacton['Transaction']['complete_date'] >=$first_day){
					$monthly_total_profit['in'][$alltimetransacton['Transaction']['currency']] += $alltimetransacton['Transaction']['profit'];
				}
				
				
			}
			
			
			// pr($employees_transactons); die;
			
			$this->set('monthly_total_profit',$monthly_total_profit);
			
		}
		
		
		
		
		

		$this->render('filtered');
	
		
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
	function get_county($district_id=1){
		$this->layout	=	false;
		$this->loadModel('County');
		$county_list	=	$this->County->find('list',array('conditions'=>array('district_id'=>$district_id)));
		$county_list = array_map('utf8_encode', $county_list);
		echo json_encode($county_list);
		exit;
	}
	function get_locals($county_id=1){
		$this->layout	=	false;
		$this->loadModel('Localemodel');
		$Local_list	=	$this->Localemodel->find('list',array('conditions'=>array('county_id'=>$county_id)));
		$Local_list = array_map('utf8_encode', $Local_list);
		echo json_encode($Local_list);
		exit;
	}
	
	function get_sub_categories($category_id=1){
		$this->layout	=	false;
		$this->loadModel('Category');
		$sub_category_list	=	$this->Category->find('list',array('fields'=>array('id','name_'.$this->lang),'conditions'=>array('parent_id'=>$category_id)));
		$sub_category_list = array_map('utf8_encode', $sub_category_list);
		echo json_encode($sub_category_list);
		exit;
	}
	
	public function account_file(){
			$user_id	=	$this->Auth->user('id');
			//pr($this->data); die;
			$this->set('pageHeading','Account File');
			if(isset($this->data['page']['type']) && $this->data['page']['type']==1){
				$this->redirect(array('action'=>'generatereport'));
				exit;
			}
	}
	public function generatereport(){ 
			
			$this->layout =	false;
			$this->autoRender =	false;
			$conditions = array();
			
			//$conditions['reference_id !='] = 0;
			if(isset($this->data['Page']['from']) && isset($this->data['Page']['to'])){
				$from = strtotime($this->data['Page']['from']);
				$to = strtotime($this->data['Page']['to']);
				$from = $from-(12*60*60);
				$to = $to+(12*60*60);
				$conditions['unix_timestamp(created) >='] = $from;
				$conditions['unix_timestamp(created) <='] = $to;
			}else{
				$conditions['exported'] = 0;
			}
			
			$this->loadModel('Transaction');
			$this->loadModel('User');
			$this->loadModel('Country');
			$this->loadModel('PartnerNormal');
			$this->loadModel('PartnerUpgradation');
			$this->loadModel('HighlightType');
			ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large

			//create a file
			 $filename = "export_".date("Y.m.d").".csv";
			 $csv_file = fopen('php://output', 'w');

			 header('Content-type: application/csv; charset=UTF-8');
			 header('Content-Disposition: attachment; filename="'.$filename.'"');
			$this->User->virtualFields  = array(
			'address'=> "SELECT field_value FROM user_details WHERE user_id=User.id AND field_name = 'User.address'",
			'city'=> "SELECT field_value FROM user_details WHERE user_id=User.id AND field_name = 'User.city'",
			'zipcode'=> "SELECT field_value FROM user_details WHERE user_id=User.id AND field_name = 'User.zipcode'",
			'nif'=> "SELECT field_value FROM user_details WHERE user_id=User.id AND field_name = 'User.nif'",
			'country'=> "SELECT field_value FROM user_details WHERE user_id=User.id AND field_name = 'User.country'",
			);
			$results	=	$this->Transaction->find('all',array('conditions'=>$conditions));
			$name	=	'';
			// PR($results); die;
			foreach($results as $key=>$result){
				$user = $this->User->find('first',array('conditions'=>array('id'=>$result['Transaction']['user_id'])));
			// pr($user);die;
				if(!empty($user)){
				$name	=	$user['User']['first_name']." ".$user['User']['last_name'];
					
					
				$results[$key]['Transaction']['username'] 		=  $name;
				$results[$key]['Transaction']['address'] 	=  isset($user['User']['address'])?$user['User']['address']:'';
				$results[$key]['Transaction']['city'] 		=  isset($user['User']['city'])?$user['User']['city']:'';
				$results[$key]['Transaction']['zipcode'] 	=  isset($user['User']['zipcode'])?$user['User']['zipcode']:'';
				$results[$key]['Transaction']['nif'] 		=  isset($user['User']['nif'])?$user['User']['nif']:'';
				$results[$key]['Transaction']['country'] 	=  isset($user['User']['country'])?$user['User']['country']:'';
				
				if($result['Transaction']['type']=='activate'){
				
					$reference		=	$this->get_reference('activate',$result['Transaction']['reference_id']);
					
					$results[$key]['Transaction']['service_description'] 	=  $this->get_description('activate',$result['Transaction']['reference_id']);
					
					$results[$key]['Transaction']['reference_code'] 		=  $reference;
					
				}elseif($result['Transaction']['type']=='highlight'){
				
					$highlighted = $this->HighlightType->find('first',array('conditions'=>array('id'=>$result['Transaction']['reference_id'])));
					$reference		=	$this->get_reference('highlight',$result['Transaction']['reference_id']);
					$results[$key]['Transaction']['service_description'] 	=  $this->get_description('highlight',$result['Transaction']['reference_id']);;
					//$results[$key]['Transaction']['service_description'] 	=  'Highlight - '.$highlighted['HighlightType']['name'];
					$results[$key]['Transaction']['reference_code'] 		=  $reference;
				}
				
				$countries = $this->Country->find('first',array('conditions'=>array('name'=>(isset($results[$key]['Transaction']['country'])?$results[$key]['Transaction']['country']:173))));
				
				$results[$key]['Transaction']['country_initials'] 	=  $countries['Country']['iso3166_1'];
				$results[$key]['Transaction']['country_origin'] 	=  $countries['Country']['origin'];
				
				}
			}
			 if(!isset($this->data['Page']['from']) && !isset($this->data['Page']['to'])){
				$dastas['exported'] = 1;
				$this->Transaction->updateAll($dastas,array('exported'=>0));
			 }
			
			$header_row = array("NOME","MORADA", "LOCALIDADE","CODIGO POSTAL","CONTRIBUINTE","PAIS CONTRIBUINTE", "PAIS ORIGEM","NUMERO","DATA","REFERENCIA","DESIGNACAO","QUANTIDADE","VALOR UNITARIO","TAXA IVA");
			
			
			 fprintf($csv_file, chr(0xEF).chr(0xBB).chr(0xBF));
			 fputcsv($csv_file,$header_row,',',' ');

			// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
			foreach($results as $result)
			{
				// Array indexes correspond to the field names in your db table(s)
				$row = array(
					(str_replace( ',', '', (isset($result['Transaction']['username'])?$result['Transaction']['username']:'') )),
					(str_replace( ',', '', (isset($result['Transaction']['address'])?$result['Transaction']['address']:'') )),
					(str_replace( ',', '', (isset($result['Transaction']['city'])?$result['Transaction']['city']:'') )),
					str_replace( ',', '', (isset($result['Transaction']['zipcode'])?$result['Transaction']['zipcode']:'') ),
					str_replace( ',', '', (isset($result['Transaction']['nif'])?$result['Transaction']['nif']:'') ),
					(str_replace( ',', '', (isset($result['Transaction']['country_initials'])?$result['Transaction']['country_initials']:'') )),
					str_replace( ',', '', (isset($result['Transaction']['country_origin'])?$result['Transaction']['country_origin']:'') ),
					$result['Transaction']['order_id'],
					(date('d-m-Y',strtotime($result['Transaction']['created']))),
					(isset($result['Transaction']['reference_code']) ? $result['Transaction']['reference_code'] : ''),
					(str_replace( '"', '', str_replace( ',', '', (isset($result['Transaction']['service_description']) ? $result['Transaction']['service_description'] : '') ))),
					($result['Transaction']['quantity'] ? $result['Transaction']['quantity'] : 1),
					$result['Transaction']['price'],
					rtrim(Configure::read('Iva.iva'),'%')
				);

				 fputcsv($csv_file,$row,','," ");
			}
			//pr($results); die;
			 fclose($csv_file);
			die;
	}
	
	function get_reference($type,$type_id){
		$reference	=	"";
		switch($type){
			case "highlight":
				switch($type_id){
					case 1:
						$reference	=	Configure::read('reference.homepage');
						break;
					case 2:
						$reference	=	Configure::read('reference.alwaysontop');
						break;
					case 3:
						$reference	=	Configure::read('reference.gobacktotop');
						break;
					case 4:
						$reference	=	Configure::read('reference.differentbackcolor');
						break;
				}
				break;
			case "activate":
				$reference	=	Configure::read('reference.activate_references');
				break;
			
		}
		return $reference;
	}
	function get_description($type,$type_id){
		$reference	=	"";
		switch($type){
			case "highlight":
				switch($type_id){
					case 1:
						$reference	=	Configure::read('reference.homepage_description');
						break;
					case 2:
						$reference	=	Configure::read('reference.alwaysontop_description');
						break;
					case 3:
						$reference	=	Configure::read('reference.gobacktotop_description');
						break;
					case 4:
						$reference	=	Configure::read('reference.differentbackcolor_description');
						break;
				}
				break;
			case "activate":
				
						$reference	=	Configure::read('reference.activate_description');
					
				break;
			
		}
		return $reference;
	}
	
	
}
