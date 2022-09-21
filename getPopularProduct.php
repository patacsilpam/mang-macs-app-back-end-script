<?php
    error_reporting(0);
    require 'database/connection.php';
    $getProduct = $connect->query("SELECT tblproducts.productName,tblproducts.productCategory,
    tblproducts.preparationTime,tblproducts.productImage,tblproducts.price,tblproducts.mainIngredients,
    GROUP_CONCAT(DISTINCT(tblproducts.productVariation) ORDER BY tblproducts.id ASC SEPARATOR ',') AS 'productVariation',
    GROUP_CONCAT(DISTINCT(tblproducts.price) ORDER BY tblproducts.id SEPARATOR ',') AS 'groupPrice',
    GROUP_CONCAT(DISTINCT(tblproducts.code) SEPARATOR ',') AS 'groupCode',
    GROUP_CONCAT(DISTINCT(tblproducts.stocks) SEPARATOR ',') AS 'stocks',
    GROUP_CONCAT(DISTINCT(tblproducts.preparationTime) SEPARATOR ',') AS 'groupPreparationTime',
    (SELECT GROUP_CONCAT(tbladdons.add_ons ORDER BY tbladdons.id ASC SEPARATOR ',') 
    FROM tbladdons WHERE tbladdons.add_ons_category = 'Pizza') as 'groupAddOns',
    (SELECT GROUP_CONCAT(tbladdons.add_ons_price ORDER BY tbladdons.id ASC  SEPARATOR ',') 
    FROM tbladdons WHERE tbladdons.add_ons_category  = 'Pizza') as 'groupAddOnsPrice'
    FROM `tbladdons` RIGHT JOIN tblproducts
    ON tblproducts.productCategory = tbladdons.add_ons_category 
    WHERE tblproducts.productCategory = 'Pizza' AND 
    tblproducts.productName IN ('Vegetarian Pizza','Hawaiian Pizza','Cheesy Pepperoni')
    GROUP BY tblproducts.productName ORDER BY tblproducts.id ASC");
    $data = array();
    while($fetch = $getProduct->fetch_array()){
        $data[] = $fetch;
    }
    echo json_encode($data);
?>