<?

class test
{
  public static function get($dbh) {
	  $sql = "select * from contents";

	  $dbh->beginTransaction();
	  $sth = $dbh->prepare($sql);
	  $sth->execute();
	  $dbh->commit();
	  while($content = $sth->fetchObject()) {
	      $contents[] = $content;
	  }
	  
	  return $contents;
	}
}

