<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class TranslationsController  extends AppController {
   var $name = 'Translations';
  // var $components = array('Axtranslate');
   var $langarr = array(/* 'hi'=>'hin', */'en'=>'eng','pt'=>'por');
   
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('trans','import','export');
	}
	
	
	
	function create(){
		
		$dir 	= 	new Folder(APP);
		$files 	= 	$dir->findRecursive('.*');
		$data_array	=	array();
		foreach($files as $file){
			$file_parts = pathinfo($file);
			if(isset($file_parts['extension']) && ($file_parts['extension']=="php" || $file_parts['extension']=="ctp")){
				$data	=	file_get_contents($file);
				$pattern=	"~(__\('|__\(\")(.*?)(\'\)|\",|\',|\"\)|\" \)|\' \))~";
				preg_match_all ($pattern , $data , $matches);
				$data_array	=	array_filter(array_merge($data_array,$matches[2]));
			}
		}
		$data_array		=	array_unique($data_array);
		pr($data_array); 
		
		$filename		=	'adefault.po';
		$file 			= 	new File(APP."/Locale".DS.$filename);
	
		foreach($data_array as $string){
			$file->write('msgid "' .$string .'"'."\n");
            $file->write('msgstr "'.$string.'"'."\n\n");
			echo $string;
		}
		$file->close();
		die;
	}
   
	function mix(){
		
		if (empty($filename)) $filename='defaultl.po';
		if (empty($filenamef)) $filenamef='defaultf.po';
		if (empty($filenamen)) $filenamen='defaultn.po';
		  $filename = ROOT . DS . 'app' . DS . 'Locale' . DS . $filename;
		  $filenamef = ROOT . DS . 'app' . DS . 'Locale' . DS . $filenamef;
		  $filenamefn = ROOT . DS . 'app' . DS . 'Locale' . DS . $filenamen;
		 // $filename= '/usr/local/www/41max.com/www/dev/app/Locale/default.pot';
		  // open the file
		  $data_array	=	array();
		  $filehandle = fopen($filename, "r");
		  $filehandlef = fopen($filenamef, "r");
		 // $filehandlen = fopen($filenamefn, "w");
		  $file = new File($filenamefn);
		  
		  $data	=	file_get_contents($filenamef);
		  
		 
		 // pr($data); die;
		  
		while (($row = fgets($filehandle)) !== FALSE) {
	 // pr($row);//  die;
         if (substr($row,0,7) == 'msgid "') {
            // parse string in hochkomma:
            $msgid = substr($row, 7 ,(strpos($row,'"',6)-8));
			//echo  $msgid; 
            if (!empty($msgid)) {
               $row = fgets($filehandle);
               if (substr($row,0,8) == 'msgstr "') {
                  $msgstr = substr($row, 8 ,(strpos($row,'"',7)-9));
               }
               $fmsgstr = '';
			   if($lpos = strpos($data,'"'.$msgstr.'"')){
					
					fseek($filehandlef, $lpos); //seek to the end of the line
						
						$fmsgid = fgets($filehandlef);
						$fmsgstr = fgets($filehandlef);
						$fmsgstr = substr($fmsgstr,8,(strpos($fmsgstr,'"',7)-9));
						
				  }
			$file->write('msgid "' .$msgid .'"'."\n");
            $file->write('msgstr "'.((isset($fmsgstr) && !empty($fmsgstr))?$fmsgstr:$msgstr).'"'."\n");
            }
			
			
			
         }
      } 
	  $file->close();
      fclose($filehandle);
      fclose($filehandlef);
		  
		die;
	}
   
   
   /****************First hit url***********************/
   
	function import($filename = '') {
	
		$this->loadModel('Translation');
      // set the filename to read from
      if (empty($filename)) $filename='adefault.po';
      $filename = ROOT . DS . 'admin' . DS. 'Locale' . DS . $filename;
     // $filename= '/usr/local/www/41max.com/www/dev/app/locale/default.pot';

      // open the file
      $filehandle = fopen($filename, "r");
      while (($row = fgets($filehandle)) !== FALSE) {
	 // pr($row);//  die;
         if (substr($row,0,7) == 'msgid "') {
            // parse string in hochkomma:
            $msgid = substr($row, 7 ,(strpos($row,'"',6)-9));
			//echo  $msgid; 
            if (!empty($msgid)) {
               $row = fgets($filehandle);
               if (substr($row,0,8) == 'msgstr "') {
                  $msgstr = substr($row, 8 ,(strpos($row,'"',7)-10));
               }
               // check if exists
			   
				//die;
			  //$trec = array();
			//  echo $msgid; echo '<br />';
			 // echo $msgstr;
               /*  $trec = $this->Translation->find('all',array('conditions'=>array('msgid !='=>$msgid,'msgstr !='=>$msgstr)));
			  if (empty($trec)) { */  
                  $this->Translation->create();
                  $data['Translation']['msgid'] = $msgid;
                  $data['Translation']['msgstr'] = $msgstr;
                  $data['Translation']['locale'] = 'en';
                  $data['Translation']['status'] = 'n';
                  $this->Translation->save($data);
				  
              /*  } else {
                 // $this->setLastUsed($trec['Translation']['id']);
               }   */
            }
         }
      } 
      fclose($filehandle);
   }

   /****************Third hit url***********************/
   function export() {

      // Step 3: export default.po file to the relevant directory
      // $filename= 'f' . gmdate('YmdHis');
      $filename= 'default.po';
      foreach ($this->langarr as $k => $v):

         $path = ROOT.DS.'admin'.DS.'Locale'.DS.$v;
         if (!file_exists($path)) mkdir($path);
         $path .= DS.'LC_MESSAGES';
         if (!file_exists($path)) mkdir($path);
         $file = $path.DS.$filename;
         if (!file_exists($path)) touch($file);

         $file = new File($path.DS.$filename);
         $tmprec = $this->Translation->find('all', array('conditions' => array('Translation.locale' => $k)));
         foreach ($tmprec as $rec):
            $file->write('msgid "' .$rec['Translation']['msgid'] .'"'."\n");
            $file->write('msgstr "'.$rec['Translation']['msgstr'].'"'."\n");
         endforeach;
         $file->close();

        // if (file_exists($path.DS.'default.po'))
             //rename ($path.DS.'default.po',$path.DS.'default.po.old'.gmdate('YmdHis'));
			//rename ($path.DS.$filename,$path.DS.'newdefault.po');
		endforeach;
		die;
   }
   
   /****************Second hit url***********************/

   public function trans() {
   //echo 'Hi'; die;
      // Step 2: translate to all languages defined in $langarr
	  $this->layout	=	false;
      $trec = $this->Translation->findAllByLocale('en');
	//  pr($trec); die;
      foreach ($trec as $rec){
         foreach ($this->langarr as $k => $v){
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

      }
	  
	  exit;
   }
   
   function translate($text, $from = '', $to = 'en') {
                //$url = 'http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q='.rawurlencode($text).'&langpair='.rawurlencode($from.'|'.$to);
                $url = 'http://api.microsofttranslator.com/V2/Ajax.svc/Translate?oncomplete=MicrosoftTranslateComplete&appId=EF45DE6734F756B2F1DEF91B9DFCE3FD0B03748B&text='.urlencode($text).'&from='.urlencode($from).'&to='.urlencode($to).'';
                
				$response 	= 	file_get_contents($url);
				
				
				$result		=	str_replace('");','',substr($response,31,strlen($response)));	
				return $result;
        }
   
   

   
  }

?> 