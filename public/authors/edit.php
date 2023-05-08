<?php
  require_once("../../private/initialize.php");
  $table = "Authors";
  
  $id = $_GET['id'];
  $authorID = mysqli_fetch_assoc(findItemByID($table,$id))['Author_ID'];
  
  $pageTitle = "Author | Edit";
  
  if(isPostRequest()){
    $author = array('Author_ID'=>$authorID,'FirstName'=>$_POST['firstName'],'LastName'=>$_POST['lastName']);
    
    $result = editItem($table, $author);
    
    if($result){
      redirectTo(urlFor("/authors/show.php?id=".$id));
    }else{
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  } 
  else {
    $author = mysqli_fetch_assoc(findItemByID($table, $id));
  }

  include(SHARED_PATH."/header.php");
?>

<h1>Edit Author</h1>
<form action="<?php echo urlFor("/authors/edit.php?id=".h(u($id)));?>" method="post">
  <label for="firstName">First Name:</label>
  <input type="text" name="firstName" id="firstName" value="<?php echo $author["FirstName"];?>">

  <label for="lastName">Last Name:</label>
  <input type="text" name="lastName" id="lastName" value="<?php echo $author["LastName"];?>">

  <input type="submit" value="Edit Book">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>
