<?php namespace Controllers;

	use Models\Competence as Competence;
	
	class competenceController{

		private $competence;

		public function __construct(){
			$this->competence = new Competence();
		}

		public function index(){
			$this->show();
		}

		public function insert(){
			if($_POST){
				$this->competence->set("keyword", $_POST['keyword']);
				$this->competence->set("specialty", $_POST['specialty']);
				$this->competence->add();
				header('Location: '. URL . "competence");
			} else {
				$this->show();
			}
		}
		
		public function edit($competence){
			if($_POST){
				$this->competence->set("keyword", $_POST['keyword']);
				$this->competence->set("specialty", $_POST['specialty']);
				$this->competence->edit($competence);
				//header('Location: '. URL . "specialty");
				echo '200'; // ajax success code
				//echo array_shift($this->competence->info($competence)['keyword'];
			}
		}
		
		public function delete($id){
			$this->competence->set("keyword", base64_decode($id));
			$this->competence->delete();
			header('Location: '. URL . "competence");
		}

		public function show(){
			$datos = $this->competence->show();
			require'Views/competence/show.php';
		}

	}
?>