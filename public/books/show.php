<?php
  require_once("../../private/initialize.php");

  $pageTitle = "Books | Show";

  include(SHARED_PATH."/header.php");
  
  $id = $_GET['id'];

  $books = findItemByIDJoined("books", $id);

?>

<h1><?php echo h($books['Title']);?></h1>

<h2>Author: </h2>
<p><?php echo h($books['FirstName'])." ".h($books['LastName']);?></p>

<h2>Genre: </h2>
<p><?php echo h($books['Name'])?></p>

<?php include(SHARED_PATH."/footer.php"); ?>