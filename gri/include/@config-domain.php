<?php

$host = "rajsoft.org.in"; /* Host name */
$user = "rajsofto_shoping"; /* User */
$password = "g^EU7*h[kdu{"; /* Password */
$dbname = "rajsofto_som"; /* Database name */

$headers .= 'From: <Online_Grievance@rajsoft.org.com>' . "\r\n";


$con = mysqli_connect($host, $user, $password,$dbname);
session_start();

// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}