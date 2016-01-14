<?php
class CityController extends UsermgmtAppController {
	
	
	public function get_countries($filed1='iso3166_1') {
		$this->loadModel('Country');
		$countriesList	=	$this->Country->find('list',array('fields'=>array($filed1,'name'),'order'=>'name'));
		return $countriesList;
		
	}
	
	public function get_states(){
		$this->layout = false;
		if($this->request->isPost()){
			$country_code	=	$this->data['country_code'];
			if($country_code!=''){
				$this->loadModel('Geoname');
				 if(!$stateList = Cache::read('stateList_'.$country_code, 'default_mem')) {
					$stateList	=	$this->Geoname->find('list',array('fields'=>array('admin1_code','name'),'conditions'=>array('feature_code'=>'ADM1','country_code'=>$country_code)));
					
					Cache::write('stateList_'.$country_code, $stateList, 'default_mem');
				}
				$this->set('stateList',$stateList);
				
				$list	=	'';
				if(count($stateList)>0){
					$list.= '<option value="">Select state</option>';
					foreach($stateList as $k=>$v){
						$list.= '<option value='.$k.'>'.$v.'</option>';
					}
				}
				echo $list;
				die;
			}
		}	
	}
	
	public function get_latlongs(){
		$this->layout = false;
		
	}
	public function map(){
		$this->layout = false;
		
	}
	
	public function get_cities(){
		$this->layout = false;		
		if($this->request->isPost()){
			$country_code	=	$this->data['country_code'];
			$state_code		=	$this->data['state_code'];
			$this->loadModel('Geoname');
			
			if(!$cityList = Cache::read('cityList_'.$state_code, 'default_mem')) {
			
				$cityList	=	$this->Geoname->find('all',array('fields'=>array('id','name'),'conditions'=>array('feature_code !="ADM1"','country_code'=>$country_code,'admin1_code'=>$state_code)));
				
				Cache::write('cityList_'.$state_code, $cityList, 'default_mem');
			}
			$this->set('cityList',$cityList);
			$list	=	'';
			
			if(count($cityList)>0){
				$list.= '<option value="">Select city</option>';
				foreach($cityList as $k=>$v){
				
					$list.= '<option value='.$v['Geoname']['id'].'>'.$v['Geoname']['name'].'</option>';
				}
			}			
			echo $list;
			die;
			
		}		
	}
	
public function get_cities_states() {
	 $cityname  =   $this->params['url']['term'];
		 $this->layout = false;		

			$this->loadModel('Geoname');
			    $options['joins'] = array(
					array('table' => 'countries',
						'alias' => 'Country',
						'type' => 'LEFT',
						'conditions' => array(
							'Country.iso3166_1 = Geoname.country_code',
						)
					)
				);
				$options['conditions']	=	array('feature_code !="ADM1"',"Geoname.name like '"."%".$cityname."%"."'");
				$options['fields']		=	array('Country.name as country_name','Geoname.id','Geoname.name');
				$options['limit']		= 20;
				$cityList	=	$this->Geoname->find('all', $options);

				$cities    =   array();
                 $c=0;
                 foreach($cityList as $location){
                    $cities[$c]['label']= $location['Geoname']['name'].", ".$location['Country']['country_name'];
                     $cities[$c]['id']=$location['Geoname']['id'];
                     
                     $c++;
                 }	
				echo json_encode($cities);
               exit;
	        } 
	
	
}
