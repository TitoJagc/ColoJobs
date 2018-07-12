<?php namespace Config;

 class Config
 {
 	 //BD LOCAL
     
     static public $mvc_bd_hostname = "localhost";
     static public $mvc_bd_nombre   = "colojobs";
     static public $mvc_bd_usuario  = "root";
     static public $mvc_bd_clave    = "";

     //css
     static public $mvc_vis_css     = "estilo.css";
     //images
     static public $default_user_image = "imagenes/users/user.png";
     //email
     static public $system_email = "colojobs@iessacolomina.es";
     static public $pass_email = "fpjobs17";

     // Configuration and setup Google API
     static public $clientId = '817565598889-.apps.googleusercontent.com';
     static public $clientSecret = 'hyRGYWTASt3y';
     static public $redirectURL = 'http://colojobs.iessacolomina.cat/users/googlelogin';
 }

 ?>