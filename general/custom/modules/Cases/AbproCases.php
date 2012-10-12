<?php
class AbproCases{
	
	protected $id_template = '97230eac-2887-41af-eeeb-507700abcf93';

	private $patronVariablesTemplate = '/(\{::)(future|pass)(::)(\w+)(::)(\w+)((::)(\w+))?(::\})/';

	public function cargaPreData(SugarBean $bean, $event, $arguments){
		$GLOBALS['log']->debug("AbproCases cargaPreData entrando");
		$bean->acPreData = $bean->fetched_row;
	}

	public function notificaLiberadoAbpro(SugarBean $bean, $event, $arguments){

		$fetchedRow = $bean->acPreData;
		$GLOBALS['log']->debug("AbproCases notificaLiberadoAbpro bean->status: " . print_r($bean->status, true));
		$GLOBALS['log']->debug("AbproCases notificaLiberadoAbpro fetchedRow: " . print_r($fetchedRow, true));
		if($bean->status === 'Liberado_ABPRO' &&  $bean->status !== $fetchedRow['status']){
			$bean->load_relationship('contacts');
			$contacts = $bean->contacts->getBeans();
			$emailAddresses = array();
			if(count($contacts)){
				$emailAddresses = $this->getEmailAddresses($contacts);			
				$GLOBALS['log']->debug("AbproCases notificaLiberadoAbpro emailAddresses: " . print_r($emailAddresses, true));			

				$this->sendEmail($bean, $emailAddresses);
			}
		}
	}

	public function getEmailAddresses($contacts){
		$emailAddresses = array();
		foreach($contacts as $contact){
			$emailAddresses[] = $contact->email1;
		}
		return $emailAddresses;
	}

	public function sendEmail($bean, $emailAddresses){
		//Busqueda del email template
		require_once("modules/EmailTemplates/EmailTemplate.php");
		$emailTemp = new EmailTemplate();
		$emailTemp->disable_row_level_security = true;
		//TODO crear el campo id_email_template
		$emailTemp->retrieve($this->id_template);

		require_once("include/SugarPHPMailer.php");
		$mail = new SugarPHPMailer();

		require_once("modules/Emails/Email.php");
		$emailObj = new Email();
		$defaults = $emailObj->getSystemDefaultEmail();

		$mail->From = $defaults['email'];
		$mail->FromName = $defaults['name'];
		$mail->Subject = $this->renderTextWithBean($bean, from_html($emailTemp->subject));
		$mail->Body = $this->renderTextWithBean($bean, from_html($emailTemp->body_html, 900));
		$mail->IsHtml(true);
		//$mail->prepForOutboud();
		$mail->setMailerForSystem();

		$GLOBALS['log']->debug("AbproCases sendEmail mail: " . print_r($mail, true));



		foreach($emailAddresses as $emailAddress){
			$mail->ClearAllRecipients();
			$GLOBALS['log']->debug('AbproCases sendEmail enviando correo a: ' . print_r($emailAddress, true));
			$mail->AddAddress($emailAddress, $emailAddress);
			if( !$mail->Send() ){
				$GLOBALS['log']->fatal('ERROR[AbproCases]: Message Send Failed');
			}
		}
	}

	private function renderTextWithBean($bean, $text){
		
		$GLOBALS['log']->debug("AbproCases renderTextWithBean bean: " . print_r($bean, true));			

		$coincidencias = null;
		preg_match_all($this->patronVariablesTemplate, $text, $coincidencias,PREG_SET_ORDER);
		$sustituciones = array();
		$GLOBALS['log']->debug("AbproCases renderTextWithBean text: " . $text);
		$GLOBALS['log']->debug("AbproCases renderTextWithBean coincidencias: " . print_r($coincidencias,true));
		foreach($coincidencias as $coincidencia){

			if($coincidencia[4] === $bean->module_dir){
				$value = null;
				if( !empty($coincidencia[7]) ){
					$relationship = $coincidencia[6];
					$field_name = $coincidencia[9];

					$GLOBALS['log']->debug("AbproCases renderTextWithBean relationship: " . $relationship);
					$GLOBALS['log']->debug("AbproCases renderTextWithBean field_name: " . $field_name);

					if(!$bean->$relationship){
						$bean->load_relationships($relationship);
					}

					$beansRelationship = $bean->$relationship->getBeans(new SugarBean());
					if(count($beansRelationship)){
						$value = $beansRelationship[0]->$field_name;
					}

				}else{
					if($coincidencia[2] === 'future'){
						$field_name = $coincidencia[6];
						$value = $bean->$field_name;
						$GLOBALS['log']->debug("AbproCases renderTextWithBean field_name: " . $field_name);
						$GLOBALS['log']->debug("AbproCases renderTextWithBean bean->field_name: " . $bean->$field_name);
					}else{
						$value = $bean->acPreData[$coincidencia[6]];
					}
				}
				$sustituciones[$coincidencia[0]] = $value;
			}
			
		}

		return str_replace(array_keys($sustituciones), array_values($sustituciones), $text);
	}
	
	private function completeDataBean($bean){
		global  $beanList, $beanFiles;
  	$class_name = $beanList[$bean->module_dir];
		require_once($beanFiles[$class_name]);
		$seed = new $class_name();
		
		$seed->retrieve($bean->id);
		$GLOBALS['log']->debug("AbproCases completeDataBean class_name: " . $class_name);
		switch($bean->module_dir){
			case 'Cases': 
				$GLOBALS['log']->debug("AbproCases completeDataBean seed->case_number: " . $seed->case_number);
				$bean->case_number = $seed->case_number;
			break;
		}
	}
}
