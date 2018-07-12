<?php namespace Models;
	
	class Student extends Users{

		protected $wantsToReceiveOffers;
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

		//alumnes - ofertes
		protected $num_offer;

		public function __construct(){ 
			parent::__construct();
		}

		//get i set heretats

		public function show(){
			$sql = "SELECT * FROM Student INNER JOIN User ON Student.id = User.id";
			return $this->con->consultaRetorno($sql);
		}

		public function delete(){
			$sql = "DELETE FROM Student WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
			parent::delete();
		}

		public function add(){
			parent::add();
			$sql = "INSERT INTO Student (id, wantsToReceiveOffers) VALUES ('{$this->id}','{$this->wantsToReceiveOffers}')";
			$this->con->consultaSimple($sql);
		}

		public function edit(){
			parent::edit();
			$sql = "UPDATE Student SET wantsToReceiveOffers = '{$this->wantsToReceiveOffers}' WHERE id = '{$this->id}'";
			$this->con->consultaSimple($sql);
		}

		public function info(){
			$sql = "SELECT * FROM Student INNER JOIN User ON Student.id = User.id where User.id = '{$this->id}'";
			$row = array_shift($this->con->consultaRetorno($sql));
			$this-> id = $row['id'];
			$this-> name = $row['name'];
			$this-> pwd = $row['pwd'];
			$this-> dateOfBirth = $row['dateOfBirth'];
			$this-> telephone = $row['telephone'];
			$this-> addressStreet = $row['addressStreet'];
			$this-> municipality = $row['municipality'];
			$this-> postalCode = $row['postalCode'];
			$this-> role = $row['role'];
			$this-> email = $row['email'];
			$this-> image = $row['image'];
			$this-> wantsToReceiveOffers = $row['wantsToReceiveOffers'];
			
			return $row;
		}

		public function getStudentForOffer(){

			$sql = "select DISTINCT(U.email), U.name from User U Inner Join Student S on U.id = S.id Inner join StudentListCicles SLC on S.id = SLC.student inner join Cicle Ci on Ci.name = SLC.cicle INNER JOIN CicleListCompetences CLC on Ci.name = CLC.cicle where CLC.competence IN(select competence from OfferListCompetences OLC where OLC.offer = '{$this->num_offer}')";
			return $this->con->consultaRetorno($sql);
		}
	}

?>