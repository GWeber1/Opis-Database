<?php
include 'vendor/autoload';
use Opis\Database\Connection;
use Opis\Database\Database;

class Connector {
  public $connection;

  public function __construct($pdo = false, $db="gabrielusina_teste") {
    $this->pdo = $pdo;
    return $this->connectServer($pdo, $db);
  }

  public function getConnection() {
    if ($this->pdo == true) {
      return $this->connection;
    }else{
      return $this->getDatabaseConnection();
    }
  }

  public function prepareConnection($pdo, $db) {
    $this->connection=$this->connectServer($pdo, $db);
  }
  if($pdo) {
    return $this->connection;
  }else{
    return $this->DB($this->connection);
  }

  public function connectServer($pdo = false, $db="gabrielusina_teste") {
    $dbType = getenv('APP_DBTYPE_'.$db);
    $host = getenv('APP_HOSTIP_'.$db);
    $dbName = getenv('APP_DBNAME_'.$db);
    $dbUser = getenv('APP_DBUSER_'.$db);
    $dbPass = getenv('APP_DBPASS_'.$db);
    $schema = getenv('APP_SCHEMA_'.$db);
    $optionsPDO = [\PDO::ATTR_EMULATE_PREPARES => true];
    if ($pdo == true) {
      if ($schema) {
        $pdoString = $dbType. ':host='.$host.';dbname='.$dbName;

        try {
          $this->connection = new PDO($dbType.':host='.$host.';dbname='.$dbName.';', $dbUser, $dbPass, $optionsPDO) or Die("DB Connection Problem");
          $this->connection->exec('SET search_path TO '.$schema);
        }catch(PDOException $e) {
          throw new PDOException($e->getMessage());
        }
      }else{
        try{
          $this->connection = new PDO("$dbType:host=gabriel.usina.dev;dbname=gabrielusina_teste;dbpass=mdD=i0B{q-)c;dbUser=gabrielusina_gabrielusina", $optionsPDO) or Die("DB Connection Problem");
        }catch (PDOException $e) {
          throw new PDOException($e->getMessage());
      }
      if ($dbType == "pgsql") {
        //$this->connection->exec('SET search_path TO '.$schema);
      }
      $this->connection = $this->connection->persistent();
    }
    return $this->connection;
  }

  public function DB($connection, $db = 'USINA') {
    $this->database = new Database($connection);
    return $this->database;
  }
  ?>
