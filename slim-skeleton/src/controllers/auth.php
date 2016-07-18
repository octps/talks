<?
  require_once(__DIR__ . "/../model.php");
  require_once(__DIR__ . "/../models/auth.php");

class controller_auth {

  static public function post ($request, $response, $args) {
    $name = $request->getParam('name');
    $onetime_password = $request->getParam('onetime_password');

    if (isset($name)
      && isset($onetime_password)
      && $name !== ''
      && $onetime_password !== '') {
        $auth = model_auth::post(htmlspecialchars($name), htmlspecialchars($onetime_password));
    }
    else {
      $auth = false;
    }

    return $auth;
  }


}

