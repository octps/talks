<?

require_once(__DIR__ . '/../db.php');
require_once(__DIR__ . '/../model.php');

class model_user
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

  public static function post($id, $content, $toId) {
      $dbh = \Db::getInstance();
      // todo try catch
      // 例外を投げる
      $sql = "INSERT into contents (user_id, content, send_id, created_at) values (:user_id, :content, :send_id, null);";
      $dbh->beginTransaction();
      $sth = $dbh->prepare($sql);
      $sth->bindValue(':user_id', $id);
      $sth->bindValue(':content', $content);
      $sth->bindValue(':send_id', $toId);
      $sth->execute();
      $dbh->commit();

      return true;
  }

  public static function delete($usrId, $id) {
      $dbh = \Db::getInstance();
      if ($usrId === null
        || $usrId !== $_SESSION['userId']) {
        return false;
      }
      // todo try catch
      // 例外を投げる
      $sql = "UPDATE contents set delete_flag = 1 where id = :id";
      $dbh->beginTransaction();
      $sth = $dbh->prepare($sql);
      $sth->bindValue(':id', $id);
      $sth->execute();
      $dbh->commit();

      return true;
  }

}

