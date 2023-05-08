<?php
  require_once("../../private/initialize.php");

  $pageTitle = "Genres | Show";

  include(SHARED_PATH."/header.php");
  
  $id = $_GET['id'];

  $genres = mysqli_fetch_assoc(findItemByID("Genres", $id));

?>

<h1><?php echo h($genres['Name']);?></h1>

<h2>Description: </h2>
<p><?php echo h($genres['Description']);?></p>

<?php include(SHARED_PATH."/footer.php"); ?>