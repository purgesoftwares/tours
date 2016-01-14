<?php
class TransactionsController  extends TransactionAppController  {
	
	
/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Transactions';
	
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
			
	public function index($dropdown_type='Active Transactions') {		
		$dropdown_type=__('Active Transactions');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		
		$pageHeading	=	__('Active Transactions');
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['status'] = 1;
		$parsedConditions['completed'] = 0;
		
		if($this->Auth->user('user_role_id')!=1 && $this->Auth->user('user_role_id')!=4){
			$parsedConditions['employee_id'] = $this->Auth->user('id');
		}
		
		$this->paginate = array(
								'conditions' => $parsedConditions,
								// 'limit' => $limit,
								'limit' => -1,
								'order'=>	array($this->modelClass . '.created' => 'desc')	
								);		
		$result= $this->paginate();
		// pr($result); die;
		$this->set('result', $result);
	}
	
	public function generate_order_pdf($transaction_id = 0){
	
		if($transaction_id == 0){
			$this->Session->setFlash(__( 'Invalid access.'), 'success');
			$this->redirect(array('action'=>'index'));
		}
		
		$transaction = $this->{$this->modelClass}->find('first',array('conditions'=>array($this->modelClass.'.id'=>$transaction_id)));
		// pr($transaction); die;
	
			$html = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><style>@font-face{font-family:\'Liberation Serif\';src:url("'.WEBSITE_URL.'/speed_connect/css/Liberation-Serif/LiberationSerif-Regular.ttf") format("truetype");font-weight:normal;font-style:normal}
			.address{font-size:12px;} .head-name{font-size:18px;}.head1-name{font-size:17px;} p{margin:0;} .points{ font-size:13px; margin:0px 25px 0px 20px; } .bold-italic{ font-weight:bold; font-style:italic;} .pointshead{ margin:0px 20px; } .in-content{ width:750px; } .arial-bold-italic{ font-family:Arial; font-weight:bold; font-style: italic;} .fmid{ font-size:17px;}.fdate{ font-size:16px;} .toppad{ padding-top:10px} .border1{ border: 0.5px solid #aaa;}</style>
			</head><body><div class="heading" style="width:750px; padding:0px;font-family:Liberation Serif;line-height:13px; font-size:14px; ">
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="fdate">Data: '.date('d.m.Y').'</span><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong class="fdate">Comanda de transport. nr. '.(isset($transaction['Transaction']['order_id'])?$transaction['Transaction']['order_id']:'______').'</strong><br />
	<img align="left" height="85" src="'.WEBSITE_URL.'/img/logo1.jpg" style="margin-top:-65px;" />
	
	
	<table  cellpadding="2" cellspacing="0" style="margin-top:1px;">
		<tbody>
			<tr >
				<td style="width:355px;" class="toppad border1">
					De la: <strong class="head-name">Speed Connect Cargo SRL</strong>
					<p class="address">Adresa de facturare: B-dul Republicii, Nr. 18, 110062, Pitesti, Jud. Arges<br />
					Persoana de contact: '.(isset($transaction['Employee']['first_name'])?$transaction['Employee']['first_name']:'___________').' '.(isset($transaction['Employee']['last_name'])?$transaction['Employee']['last_name']:'_______').', '.(isset($transaction['Employee']['mobile'])?$transaction['Employee']['mobile']:'_________').'<br />
					Email: <a href="mailto:'.(isset($transaction['Employee']['email'])?$transaction['Employee']['email']:'').'">'.(isset($transaction['Employee']['email'])?$transaction['Employee']['email']:'_________').'</a></p></td>
				<td style="width:350px;" class="toppad border1">
					Catre: <strong class="head-name">'.(isset($transaction['Transporter']['first_name'])?$transaction['Transporter']['first_name']:'_________').'</strong><br />
					<p class="address">Adresa: 
					'.((isset($transaction['Transporter']['address']) && !empty($transaction['Transporter']['address']))?$transaction['Transporter']['address']:'__________').'<br />
					Email: '.(isset($transaction['Transporter']['email'])?$transaction['Transporter']['email']:'________').'</p></td>
			</tr>
			<tr>
				<td colspan="2" style="width:705px;height:25px;" class="fmid border1">
					<strong class="head1-name" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PRET: '.(isset($transaction['Transaction']['money_out'])?$transaction['Transaction']['money_out']:'_______').' '.(isset($transaction['Transaction']['currency'])?$transaction['Transaction']['currency']:'____').' + TVA</strong></td>
			</tr>
			<tr>
				<td style="width:355px;height:58px;" class="fmid toppad border1">
					Incarcare: <strong class="bold-italic">'.(isset($transaction['Transaction']['load_location'])?$transaction['Transaction']['load_location']:'___________').'</strong><br />
					<strong>Referinta: '.(isset($transaction['Transaction']['loading_reference'])?$transaction['Transaction']['loading_reference']:'___________').'</strong></td>
				<td style="width:350px;height:58px; padding-top:5px;" class="fmid border1">
					Descarcare:'.((isset($transaction['Transaction']['unload_location']) && !empty($transaction['Transaction']['unload_location']))?$transaction['Transaction']['unload_location']:'__________').' - conform documente avize +cmr confirmate</td>
			</tr>
			<tr>
				<td style="width:355px;height:48px;" class="fmid border1">
					Sofer: '.((isset($transaction['Transaction']['driver_details']) && !empty($transaction['Transaction']['driver_details']))?$transaction['Transaction']['driver_details']:'_________ _________').'</td>
				<td style="width:350px;height:48px;" class="fmid border1">
					Auto: '.((isset($transaction['Transaction']['truck_number']) && !empty($transaction['Transaction']['truck_number']))?$transaction['Transaction']['truck_number']:'__________').'</td>
			</tr>
		</tbody>
	</table>
	&nbsp;<br />
	<div class="in-content">
	<strong class="pointshead">Anexa Contract : </strong><br /><p class="points">
	1. Acest transport se va efectua in concordanta cu regulamentele conventiei CMR si TIR.<br />
	2. Transportatorul este raspunzator conform scrisorii CMR, iar asigurarea CMR va fi acoperita de catre acesta.<br />
	3. Se va aviza zilnic pozitia autovehiculului, cel tarziu pana la ora 10:00 dimineata, incepand cu ziua incarcarii si pana la descarcare.<br />
	4. Transbordarea marfurilor, respectiv subinchirierea comenzii altui transportator, sunt strict interzise fara acordul scris al SC Speed Connect Cargo SRL.<br />
	5. Orice intarziere la locul de incarcare / descarcare nejustificata si neanuntata, precum si depasirea duratei de transport duce la o penalizare de 250&euro; / zi de intarziere.<br />
	6. Prezenta comanda se considera acceptata si fara confirmare scrisa daca in termen de 1 (una) ora de la primirea acesteia transportatorul nu ne comunica in scris refuzul motivat al efectuarii transportului.<br />
	In cazul in care anulati aceasta comanda dupa mai mult de 1 (una) ora de la primirea ei, veti suporta o penalizare de 200 &euro;.<br />
	7. Orice costuri suplimentare generate de nerespectarea prezentului contract cad in sarcina transportatorului. in cazul in care firma transportatoare nu comunica problemele aparute in intervalul incepand cu momentul confirmarii comenzii de transport si pana la prezentarea documentelor de descarcare a marfii.<br />
	8. Termenul liber de penalizari de asteptare la incarcare, respectiv descarcare, este de 48 ore pentru tarile UE si 48 ore pentru tarile NON UE. Parasirea locului de incarcare /descarcare (sub 24h pentru tarile UE si 48h pentru tarile NON UE) se penalizeaza cu suma de 400 &euro;.<br />
	9. Penalitatile de stationare vor fi acceptate numai in cazul in care vor fi furnizate note scrise pe CMR sau pe un alt document asemanator (ex. Standing Card) privind data si ora de sosire / plecare a camionului la / de la locul de incarcare / descarcare conform comenzii de transport si numai daca transportatorul nu intarzie la incarcare / descarcare conform datelor din comanda de transport.<br />
	<strong>10. Camionul trebuie sa fie in stare perfecta de functionare, podea curata, prelata intacta, cablu vamal in stare perfecta, dotat cu echipamentul necesar pentru asigurarea si protejarea marfii (chingi pentru ancorare, coltare de protectie, covorase antiderapante, etc.); soferul trebuie sa aiba echipament de protectie: manusi, bocanci, vesta reflectorizanta, casca. Prezentarea la incarcare a unui camion neconform din punct de vedere tehnic sau neconform cu specificatiile din comanda de transport poate atrage dupa sine penalizari in valoare egala cu prejudiciul creat.</strong><br />
	Transportatorul are obligatia de a se prezenta la incarcare cu camionul in stare perfecta de functionare, podeaua curata, prelata intacta, cablu vamal in stare perfecta si podeaua sa suporte o greutate de pana la 3,5t a motostivuitorului sau a altui echipament utilizat pentru incarcare / descarcare.<br />
	11. Transportatorul este raspunzator pentru incarcarea corecta a marfii in autovehicul, depasirea greutatii totale sau pe axe si pentru toate daunele (inclusiv eventualele amenzi) survenite din cauza incarcarii necorespunzatoare sau din cauza lipsei asigurarii marfii in autovehicul. La incarcare si descarcare soferul este obligat sa verifice daca starea marfurilor si cantitatea corespund cu inscrisurile din documentele oficiale si comanda de transport. Daca masina paraseste locul de incarcare fara a anunta in scris eventualele diferente de cantitate/dimensiuni, transportatorul este pe deplin raspunzator si nu are dreptul sa ceara extra costuri.Transportatorul este obligat sa noteze pe documentul de transport toate discrepantele conform conventiei CMR si TIR.</p></div><br />
	
	
					<img height="188" src="'.WEBSITE_URL.'img/stamp.jpg" width="222" style="margin-bottom:-120px;margin-left:90px;" /></td>
		
	<br clear="ALL" />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Speed Connect Cargo SRL&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRANSPORTATOR<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.........................<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	
	
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="fdate">Data: '.date('d.m.Y').'</span><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong class="fdate">Comanda de transport. nr. '.(isset($transaction['Transaction']['order_id'])?$transaction['Transaction']['order_id']:'________').'</strong><br />
	<img align="left" height="85" src="'.WEBSITE_URL.'img/logo1.jpg" style="margin-top:-65px;" />
	
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	<div class="in-content">
	<p class="points">
	12. Orice problema / paguba / deteriorare / distrugere adusa marfii in timpul transportului va fi suportata numai de catre firma transportatoare. Soferul este obligat sa asiste la incarcare si, respectiv, la descarcare si este raspunzator de intreaga marfa pe tot parcursul timpului pana la destinatie. Transportatorul se obliga sa respecte termenele si instructiunile primite prin prezentul contract si sa comunice imediat in scris despre orice problema aparuta care ar putea afecta derularea in bune conditii a contractului de transport, in caz contrar fiind pasibil de a suporta penalizari de pana la 20% din valoarea totala a transportului.<br />
	13. Din momentul acceptarii comenzii, transportatorul declara ca daca vor fi reclamatii referitoare la daune survenite in afara transportului, ne imputerniceste sa retinem sumele pe care i le datoram pana la clarificarea situatiei aparute. Dupa solutionarea cazului si semnarea protocolului / acordului intre parti, in termen de 10 (zece) zile lucratoare, va fi efectuata plata sumelor datorate, cu exceptia sumei aferente daunei.<br />
	<span style="text-align:none;">14. Neutralitatea totala fata de client este obligatorie. In caz contrar, transportatorul va suporta  o &nbsp;&nbsp; penalizare &nbsp;&nbsp; in  &nbsp;&nbsp; valoare  &nbsp;&nbsp; de  5.000&euro;, plus daune de interese.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
	15. Documente necesare la avizarea transportului: CMR, asigurarea CMR obligatorie in valoare de 50.000 euro la transport intern si 100.000&euro; la transport international, indiferent de destinatia transportului.<span><br />
	16. Incarcarea altor marfuri in camion se face numai cu acordul SC Speed Connect Cargo SRL In cazul in care pentru un transport angajat in exclusivitate se descopera incarcarea in camion a altor marfuri, transportatorul va suporta o penalizare de minim 1000 &euro; pentru fiecare partida de marfa incarcata fara acordul scris al&nbsp; SC Speed Connect Cargo SRL<br />
	17. Partile sunt de acord ca eventualele litigii aparute sa fie solutionate legal de catre Camera de Comert si Industrie a Romaniei &ndash; Bucuresti.<br />
	18. Netransmiterea documentelor originale in termen de 7 zile de la efectuarea transportului atrage dupa sine prelungirea termenului de plata la 15 de zile de la primirea acestora. Daca in termen de 15 zile documentele nu au fost primite, se pot percepe penalizari de 1% / zi din valoarea toatala.<br />
	<strong>19</strong>. <strong>Conditii de plata: Plata se va efectua prin virament bancar, la '.((isset($transaction['Transaction']['payment_terms']) && !empty($transaction['Transaction']['payment_terms']))?$transaction['Transaction']['payment_terms']:'___').' zile de la primirea facturii, a CMR-ului confirmat in </strong><br />
	<strong>ORIGINAL, precum si a altor documente care insotesc transportul (packing list, avize de insotire, facturi, note de cantar, </strong><br />
	<strong>standing card-uri, etc.). </strong><br />
	<strong style="background-color:yellow;">ATENTIE!</strong><strong> Factura se va intocmi cu datele si adresa sediului social (SC Speed Connect Cargo SRL, B-dul Republicii, </strong><br />
	<strong>Nr. 18, 110062, Pitesti, Jud. Arges, Nr.Reg.Com.: J3/923/2014, C.F. RO33390171, Conturi:<br />
	RON : RO91INGB0000999904479897&nbsp;&nbsp; /EUR &ndash;RO53INGB0000999904479902&nbsp;&nbsp; - ING BANK Pitesti) si se va trimite, </strong><br />
	<strong>impreuna cu documentele transportului, pe adresa B-dul Republicii, Nr. 18, 110062, Pitesti, Jud. Arges. Pe factura de transport se va nota obligatoriu numarul comenzii de transport. In cazul in care factura nu este trimisa la adresa de corespondenta mentionata sau documentele cursei nu sunt in original si complete, nu ne asumam responsabilitatea pentru modificarea termenului de plata.</strong><br />
	20. In cazul in care organele de control abilitate descopera in autovehicul bunuri incarcate in scop de contrabanda, transportatorul va suporta toate prejudiciile asociate, precum si daune morale catre SC Speed Connect Cargo SRL in plus, putem impune transportatorului o penalizare de 10.000 &euro; si oprirea tuturor platilor datorate catre acesta pentru servicii de transport prestate. Pentru a evita acest gen de incidente, soferul va asista la procesul de incarcare a autovehiculului incheiat prin sigilarea acestuia. Soferul isi asuma raspunderea si intelege sa nu faca contrabanda cu alcool, tigari, tutun, iar transportatorul este responsabil in fata SC Speed Connect Cargo SRL pentru toate actiunile soferului.<br />
	21. In cazul in care vama nu se efectueaza la locatia furnizorului, soferul nu va parasi locul incarcarii daca autovehiculul nu este sigilat cu un sigiliu numerotat. Sigiliul poate fi indepartat doar de autoritatile vamale. Dupa efectuarea controlului vamal si numai dupa incheierea operatiunilor de vamuire, autoritatile competente vor resigila autovehiculul cu un alt sigiliu cu numar de inregistrare.<br /></p></div>
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	
	<br />
	<table align="left" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td height="3">
					&nbsp;</td>
			</tr>
			<tr>
				<td>
					&nbsp;</td>
				<td>
					<img height="188" src="'.WEBSITE_URL.'img/stamp.jpg" width="222" style="margin-bottom:-120px;margin-left:65px;" /></td>
			</tr>
		</tbody>
	</table>
	&nbsp;<br />
	&nbsp;<br />
	<br clear="ALL" />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Speed Connect Cargo SRL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRANSPORTATOR<br />
	&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &hellip;.........................<br />
	&nbsp;</div></body></html>';
// echo $html; die;
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
						$this->dompdf = new DOMPDF();
						// $papersize = "legal";
						$papersize = "letter";
						$orientation = "landscape";
						$this->dompdf->load_html($html);
						
						$this->dompdf->render();
						$order_id = $transaction['Transaction']['order_id'];
						$filename = "order_pdfs/".$order_id."_order_pdf_".date("Y.m.d.H.i.s").".pdf";
						
						// The next call will store the entire PDF as a string in $pdf

						$pdf = $this->dompdf->output();

						// You can now write $pdf to disk, store it in a database or stream it
						// to the client.

						file_put_contents($filename, $pdf);
						
						
						
						
						$to 				= $transaction['Transporter']['email'];
						
						$from 				= "Speed Connect Cargo<orders@speedconnectcargo.ro>";

						$replyTo 			= "";
						$subject 			= 'Comanda '.$order_id.' din data de '.date('d-m-Y');
						
						$message 			= 'Buna ziua, <br/>
Gasiti atasata comanda de transport '.$order_id.' din data de '.date('d-m-Y').'.  Va rugam sa o confirmati in cel mai scurt timp si sa o atasati confirmata la facturare, insotita de documentele transportului ( CMR, Avize, note de cantar – unde este cazul). <br/><br/>

Va multumim si va dorim o zi buna!';
						
						//pr($message); die;
						echo $this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), $filename, 'html', $bcc = array('office@speedconnectcargo.ro',$transaction['Employee']['email']));

						$this->Session->setFlash(__( 'Sent Successfully.'), 'success');
						$this->redirect(array('action'=>'index'));
						// $this->dompdf->stream($filename);
						
			exit;
	}
	
	public function download_order_pdf($transaction_id = 0){
	
		if($transaction_id == 0){
			$this->Session->setFlash(__( 'Invalid access.'), 'success');
			$this->redirect(array('action'=>'index'));
		}
		
		$transaction = $this->{$this->modelClass}->find('first',array('conditions'=>array($this->modelClass.'.id'=>$transaction_id)));
		// pr($transaction); die;
	
			$html = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><style>@font-face{font-family:\'Liberation Serif\';src:url("'.WEBSITE_URL.'/speed_connect/css/Liberation-Serif/LiberationSerif-Regular.ttf") format("truetype");font-weight:normal;font-style:normal}
			.address{font-size:12px;} .head-name{font-size:18px;}.head1-name{font-size:17px;} p{margin:0;} .points{ font-size:13px; margin:0px 25px 0px 20px; } .bold-italic{ font-weight:bold; font-style:italic;} .pointshead{ margin:0px 20px; } .in-content{ width:750px; } .arial-bold-italic{ font-family:Arial; font-weight:bold; font-style: italic;} .fmid{ font-size:17px;}.fdate{ font-size:16px;} .toppad{ padding-top:10px} .border1{ border: 0.5px solid #aaa;}</style>
			</head><body><div class="heading" style="width:750px; padding:0px;font-family:Liberation Serif;line-height:13px; font-size:14px; ">
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="fdate">Data: '.date('d.m.Y').'</span><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong class="fdate">Comanda de transport. nr. '.(isset($transaction['Transaction']['order_id'])?$transaction['Transaction']['order_id']:'______').'</strong><br />
	<img align="left" height="85" src="'.WEBSITE_URL.'/speed_connect/img/logo2.jpg" style="margin-top:-65px;" />
	
	
	<table  cellpadding="2" cellspacing="0" style="margin-top:1px;">
		<tbody>
			<tr >
				<td style="width:355px;" class="toppad border1">
					De la: <strong class="head-name">Speed Connect Cargo SRL</strong>
					<p class="address">Adresa de facturare: B-dul Republicii, Nr. 18, 110062, Pitesti, Jud. Arges<br />
					Persoana de contact: '.(isset($transaction['Employee']['first_name'])?$transaction['Employee']['first_name']:'___________').' '.(isset($transaction['Employee']['last_name'])?$transaction['Employee']['last_name']:'_______').', '.(isset($transaction['Employee']['mobile'])?$transaction['Employee']['mobile']:'_________').'<br />
					Email: <a href="mailto:'.(isset($transaction['Employee']['email'])?$transaction['Employee']['email']:'').'">'.(isset($transaction['Employee']['email'])?$transaction['Employee']['email']:'_________').'</a></p></td>
				<td style="width:350px;" class="toppad border1">
					Catre: <strong class="head-name">'.(isset($transaction['Transporter']['first_name'])?$transaction['Transporter']['first_name']:'_________').'</strong><br />
					<p class="address">Adresa: 
					'.((isset($transaction['Transporter']['address']) && !empty($transaction['Transporter']['address']))?$transaction['Transporter']['address']:'__________').'<br />
					Email: '.(isset($transaction['Transporter']['email'])?$transaction['Transporter']['email']:'________').'</p></td>
			</tr>
			<tr>
				<td colspan="2" style="width:705px;height:25px;" class="fmid border1">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<strong class="head1-name" >RUTA:Vado Ligure-Bucuresti&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PRET: '.(isset($transaction['Transaction']['money_out'])?$transaction['Transaction']['money_out']:'_______').' '.(isset($transaction['Transaction']['currency'])?$transaction['Transaction']['currency']:'____').' + TVA</strong></td>
			</tr>
			<tr>
				<td style="width:355px;height:58px;" class="fmid toppad border1">
					Incarcare: <strong class="bold-italic">'.(isset($transaction['Transaction']['load_location'])?$transaction['Transaction']['load_location']:'___________').'</strong><br />
					<strong>Referinta: '.(isset($transaction['Transaction']['loading_reference'])?$transaction['Transaction']['loading_reference']:'___________').'</strong></td>
				<td style="width:350px;height:58px; padding-top:5px;" class="fmid border1">
					Descarcare:'.((isset($transaction['Transaction']['unload_reference']) && !empty($transaction['Transporter']['unload_reference']))?$transaction['Transaction']['unload_reference']:'__________').' - conform documente avize +cmr confirmate</td>
			</tr>
			<tr>
				<td style="width:355px;height:48px;" class="fmid border1">
					Sofer: '.((isset($transaction['Transaction']['driver_details']) && !empty($transaction['Transporter']['driver_details']))?$transaction['Transaction']['driver_details']:'_________ _________').'</td>
				<td style="width:350px;height:48px;" class="fmid border1">
					Auto: '.((isset($transaction['Transaction']['truck_number']) && !empty($transaction['Transporter']['truck_number']))?$transaction['Transaction']['truck_number']:'__________').'</td>
			</tr>
		</tbody>
	</table>
	&nbsp;<br />
	<div class="in-content">
	<strong class="pointshead">Anexa Contract : </strong><br /><p class="points">
	1. Acest transport se va efectua in concordanta cu regulamentele conventiei CMR si TIR.<br />
	2. Transportatorul este raspunzator conform scrisorii CMR, iar asigurarea CMR va fi acoperita de catre acesta.<br />
	3. Se va aviza zilnic pozitia autovehiculului, cel tarziu pana la ora 10:00 dimineata, incepand cu ziua incarcarii si pana la descarcare.<br />
	4. Transbordarea marfurilor, respectiv subinchirierea comenzii altui transportator, sunt strict interzise fara acordul scris al SC Speed Connect Cargo SRL.<br />
	5. Orice intarziere la locul de incarcare / descarcare nejustificata si neanuntata, precum si depasirea duratei de transport duce la o penalizare de 250&euro; / zi de intarziere.<br />
	6. Prezenta comanda se considera acceptata si fara confirmare scrisa daca in termen de 1 (una) ora de la primirea acesteia transportatorul nu ne comunica in scris refuzul motivat al efectuarii transportului.<br />
	In cazul in care anulati aceasta comanda dupa mai mult de 1 (una) ora de la primirea ei, veti suporta o penalizare de 200 &euro;.<br />
	7. Orice costuri suplimentare generate de nerespectarea prezentului contract cad in sarcina transportatorului. in cazul in care firma transportatoare nu comunica problemele aparute in intervalul incepand cu momentul confirmarii comenzii de transport si pana la prezentarea documentelor de descarcare a marfii.<br />
	8. Termenul liber de penalizari de asteptare la incarcare, respectiv descarcare, este de 24 ore pentru tarile UE si 48 ore pentru tarile NON UE. Parasirea locului de incarcare /descarcare (sub 24h pentru tarile UE si 48h pentru tarile NON UE) se penalizeaza cu suma de 400 &euro;.<br />
	9. Penalitatile de stationare vor fi acceptate numai in cazul in care vor fi furnizate note scrise pe CMR sau pe un alt document asemanator (ex. Standing Card) privind data si ora de sosire / plecare a camionului la / de la locul de incarcare / descarcare conform comenzii de transport si numai daca transportatorul nu intarzie la incarcare / descarcare conform datelor din comanda de transport.<br />
	<strong>10. Camionul trebuie sa fie in stare perfecta de functionare, podea curata, prelata intacta, cablu vamal in stare perfecta, dotat cu echipamentul necesar pentru asigurarea si protejarea marfii (chingi pentru ancorare, coltare de protectie, covorase antiderapante, etc.); soferul trebuie sa aiba echipament de protectie: manusi, bocanci, vesta reflectorizanta, casca. Prezentarea la incarcare a unui camion neconform din punct de vedere tehnic sau neconform cu specificatiile din comanda de transport poate atrage dupa sine penalizari in valoare egala cu prejudiciul creat.</strong><br />
	Transportatorul are obligatia de a se prezenta la incarcare cu camionul in stare perfecta de functionare, podeaua curata, prelata intacta, cablu vamal in stare perfecta si podeaua sa suporte o greutate de pana la 3,5t a motostivuitorului sau a altui echipament utilizat pentru incarcare / descarcare.<br />
	11. Transportatorul este raspunzator pentru incarcarea corecta a marfii in autovehicul, depasirea greutatii totale sau pe axe si pentru toate daunele (inclusiv eventualele amenzi) survenite din cauza incarcarii necorespunzatoare sau din cauza lipsei asigurarii marfii in autovehicul. La incarcare si descarcare soferul este obligat sa verifice daca starea marfurilor si cantitatea corespund cu inscrisurile din documentele oficiale si comanda de transport. Daca masina paraseste locul de incarcare fara a anunta in scris eventualele diferente de cantitate/dimensiuni, transportatorul este pe deplin raspunzator si nu are dreptul sa ceara extra costuri.Transportatorul este obligat sa noteze pe documentul de transport toate discrepantele conform conventiei CMR si TIR.</p></div><br />
	
	
					<img height="188" src="'.WEBSITE_URL.'/speed_connect/img/stamp.jpg" width="222" style="margin-bottom:-120px;margin-left:90px;" /></td>
		
	<br clear="ALL" />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Speed Connect Cargo SRL&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRANSPORTATOR<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.........................<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	
	
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="fdate">Data: '.date('d.m.Y').'</span><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong class="fdate">Comanda de transport. nr. '.(isset($transaction['Transaction']['order_id'])?$transaction['Transaction']['order_id']:'________').'</strong><br />
	<img align="left" height="85" src="'.WEBSITE_URL.'/speed_connect/img/logo2.jpg" style="margin-top:-65px;" />
	
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	<div class="in-content">
	<p class="points">
	12. Orice problema / paguba / deteriorare / distrugere adusa marfii in timpul transportului va fi suportata numai de catre firma transportatoare. Soferul este obligat sa asiste la incarcare si, respectiv, la descarcare si este raspunzator de intreaga marfa pe tot parcursul timpului pana la destinatie. Transportatorul se obliga sa respecte termenele si instructiunile primite prin prezentul contract si sa comunice imediat in scris despre orice problema aparuta care ar putea afecta derularea in bune conditii a contractului de transport, in caz contrar fiind pasibil de a suporta penalizari de pana la 20% din valoarea totala a transportului.<br />
	13. Din momentul acceptarii comenzii, transportatorul declara ca daca vor fi reclamatii referitoare la daune survenite in afara transportului, ne imputerniceste sa retinem sumele pe care i le datoram pana la clarificarea situatiei aparute. Dupa solutionarea cazului si semnarea protocolului / acordului intre parti, in termen de 10 (zece) zile lucratoare, va fi efectuata plata sumelor datorate, cu exceptia sumei aferente daunei.<br />
	<span style="text-align:none;">14. Neutralitatea totala fata de client este obligatorie. In caz contrar, transportatorul va suporta  o &nbsp;&nbsp; penalizare &nbsp;&nbsp; in  &nbsp;&nbsp; valoare  &nbsp;&nbsp; de  5.000&euro;, plus daune de interese.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
	15. Documente necesare la avizarea transportului: CMR, asigurarea CMR obligatorie in valoare de 50.000 euro la transport intern si 100.000&euro; la transport international, indiferent de destinatia transportului.<span><br />
	16. Incarcarea altor marfuri in camion se face numai cu acordul SC Speed Connect Cargo SRL In cazul in care pentru un transport angajat in exclusivitate se descopera incarcarea in camion a altor marfuri, transportatorul va suporta o penalizare de minim 1000 &euro; pentru fiecare partida de marfa incarcata fara acordul scris al&nbsp; SC Speed Connect Cargo SRL<br />
	17. Partile sunt de acord ca eventualele litigii aparute sa fie solutionate legal de catre Camera de Comert si Industrie a Romaniei &ndash; Bucuresti.<br />
	18. Netransmiterea documentelor originale in termen de 7 zile de la efectuarea transportului atrage dupa sine prelungirea termenului de plata la 15 de zile de la primirea acestora.<br />
	<strong>19</strong>. <strong>Conditii de plata: Plata se va efectua prin virament bancar, la '.((isset($transaction['Transaction']['payment_terms']) && !empty($transaction['Transaction']['payment_terms']))?$transaction['Transaction']['payment_terms']:'___').' zile de la primirea facturii, a CMR-ului confirmat in </strong><br />
	<strong>ORIGINAL, precum si a altor documente care insotesc transportul (packing list, avize de insotire, facturi, note de cantar, </strong><br />
	<strong>standing card-uri, etc.). </strong><br />
	<strong style="background-color:yellow;">ATENTIE!</strong><strong> Factura se va intocmi cu datele si adresa sediului social (SC Speed Connect Cargo SRL, B-dul Republicii, </strong><br />
	<strong>Nr. 18, 110062, Pitesti, Jud. Arges, Nr.Reg.Com.: J3/923/2014, C.F. RO33390171, Conturi:<br />
	RON : RO91INGB0000999904479897&nbsp;&nbsp; /EUR &ndash;RO53INGB0000999904479902&nbsp;&nbsp; - ING BANK Pitesti) si se va trimite, </strong><br />
	<strong>impreuna cu documentele transportului, pe adresa B-dul Republicii, Nr. 18, 110062, Pitesti, Jud. Arges. Pe factura de transport se va nota obligatoriu numarul comenzii de transport. In cazul in care factura nu este trimisa la adresa de corespondenta mentionata sau documentele cursei nu sunt in original si complete, nu ne asumam responsabilitatea pentru modificarea termenului de plata.</strong><br />
	20. In cazul in care organele de control abilitate descopera in autovehicul bunuri incarcate in scop de contrabanda, transportatorul va suporta toate prejudiciile asociate, precum si daune morale catre SC Speed Connect Cargo SRL in plus, putem impune transportatorului o penalizare de 10.000 &euro; si oprirea tuturor platilor datorate catre acesta pentru servicii de transport prestate. Pentru a evita acest gen de incidente, soferul va asista la procesul de incarcare a autovehiculului incheiat prin sigilarea acestuia. Soferul isi asuma raspunderea si intelege sa nu faca contrabanda cu alcool, tigari, tutun, iar transportatorul este responsabil in fata SC Speed Connect Cargo SRL pentru toate actiunile soferului.<br />
	21. In cazul in care vama nu se efectueaza la locatia furnizorului, soferul nu va parasi locul incarcarii daca autovehiculul nu este sigilat cu un sigiliu numerotat. Sigiliul poate fi indepartat doar de autoritatile vamale. Dupa efectuarea controlului vamal si numai dupa incheierea operatiunilor de vamuire, autoritatile competente vor resigila autovehiculul cu un alt sigiliu cu numar de inregistrare.<br /></p></div>
	&nbsp;<br />
	&nbsp;<br />
	&nbsp;<br />
	
	<br />
	<table align="left" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td height="3">
					&nbsp;</td>
			</tr>
			<tr>
				<td>
					&nbsp;</td>
				<td>
					<img height="188" src="'.WEBSITE_URL.'/speed_connect/img/stamp.jpg" width="222" style="margin-bottom:-120px;margin-left:65px;" /></td>
			</tr>
		</tbody>
	</table>
	&nbsp;<br />
	&nbsp;<br />
	<br clear="ALL" />
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Speed Connect Cargo SRL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRANSPORTATOR<br />
	&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &hellip;.........................<br />
	&nbsp;</div></body></html>';
// echo $html; die;
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
						$this->dompdf = new DOMPDF();
						// $papersize = "legal";
						$papersize = "letter";
						$orientation = "landscape";
						$this->dompdf->load_html($html);
						
						$this->dompdf->render();
						$filename = "pdf_".date("Y.m.d").".pdf";
						$this->dompdf->stream($filename);
						
			
			$this->layout	= false;
			$setlang	=	$this->Session->read('Config.language');
			$header = array(__("News Id"),__("News Title"), __("Content"), __("User Name"),__("Created"),__("Modified"));
			$this->{$this->modelClass}->virtualFields  = array(
				'username'=> "SELECT username FROM users WHERE id=".$this->modelClass.".user_id"
			); 
			$rdata = $this->{$this->modelClass}->find('all',array('conditions'=>array('status'=>1)));
				$data = array();
				foreach($rdata as $key => $ddata){
					$name			= '';
					$description 	= '';
						if($setlang == 'pt'){
							$name 					=	$ddata[$this->modelClass]['title_pt'];
							$description 			=	$ddata[$this->modelClass]['body_pt'];
						}else if($setlang == 'en'){
							$name 					=	$ddata[$this->modelClass]['title_en'];
							$description 			=	$ddata[$this->modelClass]['body_en'];
						}
					
					$data[$key]['id']				=	$ddata[$this->modelClass]['id'];
					$data[$key]['title']			=	$name;
					$data[$key]['content']			=	strip_tags($description);
					$data[$key]['username']			=	$ddata[$this->modelClass]['username'];
					$data[$key]['created']			=	$ddata[$this->modelClass]['created'];
					$data[$key]['modified']			=	$ddata[$this->modelClass]['modified'];
				}
				$this->export_file($header,$data,'pdf');
			exit;
	}
	
	
	public function completed($dropdown_type='Completed Transactions') {		
		$dropdown_type=__('Completed Transactions');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		
		$pageHeading	=	__('Completed Transactions');
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['completed'] = 1;
		
		if($this->Auth->user('user_role_id')!=1 && $this->Auth->user('user_role_id')!=4){
			$parsedConditions['employee_id'] = $this->Auth->user('id');
		}
		
		$this->paginate = array(
								'conditions' => $parsedConditions,
								//'limit' => $limit,
								'limit' => -1,
								'order'=>	array($this->modelClass . '.created' => 'desc')	
								);		
		$result= $this->paginate();
		// pr($result); die;
		$this->set('result', $result);
	}
	
	public function cancelled($dropdown_type='Cancelled Transactions') {		
		$dropdown_type=__('Cancelled Transactions');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		
		$pageHeading	=	__('Cancelled Transactions');
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['status'] = 0;
		
		if($this->Auth->user('user_role_id')!=1 && $this->Auth->user('user_role_id')!=4){
			$parsedConditions['employee_id'] = $this->Auth->user('id');
		}
		
		$this->paginate = array(
								'conditions' => $parsedConditions,
								//'limit' => $limit,
								'limit' => -1,
								'order'=>	array($this->modelClass . '.created' => 'desc')	
								);		
		$result= $this->paginate();
		// pr($result); die;
		$this->set('result', $result);
	}
	
	public function calender_transactions($dropdown_type='Transactions Statistics') {		
		$dropdown_type=__('Transactions Statistics');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$breadcrumb = array('pages' => $pages, 'active' => __($humanize, true));		
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		
		if (!empty($this->data) && isset($this->data['recordsPerPage']) ) {
			$limitValue = $limit = $this->data['recordsPerPage'];
			$this->Session->write($this->name . '.' . $this->action . '.recordsPerPage', $limit);
		}
		else {
			$this->Prg->commonProcess();
		}		
		
		$pageHeading	=	__('Transactions Statistics');
		$this->set('pageHeading',$pageHeading);
		//set the limitvalue for records
		$limitValue = 	$limit = ($this->Session->read($this->name . '.' . $this->action . '.recordsPerPage' ) ) ? $this->Session->read( $this->name . '.' . $this->action . '.recordsPerPage') : Configure::read('defaultPaginationLimit');
		$this->set('limitValue', $limitValue);
	  	$this->set('limit', $limit);
		$this->{$this->modelClass}->data[$this->modelClass] 		= 	$this->passedArgs;
		$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		$parsedConditions['status'] = 1;
		$parsedConditions['completed'] = 0;
		
		if($this->Auth->user('user_role_id')!=1 && $this->Auth->user('user_role_id')!=4 ){
			$parsedConditions['employee_id'] = $this->Auth->user('id');
		}
		
		$this->paginate = array(
								'conditions' => $parsedConditions,
								//'limit' => $limit,
								'limit' => -1,
								'order'=>	array($this->modelClass . '.created' => 'desc')	
								);		
		$result= $this->paginate();
		
		$parsedConditions['paid'] = 0;
		$transporter_result = $this->{$this->modelClass}->find('all',array('conditions'=>$parsedConditions,'limit'=>-1,'order'=>array($this->modelClass . '.created' => 'desc')));
		// pr($transporter_result); die;
		
		$this->set('result', $result);
		$this->set('transporter_result', $transporter_result);
	}
	

	function add($dropdown_type='Transactions') {
		$dropdown_type=__('Transactions');
		$humanize 				= Inflector::humanize($dropdown_type);
		$singularize 			= Inflector::singularize($humanize);
		$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
		$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
		
		if($this->Auth->user('user_role_id')==4 ){
			$this->redirect('/');
		}
		
		$breadcrumb = array('pages' => $pages, 'active' =>__('Add New').' '.$singularize);
		$this->set('breadcrumb', $breadcrumb);
		$this->set('dropdown_type', $dropdown_type);
		$this->set('humanize', $humanize);
		$this->set('singularize', $singularize);
		$this->loadModel('User');
		$clients = $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read('user_role_id.client'),'active'=>1),'fields'=>array('id','first_name')));
		$this->set('clients',$clients);
		$pageHeading	=	__('Transaction');
		$this->set('pageHeading',$pageHeading);
			if (!empty($this->data)) {
				$this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {
					// pr($this->data); die;
					
					$data = array();
					$data = $this->data[$this->modelClass];
					$data['employee_id'] = $this->Auth->user('id');
					$data['completed'] 	= 0;
					$data['profit'] 	= $data['money_in']-$data['money_out']-Configure::read('Site.regular_expenses');
					
					if ($this->{$this->modelClass}->save($data)) {
					
						$data['order_id'] = substr(ucwords($this->Auth->user('first_name')),0,1).substr(ucwords($this->Auth->user('last_name')),0,1).(100+$this->{$this->modelClass}->id);
						$this->{$this->modelClass}->save($data);
						$this->Session->setFlash(__($singularize . 'has been added.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
			}
	}
	function edit($id = null) {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
		  if($this->Auth->user('user_role_id')==4 ){
			$this->redirect('/');
		}
		
			 $this->loadModel('User');
		$clients = $this->User->find('list',array('conditions'=>array('user_role_id'=>Configure::read('user_role_id.client'),'active'=>1),'fields'=>array('id','first_name')));
		$this->set('clients',$clients);
			$user = $this->{$this->modelClass}->findById($id);
			$dropdown_type=__('Transactions');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			$pageHeading	=	__('Transaction');
			$this->set('pageHeading',$pageHeading);
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['order_id'], true));
			
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
						$data = array();
					$data = $this->data[$this->modelClass];
					$data['profit'] 	= $data['money_in']-$data['money_out']-Configure::read('Site.regular_expenses');
					
					if ($this->{$this->modelClass}->save($data)) {
						$this->Session->setFlash(__($singularize .' has been updated.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				}
			}
	}
	
	function view_transaction($id = null) {
		  if(!isset($id) || $id == '' ) {
			 $this->Session->setFlash(__('Invalid Access.'), 'error');
			 $this->redirect('/');
		  }
			 $this->loadModel('User');
		
			$user = $this->{$this->modelClass}->findByOrderId($id);
			$dropdown_type=__('Transactions');
			
			$humanize 				= Inflector::humanize($dropdown_type);
			$singularize 			= Inflector::singularize($humanize);
			$pageHeading	=	__('Transaction');
			$this->set('pageHeading',$pageHeading);
			$pages[__('Dashboard', true)] = array('plugin' => '', 'controller' => '/', 'action' => '');
			
			$pages[__($humanize, true)] = array('action' => 'index',$dropdown_type);
			
			$breadcrumb = array('pages' => $pages, 'active' => __($user[$this->modelClass]['order_id'], true));
			
			$this->{$this->modelClass}->id = $user[$this->modelClass]['id']; 
			$this->set('breadcrumb', $breadcrumb);
			$this->set('dropdown_type', $dropdown_type);
			$this->set('humanize', $humanize);
			$this->set('singularize', $singularize);
			$this->set('id', $id);
			if (empty($this->data)) {
				$this->data = $this->{$this->modelClass}->read();
				// pr($this->data); die;
				$this->set('data',$this->data);
			 } else {
				
				/* $this->{$this->modelClass}->set($this->data);
				if($this->{$this->modelClass}->validates()) {		
						$data = array();
					$data = $this->data[$this->modelClass];
					$data['profit'] 	= $data['money_in']-$data['money_out']-Configure::read('Site.regular_expenses');
					
					if ($this->{$this->modelClass}->save($data)) {
						$this->Session->setFlash(__($singularize .' has been updated.'), 'success');
						$this->redirect(array('action' => 'index',$dropdown_type));
					}
				} */
			}
	}
	
	function delete() {
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null && ($this->Auth->user('user_role_id')==1)){
			 $dropdown_type=__('Districts');
				
				if($this->{$this->modelClass}->delete($this->data['id'])){
					echo 'success';
				}else{
					echo 'error';
				}
			}else{ echo 'forbidden'; }
		} exit;
	}
	
	function change_pay_date() {
		if($this->request->is('Ajax')){
		// pr($this->data);
		 if($this->data['title'] != null){
			
			$title = $this->data['title'];
			$stitle = explode(' ',$title);
			if(isset($stitle[0]) && isset($stitle[1])){
			
				$tran_order_id = $stitle[0];
				
				if($stitle[1][0]=='+'){
					$field = 'seller_pay_date';
				}else{
					$field = 'transporter_pay_date';
				}
				$transaction = $this->{$this->modelClass}->find('first',array('conditions'=>array('order_id'=>$tran_order_id)));
				$transaction[$this->modelClass][$field] = date('d-m-Y',strtotime($this->data['date']));
				$this->{$this->modelClass}->id = $transaction[$this->modelClass]['id'];
					if($this->{$this->modelClass}->save($transaction,false)){
						echo 'success';
					}else{
						echo 'error';
					}
			}else{
				echo 'invalid';
			}
			}else{ echo 'forbidden'; }
		} exit;
	}
	
	
	function mark_completed() {
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null && ($this->Auth->user('user_role_id')==1)){
			 $this->{$this->modelClass}->id = $this->data['id'];
				if($this->{$this->modelClass}->save(array('completed'=>1,'complete_date'=>time()),false)){
					echo 'success';
				}else{
					echo 'error';
				}
			}else{ echo 'forbidden'; }
		} exit;
	}
	
	function active_status() {
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null){
			 $this->{$this->modelClass}->id = $this->data['id'];
				if($this->{$this->modelClass}->save(array('status'=>1),false)){
					echo 'success';
				}else{
					echo 'error';
				}
			}else{ echo 'forbidden'; }
		} exit;
	}
	
	function mark_paid() {
		if($this->request->is('Ajax')){
		 if($this->data['id'] != null && ($this->Auth->user('user_role_id')==1)){
			 $this->{$this->modelClass}->id = $this->data['id'];
				if($this->{$this->modelClass}->save(array('paid'=>1),false)){
					echo 'success';
				}else{
					echo 'error';
				}
			}else{ echo 'forbidden'; }
		} exit;
	}
	
	
	
	function generatereport(){
		//echo 'fghfg'; die;
		$this->layout	= false;
		$header = array('DATA',	'Order Nr.',	'LOAD',	'UNLOAD',	'Loading Seller',	'TRANSPORTER',	'MONEY IN',	'MONEY OUT',	'PROFIT');
			
			$Conditions['completed'] = 0;
			if($this->Auth->user('user_role_id')!=1 && $this->Auth->user('user_role_id')!=4){
				$Conditions['employee_id'] = $this->Auth->user('id');
			}
			
			$transactions = $this->{$this->modelClass}->find('all',array('conditions'=>$Conditions));
			$data = array();
			foreach($transactions as $key => $ddata){
				
				$data[$key]['date']			=	($ddata[$this->modelClass]['complete_date']!="")?date('d.m.Y',strtotime($ddata[$this->modelClass]['complete_date'])):"";
				$data[$key]['order_id']		=	$ddata[$this->modelClass]['order_id'];
				$data[$key]['load_location']		=	$ddata[$this->modelClass]['load_location'];
				$data[$key]['unload_location']		=	$ddata[$this->modelClass]['unload_location'];
				$data[$key]['seller']				=	(isset($ddata["Seller"]['first_name'])?$ddata["Seller"]['first_name']:'');
				$data[$key]['transporter']		=	(isset($ddata["Transporter"]['first_name'])?$ddata["Transporter"]['first_name']:'');
				$data[$key]['money_in']		=	$ddata[$this->modelClass]['money_in'];
				$data[$key]['money_out']		=	$ddata[$this->modelClass]['money_out'];
				$data[$key]['profit']		=	$ddata[$this->modelClass]['profit'];
				// $data[$key]['created']	=	date('d.m.Y',strtotime($ddata[$this->modelClass]['created']));
			}
			$this->export_file($header,$data,'csv');
		exit;
		
	}
	
	function generatereport_completed(){
		//echo 'fghfg'; die;
		$this->layout	= false;
		$header = array('DATA',	'Order Nr.',	'LOAD',	'UNLOAD',	'Loading Seller',	'TRANSPORTER',	'MONEY IN',	'MONEY OUT',	'PROFIT');
			
			$Conditions['completed'] = 1;
			if($this->Auth->user('user_role_id')!=1 && $this->Auth->user('user_role_id')!=4){
				$Conditions['employee_id'] = $this->Auth->user('id');
			}
			
			$transactions = $this->{$this->modelClass}->find('all',array('conditions'=>$Conditions));
			$data = array();
			foreach($transactions as $key => $ddata){
				
				$data[$key]['date']			=	($ddata[$this->modelClass]['complete_date']!="")?date('d.m.Y',strtotime($ddata[$this->modelClass]['complete_date'])):"";
				$data[$key]['order_id']		=	$ddata[$this->modelClass]['order_id'];
				$data[$key]['load_location']		=	$ddata[$this->modelClass]['load_location'];
				$data[$key]['unload_location']		=	$ddata[$this->modelClass]['unload_location'];
				$data[$key]['seller']				=	(isset($ddata["Seller"]['first_name'])?$ddata["Seller"]['first_name']:'');
				$data[$key]['transporter']		=	(isset($ddata["Transporter"]['first_name'])?$ddata["Transporter"]['first_name']:'');
				$data[$key]['money_in']		=	$ddata[$this->modelClass]['money_in'];
				$data[$key]['money_out']		=	$ddata[$this->modelClass]['money_out'];
				$data[$key]['profit']		=	$ddata[$this->modelClass]['profit'];
				// $data[$key]['created']	=	date('d.m.Y',strtotime($ddata[$this->modelClass]['created']));
			}
			$this->export_file($header,$data,'csv');
		exit;
		
	}
	
	public function generate_pdf(){
			
			$results	=	$this->{$this->modelClass}->find('all');
			$header_row = array(__("Transaction Name"),__("Created"));
			foreach($results as $key => $ddata){
				$data[$key]['name']		=	$ddata['Transaction']['name'];
				$data[$key]['created']	=	date('m-d-Y',$ddata['Transaction']['created']);
			}
			$this->export_file($header_row,$data,'pdf');
			die;
	}
	
}
