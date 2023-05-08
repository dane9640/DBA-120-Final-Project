<?php
  require_once("../../private/initialize.php");
  $table = "Authors";

  if(isPostRequest()){
    $author = array('FirstName'=>$_POST['firstName'],'LastName'=>$_POST['lastName']);

    $result = addItem($table, $author);
    $newID = mysqli_insert_id($db);
    redirectTo(urlFor("authors/show.php?id=".$newID));
  }
