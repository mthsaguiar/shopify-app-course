<?php

$server = 'localhost';
$username = 'root';
$password =  '';
$database = 'pegasusv1_db';

$mysql = mysql_connect($server, $username, $password, $database);

if(!$mysql){
    die("Error: " . mysql_connect_error());
}