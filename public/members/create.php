<?php
  require_once("../../private/initialize.php");
  $table = "members";

  if(isPostRequest()){
    $member = array('FirstName'=>$_POST['firstName'],'LastName'=>$_POST['lastName'], 'Email'=>$_POST['email'], 'PhoneNumber'=>$_POST['phoneNumber']);

    $result = addItem($table, $member);
    $newID = mysqli_insert_id($db);
    redirectTo(urlFor("members/show.php?id=".$newID));
  }
