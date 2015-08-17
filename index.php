<?php

require_once '../vendor/idiorm.php';
require 'dbase_config.php';

require_once '../vendor/gump.php';
require '../vendor/autoload.php';

$app = new \Slim\Slim(array(
    'mode' => 'development'
));

$corsOptions = array(
    "origin" => "*",
    "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client", "Origin", "auth_token"),
    "allowMethods" => array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'),
    "allowHeaders" => array("auth_token")
); 
$app->add(new \CorsSlim\CorsSlim($corsOptions));


function render($data){
	//$app = \Slim\Slim::getInstance();
	//$app->response()->header("Content-Type", "application/json");
	
	header('Content-type: application/json');
	echo json_encode($data);
}

function getJson(){
	//$app = \Slim\Slim::getInstance();
	//return json_decode($app->request->getBody());
	$data = json_decode(file_get_contents("php://input"));
	return $data;
}

require 'middleware_auth.php';

require 'controller_admin_etablissement.php';
require 'controller_admin_utilisateur.php';
require 'controller_categorie.php';
require 'controller_article.php';

require 'controller_app_menu.php';
//include 'controller_app_infos.php';
require 'controller_app_utilisateur_infos.php';
require 'controller_app_utilisateurs.php';
require 'controller_app_login.php';
require 'controller_app_favoris.php';

require 'controller_app_commande.php';

require 'controller_order_commandes.php';

require 'controller_order_conn.php';

//require 'controller_paypal_webhooks.php'
$app->run();

?>
