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



    /******* Constructor
    *********************************/
    public function __construct($args){
      $this->setID($args[ITEMS_TABLE::COLUMN_ITEM_ID] ?? null);
      $this->setTitle($args[ITEMS_TABLE::COLUMN_TITLE] ?? null);
      $this->setCategoryID($args[ITEMS_TABLE::COLUMN_CATEGORY_ID] ?? null);
      $this->setOrignalPrice($args[ITEMS_TABLE::COLUMN_ORIGNAL_PRICE] ?? null);
      $this->setSellingPrice($args[ITEMS_TABLE::COLUMN_SELLING_PRICE] ?? null);
      $this->setQuantityAvailable($args[ITEMS_TABLE::COLUMN_QUANTITY_AVAILABLE] ?? null);
      $this->setShippingMethod($args[ITEMS_TABLE::COLUMN_SHIPPING_METHOD] ?? null);
      $this->setShippingPrice($args[ITEMS_TABLE::COLUMN_SHIPPING_PRICE] ?? null);
      $this->setItemWillReached($args[ITEMS_TABLE::COLUMN_ITEM_WILL_REACHED] ?? null);
      $this->setPictureID($args[ITEMS_TABLE::COLUMN_PICTURE_ID] ?? null);
      $this->setDescription($args[ITEMS_TABLE::COLUMN_DESCRIPTION] ?? null);
      $this->setIsRecommended($args[ITEMS_TABLE::COLUMN_IS_RECOMMENDED] ?? null);
      $this->setIsFeatured($args[ITEMS_TABLE::COLUMN_IS_FEATURED] ?? null);
      $this->setIsNewArrival($args[ITEMS_TABLE::COLUMN_IS_NEW_ARRIVAL] ?? null);
      $this->setIsSpecialOffer($args[ITEMS_TABLE::COLUMN_IS_SPECIAL_OFFER] ?? null);

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
         $this->orignalPrice = $orignalPrice;
    }


    public function getSellingPrice() {
         return $this->sellingPrice;
    }
    public function setSellingPrice($sellingPrice) {
         $this->sellingPrice = $sellingPrice;
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
         $this->shippingPrice = $shippingPrice;
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
      }else {
        return $this->getErrorMessages();
      }
    }









    /***** Helper functions
    *******************************/
    private function isValid(){
      // do data validation
      if(!hasPresence($this->getTitle())){
        $this->errors[ITEMS_TABLE::COLUMN_TITLE] = "Title Can't be empty";
      }


    }


    public function getErrorMessages(){
      return $this->errors;
    }

}

?>
