<?
$app->get('/testedate', function () use ($app) {
   

    date_default_timezone_set('America/La_Paz');
 	$date= date('Y-m-d H:i:s') ;


	$app->render(200,array(
        'msg' => $date,
    ));

});
