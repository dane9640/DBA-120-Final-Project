<?php
  require("../../private/initialize.php");

  //Database table associated with page
  $pageTable = "Members";
  //Query to find all items from the associated table
  $dbItems = findAllItems($pageTable);

  $pageTitle = "Members";

  include(SHARED_PATH."/header.php");
?>

<!-- Html and PHP that shows all the fields of a Database
     table.
     This code can be highly customized to suit your needs. -->
<h1><abbr title="Lunsford County Public Library">LCPL</abbr> Books</h1>

  <!-- Goes to A page that can add a record to database -->
  <a href="<?php echo urlFor("members/new.php");?>">Add Member</a>

<table>
  <tr>
    <!-- Heading for each database -->
    <th>Member ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Phone Number</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>

      <!-- While loop iterates the result set as an associative array.
      
      You'll need to be customize this code a lot based on
      Schema of your database-->
      <?php while($item = mysqli_fetch_assoc($dbItems)) { ?>
        <tr>
          <td><?php echo h($item['Member_ID']) ?></td>
          <td><?php echo h($item['FirstName']) ?></td>
          <td><?php echo h($item['LastName']) ?></td>
          <td><?php echo h($item['Email']) ?></td>
          <td><?php echo h($item['PhoneNumber']) ?></td>
          <!-- Links to Crud Operations -->
          <td><a href="<?php echo urlFor('/members/show.php?id='.h(u($item['Member_ID']))); ?>">View</a></td>
          <td><a href="<?php echo urlFor('/members/edit.php?id='.h(u($item['Member_ID']))); ?>">Edit</a></td>
          <td><a href="<?php echo urlFor('/members/delete.php?id='.$item['Member_ID']);?>">Delete</a></td>
    	  </tr>
      <?php
        }
        mysqli_free_result($dbItems);
      ?>
  	</table>

<?php include(SHARED_PATH."/footer.php"); ?>
