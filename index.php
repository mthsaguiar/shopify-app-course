<?php
include_once("includes/mysql_connect.php");
include_once("includes/shopify.php");

$shopify = new Shopify();

//Use Query and SELECT statement to get the shop information

$parameters = $_GET;

$query = "SELECT * FROM shops WHERE shop_url='" . $parameters['shop'] . "' LIMIT 1";
$result = $mysql -> query($query);
//Check if the number of rows is less than 1, if it's less than 1, then that means, 
//we need to redirect the merchants to the install page

if($result -> num_rows < 1){
    header("Location: install.php?shop=" . $_GET['shop']);
    exit();
}

//Use fetch assoc function to get the records

$store_data = $result -> fetch_assoc();


$shopify->set_url($parameters['shop']);
$shopify->set_token($store_data['access_token']);

echo $shopify->get_url();
echo '<br />';
echo $shopify->get_token();