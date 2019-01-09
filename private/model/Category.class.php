<?php


class Category{

  private static $database;
  private $id;
  private $name;
  private $position;

  public function __construct($args){
    $this->setId($args[CATEGORIES_TABLE::COLUMN_ID] ?? null);
    $this->setName($args[CATEGORIES_TABLE::COLUMN_NAME] ?? '');
    $this->setPosition($args[CATEGORIES_TABLE::COLUMN_POSITION] ?? '1');
  }


  /****** Database Related
  *********************************/
  static public function setDatabase($database){
     self::$database = $database;
  }
  static public function getDatabase(){
     return self::$database;
  }




  static public function getCount(){
    $sql = 'SELECT count(*) as TotalCount FROM '.CATEGORIES_TABLE::TABLE_NAME;
    $resultSet = self::$database->query($sql);
    if(!$resultSet)
    {
      exit("total count query fail");
    }else {
      $row = $resultSet->fetch_assoc();
      // exit(print_r($row));
      return $row['TotalCount'];
    }
  }

  static public function find_category_by_id($id){
    $sql  = "SELECT * FROM ".CATEGORIES_TABLE::TABLE_NAME ." ";
    $sql .= "WHERE ".CATEGORIES_TABLE::COLUMN_ID." = ".self::escapeString($id)." LIMIT 1";
    $objectsArray = self::find_by_sql($sql);
    return array_shift($objectsArray); // get single category
  }

  static public function find_all(){
    $sql = "SELECT * FROM ".CATEGORIES_TABLE::TABLE_NAME;
    return self::find_by_sql($sql);
   }

  static public function find_by_sql($sql)  {
      $result = self::$database->query($sql);
      if(!$result){
         exit("Database Query failed...");
      }
      // results into objects
      $object_array = [];
      while($row = $result->fetch_assoc()){
        $object_array[] =  self::instantiate($row);
      }
      $result->free();
      return $object_array;
    }

  static private function instantiate($row){
    $category = new Category($row);
    return $category;
  }

  public function save()
  {
    if($this->getId()!== null){
      return $this->update();
    }else{
      return $this->create();
    }
  }

  private function create(){
    // exit("validate data and create new category");
    $errorsArray = $this->validate();
    if(!isContainErrors($errorsArray))
    {
        // data is valid, save data into database;
        $queryString  =  "INSERT INTO ".CATEGORIES_TABLE::TABLE_NAME;
        $queryString .=  " (".CATEGORIES_TABLE::COLUMN_NAME.",";
        $queryString .=  CATEGORIES_TABLE::COLUMN_POSITION.") VALUES (";

        $queryString .=  self::escapeString($this->getName()).",";
        $queryString .=  self::escapeString($this->getPosition()).")";

        $result = Category::$database->query($queryString);
        if($result)
        {
          return true; // category successfully created
        }
        else {
          throw new \Exception("Insertion failed, Error: ".$database->error);
        }
    }else {

        return $errorsArray;
    }
  }

  public function update(){
    $errorsArray = $this->validate();
    if(!isContainErrors($errorsArray))
    {
        // data is valid, save data into database;
        // UPDATE categories SET categoryName = 'qqqqq' WHERE id = 5;
        $queryString  =  "UPDATE ".CATEGORIES_TABLE::TABLE_NAME." SET ";
        $queryString .=  CATEGORIES_TABLE::COLUMN_NAME." = ".self::escapeString($this->getName())." ,";
        $queryString .=  CATEGORIES_TABLE::COLUMN_POSITION." = ".self::escapeString($this->getPosition())." ";
        $queryString .=  "WHERE ".CATEGORIES_TABLE::COLUMN_ID." = ".self::escapeString($this->getId());

        $result = Category::$database->query($queryString);
        if($result)
        {
          return true; // category successfully created
        }
        else {
          throw new \Exception("Insertion failed, Error: ".$database->error);
        }
    }else {
        return $errorsArray;
    }
  }

  public function delete(){
    $queryString = "DELETE FROM ".CATEGORIES_TABLE::TABLE_NAME." WHERE ".CATEGORIES_TABLE::COLUMN_ID." = ".self::escapeString($this->getId());
    $result = self::$database->query($queryString);
    if($result)
    {
      return true; // category successfully created
    }
    else {
      throw new \Exception("Failed to Delete category, Error: ".$database->error);
    }
  }


  /****** Getters
  ***************************/
  public function getId()
  {
    return $this->id;
  }
  public function getName()
  {
    return htmlspecialchars($this->name);
  }
  public function getPosition()
  {
    return htmlspecialchars($this->position);
  }


  /****** Setters
  **************************/
  private function setId($id){
    $this->id = $id;
  }
  public function setName($name){
    $this->name = $name;
  }

  public function setPosition($position){
    $this->position = $position;
  }



  /****** Helper funcitons
  *********************************/












  /****** Validation functions
  *********************************/
  private function validate(){
    $errors = [];

    if(!hasPresence($this->getName())){
      $errors['firstName']='Category name can\'t be blank';
    }

    return $errors;
  }

  public static function escapeString($string){
    return "'".self::$database->escape_string($string)."'";
  }

}


 ?>
