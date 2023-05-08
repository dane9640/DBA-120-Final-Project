<?php
  require_once("../../private/initialize.php");
  $table = "Books";

  if(isPostRequest()){
    $book = array('Title'=>$_POST['title'],'Genre'=>$_POST['genre'],'Author'=>$_POST['author']);

    $result = addItem($table, $book);
    $newID = mysqli_insert_id($db);
    redirectTo(urlFor("books/show.php?id=".$newID));
  }
