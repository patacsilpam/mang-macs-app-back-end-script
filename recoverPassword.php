<?php
error_reporting(0);
require_once 'database/connection.php';
$email = $_POST['email'];
$code = $_POST['code'];
$recoverPword = $connect->prepare("UPDATE tblcustomers SET code = ? WHERE email_address = ?");
$recoverPword->bind_param('is',$code,$email);
$recoverPword->execute();
$response = array();

if($recoverPword){
    $response['success'] = "1";
    $response['message'] = "Update Successfully";
}
else{
    $response['success'] = "0";
    $response['message'] = "Failed";
}
echo json_encode($response);
?>