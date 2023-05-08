<?php
  require_once("../../private/initialize.php");

  $pageTitle = "Author | Show";

  include(SHARED_PATH."/header.php");
  
  $id = $_GET['id'];

  $authors = mysqli_fetch_assoc(findItemByID("Authors", $id));

?>

<h1>Author:</h1>

<h2>First Name: </h2>
<p><?php echo h($authors['FirstName']);?></p>
<h2>Last Name: </h2>
<p><?php echo h($authors['LastName']);?></p>

<?php include(SHARED_PATH."/footer.php"); ?>