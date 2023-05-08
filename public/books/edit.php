<?php
  require_once("../../private/initialize.php");
  $table = "Books";
  $genres = findAllItems("genres");
  $authors = findAllItems("authors");
  
  $id = $_GET['id'];
  $bookID = mysqli_fetch_assoc(findItemByID($table,$id))['Book_ID'];
  
  $pageTitle = "Books | Edit";
  
  if(isPostRequest()){
    $book = array('Book_ID'=>$bookID,'Title'=>$_POST['title'],'Genre'=>$_POST['genre'],'Author'=>$_POST['author']);
    
    $result = editItem($table, $book);
    
    if($result){
      redirectTo(urlFor("/books/show.php?id=".$bookID));
    }else{
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  } 
  else {
    $book = findItemByIDJoined($table, $id);
  }

  include(SHARED_PATH."/header.php");
?>

<h1>Edit </h1>
<form action="<?php echo urlFor("/books/edit.php?id=".h(u($id)));?>" method="post">
  <label for="title">Book Title:</label>
  <input type="text" name="title" id="title" value="<?php echo $book["Title"];?>">
  
  <label for="genre">Genre:</label>
  <select name="genre" id="genre">
    <?php while($genre = mysqli_fetch_assoc($genres)){ ?>
      <option value="<?php echo $genre["Genre_ID"];?>" <?php echo ($book['Name']==$genre["Name"]) ? 'selected' :'' ?>><?php echo $genre["Genre_ID"]."-".$genre["Name"];?></option>
    <?php } ?>
  </select>
  <select name="author" id="author">
    <?php while($author = mysqli_fetch_assoc($authors)){ ?>
      <option value="<?php echo $author["Author_ID"];?>" <?php echo ($book['FirstName']==$author['FirstName'] && $book['LastName']==$author['LastName']) ? 'selected' : ''?>><?php echo $author["Author_ID"]."-".$author["FirstName"]." ".$author["LastName"];?></option>
    <?php } ?>
  </select>

  <input type="submit" value="Edit Book">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>
