<?php
  require_once("../../private/initialize.php");
  $table = "members";

  if(!isset($_GET['id'])){
    redirectTo(urlFor('members/index.php'));
  }
  $id = $_GET['id'];

  $member = mysqli_fetch_assoc(findItemByID($table,$id));
  
  if(isPostRequest()){
    $result = deleteItem($table, $member);
    if($result){
      redirectTo(urlFor('members/index.php'));
    } else {
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  }

  $pageTitle = "Member | Delete";

  include(SHARED_PATH."/header.php");
?>

<div id="content">

  <a class="back-link" href="<?php echo urlFor('members/index.php'); ?>">&laquo; Back to List</a>

  <div>
    <h1>Delete Member</h1>
    <p>Are you sure you want to delete this Member?</p>
    <p class="item"><?php echo h($member['FirstName'])." ".h($member["LastName"]); ?></p>

    <form action="<?php echo urlFor('members/delete.php?id=' . h(u($member['Member_ID']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Member">
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH."/footer.php"); ?>
