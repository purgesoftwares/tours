<?php
class ReportsController  extends ReportAppController  {
	
	
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Reports';
	
/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form', 'Session', 'Time','Fck');

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
		array('field' => 'name', 'type' => 'value')
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
		
		
		$dropdown_type=__('Reports');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		//Configure::write("debug",2);
		$this->loadModel("Transaction");
		$first_transaction = $this->Transaction->find('first',array('order'=>'id asc','limit'=>1));
		$last_transaction = $this->Transaction->find('first',array('order'=>'id desc','limit'=>1));
		$first_date = explode('-',$first_transaction["Transaction"]['payment_date']);
		$last_date = explode('-',$last_transaction["Transaction"]['payment_date']);
		if(!isset($first_date[2])){
			$first_date = explode('/',$first_transaction["Transaction"]['payment_date']);
		}
		if(!isset($first_date[2])){
			$first_date[2] = date('Y');
		}
		if(!isset($last_date[2])){
			$last_date = explode('/',$last_transaction["Transaction"]['payment_date']);
		}
		if(!isset($last_date[2])){
			$last_date[2] = date('Y');
		}
		$avail_years = array();
		for($i= $first_date[2]; $i<=$last_date[2];$i++){
			$avail_years[] = $i;
		} 
		// pr($last_date); //die;
		// pr($avail_years); //die;
		// pr($first_date); die;
		$avail_quaters = array();
		for($i= 1; $i<=(ceil(date('m')/3));$i++){
			$avail_quaters[] = $i;
		}
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September',10=>'October',11=>'November',12=>'December');
		$avail_months = array();
		for($i= 1; $i<=date('m');$i++){
			$avail_months[$i] = $months[$i];
		}
		

		$this->set('avail_months',$avail_months);
		$this->set('avail_quaters',$avail_quaters);
		$this->set('avail_years',$avail_years); 
		
		
		$pageHeading	=	"Payment Report";
		$this->set('pageHeading',$pageHeading);
		
		
		if(!empty($this->data)){
			
			// pr($this->data);
			switch($this->data["Transaction"]["range"]){
				case 0:
				$data = $this->get_month_data($months[$this->data["Transaction"]["month"]]);
				$this->set("chart_title",$months[$this->data["Transaction"]["month"]]." ".date("Y")." Report");
				$this->set("range",'month');
				break;
				case 1:
				$data = $this->get_quarter_data($this->data["Transaction"]["quarter"]);
				$this->set("chart_title",date("Y")." Quarter ".$this->data["Transaction"]["quarter"]." Report");
				$this->set("range",'quarter');
				break;
				case 2:
				$data = $this->get_year_data($this->data["Transaction"]["year"]);
				$this->set("chart_title",$this->data["Transaction"]["year"]." Year Report");
				$this->set("range",'year');
				break;
				default:
				$data = $this->get_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				
			} 
			// pr($data);
			// die;
			
		}else{
			$data = $this->get_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				$this->request->data["Transaction"]["month"] = date('m');
		}
		$this->set('results',$data);
		
	}
	
	public function export_transaction_report() {
		
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September',10=>'October',11=>'November',12=>'December');
		
		if(!empty($this->data)){
			
			// pr($this->data);
			switch($this->data["Transaction"]["range"]){
				case 0:
				$data = $this->get_month_data($months[$this->data["Transaction"]["month"]]);
				$this->set("chart_title",$months[$this->data["Transaction"]["month"]]." ".date("Y")." Report");
				$this->set("range",'month');
				break;
				case 1:
				$data = $this->get_quarter_data($this->data["Transaction"]["quarter"]);
				$this->set("chart_title",date("Y")." Quarter ".$this->data["Transaction"]["quarter"]." Report");
				$this->set("range",'quarter');
				break;
				case 2:
				$data = $this->get_year_data($this->data["Transaction"]["year"]);
				$this->set("chart_title",$this->data["Transaction"]["year"]." Year Report");
				$this->set("range",'year');
				break;
				default:
				$data = $this->get_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				
			} 
			// pr($data);
			// die;
			
		}else{
			$data = $this->get_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
		}
		
		
		$this->layout	= false;
		$header = array(__('Invoice Date'),__('Client'),__('Invoice Title'),__('Subtotal'),__('Sales Tax'),__('Grand Total'),__('Payment Method'),__('Date Range'));
			$results = $data;
			$data = array();
			if( !empty($results) ) {
					$i =  1; 	
					foreach( $results as $date_range=>$result ) { 
						if( !empty($result) ) {
							foreach( $result as $records ) { 
								
								$data[$i]['invoice_date']		=	$records["Transaction"]['payment_date'];
								$data[$i]['client']		=	$records["Invoice"]["Client"]['first_name'].' '.$records["Invoice"]["Client"]['last_name'];
								$data[$i]['invoice_title']		=	$records["Invoice"]['title'];
								$data[$i]['subtotal']		=	$records["Invoice"]['payment'];
								$data[$i]['sales_tax']		=	$records["Invoice"]['tax'];
								$data[$i]['grand_total']		=	$records["Invoice"]['total'];
								$data[$i]['payment_method']		=	$records["Transaction"]['method'];
								$data[$i]['date_range']	=	$date_range;
							
							$i++;
							}
						}
					}
				} 
										
										
			
			$this->export_file($header,$data,'csv');
		exit;
		
		
		// $this->set('results',$data);
		
	}
	
	public function get_month_data($month = "January", $year = 2015){
		
		/* if($month=="January")
		$month = date('F'); */
		/* if($year==2015)
		$year = date('y'); */
		// echo date( 'F Y');
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Transaction.Transaction");
		$month_first_day = strtotime( 'first day of ' . $month.' '.$year);
		$month_last_day = strtotime( 'last day of ' . $month.' '.$year);
		// echo date('Y-m-d',$month_last_day);
		// $dt = new DateTime('first Monday of this month');
		$dt = new DateTime('first Monday of '.$month.' '.$year);
		// echo $dt->format('Y-m-d');
		$first_week_start =  $dt->getTimestamp(); 
		$week_last = $first_week_start;
		$this->Invoice->belongsTo = array('Client' => array('className'=>"Usermgmt.Client",'foreignKey'=>'client_id'));
		$this->Transaction->belongsTo = array('Invoice' => array('className'=>"Invoice.Invoice",'foreignKey'=>'invoice_id'));
		$this->Transaction->recursive = 2;
		$this->Transaction->Behaviors->load('Containable');
		
		$all_transactoins = array();
		for($current =$month_first_day; ($week_last<$month_last_day && $week_last<time());  $week_last += (7*86400)){
			
				$transactions = $this->Transaction->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$current,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$week_last,'Transaction.status'=>1),'contain'=>array("Invoice"=>array("fields"=>array("title","client_id","payment","tax","total")),"Invoice.Client"=>array("fields"=>array("first_name","last_name"))),"fields"=>array("invoice_id","payment_date","method")));
				
				$all_transactoins[date('m/d/Y',$current).'-'.date('m/d/Y',$week_last)] = $transactions;
				
				// pr($transactions); die;
			
			$current =$week_last;
		}
		return $all_transactoins;
		
	}
	
	public function get_quarter_data($quarter = 0,$year=0){
		
		
		if(!$year) $year=date("Y");
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Transaction.Transaction");
		$this->Invoice->belongsTo = array('Client' => array('className'=>"Usermgmt.Client",'foreignKey'=>'client_id'));
		$this->Transaction->belongsTo = array('Invoice' => array('className'=>"Invoice.Invoice",'foreignKey'=>'invoice_id'));
		$this->Transaction->recursive = 2;
		$this->Transaction->Behaviors->load('Containable');
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		$quarter_first_month = (3*($quarter))+1;
		$quarter_last_month = (3*($quarter+1));
		
		$current_month = $quarter_first_month;
		$all_transactoins = array();
		
		while($current_month<=$quarter_last_month){
		
			$dt = new DateTime('first day of '.$months[$current_month].' '.$year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of '.$months[$current_month].' '.$year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			
		
				$transactions = $this->Transaction->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$month_end,'Transaction.status'=>1),'contain'=>array("Invoice"=>array("fields"=>array("title","client_id","payment","tax","total")),"Invoice.Client"=>array("fields"=>array("first_name","last_name"))),"fields"=>array("invoice_id","payment_date","method")));
				
				$all_transactoins[date('m/d/Y',$month_start)] = $transactions;
				
				// pr($transactions); die;
			
			$current_month++;
		
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	public function get_year_data($year=0){
		
		
		if(!$year) $year=date("Y");
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Transaction.Transaction");
		$this->Invoice->belongsTo = array('Client' => array('className'=>"Usermgmt.Client",'foreignKey'=>'client_id'));
		$this->Transaction->belongsTo = array('Invoice' => array('className'=>"Invoice.Invoice",'foreignKey'=>'invoice_id'));
		$this->Transaction->recursive = 2;
		$this->Transaction->Behaviors->load('Containable');
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		
		$all_transactoins = array();
		
		foreach($months as $month=>$month_name){
		
			$dt = new DateTime('first day of '.$month_name.' '.$year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of '.$month_name.' '.$year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			if($year==date("Y") && $month>date('m')) break;
		
				$transactions = $this->Transaction->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$month_end,'Transaction.status'=>1),'contain'=>array("Invoice"=>array("fields"=>array("title","client_id","payment","tax","total")),"Invoice.Client"=>array("fields"=>array("first_name","last_name"))),"fields"=>array("invoice_id","payment_date","method")));
				
				$all_transactoins[$month_name] = $transactions;
				
				// pr($transactions); die;
			
			
		
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	
	
	public function photographer_payments() {
		
		
		$dropdown_type=__('Reports');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		$this->loadModel("Transaction");
		$first_transaction = $this->Transaction->find('first',array('order'=>'id asc','limit'=>1));
		$last_transaction = $this->Transaction->find('first',array('order'=>'id desc','limit'=>1));
		$first_date = explode('-',$first_transaction["Transaction"]['payment_date']);
		$last_date = explode('-',$last_transaction["Transaction"]['payment_date']);
		$avail_years = array();
		// pr($first_date);
		if(!isset($first_date[2])){
			$first_date = explode('/',$first_transaction["Transaction"]['payment_date']);
		}
		if(!isset($first_date[2])){
			$first_date[2] = date('Y');
		}
		if(!isset($last_date[2])){
			$last_date = explode('/',$last_transaction["Transaction"]['payment_date']);
		}
		if(!isset($last_date[2])){
			$last_date[2] = date('Y');
		}
		
		for($i= $first_date[2]; $i<=$last_date[2];$i++){
			$avail_years[] = $i;
		} 
		$avail_quaters = array();
		for($i= 1; $i<=(ceil(date('m')/3));$i++){
			$avail_quaters[] = $i;
		}
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September',10=>'October',11=>'November',12=>'December');
		$avail_months = array();
		for($i= 1; $i<=date('m');$i++){
			$avail_months[$i] = $months[$i];
		}
		$this->loadModel("Usermgmt.Photographer");
		$photographers = $this->Photographer->find('list',array('fields'=>array('id','first_name'),'conditions'=>array("user_role_id"=>Configure::read('user_roles.photographer'))));
		// pr($photographers); die;
		$this->set('photographers',$photographers);
		$this->set('avail_months',$avail_months);
		$this->set('avail_quaters',$avail_quaters);
		$this->set('avail_years',$avail_years); 
		
		
		$pageHeading	=	"Photographer Payments Report";
		$this->set('pageHeading',$pageHeading);
		
		
		if(!empty($this->data)){
			
			// pr($this->data);
			switch($this->data["Transaction"]["range"]){
				case 0:
				$data = $this->get_photographer_payments_month_data($months[$this->data["Transaction"]["month"]],date('Y'),$this->data["Transaction"]["photographer"]);
				$this->set("chart_title",$months[$this->data["Transaction"]["month"]]." ".date("Y")." Report");
				$this->set("range",'month');
				break;
				case 1:
				$data = $this->get_photographer_payments_quarter_data($this->data["Transaction"]["quarter"],date('Y'),$this->data["Transaction"]["photographer"]);
				$this->set("chart_title",date("Y")." Quarter ".$this->data["Transaction"]["quarter"]." Report");
				$this->set("range",'quarter');
				break;
				case 2:
				$data = $this->get_photographer_payments_year_data($this->data["Transaction"]["year"],$this->data["Transaction"]["photographer"]);
				$this->set("chart_title",$this->data["Transaction"]["year"]." Year Report");
				$this->set("range",'year');
				break;
				default:
				$data = $this->get_photographer_payments_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				
			} 
			// pr($data);
			// die;
			
		}else{
			$data = $this->get_photographer_payments_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				$this->request->data["Transaction"]["month"] = date('m');
		}
		$this->set('results',$data);
		
	}
	
	public function export_photographer_payments_report() {
		
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September',10=>'October',11=>'November',12=>'December');
		
		if(!empty($this->data)){
			
			// pr($this->data);
			switch($this->data["Transaction"]["range"]){
				case 0:
				$data = $this->get_photographer_payments_month_data($months[$this->data["Transaction"]["month"]],date('Y'),json_decode($this->data["Transaction"]["photographer"],true));
				$this->set("chart_title",$months[$this->data["Transaction"]["month"]]." ".date("Y")." Report");
				$this->set("range",'month');
				break;
				case 1:
				$data = $this->get_photographer_payments_quarter_data($this->data["Transaction"]["quarter"],date('Y'),json_decode($this->data["Transaction"]["photographer"],true));
				$this->set("chart_title",date("Y")." Quarter ".$this->data["Transaction"]["quarter"]." Report");
				$this->set("range",'quarter');
				break;
				case 2:
				$data = $this->get_photographer_payments_year_data($this->data["Transaction"]["year"],json_decode($this->data["Transaction"]["photographer"],true));
				$this->set("chart_title",$this->data["Transaction"]["year"]." Year Report");
				$this->set("range",'year');
				break;
				default:
				$data = $this->get_photographer_payments_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				
			} 
			// pr($data);
			// die;
			
		}else{
			$data = $this->get_photographer_payments_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
		}
		
		
		$this->layout	= false;
		$header = array(__('Photographer Name'),__('Date of Shoot'),__('Shoot Title'),__('Payment Amount'));
			$results = $data;
			$data = array();
			if( !empty($results) ) {
					$i =  1; 	
					foreach( $results as $date_range=>$result ) { 
						if( !empty($result) ) {
							foreach( $result as $records ) { 
								if(!empty($records["Invoice"])){
									$subtotal = 0;
									foreach($records["Invoice"] as $invoice ) { 
									// pr($invoice); die;
									$subtotal += $invoice["Shoot"]['payment'];
									
										$data[$i]['photographer_name']	=	$records["Photographer"]['first_name'].' '.$records["Photographer"]['last_name'];
										$data[$i]['date_of_shoot']		=	$invoice["Shoot"]["date"];
										$data[$i]['shoot_title']		=	$invoice["Shoot"]["title"];
										$data[$i]['payment']			=	$invoice["Shoot"]["payment"];
										
										$i++;
									}
										$data[$i]['photographer_name']	=	"";
										$data[$i]['date_of_shoot']		=	"";
										$data[$i]['shoot_title']		=	"Subtotal";
										$data[$i]['payment']			=	$subtotal;
										$i++;
								}
							
							}
						}
					}
				} 
										
										
			
			$this->export_file($header,$data,'csv');
		exit;
		
		
		// $this->set('results',$data);
		
	}
	
	public function get_photographer_payments_month_data($month = "January", $year = 2015, $photographers= array()){
		
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Usermgmt.Photographer");
		$this->loadModel("Transaction");
		$this->Photographer->hasMany = array(
										'Invoice' => array('className'=>"Invoice.Invoice",'foreignKey'=>'photographer_id')
										);
		$this->Invoice->belongsTo = array(
										'Shoot' => array('className'=>"Shoot.Shoot",'foreignKey'=>'shoot_id')
										);
		$this->Invoice->hasMany = array(
										'Transaction' => array('className'=>"Transaction.Transaction",'foreignKey'=>'invoice_id')
										);
		
		$this->Photographer->Behaviors->load('Containable');
		$this->Photographer->recursive = 3;
		
		$month_first_day = strtotime( 'first day of ' . $month.' '.$year);
		$month_last_day = strtotime( 'last day of ' . $month.' '.$year);
		
		$dt = new DateTime('first Monday of '.$month.' '.$year);
		
		$first_week_start =  $dt->getTimestamp(); 
		$week_last = $first_week_start;
		
		$all_transactoins = array();
		for($current =$month_first_day; ($week_last<$month_last_day && $week_last<time());  $week_last += (7*86400)){
			
				
				$invoice_ids = $this->Transaction->find('list',array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$current,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$week_last,'Transaction.status'=>1),'fields'=>array('invoice_id')));
				// pr($invoice_ids); die;
				$conditions = array("user_role_id"=>Configure::read('user_roles.photographer'));
				$iconditions = array();
				
				$iconditions = array("Invoice.id"=>$invoice_ids);
				
				if(!empty($photographers))
				$conditions["Photographer.id"] = $photographers;
				// pr($conditions);
				
				$transactions = $this->Photographer->find("all",array("conditions"=>$conditions,'contain'=>array("Invoice"=>array("fields"=>array("title","photographer_id","payment","tax","total"),'conditions'=>$iconditions),"Invoice.Shoot"=>array("fields"=>array("title",'payment','date')),"Invoice.Transaction"=>array("fields"=>array("payment_date","paid",'status'))),"fields"=>array("first_name","last_name","id")));
				
				if(!empty($transactions)){
					foreach($transactions as $key=>$transaction){
						if(empty($transaction["Invoice"])){
							unset($transactions[$key]);
						}
					}
				}
				
				$all_transactoins[date('m/d/Y',$current).'-'.date('m/d/Y',$week_last)] = $transactions;
				
			
			$current =$week_last;
		}
				// pr($all_transactoins); die;
		
		return $all_transactoins;
		
	}
	
	public function get_photographer_payments_quarter_data($quarter = 0,$year=0, $photographers= array()){
		
		
		if(!$year) $year=date("Y");
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Usermgmt.Photographer");
		$this->loadModel("Transaction");
		$this->Photographer->hasMany = array(
										'Invoice' => array('className'=>"Invoice.Invoice",'foreignKey'=>'photographer_id')
										);
		$this->Invoice->belongsTo = array(
										'Shoot' => array('className'=>"Shoot.Shoot",'foreignKey'=>'shoot_id')
										);
		$this->Invoice->hasMany = array(
										'Transaction' => array('className'=>"Transaction.Transaction",'foreignKey'=>'invoice_id')
										);
		
		$this->Photographer->Behaviors->load('Containable');
		$this->Photographer->recursive = 3;
		
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		$quarter_first_month = (3*($quarter))+1;
		$quarter_last_month = (3*($quarter+1));
		
		$current_month = $quarter_first_month;
		$all_transactoins = array();
		
		while($current_month<=$quarter_last_month){
		
			$dt = new DateTime('first day of '.$months[$current_month].' '.$year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of '.$months[$current_month].' '.$year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			
		
				$invoice_ids = $this->Transaction->find('list',array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$month_end,'Transaction.status'=>1),'fields'=>array('invoice_id')));
				// pr($transaction_ids); die;
				$conditions = array("user_role_id"=>Configure::read('user_roles.photographer'));
				$iconditions = array();
				
				$iconditions = array("Invoice.id"=>$invoice_ids);
				
				if(!empty($photographers))
				$conditions["Photographer.id"] = $photographers;
				
				$transactions = $this->Photographer->find("all",array("conditions"=>$conditions,'contain'=>array("Invoice"=>array("fields"=>array("title","photographer_id","payment","tax","total"),'conditions'=>$iconditions),"Invoice.Shoot"=>array("fields"=>array("title",'payment','date')),"Invoice.Transaction"=>array("fields"=>array("payment_date","paid",'status'))),"fields"=>array("first_name","last_name","id")));
				
				if(!empty($transactions)){
					foreach($transactions as $key=>$transaction){
						if(empty($transaction["Invoice"])){
							unset($transactions[$key]);
						}
					}
				}
				
				$all_transactoins[date('m/d/Y',$month_start)] = $transactions;
				
				// pr($transactions); die;
			
			$current_month++;
		
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	public function get_photographer_payments_year_data($year=0, $photographers= array()){
		
		
		if(!$year) $year=date("Y");
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Usermgmt.Photographer");
		$this->loadModel("Transaction");
		$this->Photographer->hasMany = array(
										'Invoice' => array('className'=>"Invoice.Invoice",'foreignKey'=>'photographer_id')
										);
		$this->Invoice->belongsTo = array(
										'Shoot' => array('className'=>"Shoot.Shoot",'foreignKey'=>'shoot_id')
										);
		$this->Invoice->hasMany = array(
										'Transaction' => array('className'=>"Transaction.Transaction",'foreignKey'=>'invoice_id')
										);
		
		$this->Photographer->Behaviors->load('Containable');
		$this->Photographer->recursive = 3;
		
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		
		$all_transactoins = array();
		
		foreach($months as $month=>$month_name){
		
			$dt = new DateTime('first day of '.$month_name.' '.$year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of '.$month_name.' '.$year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			if($year==date("Y") && $month>date('m')) break;
		
				$invoice_ids = $this->Transaction->find('list',array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$month_end,'Transaction.status'=>1),'fields'=>array('invoice_id')));
				// pr($transaction_ids); die;
				$conditions = array("user_role_id"=>Configure::read('user_roles.photographer'));
				$iconditions = array();
				
				$iconditions = array("Invoice.id"=>$invoice_ids);
				
				if(!empty($photographers))
				$conditions["Photographer.id"] = $photographers;
				
				$transactions = $this->Photographer->find("all",array("conditions"=>$conditions,'contain'=>array("Invoice"=>array("fields"=>array("title","photographer_id","payment","tax","total"),'conditions'=>$iconditions),"Invoice.Shoot"=>array("fields"=>array("title",'payment','date')),"Invoice.Transaction"=>array("fields"=>array("payment_date","paid",'status'))),"fields"=>array("first_name","last_name","id")));
				
				if(!empty($transactions)){
					foreach($transactions as $key=>$transaction){
						if(empty($transaction["Invoice"])){
							unset($transactions[$key]);
						}
					}
				}
				
				$all_transactoins[$month_name] = $transactions;
				
				// pr($transactions); die;
			
			
		
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	
	
	//Editor Payments
	public function editor_payments() {
		
		
		$dropdown_type=__('Reports');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		$this->loadModel("Transaction");
		$first_transaction = $this->Transaction->find('first',array('order'=>'id asc','limit'=>1));
		$last_transaction = $this->Transaction->find('first',array('order'=>'id desc','limit'=>1));
		$first_date = explode('-',$first_transaction["Transaction"]['payment_date']);
		$last_date = explode('-',$last_transaction["Transaction"]['payment_date']);
		$avail_years = array();
		if(!isset($first_date[2])){
			$first_date = explode('/',$first_transaction["Transaction"]['payment_date']);
		}
		if(!isset($first_date[2])){
			$first_date[2] = date('Y');
		}
		if(!isset($last_date[2])){
			$last_date = explode('/',$last_transaction["Transaction"]['payment_date']);
		}
		if(!isset($last_date[2])){
			$last_date[2] = date('Y');
		}
		// pr($first_date);
		for($i= $first_date[2]; $i<=$last_date[2];$i++){
			$avail_years[] = $i;
		} 
		$avail_quaters = array();
		for($i= 1; $i<=(ceil(date('m')/3));$i++){
			$avail_quaters[] = $i;
		}
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September',10=>'October',11=>'November',12=>'December');
		$avail_months = array();
		for($i= 1; $i<=date('m');$i++){
			$avail_months[$i] = $months[$i];
		}
		

		$this->set('avail_months',$avail_months);
		$this->set('avail_quaters',$avail_quaters);
		$this->set('avail_years',$avail_years); 
		
		
		$pageHeading	=	"Editor Payments Report";
		$this->set('pageHeading',$pageHeading);
		
		
		if(!empty($this->data)){
			
			// pr($this->data);
			switch($this->data["Transaction"]["range"]){
				case 0:
				$data = $this->get_editor_payments_month_data($months[$this->data["Transaction"]["month"]]);
				$this->set("chart_title",$months[$this->data["Transaction"]["month"]]." ".date("Y")." Report");
				$this->set("range",'month');
				break;
				case 1:
				$data = $this->get_editor_payments_quarter_data($this->data["Transaction"]["quarter"]);
				$this->set("chart_title",date("Y")." Quarter ".$this->data["Transaction"]["quarter"]." Report");
				$this->set("range",'quarter');
				break;
				case 2:
				$data = $this->get_editor_payments_year_data($this->data["Transaction"]["year"]);
				$this->set("chart_title",$this->data["Transaction"]["year"]." Year Report");
				$this->set("range",'year');
				break;
				default:
				$data = $this->get_editor_payments_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				
			} 
			// pr($data);
			// die;
			
		}else{
			$data = $this->get_editor_payments_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				$this->request->data["Transaction"]["month"] = date('m');
		}
		$this->set('results',$data);
		
	}
	
	public function export_editor_payments_report() {
		
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September',10=>'October',11=>'November',12=>'December');
		
		if(!empty($this->data)){
			
			// pr($this->data);
			switch($this->data["Transaction"]["range"]){
				case 0:
				$data = $this->get_editor_payments_month_data($months[$this->data["Transaction"]["month"]]);
				$this->set("chart_title",$months[$this->data["Transaction"]["month"]]." ".date("Y")." Report");
				$this->set("range",'month');
				break;
				case 1:
				$data = $this->get_editor_payments_quarter_data($this->data["Transaction"]["quarter"]);
				$this->set("chart_title",date("Y")." Quarter ".$this->data["Transaction"]["quarter"]." Report");
				$this->set("range",'quarter');
				break;
				case 2:
				$data = $this->get_editor_payments_year_data($this->data["Transaction"]["year"]);
				$this->set("chart_title",$this->data["Transaction"]["year"]." Year Report");
				$this->set("range",'year');
				break;
				default:
				$data = $this->get_editor_payments_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				
			} 
			// pr($data);
			// die;
			
		}else{
			$data = $this->get_editor_payments_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
		}
		
		
		$this->layout	= false;
		$header = array(__('Shoot Date'),__('Shoot Title'),__('Editing Time'));
			$results = $data;
			$data = array();
			if( !empty($results) ) {
					$i =  1; 	
					foreach( $results as $date_range=>$result ) { 
						if( !empty($result) ) {
						$subtotal = 0;
							foreach( $result as $records ) { 
							$subtotal += $records["Shoot"]['editing_time'];
								
								$data[$i]['shoot_date']				=	$records["Shoot"]['date'];
								$data[$i]['shoot_title']			=	$records["Shoot"]['title'];
								$data[$i]['shoot_editing_time']		=	$records["Shoot"]['editing_time'];
								
							$i++;
							}
							
							$data[$i]['shoot_date']				=	'';
								$data[$i]['shoot_title']			=	"Subtotal";
								$data[$i]['shoot_editing_time']		=	$subtotal;
								
							$i++;
							
						}
					}
				} 
										
										
			
			$this->export_file($header,$data,'csv');
		exit;
		
		
		// $this->set('results',$data);
		
	}
	
	public function get_editor_payments_month_data($month = "January", $year = 2015){
		
		
		$this->loadModel("Shoot.Shoot");
		
		$month_first_day = strtotime( 'first day of ' . $month.' '.$year);
		$month_last_day = strtotime( 'last day of ' . $month.' '.$year);
		
		$dt = new DateTime('first Monday of '.$month.' '.$year);
		
		$first_week_start =  $dt->getTimestamp(); 
		$week_last = $first_week_start;
		
		$all_transactoins = array();
		for($current =$month_first_day; ($week_last<$month_last_day && $week_last<time());  $week_last += (7*86400)){
			
				$transactions = $this->Shoot->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Shoot.date, '%m-%d-%Y')) >"=>$current,"UNIX_TIMESTAMP(STR_TO_DATE(Shoot.date, '%m-%d-%Y')) <"=>$week_last,'Shoot.status'=>4),"fields"=>array('id',"date",'status','title','editing_time')));
				
				$all_transactoins[date('m/d/Y',$current).'-'.date('m/d/Y',$week_last)] = $transactions;
				
				// pr($transactions); die;
			
			$current =$week_last;
		}
		return $all_transactoins;
		
	}
	
	public function get_editor_payments_quarter_data($quarter = 0,$year=0){
		
		
		if(!$year) $year=date("Y");
		
		$this->loadModel("Shoot.Shoot");
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		$quarter_first_month = (3*($quarter))+1;
		$quarter_last_month = (3*($quarter+1));
		
		$current_month = $quarter_first_month;
		$all_transactoins = array();
		
		while($current_month<=$quarter_last_month){
		
			$dt = new DateTime('first day of '.$months[$current_month].' '.$year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of '.$months[$current_month].' '.$year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			
				$transactions = $this->Shoot->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Shoot.date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Shoot.date, '%m-%d-%Y')) <"=>$month_end,'Shoot.status'=>4),"fields"=>array('id',"date",'status','title','editing_time')));
				
				
				$all_transactoins[date('m/d/Y',$month_start)] = $transactions;
				
				// pr($transactions); die;
			
			$current_month++;
		
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	public function get_editor_payments_year_data($year=0){
		
		
		if(!$year) $year=date("Y");
		
		$this->loadModel("Shoot.Shoot");
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		
		$all_transactoins = array();
		
		foreach($months as $month=>$month_name){
		
			$dt = new DateTime('first day of '.$month_name.' '.$year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of '.$month_name.' '.$year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			if($year==date("Y") && $month>date('m')) break;
		
				$transactions = $this->Shoot->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Shoot.date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Shoot.date, '%m-%d-%Y')) <"=>$month_end,'Shoot.status'=>4),"fields"=>array('id',"date",'status','title','editing_time')));
				
				$all_transactoins[$month_name] = $transactions;
				
				// pr($transactions); die;
			
			
		
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	
	
	//Sales Report
	
	public function sales_report() {
		
		
		$dropdown_type=__('Reports');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		$this->loadModel("Transaction");
		$first_transaction = $this->Transaction->find('first',array('order'=>'id asc','limit'=>1));
		$last_transaction = $this->Transaction->find('first',array('order'=>'id desc','limit'=>1));
		$first_date = explode('-',$first_transaction["Transaction"]['payment_date']);
		$last_date = explode('-',$last_transaction["Transaction"]['payment_date']);
		$avail_years = array();
		if(!isset($first_date[2])){
			$first_date = explode('/',$first_transaction["Transaction"]['payment_date']);
		}
		if(!isset($first_date[2])){
			$first_date[2] = date('Y');
		}
		if(!isset($last_date[2])){
			$last_date = explode('/',$last_transaction["Transaction"]['payment_date']);
		}
		if(!isset($last_date[2])){
			$last_date[2] = date('Y');
		}
		// pr($first_date);
		for($i= $first_date[2]; $i<=$last_date[2];$i++){
			$avail_years[] = $i;
		} 
		$avail_quaters = array();
		for($i= 1; $i<=(ceil(date('m')/3));$i++){
			$avail_quaters[] = $i;
		}
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September',10=>'October',11=>'November',12=>'December');
		$avail_months = array();
		for($i= 1; $i<=date('m');$i++){
			$avail_months[$i] = $months[$i];
		}
		

		$this->set('avail_months',$avail_months);
		$this->set('avail_quaters',$avail_quaters);
		$this->set('avail_years',$avail_years); 
		
		
		$pageHeading	=	"Sales Report";
		$this->set('pageHeading',$pageHeading);
		
		
		if(!empty($this->data)){
			
			// pr($this->data);
			switch($this->data["Transaction"]["range"]){
				case 0:
				$data = $this->get_sales_report_month_data($months[$this->data["Transaction"]["month"]]);
				$this->set("chart_title",$months[$this->data["Transaction"]["month"]]." ".date("Y")." Report");
				$this->set("range",'month');
				break;
				case 1:
				$data = $this->get_sales_report_quarter_data($this->data["Transaction"]["quarter"]);
				$this->set("chart_title",date("Y")." Quarter ".$this->data["Transaction"]["quarter"]." Report");
				$this->set("range",'quarter');
				break;
				case 2:
				$data = $this->get_sales_report_year_data($this->data["Transaction"]["year"]);
				$this->set("chart_title",$this->data["Transaction"]["year"]." Year Report");
				$this->set("range",'year');
				break;
				case 3:
				$data = $this->get_sales_report_last12_data();
				$this->set("chart_title","Last 12 Months Report");
				$this->set("range",'last12');
				break;
				case 4:
				$data = $this->get_sales_report_alltime_data($avail_years);
				$this->set("chart_title","All Time Sales Report");
				$this->set("range",'last12');
				break;
				default:
				$data = $this->get_sales_report_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				
			} 
			// pr($data);
			// die;
			
		}else{
			$data = $this->get_sales_report_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				$this->request->data["Transaction"]["month"] = date('m');
		}
		$this->set('results',$data);
		
	}
	
	public function export_sales_report_report() {
		
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September',10=>'October',11=>'November',12=>'December');
		
		if(!empty($this->data)){
			
			// pr($this->data);
			switch($this->data["Transaction"]["range"]){
				case 0:
				$data = $this->get_sales_report_month_data($months[$this->data["Transaction"]["month"]]);
				$this->set("chart_title",$months[$this->data["Transaction"]["month"]]." ".date("Y")." Report");
				$this->set("range",'month');
				break;
				case 1:
				$data = $this->get_sales_report_quarter_data($this->data["Transaction"]["quarter"]);
				$this->set("chart_title",date("Y")." Quarter ".$this->data["Transaction"]["quarter"]." Report");
				$this->set("range",'quarter');
				break;
				case 2:
				$data = $this->get_sales_report_year_data($this->data["Transaction"]["year"]);
				$this->set("chart_title",$this->data["Transaction"]["year"]." Year Report");
				$this->set("range",'year');
				break;
				case 3:
				$data = $this->get_sales_report_last12_data();
				$this->set("chart_title","Last 12 Months Report");
				$this->set("range",'last12');
				break;
				case 4:
				$this->loadModel("Transaction");
					$first_transaction = $this->Transaction->find('first',array('order'=>'id asc','limit'=>1));
					$last_transaction = $this->Transaction->find('first',array('order'=>'id desc','limit'=>1));
					$first_date = explode('-',$first_transaction["Transaction"]['payment_date']);
					$last_date = explode('-',$last_transaction["Transaction"]['payment_date']);
					$avail_years = array();
					if(!isset($first_date[2])){
							$first_date = explode('/',$first_transaction["Transaction"]['payment_date']);
						}
						if(!isset($first_date[2])){
							$first_date[2] = date('Y');
						}
						if(!isset($last_date[2])){
							$last_date = explode('/',$last_transaction["Transaction"]['payment_date']);
						}
						if(!isset($last_date[2])){
							$last_date[2] = date('Y');
						}
					// pr($first_date);
					for($i= $first_date[2]; $i<=$last_date[2];$i++){
						$avail_years[] = $i;
					} 
					
				$data = $this->get_sales_report_alltime_data($avail_years);
				$this->set("chart_title","All Time Sales Report");
				$this->set("range",'last12');
				break;
				default:
				$data = $this->get_sales_report_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				
			} 
			// pr($data);
			// die;
			
		}else{
			$data = $this->get_sales_report_month_data($months[date('m')]);
				$this->set("chart_title",$months[date('m')]." ".date("Y")." Report");
				$this->set("range",'month');
				$this->request->data["Transaction"]["month"] = date('m');
		}
		
		$this->layout	= false;
		$header = array(__('Date Range'),__('Total Sales'));
			$results = $data;
			$data = array();
			if( !empty($results) ) {
					$i =  1; 	
					foreach( $results as $date_range=>$result ) { 
						if( !empty($result) ) {
							
								$data[$i]['date_range']			=	$date_range;
								$data[$i]['total_sales']		=	(isset($result[0][0]['total_paid']) && !empty($result[0][0]['total_paid']))?$result[0][0]['total_paid']:0;
							$i++;
							
						}
					}
				} 
										
										
			
			$this->export_file($header,$data,'csv');
		exit;
		
		
		// $this->set('results',$data);
		
	}
	
	public function get_sales_report_month_data($month = "January", $year = 2015){
		
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Transaction.Transaction");
		$month_first_day = strtotime( 'first day of ' . $month.' '.$year);
		$month_last_day = strtotime( 'last day of ' . $month.' '.$year);
		
		$dt = new DateTime('first Monday of '.$month.' '.$year);
		
		$first_week_start =  $dt->getTimestamp(); 
		$week_last = $first_week_start;
		
		$all_transactoins = array();
		for($current =$month_first_day; ($week_last<$month_last_day && $week_last<time());  $week_last += (7*86400)){
			
				$transactions = $this->Transaction->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$current,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$week_last,'Transaction.status'=>1),"fields"=>array('SUM(Transaction.paid) as total_paid')));
				
				$all_transactoins[date('m/d/Y',$current).'-'.date('m/d/Y',$week_last)] = $transactions;
				
				// pr($transactions); die;
			
			$current =$week_last;
		}
		return $all_transactoins;
		
	}
	
	public function get_sales_report_quarter_data($quarter = 0,$year=0){
		
		
		if(!$year) $year=date("Y");
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Transaction.Transaction");
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		$quarter_first_month = (3*($quarter))+1;
		$quarter_last_month = (3*($quarter+1));
		
		$current_month = $quarter_first_month;
		$all_transactoins = array();
		
		while($current_month<=$quarter_last_month){
		
			$dt = new DateTime('first day of '.$months[$current_month].' '.$year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of '.$months[$current_month].' '.$year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			
		
				$transactions = $this->Transaction->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$month_end,'Transaction.status'=>1),"fields"=>array('SUM(Transaction.paid) as total_paid')));
				
				$all_transactoins[date('m/d/Y',$month_start)] = $transactions;
				
				// pr($transactions); die;
			
			$current_month++;
		
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	public function get_sales_report_year_data($year=0){
		
		
		if(!$year) $year=date("Y");
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Transaction.Transaction");
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		
		$all_transactoins = array();
		
		foreach($months as $month=>$month_name){
		
			$dt = new DateTime('first day of '.$month_name.' '.$year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of '.$month_name.' '.$year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			if($year==date("Y") && $month>date('m')) break;
		
				$transactions = $this->Transaction->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$month_end,'Transaction.status'=>1),"fields"=>array('SUM(Transaction.paid) as total_paid')));
				
				$all_transactoins[$month_name] = $transactions;
				
				// pr($transactions); die;
			
			
		
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	public function get_sales_report_last12_data(){
		
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Transaction.Transaction");
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		$current_year = date("Y");
		
		
		if(date('n')<12){
			$current_month = date('n')+1;
			$current_year = $current_year-1;
		}else{
			$current_month = 1;
		}
		
		
		$all_transactoins = array();
		
		
		for($i=1; $i<=12; $i++){
		
			$dt = new DateTime('first day of '.$months[$current_month].' '.$current_year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of '.$months[$current_month].' '.$current_year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			
		
				$transactions = $this->Transaction->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$month_end,'Transaction.status'=>1),"fields"=>array('SUM(Transaction.paid) as total_paid')));
				
				$all_transactoins[$months[$current_month].' '.$current_year] = $transactions;
				
				// pr($transactions); die;
			if($current_month==12){
				$current_month=1;
				$current_year++;
			}else{
				$current_month++;
			}
		
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	public function get_sales_report_alltime_data($avail_years=array()){
		
		
		$this->loadModel("Invoice.Invoice");
		$this->loadModel("Transaction.Transaction");
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		
		if(!empty($avail_years)){ $avail_years[0] = date("Y"); }
		
		$all_transactoins = array();
		
		
		foreach($avail_years as $current_year){
		
			$dt = new DateTime('first day of January '.$current_year);
			$month_start =  $dt->getTimestamp(); 
			$dt = new DateTime('last day of December '.$current_year);
			$month_end =  $dt->getTimestamp()+86400; 
			
			
		
				$transactions = $this->Transaction->find("all",array("conditions"=>array("UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) >"=>$month_start,"UNIX_TIMESTAMP(STR_TO_DATE(Transaction.payment_date, '%m-%d-%Y')) <"=>$month_end,'Transaction.status'=>1),"fields"=>array('SUM(Transaction.paid) as total_paid')));
				
				$all_transactoins[$current_year] = $transactions;
				
				// pr($transactions); die;
			
		}
		
		
		
		return $all_transactoins;
		
	}
	
	
	
	
	
	
	
	
	public function apply_discount() {
		
		// pr($this->data); die;
		
		if(!empty($this->data) && isset($this->data["Discount"]['discount_amount'])){
			$this->{$this->modelClass}->id = $this->data["Discount"]['report_id'];
			$discount = array();
			$discount = $this->data["Discount"];
			// pr($discount); die;
			unset($discount['report_id']);
			if($this->{$this->modelClass}->save($discount,false)){
				$this->Session->setFlash(__('Discount applied successfully.'), 'success');
				$this->redirect(array('action' => 'view',$this->{$this->modelClass}->id));
			}
		}else{
			$this->redirect($this->referer);
		}
	}
	
	public function manual_payment() {
		
		// pr($this->data); die;
		/* $this->{$this->modelClass}->belongsTo = array(
										"Client"=>array('className'=>'Usermgmt.Client','foreignKey'=>'client_id'),
										"Gallery"=>array('className'=>'Gallery','foreignKey'=>'gallery_id'),
										"Shoot"=>array('className'=>'Shoot','foreignKey'=>'shoot_id'),
										"Product"=>array('className'=>'Product.Product','foreignKey'=>'product_id')
										); */
										
		if(!empty($this->data) && isset($this->data["Payment"]['amount'])){
			$this->loadModel("Transaction");
			$transaction = array();
			$transaction['transaction_id'] = $this->data["Payment"]['transaction_id'];
			$transaction['report_id'] = $this->data["Payment"]['report_id'];
			$transaction['paid'] = $this->data["Payment"]['amount'];
			$transaction['method'] = $this->data["Payment"]['method'];
			$transaction['payment_date'] = $this->data["Payment"]['payment_date'];
			$transaction['status'] = 1;
			$this->Transaction->save($transaction,false);
			
			
										
			$this->{$this->modelClass}->id = $this->data["Payment"]['report_id'];
			$report = $this->{$this->modelClass}->read();
			
			if($this->{$this->modelClass}->save(array('paid'=>$report["Report"]['paid']+$this->data["Payment"]['amount'],'status'=>($report["Report"]['paid']+$this->data["Payment"]['amount']+$report["Report"]['discount_amount']==$report["Report"]['total'])),false)){
			
				/* Send payment success email */
				
					if($report["Report"]['paid']+$transaction['paid']+$report["Report"]['discount_amount']>=$report["Report"]['total']){
					// pr($transaction);
				// pr($report);
							$this->loadModel('EmailTemplate');
							$this->loadModel('Setting');
							$this->loadModel('EmailAction');
							$settingsEmail = $this->Setting->find('first', array(
													'conditions' => array(
													'Setting.key ' =>  'Site.email',
													)
											));
							$settingstitle = $this->Setting->find('first', array(
										'conditions' => array(
										'Setting.key ' =>  'Site.title',
										)
								));	
								
							$reg_succ_id	=	Configure::read('global_ids.email_template.report_paid_email');
							
							$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

							$action 		= $email_template['EmailTemplate']['action'];
							
							$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
							
							$cons = explode(',',$action['EmailAction']['options']);
							$constants = array();
							foreach($cons as $key=>$val){
								$constants[] = '{'.$val.'}';
							}
							//SHOOT_TITLE,SHOOT_TIME,FIRST_NAME,LAST_NAME,RELEASE_DATE,PAYMENT
							$shoot_title   	=   $report["Shoot"]['title'];
							$shoot_time   	=   $report["Shoot"]['date']." ".$report["Shoot"]['hour'].":".$report["Shoot"]['min'].$report["Shoot"]['meridian'];
							
							$first_name 	=	$report["Client"]['first_name']; 
							$last_name 		=	$report["Client"]['last_name']; 
							$release_date	=	isset($report["Gallery"]['date'])?$report["Gallery"]['date']:$report["Shoot"]['date']; 
							// $payment		=	$report["Report"]['payment']-$report["Report"]['discount_amount']-$report["Report"]['paid']; 
							$payment		=	$report["Report"]['total']; 
							$email   		=   $report["Client"]["email"];
							
							$rep_Array = array($shoot_title,$shoot_time,$first_name,$last_name, $release_date, $payment ); 
						
							$to 				= $email;
							$from_email 		= $settingsEmail['Setting']['value'];
							$from_name 			= $settingstitle['Setting']['value'];
							$from 				= $from_name . "<" . $from_email . ">";

							$replyTo 			= "";
							$subject 			= $email_template['EmailTemplate']['subject'];
							
							$message 			= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);
							
							// pr($message); die;
							$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
						}
			
			
				$this->Session->setFlash(__('Manual Payment applied successfully.'), 'success');
				$this->redirect(array('action' => 'view',$this->{$this->modelClass}->id));
			}
		}else{
			$this->redirect($this->referer);
		}
	}
	
	
	function view($id = null) {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
			
		  
			$this->{$this->modelClass}->belongsTo = array(
										"Client"=>array('className'=>'Usermgmt.Client','foreignKey'=>'client_id'),
										"Product"=>array('className'=>'Product.Product','foreignKey'=>'product_id')
										);
			$report = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Reports');
			
			$this->loadModel('Usermgmt.Client');
			$client = $this->Client->findById($report[$this->modelClass]['client_id']);
			$this->set('client',$client);
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$report[$this->modelClass]['client_id']);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($report[$this->modelClass]['title'], true));
			$pageHeading	=	$report[$this->modelClass]['title'];
			$this->set('pageHeading',$pageHeading);
			$this->{$this->modelClass}->id = $id; 
			$this->set('breadcrumb', $breadcrumb);
			$this->set('dropdown_type', $dropdown_type);
			$this->set('humanize', $humanize);
			$this->set('singularize', $singularize);
			$this->set('id', $id);
			if (empty($this->data)) {
				$this->data = $this->{$this->modelClass}->read();
			 } else {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {				
					if ($this->{$this->modelClass}->save($this->data)) {
						$this->Session->setFlash(__($singularize .' has been updated.'), 'success');
						$this->redirect(array('action' => 'index',$report[$this->modelClass]['client_id']));
					}
				}
			}
	}
	
	
	public function add($client_id = null) {		
		$dropdown_type=__('Report');
		$pageHeading=__('Create Report');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('pageHeading', $pageHeading);
		$this->set('client_id', $client_id);
		$this->set('singularize', $singularize);
		$this->set('states', $this->getStatesList());
		
		$admin_id = $this->Auth->user('id');
		$this->loadModel('User');
		$this->loadModel('Product');
		$product_list = $this->Product->find('list',array('fields'=>array('id','name'),'conditions'=>array('admin_id'=>$admin_id)));
		$this->set('product_list', $product_list);
		$this->set('product_price_list', $this->Product->find('list',array('fields'=>array('id','price'),'conditions'=>array('admin_id'=>$admin_id))));
		$this->User->virtualFields  = array(
											'full_name' => 'CONCAT(User.first_name, " ", User.last_name)'
										);
		$this->set('client_list', $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.client"),'parent_id'=>$admin_id),'fields'=>array('id','full_name'),'order'=>"last_name asc")));
		
		$this->User->virtualFields = array('comment'=>'(SELECT `field_value` as price from `user_details` WHERE `user_details`.`field_name`="User.comment" AND `user_details`.`user_id`=User.id)');
		$this->set('client_comment_list', $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.client"),'parent_id'=>$admin_id),'fields'=>array('id','comment'))));
		$photographer_list = $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.photographer"),'parent_id'=>$admin_id),'fields'=>array('id','first_name')));
		$this->set('photographer_list', $photographer_list);
		
		$this->User->virtualFields = array('price'=>'(SELECT `field_value` as price from `user_details` WHERE `user_details`.`field_name`="User.price" AND `user_details`.`user_id`=User.id)');
		$photographer_price_list = $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read("user_role_id.photographer"),'parent_id'=>$admin_id),'fields'=>array('id','User.price')));
		
		$this->set('photographer_price_list', $photographer_price_list);
		
		
		$this->loadModel("Shoot");
		if (!empty($this->data)) {
				// $this->Shoot->set($this->data);
					// pr($this->data); die;
				if($this->Shoot->validates()) {
					// pr($this->data); 
					
					$data = $this->data;
					$data["Shoot"]['hour'] 	= 	$data["Shoot"]['time']['hour'];
					$data["Shoot"]['min'] 	= 	$data["Shoot"]['time']['min'];
					$data["Shoot"]['meridian'] 	= 	$data["Shoot"]['time']['meridian'];
					unset($data["Shoot"]['time']);
					
					$data['Gallery']['client_id'] 	= 	$data["Shoot"]['client_id'];
					$data['Gallery']['hour'] 	= 	$data['Gallery']['time']['hour'];
					$data['Gallery']['min'] 	= 	$data['Gallery']['time']['min'];
					$data['Gallery']['meridian'] 	= 	$data['Gallery']['time']['meridian'];
					unset($data['Gallery']['time']);
					// pr($data); 
					if ($this->Shoot->save($data,false)) {
						$shoot_id = $this->Shoot->id;
						$this->loadModel('Gallery');
						$this->Gallery->save($data,false);
						$gallery_id = $this->Gallery->id;
						$this->Shoot->save(array("gallery_id"=>$gallery_id),false);
						
						/* Save Reports */
						if($data['Report']['create_report']){
						
							$report	=	array();
							$report['title']		=	$data['Shoot']['title'];
							$report['shoot_id']	=	$shoot_id;
							$report['gallery_id']	=	$gallery_id;
							$report['client_id']	=	$data['Shoot']['client_id'];
							$report['recipient_id']	=	$data['Report']['recipient'];
							$report['product_id']		=	$data['Shoot']['product_id'];
							$report['photographer_id']	=	$data['Shoot']['photographer_id'];
							$report['payment']			=	$data['Shoot']['price'];
							$report['send_confirmation']	=	$data['Report']['send_confirmation'];
							$report['due_date']	=	$data['Report']['due_date'];
							$report['send_reminder']	=	$data['Report']['send_reminder'];
							$report['status']	=	0;
							$tax = 0;
							if(isset($data['Shoot']['product_id']) && !empty($data['Shoot']['product_id'])){
								$this->loadModel("Product");
								$product = $this->Product->findById($data['Shoot']['product_id']);
								if(!empty($product) && $product['Product']['taxable']){
									$tax = Configure::read('Site.sales_tax_rate');
									if(empty($tax)) $tax  = 0;
								}
							}
							
							$report['tax']	=	round(($data['Shoot']['price']*($tax/100)),2);
							$report['total']	=	$data['Shoot']['price']+round((($data['Shoot']['price']*($tax/100))),2);
							
							$this->loadModel('Report');
							$this->Report->save($report,array('validate'=>false));
							
						}
						// pr($report); die;
						
						/* Send shoot booked email */
							$this->loadModel('EmailTemplate');
							$this->loadModel('Setting');
							$this->loadModel('EmailAction');
							$settingsEmail = $this->Setting->find('first', array(
													'conditions' => array(
													'Setting.key ' =>  'Site.email',
													)
											));
							$settingstitle = $this->Setting->find('first', array(
										'conditions' => array(
										'Setting.key ' =>  'Site.title',
										)
								));	
								
							$reg_succ_id	=	Configure::read('global_ids.email_template.booking_confirmation');
							
							$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$reg_succ_id));

							$action 		= $email_template['EmailTemplate']['action'];
							
							$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$action)));
							
							$cons = explode(',',$action['EmailAction']['options']);
							$constants = array();
							foreach($cons as $key=>$val){
								$constants[] = '{'.$val.'}';
							}
							//SHOOT_TITLE,SHOOT_DATE,SHOOT_SIZE,SHOOT_PRICE,PRODUCT,PHOTOGRAPHER,FIRST_NAME,LAST_NAME
							$shoot_title   	=   $data['Shoot']['title'];
							$shoot_date   	=   $data['Shoot']['date'];
							$shoot_size   	=   $data['Shoot']['size'];
							$shoot_price   	=   $data['Shoot']['price'];
							$product	   	=   $product_list[$data['Shoot']['product_id']];
							$photographer  	=   $photographer_list[$data['Shoot']['photographer_id']];
							
							$client = $this->User->find("first",array("conditions"=>array("User.id"=>$data['Shoot']['client_id']),'fields'=>array("first_name","last_name","email")));
							
							$first_name   	=   $client["User"]["first_name"];
							
							$last_name   	=   $client["User"]["last_name"];
							$email   		=   $client["User"]["email"];
							
							$rep_Array = array($shoot_title,$shoot_date,$shoot_size,$shoot_price,$product,$photographer,$first_name,$last_name); 
						
							$to 				= $email;
							$from_email 		= $settingsEmail['Setting']['value'];
							$from_name 			= $settingstitle['Setting']['value'];
							$from 				= $from_name . "<" . $from_email . ">";

							$replyTo 			= "";
							$subject 			= $email_template['EmailTemplate']['subject'];
							
							$message 			= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);
							
							// pr($message); die;
							$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
						
						
						
						
						$this->Session->setFlash(__($singularize . ' has been added.'), 'success');
						$this->redirect(array('action' => 'index',$client_id));
					}
				}else{
					$this->Session->setFlash(__('Validation Errors'), 'success');
						$this->redirect(array('action' => 'index',$client_id));
				}
			}
			
			$this->set('autopassword', $this->generatePassword(8,3));
			
		
	}
	
	function generatePassword($length=9, $strength=0) {
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength >= 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength >= 2) {
			$vowels .= "AEUY";
		}
		if ($strength >= 4) {
			$consonants .= '23456789';
		}
		if ($strength >= 8 ) {
			$vowels .= '@#$%';
		}

		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$password .= $vowels[(rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $password;
	}
	

	function addd($dropdown_type='Reports') {
		$dropdown_type=__('Reports');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add New').' '.$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		$pageHeading	=	__('Add Report');
		$this->set('pageHeading',$pageHeading);
			if (!empty($this->data)) {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {
					// pr($this->data); die;
					if ($this->{$this->modelClass}->save($this->data)) {
						$this->Session->setFlash(__($singularize .' has been added.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
			}
	}
	function edit($client_id = 0, $id = null) {
		  if(!isset($id) || $id == '' || $client_id == 0 ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
			$user = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Reports');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['title'], true));
			$pageHeading	=	__('Edit Report');
			$this->set('pageHeading',$pageHeading);
			$this->{$this->modelClass}->id = $id; 
			$this->set('breadcrumb', $breadcrumb);
			$this->set('dropdown_type', $dropdown_type);
			$this->set('humanize', $humanize);
			$this->set('singularize', $singularize);
			$this->set('id', $id);
			// echo $client_id; die;
			$this->set('client_id', $client_id);
			if (empty($this->data)) {
				$this->data = $this->{$this->modelClass}->read();
			 } else {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {				
					if ($this->{$this->modelClass}->save($this->data)) {
						$this->Session->setFlash(__($singularize .' has been updated.'), 'success');
						
						$this->redirect(array('action' => 'index',$client_id));
					}
				}
			}
	}
	
 function deleted($id=null) {
	 $dropdown_type=__('Reports');
		if($id == null){
				die(__("No ID received"));
			}else{	
			
				$humanize 				= Inflector::humanize($dropdown_type);
				$singularize 			= Inflector::singularize($humanize);
				$this->{$this->modelClass}->delete($id);
				$this->Session->setFlash(__($singularize.' has been deleted.'),'success');
				$this->redirect(array('action'=>'index',$dropdown_type));
			}
		}
	function delete() {
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null){
			 $dropdown_type=__('Reports');
				
				if($this->{$this->modelClass}->delete($this->data['id'])){
					
					echo 'success';
				}else{
					echo 'error';
				}
			}
		} exit;
	}
	
	function generatereport(){
		//echo 'fghfg'; die;
		$this->layout	= false;
		$header = array(__('Report Name'),__('Created'));
			$reportdata = $this->{$this->modelClass}->find('all');
			$data = array();
			foreach($reportdata as $key => $ddata){
				$data[$key]['name']		=	$ddata['Report']['name'];
				$data[$key]['created']	=	date('m-d-Y',$ddata['Report']['created']);
			}
			$this->export_file($header,$data,'csv');
		exit;
		
	}
	
	public function generate_pdf(){
			
			$results	=	$this->{$this->modelClass}->find('all');
			$header_row = array(__("Report Name"),__("Created"));
			foreach($results as $key => $ddata){
				$data[$key]['name']		=	$ddata['Report']['name'];
				$data[$key]['created']	=	date('m-d-Y',$ddata['Report']['created']);
			}
			$this->export_file($header_row,$data,'pdf');
				
			die;
	}
	
	
}
