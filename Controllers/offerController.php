<?php namespace Controllers;
	
	use Models\Users as Users;
	use Models\Student as Student;
	use Models\Company as Company;
	use Models\Teacher as Teacher;
	use Models\Competence as Competence;
	use Models\Specialty as Specialty;
	use Models\Offer as Offer;	
	use Models\Resume as Resume;
	use Utils\Utils as Utils;
	use Utils\Mails as Mails;
	use Utils\Pdf as Pdf;	
	use Config\Config as Config;

		
	class offerController{

		private $company;
		private $offer;
		private $user;
		private $competence;
		private $specialty;
		
		public function __construct(){
			$this-> company = new Company();
			$this-> offer = new Offer();
			$this-> user = new Users;
			$this-> competence = new Competence;
			$this-> specialty = new Specialty;
		}


		public function show(){//llistar totes les ofertes, nomes per teachers
			$ofertas = $this->offer->show();
			/*echo "<pre>";
			print_r($oferta);
			echo "</pre>";*/
			foreach ($ofertas as $key => $oferta) {
				$this-> offer->set("num",$oferta["num"]);
				$this-> offer->competenceList();
				$oferta["competences"] = $this-> offer->get("competences");
				$ofertas[$key] = $oferta;

			}
			require 'Views/offers/show.php';
		}

		public function insert($id_company=""){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {		

				if($id_company){
					$id_empresa = $id_company;
				}else{
					$id_empresa = $_POST["company_id"];
				}
				//Creo una nova oferta
				$this-> offer->set("description", htmlentities(addslashes(Utils::test_input($_POST["descr"]))));
				$this-> offer->set("idCompany", Utils::test_input($id_empresa));
				$this-> offer->set("dateEnd", Utils::test_input(Utils::dateToMysql($_POST["fi"])));
				$this-> offer->add();
				$this-> offer->info();

				//Alta ofertes-competencies
				$compes = $_POST['competencies'];
    			foreach ($compes as $comp) {
             		$this-> offer->set("competence", base64_decode($comp));
             		$this-> offer->addCompetence();
        		}
        		//Selecció de competencies array competences
        		$this-> offer->competenceList();

				//Empresa que envia ofertes
				$this-> company->set("id",$id_empresa);
				$this-> company->info();
				
				//profes que han de validar
				$profes = new Teacher;
				$profes_array = $profes->getValidators();

				//Avisar oferta pendent de validar
				$mail = new Mails();
				$mail->sendOffer($profes_array, $this-> offer, $this-> company,"valida");	


				if($id_company){// Ve del llistat d'ofertes d'empresa
					header("Location: " . URL."company/info/".$id_company);				
				}else{
					//Si venim del llistat d'ofertes per data
					header("Location: " . URL."offer/show");
				}
				
			}else{
				if (!$id_company) {
					$empresas = $this-> company->show();
				}
				$especialitats = $this-> specialty->show();
				$competencies = $this-> competence->show();
				require 'Views/offers/insert.php';
			}
		}

		public function edit($id, $id_company=""){
			$this-> offer->set("num", Utils::test_input($id));
			$oferta = $this-> offer->info();			
			if ($this-> offer->get("validatedBy")){
					//TODO: REENVIAR a pagina error, no es pot esborrar una oferta validada(historic)
			}else{		
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {		
					if($id_company){ //Modifica una empresa
						$id_empresa = $id_company;
					}else{ //modificar un professor
						$id_empresa = $_POST["company_id"];
					}
					/*Modificar companyia a la que pertany la oferta?????? Només els profes*/
					$this-> offer->set("idCompany", Utils::test_input($id_empresa));
					$this-> offer->set("description", htmlentities(addslashes(Utils::test_input($_POST["descr"]))));

					if (isset($_POST["ini"])) {
						$this-> offer->set("dateStart", Utils::test_input(Utils::dateToMysql($_POST["ini"]))); //TODO: convert to timestamp!!!!!
					}

					$this-> offer->set("dateEnd", Utils::test_input(Utils::dateToMysql($_POST["fi"])));
					$this-> offer->edit();

					//Alta ofertes-competencies
					$this-> offer->deleteCompetences();
					$compes = $_POST['competencies'];
	    			foreach ($compes as $comp) {
	             		$this-> offer->set("competence", base64_decode($comp));
	             		$this-> offer->addCompetence();
	        		}


					if($id_company){// Ve del llistat d'ofertes d'empresa
						header("Location: " . URL."company/info/".$id_company);				
					}else{
						//Si venim del llistat d'ofertes per data
						header("Location: " . URL."offer/show");
					}
					
				}else{
					if (!$id_company) {
						$empresas = $this-> company->show();
					}	
					$especialitats = $this-> specialty->show();
					$competencies = $this-> competence->show();		
					$this-> offer->competenceList();	
					$competenciesOferta = $this-> offer->get("competences");	
					require 'Views/offers/edit.php';
				}
			}
		}

		public function validate($id, $id_company=""){
			if (true) {		//TODO: comprovacio permisos per fer una validacio

				//Profe que valida
				$this-> user-> set("email",$_SESSION["email"]);
				$this-> user-> info();

				//Modificam el validador
				$this-> offer->set("num", Utils::test_input($id));
				$this-> offer->info();
				$this-> offer->set("validatedBy", $this-> user->get("id"));
				$this-> offer->validate();
        		//Selecció de competencies array competences
        		$this-> offer->competenceList();
        		
				//Enviar mails (llista de alumnes + info oferta)
				//Empresa que envia ofertes
				$this-> company->set("id",$this-> offer->get("idCompany"));
				$this-> company->info();

				//Alumnes que reben oferta
				//Filtrar alumnes tenen requisits
				$alumnes = new Student;
				$alumnes->set("num_offer", $num_offer);
				$alumnes_array = $alumnes->getStudentForOffer();

				$mail = new Mails();
				$mail->sendOffer($alumnes_array, $this-> offer,$this-> company);
				
				if($id_company){// Ve del llistat d'ofertes d'empresa
					header("Location: " . URL."company/info/".$id_company);				
				}else{
					// Si venim del llistat d'ofertes per data
					header("Location: " . URL."offer/show");
				}
			}
		}

		/*mailValida: mètode que serveix per fer una validació via mail,per part del professor
		*/
		public function mailValidate($email_profe, $id_company, $num_offer, $hash){
			if (password_verify($email_profe.$id_company.$num_offer."topsecret", base64_decode($hash))) {
				//Profe que valida
				$this-> user-> set("email",$email_profe);
				$this-> user-> info();

				//Modificam el validador
				$this-> offer->set("num", $num_offer);
				$this-> offer->info();
				if ($this-> offer->get("validatedBy")) {
					//TODO: Redirecció per informar de oferta ja validada
				}else{
					$this-> offer->set("validatedBy", $this-> user->get("id"));
					$this-> offer->validate();
					//Selecció de competencies array competences
        			$this-> offer->competenceList();

					//Enviar mails (llista de alumnes + info oferta)
					//Empresa que envia ofertes
					$this-> company->set("id",$this-> offer->get("idCompany"));
					$this-> company->info();

					//Alumnes que reben oferta
					//Filtrar alumnes tenen requisits
					$alumnes = new Student;
					$alumnes->set("num_offer", $num_offer);
					$alumnes_array = $alumnes->getStudentForOffer();
					print_r($alumnes_array);

					$mail = new Mails();
					$mail->sendOffer($alumnes_array, $this-> offer,$this-> company);
				}

				//TODO reenvia a web que digui que no rebra mes mails
				
			}else{
				//TODO reenvia a page XXX
				
			}
		}
		public function delete($id, $id_company=""){
				//TODO: Comprovar sessio i role

				$this-> offer->set("num", Utils::test_input($id));
				$this-> offer->info();
				if ($this-> offer->get("validatedBy")){
					//TODO: REENVIAR a pagina error, no es pot esborrar una oferta validada(historic)
				}else{
					$this-> offer->delete();
					if($id_company){// Ve del llistat d'ofertes d'empresa
						header("Location: " . URL."company/info/".$id_company);				
					}else{
						// Si venim del llistat d'ofertes per data
						header("Location: " . URL."offer/show");
					}
				}
		}




		public function noMoreOffers($email_student, $id_company, $num_offer, $hash){
			if (password_verify($email.$id_company.$num_offer."topsecret", base64_decode($hash))) {
				$alumne = new Student;
				$alumne->set("email", $email_student);
				$alumne->info();
				$alumne->set("wantsToReceiveOffers",0);
				$alumne->edit();

				//TODO reenvia a web que digui que no rebra mes mails
			}else{
				//TODO reenvia a page XXX
				
			}
		}



		public function sendCurriculum($email_student, $id_company, $num_offer, $hash){
			if (password_verify($email_student.$id_company.$num_offer."topsecret", base64_decode($hash))) {

				//ho faig amb user pq student no puc consultar per email
				$user = new Users;
				$user->set("email", $email_student);
				$user->info();


				//GENERAR PDF FILE
				$student = new Student();
				$student->set("id", $user->get("id"));
				$student->info();

				$resume = new Resume();
				$resume->set("idStudent",$user->get("id"));
				$resume->infoResumeByStudent();

				$PdfGenerator = new Pdf;
				$PdfGenerator->generate($student, $resume, "file");


				//ENVIAMENT PDF A EMPRESA
				$this-> company->set("id", $id_company);
				$this-> company->info();

				$this-> offer->set("num", $num_offer);
				$this-> offer->info();		

				$mail = new Mails();
				$mail->sendCurriculum($this-> company, $this-> offer, $student);

				//TODO reenvia a web que digui curriculum enviat
				//TODO comptar/registrar numero de curriculums enviat a la empresa->camps respostes a offer

			}else{
				//TODO reenvia a page error XXX
			}
		}




	}

$offers = new offerController();

?>