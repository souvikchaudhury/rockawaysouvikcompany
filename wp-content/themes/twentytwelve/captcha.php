<?php 
session_start(); 
$text = rand(10000,99999); 
$chars = "1234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$text = "";
for($i=0;$i<=5;$i++) { $text.= $chars{mt_rand(0,strlen($chars))}; }

$_SESSION["vercode"] = $text; 

$image = imagecreatefromjpeg("images/bg.jpg");
$txtColor = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 5, 5, $text, $txtColor);
header("Content-type: image/jpeg");
imagejpeg($image);
?>
