<?php namespace Controllers;

	use Models\Cicle as Cicle;
	
	class cicleController{

		private $cicle;

		public function __construct(){
			$this->cicle = new Cicle();
		}

		public function index(){
			$this->show();
		}

		public function insert(){
			if($_POST){
				$this->cicle->set("name", addslashes(Utils::test_input($_POST['name'])));
				$this->cicle->add();
				header('Location: '. URL . "cicle/show");
			} else {
				$this->show();
			}
		}
		
		public function edit(){
			if($_POST){
				$this->cicle->set("name", addslashes(Utils::test_input($_POST['name'])));
				$this->cicle->set("newname", addslashes(Utils::test_input($_POST['newname'])));
				$this->cicle->edit();
				//header('Location: '. URL . "specialty");
				echo '200'; // ajax success code
				//echo array_shift($this->cicle->info($cicle)['keyword'];
			}
		}
		
		public function delete($id){
			$this->cicle->set("name", base64_decode($id));
			$this->cicle->delete();
			header('Location: '. URL . "cicle/show");
		}

		public function show(){
			$datos = $this->cicle->show();
			require'Views/cicles/show.php';
		}

	}


?>