<?php
error_reporting(0);
require_once 'database/connection.php';
$email = $_GET['email'];
$code = $_GET['code'];
$verifyCode = $connect->prepare("SELECT code FROM tblcustomers WHERE email_address=?");
$verifyCode->bind_param('s',$email);
$verifyCode->execute();
$verifyCode->store_result();
$verifyCode->bind_result($userCode);
$response = array();
if($verifyCode->num_rows == 1){
    $verifyCode->fetch();
    if($code == $userCode){
        $changeCode = 0;
        $updateCode = $connect->prepare("UPDATE tblcustomers SET code=? WHERE email_address=?");
        $updateCode->bind_param('is',$changeCode,$email);
        $updateCode->execute();
        if($updateCode){
            $response['success'] = "1";
        }

    }
    else{
        $response['success'] = "0";
        $response['message'] = "Incorrect code";
    }
}
else{
    $response['success'] = "0";
    $response['message'] = "Incorrect code";
}
echo json_encode($response);
?>