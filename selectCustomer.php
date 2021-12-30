<?php
error_reporting(0);
require 'database/connection.php';
$myusername = $_GET["email_address"];
$query = $connect->prepare("SELECT id,customer_id,fname,lname,email_address,user_password,gender,birthdate FROM tblcustomers WHERE email_address=?");
$query->bind_param('s',$myusername);
$query->execute();
$query->store_result();
$query->bind_result($id,$customerID,$fname,$lname,$email,$pword,$gender,$birthdate);
$response = array();
if($query->num_rows == 1){
    $query->fetch();
      $response['success'] = "1";
      $response['message'] = "Login successfully";
      $response['customer_id'] = $customerID;
      $response['fname'] = $fname;
      $response['lname'] = $lname;
      $response['email_address'] = $email;
      $response['gender'] = $gender;
      $response['birthdate'] = $birthdate;
}  
echo json_encode($response);
mysqli_close($connect);
?>
