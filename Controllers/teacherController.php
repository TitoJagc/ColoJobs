<?php namespace Controllers;
	
	use Models\Teacher as Teacher;
	use Utils\Utils as Utils;
	use Config\Config as Config;
		
	class teacherController{

		private $teacher;
		
		public function __construct(){
			$this->teacher = new Teacher();
		}

		public function show(){
			$datos = $this->teacher->show();
			require 'Views/teachers/show.php';
		}


		public function insert(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {		

				$this-> teacher->set("id", Utils::test_input($_POST["id"]));// NIF
				$this-> teacher->set("name", Utils::test_input($_POST["name"]));
				$this-> teacher->set("pwd", password_hash(Utils::test_input($_POST["pwd"]), PASSWORD_DEFAULT));
				$this-> teacher->set("dateOfBirth", Utils::test_input(Utils::dateToMysql($_POST["naixement"])));
				$this-> teacher->set("telephone", Utils::test_input($_POST["telephone"]));
				$this-> teacher->set("addressStreet", Utils::test_input($_POST["address"]));
				$this-> teacher->set("municipality",Utils::test_input( $_POST["municipality"]));
				$this-> teacher->set("postalCode", Utils::test_input($_POST["postalCode"]));
				$this-> teacher->set("email", Utils::test_input($_POST["email"]));
				$this-> teacher->set("role", "Teacher");

				if (isset($_POST["validator"])) {
					$this-> teacher->set("isValidator",1);
				}else{
					$this-> teacher->set("isValidator",0);
				}
					
				
				$img_subida = Utils::sube_img_user( $_POST["id"]);
				if($img_subida){
					$this-> teacher->set("image", $img_subida);
				}else{
					$this-> teacher->set("image", Config::$default_user_image);
				}

				$this-> teacher->add();
				header("Location: " . URL . "teacher/show");
			}else{
				$datos = $this-> teacher->showMunicipalities();
				require 'Views/teachers/insert.php';
			}
		}

		public function delete($id){


				$this-> teacher->set("id", $id);
				$this-> teacher->info();
				
				if ($this-> teacher->get("image")!=Config::$default_user_image ){
					unlink(ROOT."Views/template/".$this-> teacher->get("image"));
				}
				$this-> teacher->delete();

				header("Location: " . URL . "teacher/show");

		}


		public function edit($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {		

				$this-> teacher->set("id", $id);
				$this-> teacher->info();

				$this-> teacher->set("name", Utils::test_input($_POST["name"]));

				if($_POST["pwd"]){//Han escrit alguna cosa per tant, canvi de pass
					$this-> teacher->set("pwd", password_hash(Utils::test_input($_POST["pwd"]), PASSWORD_DEFAULT));
				}

				$this-> teacher->set("dateOfBirth", Utils::test_input(Utils::dateToMysql($_POST["naixement"])));
				$this-> teacher->set("telephone", Utils::test_input($_POST["telephone"]));
				$this-> teacher->set("addressStreet", Utils::test_input($_POST["address"]));
				$this-> teacher->set("municipality",Utils::test_input( $_POST["municipality"]));
				$this-> teacher->set("postalCode", Utils::test_input($_POST["postalCode"]));
				$this-> teacher->set("email", Utils::test_input($_POST["email"]));
				//$this-> teacher->set("role", "Teacher");
				if (isset($_POST["validator"])) {
					$this-> teacher->set("isValidator",1);
				}else{
					$this-> teacher->set("isValidator",0);
				}

				
					
				
				$img_subida = Utils::sube_img_user($_POST["id"]);
				if($img_subida){                                   // imatge nova
					$this-> teacher->set("image", $img_subida);
				}else if($_POST["image_hide"]){                    // mateixa imatge 
					//no cal fer res
				}else{  					
					unlink(ROOT."Views/template/".$this-> teacher->get("image"));					   // imatge esborrada
					$this-> teacher->set("image", Config::$default_user_image);
					
				}

				$this-> teacher->edit();
				header("Location: " . URL . "teacher/show");
			}else{
				$this-> teacher->set("id", $id);
				$datos = $this-> teacher->info();
				$municipalities = $this-> teacher->showMunicipalities();
				require 'Views/teachers/edit.php';
			}
		}

		public function info($id){
			$this-> teacher->set("id", $id);
			$datos = $this-> teacher->info();
			require 'Views/teachers/info.php';
		}
}

$teachers = new teacherController();

?>