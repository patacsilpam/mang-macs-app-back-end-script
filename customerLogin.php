<?php
error_reporting(0);
require 'database/connection.php';
$myemail = $_GET["email_address"];
$mypassword = $_GET["user_password"];
$query = $connect->prepare("SELECT id,fname,lname,email_address,user_password,gender,user_status FROM tblcustomers WHERE email_address=?");
$query->bind_param('s',$myemail);
$query->execute();
$query->store_result();
$query->bind_result($id,$fname,$lname,$email,$pword,$gender,$status);

if($query->num_rows == 1){
    $query->fetch();
    if(password_verify($mypassword,$pword)){
      if($status == "verified"){
        $response['success'] = "1";
        $response['fname'] = $fname;
        $response['lname'] = $lname;
        $response['email_address'] = $email;
        $response['gender'] = $gender;
        //$reponse['user_password'] =  $query['user_password'];
      }
      else{
        $response['success'] = "2";
        $response['message'] = "Invalid account";
      }
    }
    else {
      $response['success'] = "0";
      $response['message'] = "Incorrect email or password";
    }
}  
else {
  $response['success'] = "0";
  $response['message'] = "Incorrect email or password";
}
echo json_encode($response);
mysqli_close($connect);
?>
