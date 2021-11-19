<?php
//Testes para subir files

$now = new DateTime();
$name = $now->getTimestamp();
$name = "post_" . $name . ".png";
echo $name;


?>
<form enctype="multipart/form-data" action="upload.php" method="POST">
    <input type="file" name="file">
    <input type="submit" value="Submit">
</form>