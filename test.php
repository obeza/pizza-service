<?
$app->get('/testo/:name', function ($name) use ($app) {
    

    $token = $app->request->headers->get('auth_token');
    //$token = apache_request_headers()["token"];

    // $app->view()->setResponse(array('response' => $token ));
    // $app->render('json');

	$app->render(200,array(
        'msg' => $token,
    ));

});
