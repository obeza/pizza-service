<?php

require_once '../vendor/idiorm.php';
require 'dbase_config.php';

require_once '../vendor/gump.php';
require '../vendor/autoload.php';

$app = new \Slim\Slim();

require 'controller_etablissement.php';
require 'controller_utilisateur.php';
require 'controller_categorie.php';
require 'controller_article.php';

require 'controller_app_menu.php';
//include 'controller_app_infos.php';
require 'controller_app_utilisateur_infos.php';
require 'controller_app_utilisateurs.php';
require 'controller_app_login.php';

//require 'controller_paypal_webhooks.php'
$app->run();

?>
