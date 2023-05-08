<?php

  /**
   * Executes a query to find all items from a
   * database
   *
   * @param String $table Table to get the items from
   *
   * @return mysqli_result Results from the sql query
   */
  function findAllItems($table) {
    global $db;

    if($table === "Books") {
      $sql = "SELECT books.Book_ID, books.Title, authors.FirstName, authors.LastName, genres.Name, genres.Description FROM $table ";
      $sql .= "INNER JOIN authors ON books.Author_ID = authors.Author_ID ";
      $sql .= "INNER JOIN genres ON books.Genre_ID = genres.Genre_ID ";
      $sql .= "ORDER BY Title ASC";
    } else if($table === "Loans") {
      $sql = "SELECT books.Title, members.FirstName, members.LastName, loans.CheckoutDate, loans.DueDate, loans.Loan_ID FROM $table ";
      $sql .= "INNER JOIN books ON loans.Book_ID = books.Book_ID ";
      $sql .= "INNER JOIN members ON loans.Member_ID = members.Member_ID ";
      $sql .= "ORDER BY CheckoutDate ASC";
    } else {
      $sql = "SELECT * FROM $table ";
    }

    $result = mysqli_query($db, $sql);

    return $result;
  }

  function findItemByID($table, $id){
    global $db;

    if($table === "Books") {
      $sql = "SELECT * FROM $table ";
      $sql .= "WHERE books.Book_ID='".$id."'";
    } else if ($table === "Genres"){
      $sql = "SELECT * FROM $table ";
      $sql .= "WHERE genres.Genre_ID='".$id."'";
    } else if ($table === "Authors"){
      $sql = "SELECT * FROM $table ";
      $sql .= "WHERE authors.Author_ID='".$id."'";
    } else if ($table === "Members"){
      $sql = "SELECT * FROM $table ";
      $sql .= "WHERE members.Member_ID='".$id."'";
    } else if ($table === "Loans"){
      $sql = "SELECT * FROM $table ";
      $sql .= "WHERE loans.Loan_ID='".$id."'";
    } else {
      $sql = "SELECT * FROM $table ";
    }

    $result = mysqli_query($db, $sql);

    return $result;
  }

  function findItemByIDJoined($table, $id){
    global $db;

    if($table === "Books") {
      $sql = "SELECT books.Book_ID, books.Title, authors.FirstName, authors.LastName, genres.Name FROM $table ";
      $sql .= "INNER JOIN authors ON books.Author_ID = authors.Author_ID ";
      $sql .= "INNER JOIN genres ON books.Genre_ID = genres.Genre_ID ";
      $sql .= "WHERE books.Book_ID='".$id."'";

    } else if($table === "Loans") {
      $sql = "SELECT books.Book_ID, books.Title, members.FirstName, members.LastName, members.Member_ID, loans.CheckoutDate, loans.DueDate, loans.Loan_ID FROM $table ";
      $sql .= "INNER JOIN books ON loans.Book_ID = books.Book_ID ";
      $sql .= "INNER JOIN members ON loans.Member_ID = members.Member_ID ";
      $sql .= "WHERE loans.Loan_ID='".$id."'";
    } else {
      $sql = "SELECT * FROM $table ";
    }

    $result = mysqli_query($db, $sql);

    $result = mysqli_fetch_assoc($result);
    return $result;
  }

  function addItem($table, $item){
    global $db;

    if ($table === "Books"){
      $sql = "INSERT INTO $table ";
      $sql .= "(Title, Author_ID, Genre_ID) ";
      $sql .= "VALUES (";
      $sql .= "'".$item['Title']."',";
      $sql .= "'".$item['Author']."',";
      $sql .= "'".$item['Genre']."'";
      $sql .= ")";

    } else if ($table ==="Genres"){
      $sql = "INSERT INTO $table ";
      $sql .= "(Name, Description) ";
      $sql .= "VALUES (";
      $sql .= "'".$item['Name']."',";
      $sql .= "'".$item['Description']."'";
      $sql .= ")";

    } else if ($table ==="Authors"){
      $sql = "INSERT INTO $table ";
      $sql .= "(FirstName, LastName) ";
      $sql .= "VALUES (";
      $sql .= "'".$item['FirstName']."',";
      $sql .= "'".$item['LastName']."'";
      $sql .= ")";

    } else if ($table ==="Members"){
      $sql = "INSERT INTO $table ";
      $sql .= "(FirstName, LastName, Email, PhoneNumber) ";
      $sql .= "VALUES (";
      $sql .= "'".$item['FirstName']."',";
      $sql .= "'".$item['LastName']."',";
      $sql .= "'".$item['Email']."',";
      $sql .= "'".$item['PhoneNumber']."'";
      $sql .= ")";

    } else if ($table ==="Loans"){
      $sql = "INSERT INTO $table ";
      $sql .= "(Book_ID, Member_ID, CheckoutDate, DueDate) ";
      $sql .= "VALUES (";
      $sql .= "'".$item['Book_ID']."',";
      $sql .= "'".$item['Member_ID']."',";
      $sql .= "'".$item['CheckoutDate']."',";
      $sql .= "DATE_ADD('".$item['CheckoutDate']."', INTERVAL 1 MONTH)";
      $sql .= ")";
    } else {
      $sql = "INSERT INTO $table ";
    }

    $result = mysqli_query($db, $sql);
    
    if ($result){
      return $result;
    } else {
      echo mysqli_error($db);
      dbDisconnect($db);
    }
    
  }

  function deleteItem($table, $item){
    global $db;

    if($table === "Books"){
      $sql = "DELETE FROM $table ";
      $sql .= "WHERE Book_ID='".$item['Book_ID']."' ";
      $sql .= "LIMIT 1";
      
    } else if($table === "Genres") {
      $sql = "DELETE FROM $table ";
      $sql .= "WHERE Genre_ID='".$item['Genre_ID']."' ";
      $sql .= "LIMIT 1";

    } else if($table === "Authors") {
      $sql = "DELETE FROM $table ";
      $sql .= "WHERE Author_ID='".$item['Author_ID']."' ";
      $sql .= "LIMIT 1";

    } else if($table === "Members") {
      $sql = "DELETE FROM $table ";
      $sql .= "WHERE Member_ID='".$item['Member_ID']."' ";
      $sql .= "LIMIT 1";

    } else if($table === "Loans") {
      $sql = "DELETE FROM $table ";
      $sql .= "WHERE Loan_ID='".$item['Loan_ID']."' ";
      $sql .= "LIMIT 1";

    } else {
      $sql = "DELETE FROM $table ";
      $sql .= "WHERE id='".$item['id']."' ";
      $sql .= "LIMIT 1";
    }

    $result = mysqli_query($db, $sql);
    if($result){
      return $result;
    } else {
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  }

  function editItem($table, $item){
    global $db;

    if($table === "Books"){
      $sql = "UPDATE books SET ";
      $sql .= "Title='".$item['Title']."',";
      $sql .= "Author_ID='".$item['Author']."',";
      $sql .= "Genre_ID='".$item['Genre']."' ";
      $sql .= "WHERE Book_ID='".$item['Book_ID']."' ";
      $sql .= "LIMIT 1";

    } else if ($table === "Genres") {
      $sql = "UPDATE $table SET ";
      $sql .= "Name='".$item['Name']."',";
      $sql .= "Description='".$item['Description']."' ";
      $sql .= "WHERE Genre_ID='".$item['Genre_ID']."' ";
      $sql .= "LIMIT 1";

    } else if ($table === "Authors") {
      $sql = "UPDATE $table SET ";
      $sql .= "FirstName='".$item['FirstName']."',";
      $sql .= "LastName='".$item['LastName']."' ";
      $sql .= "WHERE Author_ID='".$item['Author_ID']."' ";
      $sql .= "LIMIT 1";

    } else if ($table === "Members") {
      $sql = "UPDATE $table SET ";
      $sql .= "FirstName='".$item['FirstName']."',";
      $sql .= "LastName='".$item['LastName']."', ";
      $sql .= "Email='".$item['Email']."', ";
      $sql .= "PhoneNumber='".$item['PhoneNumber']."' ";
      $sql .= "WHERE Member_ID='".$item['Member_ID']."' ";
      $sql .= "LIMIT 1";

    } else if ($table === "Loans") {
      $sql = "UPDATE $table SET ";
      $sql .= "Loan_ID='".$item['Loan_ID']."',";
      $sql .= "Book_ID='".$item['Book_ID']."', ";
      $sql .= "Member_ID='".$item['Member_ID']."',";
      $sql .= "CheckoutDate='".$item['CheckoutDate']."',";
      $sql .= "DueDate=DATE_ADD('".$item['CheckoutDate']."', INTERVAL 1 MONTH) ";
      $sql .= "WHERE Member_ID='".$item['Member_ID']."' ";
      $sql .= "LIMIT 1";

    }

    $result = mysqli_query($db, $sql);
    if ($result){
      return $result;
    } else {
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  }

?>