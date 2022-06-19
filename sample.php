<?php
error_reporting(0);
require 'database/connection.php';
$users = $_GET['id'];
$response = array();
foreach($users as $key => $index){
    $users = $index;
    $query=$connect->query("SELECT code,stocks FROM tblproducts WHERE code in ('$users')");
    while($fetch = $query->fetch_array()){
        $response[] = $fetch;
    }
}
echo json_encode($response);

?>