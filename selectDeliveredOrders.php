<?php
require 'database/connection.php';
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$selectNewOrders = $connect->query("SELECT tblcustomerorder.*,tblorderdetails.* 
FROM tblorderdetails LEFT JOIN tblcustomerorder ON tblcustomerorder.order_number = tblorderdetails.order_number
WHERE tblorderdetails.order_status='Pending' AND tblcustomerorder.email='$emailAddress' GROUP BY tblorderdetails.order_number
ORDER BY `tblorderdetails`.`id` ASC");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>