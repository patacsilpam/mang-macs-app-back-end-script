<?php
error_reporting(0);
require_once 'database/connection.php';
$id = NULL;
$customerId = $_POST['customerID'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$street = $_POST['street'];
$barangay = $_POST['barangay'];
$city = $_POST['city'];
$province = $_POST['province'];
$labelAddress = $_POST['labelAddress'];
$phoneNo = $_POST['phoneNo'];
//insertion of customer address
$insertAddress = $connect->prepare("INSERT INTO tbladdress(id,customer_id,fullname,email,street,barangay,city,province,label_address,phone_no)
VALUES(?,?,?,?,?,?,?,?,?,?)");
$insertAddress->bind_param('isssssssss',$id,$customerId,$fullname,$email,$street,$barangay,$city,$province,$labelAddress,$phoneNo);
$insertAddress->execute();
$response = array();
if($insertAddress){
    $response['success'] = "1";
}else{
    $response['success'] = "0";
    $response['message'] = "Error";
}
echo json_encode($response);
?>