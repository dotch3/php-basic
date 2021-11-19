<?php
//Teste 
$location = '../../storage/uploads/';
$now = new DateTime();
$timestamp = $now->getTimestamp();
$postName = "post_" . $timestamp . "_";
echo $postName;

print_r($_FILES);
if (isset($_FILES['file'])) {
    $filename = $_FILES['file']['name'];
    $name = $postName . $filename;
    $tmp_name = $_FILES['file']['tmp_name'];

    echo "new name: $name ";
    $error = $_FILES['file']['error'];
    if ($error !== UPLOAD_ERR_OK) {
        echo 'Erro ao fazer o upload:', $error;
    } elseif (move_uploaded_file($tmp_name, $location . $name)) {
        echo 'Uploaded';
    }
} else {
    echo 'Selecione um arquivo para fazer upload';
}
