<?
  require_once(dirname(__FILE__) . "/../models/login.php");
  require_once(__DIR__ . "/../model.php");

class controller_log {

  static public function in ($res, $post) {
    if (isset($post->email)
      && isset($post->password)
      && $post->password !== ''
      && filter_var($post->email, FILTER_VALIDATE_EMAIL)) {
        $user = model_log::in($post->email, $post->password);
        if ($user !== false) {
          $_SESSION["loginUser"] = $user->name;
          $_SESSION["userId"] = $user->id;
            return $res->withStatus(302)->withHeader('Location', ('/' . $user->name));
        }
        // print_r("you");
        return $res->withStatus(302)->withHeader('Location', '/');
    }
  }

}