<?

$app->post('/app/commande', 'auth', function () use ($app) {

	$data = json_decode(file_get_contents("php://input"));
	
	date_default_timezone_set('America/La_Paz');
 	$date = date('Y-m-d H:i:s') ;

	$fiche = ORM::for_table('commandes')->create();

	$fiche->etab = $data->etab;
	$fiche->clientid = $data->userid;
	$fiche->details = json_encode($data->panier);
	$fiche->dtsaisie = $date;
	$fiche->total = $data->total;
	$fiche->statut = 0;
	$fiche->ip = $_SERVER["REMOTE_ADDR"];
	$fiche->livraison = $data->livraison;

	$fiche->save();
	$id = $fiche->id();

	render( array(
		"msg"=> "ok",
		"id"=> $id
	));


});

