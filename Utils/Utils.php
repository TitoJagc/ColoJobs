<?php namespace Utils;


 class Utils
 {

 		static public function mysqlToDate($var){
 			return preg_replace("/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/","$3/$2/$1",$var);
 		}

 		static public function dateToMysql($var){
 			return preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/","$3/$2/$1",$var);
 		} 		

		//Filtra string provinents de Formularis per tal d'evitar atacs
		static public function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

				//TODE: AIxò s'ha de fer generic i posar-ho en una classe utils o algo així
		static public function sube_img_user($id){
			if ($_FILES["image"]["size"] !=0 ){
				//echo print_r($_FILES["image"]),"<br>";
				$target_dir = ROOT."Views/template/imagenes/users/";
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				    $check = getimagesize($_FILES["image"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }
				}

				// Check file size
				if ($_FILES["image"]["size"] > 500000) {
				    echo "Sorry, your file is too large.";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    //echo "Sorry, your file was not uploaded.";
					return false;
				} else {// if everything is ok, try to upload file
					$real_name_path = $target_dir.$id.".".$imageFileType;
					$return_name_path = "imagenes/users/".$id.".".$imageFileType;
				    if (move_uploaded_file($_FILES["image"]["tmp_name"], $real_name_path)) {
				        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
				        return $return_name_path;
				    } else {
				        //echo "Sorry, there was an error uploading your file.";
				        return false;
				    }
				}
			}else{//No s'envia cap imatge
				return false;
			}
		}


		static public function masiveLoadFile(){
			if ($_FILES["fitxer"]["size"] !=0 ){
				//echo print_r($_FILES["image"]),"<br>";
				$target_dir = ROOT."Files/";
				$target_file = $target_dir . basename($_FILES["fitxer"]["name"]);
				$uploadOk = 1;
				$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

				// Check if image file is a actual image or fake image
				/*if(isset($_POST["submit"])) {
				    $check = getimagesize($_FILES["fitxer"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }
				}*/

				// Check file size
				if ($_FILES["fitxer"]["size"] > 500000) {
				    echo "Sorry, your file is too large.";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($FileType != "txt" && $FileType != "csv") {
				    echo "Sorry, only txt or csv files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    //echo "Sorry, your file was not uploaded.";
					return false;
				} else {// if everything is ok, try to upload file
					
					if (move_uploaded_file($_FILES["fitxer"]["tmp_name"], $target_file)) {
				        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
				        return $target_file;
				    } else {
				        //echo "Sorry, there was an error uploading your file.";
				        return false;
				    }
				}
			}else{//No s'envia cap imatge
				return false;
			}
		}

 }

 ?>