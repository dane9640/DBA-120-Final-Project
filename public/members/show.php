<?php
  require_once("../../private/initialize.php");

  $pageTitle = "Member | Show";

  include(SHARED_PATH."/header.php");
  
  $id = $_GET['id'];

  $members = mysqli_fetch_assoc(findItemByID("members", $id));

?>

<h1>Member:</h1>

<h2>First Name: </h2>
<p><?php echo h($members['FirstName']);?></p>
<h2>Last Name: </h2>
<p><?php echo h($members['LastName']);?></p>
<h2>Email: </h2>
<p><?php echo h($members['Email']);?></p>
<h2>Phone Number: </h2>
<p><?php echo h($members['PhoneNumber']);?></p>

<?php include(SHARED_PATH."/footer.php"); ?>