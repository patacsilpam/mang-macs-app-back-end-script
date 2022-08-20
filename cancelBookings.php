<?php
require 'database/connection.php';
$id = $_POST['id'];
$status = "Cancelled";
$deleteOrder = $connect->prepare("UPDATE tblreservation SET status=? WHERE id=?");
$deleteOrder->bind_param('si',$status,$id);
$deleteOrder->execute();
$response = array();
if($deleteOrder){
    $response['success'] = "1";
}
echo json_encode($response);
?>