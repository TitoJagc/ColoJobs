<?php namespace Models;

	class Specialty{

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
			$sql = "SELECT name FROM Specialty ORDER BY name ASC";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function add(){
			$sql = "INSERT INTO Specialty VALUES ('{$this->name}')";
			$this->con->consultaSimple($sql);
		}

		public function delete(){
			$sql = "DELETE FROM Specialty WHERE name = '{$this->name}'";
			$this->con->consultaSimple($sql);
		}

		public function edit(){
			$sql = "UPDATE Specialty SET name = '{$this->newname}' WHERE name = '{$this->name}'";
			$this->con->consultaSimple($sql);
		}
	
		public function info($specialty){
			$sql = "SELECT name FROM Specialty WHERE name = '{$specialty}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		
	}
?>