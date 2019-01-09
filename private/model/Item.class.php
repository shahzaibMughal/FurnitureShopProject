<?php

class Item
{
    private static $database;
    private $id;
    private $isSpecialOffer; //boolean
    private $isNewArrival; //boolean
    private $isFeatured; //boolean
    private $isRecommended; //boolean
    private $pictureID; //int
    private $ItemWillReached; //int
    private $shippingPrice; //int
    private $shippingMethod; //String
    private $quantityAvailable; //int
    private $sellingPrice; //int
    private $orignalPrice; //int
    private $categoryID; //int
    private $title; //String
    private $description; //String

    private $errors = [];



    /******* Database Related
    *********************************/
    public static function setDatabase($database){
      self::$database = $database;
    }


    public function create(){
      $queryString = "INSERT INTO ".ITEMS_TABLE::TABLE_NAME." ";
      $queryString .= "SET ".ITEMS_TABLE::COLUMN_TITLE." = ".self::escapeString($this->getTitle()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_CATEGORY_ID." = ".self::escapeString($this->getCategoryID()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_ORIGNAL_PRICE." = ".self::escapeString($this->getOrignalPrice()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_SELLING_PRICE." = ".self::escapeString($this->getSellingPrice()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_QUANTITY_AVAILABLE." = ".self::escapeString($this->getQuantityAvailable()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_SHIPPING_METHOD." = ".self::escapeString($this->getShippingMethod()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_SHIPPING_PRICE." = ".self::escapeString($this->getShippingPrice()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_ITEM_WILL_REACHED." = ".self::escapeString($this->getItemWillReached()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_PICTURE_ID." = ".self::escapeString($this->getPictureID()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_DESCRIPTION." = ".self::escapeString($this->getDescription()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_IS_RECOMMENDED." = ".self::escapeString($this->getIsRecommended()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_IS_FEATURED." = ".self::escapeString($this->getIsFeatured()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_IS_NEW_ARRIVAL." = ".self::escapeString($this->getIsNewArrival()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_IS_SPECIAL_OFFER." = ".self::escapeString($this->getIsSpecialOffer());

      // exit($queryString);
      $result = self::$database->query($queryString);
      if($result)
      {
        return true; // Item successfully created
      }
      else {
        throw new \Exception("Insertion failed, Error: ".self::$database->error);
      }
    }

    public function update(){
      $queryString = "UPDATE ".ITEMS_TABLE::TABLE_NAME." ";
      $queryString .= "SET ".ITEMS_TABLE::COLUMN_TITLE." = ".self::escapeString($this->getTitle()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_CATEGORY_ID." = ".self::escapeString($this->getCategoryID()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_ORIGNAL_PRICE." = ".self::escapeString($this->getOrignalPrice()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_SELLING_PRICE." = ".self::escapeString($this->getSellingPrice()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_QUANTITY_AVAILABLE." = ".self::escapeString($this->getQuantityAvailable()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_SHIPPING_METHOD." = ".self::escapeString($this->getShippingMethod()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_SHIPPING_PRICE." = ".self::escapeString($this->getShippingPrice()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_ITEM_WILL_REACHED." = ".self::escapeString($this->getItemWillReached()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_PICTURE_ID." = ".self::escapeString($this->getPictureID()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_DESCRIPTION." = ".self::escapeString($this->getDescription()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_IS_RECOMMENDED." = ".self::escapeString($this->getIsRecommended()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_IS_FEATURED." = ".self::escapeString($this->getIsFeatured()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_IS_NEW_ARRIVAL." = ".self::escapeString($this->getIsNewArrival()). ",";
      $queryString .= ITEMS_TABLE::COLUMN_IS_SPECIAL_OFFER." = ".self::escapeString($this->getIsSpecialOffer())." ";
      $queryString .=  "WHERE ".ITEMS_TABLE::COLUMN_ITEM_ID." = ".self::escapeString($this->getId());

      // exit($queryString);
      $result = self::$database->query($queryString);
      if($result)
      {
        return true; // Item successfully updated
      }
      else {
        throw new \Exception("Failed to Update the item, Error: ".self::$database->error);
      }
    }



    /******* Constructor
    *********************************/
    public function __construct($args = []){
      $this->setID($args[ITEMS_TABLE::COLUMN_ITEM_ID] ?? null);
      $this->setTitle($args[ITEMS_TABLE::COLUMN_TITLE] ?? null);
      $this->setCategoryID($args[ITEMS_TABLE::COLUMN_CATEGORY_ID] ?? null);
      $this->setOrignalPrice($args[ITEMS_TABLE::COLUMN_ORIGNAL_PRICE] ?? null);
      $this->setSellingPrice($args[ITEMS_TABLE::COLUMN_SELLING_PRICE] ?? null);
      $this->setQuantityAvailable($args[ITEMS_TABLE::COLUMN_QUANTITY_AVAILABLE] ?? null);
      $this->setShippingMethod($args[ITEMS_TABLE::COLUMN_SHIPPING_METHOD] ?? null);
      $this->setShippingPrice($args[ITEMS_TABLE::COLUMN_SHIPPING_PRICE] ?? 0);
      $this->setItemWillReached($args[ITEMS_TABLE::COLUMN_ITEM_WILL_REACHED] ?? null);
      $this->setPictureID($args[ITEMS_TABLE::COLUMN_PICTURE_ID] ?? null);
      $this->setDescription($args[ITEMS_TABLE::COLUMN_DESCRIPTION] ?? '');
      $this->setIsRecommended($args[ITEMS_TABLE::COLUMN_IS_RECOMMENDED] ?? 0);
      $this->setIsFeatured($args[ITEMS_TABLE::COLUMN_IS_FEATURED] ?? 0);
      $this->setIsNewArrival($args[ITEMS_TABLE::COLUMN_IS_NEW_ARRIVAL] ?? 0);
      $this->setIsSpecialOffer($args[ITEMS_TABLE::COLUMN_IS_SPECIAL_OFFER] ?? 0);

    }




    /******* Getter & Setters
    *********************************/
    private function getID() {
         return $this->id;
    }
    public function setID($id) {
         $this->id = $id;
    }

    public function getTitle() {
         return $this->title;
    }
    public function setTitle($title) {
         $this->title = $title;
    }
    public function getDescription() {
         return $this->description;
    }
    public function setDescription($description) {
         $this->description = $description;
    }


    public function getCategoryID() {
         return $this->categoryID;
    }
    public function setCategoryID($categoryID) {
         $this->categoryID = $categoryID;
    }


    public function getOrignalPrice() {
         return $this->orignalPrice;
    }
    public function setOrignalPrice($orignalPrice) {
        if(!is_numeric($orignalPrice)){
          throw new \Exception("Price Can't be a string");
        }
        $this->orignalPrice = (double) $orignalPrice;
    }


    public function getSellingPrice() {
         return $this->sellingPrice;
    }
    public function setSellingPrice($sellingPrice) {
      if(!is_numeric($sellingPrice)){
        throw new \Exception("Price Can't be a string");
      }
         $this->sellingPrice = (double) $sellingPrice;
    }


    public function getQuantityAvailable() {
         return $this->quantityAvailable;
    }
    public function setQuantityAvailable($quantityAvailable) {
         $this->quantityAvailable = $quantityAvailable;
    }


    public function getShippingMethod() {
         return $this->shippingMethod;
    }
    public function setShippingMethod($shippingMethod) {
         $this->shippingMethod = $shippingMethod;
    }


    public function getShippingPrice() {
         return $this->shippingPrice;
    }
    public function setShippingPrice($shippingPrice) {
        if(!is_numeric($shippingPrice)){
          throw new \Exception("Price Can't be a string");
        }
        $this->shippingPrice = (double) $shippingPrice;
    }


    public function getItemWillReached() {
         return $this->ItemWillReached;
    }
    public function setItemWillReached($ItemWillReached) {
         $this->ItemWillReached = $ItemWillReached;
    }


    public function getPictureID() {
         return $this->pictureID;
    }
    public function setPictureID($pictureID) {
         $this->pictureID = $pictureID;
    }


    public function getIsRecommended() {
         return $this->isRecommended;
    }
    public function setIsRecommended($isRecommended) {
         $this->isRecommended = $isRecommended;
    }


    public function getIsFeatured() {
         return $this->isFeatured;
    }
    public function setIsFeatured($isFeatured) {
         $this->isFeatured = $isFeatured;
    }


    public function getIsNewArrival() {
         return $this->isNewArrival;
    }
    public function setIsNewArrival($isNewArrival) {
         $this->isNewArrival = $isNewArrival;
    }


    public function getIsSpecialOffer() {
         return $this->isSpecialOffer;
    }
    public function setIsSpecialOffer($isSpecialOffer) {
         $this->isSpecialOffer = $isSpecialOffer;
    }






    /***** General functions
    *******************************/
    public function save(){

      if($this->isValid()){
          // save or update item
          if(!hasPresence($this->getID())){
            $this->create();
          }else {
            $this->update();
          }
      }else {
        return $this->getErrorMessages();
      }
    }









    /***** Helper functions
    *******************************/
    private function isValid(){
      // do data validation
      // if(!hasPresence()){
      //   $this->errors[] = "";
      // }

      if(!hasPresence($this->getTitle()))     {
        $this->errors[ITEMS_TABLE::COLUMN_TITLE] = "Title Can't be empty";
        return false;
      }
      if(!hasPresence($this->getCategoryID()))     {
        $this->errors[ITEMS_TABLE::COLUMN_CATEGORY_ID] = "Category ID Can't be empty";
        return false;
      }
      if(!hasPresence($this->getOrignalPrice()) || $this->getOrignalPrice()<=0){
        $this->errors[ITEMS_TABLE::COLUMN_ORIGNAL_PRICE] = "Orignal Price Can't be empty and should be > 0";
        return false;
      }
      if(!hasPresence($this->getSellingPrice()) || $this->getSellingPrice()<=0){
        $this->errors[ITEMS_TABLE::COLUMN_SELLING_PRICE] = "Selling Price Can't be empty and should be > 0";
        return false;
      }
      if(!hasPresence($this->getQuantityAvailable()) || $this->getQuantityAvailable()<0){
        $this->errors[ITEMS_TABLE::COLUMN_QUANTITY_AVAILABLE] = "Quantity Availabe Can't be empty and should be >= 0";
        return false;
      }
      if(!hasPresence($this->getShippingMethod()))     {
        $this->errors[ITEMS_TABLE::COLUMN_SHIPPING_METHOD] = "Shipping method Can't be empty";
        return false;
      }
      if(!hasPresence($this->getShippingPrice()) || $this->getShippingPrice()<0){
        $this->errors[ITEMS_TABLE::COLUMN_SHIPPING_PRICE] = "Price Can't be < 0";
        return false;
      }
      if(!hasPresence($this->getItemWillReached()) || $this->getItemWillReached()<=0){
        $this->errors[ITEMS_TABLE::COLUMN_ITEM_WILL_REACHED] = "Shipping days should be > 0";
        return false;
      }
      if(!hasPresence($this->getPictureID())){
        $this->errors[ITEMS_TABLE::COLUMN_PICTURE_ID] = "Picture id can't be null";
        return false;
      }
      return true;
    }


    public function getErrorMessages(){
      return $this->errors;
    }
    public static function escapeString($string){
      if(isset($string)){
        return "'".self::$database->escape_string($string)."'";
      }
      return null;
    }

}

?>
