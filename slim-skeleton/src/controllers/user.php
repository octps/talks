<?

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/user.php');

class controller_user
{
  public static function get() {
	  $contents = Model_User::get();
	  return $contents;
	}
}

