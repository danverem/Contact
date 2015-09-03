<?php

/*
    This is the bootstap for the entire application
*/

require_once('libs/Smarty.class.php');

//Parse the ini file
$config = parse_ini_file("config.ini", TRUE);

require_once('classes/BaseController.php');

if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['REQUEST_METHOD'])) {

	$method = $_SERVER['REQUEST_METHOD'];

	$requestData = '';

	if (isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 0) {
		//There is some data in the request. We would like to have this.

		$httpContent = fopen('php://input', 'r');
		while ($data = fread($httpContent, 1024)) {
			$requestData .= $data;
		}
		fclose($httpContent);
	}

	//If we are installed in a subdirectory, we'd like to analyse the part after this directory
	$urlString = substr($_SERVER['REQUEST_URI'], strlen($config['settings']['baseURL']));

	//Split the url in pieces
	$urlParts = explode('/', $urlString);

	$lastPart = array_pop($urlParts);
	$dotPosition = strpos($lastPart, '.');
	if ($dotPosition !== FALSE) {

		$extention = substr($lastPart, $dotPosition + 1);
		$lastPart = substr($lastPart, 0, $dotPosition);
	}
	array_push($urlParts, $lastPart);


	if (isset($urlParts[0]) && $urlParts[0] == '') {
		array_shift($urlParts);
	}
	
	if (!isset($urlParts[0]) || $urlParts[0] == '') {
		//If the url does not contain more then / we're going to start the default controller. Which is home
		$mainViewPath="home/";
		$currentController = "HomeController";
		$controllerFile = "homeController.php";
	}
	else	{
		$mainViewPath=strtolower($urlParts[0]);
		//There is a directive after the / so that is going to be our controller
		$currentController = ucfirst($urlParts[0]) . "Controller";
		$controllerFile = $urlParts[0] . "Controller.php";
		//This will make the 'action' part of the url the first directive
		array_shift($urlParts);
	}

	$config['settings']['current_view_path'] = $config['settings']['view_path'] . $mainViewPath . "/";

	$controllerClassFilePath=$config['settings']['controller_path'] . $controllerFile;

	try {
		//We'll try loading the class file
		if(file_exists($controllerClassFilePath)) {
			require_once($controllerClassFilePath);
		} else {
			//Make it go wrong
			throw(new Exception('Onbekende route.'));
		}
	}
	catch(Exception $err) {

		header($_SERVER["SERVER_PROTOCOL"] . " 404 Not found");
	}
	new $currentController($currentController, $urlParts, $requestData);
}
else    {
	header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad request");
}

?>
