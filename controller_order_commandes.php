<?

$app->get('/app/order/etab/:etab/commandes/statut/:statut', function ($etab, $statut) use ($app) {

	$commandes = ORM::for_table('commandes')
		->where('etab', $etab)
		->where('statut', $statut)
		->find_array();

	$app->response()->header("Content-Type", "application/json");

	echo json_encode($commandes);


});