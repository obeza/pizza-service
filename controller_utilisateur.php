<?
/*


*/

// liste
$app->get('/utilisateurs/:id', function ($id) {

	$liste = ORM::for_table('utilisateurs')->find_array();

	//$data['data'] = $liste;
	//$app->response()->header("Content-Type", "application/json");
	echo json_encode($liste);

});

// une fiche
$app->get('/utilisateur/:id', function ($id) use ($app) {

	$liste = ORM::for_table('utilisateurs')->where('id', $id)->find_array();

	$app->response()->header("Content-Type", "application/json");
	
	echo json_encode($liste[0]);

});

// publier
$app->post('/utilisateur', function () {


	$data = json_decode(file_get_contents("php://input"));

	$fiche = ORM::for_table('utilisateurs')->create();

	$fiche->etablissement = $data->etablissement;
	$fiche->nom = $data->nom;

	if(!empty($data->email)){
		$fiche->email = $data->email;
	}
	
	$fiche->passe = base64_encode($data->passe);

	$fiche->save();

	$msg = array("msg"=>"ok");

	echo json_encode($msg);

});

// modifier
$app->put('/utilisateur/:id', function ($id) use ($app) {

    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);

	$fiche = ORM::for_table('utilisateurs')->where('id', $id)->find_one();

	$fiche->nom = $input->nom;
	$fiche->email = $input->email;

	$fiche->passe = $input->passe;
	
	$fiche->statut = $input->statut;
	
	$fiche->save();

	$msg = array("msg"=>"ok");

	$app->response()->header("Content-Type", "application/json");
	echo json_encode($msg);

});


