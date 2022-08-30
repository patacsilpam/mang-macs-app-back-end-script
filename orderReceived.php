<?php 
    require 'database/connection.php';
    $orderNumber = mysqli_real_escape_string($connect,$_GET['orderNumber']);
    $orderReceived = "Order Received";
    $response = array();
    $updateOrderStatus = $connect->prepare("UPDATE tblorderdetails SET order_status=? WHERE order_number=?");
    $updateOrderStatus->bind_param('ss',$orderReceived,$orderNumber);
    $updateOrderStatus->execute();
    if($updateOrderStatus){
        $response['success'] = "1";
    }
    echo json_encode($response);
?>