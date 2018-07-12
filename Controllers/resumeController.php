<?php namespace Controllers;


	
	use Models\Student as Student;
	use Models\Cicle as Cicle;
	use Models\Resume as Resume;
	use Utils\Utils as Utils;
	use Utils\Pdf as Pdf;
	use Config\Config as Config;
		
	class resumeController{

		private $resume;
		
		public function __construct(){
			$this->resume = new Resume();
			$this->cicle = new Cicle;
			$this->student = new Student; 
		}

		public function show($id_student){

			$this-> resume->set("idStudent",$id_student);
			$this-> resume->infoResumeByStudent();

			$curriculum = $this->resume;
			$tots_cicles = $this ->cicle->show();
			$tots_langs = $this ->resume->getBaseLanguages();
			$tots_levels = $this ->resume->getLevels();
			$tots_carnets = $this ->resume->getLicences();
			require 'Views/resumes/show.php';
		}

		public function deleteCicle($cicle, $id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("value", base64_decode($cicle));
			$this-> resume->deleteCicle();
			header("Location: " . URL . "resume/show/".$id_student);
		}	

		public function insertCicle($id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("value", base64_decode($_POST["id_cicle"]));
			$this-> resume->set("class", $_POST["promocio"]);
			$this-> resume->insertCicle();
			header("Location: " . URL . "resume/show/".$id_student);
		}		

		public function deleteEducation($cicle, $id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("value", $cicle);
			$this-> resume->deleteEducation();
			header("Location: " . URL . "resume/show/".$id_student."#formacio");
		}	

		public function insertEducation($id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("organization", addslashes(Utils::test_input($_POST["organization"])));
			$this-> resume->set("title", addslashes(Utils::test_input($_POST["title"])));
			$this-> resume->set("mainLearnedCapacities", addslashes(Utils::test_input($_POST["capacities"])));
			$this-> resume->set("startDate", Utils::dateToMysql($_POST["startDate"]));
			$this-> resume->set("endDate", Utils::dateToMysql($_POST["endDate"]));
			$this-> resume->insertEducation();
			header("Location: " . URL . "resume/show/".$id_student."#formacio");
		}		

		public function deleteExperience($cicle, $id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("value", $cicle);
			$this-> resume->deleteExperience();
			header("Location: " . URL . "resume/show/".$id_student."#experiencia");
		}	

		public function insertExperience($id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("employer", addslashes(Utils::test_input($_POST["employer"])));
			$this-> resume->set("sector", addslashes(Utils::test_input($_POST["sector"])));
			$this-> resume->set("position", addslashes(Utils::test_input($_POST["position"])));
			$this-> resume->set("mainActivities", addslashes(Utils::test_input($_POST["activities"])));
			$this-> resume->set("startDate", Utils::dateToMysql($_POST["startDate"]));
			$this-> resume->set("endDate", Utils::dateToMysql($_POST["endDate"]));
			$this-> resume->insertExperience();
			header("Location: " . URL . "resume/show/".$id_student."#experiencia");
		}

		public function deleteLanguage($lang, $id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("language", base64_decode($lang));
			$this-> resume->deleteLanguage();
			header("Location: " . URL . "resume/show/".$id_student."#idiomes");
		}	

		public function insertLanguage($id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("language", base64_decode($_POST["language"]));

			if (isset($_POST["isMotherTongue"])) {
				$this-> resume->set("isMotherTongue",1);
			}else{
				$this-> resume->set("isMotherTongue",0);
			}
			$this-> resume->set("spokenLevel",  $_POST["spoken"]);
			$this-> resume->set("writtenLevel", $_POST["written"]);
			$this-> resume->set("readingLevel", $_POST["reading"]);		

			$this-> resume->insertLanguage();
			header("Location: " . URL . "resume/show/".$id_student."#idiomes");
		}

		public function deleteLicence($licence, $id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("licence", base64_decode($licence));
			$this-> resume->deleteLicence();
			header("Location: " . URL . "resume/show/".$id_student."#carnets");
		}	

		public function insertLicence($id_student){
			$this-> resume->set("idStudent",$id_student);
			$this-> resume->set("licence", base64_decode($_POST["licence"]));	
			$this-> resume->insertLicence();
			header("Location: " . URL . "resume/show/".$id_student."#carnets");
		}

		public function generatePdf($id_student){
			
			$this-> student->set("id", $id_student);
			$this-> student->info();

			$this-> resume->set("idStudent",$id_student);
			$this-> resume->infoResumeByStudent();

			$PdfGenerator = new Pdf;
			$PdfGenerator->generate($this-> student, $this-> resume);
		}

}

$resumes = new resumeController();

?>