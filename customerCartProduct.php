<?php

require 'database/connection.php';
$id = NULL;
$email = $_POST['email'];
$productCode = $_POST['code'];
$productName = $_POST['product'];
$productCategory = $_POST['productCategory'];
$imgProduct = $_POST['imageProduct'];
$variation = $_POST['variation'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$price = $_POST['price'];
$quantity =$_POST['quantity'];
$add_ons = $_POST['addOns'];
$addOnsFee = $_POST['addOnsFee'];
$specialRequest = $_POST['specialRequest'];
$cartStatus = "Not ordered";
$preparedTime = $_POST['preparedTime'];
$response = array();

$getCode = $connect->prepare("SELECT productCode,quantity FROM cart WHERE productCode=? AND email=? AND cart_status='Not Ordered'");
$getCode->bind_param('ss',$productCode,$email);
$getCode->execute();
$getCode->store_result();
$getCode->bind_result($code,$add);
if($getCode->num_rows>0){
   $getCode->fetch();
   if($code == $productCode){ 
    $add = 0;
    $addQuantity = $add + $quantity;
    $updateQuantity=$connect->prepare("UPDATE cart SET quantity=?,add_ons=?,add_ons_fee=? WHERE productCode=? AND email=? AND cart_status='Not Ordered'");
    $updateQuantity->bind_param('issis',$addQuantity,$add_ons,$addOnsFee,$productCode,$email);
    $updateQuantity->execute();
    if($updateQuantity){
        $response['success'] = "1";
    }
  }
}
else{
    $insertCart = $connect->prepare("INSERT INTO cart(id,email,productCode,productName,productCategory,variation,fname,lname,price,quantity,add_ons,add_ons_fee,special_request,imageProduct,cart_status,preparation_time) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $insertCart->bind_param('isssssssiisisssi',$id,$email,$productCode,$productName,$productCategory,$variation,$fname,$lname,$price,$quantity,$add_ons,$addOnsFee,$specialRequest,$imgProduct,$cartStatus,$preparedTime);
    $insertCart->execute();
    if($insertCart){
        $response['success'] = "1";
        
    }
}
echo json_encode($response);
?>