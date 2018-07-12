<?php namespace Controllers;
	
	use Models\Student as Student;
	use Utils\Utils as Utils;
	use Config\Config as Config;
		
	class studentController{

		private $student;
		
		public function __construct(){
			$this->student = new Student();
		}

		public function show(){
			$datos = $this->student->show();
			require 'Views/students/show.php';
		}


		public function insert(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {		

				$this-> student->set("id", Utils::test_input($_POST["id"]));// NIF
				$this-> student->set("name", Utils::test_input($_POST["name"]));
				$this-> student->set("pwd", password_hash(Utils::test_input($_POST["pwd"]), PASSWORD_DEFAULT));
				$this-> student->set("dateOfBirth", Utils::test_input(Utils::dateToMysql($_POST["naixement"])));
				$this-> student->set("telephone", Utils::test_input($_POST["telephone"]));
				$this-> student->set("addressStreet", addslashes(Utils::test_input( $_POST["address"])));
				$this-> student->set("municipality",Utils::test_input($_POST["municipality"]));
				$this-> student->set("postalCode", Utils::test_input($_POST["postalCode"]));
				$this-> student->set("email", Utils::test_input($_POST["email"]));
				$this-> student->set("role", "Student");

				$this-> student->set("wantsToReceiveOffers",1);
					
				
				$img_subida = Utils::sube_img_user( $_POST["id"]);
				if($img_subida){
					$this-> student->set("image", $img_subida);
				}else{
					$this-> student->set("image", Config::$default_user_image);
				}

				$this-> student->add();
				header("Location: " . URL . "student/show");
			}else{
				$datos = $this-> student->showMunicipalities();
				require 'Views/students/insert.php';
			}
		}

		public function delete($id){


				$this-> student->set("id", $id);
				$this-> student->info();
				
				if ($this-> student->get("image")!=Config::$default_user_image ){
					unlink(ROOT."Views/template/".$this-> student->get("image"));
				}
				$this-> student->delete();

				header("Location: " . URL . "student/show");

		}


		public function edit($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {		

				$this-> student->set("id", $id);
				$this-> student->info();

				$this-> student->set("name", Utils::test_input($_POST["name"]));

				if($_POST["pwd"]){//Han escrit alguna cosa per tant, canvi de pass
					$this-> student->set("pwd", password_hash(Utils::test_input($_POST["pwd"]), PASSWORD_DEFAULT));
				}

				$this-> student->set("dateOfBirth", Utils::test_input(Utils::dateToMysql($_POST["naixement"])));
				$this-> student->set("telephone", Utils::test_input($_POST["telephone"]));
				$this-> student->set("addressStreet", addslashes(Utils::test_input($_POST["address"])));
				$this-> student->set("municipality",Utils::test_input( $_POST["municipality"]));
				$this-> student->set("postalCode", Utils::test_input($_POST["postalCode"]));
				$this-> student->set("email", Utils::test_input($_POST["email"]));
				//$this-> student->set("role", "Student");
				if (isset($_POST["offers"])) {
					$this-> student->set("wantsToReceiveOffers",1);
				}else{
					$this-> student->set("wantsToReceiveOffers",0);
				}

				
					
				
				$img_subida = Utils::sube_img_user($_POST["id"]);
				if($img_subida){                                   // imatge nova
					$this-> student->set("image", $img_subida);
				}else if($_POST["image_hide"]){                    // mateixa imatge 
					//no cal fer res
				}else{  					
					unlink(ROOT."Views/template/".$this-> student->get("image"));					   // imatge esborrada
					$this-> student->set("image", Config::$default_user_image);
					
				}

				$this-> student->edit();
				header("Location: " . URL . "student/show");
			}else{
				$this-> student->set("id", $id);
				$datos = $this-> student->info();
				$municipalities = $this-> student->showMunicipalities();
				require 'Views/students/edit.php';
			}
		}

		public function info($id){
			$this-> student->set("id", $id);
			$datos = $this-> student->info();
			require 'Views/students/info.php';
		}

		public function masive(){
			$fitxer_subida = Utils::masiveLoadFile();
			if($fitxer_subida){
				$fitxer = @fopen($fitxer_subida,"r");
				if($fitxer){
					echo "<table>";
					while ($fields = fgetcsv($fitxer,",")) {
    					echo "<tr><td>".$fields[0]."</td><td>".$fields[1]."</td><td>".$fields[2]."</td><td>".$fields[3]."</td><td>".$fields[4]."</td><td>".$fields[5]."</td></tr>";

							$this-> student->set("id", Utils::test_input($fields[0]));// NIF
							$this-> student->set("name", Utils::test_input($fields[1]));
							$this-> student->set("pwd", password_hash(Utils::test_input("12345"), PASSWORD_DEFAULT));
							$this-> student->set("dateOfBirth", Utils::test_input(Utils::dateToMysql($fields[2])));
							$this-> student->set("telephone", Utils::test_input($fields[5]));
							$this-> student->set("addressStreet", addslashes(Utils::test_input($fields[3])));
							$this-> student->set("municipality",Utils::test_input( "Eivissa"));
							$this-> student->set("postalCode", Utils::test_input("07800"));
							$this-> student->set("email", Utils::test_input($fields[4]));


							$this-> student->set("role", "Student");
							$this-> student->set("wantsToReceiveOffers",1);
			    			$this-> student->set("image", Config::$default_user_image);
			    			$this-> student->add();
					}
					echo "</table>";
					fclose($fitxer);
				}				
			}else{
				//imatge no pujada
			}

		}
}

$students = new studentController();

?>