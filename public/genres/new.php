<?php
  require_once("../../private/initialize.php");

  $pageTitle = "Add Genre";


  include(SHARED_PATH."/header.php");
?>

<h1>Add new Genre</h1>

<!-- Back to page -->
<a href="<?php echo urlFor("genres/index.php");?>">Back to List</a>

<!-- Form to add a record to the database,
     You need to be customize this to fit the needs
     of the schema
    
    Need to update your create.php file as well.-->
<form action="<?php echo urlFor("genres/create.php");?>" method="post">
  <label for="name">Genre Name:</label>
  <input type="text" name="name" id="name">
  
  <label for="description">Genre Description:</label>
  <input type="text" name="description" id="description">

  <input type="submit" value="Add Genre">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>