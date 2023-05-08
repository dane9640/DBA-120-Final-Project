<?php
  require_once("../../private/initialize.php");
  $table = "Loans";
  
  $id = $_GET['id'];
  $loanID = mysqli_fetch_assoc(findItemByID($table,$id))['Loan_ID'];

  $books = findAllItems("books");
  $members = findAllItems("members");
  
  $pageTitle = "Loan | Edit";
  
  if(isPostRequest()){
    $loan = array('Loan_ID'=>$loanID,'Book_ID'=>$_POST['book'],'Member_ID'=>$_POST['member'], 'CheckoutDate'=>$_POST['checkoutDate']);
    
    $result = editItem($table, $loan);
    
    if($result){
      redirectTo(urlFor("/loans/show.php?id=".$id));
    }else{
      echo mysqli_error($db);
      dbDisconnect($db);
    }
  } 
  else {
    $loan = findItemByIDJoined($table, $id);
  }

  include(SHARED_PATH."/header.php");
?>

<h1>Edit Loan</h1>
<form action="<?php echo urlFor("loans/edit.php?id=".h($id));?>" method="post">
  <label for="book">Select Book:</label>
  <select name="book" id="book">
    <?php while($book = mysqli_fetch_assoc($books)){ ?>
      <option value="<?php echo $book["Book_ID"];?>" <?php echo ($book['Title']==$loan["Title"]) ? 'selected' :'' ?>><?php echo $book["Book_ID"]."-".$book["Title"];?></option>
    <?php } ?>
  </select>
  <label for="member">Select Member:</label>
  <select name="member" id="member">
    <?php while($member = mysqli_fetch_assoc($members)){ ?>
      <option value="<?php echo $member["Member_ID"];?>"<?php echo ($member['Member_ID']==$loan["Member_ID"]) ? 'selected' :'' ?>><?php echo $member["FirstName"]." ".$member["LastName"];?></option>
    <?php } ?>
  </select>
  <label for="checkoutDate">Date of checkout:</label>
  <input type="date" name="checkoutDate" id="checkoutDate" value="<?php echo h($loan["CheckoutDate"]);?>">
  <input type="submit" value="Edit Loan">
</form>

<?php include(SHARED_PATH."/footer.php"); ?>
