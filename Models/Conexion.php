<?php namespace Models;

use Config\Config as Config;

	class Conexion{


		private $con;

		public function __construct(){
			// Ensure reporting is setup correctly 
			mysqli_report(MYSQLI_REPORT_STRICT); 
			
			$this->con = new \mysqli(Config::$mvc_bd_hostname, 
									 Config::$mvc_bd_usuario,
									 Config::$mvc_bd_clave,
									 Config::$mvc_bd_nombre);
			$this->con->set_charset("utf8");
		}

		public function consultaSimple($sql){
			$this->con->query($sql);
		}

		public function ultimoID(){
			return $this->con->insert_id;
		}

		public function consultaRetorno($sql){
			$result=$this->con->query($sql);
			$datos=array();
			if ($result->num_rows) {
				while($row=$result->fetch_assoc()){
					$datos[]=$row;
				}
			}
			return $datos;
		}
	}

?>
