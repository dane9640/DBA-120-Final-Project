<?php
  require_once("../../private/initialize.php");

  $pageTitle = "Add Member";


  include(SHARED_PATH."/header.php");
?>

<h1>Add new Author</h1>

<!-- Back to page -->
<a href="<?php echo urlFor("members/index.php");?>">Back to List</a>

<!-- Form to add a record to the database,
     You need to be customize this to fit the needs
     of the schema
    
    Need to update your create.php file as well.-->
<form action="<?php echo urlFor("members/create.php");?>" method="post">
  <label for="firstName">First Name:</label>
  <input type="text" name="firstName" id="firstName">
  
  <label for="lastName">Last Name:</label>
  <input type="text" name="lastName" id="lastName">

  <label for="email">Email:</label>
  <input type="text" name="email" id="email">

  <label for="phoneNumber">Phone Number:</label>
  <input type="text" name="phoneNumber" id="phoneNumber">

  <input type="submit" value="Add Member">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>