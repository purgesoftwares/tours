<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
App::uses('Controller', 'Controller');
App::uses('Folder', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('File', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	/**
	* Helpers
	*
	* @var array
	*/
		public $helpers = array(
								'Html',
								'Form',
								'Session',
								'Time',
								'Text');

	/**
	* Components
	*
	* @var array
	*/
	public $components = array(
							'Auth',
							'Session',
							 'Email',
							'Cookie',
							'Paginator');
		
	
	/**
	* beforeFilter callback
	*
	* @return void
	*/
	public function beforeRender(){

                 header('pragma: no-cache'); 
                  header('Cache-Control: no-cache, must-revalidate'); 
                 header('Expires: Sat, 1 Jan 2005 00:00:00 GMT'); 
                $this->response->disableCache();

		if($this->name == 'CakeError'){
			//$this->layout = 'error';
		}        
	}
	public function beforeFilter() {
	
		$scope = array('User.active' => 1,'User.user_role_id' => array(Configure::read('user_roles.client'),Configure::read('user_roles.contact')));
		$loginAction = array('plugin'=>'','controller' => 'users', 'action' => 'login');
		$loginRedirect	='/';
		$logoutRedirect	='/';
		$this->Auth->authenticate = array('Form' => array('fields' => array('username' => 'email','password' => 'password'),'scope' => $scope));
		$this->Auth->authError = 'Did you really think you are allowed to see that?';
		$sessionKey    = 'Auth.Front';
		authComponent::$sessionKey = $sessionKey;
		$this->Auth->loginRedirect = $loginRedirect;
		$this->Auth->logoutRedirect = $logoutRedirect;
		$this->Auth->loginAction = array('plugin'=>'', 'controller' => 'users', 'action' => 'login');
		$this->Auth->allow('login','language','get_image');
		
		
		/* -----Menu auth check- start here---------- */
		$admin_data	=	$this->Session->read('Auth.Front');
		$this->set('admin_data',$admin_data);
	
			
		
	}
	
		
	function _sendMail($to, $from, $replyTo, $subject, $element , $parsingParams  = array() ,$attachments ="", $sendAs = 'html', $bcc = array()) {
		
		$toAraay = array();
		if ( !is_array($to) ) {
		
			$toAraay[] = $to;
		} else {
			$toAraay = $to;
		}
		
	
		$this->Email->smtpOptions = array(
        'port'=>MAIL_PORT, 
        'host' => MAIL_HOST,
        'username'=>MAIL_USERNAME,
        'password'=>MAIL_PASSWORD,
        'client' => MAIL_CLIENT
		);

		$this->Email->delivery = 'smtp';
		
		foreach ($parsingParams as $key => $value) {
			$this->set($key, $value);
		}
		
		foreach ($toAraay as $email) {
			$this->Email->to = $to;			
			$this->Email->bcc = $bcc;			
			$this->Email->subject = $subject;
			$this->Email->replyTo = $replyTo;
			$this->Email->from = $from;
			if($attachments!=""){
				$this->Email->attachments = array();
        		$this->Email->attachments[0] = $attachments ;
			}
			$this->Email->template = $element; // note no '.ctp'
			//Send as 'html', 'text' or 'both' (default is 'text')
			$this->Email->sendAs = $sendAs; // because we like to send pretty mail
			//Set view variables as normal
			//$this->set('webroot', HTTP_HOST . $this->webroot);
			//Do not pass any args to send()
			$this->Email->send();
			$this->Email->reset();
		} 
		
	}
	/*
	create a dynamic folders with month and date
	params	=	@path where to create
	*/
	function createFloder($path=""){
		// check if path is not empty
		if($path=="") // if path is empty make webroot uploads as default
			$path	=	APP_UPLOADS_ROOT_PATH;
		
		$month	=	date('M');			
		$year	=	date('Y');
		$floder_to_create	=	$month."-".$year;
		// create a folder with month and year	
		$folder	=	array('path'=>$path.$floder_to_create,'folder'=>$floder_to_create);
		if(is_dir($path)){ // check if given path is dir 
			if(!is_dir($path."/".$floder_to_create)){ // if gibven path is not empty
				$dir 	= 	new Folder($path."/".$floder_to_create, true, 0777);
				$folder	=	array('path'=>$dir->path,'folder'=>$floder_to_create);
			}
		}else{ // given path is not directery reate it
			$dir 		= 	new Folder($path, true, 0777);
			$folder		=	array('path'=>$dir->path,'folder'=>$floder_to_create);
		}
		return $folder;
	}
	
	function createFolder($path="",$floder_to_create=''){
		// check if path is not empty
		if($path=="") // if path is empty make webroot uploads as default
			$path	=	APP_UPLOADS_ROOT_PATH;
		
		$month	=	date('M');			
		$year	=	date('Y');
		if($floder_to_create=="") // if path is empty make webroot uploads as default
		$floder_to_create	=	$month."-".$year;
		// create a folder with month and year	
		$folder	=	array('path'=>$path.$floder_to_create,'folder'=>$floder_to_create);
		if(is_dir($path)){ // check if given path is dir 
			if(!is_dir($path."/".$floder_to_create)){ // if gibven path is not empty
				$dir 	= 	new Folder($path."/".$floder_to_create, true, 0777);
				$folder	=	array('path'=>$dir->path,'folder'=>$floder_to_create);
			}
		}else{ // given path is not directery reate it
			$dir 		= 	new Folder($path, true, 0777);
			$folder		=	array('path'=>$dir->path,'folder'=>$floder_to_create);
		}
		return $folder;
	}
	
	
	
function export_file($header_row,$results,$flag=''){ 
			
				if($flag == 'csv'){	
								ini_set('max_execution_time', 600); 
								$filename = "export_".date("Y.m.d").".csv";
								$csv_file = fopen('php://output', 'w');

								header('Content-type: application/csv');
								header('Content-Disposition: attachment; filename="'.$filename.'"');
								
								fputcsv($csv_file,$header_row,',','"'); 
								
								foreach($results as $result)
								{
									$row	=	array();
									foreach($result as $key => $res){
										$row[] = $res;
											
									}
								fputcsv($csv_file,$row,',','"');
								}
								

								fclose($csv_file);
								die;
				
				}else if($flag == 'pdf'){
				
				
							$detail = PDF_HEADER_HTML;
							foreach($header_row as $header_item){
								$detail .= '<th style="border:1px solid #000;">'.$header_item.'</th>';
							}
							$detail .= '</tr>';
							foreach($results as $key=>$result){
								$row	=	array();
								$detail .= '<tr >';
								foreach($result as $key => $res){
										$detail .= '<td style="border:1px solid #000;">'.$res.'</td>';
									}		
								$detail .= '</tr>';
							}
						$detail .= '</table>'.PDF_FOOTER_HTML;
						require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
						$this->dompdf = new DOMPDF();
						$papersize = "legal";
						$orientation = "landscape";
						$this->dompdf->load_html($detail);
						
						$this->dompdf->render();
						$filename = "pdf_".date("Y.m.d").".pdf";
						$this->dompdf->stream($filename);
						
						die;
				
				}	
	}
	
	function getDropDowns($type=array()){
		
		$this->loadModel('Master.Category');
		if(!empty($type)){
			$drop_downs		=	$this->Category->find('list',array('fields'=>array('name','name','dropdown_type'),'conditions'=>array('dropdown_type'=>$type)));
		}else{
			$drop_downs		=	$this->Category->find('list',array('fields'=>array('name','name','dropdown_type')));
		}
		return $drop_downs;	
	}
	
	function getDropDown($type='client_types'){
		
		$this->loadModel('Master.Category');
			$drop_downs		=	$this->Category->find('list',array('fields'=>array('name','name'),'conditions'=>array('dropdown_type'=>$type)));
		
		return $drop_downs;	
	}
	function getStatesList(){
		
		$this->loadModel('State');
			$states		=	$this->State->find('list',array('fields'=>array('short_code','short_code')));
		
		return $states;	
	}
	
	function getDropDownById($type='client_types'){
		
		$this->loadModel('Master.Category');
		$drop_downs		=	$this->Category->find('list',array('fields'=>array('id','name'),'conditions'=>array('dropdown_type'=>$type)));
		
		return $drop_downs;	
	}
	function getDropDownsById($type=array()){
		
		$this->loadModel('Master.Category');
		if(!empty($type)){
			$drop_downs		=	$this->Category->find('list',array('fields'=>array('id','name','dropdown_type'),'conditions'=>array('dropdown_type'=>$type)));
		}else{
			$drop_downs		=	$this->Category->find('list',array('fields'=>array('id','name','dropdown_type')));
		}
		return $drop_downs;	
	}
	

}