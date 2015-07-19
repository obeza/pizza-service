<?
/*


*/

// liste
$app->get('/categories/:id', function ($id) {

	$liste = ORM::for_table('categories')->where('etablissement', $id)->find_array();

	//$data['data'] = $liste;
	//$app->response()->header("Content-Type", "application/json");
	echo json_encode($liste);

});


// une fiche
$app->get('/categorie/:id', function ($id) use ($app) {

	$liste = ORM::for_table('categories')->where('id', $id)->find_array();

	$app->response()->header("Content-Type", "application/json");
	
	echo json_encode($liste[0]);

});

// publier
$app->post('/categorie', function () {


	$data = json_decode(file_get_contents("php://input"));

	$fiche = ORM::for_table('categories')->create();

	$fiche->etablissement = $data->etablissement;
	$fiche->nom = $data->nom;

	$fiche->save();

	$msg = array("msg"=>"ok");

	echo json_encode($msg);

});

// modifier
$app->post('/categorie/:id', function ($id) use ($app) {

    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);

	$fiche = ORM::for_table('categories')->where('id', $id)->find_one();

	$fiche->nom = $input->nom;
	
	$fiche->statut = $input->statut;
	
	$fiche->save();

	$msg = array("msg"=>"ok");

	$app->response()->header("Content-Type", "application/json");
	echo json_encode($msg);

});


