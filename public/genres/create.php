<?php
  require_once("../../private/initialize.php");
  $table = "genres";

  if(isPostRequest()){
    $genre = array('Name'=>$_POST['name'],'Description'=>$_POST['description']);

    $result = addItem($table, $genre);
    $newID = mysqli_insert_id($db);
    redirectTo(urlFor("genres/show.php?id=".$newID));
  }
