<?php namespace Models;
	
	class Offer{

		private $num;
		private $description;
		private $dateStart;
		private $dateEnd;
		private $validatedBy;
		private $idCompany;
		private $con;

		private $competence;//Alta de competència
		private $competences;//Llista competències oferta

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
			$sql = "SELECT O.num, O.description, O.dateStart, O.dateEnd, O.validatedBy, O.idCompany, U.name FROM Offer O INNER JOIN Company C ON O.idCompany = C.id INNER JOIN User U ON U.id = C.id ORDER BY O.dateStart DESC";
			return $this->con->consultaRetorno($sql);
		}

		public function showOffersByCompany(){
			$sql = "SELECT * FROM Offer WHERE idCompany = '{$this->idCompany}' ORDER BY dateStart DESC";
			return $this->con->consultaRetorno($sql);
		}

		public function delete(){
			$sql = "DELETE FROM Offer WHERE num = '{$this->num}'";
			$this->con->consultaSimple($sql);
		}

		public function add(){
			$sql = "INSERT INTO Offer (description, dateEnd, idCompany) VALUES ('{$this->description}','{$this->dateEnd}', '{$this->idCompany}')";
			$this->con->consultaSimple($sql);
			$this->num = $this->con->ultimoID();
		}

		public function addCompetence(){
			$sql = "INSERT INTO OfferListCompetences (competence, offer) VALUES ('{$this->competence}','{$this->num}')";
			$this->con->consultaSimple($sql);
		}

		public function deleteCompetences(){
			$sql = "DELETE FROM OfferListCompetences WHERE offer = '{$this->num}'";
			$this->con->consultaSimple($sql);
		}

		public function competenceList(){
			$sql = "SELECT competence FROM OfferListCompetences WHERE offer = '{$this->num}' order by competence ASC";
			$this-> competences = array();
			$result = $this->con->consultaRetorno($sql);
			foreach ($result as $row) {
				$this-> competences[] = $row["competence"];
			}
			
		}

		public function edit(){
			$sql = "UPDATE Offer SET description = '{$this->description}', dateStart = '{$this->dateStart}', dateEnd = '{$this->dateEnd}', idCompany = '{$this->idCompany}' WHERE num = '{$this->num}'";
			$this->con->consultaSimple($sql);
		}

		public function validate(){
			$sql = "UPDATE Offer SET  validatedBy = '{$this->validatedBy}' WHERE num = '{$this->num}'";
			$this->con->consultaSimple($sql);
		}
		
		public function info(){
			$sql = "SELECT * FROM Offer where num = '{$this->num}'";
			$row = array_shift($this->con->consultaRetorno($sql));
			$this->description = $row['description'];
			$this->dateStart = $row['dateStart'];
			$this->dateEnd = $row['dateEnd'];
			$this->validatedBy = $row['validatedBy'];
			$this->idCompany = $row['idCompany'];
			return $row;
		}


	}

?>