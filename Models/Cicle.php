<?php namespace Models;
	
	class Cicle{

		private $name;
		private $newname;
		private $con;

		public function __construct(){ 
			$this->con = new Conexion();
		}

		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}

		public function get($atributo){
			return $this->$atributo;
		}

		public function show(){
			$sql = "SELECT * FROM Cicle";
			return $this->con->consultaRetorno($sql);
		}

		public function add(){
			$sql = "INSERT INTO Cicle VALUES ('{$this->name}')";
			$this->con->consultaSimple($sql);
		}

		public function delete(){
			$sql = "DELETE FROM Cicle WHERE name = '{$this->name}'";
			$this->con->consultaSimple($sql);
		}

		public function edit(){
			$sql = "UPDATE Cicle SET name = '{$this->newname}' WHERE name = '{$this->name}'";
			$this->con->consultaSimple($sql);
		}
	
		public function info(){
			$sql = "SELECT name FROM Cicle WHERE name = '{$this->name}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}


	}

?>