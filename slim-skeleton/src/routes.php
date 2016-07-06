<?php
// Routes
require_once(__DIR__ . '/./db.php');
require_once(__DIR__ . '/./controllers/user.php');
require_once(__DIR__ . '/./controllers/login.php');

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});



$app->get('/{name}', function ($request, $response, $args) {
	
	$contents = Controller_User::get();

    // Render index view
    $sender = array("args" => $args, "contents"=>$contents);
    return $this->renderer->render($response, 'user.phtml', $sender);
});

$app->post('/login', function($request, $response, $args) {
	return controller_log::in($response, (object)$_POST);
});

