<?php
require 'database/connection.php';
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$selectNewOrders = $connect->query("SELECT tblcustomerorder.*,tblorderdetails.* FROM tblorderdetails 
LEFT JOIN tblcustomerorder ON tblcustomerorder.order_number = tblorderdetails.order_number 
WHERE tblorderdetails.order_status='Pending' OR tblorderdetails.order_status='Order Processing' 
OR tblorderdetails.order_status='Ready for Pick Up' 
OR tblorderdetails.order_status='Out for Delivery'  GROUP BY tblorderdetails.order_number 
 HAVING tblcustomerorder.email='$emailAddress'
 ORDER BY STR_TO_DATE(CONCAT(tblorderdetails.required_date,' ',tblorderdetails.required_time),'%Y-%m-%d %h:%i %p') ASC");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>