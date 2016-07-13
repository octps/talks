<?

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/user.php');
require_once(__DIR__ . '/../models/contents.php');

class Controller_User
{
  public static function get($args) {
	  $user = Model_User::get($args);
	  $contents = Model_Contents::get($user->id);
	  $userContetns = array('user'=>$user, 'contents'=>$contents);
	  return $userContetns;
	}

  public static function post($res, $args) {
  	  $content = htmlspecialchars($_POST['content']);
  	  $to['name'] = htmlspecialchars($_POST['to']);
  	  $toValue = Model_User::get($to);
  	  if ($toValue === false) {
        return $res->withStatus(200)->withHeader('Location', ('/' . $_SESSION['loginUser'] . '?error=user'));
	  }
  	  if ($content === '') {
        return $res->withStatus(200)->withHeader('Location', ('/' . $_SESSION['loginUser'] . '?error=content'));
	  }

      Model_User::post($_SESSION['userId'], $content, $toValue->id);
      return $res->withStatus(200)->withHeader('Location', ('/' . $_SESSION['loginUser']));
	}

  public static function delete($res, $args) {
      Model_User::delete($_SESSION['userId'], $args['id']);
      return $res->withStatus(200)->withHeader('Location', ('/' . $_SESSION['loginUser']));
	}

}

