<?php
$_API_KEY = '73ded20a3030dff6210634b5130e6110';
$_NGROK_URL = 'https://fe30-167-249-188-18.ngrok.io';
$shop = $_GET['shop'];
$scopes = 'read_products,write_products,read_orders,write_orders';
$redirect_uri = $_NGROK_URL . '/pegasusv1/token.php';
$nonce = bin2hex( random_bytes(12) );
$access_mode = 'per-user';

$oauth_url = 'https://' . $shop . '/admin/oauth/authorize?client_id=' . $_API_KEY . '&scope=' . $scopes . '&redirect_uri=' . urlencode($redirect_uri) . '&state=' . $nonce . '&grant_options[]=' . $access_mode;


header("Location: " . $oauth_url);
exit();