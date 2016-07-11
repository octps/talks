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
}

