<?php   require_once('../../../private/initialize.php');?>
<?php
  $id = $_GET['id'] ?? NULL;
  if(!isset($id)){
    redirectTo('index.php');
    exit;
  }


  $category = Category::find_category_by_id($id);


  if(isPostRequest()){
    if(isset($_POST['delete']))
    {
      // exit("Delete Button Pressed");
      if(isset($category)){
        $category->delete();
        redirectTo('index.php');
      }else {
        exit("Item you are trying to delete is not exist");
      }
    }else {
      // exit("Cancel Button Pressed");
      redirectTo('index.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Delete Category</title>
    <style media="screen">
        *{
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        }

        .content{
        /* background: pink; */
        width: 50%;
        margin: 10% auto;
        text-align: center;
        font-size: 2em;
        }

        input[type="submit"], button{
        box-sizing: content-box;
        background-color: #4CAF50;
        color: white;
        border: 0px;
        font-size: 1em;
        padding: 10px;
        width: 20%;
        }


        input[type="submit"]:hover, button:hover{
        cursor: pointer;
        background-color: #3a7d3d;
        }
    </style>
  </head>
  <body>
    <div class="content">
      <form action="<?php echo $_SERVER['SCRIPT_NAME']."?id=".$category->getId(); ?>" method="post">
        <h1>Are You Sure?</h1>
        <input type="submit" name="cancel" value="Cancel">
        <input type="submit" name="delete" value="Delete">
      </form>
    </div>

  </body>
</html>
