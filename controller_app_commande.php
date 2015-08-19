<?

$app->post('/app/commande', function () use ($app) {

	$data = json_decode(file_get_contents("php://input"));
	//$data = getJson();

	// format de la livraison de string à bool
	$livraison = $data->livraison;
	$livraison = $livraison === 'true'? true: false;


	date_default_timezone_set('America/La_Paz');
 	$date = date('Y-m-d H:i:s') ;

	$fiche = ORM::for_table('commandes')->create();

	$fiche->etab = (int)$data->etab;
	$fiche->clientid = (int)$data->userid;
	$fiche->details = json_encode($data->panier);
	$fiche->dtsaisie = $date;
	$fiche->total = floatval($data->total);
	$fiche->statut = 0;
	$fiche->ip = $_SERVER["REMOTE_ADDR"];
	$fiche->livraison = $livraison;

	$fiche->save();
	$id = $fiche->id();

	$data = array( 
		"msg"=>"ok",
		"id"=> $id

	);

	header('Content-type: application/json');
	echo json_encode($data);
	exit;


});

$app->post('/app/commande/paypal', $authApp, function () use ($app) {

	//$data = json_decode(file_get_contents("php://input"));
	$data = getJson();

	date_default_timezone_set('America/La_Paz');
 	$date = date('Y-m-d H:i:s') ;

 	$fiche = ORM::for_table('commandes')
 	->where('id', $data->commandeId)
 	->find_one();

 	$msg = "erreur";

 	if ($fiche){
	 	$fiche->paypalres = $data->payid;
	 	$fiche->statut = 1;
	 	$fiche->dtPaypal = $date;
	 	$fiche->save();

	 	$msg = "ok";


	 	// ajouter le code de notification vers l'app Orders
	 	//
	 	//
	 	//

 	}
	render( array(
		"msg"=> $msg
	));
	exit;

});