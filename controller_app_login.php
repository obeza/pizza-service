<?

$app->post('/app/utilisateur/login', function () use ($app) {

	//$data = json_decode(file_get_contents("php://input"));
	$data = getJson();
	// $json = $app->request->getBody();
 //    $data = json_decode($json, true);

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

	$data = array( 
		"msg"=>$msg,
		"token"=>$token,
		"infos"=>$infos[0]
	);

	header('Content-type: application/json');
	echo json_encode($data);
	exit;


	}

	// render(array(
 //        'msg' => $msg,
 //        'token' => $token,
 //        'infos' => $infos[0]
 //    ));
	$data = array( 
		"msg"=>"erreur"
	);

	header('Content-type: application/json');
	echo json_encode($data);
});



