<?php
class Database{

  public $db;
  public function __construct(){
    /*** mysql hostname ***/
    $hostname = 'localhost';

    /*** mysql username ***/
    $username = 'root';

    /*** mysql password ***/
    $password = '';

    // nama database //
    $database = 'tryout';

    try {
      $this->db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }

  }

  /*** Query Function ***/
  public function query($sql)
  {
    return $this->db->query($sql);
  }
}
