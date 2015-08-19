<?
$app->post('/testpost', function () use ($app) {
   

  //   date_default_timezone_set('America/La_Paz');
 	// $date= date('Y-m-d H:i:s') ;

	$data = getJson();

	print_r($data);
	// render(array(
 //        'msg' => $data,
 //    ));

});
