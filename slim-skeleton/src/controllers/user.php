<?

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/user.php');
require_once(__DIR__ . '/../models/contents.php');

class controller_user
{
	public static function get($args, $request) {
    $limit = 10;
    $offset = 0;
    if (@$request->getParam('offset') && is_numeric($request->getParam('offset'))) {
      $offset = $request->getParam('offset') * $limit;
    }

	  $user = model_user::get($args);
	  $contents = model_contents::get($user->id, $offset, $limit);
	  $userContetns = array('user'=>$user, 'contents'=>$contents, 'offset'=>$offset/$limit);
	  return $userContetns;
	}

  public static function getOne($args, $request) {
    $user = model_user::get($args);
    $contents = model_contents::getOne($args['id']);
    $userContetns = array('user'=>$user, 'contents'=>$contents);
    return $userContetns;
  }

  public static function post($res, $args) {
  	  $content = htmlspecialchars($_POST['content']);
  	  $to['name'] = htmlspecialchars($_POST['to']);
  	  $toValue = model_user::get($to);
  	  if ($toValue === false) {
        return $res->withStatus(200)->withHeader('Location', ('/' . $_SESSION['loginUser'] . '?error=user'));
	  }
  	  if ($content === '') {
        return $res->withStatus(200)->withHeader('Location', ('/' . $_SESSION['loginUser'] . '?error=content'));
	  }

      model_user::post($_SESSION['userId'], $content, $toValue->id);
      return $res->withStatus(200)->withHeader('Location', ('/' . $_SESSION['loginUser']));
	}

    public static function delete($res, $args) {
      model_user::delete($_SESSION['userId'], $args['id']);
      return $res->withStatus(200)->withHeader('Location', ('/' . $_SESSION['loginUser']));
	}

}

