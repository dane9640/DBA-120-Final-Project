<?php
  require_once("../../private/initialize.php");
  $table = "Loans";

  if(isPostRequest()){
    $loan = array('Member_ID'=>$_POST['member'],'Book_ID'=>$_POST['book'], 'CheckoutDate'=>$_POST['checkoutDate']);

    $result = addItem($table, $loan);
    $newID = mysqli_insert_id($db);
    redirectTo(urlFor("loans/show.php?id=".$newID));
  }
