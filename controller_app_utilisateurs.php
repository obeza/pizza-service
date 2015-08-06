<?
$app->post('/app/utilisateur/creer', function () use ($app) {

	// on récupére le JSON via une fonction de Slim
	//$json = $app->request->getBody();

	// on met le $json dans un table PHP
    //$data = json_decode($json, true);
    header('Access-Control-Allow-Origin: *');  
	$data = json_decode(file_get_contents("php://input"), true);
	//echo ($data->nom);


    // GUMP est une class qui va checker les validations
	$validated = GUMP::is_valid($data, array(
    	'prenom' => 'required|alpha_numeric',
    	'nom' => 'required|alpha_numeric',
    	'tel' => 'required|numeric|max_len,10',
    	'ville' => 'required|numeric',
    	'adresse' => 'required',
    	'email' => 'required|valid_email',
    	'passe' => 'required|alpha_numeric',
    	'etab' => 'required|numeric',

	));

	if($validated === true) {
		$data = json_decode(file_get_contents("php://input"));

	    // check si existe email :
	    $checkEmail = ORM::for_table('clients')->where('email', $data->email)->count();

	    if ($checkEmail>0){
	    	$msg = array("msg"=>"email");
	    	
	    } else {
		

		    $fiche = ORM::for_table('clients')->create();

		    $fiche->etab = $data->etab;
		    $fiche->nom = $data->nom;
		    $fiche->prenom = $data->prenom;
		    $fiche->adresse = $data->adresse;
		    $fiche->ville = $data->ville;
		    $fiche->tel = $data->tel;
		    // on encode le mot de passe avec sha1
		    $fiche->passe = sha1($data->passe);
		    $fiche->email = $data->email;

		    $fiche->save();

		    $msg = array("msg"=>"ok");

		}

	} else {
	    // print_r($is_valid);
	    $msg = array("msg"=>"erreur");
		
	}
	echo json_encode($msg);
});