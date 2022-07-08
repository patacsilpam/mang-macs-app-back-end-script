<?php
error_reporting(0);
require 'database/connection.php';
$users = $_GET['id'];
$emailAddress = $_GET['email'];
$response = array();
foreach($users as $key => $index){
    $users = $index;
    $email = $emailAddress[$key];
    $query=$connect->query("SELECT code,stocks,
    (SELECT MAX(preparationTime) FROM tblproducts WHERE code in ('$users')) as 'preparationTime'
    FROM tblproducts WHERE code in ('$users')");
    while($fetch = $query->fetch_array()){
        $response[] = $fetch;
    }
}
echo json_encode($response);

?>