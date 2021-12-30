<?php
error_reporting(0);
require 'database/connection.php';
$myemail = $_POST["email"];
$mypassword = $_POST["currentPassword"];
$newPassword = $_POST['newPassword'];
$pwordHash  = password_hash($newPassword,PASSWORD_DEFAULT);
$query = $connect->prepare("SELECT user_password FROM tblcustomers WHERE email_address=?");
$query->bind_param('s',$myemail);
$query->execute();
$query->store_result();
$query->bind_result($userpassword);
if($query->num_rows == 1){
  $query->fetch();
  if(password_verify($mypassword,$userpassword)){
    $updatePword = $connect->prepare("UPDATE tblcustomers SET user_password=? WHERE email_address=?");
    $updatePword->bind_param('ss',$pwordHash,$myemail);
    $updatePword->execute();
    if($updatePword){
      $response['success'] = "1";
      $response['message'] = "Update Successfully";
    }
  }
  else {
    $response['success'] = "0";
    $response['message'] = "Incorrect password";
  }
}  
else {
  $response['success'] = "0";
  $response['message'] = "Failed";
}
echo json_encode($response);
mysqli_close($connect);
?>