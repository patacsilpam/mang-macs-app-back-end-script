<?php

require 'database/connection.php';
$id = $_POST['id'];
$quantity = $_POST['quantity'];
$getId = $connect->prepare("SELECT id FROM cart WHERE id=?");
$getId->bind_param('i',$id);
$getId->execute();
$getId->store_result();
$getId->bind_result($ids);
$response = array();
if($getId->num_rows==1){
    $getId->fetch();
    if($id==$ids){
        $updateQuantity=$connect->prepare("UPDATE cart SET quantity=? WHERE id=?");
        $updateQuantity->bind_param('ii',$quantity,$id);
        $updateQuantity->execute();
        $response = array();
        if($updateQuantity){
            $response['success'] = "1";
        }
    }
}
echo json_encode($response);
?>