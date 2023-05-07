<?php
  require_once("../../private/initialize.php");

  $pageTitle = "Checkout Book";
  $books = findAllItems("books");
  $members = findAllItems("members");


  include(SHARED_PATH."/header.php");
?>

<h1>Checkout Book</h1>

<!-- Back to page -->
<a href="<?php echo urlFor("loans/index.php");?>">Back to List</a>

<!-- Form to add a record to the database,
     You need to be customize this to fit the needs
     of the schema
    
    Need to update your create.php file as well.-->
<form action="<?php echo urlFor("loans/create.php");?>" method="post">
  <label for="book">Select Book:</label>
  <select name="book" id="book">
    <?php while($book = mysqli_fetch_assoc($books)){ ?>
      <option value="<?php echo $book["Book_ID"];?>"><?php echo $book["Book_ID"]."-".$book["Title"];?></option>
    <?php } ?>
  </select>
  <label for="member">Select Member:</label>
  <select name="member" id="member">
    <?php while($member = mysqli_fetch_assoc($members)){ ?>
      <option value="<?php echo $member["Member_ID"];?>"><?php echo $member["FirstName"]." ".$member["LastName"];?></option>
    <?php } ?>
  </select>
  <label for="checkoutDate">Date of checkout:</label>
  <input type="date" name="checkoutDate" id="checkoutDate">
  <input type="submit" value="Add Member">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>