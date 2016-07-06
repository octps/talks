<?
  // require_once(__DIR__ . '/./db.php');
  require_once(__DIR__ . "/../model.php");

  class model_log extends model {
    public static function in($email, $password) {
      $dbh = \Db::getInstance();
      $sql = "SELECT * FROM users where email = :email And password = :password And auth > 0";
      $dbh->beginTransaction();
      $sth = $dbh->prepare($sql);
      $sth->bindValue(':email', $email);
      $sth->bindValue(':password', sha1($password));
      $sth->execute();
      $dbh->commit();
      $user = $sth->fetchObject();
      return $user;
    }
        
  }