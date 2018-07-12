<?php namespace Models;
	
	class Resume{

		private $cicles;//row cicles bd
		private $otherEducation;//row education bd
		private $experience;//row experience bd
		private $languages;//row lang bd
		private $licences;//row licences bd

		//cicles
		private $idStudent;
		private $value;
		private $class;
		//otherEducation
		private $title;
		private $organization;
		private $startDate;
		private $endDate;
		private $mainLearnedCapacities;
		//JobExperience
		private $employer;
		private $sector;
		private $position;	
		private $mainActivities;
		//Language
		private $language;
		private $isMotherTongue;
		private $spokenLevel;
		private $writtenLevel;
		private $readingLevel;
		//Licence
		private $licence;

		private $con;

		public function __construct(){ 
			$this->con = new Conexion();
		}

		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}

		public function get($atributo){
			return $this->$atributo;
		}

		public function infoResumeByStudent(){
			$sql = "SELECT C.name,S.class FROM Cicle C INNER JOIN StudentListCicles S ON C.name = S.cicle WHERE S.student = '{$this->idStudent}' order by S.class DESC";
			$this-> cicles = $this->con->consultaRetorno($sql);
			$sql = "SELECT * FROM StudentOtherEducation WHERE student = '{$this->idStudent}' order by endDate DESC";
			$this-> otherEducation = $this->con->consultaRetorno($sql);		
			$sql = "SELECT * FROM StudentJobExperience WHERE student = '{$this->idStudent}' order by endDate DESC";
			$this-> experience = $this->con->consultaRetorno($sql);						
			$sql = "SELECT * FROM StudentKnownLanguages WHERE student = '{$this->idStudent}' order by isMotherTongue DESC";
			$this-> languages = $this->con->consultaRetorno($sql);	
			$sql = "SELECT * FROM StudentDrivingLicence WHERE student = '{$this->idStudent}'";
			$this-> licences = $this->con->consultaRetorno($sql);				
		}


		public function deleteResumeByStudent(){
			$sql = "DELETE FROM StudentListCicles WHERE student = '{$this->idStudent}'";
			$this->con->consultaSimple($sql);
			$sql = "DELETE FROM StudentOtherEducation WHERE student = '{$this->idStudent}'";
			$this->con->consultaSimple($sql);	
			$sql = "DELETE FROM StudentJobExperience WHERE student = '{$this->idStudent}'";
			$this->con->consultaSimple($sql);						
			$sql = "DELETE FROM StudentKnownLanguages WHERE student = '{$this->idStudent}'";
			$this->con->consultaSimple($sql);	
			$sql = "DELETE FROM StudentDrivingLicence WHERE student = '{$this->idStudent}'";
			$this->con->consultaSimple($sql);	
		}

		public function deleteCicle(){
			$sql = "DELETE FROM StudentListCicles WHERE student = '{$this->idStudent}' and cicle = '{$this->value}'";
			$this->con->consultaSimple($sql);
		}

		public function insertCicle(){
			$sql = "INSERT INTO StudentListCicles VALUES ('{$this->idStudent}','{$this->value}','{$this->class}')";
			$this->con->consultaSimple($sql);
		}

		public function deleteEducation(){
			$sql = "DELETE FROM StudentOtherEducation WHERE student = '{$this->idStudent}' and num = '{$this->value}'";
			$this->con->consultaSimple($sql);
		}

		public function insertEducation(){

			$sql = "SELECT MAX(num) FROM StudentOtherEducation WHERE student = '{$this->idStudent}'";
			$max_num = array_shift($this->con->consultaRetorno($sql));
			$new_num = $max_num['MAX(num)']+1;
			$sql = "INSERT INTO StudentOtherEducation VALUES ('{$this->idStudent}',$new_num,'{$this->organization}','{$this->mainLearnedCapacities}','{$this->title}','{$this->startDate}','{$this->endDate}')";
			$this->con->consultaSimple($sql);
		}

		public function deleteExperience(){
			$sql = "DELETE FROM StudentJobExperience WHERE student = '{$this->idStudent}' and num = '{$this->value}'";
			$this->con->consultaSimple($sql);
		}

		public function insertExperience(){

			$sql = "SELECT MAX(num) FROM StudentJobExperience WHERE student = '{$this->idStudent}'";
			$max_num = array_shift($this->con->consultaRetorno($sql));
			$new_num = $max_num['MAX(num)']+1;
			$sql = "INSERT INTO StudentJobExperience VALUES ('{$this->idStudent}',$new_num,'{$this->employer}','{$this->sector}','{$this->position}','{$this->mainActivities}','{$this->startDate}','{$this->endDate}')";
			$this->con->consultaSimple($sql);
		}

		public function getBaseLanguages(){
			$sql = "SELECT * FROM BaseLanguages order by name";
			return $this->con->consultaRetorno($sql);	
		}

		public function deleteLanguage(){
			$sql = "DELETE FROM StudentKnownLanguages WHERE student = '{$this->idStudent}' and language = '{$this->language}'";
			$this->con->consultaSimple($sql);
		}

		public function insertLanguage(){
			$sql = "INSERT INTO StudentKnownLanguages VALUES ('{$this->idStudent}','{$this->language}','{$this->isMotherTongue}','{$this->spokenLevel}','{$this->writtenLevel}','{$this->readingLevel}')";
			$this->con->consultaSimple($sql);
		}

		public function getLevels(){
			$sql = "SHOW COLUMNS FROM StudentKnownLanguages LIKE 'spokenLevel'";
			$row = array_shift($this->con->consultaRetorno($sql));
			return explode(",",str_replace("'","",substr($row["Type"], 5,-1)));
		}

		public function getLicences(){
			$sql = "SHOW COLUMNS FROM StudentDrivingLicence LIKE 'licence'";
			$row = array_shift($this->con->consultaRetorno($sql));
			return explode(",",str_replace("'","",substr($row["Type"], 5,-1)));
		}

		public function deleteLicence(){
			$sql = "DELETE FROM StudentDrivingLicence WHERE student = '{$this->idStudent}' and licence = '{$this->licence}'";
			$this->con->consultaSimple($sql);
		}

		public function insertLicence(){
			$sql = "INSERT INTO StudentDrivingLicence VALUES ('{$this->idStudent}','{$this->licence}')";
			$this->con->consultaSimple($sql);
		}

	}

?>