<?php
require 'database/connection.php';
$id = $_POST['id'];
$deleteOrder = $connect->prepare("DELETE FROM tblorders WHERE order_id=?");
$deleteOrder->bind_param('i',$id);
$deleteOrder->execute();
$response = array();
if($deleteOrder){
    $response['success'] = "1";
}
echo json_encode($response);
?>