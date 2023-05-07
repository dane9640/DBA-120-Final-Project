<?php
  require_once("../../private/initialize.php");

  $pageTitle = "Loan | Show";

  include(SHARED_PATH."/header.php");
  
  $id = $_GET['id'];

  $loans = findItemByIDJoined("loans", $id);

?>

<h1>Loan:</h1>

<h2>Book: </h2>
<p><?php echo h($loans['Title']);?></p>
<h2>Member: </h2>
<p><?php echo h($loans['FirstName'])." ".h($loans['LastName']);?></p>
<h2>Checkout Date: </h2>
<p><?php echo h($loans['CheckoutDate']);?></p>
<h2>Due Date: </h2>
<p><?php echo h($loans['DueDate']);?></p>

<?php include(SHARED_PATH."/footer.php"); ?>