<?php
require_once 'database/connection.php';
$id = $_GET['id'];
$response = array();
$deleteAddress = $connect->prepare("DELETE FROM cart WHERE id=?");
$deleteAddress->bind_param('i',$id);
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