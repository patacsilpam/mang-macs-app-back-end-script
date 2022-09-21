<?php
   //error_reporting(0);
   $data = array();
   function fetchPizzaDb(){
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
      WHERE tblproducts.productCategory = 'Pizza'
      GROUP BY tblproducts.productName ORDER BY tblproducts.id ASC");
      while($fetch = $getProduct->fetch_array()){
         $data[] = $fetch;
      }
       echo json_encode($data);
   }
   fetchPizzaDb();
   /*
      SELECT productName,productCategory,preparationTime,productImage,price,mainIngredients,
		add_ons AS 'groupAddOns',add_ons_price AS 'groupAddOnsPrice',
      GROUP_CONCAT(DISTINCT(productVariation) ORDER BY tblproducts.id ASC SEPARATOR ',') AS 'productVariation',
      GROUP_CONCAT(DISTINCT(price) ORDER BY tblproducts.id SEPARATOR ',') AS 'groupPrice',
      GROUP_CONCAT(DISTINCT(code) SEPARATOR ',') AS 'groupCode',
      GROUP_CONCAT(stocks SEPARATOR ',') AS 'stocks',
      GROUP_CONCAT(preparationTime SEPARATOR ',') AS 'groupPreparationTime'
      FROM tblproducts WHERE productCategory='Pizza'
      GROUP BY productName ORDER BY id


      SELECT productName,productCategory,preparationTime,productImage,price,mainIngredients,
      GROUP_CONCAT(DISTINCT(productVariation) ORDER BY tblproducts.id ASC SEPARATOR ',') AS 'productVariation',
      GROUP_CONCAT(DISTINCT(price) ORDER BY tblproducts.id SEPARATOR ',') AS 'groupPrice',
      GROUP_CONCAT(DISTINCT(code) SEPARATOR ',') AS 'groupCode',
      GROUP_CONCAT(stocks SEPARATOR ',') AS 'stocks',
      GROUP_CONCAT(preparationTime SEPARATOR ',') AS 'groupPreparationTime',
      GROUP_CONCAT(DISTINCT(tbladdons.add_ons) ORDER BY tbladdons.id ASC SEPARATOR ',') as 'groupAddOns',
      GROUP_CONCAT(tbladdons.add_ons_price  SEPARATOR ',') as 'groupAddOnsPrice'
      FROM tblproducts
      CROSS JOIN tbladdons WHERE tblproducts.productCategory = 'Pizza'
       GROUP BY tblproducts.productName
    */
?>
