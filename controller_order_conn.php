<?

$app->post('/app/order/conn', function () use ($app) {

	$data = json_decode($app->request->getBody());

	$client = ORM::for_table('utilisateurs')
		->where('email', $data->email)
		->where('passe', sha1($data->passe) )
		->where('etab', $data->etab)
		->find_one();

	$msg = "erreur";

	if ($client){

		$token = hash('sha1', mt_rand());

		$client->token = $token;
		$client->save();

		$msg = "ok";

	}

	echo json_encode(array(
		'msg' => $msg,
		'token' => $token
	));

});


