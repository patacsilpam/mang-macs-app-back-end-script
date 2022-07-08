<?php
    error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT * FROM `tblproducts` WHERE productName='Bagnet' OR productName ='Lemon Chicken' 
    OR productName='Lomi'  OR productName='Sizzling Pork Sisig' OR productName='Java Rice' GROUP BY productName");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
        $data[] = $fetch;
    }
    echo json_encode($data);
?>