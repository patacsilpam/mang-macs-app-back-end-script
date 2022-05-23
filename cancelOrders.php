<?php
require 'database/connection.php';
$id = $_POST['id'];
$orderStatus = "Cancelled";
$deleteOrder = $connect->prepare("UPDATE tblorderdetails SET order_status=? WHERE id=?");
$deleteOrder->bind_param('ss',$orderStatus,$id);
$deleteOrder->execute();
$response = array();
if($deleteOrder){
    $response['success'] = "1";
}
echo json_encode($response);
?>