<?
//
//	liste par rapport aux statuts
//
$app->get('/app/order/etab/:etab/commandes/statut/:statut', function ($etab, $statut) use ($app) {

	// structure attendue
	// {
	// 	"etab" : 2,
	// 	"statut" : 0,
	//  "userId" : 23
	// }

	if ($statut ==='toutes'){
		$commandes = ORM::for_table('commandes')
			->select_many(
				'commandes.id', 
				'clients.nom', 
				'clients.prenom',
				'clients.adresse',
				'clients.ville',
				'clients.point',
				'commandes.details',
				'commandes.dtsaisie',
				'commandes.total',
				'commandes.livraison',
				'commandes.statut'
			)
			->join('clients', array('clients.id', '=', 'commandes.clientId'))
			->where('commandes.etab', $etab)
			->where('clients.etab', $etab)
			->where_lt('commandes.statut', '5')
			->find_array();





	} else {
		$commandes = ORM::for_table('clients')
			->select_many(
				'commandes.id', 
				'clients.nom', 
				'clients.prenom',
				'clients.adresse',
				'clients.ville',
				'clients.point',
				'commandes.details',
				'commandes.dtsaisie',
				'commandes.total',
				'commandes.livraison',
				'commandes.statut'
			)
			->join('commandes', array('clients.id', '=', 'commandes.clientId'))
			->where('commandes.etab', $etab)
			->where('clients.etab', $etab)
			->where('commandes.statut', $statut)
			->find_array();

	}

	$nbCommandesToutes = ORM::for_table('commandes')
		->where('commandes.etab', $etab)
		->where_lt('commandes.statut', 5)
		->count();

	$nbCommandes0 = ORM::for_table('commandes')
		->where('commandes.etab', $etab)
		->where('commandes.statut', 1)
		->count();

	$nbCommandes1 = ORM::for_table('commandes')
		->where('commandes.etab', $etab)
		->where('commandes.statut', 2)
		->count();

	$nbCommandes2 = ORM::for_table('commandes')
		->where('commandes.etab', $etab)
		->where('commandes.statut', 3)
		->count();

	$nbCommandes3 = ORM::for_table('commandes')
		->where('commandes.etab', $etab)
		->where('commandes.statut', 4)
		->count();

		$app->render(200,array(
        	'data' => $commandes,
        	'pastilles' => array( 
        		$nbCommandesToutes,
        		$nbCommandes0,
        		$nbCommandes1,
        		$nbCommandes2,
        		$nbCommandes3
        	)
    	));

});

// $app->get('/app/order/etab/:etab/commandes/liste', function ($etab) use ($app) {

// 	$commandes = ORM::for_table('clients')
// 		->select_many(
// 			'commandes.id', 
// 			'clients.nom', 
// 			'clients.prenom',
// 			'clients.adresse',
// 			'clients.ville',
// 			'clients.point',
// 			'commandes.details',
// 			'commandes.dtsaisie',
// 			'commandes.total',
// 			'commandes.livraison',
// 			'commandes.statut'
// 		)
// 		->join('commandes', array('clients.id', '=', 'commandes.clientId'))
// 		->where('commandes.etab', $etab)
// 		->where('clients.etab', $etab)
// 		->find_array();

// 		$app->render(200,array(
//         	'data' => $commandes
//     	));

// });

$app->post('/app/order/etab/:etab/commande', function () use ($app) {

	// post => {
	// 	commandeId
	// 	statutMaj
	// }

	$data = json_decode($app->request->getBody());

	$commandes = ORM::for_table('commandes')
		->where('id', $data->commandeId)
		->find_one();

	$commandes->statut = $data->statutMaj;
	$commandes->save();

		$app->render(200,array(
        	'msg' => 'ok'
    	));

});




