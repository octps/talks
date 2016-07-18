<?php
// Routes
require_once(__DIR__ . '/./db.php');
// require_once(__DIR__ . '/./controllers/contents.php');
require_once(__DIR__ . '/./controllers/user.php');
require_once(__DIR__ . '/./controllers/login.php');
require_once(__DIR__ . '/./controllers/signin.php');
require_once(__DIR__ . '/./controllers/auth.php');

$app->get('/', function ($request, $response, $args) {
    $this->logger->info("Slim-Skeleton '/' route");
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/logout', function($request, $response, $args) {
	return controller_log::out($response);
});

$app->get('/signin', function($request, $response, $args) {
    return $this->renderer->render($response, 'signin.phtml', $args);
});

$app->get('/auth', function($request, $response, $args) {
	return $this->renderer->render($response, 'auth.phtml', $args);
});

$app->get('/{name}', function ($request, $response, $args) {
	$userContents = Controller_User::get($args, $request);
    $sender = array("name" => $args['name'],
                    "contents"=>$userContents['contents'],
                    'user'=>$userContents['user'],
                    'offset'=>$userContents['offset'],
                    );
    return $this->renderer->render($response, 'user.phtml', $sender);
});


$app->post('/login', function($request, $response, $args) {
	return controller_log::in($response, (object)$_POST);
});

$app->post('/signin', function($request, $response, $args) {
   $signin = controller_signin::post($request, $response, $args);
   if ($signin === false) {
      return $this->renderer->render($response, 'signin.phtml', $args);
   }
   return $response->withStatus(200)->withHeader('Location', '/auth');
});

$app->post('/auth', function($request, $response, $args) {
   $auth = controller_auth::post($request, $response, $args);
   if ($auth === false) {
      return $this->renderer->render($response, 'auth.phtml', $args);
   }
   return $response->withStatus(200)->withHeader('Location', "/");
});

$app->post('/{name}', function ($request, $response, $args) {
	return Controller_User::post($response, $args);
});

$app->delete('/{name}/{id}', function ($request, $response, $args) {
	return Controller_User::delete($response, $args);
});
