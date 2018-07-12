<?php namespace Models;
	
	class Teacher extends Users{

		protected $isValidator;
		/*heredats
		protected $id;//DNI
		protected $name;
		protected $pwd;
		protected $dateOfBirth;
		protected $telephone;
		protected $addressStreet;
		protected $municipality;
		protected $postalCode;
		protected $email;
		protected $image;
		*/

		public function __construct(){ 
			parent::__construct();
		}

		//get i set heretats

		public function show(){
			$sql = "SELECT * FROM Teacher INNER JOIN User ON Teacher.id = User.id";
			return $this->con->consultaRetorno($sql);
		}

		public function getValidators(){
			$sql = "SELECT * FROM Teacher INNER JOIN User ON Teacher.id = User.id where Teacher.isValidator = 1";
			return $this->con->consultaRetorno($sql);
		}

		public function delete(){
			$sql = "DELETE FROM Teacher WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
			parent::delete();
		}

		public function add(){
			parent::add();
			$sql = "INSERT INTO Teacher (id, isValidator) VALUES ('{$this->id}','{$this->isValidator}')";
			$this->con->consultaSimple($sql);
		}

		public function edit(){
			parent::edit();
			$sql = "UPDATE Teacher SET isValidator = '{$this->isValidator}' WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
		}

		public function info(){
			$sql = "SELECT * FROM Teacher INNER JOIN User ON Teacher.id = User.id where User.id = '{$this->id}'";
			$row = array_shift($this->con->consultaRetorno($sql));
			$this-> id = $row['id'];
			$this-> name = $row['name'];
			$this-> pwd = $row['pwd'];
			$this-> dateOfBirth = $row['dateOfBirth'];
			$this-> telephone = $row['telephone'];
			$this-> municipality = $row['municipality'];
			$this-> postalCode = $row['postalCode'];
			$this-> role = $row['role'];
			$this-> image = $row['image'];
			$this-> isValidator = $row['isValidator'];
			
			return $row;
		}
	}

?>