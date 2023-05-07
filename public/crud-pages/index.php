<?php
  require("../../private/initialize.php");

  //Database table associated with page
  $pageTable = "table";
  //Query to find all items from the associated table
  $dbItems = mysqli_query($db,"SELECT * FROM $pageTable");

  $pageTitle = "Page";

  include(SHARED_PATH."/header.php");
?>

<!-- Html and PHP that shows all the fields of a Database
     table.
     This code can be highly customized to suit your needs. -->
<h1>Page Heading</h1>

  <!-- Goes to A page that can add a record to database -->
  <a href="<?php echo urlFor("page/new.php");?>">Create Item</a>

<table>
  <tr>
    <!-- Heading for each database -->
    <th>Database</th>
    <th>Fields</th>
    <th>Here</th>
    <th></th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>

      <!-- While loop iterates the result set as an associative array.
      
      You'll need to be customize this code a lot based on
      Schema of your database-->
      <?php while($item = mysqli_fetch_assoc($dbItems)) { ?>
        <tr>
          <td><?php echo h($item['field']) ?></td>
          <td><?php echo h($item['field']) ?></td>
          <td><?php echo h($item['field']) ?></td>
          <td><?php echo h($item['field']) ?></td>
          <!-- Links to Crud Operations -->
          <td><a href="<?php echo urlFor('/page/show.php?id='.h(u($item['id']))); ?>">View</a></td>
          <td><a href="<?php echo urlFor('/page/edit.php?id='.h(u($item['id']))); ?>">Edit</a></td>
          <td><a href="<?php echo urlFor('/page/delete.php?id='.$item['id']);?>">Delete</a></td>
    	  </tr>
      <?php
        }
        mysqli_free_result($dbItems);
      ?>
  	</table>

<?php include(SHARED_PATH."/footer.php"); ?>
