<?

$app->post('/app/utilisateur/login', function () use ($app) {


	$data = getJson();

	$client = ORM::for_table('clients')
	->where('email', $data->email)
	->where('passe', sha1($data->passe) )
	->where('etab', $data->etab)
	->find_one();

	$msg = "erreur";
	$token = "";
	$infos = [];

	if ($client){
		
		//$token = hash('sha512', mt_rand());
		$token = hash('sha1', mt_rand());

		$client->token = $token;
		$client->save();
		$msg = "ok";

		$infos = ORM::for_table('clients')
			->select_many(
				'id', 
				'nom', 
				'prenom',
				'adresse',
				'ville',
				'tel',
				'email'
			)
			->where('id', $client->id)
			->find_array();


		// unset($infos->passe);
		// unset($infos->token);
		// unset($infos->etab);
		// unset($infos->dt_creation);
		// unset($infos->system);
		// unset($infos->gcm);
	} else {
		$client = "";
	}

	render(array(
        'msg' => $msg,
        'token' => $token,
        'infos' => $infos[0]
    ));

	// $msg = array("msg"=> $msg,"token"=>$token, "infos"=> $infos[0]);

	// $app->response()->header("Content-Type", "application/json");
	// echo json_encode($msg);

});