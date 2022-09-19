<?php
require 'database/connection.php';
date_default_timezone_set("Asia/Manila");
$time = date('h:i a');
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$selectNewOrders = $connect->query("SELECT DISTINCT(tblreservation.refNumber),tblreservation.id,tblreservation.fname,tblreservation.lname,tblreservation.guests,
tblreservation.email,tblreservation.created_at,DATE_FORMAT(tblreservation.scheduled_date,'%a,  %b %d, %Y') as 'scheduled_date',tblreservation.scheduled_time,
tblreservation.status,tblreservation.totalAmount,tblreservation.payment_photo,
tblorderdetails.product_code,tblorderdetails.product_name,tblorderdetails.product_category,tblorderdetails.product_code,
tblorderdetails.product_variation,tblorderdetails.quantity,tblorderdetails.price,tblorderdetails.add_ons,tblorderdetails.add_ons,
tblorderdetails.product_image,tblorderdetails.completed_time
FROM tblreservation LEFT JOIN tblorderdetails
ON tblreservation.refNumber = tblorderdetails.order_number
WHERE STR_TO_DATE(CONCAT(scheduled_date,' ', scheduled_time),'%Y-%m-%d %h:%i %p') >= DATE_SUB(CURDATE(), INTERVAL 30 MINUTE) 
AND tblreservation.status != 'Cancelled' GROUP BY tblreservation.refNumber
HAVING tblreservation.email='$emailAddress'");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;

}
echo json_encode($response);

?>
