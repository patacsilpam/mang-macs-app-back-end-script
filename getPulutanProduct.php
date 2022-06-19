<?php
    error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT * FROM `tblproducts` WHERE productCategory='Mang Macs Pulutan'");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
        $data[] = $fetch;
    }
    echo json_encode($data);
?>