<?php
    error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT productName,status,productImage,price,
    GROUP_CONCAT(productVariation SEPARATOR ',') AS 'productVariationBilao',
    GROUP_CONCAT(price  SEPARATOR ',') AS 'groupPriceBilao',
    GROUP_CONCAT(code SEPARATOR ',') AS 'groupCode'
    FROM tblproducts WHERE productCategory='Bilao' GROUP BY productName ORDER BY id");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
       $data[] = $fetch;
    }
    echo json_encode($data);
?>