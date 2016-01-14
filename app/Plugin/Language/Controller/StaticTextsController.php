<?php
class StaticTextsController  extends LanguageAppController  {
	
	
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'StaticTexts';
	
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

	public $language_codes = array(
		/* Afrikaans */ 'afr' => 'af',
		/* Albanian */ 'alb' => 'sq',
		/* Arabic */ 'ara' => 'ar',
		/* Armenian - Armenia */ 'hye' => 'hy',
		/* Basque */ 'baq' => 'eu',
		/* Tibetan */ 'bod' => 'bo',
		/* Bosnian */ 'bos' => 'bs',
		/* Bulgarian */ 'bul' => 'bg',
		/* Byelorussian */ 'bel' => 'be',
		/* Catalan */ 'cat' => 'ca',
		/* Chinese */ 'chi' => 'zh',
		/* Chinese */ 'zho' => 'zh',
		/* Croatian */ 'hrv' => 'hr',
		/* Czech */ 'cze' => 'cs',
		/* Czech */ 'ces' => 'cs',
		/* Danish */ 'dan' => 'da',
		/* Dutch (Standard) */ 'dut' => 'nl',
		/* Dutch (Standard) */ 'nld' => 'nl',
		/* English */ 'eng' => 'en',
		/* Estonian */ 'est' => 'et',
		/* Faeroese */ 'fao' => 'fo',
		/* Farsi */ 'fas' => 'fa',
		/* Farsi */ 'per' => 'fa',
		/* Finnish */ 'fin' => 'fi',
		/* French (Standard) */ 'fre' => 'fr',
		/* French (Standard) */ 'fra' => 'fr',
		/* Gaelic (Scots) */ 'gla' => 'gd',
		/* Galician */ 'glg' => 'gl',
		/* German (Standard) */ 'deu' => 'de',
		/* German (Standard) */ 'ger' => 'de',
		/* Greek */ 'gre' => 'el',
		/* Greek */ 'ell' => 'el',
		/* Hebrew */ 'heb' => 'he',
		/* Hindi */ 'hin' => 'hi',
		/* Hungarian */ 'hun' => 'hu',
		/* Icelandic */ 'ice' => 'is',
		/* Icelandic */ 'isl' => 'is',
		/* Indonesian */ 'ind' => 'id',
		/* Irish */ 'gle' => 'ga',
		/* Italian */ 'ita' => 'it',
		/* Japanese */ 'jpn' => 'ja',
		/* Korean */ 'kor' => 'ko',
		/* Latvian */ 'lav' => 'lv',
		/* Lithuanian */ 'lit' => 'lt',
		/* Macedonian */ 'mac' => 'mk',
		/* Macedonian */ 'mkd' => 'mk',
		/* Malaysian */ 'may' => 'ms',
		/* Malaysian */ 'msa' => 'ms',
		/* Maltese */ 'mlt' => 'mt',
		/* Norwegian */ 'nor' => 'no',
		/* Norwegian Bokmal */ 'nob' => 'nb',
		/* Norwegian Nynorsk */ 'nno' => 'nn',
		/* Polish */ 'pol' => 'pl',
		/* Portuguese (Portugal) */ 'por' => 'pt',
		/* Rhaeto-Romanic */ 'roh' => 'rm',
		/* Romanian */ 'rum' => 'ro',
		/* Romanian */ 'ron' => 'ro',
		/* Russian */ 'rus' => 'ru',
		/* Sami (Lappish) */ 'smi' => 'sz',
		/* Serbian */ 'scc' => 'sr',
		/* Serbian */ 'srp' => 'sr',
		/* Slovak */ 'slo' => 'sk',
		/* Slovak */ 'slk' => 'sk',
		/* Slovenian */ 'slv' => 'sl',
		/* Sorbian */ 'wen' => 'sb',
		/* Spanish (Spain - Traditional) */ 'spa' => 'es',
		/* Swedish */ 'swe' => 'sv',
		/* Thai */ 'tha' => 'th',
		/* Tsonga */ 'tso' => 'ts',
		/* Tswana */ 'tsn' => 'tn',
		/* Turkish */ 'tur' => 'tr',
		/* Ukrainian */ 'ukr' => 'uk',
		/* Urdu */ 'urd' => 'ur',
		/* Venda */ 'ven' => 've',
		/* Vietnamese */ 'vie' => 'vi',
		/* Welsh */ 'cym' => 'cy',
		/* Xhosa */ 'xho' => 'xh',
		/* Yiddish */ 'yid' => 'yi',
		/* Zulu */ 'zul' => 'zu',
		/* Zulu */ 'engUS' => 'en_us',
		/* Zulu */ 'engUK' => 'en_gb'
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
			
	public function index($site_id = 0) {
		
		$dropdown_type='Languages';
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		$this->loadModel('Site');
		$this->loadModel('Language.Language');
		$this->{$this->modelClass}->virtualFields = array(
										'site_name'=>'SELECT name FROM sites WHERE id = '.$this->modelClass.'.site_id');
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['site_id']  = $site_id;
		$this->paginate = array(
		'conditions' => $parsedConditions,
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$result= $this->paginate();
		//pr($result); die;
		$this->set('result', $result);
		$this->set('site_id', $site_id);
	}
		
	public function translator() {
		
		$dropdown_type='Languages';
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		//pr($this->Auth->user()); die;
		
		$user_data = $this->Auth->user();
		$valid_languages  = json_decode($user_data['reg_complete_string'],true);
		
		$pro_languages = array();
		if(!empty($valid_languages)){
			foreach($valid_languages as $valid_language){
			
				if(!empty($valid_language)){
					foreach($valid_language as $pk=>$pro_language){
						if($pro_language==1){
							$pro_languages[] = $pk;
						}	
					}
				}
			}
		}
		
		
		$this->loadModel('Site');
		$this->loadModel('Language.Language');
		$this->{$this->modelClass}->virtualFields = array(
										'site_name'=>'SELECT name FROM sites WHERE id = '.$this->modelClass.'.site_id');
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		//$parsedConditions['site_id']  = $site_id;
		$parsedConditions['id']  = $pro_languages;
		$this->paginate = array(
		'conditions' => $parsedConditions,
		'limit' => $limit,
		'order'=>	array($this->modelClass . '.created' => 'desc')	
		);		
		$result= $this->paginate();
		//pr($result); die;
		$this->set('result', $result);
		//$this->set('site_id', $site_id);
	}
	
	public function edit_expressions($site_id = 0,$language_id  = 0) {
	
		$this->loadModel('Site');
		$this->loadModel('Language');
		if($site_id == 0 || $language_id == 0){
			$this->redirect('/');
		}
		
		$site_data = $this->Site->find('first',array('conditions'=>array('id'=>$site_id)));
		$language_data = $this->Language->find('first',array('conditions'=>array('id'=>$language_id)));
		
		$path = $this->_UploadDirectoryName($site_id,4);
       
		$language_codes = $this->language_codes;
		$language_codes = array_flip($language_codes);
		$short_name = $language_data['Language']['short_name'];
		$path .= $language_codes[$short_name];
			 
		$path .= DS.'LC_MESSAGES'.DS.'default.po';
			 
		/* if (!file_exists($path)){
			$this->Session->setFlash('File not present', 'success');
			$this->redirect($this->referer);
		} */
		$this->set('site_id',$site_id);
		$this->set('language_id',$language_id);
		
		if(empty($this->data)){
			$extrct_array = $this->extract_language_file($path);
			$this->data = $extrct_array;
			$this->set('extrct_array',$extrct_array);
		}else{
			
			
			
			
			$edited_data = $this->data;
			unset($edited_data['Language']['site_id']);
			unset($edited_data['Language']['language_id']);
			//pr($edited_data); die;
			
			$this->export_language($site_id,$short_name,$language_codes[$short_name],$edited_data['Language']);
			
			$this->Session->setFlash( 'Language file successfully edited', 'success');
				$this->redirect(array('action' => 'translator'));
			
		}
		

	}
	function export_language($site_id,$k,$v,$export_data) {

      // Step 3: export default.po file to the relevant directory
      $filename= 'f' . gmdate('YmdHis');
      
		$path = $this->_UploadDirectoryName($site_id,4);
      
		 $path .= $v;
         if (!file_exists($path)){ mkdir($path); }
		// die;
         $path .= DS.'LC_MESSAGES';
		 
         if (!file_exists($path)) mkdir($path);
         $file = $path.DS.$filename;
         if (!file_exists($path)) touch($file);
		$this->loadModel('Translation');
         $file = new File($path.DS.$filename);
		
         $tmprec = $export_data;
		
         foreach ($tmprec as $rec):
            $file->write('msgid "' .$rec['msgid'] .'"'."\n");
            $file->write('msgstr "'.$rec['msgstr'].'"'."\n");
         endforeach;
         $file->close();
		 // pr($tmprec); die;

         if (file_exists($path.DS.'default.po'))
            rename ($path.DS.'default.po',$path.DS.'default.po.old'.gmdate('YmdHis'));
			rename ($path.DS.$filename,$path.DS.'default.po');
			
	  return 1;
		
   }
	
	function extract_language_file($path = ''){
	
		$extrct_array = array();
		$i = 0;
	//	echo $path;
		 $filehandle = fopen($path, "r");
		 
		  while (($row = fgets($filehandle)) !== FALSE) {
		  //pr($row); die;
			 if (substr($row,0,7) == 'msgid "') {
				// parse string in hochkomma:
				$msgid = substr($row, 7 ,(strpos($row,'"',6)-8));
				//echo  $msgid; 
				if (!empty($msgid)) {
				   $row = fgets($filehandle);
				   if (substr($row,0,8) == 'msgstr "') {
					  $msgstr = substr($row, 8 ,(strpos($row,'"',7)-9));
				   }
				   $extrct_array[$i]['msgid']  = $msgid;
				   $extrct_array[$i]['msgstr']  = $msgstr;
				  $i++;
				  
				}
			 }
		  } 
		  fclose($filehandle);
		  return $extrct_array;
	}


	function add($site_id = 0,$dropdown_type='Languages') {
		
		global $language_codes;
		
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		$breadcrumb = array('pages' => $pages, 'active' =>'Add New '.$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		$this->loadModel('Site');
		$site = $this->Site->find('list',array('fields'=>array('id','name')));
		$this->set("site",$site);
		
		
		$this->loadModel('Language');
		$languages = $this->Language->find('list',array('fields'=>array('id','short_name')));
		$this->set("languages",$languages);
		$this->set("site_id",$site_id);
		
			if (!empty($this->data)) {
			
			//pr($this->data); die;
			 $language_codes = $this->language_codes;
			 $language_codes = array_flip($language_codes);
			 
			 $plang = $this->{$this->modelClass}->find('count',array('conditions'=>array('site_id'=>$site_id,'short_name'=>$this->data['Language']['short_name'])));
			 if($plang){
				$this->Session->setFlash($singularize . ' already present', 'success');
				$this->redirect(array('action' => 'index',$site_id));
			 }
			 
				$short_name = $this->data['Language']['short_name'];	
				$language_name = $this->data['Language']['name'];	
				$lang_site_id = $this->data['Language']['site_id'];	
				if(in_array($short_name,$languages)){
					$this->export($lang_site_id,$short_name,$language_codes[$short_name]);
				}else{
					$this->trans($lang_site_id,$short_name,$language_codes[$short_name]);
					$this->export($lang_site_id,$short_name,$language_codes[$short_name]);
				}
			
				$this->{$this->modelClass}->set($this->data);
					$data = array();
					$data = $this->data;
					$this_site_id =  $data[$this->modelClass]['site_id'];
 					if ($this->{$this->modelClass}->save($data,false)) {
						$this_language_id = $this->{$this->modelClass}->id;
						$this->loadModel('MenuTemplate');
						$this->loadModel('Menu');
						$this->loadModel('CategoryTemplate');
						$this->loadModel('Category');
						$this->loadModel('Section');
						$this->loadModel('SectionTemplate');
						$this->loadModel('SectionContent');
						$this->loadModel('SectionContentTemplate');
						$this->loadModel('ProductAdvisorStaticContentTemplates');
						$this->loadModel('ProductAdvisorStaticContent');
						
						 $menu_templates = $this->MenuTemplate->find('all');
						//pr($menu_templates); die;
						if(!empty($menu_templates)){
							foreach($menu_templates as $menu_template){
								$prev_menu_id  = $menu_template['MenuTemplate']['id'];
								unset($menu_template['MenuTemplate']['id']);
								$menu_template['MenuTemplate']['lang_id']  = $this_language_id;
								$menu_template['MenuTemplate']['site_id']  = $this_site_id;
								$this->Menu->create();
								//pr($menu_template['MenuTemplate']); 
								$this->Menu->save($menu_template['MenuTemplate'],false);
									$this_menu_id = $this->Menu->id;
									
									$menu_categories  = $this->CategoryTemplate->find('all',array('conditions'=>array('menu_id'=>$prev_menu_id)));
									//pr($menu_categories);
									if(!empty($menu_categories)){
										foreach($menu_categories as $menu_category){
											unset($menu_category['CategoryTemplate']['id']);
											$menu_category['CategoryTemplate']['menu_id']  = $this_menu_id;
											$this->Category->create();
											$this->Category->save($menu_category['CategoryTemplate'],false);
										}
									}
							}
							
						} 
						$section_templates = $this->SectionTemplate->find('all');
						if(!empty($section_templates)){
							foreach($section_templates as $section_template){
								$prev_section_id  = $section_template['SectionTemplate']['id'];
								unset($section_template['SectionTemplate']['id']);
								$section_template['SectionTemplate']['lang_id']  = $this_language_id;
								$section_template['SectionTemplate']['site_id']  = $this_site_id;
								$this->Section->create();
								//pr($menu_template['MenuTemplate']); 
								$this->Section->save($section_template['SectionTemplate'],false);
									$this_section_id = $this->Section->id;
									
									$section_content_templates = $this->SectionContentTemplate->find('all',array('conditions'=>array('section_id'=>$prev_section_id)));
									if(!empty($section_content_templates)){
										foreach($section_content_templates as $section_content_template){
											$prev_section_content_id  = $section_content_template['SectionContentTemplate']['id'];
											unset($section_content_template['SectionContentTemplate']['id']);
											$section_content_template['SectionContentTemplate']['lang_id']  = $this_language_id;
											$section_content_template['SectionContentTemplate']['section_id']  = $this_section_id;
											$section_content_template['SectionContentTemplate']['site_id']  = $this_site_id;
											$this->SectionContent->create();
											//pr($menu_template['MenuTemplate']); 
											$this->SectionContent->save($section_content_template['SectionContentTemplate'],false);
												$this_section_content_id = $this->SectionContent->id;
										}
									}
							}
						}
						
						
						
						$advisor_static_content_templates = $this->ProductAdvisorStaticContentTemplates->find('all');
						if(!empty($advisor_static_content_templates)){
							foreach($advisor_static_content_templates as $advisor_static_content_template){
								$prev_advisor_static_content_id  = $advisor_static_content_template['ProductAdvisorStaticContentTemplates']['id'];
								unset($advisor_static_content_template['ProductAdvisorStaticContentTemplates']['id']);
								$advisor_static_content_template['ProductAdvisorStaticContentTemplates']['lang_id']  = $this_language_id;
								$advisor_static_content_template['ProductAdvisorStaticContentTemplates']['site_id']  = $this_site_id;
								$this->ProductAdvisorStaticContent->create();
								//pr($menu_template['MenuTemplate']); 
								$this->ProductAdvisorStaticContent->save($advisor_static_content_template['ProductAdvisorStaticContentTemplates'],false);
									$this_advisor_static_content_id = $this->ProductAdvisorStaticContent->id;
							}
						}
						
						$this->Session->setFlash($singularize . ' has been added.', 'success');
						$this->redirect(array('action' => 'index',$site_id));
					}
				
			}
	}
	
	
   public function trans($site_id,$k,$v) {
   
      // Step 2: translate to all languages defined in $langarr
	  $this->layout	=	false;
	  $this->loadModel('Translation');
      $trec = $this->Translation->findAllByLocale('en');
	//  pr($trec); die;
      foreach ($trec as $rec){
	  
            $tmprec = $this->Translation->find('all',array('conditions' => array('Translation.locale' =>$k,'Translation.msgid  LIKE binary "'.addslashes($rec['Translation']['msgid']).'" ')));
			
			//pr($tmprec); die;
            if (count($tmprec) == 0) {
				$this->Translation->create();
               $data['Translation']['msgstr'] = $this->translate($rec['Translation']['msgid'], 'en', $k);
			   $data['Translation']['msgid'] = $rec['Translation']['msgid'];
               $data['Translation']['locale'] = $k;
               $data['Translation']['status'] = 'm';
			   
			   //pr($data); die;
			   
			   
               $this->Translation->save($data);
			   //$this->render('elements/sql_dump');
			   
            }

      }
	  
	  return 1;
   }
    function translate($text, $from = '', $to = 'en') {
                //$url = 'http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q='.rawurlencode($text).'&langpair='.rawurlencode($from.'|'.$to);
                $url = 'http://api.microsofttranslator.com/V2/Ajax.svc/Translate?oncomplete=MicrosoftTranslateComplete&appId=EF45DE6734F756B2F1DEF91B9DFCE3FD0B03748B&text='.urlencode($text).'&from='.urlencode($from).'&to='.urlencode($to).'';
                
				$response 	= 	file_get_contents($url);
				
				
				$result		=	str_replace('");','',substr($response,31,strlen($response)));	
				return $result;
	}
   
  
  function export($site_id,$k,$v) {

      // Step 3: export default.po file to the relevant directory
      $filename= 'f' . gmdate('YmdHis');
      
		$path = $this->_UploadDirectoryName($site_id,4);
      
		 $path .= $v;
         if (!file_exists($path)){ mkdir($path); }
		// die;
         $path .= DS.'LC_MESSAGES';
		 
         if (!file_exists($path)) mkdir($path);
         $file = $path.DS.$filename;
         if (!file_exists($path)) touch($file);
		$this->loadModel('Translation');
         $file = new File($path.DS.$filename);
		
         $tmprec = $this->Translation->find('all', array('conditions' => array('Translation.locale' => $k)));
		 
         foreach ($tmprec as $rec):
            $file->write('msgid "' .$rec['Translation']['msgid'] .'"'."\n");
            $file->write('msgstr "'.$rec['Translation']['msgstr'].'"'."\n");
         endforeach;
         $file->close();

         if (file_exists($path.DS.'default.po'))
            rename ($path.DS.'default.po',$path.DS.'default.po.old'.gmdate('YmdHis'));
			rename ($path.DS.$filename,$path.DS.'default.po');
			
	  return 1;
		
   }
  
  
	function edit($site_id = 0,$id = null) {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash('Invalid Access.', 'error');
			 $this->redirect(array('action' => 'index'));
		  }
		  $dropdown_type='Languages';
			$user = $this->{$this->modelClass}->findById($id);
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['name'], true));
			
			$this->{$this->modelClass}->id = $id; 
			$this->set('breadcrumb', $breadcrumb);
			$this->set('dropdown_type', $dropdown_type);
			$this->set('humanize', $humanize);
			$this->set('singularize', $singularize);
			$this->set('id', $id);
			$this->set("site_id",$site_id);
			
		
			if (empty($this->data)) {
				$this->data = $this->{$this->modelClass}->read();
				
				
			 } else {
				 $data = array();
					$data = $this->data;
					
					
 					if ($this->{$this->modelClass}->save($data,false)) {
						
						$this->Session->setFlash($singularize . ' has been added.', 'success');
						$this->redirect(array('action' => 'index',$site_id));
					}
				
			}
	}
	
 function delete($id=null) {	 
 
	if($id == null){
				die("No ID received");
			}else{	
			$dropdown_type = 'Languages';
				$humanize 				= Inflector::humanize($dropdown_type);
				$singularize 			= Inflector::singularize($humanize);
				$this->{$this->modelClass}->delete($id);
				$this->Session->setFlash($singularize.' has been deleted.','success');
				$this->redirect(array('action'=>'index',$dropdown_type));
			}
	}	
	
 function status_change($site_id=0,$id=null) {	 
 
	if($id == null){
				die("No ID received");
			}else{	
			$language = $this->{$this->modelClass}->find('first',array('conditions'=>array('id'=>$id)));
			$dropdown_type = 'Languages';
				$humanize 				= Inflector::humanize($dropdown_type);
				$singularize 			= Inflector::singularize($humanize);
				
				if($language['Language']['active']){
					$status['active'] = 0;
					}else{
					$status['active'] = 1;
					}
				$this->{$this->modelClass}->id = $language['Language']['id'];
				
				$this->{$this->modelClass}->save($status,false);
				$this->Session->setFlash($singularize.' has been changed.','success');
				$this->redirect(array('action'=>'index',$site_id,$dropdown_type));
			}
	}	
		
		
}
