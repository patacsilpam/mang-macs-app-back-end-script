<?php
error_reporting(E_ALL);
require 'database/connection.php';
$email = mysqli_real_escape_string($connect,$_GET["emailaddress"]);
$getProduct = $connect->query("SELECT * FROM `tbladdress` WHERE email='$email'");
$response = array();
while($fetch = $getProduct->fetch_array()){
    $response[] = $fetch;
}
echo json_encode($response);
?>