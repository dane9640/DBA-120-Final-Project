<?php
  require_once("../../private/initialize.php");
  $table = "Genres";
  
  $id = $_GET['id'];
  $genreID = mysqli_fetch_assoc(findItemByID($table,$id))['Genre_ID'];
  
  $pageTitle = "Genres | Edit";
  
  if(isPostRequest()){
    $genre = array('Genre_ID'=>$genreID,'Name'=>$_POST['name'],'Description'=>$_POST['description']);
    
    $result = editItem($table, $genre);
    
    if($result){
      redirectTo(urlFor("/genres/show.php?id=".$genreID));
    }else{
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  } 
  else {
    $genre = mysqli_fetch_assoc(findItemByID($table, $id));
  }

  include(SHARED_PATH."/header.php");
?>

<h1>Edit Genre</h1>
<form action="<?php echo urlFor("/genres/edit.php?id=".h(u($id)));?>" method="post">
  <label for="name">Genre Name:</label>
  <input type="text" name="name" id="name" value="<?php echo $genre["Name"];?>">

  <label for="description">Genre Description:</label>
  <input type="text" name="description" id="description" value="<?php echo $genre["Description"];?>">

  <input type="submit" value="Edit Book">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>
