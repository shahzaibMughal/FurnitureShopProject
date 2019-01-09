<?php
  require_once('../../../private/initialize.php');

  $category  = new Category(['categoryName'=>'','position'=>'']); // empty object for prevention from error while !isForEditCategory()
  $errors = [];



  if(isForEditCategory()){
    $category  = Category::find_category_by_id($_GET['id']);
    if(!isset($category)){
      // exit("don't do yakiyan with url");
      redirectTo(urlFor('admin/categories/index.php'));
    }
  }

  if(isPostRequest()){
    $category->setName($_POST[CATEGORIES_TABLE::COLUMN_NAME]);
    $category->setPosition($_POST[CATEGORIES_TABLE::COLUMN_POSITION]);
    $result = $category->save();
    if($result === true)
    {
      redirectTo(urlFor('admin/categories/index.php'));
    }
    $errors = $result;

  }




  function isForEditCategory(){
    $id = $_GET['id'] ?? null;
    if($id === null) { return false;}
    else{return true;}
  }
  function getPageTitle(){
    if(!isForEditCategory()){
      return "Create Category";
    }else {
      return "Edit Category";
    }
  }
  function getCurrentPageURL(){
    if(isForEditCategory()){
      return $_SERVER['SCRIPT_NAME'].'?id='.$_GET['id'];
    }
    else {
      return $_SERVER['SCRIPT_NAME'];
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo getPageTitle(); ?></title>
    <!-- TODO <link rel="stylesheet" href="styles/create_note.css"> -->
  </head>
  <body>
    <div class="content">

      <?php if(isContainErrors($errors)){ print_r($errors);} ?>

        <form action="<?php echo getCurrentPageURL(); ?>" method="post">
          <input  type="text"
                  name=<?php echo CATEGORIES_TABLE::COLUMN_NAME; ?>
                  placeholder="Category Name"
                  maxlength="30"
                  value="<?php echo $category->getName(); ?>">

          <select name=<?php echo CATEGORIES_TABLE::COLUMN_POSITION; ?>>
              <?php $totalCategories = Category::getCount();
                    for($i=1; $i<=$totalCategories; $i++){
                      echo "<option value=".$i." ". ($category->getPosition()==$i ? 'selected':'') ."  >".$i."</option>";
                    }
              ?>
          </select>
          <input type="submit" name="submit" value=<?php echo isForEditCategory() ? "Update": "Create" ;  ?>>
        </form>
    </div>
  </body>
</html>
