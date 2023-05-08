<?php
  require_once("../../private/initialize.php");
  $table = "Members";
  
  $id = $_GET['id'];
  $memberID = mysqli_fetch_assoc(findItemByID($table,$id))['Member_ID'];
  
  $pageTitle = "Member | Edit";
  
  if(isPostRequest()){
    $member = array('Member_ID'=>$memberID,'FirstName'=>$_POST['firstName'],'LastName'=>$_POST['lastName'], 'Email'=>$_POST['email'], 'PhoneNumber'=>$_POST['phoneNumber']);
    
    $result = editItem($table, $member);
    
    if($result){
      redirectTo(urlFor("/members/show.php?id=".$id));
    }else{
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  } 
  else {
    $member = mysqli_fetch_assoc(findItemByID($table, $id));
  }

  include(SHARED_PATH."/header.php");
?>

<h1>Edit Member</h1>
<form action="<?php echo urlFor("members/edit.php?id=".h($memberID));?>" method="post">
  <label for="firstName">First Name:</label>
  <input type="text" name="firstName" id="firstName" value="<?php echo $member['FirstName'];?>">
  
  <label for="lastName">Last Name:</label>
  <input type="text" name="lastName" id="lastName" value="<?php echo $member['LastName'];?>">

  <label for="email">Email:</label>
  <input type="text" name="email" id="email" value="<?php echo $member['Email'];?>">

  <label for="phoneNumber">Phone Number:</label>
  <input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo $member['PhoneNumber'];?>">

  <input type="submit" value="Edit Member">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>
