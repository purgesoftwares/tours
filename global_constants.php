<?php
define('SUBDIR','/tour_shout/');
/****************************************** Start Database details ******************************************/
define('DBHOST',"localhost");
define('DBUSERNAME',"root");
define('DBPASSWORD',"");
define('DATABASE',"tour_shout");

/****************************************** End Database details ******************************************/
define('WEBSITE_URL','http://'.$_SERVER['HTTP_HOST'].''.SUBDIR);
define('WEBSITE_JS_URL',WEBSITE_URL.'js/');
define('WEBSITE_CSS_URL',WEBSITE_URL.'css/');
define('WEBSITE_IMAGE_URL',WEBSITE_URL.'img/');
define('WEBSITE_IMG_URL',WEBSITE_URL.'img/');
define('WEBSITE_IMAGES_URL',WEBSITE_URL.'images/');
define('WEBSITE_APP_WEBROOT_ROOT_PATH',dirname(__FILE__).'/app/webroot/');
define('WEBSITE_ADMIN_WEBROOT_ROOT_PATH',dirname(__FILE__).'/admin');
define('WEBSITE_APP_WEBROOT_IMG_ROOT_PATH',dirname(__FILE__).'/app/webroot/img/');
define('IMAGE_STORE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/profile_pic/');
define('DEFAULT_DATE_FORMAT', "m/d/Y");
define('PARTNER_PAGE_LIMIT', 12);
// $config['CURRENCY_SYMBOL']					= 	'&euro;';
$config['CURRENCY_SYMBOL']					= 	'$';
// define('PAYPAL_CURRENCY_CODE',		'EUR');
define('PAYPAL_CURRENCY_CODE',		'USD');
/****************************************** Include all settings ******************************************/
require_once('settings.php');
/****************************************** Include all settings ******************************************/
$config['pagingViews'] 	= 	array(10=>'10',20=>'20',50=>'50');
/* Admin Configuration */
if(!defined('ADMIN_FOLDER')) {
	define("ADMIN_FOLDER", "app");	
}
if (!defined('WEBSITE_ADMIN_URL')) {
	define("WEBSITE_ADMIN_URL", WEBSITE_URL.ADMIN_FOLDER.'/');
}
if (!defined('WEBSITE_ADMIN_IMG_URL')) {
	define("WEBSITE_ADMIN_IMG_URL", WEBSITE_ADMIN_URL.'img/');
}
if (!defined('APP_WEBROOT_ROOT_PATH')) {
	define("APP_WEBROOT_ROOT_PATH", $_SERVER['DOCUMENT_ROOT'].SUBDIR.'app/webroot/');
}
if (!defined('APP_UPLOADS_ROOT_PATH')) {
	define("APP_UPLOADS_ROOT_PATH", APP_WEBROOT_ROOT_PATH.'uploads/');
}
if (!defined('APP_UPLOADS_HTTP_PATH')) {
	define("APP_UPLOADS_HTTP_PATH", WEBSITE_URL.'uploads/');
}
if (!defined('USER_IMAGE_STORE_PATH')) {
	define("USER_IMAGE_STORE_PATH", APP_UPLOADS_ROOT_PATH.'photos/');
}
if (!defined('USER_IMAGE_STORE_HTTP_PATH')) {
	define("USER_IMAGE_STORE_HTTP_PATH", APP_UPLOADS_HTTP_PATH.'photos/');
}
if (!defined('STORE_IMAGE_STORE_PATH')) {
	define("STORE_IMAGE_STORE_PATH", APP_UPLOADS_ROOT_PATH.'store/');
}
if (!defined('STORE_IMAGE_STORE_HTTP_PATH')) {
	define("STORE_IMAGE_STORE_HTTP_PATH", APP_UPLOADS_HTTP_PATH.'store/');
}

if (!defined('RECRUITMENT_STORE_PATH')) {
	define("RECRUITMENT_STORE_PATH", APP_UPLOADS_ROOT_PATH.'recruitment/');
}
if (!defined('RECRUITMENT_STORE_HTTP_PATH')) {
	define("RECRUITMENT_STORE_HTTP_PATH", APP_UPLOADS_HTTP_PATH.'recruitment/');
}

if (!defined('ADVERTISEMENT_STORE_PATH')) {
	define("ADVERTISEMENT_STORE_PATH", APP_UPLOADS_ROOT_PATH.'advertisement/');
}
if (!defined('ADVERTISEMENT_STORE_HTTP_PATH')) {
	define("ADVERTISEMENT_STORE_HTTP_PATH", APP_UPLOADS_HTTP_PATH.'advertisement/');
}

define('MEMORY_TO_ALLOCATE',	'100M');
define('DEFAULT_QUALITY',	90);
define('CACHE_DIR',				WEBSITE_APP_WEBROOT_ROOT_PATH .'imagecache' . DS);
define('DISCOUNT_SYMBOL','%');

$config['CALENDER_SCHEDULE_MINUTE']	= 	60;

$config['user_roles']	= 	array('admin'=>1,'photographer'=>2,'client'=>3,'contact'=>4);
$config['shoot_status']	= 	array(1=>"Waiting",2=>'Processing',3=>"Done",4=>"Delivered");
$config['USER_TYPE']			= 	array(3=>'partner',4=>'customer',6=>'other partner');
$config['PARTNER_TYPE']			= 	array(3=>__('partner'),6=>__('other partner'));
$config['PARTNERS_TYPE']		= 	array(1=>__('Individual'),2=>__('Company'));
$config['CUSTOMER_TYPE']		= 	array(1=>__('Individual'),2=>__('Company'));
$config['gender']				= 	array('1'=>'Male','0'=>'Female');

/****************************************** Custom constants  ********************************************/
define('ALBUM_UPLOAD_IMAGE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/photos/');
define('BRAND_UPLOAD_IMAGE_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH.'uploads/brands/');
if (!defined('SETTING_FILE_PATH')) {
	define("SETTING_FILE_PATH", ROOT.'/settings.php');
}

$config['pagingViews'] 	= 	array(10=>'10',20=>'20',50=>'50');
$config['user_role_id'] = 	array('admin'=>1,'photographer'=>2,'client'=>3,'contact'=>4);
$config['default_latlong'] = 	array('lat'=>38.7138,'long'=>9.1394);
$config['defaultPaginationLimit'] 	= 	10;
$config['defaultVoucherPartnerLimit'] 	= 	10;
$config['valid_mime_types'] 	= 	array('image/jpeg', 'image/png', 'image/gif','image/pjpeg');
$config['file_valid_mime_types']= 	array('text/plain', 'text/plain', 'text/plain','text/plain');
$config['valid_image_types']	= 	array('jpg', 'jpeg', 'png', 'gif','pjpeg');
$config['valid_image_size']		= 	52428800;//50MB
$config['global_ids']	=	array(
								'email_template'=>
									array(
										'registration_successfull'					=>	1,
										'verification_email'						=>	2,
										'forgot_password'							=>	3,
										'user_password_changed_successfully'		=>	4,
										'contact_added'								=>  5, 
										'booking_confirmation'						=>  6, 
										'editing_status_done'						=>  7, 
										'invoice_reminder'							=>  8, 
										'release_email'								=>  9, 
										'invoice_past_due_email'					=>  10, 
										'invoice_paid_email'						=>  11,
										'shoot_feedback'							=>  12
										
										),
					'admin_default_image'=>
						array(
						'setting_default_image'=>72)
					);
$config['date_format']				= 	array('basic'=>'m/d/Y','basics'=>'d M, Y h:i a','profile'=>'F d, Y');	
//$config['GLOBEL_CAMPAIGN_CONDITIONS']	= 	array('is_suspended'=>0,'status'=>1,'pending'=>0,"UNIX_TIMESTAMP(STR_TO_DATE(`end_date`,'%d/%m/%Y')) >= "=>time());	
$config['GLOBEL_CAMPAIGN_CONDITIONS']	= 	array('Campaign.is_suspended'=>0,/* 'Campaign.status'=>1, */'Campaign.pending'=>0,"UNIX_TIMESTAMP(STR_TO_DATE(`Campaign`.`end_date`,'%d-%m-%Y')) >= "=>strtotime(date('d-m-Y')));	
$config['front_date_format']				= 	array('basic'=>'M d, Y h:i a','profile'=>'d/m/Y','front'=>'d-m-Y');	
$config['date_picker_formate']		= 	'dd/mm/yy';	
$config['Action_options']			=	array('Registration'=>'Registration','VerificationMail'=>'Verification Email','Forgot Password'=>'Forgot Password','UserPasswordChangedSuccessfully'=>'Reset Forgot Password','contact_added'=>'Contact Added','booking_confirmation'=>'Booking Confirmation','editing_status_done'=>'Editing Status Done','invoice_reminder'=>'Invoice Reminder','release_email'=>'Release Email');
$config['InvoiceSent'] 			= 	array('username'=>'USER_NAME','email'=>'EMAIL_ADDRESS','website_url'=>'WEBSITE_URL');

$config['registration'] 			= 	array('email'=>'EMAIL_ADDRESS','website_url'=>'WEBSITE_URL','verify_link'=>'VERIFY_LINK');
$config['register_verify'] 			= 	array('email'=>'EMAIL_ADDRESS','website_url'=>'WEBSITE_URL');

$config['forgot_password'] 			= 	array('email'=>'EMAIL_ADDRESS','website_url'=>'WEBSITE_URL','reset_link'=>'RESET');
$config['reset_forgot_password'] 	=	array('email'=>'EMAIL_ADDRESS','website_url'=>'WEBSITE_URL');

$config['contact_added'] 			=	array('first_name'=>'FIRST_NAME','last_name'=>'LAST_NAME','email'=>'EMAIL','phone'=>'PHONE_NUMBER','password'=>"PASSWORD","website_url"=>'WEBSITE_URL');
$config['booking_confirmation'] 	=	array('shoot_title'=>'SHOOT_TITLE','shoot_date'=>'SHOOT_DATE','shoot_size'=>'SHOOT_SIZE','shoot_price'=>'SHOOT_PRICE',"product"=>"PRODUCT","photographer"=>"PHOTOGRAPHER","first_name"=>"FIRST_NAME","last_name"=>"LAST_NAME");
$config['editing_status_done'] 			=	array('shoot_title'=>'SHOOT_TITLE','shoot_time'=>'SHOOT_TIME');
$config['invoice_reminder'] 			=	array('shoot_title'=>'SHOOT_TITLE','shoot_time'=>'SHOOT_TIME',"first_name"=>"FIRST_NAME","last_name"=>"LAST_NAME","release_date"=>"RELEASE_DATE","payment"=>"PAYMENT");
$config['release_email'] 			=	array('shoot_title'=>'SHOOT_TITLE','shoot_time'=>'SHOOT_TIME',"first_name"=>"FIRST_NAME","last_name"=>"LAST_NAME","release_date"=>"RELEASE_DATE");

$config['invoice_past_due_email'] 		=	array('shoot_title'=>'SHOOT_TITLE','shoot_time'=>'SHOOT_TIME',"first_name"=>"FIRST_NAME","last_name"=>"LAST_NAME","release_date"=>"RELEASE_DATE","payment"=>"PAYMENT");
$config['invoice_paid_email'] 			=	array('shoot_title'=>'SHOOT_TITLE','shoot_time'=>'SHOOT_TIME',"first_name"=>"FIRST_NAME","last_name"=>"LAST_NAME","release_date"=>"RELEASE_DATE","payment"=>"PAYMENT");
$config['shoot_feedback'] 			=	array('shoot_title'=>'SHOOT_TITLE',"first_name"=>"FIRST_NAME","last_name"=>"LAST_NAME","comment"=>"COMMENT");

$config['globalUsersOption'] 		= 	array(''=>'View All','1'=>'View Verified','0'=>'View Unverified');
$config['deal_type'] 				= 	array(1=>'Product',2=>'Service');
$config['business_type']			=	3;
$config['contact_options'] 			= 	array(1=>'Email',2=>'Phone');
$config['shipping_options'] 		= 	array(1=>'Shipping Not Required',2=>'Buyers can pickup',3=>'Free Shipping Nationwide',4=>'Add Shopping Cost');
$config['varification_options'] 	= 	array(1=>'Varify Using Credit Card',2=>'Varify Using Credit Card',3=>'Varify Using Option Third');
$config['featured_options'] 		= 	array(1=>'Top Service Search Featured
(Appear in top search results at $15 for 3 months)',2=>'Auto Renewal (Top Search Featured)');

$config['voucher_generate_type'] 		= 	array(1=>'More than once',2=>'Only once per user',3=>'More than once, but only after validated');


define('PDF_HEADER_HTML', '<html><style>
				.Table{clear:both; display:table; width:100%; border-left:1px solid #eee;}
				.Table th, .Table td{border-right:1px solid #eee; border-bottom:1px solid #eee; padding:5px 10px; text-align:left; font:12px Arial, Helvetica, sans-serif; color:#666;}
				.Table th{font:bold 13px Arial, Helvetica, sans-serif; color:#fff; background:#333;}
				.Table td{background:#fdfdfd;}
				.Table tr:hover td{background:#f6f6f6;}
				</style><body><script  type="text/php">$pdf->page_text(550, $y, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, $color);</script><img src="'.WEBSITE_APP_WEBROOT_ROOT_PATH.'img/logo.png'.'"><br/><br/><table class="Table" width="100%" colspan="0" cellpadding="0" cellspacing="0" style="border:1px solid #000;"><tr>');

define('PRINT_HEADER_HTML', '<html><style>
				.Table{clear:both; display:table; width:100%; border-left:1px solid #eee;}
				.Table th, .Table td{border-right:1px solid #eee; border-bottom:1px solid #eee; padding:5px 10px; text-align:left; font:12px Arial, Helvetica, sans-serif; color:#666;}
				.Table th{font:bold 13px Arial, Helvetica, sans-serif; color:#fff; background:#333;}
				.Table td{background:#fdfdfd;}
				.Table tr:hover td{background:#f6f6f6;}
				</style><body><img src="'.WEBSITE_APP_WEBROOT_ROOT_PATH.'img/logo.png'.'"><br/><br/>');
				
				
define('PDF_FOOTER_HTML', '</br></br>&nbsp;'.Configure::read('Site.Copyright_text'));
/* define('MAIL_PORT', 25);
define('MAIL_HOST', 'mail.xtreemtech.com');
define('MAIL_USERNAME', 'demo@xtreemtech.com');
define('MAIL_PASSWORD', 'Champ@123');
define('MAIL_CLIENT', 'gmail.com');	  */
/* 
define('MAIL_PORT', 25);
define('MAIL_HOST', 'mail.uptostart.com');
define('MAIL_USERNAME', 'aniima@aniima.uptostart.com');
define('MAIL_PASSWORD', 'Champ@123');
define('MAIL_CLIENT', 'gmail.com'); 
  */
  
define('MAIL_PORT', 465);
// define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_HOST', 'ssl://smtp.gmail.com');
define('MAIL_USERNAME', 'shankar.xtreem@gmail.com');
define('MAIL_PASSWORD', 'Xtreem@12345678');
define('MAIL_CLIENT', 'gmail.com'); 
/* 
define('MAIL_PORT', 587);
// define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_HOST', 'mail.sdpsolution.com');
define('MAIL_USERNAME', 'demo@sdpsolution.com');
define('MAIL_PASSWORD', 'Champ@123');
define('MAIL_CLIENT', 'gmail.com'); */


$config['EasyPay']			= 	array('easypay_code'=>'b8f81570bf652c2fd4ef3a676dd52cf4');
$config['DISCOUNT_TYPE']	= 	array(2=>'Gift',0=>'Percentage',1=>'Absolute Rate',3=>__('Gift-Voucher'));

$config['Action_request_options'] = array('request'=>'Request');

$config['request'] = array('compaign_name'=>'COMPAIGN_NAME','description'=>'DESCRIPTION','rating'=>'RATING','text_block_1'=>'TEXT_BLOCK_1','text_block_2'=>'TEXT_BLOCK_2','email'=>'EMAIL','category'=>'CATEGORY','price'=>'PRICE','video'=>'VIDEO','store'=>'STORE','brand'=>'BRAND','product_type'=>'PRODUCT_TYPE','service_type'=>'SERVICE_TYPE','country'=>'COUNTRY','district'=>'DISTRICT','county'=>'COUNTY','address'=>'ADDRESS','phone'=>'PHONE','site_url'=>'SITE_URL','mobile'=>'MOBILE','zip_code'=>'ZIP_CODE','sub_category'=>'SUB_CATEGORY');
 ?>