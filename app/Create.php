<?php
include_once "../../db/conn.inc.php";

$stmt = $conn->prepare("insert into categoria(name,description) values(:name,:description)");

$name="test".date("Ymd");  
$description="Test description ".date("Ymd");

$stmt->bindParam(":name",$name);
$stmt->bindParam(":description",$description);


if ($stmt->execute()) {
    echo "Dados cadastrados com sucesso!";
}
else{
    echo "algo ocurriu mal";
}
