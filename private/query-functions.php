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
      $sql = "SELECT Books.Book_ID, Books.Title, Authors.FirstName, Authors.LastName, Genres.Name, Genres.Description FROM $table ";
      $sql .= "INNER JOIN Authors ON Books.Author_ID = Authors.Author_ID ";
      $sql .= "INNER JOIN Genres ON Books.Genre_ID = Genres.Genre_ID ";
      $sql .= "ORDER BY Title ASC";
    } else if($table === "Loans") {
      $sql = "SELECT Books.Title, Members.FirstName, Members.LastName, Loans.CheckoutDate, Loans.DueDate, Loans.Loan_ID FROM $table ";
      $sql .= "INNER JOIN Books ON Loans.Book_ID = Books.Book_ID ";
      $sql .= "INNER JOIN Members ON Loans.Member_ID = Members.Member_ID ";
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
      $sql .= "WHERE Books.Book_ID='".$id."'";
    } else if ($table === "Genres"){
      $sql = "SELECT * FROM $table ";
      $sql .= "WHERE Genres.Genre_ID='".$id."'";
    } else if ($table === "Authors"){
      $sql = "SELECT * FROM $table ";
      $sql .= "WHERE Authors.Author_ID='".$id."'";
    } else if ($table === "Members"){
      $sql = "SELECT * FROM $table ";
      $sql .= "WHERE Members.Member_ID='".$id."'";
    } else if ($table === "Loans"){
      $sql = "SELECT * FROM $table ";
      $sql .= "WHERE Loans.Loan_ID='".$id."'";
    } else {
      $sql = "SELECT * FROM $table ";
    }

    $result = mysqli_query($db, $sql);

    return $result;
  }

  function findItemByIDJoined($table, $id){
    global $db;

    if($table === "Books") {
      $sql = "SELECT Books.Book_ID, Books.Title, Authors.FirstName, Authors.LastName, Genres.Name FROM $table ";
      $sql .= "INNER JOIN Authors ON Books.Author_ID = Authors.Author_ID ";
      $sql .= "INNER JOIN Genres ON Books.Genre_ID = Genres.Genre_ID ";
      $sql .= "WHERE Books.Book_ID='".$id."'";

    } else if($table === "Loans") {
      $sql = "SELECT Books.Book_ID, Books.Title, Members.FirstName, Members.LastName, Members.Member_ID, Loans.CheckoutDate, Loans.DueDate, Loans.Loan_ID FROM $table ";
      $sql .= "INNER JOIN Books ON Loans.Book_ID = Books.Book_ID ";
      $sql .= "INNER JOIN Members ON Loans.Member_ID = Members.Member_ID ";
      $sql .= "WHERE Loans.Loan_ID='".$id."'";
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