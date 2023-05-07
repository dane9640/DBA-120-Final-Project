<?php
  require_once("../../private/initialize.php");
  $table = "loans";

  if(!isset($_GET['id'])){
    redirectTo(urlFor('loans/index.php'));
  }
  $id = $_GET['id'];

  $loan = findItemByIDJoined($table,$id);
  
  if(isPostRequest()){
    $result = deleteItem($table, $loan);
    if($result){
      redirectTo(urlFor('loans/index.php'));
    } else {
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  }

  $pageTitle = "Loans | Delete";

  include(SHARED_PATH."/header.php");
?>

<div id="content">

  <a class="back-link" href="<?php echo urlFor('loans/index.php'); ?>">&laquo; Back to List</a>

  <div>
    <h1>Delete Loan</h1>
    <p>Are you sure you want to delete this Loan?</p>
    <p class="item">ID: <?php echo h($loan['Loan_ID']); ?></p>
    <p class="item">Book Title: <?php echo h($loan['Title']); ?></p>
    <p class="item">Member Name: <?php echo h($loan['FirstName'])." ".h($loan['LastName']); ?></p>

    <form action="<?php echo urlFor('loans/delete.php?id=' . h(u($loan['Loan_ID']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Loan">
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH."/footer.php"); ?>
