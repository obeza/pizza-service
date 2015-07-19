<?php

require_once '../vendor/idiorm.php';
ORM::configure('mysql:host=localhost;dbname=pizzapizza');
ORM::configure('username', 'root');
ORM::configure('password', 'root');

require_once '../vendor/gump.php';
require '../vendor/autoload.php';
//require 'vendor/slim/slim/Slim/Slim.php';

//$app = new \Slim\Slim();

$app = new \Slim\Slim(array(
    'mode' => 'development'
));

function verifEmpty($verif){
	if (!empty($verif)){
		return null;
	}
}

function graindesel(){
	return "mongraindesel";
}


function check(){
	//$charset = apache_request_headers()["Authorization"];

	//$msg = array("msg"=>$charset);

	//echo json_encode($msg);
	//exit;
}

include 'controller_etablissement.php';
include 'controller_utilisateur.php';
include 'controller_categorie.php';
include 'controller_article.php';

include 'controller_app_menu.php';
//include 'controller_app_infos.php';
include 'controller_app_utilisateurs.php';

$app->get('/norris', 'check', function () {
	$myfile = fopen("../angularjs/initfactory/norris.json", "r") or die("Unable to open file!");
	//echo fread($myfile,filesize("norris.json"));
	sleep (3);
while ($line = fgets($myfile)) {
  // <... Do your work with the line ...>
  echo($line);
}
	fclose($myfile);
});

$app->run();

?>