<?php
//error_reporting(0);
require_once 'database/connection.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email_address'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$update = $connect->prepare("UPDATE tblcustomers SET fname = ?, lname = ?, gender = ?, birthdate = ? WHERE email_address = ?");
$update->bind_param('sssss',$fname,$lname,$gender,$birthdate,$email);
$update->execute();
$response = array();
if($update){
    $response['success'] = "1";
    $response['message'] = "Update Successfully";
}
else{
    $response['success'] = "0";
    $response['message'] = "Error";
}
echo json_encode($response);
?>