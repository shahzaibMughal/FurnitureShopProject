<?php require_once('../../../private/initialize.php');?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Categories</title>
    <link rel="stylesheet" href=<?php echo urlFor('stylesheets/categories.css'); ?>>
  </head>
  <body>
    <div class="content">
       <a href="<?php echo urlFor('admin/categories/create_edit.php'); ?>">Add New Category</a>
       <table>
         <thead>
           <tr>
             <th>Category Name</th>
             <th></th>
             <th></th>
           </tr>
         </thead>
         <tbody>
           <?php $categories = Category::find_all(); ?>
           <?php foreach ($categories as $category) { ?>
           <tr>
             <td><?php echo $category->getName(); ?></td>
             <td><a href="<?php echo urlFor('admin/categories/create_edit.php?id='.$category->getId()); ?>">Edit</a></td>
             <td><a href="<?php echo urlFor('admin/categories/delete.php?id='.$category->getId()); ?>">Delete</a></td>
           </tr>
         <?php } ?>

         </tbody>
       </table>
     </div>
  </body>
</html>
