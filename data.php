<?php
class Data{
  
  // database connection and table name
  private $conn;
  private $table_name = "backend";

  // object properties
  public $Linux;
  public $Php;
  public $Codeigniter;
  public $Laravel;
  public $Nodejs;
  public $Golang;
  public $Git;
  public $Restful;
  public $Nosql;
  public $Mysql;

  // constructor with $db as database connection
  public function __construct($db){
      $this->conn = $db;
  }

  // create product
  function datain(){

      // query to insert record
    //   $query = "SELECT * FROM " . $this->table_name . " WHERE Account = :Account";

      // prepare query statement
    //   $stmt = $this->conn->prepare($query);

      // sanitize
    //   $this->Account=htmlspecialchars(strip_tags($this->Account));
  
      // bind new values
    //   $stmt->bindParam(':Account', $this->Account);
  
      // execute the query
    //   $stmt->execute();
    //   $num = $stmt->rowCount();
    //   if($num !== 0){
    //       return false;
    //   }

        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Linux"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Linux);
        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Php"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Php);
        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Codeigniter"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Codeigniter);
        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Laravel"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Laravel);
        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Nodejs"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Nodejs);
        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Golang"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Golang);
        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Git"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Git);
        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Restful"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Restful);
        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Nosql"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Nosql);
        $content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=Mysql"));
        preg_match('/－(.*?)個工作機會/', $content, $this->Mysql);
  
      // query to insert record
      $query = "INSERT INTO " . $this->table_name . " SET Linux=:Linux, Php=:Php, Codeigniter=:Codeigniter, Laravel=:Laravel, Nodejs=:Nodejs, Golang=:Golang, Git=:Git, Restful=:Restful, Nosql=:Nosql, Mysql=:Mysql";
  
      // prepare query
      $stmt = $this->conn->prepare($query);
  
      // sanitize
      $this->Linux=htmlspecialchars(strip_tags($this->Linux));
      $this->Php=htmlspecialchars(strip_tags($this->Php));
      $this->Codeigniter=htmlspecialchars(strip_tags($this->Codeigniter));
      $this->Laravel=htmlspecialchars(strip_tags($this->Laravel));
      $this->Nodejs=htmlspecialchars(strip_tags($this->Nodejs));
      $this->Golang=htmlspecialchars(strip_tags($this->Golang));
      $this->Git=htmlspecialchars(strip_tags($this->Git));
      $this->Restful=htmlspecialchars(strip_tags($this->Restful));
      $this->Nosql=htmlspecialchars(strip_tags($this->Nosql));
      $this->Mysql=htmlspecialchars(strip_tags($this->Mysql));
  
      // bind values
      $stmt->bindParam(":Linux", $this->Linux);
      $stmt->bindParam(":Php", $this->Php);
      $stmt->bindParam(":Codeigniter", $this->Codeigniter);
      $stmt->bindParam(":Laravel", $this->Laravel);
      $stmt->bindParam(":Nodejs", $this->Nodejs);
      $stmt->bindParam(":Golang", $this->Golang);
      $stmt->bindParam(":Git", $this->Git);
      $stmt->bindParam(":Restful", $this->Restful);
      $stmt->bindParam(":Nosql", $this->Nosql);
      $stmt->bindParam(":Mysql", $this->Mysql);
  
      // execute query
      if($stmt->execute()){
          return true;
      }
  
      return false;
      
  }

  // function isDup(){
  // }

  // login
  function refresh(){
  
      // select all query
      $query = "SELECT * FROM " . $this->table_name;
  
      // prepare query statement
      $stmt = $this->conn->prepare($query);
  
      // execute the query
      $stmt->execute();
      return $stmt;
  }
}
?>
