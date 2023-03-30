<?php
require_once 'assets/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
class Users {
   protected $database;
   protected $dbname = 'crop_types';
   public function __construct(){
       $factory = (new Factory())
        ->withServiceAccount('assets/api-keys/agrimarket.json')
        ->withProjectId('agrimarket-bcd77')
        ->withDatabaseUri('https://agrimarket-bcd77-default-rtdb.asia-southeast1.firebasedatabase.app/');
        $this->database = $factory->createDatabase();
   }
   public function get_Database(){
    return $this->database;
   }
   public function get($database_name){    
       if ($this->database->getReference($database_name)->getValue()){
           return $this->database->getReference($database_name)->getValue();
       } else {
           return FALSE;
       }
   }
   public function insert(array $data) {
       if (empty($data) || !isset($data)) { return FALSE; }
       foreach ($data as $key => $value){
           $this->database->getReference()->getChild($this->dbname)->getChild($key)->push($value);
       }
       return TRUE;
   }
   public function delete($userID) {
       if (empty($userID) || !isset($userID)) { return FALSE; }
       if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)){
           $this->database->getReference($this->dbname)->getChild($userID)->remove();
           return TRUE;
       } else {
           return FALSE;
       }
   }
}
?>