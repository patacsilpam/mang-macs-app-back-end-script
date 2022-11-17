<?php
require 'database/connection.php';
$id = $_POST['id'];
$status = "Cancelled";

$cancelBooking = $connect->prepare("UPDATE tblreservation SET status=? WHERE refNumber=?");
$cancelBooking->bind_param('si',$status,$id);
$cancelBooking->execute();
$response = array();
if($cancelBooking){
    $deleteOrder = $connect->prepare("UPDATE tblorderdetails SET order_status=? WHERE order_number=?");
    $deleteOrder->bind_param('si',$status,$id);
    $deleteOrder->execute();
    $response['success'] = "1";
}
echo json_encode($response);
?>