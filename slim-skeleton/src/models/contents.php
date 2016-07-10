<?

require_once(__DIR__ . '/../db.php');
require_once(__DIR__ . '/../model.php');

class Model_Contents
{
  public static function get() {
      $dbh = \Db::getInstance();
      // todo try catch
      // 例外を投げる
      $sql = "SELECT * FROM contents";
      $dbh->beginTransaction();
      $sth = $dbh->prepare($sql);
      $sth->execute();
      $dbh->commit();
      while ($contnet =  $sth->fetchObject()) {
      	$contents[] = $contnet;
      }

	  return $contents;
	}
}

