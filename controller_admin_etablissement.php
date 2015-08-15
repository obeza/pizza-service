<?
/*


*/

// liste
$app->get('/etablissement', function () use ($app) {

	$liste = ORM::for_table('etablissements')->find_array();

	//$data['data'] = $liste;
	//$app->response()->header("Content-Type", "application/json");
	echo json_encode($liste);

	// $app->render(200,
 //        $liste
 //    );

});

// une fiche
$app->get('/etablissement/:id', function ($id) use ($app) {

	$liste = ORM::for_table('etablissements')->where('id', $id)->find_array();

	$app->response()->header("Content-Type", "application/json");
	
	echo json_encode($liste[0]);

});

// publier
$app->post('/etablissement', function () {


	$data = json_decode(file_get_contents("php://input"));

	$fiche = ORM::for_table('etablissements')->create();

	$fiche->nom = $data->nom;
	$fiche->infos = $data->infos;
	$fiche->paypal = $data->paypal;

	$fiche->save();

	$msg = array("msg"=>"ok");

	echo json_encode($msg);

});

// modifier
$app->put('/etablissement/:id', function ($id) use ($app) {

    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);

	$fiche = ORM::for_table('etablissements')->where('id', $id)->find_one();

	$fiche->nom = $input->nom;
	$fiche->infos = $input->infos;
	$fiche->paypal = $input->paypal;
	$fiche->statut = $input->statut;
	
	$fiche->save();

	$msg = array("msg"=>"ok");

	$app->response()->header("Content-Type", "application/json");
	echo json_encode($msg);

});


