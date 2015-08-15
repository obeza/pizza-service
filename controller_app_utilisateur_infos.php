<?

$app->get('/app/utilisateur/infos/:id', function ($id) use ($app) {

	$token = $app->request->headers->get('auth_token');

	$liste = ORM::for_table('clients')
		->where('id', $id)
		->where('token', $token)
		->find_array();
	
	if ( $liste ){

		// $infos = json_encode($liste[0]);
		// $infos = json_decode($infos);
		$infos = $liste[0];
		// unset($infos->passe);
		// unset($infos->token);
		// unset($infos->etab);
		// unset($infos->dt_creation);
		// unset($infos->system);
		// unset($infos->gcm);

		render( $infos );

	} else {

		$app->halt(401);

	}

});





