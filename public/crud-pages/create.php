<?php
  require_once("../../private/initialize.php");

  if(isPostRequest()){
    $salamander = array('name'=>$_POST['salamanderName'],'habitat'=>$_POST['habitat'],'description'=>$_POST['description']);

    $result = addItem($salamander);
    $newID = mysqli_insert_id($db);
    redirectTo(urlFor("salamanders/show.php?id=".$newID));
  }
