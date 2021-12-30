<?php
require_once 'database/connection.php';
$id = $_POST['id'];
$deleteAddress = $connect->prepare("DELETE FROM tbladdress WHERE id=?");
$deleteAddress->bind_param('i',$id);
$deleteAddress->execute();
$response = array();
if($deleteAddress){
    $response['success'] = "1";
}
else{
    $response['success'] = "0";
    $response['message'] = "Error";
}
echo json_encode($response);
?>