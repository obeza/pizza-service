<?

$app->get('/app/favoris/:id/etab/:etab/token/:token', function ($id, $etab, $token) use ($app) {

//$jaime =  $app->request->headers->get('auth_token');

	$client = ORM::for_table('clients')->where('token', $token)->find_one();

	if (!$client){
		$msg = "token";
	} else {
		$clientId = $client->id;
		$favoris = ORM::for_table('favoris')
		->where('articleId', $id)
		->where('clientId', $clientId)
		->where('etab', $etab)
		->find_one();

		$app->response()->header("Content-Type", "application/json");

		$jaime = 'n';

		if ($favoris){
			$jaime = $favoris->jaime;
			$msg = "ok";
		}
	}

	$alerte = array("jaime"=> $jaime, "msg"=> $msg);
	echo json_encode($alerte);

});

$app->get('/app/favoris/:id/etab/:etab/jaime/:jaime/token/:token', function ($id, $etab, $jaime, $token) use ($app) {

	$client = ORM::for_table('clients')->where('token', $token)->find_one();

	if (!$client){
		$msg = "token";
	} else {
		// check si le favoris exist
		$clientId = $client->id;
		$favoris = ORM::for_table('favoris')
		->where('articleId', $id)
		->where('clientId', $clientId)
		->where('etab', $etab)
		->find_one();

		if ($favoris){	
			// on le met à jour	 
			$favoris->jaime = $jaime;
			$favoris->save();		
			$msg = "maj";
		} else {
			// on le créé
			$favorisAjouter = ORM::for_table('favoris')->create();
			$favorisAjouter->etab = $etab;
			$favorisAjouter->clientId = $clientId;
			$favorisAjouter->articleId = $id;
			$favorisAjouter->jaime = $jaime;
			$favorisAjouter->save();
			$msg = "create";
		}
		$app->response()->header("Content-Type", "application/json");
		$alerte = array("msg"=> $msg);
		echo json_encode($alerte);
	}

});

$app->get('/app/favoris/liste/:token', function ($token) use ($app) {

	$client = ORM::for_table('clients')->where('token', $token)->find_one();

	if (!$client){
		$msg = "token";
		$app->halt(401);
	} else {
		//$clientId = $client->id;
		$favoris = ORM::for_table('favoris')
			->where('clientId', $client->id)
			->where('etab', $client->etab)
			->where('jaime', 'y')
			->find_array();

		$tabfav = array();
		for ($i = 0; $i < sizeof($favoris); $i ++) {

    		array_push($tabfav, $favoris[$i]['articleId']);

		}

		$results = ORM::for_table('articles')
			->where_in('id', $tabfav)
			->find_array();

		$app->response()->header("Content-Type", "application/json");
		$alerte = array("msg"=> "ok");
		echo json_encode($results);
	}

});




