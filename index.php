<?php
	session_start();
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', realpath(dirname(__FILE__)) . DS);
	define('URL', "http://localhost/ColoJobs/");
	//define('URL', "http://colojobs.iessacolomina.cat/");

	//Include Google client library 
	require_once 'Utils/google/Google_Client.php';
	require_once 'Utils/google/contrib/Google_Oauth2Service.php';

	require_once "Config/Autoload.php";
	Config\Autoload::run();
	//require_once "Views/template.php";
	Config\Enrutador::run(new Config\Request());
?>