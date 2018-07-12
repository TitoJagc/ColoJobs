<?php namespace Models;
	
	class Users{

		protected $id;// DNI
		protected $name;
		protected $pwd;
		protected $dateofBirth;
		protected $telephone;
		protected $addressStreet;
		protected $municipality;
		protected $postalCode;
		protected $email;
		protected $role;
		protected $image;
		protected $con;

		public function __construct(){ 
			$this->con = new Conexion();
		}

		public function __destruct(){
			$this->con = null;
		}

		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}

		public function get($atributo){
			return $this->$atributo;
		}

		public function show(){
			$sql = "SELECT * FROM User";
			return $this->con->consultaRetorno($sql);
		}

		public function delete(){
			$sql = "DELETE FROM User WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
		}

		public function add(){
			$sql = "INSERT INTO User (id, name, pwd, dateofBirth, telephone, addressStreet, municipality, postalCode, email, role, image) VALUES ('{$this->id}','{$this->name}','{$this->pwd}','{$this->dateofBirth}', '{$this->telephone}', '{$this->addressStreet}', '{$this->municipality}', '{$this->postalCode}', '{$this->email}', '{$this->role}', '{$this->image}')";
			$this->con->consultaSimple($sql);
		}

		public function edit(){
			$sql = "UPDATE User SET name = '{$this->name}', dateofBirth = '{$this->dateofBirth}', telephone = '{$this->telephone}', addressStreet = '{$this->addressStreet}', municipality = '{$this->municipality}', postalCode
			 = '{$this->postalCode}', email = '{$this->email}', role = '{$this->role}' WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
		}


		public function info(){
			$sql = "SELECT * FROM User WHERE email = '{$this->email}'";
			$row = array_shift($this->con->consultaRetorno($sql));
			$this-> id = $row['id'];
			$this-> name = $row['name'];
			$this-> pwd = $row['pwd'];
			$this-> dateofBirth = $row['dateofBirth'];
			$this-> telephone = $row['telephone'];
			$this-> addressStreet = $row['addressStreet'];
			$this-> municipality = $row['municipality'];
			$this-> postalCode = $row['postalCode'];
			$this-> role = $row['role'];
			$this-> image = $row['image'];
			return $row;
		}


		public function validate(){
			$sql = "SELECT * FROM User WHERE email = '{$this->email}'";
			$datos = $this->con->consultaRetorno($sql);
			if (count($datos) > 0) {
				$row = array_shift($datos);
				return password_verify($this->pwd, $row["pwd"]);
			}else{
				return false;
			}

		}

		
	}

?>