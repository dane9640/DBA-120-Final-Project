<?php
  require_once("../../private/initialize.php");

  $test = $_GET['test'] ?? '';

  $pageTitle = "Add";

  include(SHARED_PATH."/header.php");
?>

<h1>Add new item</h1>

<!-- Back to page -->
<a href="<?php echo urlFor("page/index.php");?>">Back to List</a>

<!-- Form to add a record to the database,
     You need to be customize this to fit the needs
     of the schema
    
    Need to update your create.php file as well.-->
<form class="test" action="<?php echo urlFor("/page/create.php");?>" method="post">
  <label for="">Item Field:</label>
  <input type="text" name="" id="">
  
  <label for="">Item Field:</label>
  <input type="text" name="" id="">

  <input type="submit" value="Add Item">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>