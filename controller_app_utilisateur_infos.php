<?

$app->get('/app/utilisateur/infos/:token', function ($token) use ($app) {

	//header("Access-Control-Allow-Origin: *");

	//$token =  $app->request->headers->get('auth_token');


	$liste = ORM::for_table('clients')->where('token', $token)->find_array();
	
	if ( $liste ){
		//echo "<br> passe ";
		$app->response()->header("Content-Type", "application/json");

		$infos= json_encode($liste[0]);
		$infos = json_decode($infos);
		unset($infos->passe);
		unset($infos->token);
		unset($infos->etab);
		unset($infos->dt_creation);
		unset($infos->system);
		unset($infos->gcm);
		echo json_encode($infos);

	} else {

		$app->halt(401);

	} 


});

