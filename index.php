<?php  
	require './psystem/config/config.php';
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Origin: *");

	$bootstrap = new Bootstrap();
	$bootstrap->init();
	Database::Close();

	function __autoload($class) {
		
		$path = LIBS .$class .".php";
		if (file_exists($path)){
				include($path);
				return;
		}else{
				throw new Exception("{$class} not found");
		}
	}