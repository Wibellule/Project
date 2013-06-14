<?php
class MailsController extends AppController{
	function index(){
		
	}
	
	function view(){
		$valueFlash = Session::read('Frontoffice');
		if($valueFlash){
			$value = Session::read('Frontoffice.mail');
		}else{
			$value = '';
		}
		$content = '';
		$content .= '<form class="form-signin" method="POST" action="'.Router::url("mails/send").'">';
		$content .= '<h2 class="form-signin-heading">Sortie de bacs</h2>';
		$content .= '<input type="text" class="input-block-level" placeholder="Adresse Mail" name="mail" id="mail" value="'.$value.'">';
		$content .= '<hr>';
		$content .= '<input type="text" class="input-block-level" placeholder="Numéro du bac" name="bac" id="bac">';
		$content .= '<button class="btn btn-large btn-primary" type="submit">Envoyer</button>';
		$content .= '</form>';
		

		//On envoi les variables à la vue
		$this->set('formulaire', $content);
	}
		
	function send(){
		if($this->request->data){
			if($this->Mail->validates($this->request->data)){
				require_once SWIFTMAILER.DS.'swift_required.php'; //Inclusion de la librairie d'envoi de mails
				
				$message = Swift_Message::newInstance();
				$message->setFrom('cresus@delice.fr');
				$transport = Swift_SmtpTransport::newInstance('mail.delice.fr', 25);
				$mailer = Swift_Mailer::newInstance($transport);
				$message = Swift_Message::newInstance('01 Sortie de bacs')
				  ->setFrom(array('cresus@delice.fr' => 'Cresus Project Delice'))
				  ->setTo(array('cresus@delice.fr' => 'Cresus Project Delice'))
				  ->setBody(
						$this->request->data['mail'].'/'.$this->request->data['bac']
					);
				// $result = $mailer->send($message);
				Session::write('Frontoffice.mail',$this->request->data['mail']);
				Session::setFlash('Bac envoyé','success');
				$this->redirect('mails/view');
			}else{
				$errors = $this->Mail->errors;
				$message = "Erreur dans le formulaire<br/><br/>";
				foreach($errors as $k => $v){
					$message .= $v."<br />";
				}
				Session::setFlash($message,'error');
				$this->redirect('mails/view');
			}
		}else{
			$errors = $this->Mail->errors;
			$message = "Erreur dans le formulaire<br/><br/>";
			foreach($errors as $k => $v){
				$message .= $v."<br />";
			}
			Session::setFlash($message,'error');
			$this->redirect('mails/view');
			//////////////////////////////
		}
	}
}