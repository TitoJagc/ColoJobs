<?php namespace Controllers;

	use Models\Specialty as Specialty;
	use Utils\Utils as Utils;
	
	class specialtyController{

		private $specialty;

		public function __construct(){
			$this->specialty = new Specialty();
		}

		public function index(){
			$datos = $this->specialty->show();
			require'Views/specialty/show.php';
		}

		public function insert(){
			if($_POST){
				$this->specialty->set("name", addslashes(Utils::test_input($_POST['specialty'])));
				$this->specialty->add();
				header('Location: '. URL . "specialty");
			} else {
				require'Views/specialty/show.php';
			}
		}
		
		public function edit(){
			if($_POST){
				try{
					$this->specialty->set("name", addslashes(Utils::test_input($_POST['specialty'])));
					$this->specialty->set("newname", addslashes(Utils::test_input($_POST['newspecialty'])));
					$this->specialty->edit();
					//header('Location: '. URL . "specialty");
					echo '200'; // ajax success code
					//echo array_shift($this->specialty->info($_POST['newspecialty']))['name'];
				} catch (Exception $e) { 
	  				echo $e->errorMessage(); 
				} 
			}
		}
		
		public function delete($id){
			$this->specialty->set("name", base64_decode($id));
			$this->specialty->delete();
			header('Location: '. URL . "specialty");
		}

		public function show(){//llistar empreses
			$datos = $this->specialty->show();
			require 'Views/specialty/show.php';
		}

		public function getSpecialties(){
			$datos = $this->specialty->show();
			//.ajax call
			$sps = array();
			foreach ($datos as $sp){
				$sps[] = $sp['name'];
			}
			echo json_encode($sps);
		}

	}
?>