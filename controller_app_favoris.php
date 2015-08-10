<?

$app->get('/app/favoris/:id', function ($id) use ($app) {

	$favoris = ORM::for_table('favoris')
	->where('articleId', $id)
	->find_one();

	$app->response()->header("Content-Type", "application/json");

	$jaime = 'n';

	if ($favoris){
		$jaime = $favoris->jaime;
	}

	$msg = array("jaime"=> $jaime);
	echo json_encode($msg);

});

$app->get('/app/favoris/:id/etab/:etab/jaime/:jaime', function ($id, $etab, $jaime) use ($app) {

	$favoris = ORM::for_table('favoris')
	->where('articleId', $id)
	->find_one();

	if ($favoris){		 
		$favoris->jaime = $jaime;
		$favoris->save();		
		$msg = array("msg"=> "maj");
	} else {
		$favorisAjouter = ORM::for_table('favoris')->create();
		$favorisAjouter->etab = $etab;
		$favorisAjouter->articleId = $id;
		$favorisAjouter->jaime = $jaime;
		$favorisAjouter->save();
		$msg = array("msg"=> "create");
	}
	$app->response()->header("Content-Type", "application/json");
	echo json_encode($msg);
});



