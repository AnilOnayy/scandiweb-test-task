<?php 

namespace Core;


use PDO,PDOException;


class Database
{
    // Const in config.php
    private $host = HOST;
    private $db = DB;
    private $username = DB_USER;
    private $password = DB_PASSWORD;
    private $charset = "UTF8";
    private $collation = "utf8mb4_general_ci";
    public  $pdo=null;
    private $stmt=null;




    private function connect(){
        // Database Connection
        $sql = "mysql:host={$this->host};dbname={$this->db};";
       
        try {
            $this->pdo = new \PDO($sql,$this->username,$this->password);
            $this->pdo->query("SET NAMES '{$this->charset}' COLLATE '{$this->collation}' ");
            $this->pdo->query("SET CHARACTER SET '{$this->charset}' ");
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_OBJ);


        } catch (\Throwable $e) {
            die("An error occured while connecting => {$e->getMessage()}");
        }// Catch END
    }
    // connectDb End


    public function __construct()
    {
        $this->connect();
    }   


    private function myQuery($query,$params){
        // Diğer metotlardaki veri tekrarını engellemek için kullanılan private metot
        if(is_null($params)){
            $this->stmt = $this->pdo->query($query);
        }
        else{
            $this->stmt  = $this->pdo->prepare($query);
            $this->stmt->execute($params);
        }// if end

        return $this->stmt;
    }

    public function getRows($query,$params=null){

        // Multiple Row Fetching
        try {

            return $this->myQuery($query,$params)->fetchAll();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    

    public function getRow($query,$params=null){

        // One Row Fetching
        try {
            return $this->myQuery($query,$params)->fetch();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getColumn($query,$params=null){

        // One Row One Column Fetching
        try {
            return $this->myQuery($query,$params)->fetchColumn();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function insert($query,$params=NULL){
        // Insert Data
        try {
            $this->myQuery($query,$params);
            return $this->pdo->lastInsertId();
        }catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function update($query,$params=NULL){
         // Update Data
         try {
            return $this->myQuery($query,$params)->rowCount();
        }catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function delete($query,$params=NULL){
        // Delete Data
        // Update ismini aldı çünkü update classıyla tamamen aynı işi yapıyor.
        // Sorgu gönderilicek ve dönen değerin row countu alınıcak.
        return $this->Update($query,$params);
    }
    
    public function __destruct()
    {
        // close DB connection
        $this->pdo=NULL;
        $this->stmt=NULL;
    } 


}


?>