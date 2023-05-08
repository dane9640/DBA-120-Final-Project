<?php
  require("../../private/initialize.php");

  //Database table associated with page
  $pageTable = "Genres";
  //Query to find all items from the associated table
  $dbItems = findAllItems($pageTable);

  $pageTitle = "Genres";

  include(SHARED_PATH."/header.php");
?>

<!-- Html and PHP that shows all the fields of a Database
     table.
     This code can be highly customized to suit your needs. -->
<h1><abbr title="Lunsford County Public Library">LCPL</abbr> Books</h1>

  <!-- Goes to A page that can add a record to database -->
  <a href="<?php echo urlFor("genres/new.php");?>">Add Genre</a>

<table>
  <tr>
    <!-- Heading for each database -->
    <th>Genre ID</th>
    <th>Genre Name</th>
    <th>Genre Description</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>

      <!-- While loop iterates the result set as an associative array.
      
      You'll need to be customize this code a lot based on
      Schema of your database-->
      <?php while($item = mysqli_fetch_assoc($dbItems)) { ?>
        <tr>
          <td><?php echo h($item['Genre_ID']) ?></td>
          <td><?php echo h($item['Name']) ?></td>
          <td><?php echo h($item['Description']) ?></td>
          <!-- Links to Crud Operations -->
          <td><a href="<?php echo urlFor('/genres/show.php?id='.h(u($item['Genre_ID']))); ?>">View</a></td>
          <td><a href="<?php echo urlFor('/genres/edit.php?id='.h(u($item['Genre_ID']))); ?>">Edit</a></td>
          <td><a href="<?php echo urlFor('/genres/delete.php?id='.$item['Genre_ID']);?>">Delete</a></td>
    	  </tr>
      <?php
        }
        mysqli_free_result($dbItems);
      ?>
  	</table>

<?php include(SHARED_PATH."/footer.php"); ?>
