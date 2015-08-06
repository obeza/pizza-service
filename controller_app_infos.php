<!-- 
<?

// publier
$app->get('/app/utilisateur/infos', function () use ($app) {

  $token =  $app->request->headers->get('token');

	if(!$token){
		header('WWW-Authenticate: Basic realm="Test Authentication System"'); 
    	header('HTTP/1.0 401 Unauthorized'); 
  		exit;
	$app->halt(401);

  }


	$liste = ORM::for_table('clients')->where('token', $token)->find_array();
	
	if ( $liste ){
		$app->response()->header("Content-Type", "application/json");
		echo json_encode($liste[0]);
	} else {

		$app->halt(401);

	} 

});




// <?

// // publier
// $app->get('/app/infos', 'checkToken', function () use ($app) {
	
// 	$token = apache_request_headers()["token"];




// }); -->