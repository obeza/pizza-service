<?


$app->post('/app/utilisateur/creer', function () use ($app) {

	// on récupére le JSON via une fonction de Slim
	$json = $app->request->getBody();
	// on met le $json dans un table PHP
    $data = json_decode($json, true);

	//print_r ($data);

    // GUMP est une class qui va checker les validations
	$is_valid = GUMP::is_valid($data, array(
    	'etab' => 'required|numeric',
    	'nom' => 'required|alpha_numeric',
    	'prenom' => 'required|alpha_numeric',
    	'adresse' => 'required|alpha_numeric',
    	'ville' => 'required|numeric',
    	'tel' => 'required|numeric|max_len,10|min_len,10',
    	'passe' => 'required|alpha_numeric',
    	'email' => 'required|valid_email'

	));

	if($is_valid === true) {
	    // continue

	    $fiche = ORM::for_table('clients')->create();

	    $fiche->etab = $data->etad;
	    $fiche->nom = $data->nom;
	    $fiche->prenom = $data->prenom;
	    $fiche->adresse = $data->adresse;
	    $fiche->ville = $data->ville;
	    $fiche->tel = $data->tel;
	    // on encode le mot de passe avec sha1
	    $fiche->passe = sha1($data->passe);
	    $fiche->email = $data->email;

	    $fiche->save();

	    echo "ok";
	} else {
	    // print_r($is_valid);
	    $app->flash('error', $is_valid);
	}


});