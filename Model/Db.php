<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $configDB = json_decode(file_get_contents('config.json'), false);
        self::$instance = new PDO("mysql:host=$configDB->host;dbname=$configDB->database", $configDB->user, $configDB->password);
      }
      return self::$instance;
    }
  }
?>