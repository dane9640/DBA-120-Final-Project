<?php
  require_once("../../private/initialize.php");


  $pageTitle = "Add Book";

  $genres = findAllItems("Genres");
  $authors = findAllItems("Authors");

  include(SHARED_PATH."/header.php");
?>

<h1>Add new book</h1>

<!-- Back to page -->
<a href="<?php echo urlFor("books/index.php");?>">Back to List</a>

<!-- Form to add a record to the database,
     You need to be customize this to fit the needs
     of the schema
    
    Need to update your create.php file as well.-->
<form action="<?php echo urlFor("books/create.php");?>" method="post">
  <label for="title">Book Title:</label>
  <input type="text" name="title" id="title">
  
  <label for="genre">Genre:</label>
  <select name="genre" id="genre">
    <?php while($genre = mysqli_fetch_assoc($genres)){ ?>
      <option value="<?php echo $genre["Genre_ID"];?>"><?php echo $genre["Genre_ID"]."-".$genre["Name"];?></option>
    <?php } ?>
  </select>
  <select name="author" id="author">
    <?php while($author = mysqli_fetch_assoc($authors)){ ?>
      <option value="<?php echo $author["Author_ID"];?>"><?php echo $author["Author_ID"]."-".$author["FirstName"]." ".$author["LastName"];?></option>
    <?php } ?>
  </select>

  <input type="submit" value="Add Book">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>