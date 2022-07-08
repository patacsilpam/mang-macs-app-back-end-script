<?php
    error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT productName,productCategory,preparationTime,productImage,price,mainIngredients,
    GROUP_CONCAT(productVariation SEPARATOR ',') AS 'productVariation',
    GROUP_CONCAT(price SEPARATOR ',') AS 'groupPrice',
    GROUP_CONCAT(code SEPARATOR ',') AS 'groupCode',
    GROUP_CONCAT(stocks SEPARATOR ',') AS 'stocks',
    GROUP_CONCAT(preparationTime SEPARATOR ',') AS 'groupPreparationTime'
    FROM tblproducts WHERE productCategory='Pizza'
    GROUP BY productName
    ORDER BY id");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
       $data[] = $fetch;
    }
    echo json_encode($data);
?>