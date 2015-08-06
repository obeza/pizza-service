<?

$app->post('/paypal/webhooks', function () use ($app) {

	file_put_contents('export.txt', var_export($_POST, true));

});