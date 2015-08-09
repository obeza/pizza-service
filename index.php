<?php

require_once '../vendor/idiorm.php';
require 'dbase_config.php';

require_once '../vendor/gump.php';
require '../vendor/autoload.php';

$app = new \Slim\Slim();

// $corsOptions = array(
//     "origin" => "*",
//     "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client"),
//     "allowMethods" => array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS')
// );
// $cors = new \CorsSlim\CorsSlim($corsOptions);

// $app->add($cors);

require 'middleware_auth.php';

require 'controller_etablissement.php';
require 'controller_utilisateur.php';
require 'controller_categorie.php';
require 'controller_article.php';

require 'controller_app_menu.php';
//include 'controller_app_infos.php';
require 'controller_app_utilisateur_infos.php';
require 'controller_app_utilisateurs.php';
require 'controller_app_login.php';
require 'controller_app_favoris.php';

require 'controller_app_commande.php';

//require 'controller_paypal_webhooks.php'
$app->run();

?>
