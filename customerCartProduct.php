<?php

require 'database/connection.php';
$id = NULL;
$customerId = $_POST['customerID'];
$productCode = $_POST['code'];
$productName = $_POST['product'];
$variation = $_POST['variation'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$price = $_POST['price'];
$quantity = 1;
$add_ons = $_POST['add_ons'];
$response = array();

$getCode = $connect->prepare("SELECT productCode,quantity FROM cart WHERE productCode=?");
$getCode->bind_param('s',$productCode);
$getCode->execute();
$getCode->store_result();
$getCode->bind_result($code,$add);
if($getCode->num_rows>0){
   $getCode->fetch();
   if($code == $productCode){
    $num = 1;
    $addQuantity = $add+$num;
    $updateQuantity=$connect->prepare("UPDATE cart SET quantity=? WHERE productCode=?");
    $updateQuantity->bind_param('is',$addQuantity,$productCode);
    $updateQuantity->execute();
    if($updateQuantity){
        $response['success'] = "1";
    }
   }
}
else{
    $insertCart = $connect->prepare("INSERT INTO cart(id,email,productCode,productName,variation,fname,lname,price,quantity,add_ons) VALUES(?,?,?,?,?,?,?,?,?,?)");
    $insertCart->bind_param('issssssiis',$id,$customerId,$productCode,$productName,$variation,$fname,$lname,$price,$quantity,$add_ons);
    $insertCart->execute();
    if($insertCart){
        $response['success'] = "1";
    }
}
  

echo json_encode($response);
?>