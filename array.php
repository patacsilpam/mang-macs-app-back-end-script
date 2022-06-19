<?php
require 'database/connection.php';

$users=$_GET['id'];
// glue them together with ', '
$userStr = implode("', '", $users);
$query=$connect->query("SELECT code FROM tblproducts WHERE code in ('$userStr')");
$response = array();
while($fetch = $query->fetch_array()){
    $response[] = $fetch;
  
}
echo json_encode($response);
?>