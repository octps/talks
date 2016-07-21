<?

require_once(__DIR__ . '/../db.php');
require_once(__DIR__ . '/../model.php');

class model_search
{
  public static function get($value, $offset, $limit) {
      $dbh = \Db::getInstance();
      $contents = Null; 
      $value = '%' . $value . '%';
      // todo try catch
      // 例外を投げる
      $sql = "SELECT
              contents.id,
              contents.content,
              contents.user_id,
              u1.name as user_name,
              contents.send_id,
              u2.name as send_name,
              contents.created_at,
              contents.updated_at
              from contents
              join users as u1 on
              contents.user_id = u1.id
              left outer join users as u2 on
              contents.send_id = u2.id
              WHERE 
              contents.delete_flag = 0
              AND contents.content like :value
              ORDER BY updated_at DESC
              Limit $limit offset $offset;";
      $dbh->beginTransaction();
      $sth = $dbh->prepare($sql);
      $sth->bindValue(':value', $value);
      $sth->execute();
      $dbh->commit();
      while ($contnet =  $sth->fetchObject()) {
      	$contents[] = $contnet;
      }

	  return $contents;
	}
}

