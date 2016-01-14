<?php
App::import('Vendor','paypal' ,array('file'=>'paypal.class.php')); 
class PaypalComponent extends Object 
{
	
	var $controller;
	var $data = array();
	public function __construct($file = null, $watermark = null)
	{
		/* if ( !empty($file) )
			$this->setImage($file);

		if ( !empty($watermark) )
			$this->setWatermark($watermark); */
	}

	/**
	 * Contructor function for CakePHP
	 * @param Object &$controller pointer to calling controller
	 */
	public function initialize(&$controller, $options = array())
	{
		
	}
	
	public function beforeRedirect(&$controller, $options = array())
	{
	}
	public function startup(&$controller, $options = array())
	{
	}
	public function beforeRender(&$controller, $options = array())
	{
	}
	public function shutdown(&$controller, $options = array())
	{
	}
	
	function get_response($action = null){
	
	// pr($action);die;
		
		//require_once('paypal.class.php');
		
		$p = new paypal_class;
		if(Configure::read('Payment.paypal_sandbox')){
			$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}else{
			$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
		}
		//$this_script = 'MYDOMAIN.COM/paypal.php';
		$this_script = Configure::read('App.Siteurl').'payments/paypal_response/';
		switch ($action) {	  
			case 'ipn':
				$this->test_log();
				if($p->validate_ipn()){}			  
				break;
		} 
	}
	/* write test_log file added by S.R. */
	function test_log(){
		
		$myFile = "test_log.txt";
		$fh = fopen($myFile, 'a+') or die("can't open file");
		$stringData = "\r\n---------created date::".date('Y-m-d H:m:s')."------------\r\n";
		fwrite($fh, $stringData);
		
		fwrite($fh, $this->data);
		$stringData = "\r\n------------------------\r\n";
		fwrite($fh, $stringData);
		fclose($fh);	
	}
	
	
	function dealPayment($data,$total,$ids){
		
		$customsettings = array(
			'cpp_header_image' => WEBSITE_IMG_URL."logo2.jpg", 
			'page_style' =>"paypal", 
			'cbt'  => __("To complete your order Go Back to ".Configure::read('Site.title'))
		);
		// pr($customsettings); die;
		$nvpArray = array_merge($customsettings);
		//$nvp = http_build_query($nvpArray);
		foreach($nvpArray as $param => $value) {
			$paramsJoined[] = "$param=$value";
		}
		$nvp = implode('&', $paramsJoined);
		
		$p = new paypal_class;
		if(Configure::read('Payment.paypal_sandbox')){
			$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr/'.$nvp;
		}else{
			$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr/'.$nvp;
		}
		
		$this_script 	= Router::url(array('plugin'=>'invoice','controller'=>'invoices','action'=>'paypal_response'),true);
		$paypal_success = Router::url(array('plugin'=>'invoice','controller'=>'invoices','action'=>'paypal_response'),true);
		$paypal_cancle 	= Router::url(array('plugin'=>'invoice','controller'=>'invoices','action'=>'paypal_response'),true);
		
		$i = 1;
		
		// $p->add_field('cmd','_xclick');//type cart
		
		$p->add_field('cmd','_cart');//type cart
		$p->add_field('upload','1');// multiple orders
		$p->add_field('username',Configure::read('Payment.PaypalUsername') );//$_POST['paypalemail']
		$p->add_field('business',Configure::read('Payment.paypal_email'));//$owner_paypal_email
		$p->add_field('return', $paypal_success);
		$p->add_field('cancel_return', $paypal_cancle);
		$p->add_field('notify_url', $this_script.'?action=ipn');
		$p->add_field('currency_code',PAYPAL_CURRENCY_CODE);
		$p->add_field('os0',PAYPAL_CURRENCY_CODE);
		
		foreach($data as $key => $value)
		{
			$p->add_field('item_name_'.($key + 1), $value['title']);
			$p->add_field('amount_'.($key + 1), $value['amount']);
			$p->add_field('shipping_'.($key + 1), $value['shipping_cost']);
			$p->add_field('quantity_'.($key + 1), $value['qty']);
		}
		
		$p->add_field('custom', $ids["id"]);
		$p->submit_paypal_post();
		exit;
	}
}
?>