<?php
require 'database/connection.php';
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$selectNewOrders = $connect->query("SELECT tblcustomerorder.*,tblorderdetails.* 
FROM tblorderdetails LEFT JOIN tblcustomerorder ON tblcustomerorder.order_number = tblorderdetails.order_number
WHERE tblorderdetails.order_status IN ('Order Completed','Order Received','Cancelled') 
AND tblorderdetails.order_type IN ('Pick Up','Deliver')
AND tblcustomerorder.email='$emailAddress' GROUP BY tblorderdetails.order_number
ORDER BY tblorderdetails.id DESC,
STR_TO_DATE(CONCAT(tblorderdetails.required_date,' ',tblorderdetails.required_time),'%Y-%m-%d %h:%i %p') ASC");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>