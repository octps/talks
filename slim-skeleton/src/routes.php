<?php
// Routes
require_once(__DIR__ . '/./db.php');
// require_once(__DIR__ . '/./controllers/contents.php');
require_once(__DIR__ . '/./controllers/user.php');
require_once(__DIR__ . '/./controllers/login.php');

$app->get('/', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route");

    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/logout', function($request, $response, $args) {
	return controller_log::out($response);
});

$app->get('/{name}', function ($request, $response, $args) {
	$userContents = Controller_User::get($args);
    $sender = array("name" => $args['name'], "contents"=>$userContents['contents'], 'user'=>$userContents['user']);
    return $this->renderer->render($response, 'user.phtml', $sender);
});

$app->post('/login', function($request, $response, $args) {
	return controller_log::in($response, (object)$_POST);
});

