<?php
class invoicexpress{
	var $config		=	array(
						// urls
							'url'=>array(
										'main'=>"https://SCREEN-NAME.invoicexpress.net",
									),
						// api key		
							'api'=>array(
									'api_key'=>'e8b3cbefc1a42193805115659672f96016b98336'
							)	
						);

	// initiate curl 
	function init_request($url="",$post_xml="",$method="POST"){
		
		$curl 		= 	curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_VERBOSE, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		if($method=="POST"){
			curl_setopt($curl, CURLOPT_POST, true);
		}else{
			curl_setopt($curl, CURLOPT_POST, false);
		}
		if($post_xml!=""){
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post_xml);
		}
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
		curl_setopt($curl, CURLINFO_HEADER_OUT, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 4);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
		$response 	= 	curl_exec($curl);
		curl_close($curl);
		return $response;
		
		
		
	}
	function init_request_invoice_create($url="",$post_xml="",$method="POST"){
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		if($method=="POST"){
			curl_setopt($ch, CURLOPT_POST, true);
		}else{
			curl_setopt($ch, CURLOPT_POST, false);
		}
		if($post_xml!=""){
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_xml);
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
		
		// Execute the request
		$result = curl_exec($ch);

		// Close the handle
		curl_close($ch);
		return $result;
	}
	
	
	// construct the default options
	function __construct($screename="xtreemsolution", $api_key=""){
		// check if apikey received else use default
		if($api_key!=""){
			$this->config['api']['api_key']	=	$api_key;
		}
		// create main url
		$this->config['url']['main']		=	str_replace("SCREEN-NAME",$screename,$this->config['url']['main']);
	}
	
	function convertxml_to_array($xml_data=""){
		
		$getdata	=	str_replace("> ",">",$xml_data);
		$getdata	=	str_replace(" <","<",$getdata);
	
		$arr 		= 	simplexml_load_string($getdata);
		
		$arr 		= 	json_encode($arr);
		return $arr = 	json_decode($arr, true);
	}
	
		// function defination to convert array to xml
	function create_to_xml($array_data, &$xml_info) {
		
		foreach($array_data as $key => $value) {
			
				if(is_array($value)) {
					if(!is_numeric($key)){
						if($key!="@attributes") {
							$subnode = $xml_info->addChild(htmlspecialchars($key));
							$this->create_to_xml($value, $subnode);
						}
					} else{
						$this->create_to_xml($value, $xml_info);
					}
				} else {
					
					$xml_info->addChild(htmlspecialchars(addslashes(trim($key))),htmlspecialchars(addslashes(trim($value))));
				}
			
		}
	}
	// create xml from an array
	function array_to_xml($array=array(),$root="client"){
		$xml_data = new SimpleXMLElement("<?xml version=\"1.0\"?><".$root."/>");
		$this->create_to_xml($array,$xml_data);
		$xml	=	$xml_data->asXML();
		return $xml;
	}
	
	// create client
	function client_create($client_data=array(),$send_options=1){
		
		$create_client_array	=	array(
										'name'=>$client_data['name'],
										'code'=>$client_data['code'],
										'email'=>$client_data['email'],
										'address'=>$client_data['address'],
										'send_options'=>$send_options,
									);
		$client_xml				=	$this->array_to_xml($create_client_array,'client');
		// create a url
		$url				=	$this->config['url']['main']."/clients.xml?api_key=".$this->config['api']['api_key'];	
		// initiate curl request
		$curl_response			=	$this->init_request_invoice_create($url,$client_xml);
		//$curl_response		=	$this->convertxml_to_array($this->init_request_invoice_create($url,$client_xml));
		return $curl_response;	
	}
	
	//get client_list
	function client_list($page=1,$limit=30){
		
		// create a url
		$clienturl				=	$this->config['url']['main']."/clients.xml?api_key=".$this->config['api']['api_key']."&page=".$page."&per_page=".$limit;	
		// initiate curl request
		$curl_response			=	$this->init_request($clienturl,"","GET");
		return $curl_response;	
	}
	
	// create client
	function client_update($client_data=array(),$send_options=1,$client_id=776341){
		
		/*  pr($client_data); 
		echo $send_options; echo '<br/>';
		echo  $client_id; */
		
		
		$update_client_array	=	array(
											'name'=>$client_data['name'],
											'code'=>$client_data['code'],
											'email'=>$client_data['email'],
											'address'=>$client_data['address'],
											'send_options'=>$send_options,
										);
			
			
		$client_xml				=	$this->array_to_xml($update_client_array,'client');
		
		// create a url
		$url					=	$this->config['url']['main']."/clients/".$client_id.".xml?api_key=".$this->config['api']['api_key'];
		// initiate curl request
		$curl_response			=	$this->init_request($url,$client_xml,'PUT');
		/* echo 'Hello';
		
		echo $curl_response; die; */
		return $curl_response;	
	}
	
	// create invoice
	function invoices_create($invoice_data=array()){
		
		
		$invoice_xml			=	$this->array_to_xml($invoice_data,'invoice');
		
		$invoice_xml			=	str_replace('<items>','<items type="array">',$invoice_xml);
		// create a url
		$url					=	$this->config['url']['main']."/invoices.xml?api_key=".$this->config['api']['api_key'];
		// initiate curl request
		$curl_response			=	$this->init_request_invoice_create($url,$invoice_xml);
		//	$data1= $this->convertxml_to_array($curl_response); 

		//pr($curl_response);die;
		//pr($curl_response); die;
		return $curl_response;	
	}
}
?>