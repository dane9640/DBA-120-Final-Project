<?php
  require_once("../../private/initialize.php");
  $table = "Authors";

  if(!isset($_GET['id'])){
    redirectTo(urlFor('authors/index.php'));
  }
  $id = $_GET['id'];

  $author = mysqli_fetch_assoc(findItemByID($table,$id));
  
  if(isPostRequest()){
    $result = deleteItem($table, $author);
    if($result){
      redirectTo(urlFor('authors/index.php'));
    } else {
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  }

  $pageTitle = "Author | Delete";

  include(SHARED_PATH."/header.php");
?>

<div id="content">

  <a class="back-link" href="<?php echo urlFor('authors/index.php'); ?>">&laquo; Back to List</a>

  <div>
    <h1>Delete Author</h1>
    <p>Are you sure you want to delete this Author?</p>
    <p class="item"><?php echo h($author['FirstName'])." ".h($author["LastName"]); ?></p>

    <form action="<?php echo urlFor('authors/delete.php?id=' . h(u($author['Author_ID']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Author">
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH."/footer.php"); ?>
