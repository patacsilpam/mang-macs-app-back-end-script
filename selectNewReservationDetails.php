<?php
require 'database/connection.php';
date_default_timezone_set("Asia/Manila");
$time = date('h:i a');
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$orderNumber = mysqli_real_escape_string($connect,$_GET['orderNumber']);
$selectNewOrders = $connect->query("SELECT tblreservation.id,tblreservation.fname,tblreservation.lname,tblreservation.guests,
tblreservation.email,tblreservation.created_at,DATE_FORMAT(tblreservation.scheduled_date,'%a,  %b %d, %Y') as 'scheduled_date',tblreservation.scheduled_time,
tblreservation.status,tblreservation.totalAmount,tblreservation.payment_photo,
tblorderdetails.product_code,tblorderdetails.product_name,tblorderdetails.product_category,
tblorderdetails.product_variation,tblorderdetails.quantity,tblorderdetails.price,tblorderdetails.add_ons,
tblorderdetails.product_image,tblorderdetails.completed_time,tblorderdetails.preparation_time
FROM tblreservation LEFT JOIN tblorderdetails
ON tblreservation.refNumber = tblorderdetails.order_number
WHERE tblreservation.email='$emailAddress' AND tblreservation.refNumber='$orderNumber'");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;

}
echo json_encode($response);

?>
