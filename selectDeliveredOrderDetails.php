<?php
require 'database/connection.php';
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$orderNumber = mysqli_real_escape_string($connect,$_GET['orderNumber']);
$selectNewOrders = $connect->query("SELECT tblcustomerorder.customer_name,tblcustomerorder.customer_address,
 tblcustomerorder.label_address,tblcustomerorder.email,tblcustomerorder.phone_number, 
 tblcustomerorder.payment_photo,tblorderdetails.order_number,tblorderdetails.id,
 tblorderdetails.recipient_name,tblorderdetails.product_name, tblorderdetails.product_variation, tblorderdetails.product_category,
 tblorderdetails.price,tblorderdetails.quantity,tblorderdetails.add_ons,tblorderdetails.add_ons_fee,tblorderdetails.special_request,
 tblorderdetails.product_image,tblorderdetails.order_type,tblorderdetails.order_status,tblorderdetails.product_code,tblorderdetails.preparation_time,
 (SELECT SUM(tblorderdetails.price * tblorderdetails.quantity) + SUM(tblorderdetails.add_ons_fee * tblorderdetails.quantity)
 FROM tblorderdetails WHERE order_number='$orderNumber') as 'total_amount' 
 FROM tblorderdetails LEFT JOIN tblcustomerorder ON tblcustomerorder.order_number = tblorderdetails.order_number 
 WHERE tblcustomerorder.email='$emailAddress' AND tblorderdetails.order_number='$orderNumber'");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>