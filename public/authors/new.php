<?php
  require_once("../../private/initialize.php");

  $test = $_GET['test'] ?? '';

  $pageTitle = "Add Author";


  include(SHARED_PATH."/header.php");
?>

<h1>Add new Author</h1>

<!-- Back to page -->
<a href="<?php echo urlFor("authors/index.php");?>">Back to List</a>

<!-- Form to add a record to the database,
     You need to be customize this to fit the needs
     of the schema
    
    Need to update your create.php file as well.-->
<form action="<?php echo urlFor("authors/create.php");?>" method="post">
  <label for="firstName">First Name:</label>
  <input type="text" name="firstName" id="firstName">
  
  <label for="lastName">Last Name:</label>
  <input type="text" name="lastName" id="lastName">

  <input type="submit" value="Add Author">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>