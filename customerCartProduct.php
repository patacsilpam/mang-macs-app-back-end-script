<?php

require 'database/connection.php';
$id = NULL;
$email = $_POST['email'];
$productCode = $_POST['code'];
$productName = $_POST['product'];
$variation = $_POST['variation'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$price = $_POST['price'];
$quantity =$_POST['quantity'];
$add_ons = $_POST['add_ons'];
$response = array();

$getCode = $connect->prepare("SELECT productCode,quantity FROM cart WHERE productCode=? AND email=?");
$getCode->bind_param('ss',$productCode,$email);
$getCode->execute();
$getCode->store_result();
$getCode->bind_result($code,$add);
if($getCode->num_rows>0){
   $getCode->fetch();
   if($code == $productCode){
    $add = 0;
    $addQuantity = $add + $quantity;
    $updateQuantity=$connect->prepare("UPDATE cart SET quantity=? WHERE productCode=? AND email=?");
    $updateQuantity->bind_param('iss',$addQuantity,$productCode,$email);
    $updateQuantity->execute();
    if($updateQuantity){
        $response['success'] = "1";
    }
  }
}
else{
    $insertCart = $connect->prepare("INSERT INTO cart(id,email,productCode,productName,variation,fname,lname,price,quantity,add_ons) VALUES(?,?,?,?,?,?,?,?,?,?)");
    $insertCart->bind_param('issssssiis',$id,$email,$productCode,$productName,$variation,$fname,$lname,$price,$quantity,$add_ons);
    $insertCart->execute();
    if($insertCart){
        $response['success'] = "1";
    }
}
echo json_encode($response);
?>