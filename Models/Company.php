<?php namespace Models;
	
	class Company extends Users{

		protected $description;
		protected $web;
		/*heredats
		protected $id;//NIF
		protected $name;
		protected $pwd;
		protected $dateOfBirth;//data d'alta
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
			$sql = "SELECT * FROM Company INNER JOIN User ON Company.id = User.id";
			return $this->con->consultaRetorno($sql);
		}

		public function delete(){
			$sql = "DELETE FROM Company WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
			parent::delete();
		}

		public function add(){
			parent::add();
			$sql = "INSERT INTO Company (id, description, web) VALUES ('{$this->id}','{$this->description}','{$this->web}')";
			$this->con->consultaSimple($sql);
		}

		public function edit(){
			parent::edit();
			$sql = "UPDATE Company SET description = '{$this->description}', web = '{$this->web}' WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
		}

		public function info(){
			$sql = "SELECT * FROM Company INNER JOIN User ON Company.id = User.id where User.id = '{$this->id}'";
			$row = array_shift($this->con->consultaRetorno($sql));
			$this-> id = $row['id'];
			$this-> name = $row['name'];
			$this-> pwd = $row['pwd'];
			$this-> dateOfBirth = $row['dateOfBirth'];
			$this-> telephone = $row['telephone'];
			$this-> municipality = $row['municipality'];
			$this-> postalCode = $row['postalCode'];
			$this-> role = $row['role'];
			$this-> email = $row['email'];
			$this-> image = $row['image'];
			$this-> description = $row['description'];
			$this-> web = $row['web'];
			return $row;
		}
	}

?>