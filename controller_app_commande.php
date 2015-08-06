<?

$app->post('/app/commande/statut/0', 'auth', function () use ($app) {


	$data = json_decode(file_get_contents("php://input"));
	
	$fiche = ORM::for_table('commandes')->create();

	$fiche->cmd_etab = $data->etab;
	$fiche->cmd_details = json_encode($data->panier);
	$fiche->cmd_total = $data->total;

	$fiche->save();



	$msg = array("msg"=> "ok", "id" => $fiche->id() );

	$app->response()->header("Content-Type", "application/json");
	echo json_encode($msg);

});