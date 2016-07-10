<?

require_once(__DIR__ . '/../db.php');
require_once(__DIR__ . '/../model.php');

class Model_User
{
  public static function get($args) {
      $dbh = \Db::getInstance();
      // todo try catch
      // 例外を投げる
      $sql = "SELECT id,name FROM users where name = :name;";
      $dbh->beginTransaction();
      $sth = $dbh->prepare($sql);
      $sth->bindValue(':name', $args['name']);
      $sth->execute();
      $dbh->commit();
      $user = $sth->fetchObject();

      return $user;
  }
}

