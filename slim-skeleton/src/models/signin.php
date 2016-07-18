<?
  require_once(__DIR__ . "/../model.php");

  class model_signin {
    public static function up($name, $email, $password) {
      $dbh = \Db::getInstance();
      
      // メールアドレスの重複確認
      $sql = "SELECT * FROM users where email = :email";
      $dbh->beginTransaction();
      $sth = $dbh->prepare($sql);
      $sth->bindValue(':email', $email);
      $sth->execute();
      $dbh->commit();
      $user = $sth->fetchObject();
      if ($user !== false) {
        return false;
      }

      // ユーザー名の重複確認
      $sql = "SELECT * FROM users where name = :name";
      $dbh->beginTransaction();
      $sth = $dbh->prepare($sql);
      $sth->bindValue(':name', $name);
      $sth->execute();
      $dbh->commit();
      $user = $sth->fetchObject();
      if ($user !== false) {
        return false;
      }

      // onetime passwordの生成
      $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
      $onetime_password = null;
      for ($i = 0; $i < 8; $i++) {
        $onetime_password .= $str[rand(0, count($str) - 1)];
      }

      $sql = "INSERT INTO users (name, email, password, auth, onetime_password, created_at) values(:name, :email, :password, 0, :onetime_password, null)";
      $dbh->beginTransaction();
      $sth = $dbh->prepare($sql);
      $sth->bindValue(':name', $name);
      $sth->bindValue(':email', $email);
      $sth->bindValue(':password', sha1($password));
      $sth->bindValue(':onetime_password', $onetime_password);
      $sth->execute();
      $dbh->commit();

      /*  
      ## mamp mail
      * http://origin8.info/blog/?p=211
      */


      $to = $email;
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= "From:toshinweb@gmail.com";
      $subject = 'Sign up step';
      $bodyTextData = 'go to <a href="http://localhost/auth">sign up</a><br />'. "\r\n" .
"onetime password is " . $onetime_password;
      
      mb_language('Japanese');
      mb_internal_encoding("UTF-8");
      mb_send_mail($to, $subject, $bodyTextData, $headers);

      return true;
    }
       
  }