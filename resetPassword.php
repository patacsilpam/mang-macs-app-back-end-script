<?php
error_reporting(0);
require_once 'database/connection.php';
$email = $_POST['email'];
$newPword = $_POST['newPassword'];
$confirmPword = $_POST['confirmPassword'];
$pwordHash = password_hash($confirmPword,PASSWORD_DEFAULT);
$queryEmail = $connect->prepare("SELECT * FROM tblcustomers WHERE email_address=?");
$queryEmail->bind_param('s',$email);
$queryEmail->execute();
$queryEmail->store_result();
$response = array();
if($queryEmail->num_rows == 1){
    $resetPword = $connect->prepare("UPDATE tblcustomers SET user_password=? WHERE email_address=?");
    $resetPword->bind_param('ss',$pwordHash,$email);
    $resetPword->execute();
    if($resetPword){
        $response['success'] = "1";
    }
    else{
        $response['success'] = "0";
        $response['message'] = "Error";
    }
}
echo json_encode($response);
?>