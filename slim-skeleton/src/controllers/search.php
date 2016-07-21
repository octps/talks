<?

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/search.php');

class controller_search
{
	public static function post($request, $response, $args) {
    $limit = 10;
    $offset = 0;
    if (@$request->getParam('offset') && is_numeric($request->getParam('offset'))) {
      $offset = $request->getParam('offset') * $limit;
    }
    $value = $request->getParam('q');
    $contents = model_search::get($value, $offset, $limit);
    $userContetns = array('contents'=>$contents, 'offset'=>$offset/$limit);
    return $userContetns;
	}
}

