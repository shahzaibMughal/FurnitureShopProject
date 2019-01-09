<?php

  define("DB_SERVER","localhost");
  define("DB_USER","root");
  define("DB_PASS","");
  define("DB_NAME","furnitureShop");

  function dbConnect(){
    $database = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    if($database->connect_errno)
    {
      throw new \Exception("Can't connect with the database, Error: ".$database->connect_error.", Error Number:".$database->connect_errno);
    }
    return $database;
  }

  function dbDisconnect($database)
  {
    if(isset($database)){ $database->close();}
  }




  class CATEGORIES_TABLE {
    public const TABLE_NAME = 'categories';
    public const COLUMN_ID = 'id';
    public const COLUMN_NAME = 'categoryName';
    public const COLUMN_POSITION = 'position';
  }




  class ITEMS_TABLE {
    public const TABLE_NAME = 'Items';
    public const COLUMN_TITLE = 'title';
    public const COLUMN_CATEGORY_ID = 'categoryID';
    public const COLUMN_ORIGNAL_PRICE = 'orignalPrice';
    public const COLUMN_SELLING_PRICE = 'sellingPrice';
    public const COLUMN_ITEM_ID = 'itemID';
    public const COLUMN_QUANTITY_AVAILABLE = 'quantityAvailable';
    public const COLUMN_TIMESTAMP = 'timestamp';
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_SHIPPING_METHOD = 'shippingMethod';
    public const COLUMN_SHIPPING_PRICE = 'shippingPrice';
    public const COLUMN_ITEM_WILL_REACHED = 'itemWillReached';
    public const COLUMN_IS_SPECIAL_OFFER = 'isSpecialOffer';
    public const COLUMN_IS_RECOMMENDED = 'isRecommended';
    public const COLUMN_IS_FEATURED = 'isFeatured';
    public const COLUMN_IS_NEW_ARRIVAL = 'isNewArrival';
    public const COLUMN_PICTURE_ID = 'pictureID';
  }



 ?>
