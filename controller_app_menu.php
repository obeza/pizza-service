<?

$app->get('/etab/:id', function ($id) use ($app) {


	$categories = ORM::for_table('categories')
		->where('etablissement', $id)
		->where('statut', 'Y')
		->find_array();

	$articles = ORM::for_table('articles')
		->where('etablissement', $id)
		->where('statut', 'Y')
		->find_array();

	$data['categories'] = $categories;
	$data['articles'] = $articles;


	$app->render(200,array(
        	'data' => $data
    	));

	
});
$app->get('/etab/menu/:id', function ($id) use ($app) {


	$categories = ORM::for_table('categories')
		->where('etablissement', $id)
		->where('statut', 'Y')
		->find_array();

	$articles = ORM::for_table('articles')
		->where('etablissement', $id)
		->where('statut', 'Y')
		->find_array();

	//$data['categories'] = $categories;
	$data['articles'] = $articles;


	$app->response()->header("Content-Type", "application/json");

	header("Access-Control-Allow-Origin: *");
	echo json_encode($articles);

	
});

/*
	Sauvegarder la requete dans un fiichier JSON

*/

$app->get('/etabsave/:id', function ($id) use ($app) {

	$categories = ORM::for_table('categories')
		->where('etablissement', $id)
		->where('statut', 'Y')
		->find_array();

	$articles = ORM::for_table('articles')
		->where('etablissement', $id)
		->where('statut', 'Y')
		->find_array();

	$data['categories'] = $categories;
	$data['articles'] = $articles;


	file_put_contents('filename.json', json_encode($data));

	
});