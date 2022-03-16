<?php
require 'database/connection.php';
$emailAddress = mysqli_real_escape_string($connect,$_GET['emailAddress']);
$selectNewOrders = $connect->query("SELECT tblcustomerorder.*,tblorderdetails.* FROM tblorderdetails LEFT JOIN tblcustomerorder ON tblcustomerorder.customer_id = tblorderdetails.customer_id WHERE tblorderdetails.order_status='Pending' AND tblcustomerorder.email='pammpatacsil@gmail.com' GROUP BY tblorderdetails.order_id ORDER BY `tblorderdetails`.`id` ASC");
$response = array();
while($fetch = $selectNewOrders->fetch_assoc()){
    $response[] = $fetch;
}
echo json_encode($response);
?>