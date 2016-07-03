<?php
// Routes
require_once(__DIR__ . '/./db.php');
require_once(__DIR__ . '/./controllers/test.php');

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->get('/hello/[{name}]', function ($request, $response, $args) {
	$dbh = \Db::getInstance();
	$test = test::get($dbh);

    // // Sample log message
    // $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    $sender = array("args" => $args, "test"=>$test);
    return $this->renderer->render($response, 'index.phtml', $sender);
});

