
<?

// publier
$app->get('/app/infos/:id', function ($id) {
	echo graindesel();

});

// publier
$app->post('/app/infos/:id', function ($id) {

	$data = json_decode(file_get_contents("php://input"));

	$fiche = ORM::for_table('clients')->create();

	$fiche->etablissement = $id;
	$fiche->nom = $data->nom;
	$fiche->prenom = $data->prenom;
	$fiche->adresse = $data->adresse;
	$fiche->ville = $data->ville;
	$fiche->tel = $data->tel;
	$fiche->passe = sha1($data->passe.graindesel());
	$fiche->email = $data->email;

	$fiche->save();

	$msg = array("msg"=>"ok");

	echo json_encode($msg);

});


