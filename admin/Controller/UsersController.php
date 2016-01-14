<?php
class UsersController extends AppController {
	
	/**
* Helpers
*
* @var array
*/
//public $helpers = array('Goodies.Gravatar');

/**
* Components
*
* @var array
*/

public $components 	= 	array('Auth', 'Session', 'Email', 'Cookie', 'Search.Prg', 'RequestHandler');
public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');

public $presetVars = array();

/**
/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		//$this->_setupAuth();

		$this->set('model', $this->modelClass);
		$this->Auth->allow('footer','forgot_password','resetpassword');
		if (!Configure::read('App.defaultEmail')) {
			Configure::write('App.defaultEmail', 'noreply@' . env('HTTP_HOST'));
		}
	}
	
	public function login() {
		$this->layout	=	'home';
		if(!empty($this->data)){	
			$rememberMe	=	$this->data[$this->modelClass]['remember_me'];
			if($rememberMe != 0){
				$cookieTime = "7 days"; // You can do e.g: 1 week, 17 weeks, 14 days
				//unset($rememberMe);
				$data['password'] = $this->Auth->password($this->data[$this->modelClass]['password']);
				$this->Cookie->write('remember_me', $data, true, $cookieTime);
			}	
			}
		$this->request->is('post') && $this->Auth->login();
		if ($this->Auth->user()) {
			
			if ($this->here == $this->Auth->loginRedirect) {
				$this->Auth->loginRedirect = '/';
			}	
			$this->Session->setFlash(sprintf(__('%s you have successfully logged in'), $this->Auth->user('username')),'success');
			if($this->Auth->user('user_role_id')){ 
				$this->Session->write('access_mode',$this->Auth->user('user_role_id')); 
				$this->User->virtualFields  = array(
				'allow_as_admin'=> "SELECT field_value  FROM user_details WHERE user_id=User.id AND field_name = 'User.allow_as_admin'"
				); 
		
				$userdata =  $this->{$this->modelClass}->find('first',array('conditions'=>array('id'=>$this->Auth->user('id'))));
				//pr($userdata); die;
				if($userdata['User']['user_role_id']!=1 && isset($userdata['User']['allow_as_admin']) && !empty($userdata['User']['allow_as_admin'])){
				
				$this->Session->write('allow_access_mode',$userdata['User']['allow_as_admin']);
				
				}else{
				$this->Session->write('allow_access_mode',0); 
				}
			}
			
			 if($this->Auth->user('id') == 1){
			 
				$emaildata['email']	=	Configure::read('Site.email');
				$this->User->id	=	$this->Auth->user('id');
				$this->User->save($emaildata,false);
			 }
		
			$this->redirect($this->Auth->redirect());
		} else {
			
			$this->Auth->flash(__('Invalid e-mail / password combination. Please try again'),'error');
			if(!empty($this->data))
				$_SESSION['failed']	=	__('Invalid e-mail / password combination. Please try again');
		}
	}
	public function change_access_mode() {
	
		if(($this->Session->read('access_mode'))==2){
		$this->Session->delete('access_mode');
		$this->Session->write('access_mode',1);
		}elseif(($this->Session->read('access_mode'))==1){
		$this->Session->delete('access_mode');
		$this->Session->write('access_mode',2);
		}
		
		$this->Session->delete('Config.admin_menus');
		$this->redirect($this->referer());
	}
	function forgot_password(){
		
	$this->layout	=	'home';
		if($this->Auth->user('id') != null){
			$this->redirect(array('controller'=>'/'));
		}
		if(!empty($this->data)) {		
			$this->{$this->modelClass}->set($this->data);
			if($this->{$this->modelClass}->ForgotPasswordValidate()) {
				
			$email_data	=	$this->{$this->modelClass}->find('first',array('conditions'=>array('email'=>$this->data[$this->modelClass]['email'],'is_verified'=>1,'active'=>1,'is_deleted'=>0)));
			
			//pr($email_data); die;	
			if(!empty($email_data)){
				$forgot_password_validate_string				=	Security::hash($email_data[$this->modelClass]['email'].time(), 'sha1', true);
				$validate['forgot_password_validate_string']	= 	$forgot_password_validate_string;
				$this->{$this->modelClass}->id					=	$email_data[$this->modelClass]['id'];
				$this->{$this->modelClass}->save($validate,false);
			
				$this->loadModel('EmailTemplate');
				$this->loadModel('Setting');
				$settingsEmail = Configure::read('Site.email');
				$settingstitle = Configure::read('Site.title');
				/* $this->Setting->find('first', array(
							'conditions' => array(
							'Setting.key ' =>  'Site.title',
							)
					)); */
						
				$email 				=  $email_data[$this->modelClass]['email'];
				$username 			=  $email_data[$this->modelClass]['username'];
				$WEBSITE_URL    	=  WEBSITE_URL.'admin/';
				$varify_link    	=   Router::url(array('plugin'=>false,'controller'=>'users','action'=>'resetpassword',$forgot_password_validate_string),true);
				//echo $varify_link; die;
				// WEBSITE_URL."users/resetpassword/".$forgot_password_validate_string."/"."?enc=".md5(time());	
				$varify_link		=	'<a href="'.$varify_link.'">Click here</a>';
				$forg_pass_id		=	Configure::read('global_ids.email_template.forgot_password');
				$email_template = $this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$forg_pass_id));
				$to 				= $this->data[$this->modelClass]['email'];
				$from_email 		= $settingsEmail;
				$from_name 			= $settingstitle;
				$from 				= $from_name . "<" . $from_email . ">";
				$replyTo 			= "";
				$subject 			= $email_template['EmailTemplate']['subject'];
					
				/**********************************************************************/
				
				$ac 				= str_replace(' ','',$email_template['EmailTemplate']['action']);
				$this->loadModel('EmailAction');
					
				$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$ac)));
				$cons = explode(',',$action['EmailAction']['options']);
				$constants = array();
				foreach($cons as $key=>$val){
					$constants[] = '{'.$val.'}';
				}
				//pr($constants); die;
				$rep_Array = array($username, $email,$varify_link,$WEBSITE_URL); 
				$message 	= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);	
				//pr($message); die;
				$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail',  $message /* array('message' => $message) */, "", 'html', $bcc = array());
				
				$this->Session->setFlash(__('A reset password link has been sent to your email. Please check your email.'), 'success');
				$this->data	=	'';	
				$this->redirect(array('plugin'=>false, 'controller'=>'users', 'action'=>'forgot_password'));	
			} else{
				$this->Session->setFlash(__('This email is not registered with GooBond'), 'error');
			}
		} else {
				$this->set('errors',$this->{$this->modelClass}->invalidFields());
		}
	  }
	}
	function resetpassword($validate_string=null){
		
		$this->layout	=	'home';
		$msg	=	'';
		$userInfo	=	$this->{$this->modelClass}->find('first',array('conditions'=>array('forgot_password_validate_string'=>$validate_string)));	
		//pr($userInfo); die;
		if(!empty($userInfo)){
			if(!empty($this->data)) {
				$this->{$this->modelClass}->set($this->data);	
				if($this->{$this->modelClass}->ResetPasswordValidate()){
				//echo 'gdfg'; die;
					$passwd = $this->request->data[$this->modelClass]['password'];
					
					$this->request->data[$this->modelClass]['password']			= 	Security::hash($passwd, 'sha1', true);
					$this->request->data[$this->modelClass]['forgot_password_validate_string']			= 	'';
					$this->{$this->modelClass}->id	=	$userInfo[$this->modelClass]['id'];
					$this->{$this->modelClass}->save($this->data,array('validate'=>false));
					
					
					$this->loadModel('EmailTemplate');
					$this->loadModel('Setting');
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
							
					$WEBSITE_URL	=  WEBSITE_URL.'admin/';
					$login_link    	=   Router::url(array('plugin'=>false,'controller'=>'users','action'=>'login'),true);	
					$login_link		=	'<a href="'.$login_link.'">'.$login_link .'</a>';
					
				
					$forg_pass_succ_id	=	Configure::read('global_ids.email_template.user_password_changed_successfully'); 
					//echo $forg_pass_succ_id; die;
				
					$email_template		=	$this->EmailTemplate->find("first", array("conditions" => "EmailTemplate.id=".$forg_pass_succ_id));
					
					
					$to 				= $userInfo[$this->modelClass]['email'];
					$username 			= $userInfo[$this->modelClass]['username'];
					$from_email 		= $settingsEmail['Setting']['value'];
					$from_name 			= $settingstitle['Setting']['value'];
					$from 				= $from_name . "<" . $from_email . ">";
					$replyTo 			= "";
					$subject 			= $email_template['EmailTemplate']['subject'];
						
					/**********************************************************************/
					
					$ac 				= $email_template['EmailTemplate']['action'];
					$this->loadModel('EmailAction');
						
					$action = $this->EmailAction->find("first", array('conditions' => array('EmailAction.action'=>$ac)));
					$cons = explode(',',$action['EmailAction']['options']);
					$constants = array();
					foreach($cons as $key=>$val){
						$constants[] = '{'.$val.'}';
					}
					
					//pr($constants); die;
					$rep_Array = array($username, $to,$login_link);
					
					$message 	= str_replace($constants, $rep_Array, $email_template['EmailTemplate']['body']);					
					//pr($message); die;
					$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail',  $message /* array('message' => $message) */, "", 'html', $bcc = array());
					
					
					$this->Session->setFlash(__('Your password has been reset successfully. Please login to access your account.'), 'success');
					$this->data	=	'';	
					$this->redirect(array('plugin'=>'', 'controller'=>'users', 'action'=>'login'));
					
				} else {
				//	pr($this->{$this->modelClass}->invalidFields()); die;
					$this->set('errors',$this->{$this->modelClass}->invalidFields());
				}
			}
		} else {
			$this->Session->setFlash(__('Sorry, you are using wrong link'), 'error');
			$this->redirect(array('plugin'=>false, 'controller'=>'users', 'action'=>'login'));
			
			//$msg	=	'Sorry, you are using wrong link';
		}
		
		//$this->set('msg',$msg);
		$this->set('validate_string',$validate_string);
	}
	
	
	public function logout() {
		
		$user = $this->Auth->user();
	
		$this->Session->setFlash(sprintf(__('%s you have successfully logged out'), $this->Auth->user('username')),'success');
		
		// $this->redirect($this->Auth->logout());
                 $this->Session->destroy();

 $cachePaths = array('js', 'css', 'menus', 'views', 'persistent', 
'models'); 
    foreach($cachePaths as $config) { 
        clearCache(null, $config); 
    } 

		$this->Auth->logout();

                if($this->Auth->user('id')){
                  $this->redirect(array('controller'=>'users','action'=>'logout',time()));
                }
		$this->redirect(array('controller'=>'users','action'=>'login'));
	}
	
	

	public function myaccount() {
		$pages[__('Dashboard')] = array('controller'=>'pages','action'=>'home');

		$breadcrumb = array('pages'=>$pages, 'active'=>__('My Account',true));	
		
		$this->set('breadcrumb', $breadcrumb);
		$userId = $this->Auth->user('id');
		
		$user_data = $this->{$this->modelClass}->read(null, $userId);
		
		$pageHeading	=	__('My Account');
		$this->set('pageHeading',$pageHeading);
		
		if(!empty($this->request->data)) {
			$user_pass	=	$user_data['User']['password'];
			
			$data 		=	$this->data;
			
			$data['User']['user_pass'] = $user_pass;
			
			$this->data = $data;
			
			$this->{$this->modelClass}->set($this->data);	
		
			if($this->{$this->modelClass}->EditValidate()) {
				
				$password 						= 	Security::hash($this->data['User']['password'], 'sha1', true);
				
				$save_data['User']['id']		= $this->data['User']['id'];
				$save_data['User']['email']		= $this->data['User']['email'];
				$save_data['User']['password']	= $password;
				
				if($this->{$this->modelClass}->save($save_data,false)) {
					$this->Session->setFlash(__('Account settings saved'),'success');
					$this->redirect(array('action' => 'myaccount'));
				} else {
					$this->Session->setFlash($e->getMessage(),'error');
					$this->redirect(array('action' => 'myaccount'));
				}
			}
		
			// pr($this->request->data); die;
			/* try {
				$result = $this->{$this->modelClass}->edit($userId, $this->request->data);
				if ($result === true) {
					$this->Session->setFlash(__('User saved'),'success');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->request->data = $result;
				}
			} catch (OutOfBoundsException $e) {
				$this->Session->setFlash($e->getMessage(),'error');
				$this->redirect(array('action' => 'index'));
			} */
			
			
			
		} else if (empty($this->request->data)) {
			$this->request->data = $user_data;
		}

	}
	
	function footer(){
		$this->layout	=	false;
		$this->loadModel('Setting');
		$footers['copyright_text']	=	$this->Setting->find('first',array('fields'=>array('id','key','value'),'conditions'=>array('key'=>'Site.copyright_text')));
		return $footers;
	}
}