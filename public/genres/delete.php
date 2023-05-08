<?php
  require_once("../../private/initialize.php");
  $table = "Genres";

  if(!isset($_GET['id'])){
    redirectTo(urlFor('genres/index.php'));
  }
  $id = $_GET['id'];

  $genre = mysqli_fetch_assoc(findItemByID($table,$id));
  
  if(isPostRequest()){
    $result = deleteItem($table, $genre);
    if($result){
      redirectTo(urlFor('genres/index.php'));
    } else {
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  }

  $pageTitle = "Genre | Delete";

  include(SHARED_PATH."/header.php");
?>

<div id="content">

  <a class="back-link" href="<?php echo urlFor('genres/index.php'); ?>">&laquo; Back to List</a>

  <div>
    <h1>Delete Genre</h1>
    <p>Are you sure you want to delete this book?</p>
    <p class="item"><?php echo h($genre['Name']); ?></p>

    <form action="<?php echo urlFor('genres/delete.php?id=' . h(u($genre['Genre_ID']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Genre">
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH."/footer.php"); ?>
