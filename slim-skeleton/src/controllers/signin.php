<?
  require_once(__DIR__ . "/../model.php");
  require_once(__DIR__ . "/../models/signin.php");

class controller_signin {

  static public function post ($request, $response, $args) {
    $name = $request->getParam('name');
    $email = $request->getParam('email');
    $password = $request->getParam('password');


    if (isset($name)
      && isset($email)
      && isset($password)
      && $name !== ''
      && filter_var(htmlspecialchars($email), FILTER_VALIDATE_EMAIL)
      && $password !== ''
      && preg_match("/^[a-zA-Z0-9]+$/", $name)) {
        $sign = Model_Signin::up(htmlspecialchars($name), htmlspecialchars($email), htmlspecialchars($password));
    }
    else {
      $sign = false;
    }
    return $sign;
  }


}