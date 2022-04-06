<?php
require 'database/connection.php';
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$orderNumber = mysqli_real_escape_string($connect,$_GET['orderNumber']);
$selectNewOrders = $connect->query("SELECT tblcustomerorder.customer_name,tblcustomerorder.customer_address,
 tblcustomerorder.label_address,tblcustomerorder.email,tblcustomerorder.phone_number, 
 tblcustomerorder.payment_photo,tblorderdetails.order_number,tblorderdetails.id,
 tblorderdetails.recipient_name,tblorderdetails.product_name, tblorderdetails.product_variation,
 tblorderdetails.price,tblorderdetails.quantity,tblorderdetails.add_ons,tblorderdetails.product_image, 
 tblorderdetails.order_type,tblorderdetails.order_status, 
 (SELECT SUM(tblorderdetails.price * tblorderdetails.quantity) 
 FROM tblorderdetails WHERE order_number='$orderNumber') as 'total_amount' 
 FROM tblorderdetails LEFT JOIN tblcustomerorder ON tblcustomerorder.order_number = tblorderdetails.order_number 
 WHERE tblcustomerorder.email='$emailAddress' AND tblorderdetails.order_number='$orderNumber'");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>