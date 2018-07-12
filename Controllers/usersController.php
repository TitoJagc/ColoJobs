<?php namespace Controllers;
	
	use Models\Users as Users;
	use Config\Config as Config;
		

	class usersController{

		private $user;
		
		public function __construct(){
			$this->user = new Users();
		}

		public function index(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->user->set("email", $_POST["username"]);
				$this->user->set("pwd", $_POST["password"]);
				
				if($this->user->validate()){
					
					$info = $this->user->info();

					$_SESSION["email"] = $info["email"];
					$_SESSION["name"] = $info["name"];
					$_SESSION["rol"] = $info["role"];
					$_SESSION["image"] = $info["image"];

					header("Location: " . URL . "users/backoffice");
				}else{
					$mensaje = "Això no valida";
				}
				
			}
			
			require 'Views/login.php';
		}

		public function googlelogin(){

			//Call Google API
			$gClient = new \Google_Client();
			$gClient->setApplicationName('ColoJobs');
			$gClient->setClientId(Config::$clientId);
			$gClient->setClientSecret(Config::$clientSecret);
			$gClient->setRedirectUri(Config::$redirectURL);

			$google_oauthV2 = new \Google_Oauth2Service($gClient);


			if(isset($_GET['code'])){
    			$gClient->authenticate($_GET['code']);
    			$_SESSION['token'] = $gClient->getAccessToken();
    			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
			}

			if (isset($_SESSION['token'])) {
    			$gClient->setAccessToken($_SESSION['token']);
			}

			if ($gClient->getAccessToken()) {
			    //Get user profile data from google
			    $gpUserProfile = $google_oauthV2->userinfo->get();
			    
			    $this->user->set("email", $gpUserProfile['email']);
			    $row_user = $this->user->info();
			    if (count($row_user)) {
			    	$_SESSION["email"] = $info["email"];
					$_SESSION["name"] = $info["name"];
					$_SESSION["rol"] = $info["role"];
					$_SESSION["image"] = $info["image"];

					header("Location: " . URL . "users/backoffice");
			    }else{
			        $mensaje = 'Hi ha algun tipus de problema, ja tens usuari?';
			        require 'Views/login.php';
			    }
			} else {
				$authUrl = $gClient->createAuthUrl();
				header("Location:" . filter_var($authUrl, FILTER_SANITIZE_URL) );
			    
			}
			
			

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->user->set("email", $_POST["username"]);
				$this->user->set("pwd", $_POST["password"]);
				
				if($this->user->validate()){
					
					$info = $this->user->info();


				}else{
					$mensaje = "Això no valida";
				}
				
			}
			
			require 'Views/login.php';
		}

		public function backoffice(){

			if(isset($_SESSION["email"])){
				require 'Views/users/dashboard.php';	
			}else{
				require'Views/page_403.html';
			}
			
			
		}

		public function logout(){

			session_destroy();
			
			header("Location:" . URL );
		}

}

$users = new usersController();

?>