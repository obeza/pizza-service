<?
$app->get('/app/favoris/liste', function () use ($app) {

	$token = $app->request->headers->get('auth_token');

	$client = ORM::for_table('clients')
		->where('token', $token)
		->find_one();

	if (!$client){
		$msg = "token";
		render(array(
        	'msg' => $msg
    	));
		$app->halt(401);

	} else {
	// 	//$clientId = $client->id;
		$favoris = ORM::for_table('favoris')
			->where('clientId', $client->id)
			->where('etab', $client->etab)
			->where('jaime', 'y')
			->find_array();

		if ($favoris){
			$tabfav = array();
			for ($i = 0; $i < sizeof($favoris); $i ++) {
	    		array_push($tabfav, $favoris[$i]['articleId']);
			}
		
			$results = ORM::for_table('articles')
				->where_in('id', $tabfav)
				->find_array();

			render(array(
        		'data' => $results,
        		'msg' => $msg
    		));

	// 		// $app->response()->header("Content-Type", "application/json");
	// 		// $alerte = array("msg"=> "ok");
	// 		// echo json_encode($results);
		} else {
			render(array(
        		'msg' => 'no data'
    		));
		}
	}

});

$app->get('/app/favoris/:id/etab/:etab', function ($id, $etab) use ($app) {

	$token = $app->request->headers->get('auth_token');

	$client = ORM::for_table('clients')
		->where('token', $token)
		->find_one();

	if (!$client){
		$msg = "token";
	} else {
		$favoris = ORM::for_table('favoris')
			->where('articleId', $id)
			->where('clientId', $client->id)
			->where('etab', $etab)
			->find_one();

		$jaime = 'n';

		if ($favoris){
			$jaime = $favoris->jaime;
			$msg = "ok";
		}
	}

		render(array(
        'msg' => $msg,
        'jaime' => $jaime,
    ));


});

//
// modifier le jaime
//
$app->post('/app/favoris', function () use ($app) {

	// post => {
	// 	articleId,
	// 	etab,
	// 	jaime
	// }

	$token =  $app->request->headers->get('auth_token');

	$client = ORM::for_table('clients')
		->where('token', $token)
		->find_one();

	if (!$client){
		$msg = "token";
	} else {
		// check si le favoris exist

		$data = getJson();

		$clientId = $client->id;
		$etab = $client->etab;
		$favoris = ORM::for_table('favoris')
			->where('articleId', $data->id)
			->where('clientId', clientId)
			->where('etab', $etab)
			->find_one();

		if ($favoris){	
			// on le met à jour	 
			$favoris->jaime = $data->jaime;
			$favoris->save();		
			$msg = "maj";
		} else {
			// on le créé
			$favorisAjouter = ORM::for_table('favoris')->create();
			$favorisAjouter->etab = $etab;
			$favorisAjouter->clientId = $clientId;
			$favorisAjouter->articleId = $data->id;
			$favorisAjouter->jaime = $data->jaime;
			$favorisAjouter->save();
			$msg = "create";
		}


		// $app->response()->header("Content-Type", "application/json");
		// $alerte = array("msg"=> $msg);
		// echo json_encode($alerte);
	}

	render(array(
        'msg' => $msg,
    ));

});






