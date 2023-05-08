<?php
  require_once("../../private/initialize.php");
  $table = "Books";

  if(!isset($_GET['id'])){
    redirectTo(urlFor('books/index.php'));
  }
  $id = $_GET['id'];

  $book = findItemByIDJoined($table,$id);
  
  if(isPostRequest()){
    $result = deleteItem($table, $book);
    if($result){
      redirectTo(urlFor('books/index.php'));
    } else {
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  }

  $pageTitle = "Books | Delete";

  include(SHARED_PATH."/header.php");
?>

<div id="content">

  <a class="back-link" href="<?php echo urlFor('books/index.php'); ?>">&laquo; Back to List</a>

  <div>
    <h1>Delete Book</h1>
    <p>Are you sure you want to delete this book?</p>
    <p class="item"><?php echo h($book['Title']); ?></p>

    <form action="<?php echo urlFor('books/delete.php?id=' . h(u($book['Book_ID']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete book">
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH."/footer.php"); ?>
