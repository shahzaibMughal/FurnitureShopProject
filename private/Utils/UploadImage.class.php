<?php
/**
 *
 */
class UploadImage
{
  static $ImageID;


  public static function setImageId($id){

      if(!isset(self::$ImageID)){
        self::$ImageID = $id;
        echo "Brand new Image Id is created: ".self::$ImageID;
      }else {
        echo "Image Id already set: ".self::$ImageID;
      }

  }

  function __construct()
  {
    // code...
  }
}


 ?>
