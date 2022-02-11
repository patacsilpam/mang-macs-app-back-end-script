<?php
require 'database/connection.php';
$orderId ="";
$productCode = $_POST['productCode'];
$orderDate = $_POST['orderDate'];
$requiredDate = $_POST['requiredDate'];
$requiredTime = $_POST['requiredTime'];
$customerName = $_POST['customerName'];
$address = $_POST['customer_address'];
$labelAddreess = $_POST['labelAddress'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$product = $_POST['product'];
$variation = $_POST['variation'];
$quantity = $_POST['quantity'];
$add_ons = $_POST['addOns'];
$price = $_POST['price'];
$subTotal = $_POST['subTotal'];
$totalAmount = $_POST['totalAmount'];
$paymentPhoto = $_POST['paymentPhoto'];
$imgProduct= $_POST['imgProduct'];
$orderType = $_POST['orderType'];
$orderStatus = $_POST['orderStatus'];
$response = array();
//insert orders
$insertOrders = $connect->prepare("INSERT INTO tblorders(order_id,product_code,ordered_date,required_date,required_time,customer_name,customer_address,label_address,email,phone_no,product,variation,quantity,add_ons,price,subtotal,total_amount,payment_photo,img_product,order_type,order_status)
 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$insertOrders->bind_param('isssssssssssisiiissss', $orderId,$productCode,$orderDate,$requiredDate,$requiredTime,$customerName,$address,$labelAddreess,$email,$phoneNumber,$product,$variation,$quantity,$add_ons,$price,$subTotal,$totalAmount,$paymentPhoto,$imgProduct,$orderType,$orderStatus);
$insertOrders->execute();
if($insertOrders){
    $cartStatus = "ordered";
    $updateCart = $connect->prepare("UPDATE cart SET cart_status=? WHERE email=?");
    $updateCart->bind_param('ss',$cartStatus,$email);
    $updateCart->execute();
    if($updateCart){
        $response['success'] = "1";
    }
}
echo json_encode($response);

?>