<?php
class Database
{
  // DB Params
  private $host = 'localhost';
  private $db_name = 'eventdb';
  private $username = 'root';
  private $password = '';
  private $conn;

  // DB Connect
  public function connect()
  {
    $this->conn = null;

    // driver option
    $driver_options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    );

    try {
      $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password, $driver_options);


    } catch (PDOException $e) {
      echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;
  }
}
