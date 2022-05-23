<?php
require_once 'database/connection.php';
$id = $_GET['id'];
$response = array();
$orderStatus = "Cancelled";
$deleteAddress = $connect->prepare("UPDATE cart SET cart_status=? WHERE id=?");
$deleteAddress->bind_param('si',$orderStatus,$id);
$deleteAddress->execute();
if($deleteAddress){
    $response['success'] = "1";
}
else{
    $response['success'] = "0";
    $response['message'] = "Error";
}
echo json_encode($response);
?>