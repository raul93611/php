<?php
class Database {
  public function getConn() {
    $db_host = 'database:3306';
    $db_name = 'cms';
    $db_user = 'root';
    $db_pass = 'tiger';

    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
    try {
      $db = new PDO($dsn, $db_user, $db_pass);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
    } catch (\Throwable $e) {
      echo $e->getMessage();
      exit;
    }
  }
}
