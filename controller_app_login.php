<?

$app->post('/app/utilisateur/login', function () use ($app) {


	$data = json_decode(file_get_contents("php://input"));

	$client = ORM::for_table('clients')
	->where('email', $data->email)
	->where('passe', sha1($data->passe) )
	->where('etab', $data->etab)
	->find_one();

	$infos = "erreur";
	$token = "";
	if ($client){
		$token = hash('sha512', mt_rand());

		$client->token = $token;
		$client->save();
		$infos = "ok";
	}

	$msg = array("msg"=> $infos,"token"=>$token);

	$app->response()->header("Content-Type", "application/json");
	echo json_encode($msg);

});