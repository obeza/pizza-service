<?

$app->get('/app/etab/:etab/favoris/:id', 'auth', function ($etab, $id) use ($app) {

	$favoris = ORM::for_table('favoris')
	->where('etab', $etab)
	->where('articleId', $id)
	->find_array();

	$app->response()->header("Content-Type", "application/json");

	if ($favoris){
		 $jaime = false;
		 if ($favoris->jaime=="Y"){
		 	$jaime = true;
		 }

		$msg = array("jaime"=> $jaime);
		
		
	} else {
		$favoris->etab = $etab;
		$favoris->articleId = $id;
		$favoris->save();

		$msg = array("jaime"=> "true");
		
	}

	echo json_encode($msg);

});