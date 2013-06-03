<?php
class MailsController extends AppController{
	function backoffice_index(){
		parent::backoffice_index();
	}
	
	function backoffice_view(){
		
	}
		
	function send(){
	
		// print_r($_POST);
		// die();
		
		$this->loadModel('Mail');
		// if($this->request->data){
			print_r($_POST);
			die();
		// }
		
		// if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            // strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		
		// if($this->request->data){
			// if($this->Mail->validates($this->request->data)){
				// require_once SWIFTMAILER.DS.'swift_required.php'; //Inclusion de la librairie d'envoi de mails
				
				// $message = Swift_Message::newInstance();
				// $message->setFrom('cresus@delice.fr');
				// $transport = Swift_SmtpTransport::newInstance('mail.delice.fr', 25);
				// $mailer = Swift_Mailer::newInstance($transport);
				// $message = Swift_Message::newInstance('01 Sortie de bacs')
				  // ->setFrom(array('cresus@delice.fr' => 'Cresus Project Delice'))
				  // ->setTo(array('cresus@delice.fr' => 'Cresus Project Delice'))
				  // ->setBody(
						// $this->request->data['mail'].'/'.$this->request->data['bac']
					// );
				// $result = $mailer->send($message);
				// Session::write('Frontoffice.mail',$this->request->data['mail']);
				// Session::setFlash('Bac envoyé','success');
				// $this->redirect('mails/view');
			// }else{
				// $errors = $this->Mail->errors;
				// $message = "Erreur dans le formulaire<br/><br/>";
				// foreach($errors as $k => $v){
					// $message .= $v."<br />";
				// }
				// Session::setFlash($message,'error');
				// $this->redirect('mails/view');
			// }
		// }else{
			// $errors = $this->Mail->errors;
			// $message = "Erreur dans le formulaire<br/><br/>";
			// foreach($errors as $k => $v){
				// $message .= $v."<br />";
			// }
			// Session::setFlash($message,'error');
			// $this->redirect('mails/view');
			//////////////////////////////
		// }
	}
}