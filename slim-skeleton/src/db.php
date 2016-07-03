<?php

class Db
{
  private static $pdo = null;

  public static function getInstance() {
	$settings = require __DIR__ . '/../src/settings.php';
	$app = new \Slim\App($settings);

	$container = $app->getContainer();
	$db = (object)$container->settings['config']['db'];

    if (is_null(self::$pdo)) {
      self::$pdo = new PDO(sprintf(
        '%s:host=%s; port=%d; dbname=%s; charset=utf8;'
        , 'mysql'
        , $db->host
        , 3306
        , $db->dbname
      ), $db->user, $db->pass);

      self::$pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    return self::$pdo;
  }
}

