<?php
include_once("includes/mysql_connect.php");
include_once("includes/shopify.php");

$shopify = new Shopify();

$parameters = $_GET;

/**
*===========================================
*        CHECKING THE SHOPIFY STORE
*===========================================
*/

$query = "SELECT * FROM shops WHERE shop_url='" . $parameters['shop'] . "' LIMIT 1";
$result = $mysql -> query($query);

if($result -> num_rows < 1){
    header("Location: install.php?shop=" . $_GET['shop']);
    exit();
}

$store_data = $result -> fetch_assoc();

echo $store_data['access_token'];


$shopify->set_url($parameters['shop']);
$shopify->set_token($store_data['access_token']);

$shop = $shopify->rest_api('/admin/api/2022-01/shop.json', array(), 'GET');
$response = json_decode($shop['body'], true);

if(array_key_exists('errors', $response)) {
    header("Location: install.php?shop=" . $_GET['shop']);
    exit();
}

/**
*===========================================
*   HERE DISPLAY ANYTHING ABOUT THE STORE
*===========================================
*/

$access_scopes = $shopify->rest_api('/admin/oauth/access_scopes.json', array(), 'GET');
$response_access_scope = json_decode($access_scopes['body'], true);

echo print_r($response_access_scope);