<?php
  require_once('../../../private/initialize.php');




  if(isPostRequest()){
    // exit("POST: ".print_r($_POST));

    $ImageID = $_POST['ImageID'] ??  false;
    // exit("Image id ". $ImageID);
    if(!$ImageID){
      //TODO: insert fresh image into database and get the image id and next use that image id to update the same row where previous image is inserted
      $uploaded_image_id = 78965;// temp value
      $result_array = array(
        'ImageID'=>$uploaded_image_id,
        'message' => "insert fresh image into database and get the image id and next use that image id to update the same row where previous image"
      );
      exit(json_encode($result_array));

    }else{
      //TODO: now save the received image into products images database where id = $_POST['ImageID']
      $result_array = array("message"=>" now save the received image into products images database where id = _POST['ImageID']");
      exit(json_encode($result_array));
    }
    // exit(print_r($_GET));
    // exit("FILES: ".print_r($_FILES));
    // exit("Image id: ".$_GET['imageId'] ."\n".print_r($_FILES));
  }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upalod Image</title>
    <link rel="stylesheet" type="text/css" href="<?php echo urlFor('stylesheets/uploadImage.css'); ?>">
  </head>
  <body>
    <div class="container">
          <!-- Header Image -->
          <button class="fileButton"  onclick="document.getElementById('headerImage').click()">Add Header Image</button>
          <input id="headerImage" type='file' name="headerImage" accept="image/*" >
          <div id="headerImageContainer">
            <img src="<?php echo urlFor('images/default_image.svg'); ?>" alt="">
          </div>

          <!-- Product Gallery Images -->
          <button class="fileButton" onclick="document.getElementById('getProductGallaryImages').click()">Add Product Gallery Image</button>
          <input type="file" name="productGalleryImages[]" id="getProductGallaryImages" accept="image/*" multiple="multiple"  >
          <div id="productGallery">
            <ul>
              <li> <img src="<?php echo urlFor('images/default_image.svg'); ?>" alt=""> </li>
              <li> <img src="<?php echo urlFor('images/default_image.svg'); ?>" alt=""> </li>
              <li> <img src="<?php echo urlFor('images/default_image.svg'); ?>" alt=""> </li>
            </ul>
          </div>
    </div>

  </body>


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">

    var ImageID = null;
        // upload Header Image without page load
        $(document).ready(function() {
          $('#headerImage').change(function(){
                  console.log("Image Added");
                  var file_data = $('#headerImage').prop('files')[0];
                  console.log(file_data);
                  // var form_data = new FormData(document.getElementById('ImageIdForm'));
                  var form_data = new FormData();
                  form_data.append('file', file_data);
                  if(ImageID !== null) form_data.append('ImageID',ImageID);

                  $.ajax({
                      url: "uploadImages.php",
                      type: "POST",
                      data: form_data,
                      contentType: false,
                      cache: false,
                      processData:false,
                      success: function(data){
                          var json = JSON.parse(data);
                          ImageID = json['ImageID'];
                          // document.getElementById('ImageID').setAttribute('value',uploaded_image_id);
                          // console.log(document.getElementById('ImageID'));
                          console.log(json['message']);
                      }
                  });
          });
          $('#getProductGallaryImages').change(function(){
                  console.log("Product gallary Images Added");
                  var files = $('#getProductGallaryImages').prop('files');
                  for(var i=0; i<files.length; i++){
                      var single_file_data = $('#getProductGallaryImages').prop('files')[i];
                      var form_data = new FormData();
                      form_data.append('file', single_file_data);
                      $.ajax({
                          url: "uploadImages.php",
                          type: "POST",
                          data: form_data,
                          contentType: false,
                          cache: false,
                          processData:false,
                          success: function(data){
                              console.log(data);
                          }
                      });
                  }
          });

        });

  </script>

</html>
