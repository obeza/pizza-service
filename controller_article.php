<?
/*


*/

// liste
$app->get('/articles/:id', function ($id) {

	$liste = ORM::for_table('articles')->where('categorie', $id)->find_array();

	//$data['data'] = $liste;
	//$app->response()->header("Content-Type", "application/json");
	echo json_encode($liste);

});

// une fiche
$app->get('/article/:id', function ($id) use ($app) {

	$liste = ORM::for_table('articles')->where('id', $id)->find_array();

	$app->response()->header("Content-Type", "application/json");
	
	echo json_encode($liste[0]);

});

// publier
$app->post('/article', function () {

	$data = json_decode(file_get_contents("php://input"));

	$fiche = ORM::for_table('articles')->create();

	$fiche->etablissement = $data->etablissement;
	$fiche->categorie = $data->categorie;
	$fiche->nom = $data->nom;

	if (!empty($data->description)){
		$fiche->description = $data->description;
	}
	if (empty($data->prix)){
		$fiche->prix = 0;
	} else {

		$fiche->prix = $data->prix;
	}

	if (empty($data->prix1)){
		$fiche->prix1 = 0;
	} else {

		$fiche->prix1 = $data->prix1;
	}

	if (empty($data->prix2)){
		$fiche->prix2 = 0;
	} else {

		$fiche->prix2 = $data->prix2;
	}

	if (empty($data->prix3)){
		$fiche->prix3 = 0;
	} else {

		$fiche->prix3 = $data->prix3;
	}


	$fiche->save();

	$msg = array("msg"=>"ok");

	echo json_encode($msg);

});


// modifier
$app->put('/article/:id', function ($id) use ($app) {

    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);

	$fiche = ORM::for_table('articles')->where('id', $id)->find_one();

	$fiche->nom = $input->nom;
	if (!empty($input->description)){
		$fiche->description = $input->description;
	}
	
	$fiche->prix = $input->prix;
	
	$fiche->prix1 = $input->prix1;
	$fiche->prix2 = $input->prix2;
	$fiche->prix3 = $input->prix3;	
	
	$fiche->statut = $input->statut;
	
	$fiche->save();

	$msg = array("msg"=>$input);

	$app->response()->header("Content-Type", "application/json");
	echo json_encode($msg);

});


