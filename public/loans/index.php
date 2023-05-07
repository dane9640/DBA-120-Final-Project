<?php
  require("../../private/initialize.php");

  //Database table associated with page
  $pageTable = "loans";
  //Query to find all items from the associated table
  $dbItems = findAllItems($pageTable);

  $pageTitle = "Loans";

  include(SHARED_PATH."/header.php");
?>

<!-- Html and PHP that shows all the fields of a Database
     table.
     This code can be highly customized to suit your needs. -->
<h1><abbr title="Lunsford County Public Library">LCPL</abbr> Books</h1>

  <!-- Goes to A page that can add a record to database -->
  <a href="<?php echo urlFor("loans/new.php");?>">Add Loan</a>

<table>
  <tr>
    <!-- Heading for each database -->
    <th>Loan ID</th>
    <th>Book Title</th>
    <th colspan="2">Member Name</th>
    <th>Checkout Date</th>
    <th>Due Date</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>

      <!-- While loop iterates the result set as an associative array.
      
      You'll need to be customize this code a lot based on
      Schema of your database-->
      <?php while($item = mysqli_fetch_assoc($dbItems)) { ?>
        <tr>
          <td><?php echo h($item['Loan_ID']) ?></td>
          <td><?php echo h($item['Title']) ?></td>
          <td><?php echo h($item['FirstName']) ?></td>
          <td><?php echo h($item['LastName']) ?></td>
          <td><?php echo h($item['CheckoutDate']) ?></td>
          <td><?php echo h($item['DueDate']) ?></td>
          <!-- Links to Crud Operations -->
          <td><a href="<?php echo urlFor('/loans/show.php?id='.h(u($item['Loan_ID']))); ?>">View</a></td>
          <td><a href="<?php echo urlFor('/loans/edit.php?id='.h(u($item['Loan_ID']))); ?>">Edit</a></td>
          <td><a href="<?php echo urlFor('/loans/delete.php?id='.$item['Loan_ID']);?>">Delete</a></td>
    	  </tr>
      <?php
        }
        mysqli_free_result($dbItems);
      ?>
  	</table>

<?php include(SHARED_PATH."/footer.php"); ?>
