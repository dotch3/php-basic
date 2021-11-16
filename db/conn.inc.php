<?php

$hostname="192.168.64.2";
$db_name="diario_bordo";
$user="fiap";
$passw="fiap";
$conn = new PDO("mysql:host=$hostname;dbname=$db_name",$user,$passw);