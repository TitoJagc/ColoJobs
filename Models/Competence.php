<?php namespace Models;

	class Competence{

		private $keyword;
		private $specialty;
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
			$sql = "SELECT keyword, specialty FROM Competence ORDER BY specialty ASC, keyword ASC";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}

		public function add(){
			$sql = "INSERT INTO Competence VALUES ('{$this->keyword}','{$this->specialty}')";
			$this->con->consultaSimple($sql);
		}

		public function delete(){
			$sql = "DELETE FROM Competence WHERE keyword = '{$this->keyword}'";
			$this->con->consultaSimple($sql);
		}

		public function edit($competence){
			$sql = "UPDATE Competence SET keyword = '{$this->keyword}', specialty = '{$this->specialty}'  WHERE keyword = '{$competence}'";
			$this->con->consultaSimple($sql);
		}
	
		public function info($competence){
			$sql = "SELECT keyword FROM Competence WHERE keyword = '{$competence}'";
			$datos = $this->con->consultaRetorno($sql);
			return $datos;
		}
		
	}
?>