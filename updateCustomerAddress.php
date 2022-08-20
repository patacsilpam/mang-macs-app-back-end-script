<?php
require_once 'database/connection.php';
$id = $_POST['id'];
$fullname = $_POST['fullname'];
$barangay = $_POST['barangay'];
$street = $_POST['street'];
$phoneNumber = $_POST['phoneNumber'];
$labelAddress = $_POST['labelAddress'];

$updateAddress = $connect->prepare("UPDATE tbladdress SET fullname=?,street=?,barangay=?,label_address=?,phone_no=? WHERE id=?");
$updateAddress->bind_param('sssssi',$fullname,$street,$barangay,$labelAddress,$phoneNumber,$id);
$updateAddress->execute();
$response = array();
if($updateAddress->execute()){
    $response['success'] = "1";
}
else{
    $response['success'] = "0";
    $response['message'] = "Error";
}
echo json_encode($response);
?>