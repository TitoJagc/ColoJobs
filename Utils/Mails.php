<?php namespace Utils;

	use Models\Company as Company;
	use Models\Offer as Offer;

	date_default_timezone_set('Etc/UTC');
	
	

 class Mails
 {
 	private $mail;

 		public function __construct(){

 			//Create a new PHPMailer instance
			$this-> mail = new PHPMailer;
			//Set who the message is to be sent from
			$this-> mail->setFrom('colojobs@institut.es', 'ColoJobs');// aquest parametres fer-ho amb config.php

			
			$this-> mail->isSMTP();
			$this-> mail->SMTPDebug = 0;
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			//$this-> mail->SMTPDebug = 2;
			//$this-> mail->Debugoutput = 'html';
			$this-> mail->Host = 'smtp.gmail.com';

			$this-> mail->SMTPAuth = true;
			$this-> mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
			$this-> mail->Port = 587;
			$this-> mail->SMTPSecure = 'tls';
			$this-> mail->Username = 'colojobs@institut.es';// aquest parametres fer-ho amb config.php
			$this-> mail->Password = 'pass'; // aquest parametres fer-ho amb config.php

			//Configuració del content
			$this-> mail->isHTML(true);
			$this-> mail->charset = 'UTF-8';

			
 		}



 		 public function sendOffer($list_students, $offer, $company,$toValidate=""){

			$this-> mail->Subject = "Oferta de feina!";

			//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
			$this-> mail->AltBody = 'Sisplau, per veure el missatge, utilitza un client de correu compatible amb HTML!';

//TODO: Afegir pdf oferta
			/*  if (!empty($row['photo'])) {
			        $mail->addStringAttachment($row['photo'], 'YourPhoto.jpg'); //Assumes the image data is stored in the DB
			    }
			*/

			foreach ($list_students as $row) {
			    $this-> mail->addAddress($row['email'], $row['name']);

				$body = $this->crearContent($row['email'], $offer,$company,$toValidate);
				$this-> mail->msgHTML($body);

//TODO: Logs dels enviaments?????????

			    if (!$this-> mail->send()) {
			        echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $this-> mail->ErrorInfo . '<br />';
			        break; //Abandon sending
			    } else {
			        echo "Message sent to :" . $row['name'] . ' (' . str_replace("@", "&#64;", $row['email']) . ')<br />';

			    }
			    // Clear all addresses and attachments for next loop
			    $this-> mail->clearAddresses();
			    $this-> mail->clearAttachments();
			}
 		}




 		public function sendCurriculum($company, $offer, $student){

			
 			$this-> mail->Subject = "Curriculum oferta ColoJobs";

 			$this-> mail->Body = "Enviament curricullum oferta nº ".$offer->get("num")." ColoJobs.";
 			echo "<pre>";
 			print_r($company);
 			print_r($offer);
 			print_r($student);
 			echo "</pre>";
 			$this-> mail->addAddress($company->get("email"), $company->get("name"));
 			$this-> mail->addAttachment(ROOT."pdfs/".$student->get("id").'.pdf');
 			//send the message, check for errors
			if (!$this-> mail->send()) {
			    echo "Mailer Error: " . $this-> mail->ErrorInfo;
			} else {
			    echo "Message sent!";
			}
 		}




 		private function crearContent($email, $offer, $company, $toValidate){

 			$hash = base64_encode(password_hash($email.$company->get("id").$offer->get("num")."topsecret", PASSWORD_DEFAULT));

            $comps = "";
            foreach ($offer->get("competences") as $competencia) {
                if ($comps) {
                    $comps .= ", ".$competencia;

                }else{
                    $comps = $competencia;   
                }
            }
            if (!$comps){
                $comps = "No s'han establert competències per aquesta oferta.";
            }

			$html='<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Oferta de ColoJobs</title></head><body><div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">';

			$html.= '<h1>L\'empresa:</h1><h2>'.$company->get("name").'</h2><p>'.$company->get("description").'</p>';
			$html.='<hr><h2> Ens ha fet arribar la següent oferta:</h2>';
			$html.= '<p>'.html_entity_decode(html_entity_decode($offer->get("description"))).'</p>';
			$html.='<hr><h2> Amb les següents competències requerides:</h2>';
			$html.= '<p>'.$comps.'</p>';
			if ($toValidate) {
				$html.= '<div align="center"><br><br> <a href="'.URL.'offer/mailValidate/'.$email.'/'.$company->get("id").'/'.$offer->get("num").'/'.$hash.'" target="_blank">Clica en aquest enllaç per VALIDAR l\'oferta.</a><p>*(Automàticament s\'enviarà als alumnes.)</p></div>';
			}else{
				$html.= '<div align="center"><br><br> <a href="'.URL.'offer/sendCurriculum/'.$email.'/'.$company->get("id").'/'.$offer->get("num").'/'.$hash.'" target="_blank">Clica en aquest enllaç per enviar el teu curriculum automàticament.</a><br><br> <a href="'.URL.'offer/noMoreOffers/'.$email.'/'.$company->get("id").'/'.$offer->get("num").'/'.$hash.'" target="_blank">Si vols deixar de rebre ofertes clica aquest enllaç.</a></div>';
			}

			   
			$html.='</div></body></html>';

			return $html;

 		}


 }

 ?>
