<?php namespace Controllers;
	
	use Models\Company as Company;
	use Models\Offer as Offer;	
	use Utils\Utils as Utils;
	use Config\Config as Config;
		
	class companyController{

		private $company;
		private $offers;
		
		public function __construct(){
			$this->company = new Company();
			$this->offers = new Offer();
		}

		public function show(){//llistar empreses
			$datos = $this->company->show();
			require 'Views/companies/show.php';
		}


		public function insert(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {		

				$this-> company->set("id", Utils::test_input($_POST["id"]));// NIF
				$this-> company->set("name", Utils::test_input($_POST["name"]));
				$this-> company->set("pwd", password_hash(Utils::test_input($_POST["pwd"]), PASSWORD_DEFAULT));
				$this-> company->set("dateOfBirth", date('Y-m-d'));//Data d'alta
				$this-> company->set("telephone", Utils::test_input($_POST["telephone"]));
				$this-> company->set("addressStreet", addslashes(Utils::test_input($_POST["address"])));
				$this-> company->set("municipality",Utils::test_input( $_POST["municipality"]));
				$this-> company->set("postalCode", Utils::test_input($_POST["postalCode"]));
				$this-> company->set("email", Utils::test_input($_POST["email"]));
				$this-> company->set("role", "Company");
				$this-> company->set("description",Utils::test_input($_POST["description"]));
				$this-> company->set("web", Utils::test_input($_POST["website"]));	
				
				$img_subida = Utils::sube_img_user( $_POST["id"]);
				if($img_subida){
					$this-> company->set("image", $img_subida);
				}else{
					$this-> company->set("image", Config::$default_user_image);
				}

				$this-> company->add();
				header("Location: " . URL . "company/show");
			}else{
				$datos = $this-> company->showMunicipalities();
				require 'Views/companies/insert.php';
			}
		}

		public function delete($id){

				$this-> company->set("id", $id);
				$this-> company->info();

				if ($this-> company->get("image")!=Config::$default_user_image ){
					unlink(ROOT."Views/template/".$this-> company->get("image"));
				}
				$this-> company->delete();
				header("Location: " . URL . "company/show");

		}


		public function edit($id){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {		

				$this-> company->set("id", $id);
				$this-> company->info();

				$this-> company->set("name", Utils::test_input($_POST["name"]));

				if($_POST["pwd"]){//Han escrit alguna cosa per tant, canvi de pass
					$this-> company->set("pwd", password_hash(Utils::test_input($_POST["pwd"]), PASSWORD_DEFAULT));
				}

				//$this-> company->set("dateOfBirth", date('Y-m-d'));//Data d'alta
				$this-> company->set("telephone", Utils::test_input($_POST["telephone"]));
				$this-> company->set("addressStreet", addslashes(Utils::test_input($_POST["address"])));
				$this-> company->set("municipality",Utils::test_input( $_POST["municipality"]));
				$this-> company->set("postalCode", Utils::test_input($_POST["postalCode"]));
				$this-> company->set("email", Utils::test_input($_POST["email"]));
				//$this-> company->set("role", "Company");
				$this-> company->set("description",Utils::test_input($_POST["description"]));
				$this-> company->set("web", Utils::test_input($_POST["website"]));	
				
				$img_subida = Utils::sube_img_user($_POST["id"]);
				if($img_subida){                                   // imatge nova
					$this-> company->set("image", $img_subida);
				}else if($_POST["image_hide"]){                    // mateixa imatge 
					//no cal fer res
				}else{  					
					unlink(ROOT."Views/template/".$this-> company->get("image"));					   // imatge esborrada
					$this-> company->set("image", Config::$default_user_image);
					
				}

				$this-> company->edit();
				header("Location: " . URL . "company/show");
			}else{
				$this-> company->set("id", $id);
				$datos = $this-> company->info();
				$municipalities = $this-> company->showMunicipalities();
				require 'Views/companies/edit.php';
			}
		}

		public function info($id){
			$_SESSION["company"] = $id;
			$this-> company->set("id", $id);
			$datos = $this-> company->info();
			$this-> offers->set("idCompany",$id);
			$ofertas = $this-> offers->showOffersByCompany();
			foreach ($ofertas as $key => $oferta) {
				$this-> offers->set("num",$oferta["num"]);
				$this-> offers->competenceList();
				$oferta["competences"] = $this-> offers->get("competences");
				$ofertas[$key] = $oferta;
			}
			require 'Views/companies/info.php';
		}


		public function masive(){
			$fitxer_subida = Utils::masiveLoadFile();
			if($fitxer_subida){
				$fitxer = @fopen($fitxer_subida,"r");
				if($fitxer){
					//echo "<table>";
					while ($fields = fgetcsv($fitxer,",")) {
    					//echo "<tr><td>".$fields[0]."</td><td>".$fields[1]."</td><td>".$fields[2]."</td><td>".$fields[3]."</td><td>".$fields[4]."</td><td>".$fields[5]."</td></tr>";

						$this-> company->set("id", Utils::test_input($fields[0]));// NIF
						$this-> company->set("name", Utils::test_input($fields[1]));
						$this-> company->set("pwd", password_hash(Utils::test_input("54321"), PASSWORD_DEFAULT));
						$this-> company->set("dateOfBirth", date('Y-m-d'));//Data d'alta
						$this-> company->set("telephone", Utils::test_input($fields[3]));
						$this-> company->set("addressStreet", addslashes(Utils::test_input($fields[2])));
						$this-> company->set("municipality",Utils::test_input( "Eivissa"));
						$this-> company->set("postalCode", Utils::test_input("07800"));
						$this-> company->set("email", Utils::test_input($fields[4]));
						
						$this-> company->set("description",addslashes(Utils::test_input($fields[6])));
						$this-> company->set("web", Utils::test_input($fields[5]));	

						$this-> company->set("role", "Company");
						$this-> company->set("image", Config::$default_user_image);
						

						$this-> company->add();
					}
					//echo "</table>";
					fclose($fitxer);
				}				
			}else{
				//imatge no pujada
			}

		}
}

$companies = new companyController();

?>