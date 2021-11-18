<?php
include_once "../../db/conn.inc.php";


if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
    $id = $_POST['id'];
    $sql = 'delete from categoria where categoria_id = :categoria_id';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':categoria_id', $id, PDO::PARAM_INT);

    // execute the statement
    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">';
        echo 'Dados apagados existosamente';
        echo 'Atualize sua pagina para ver os cambios';
        echo '</div>';
        header("Location:./AdminListCategoria.php");
    } else {
        echo 'Algo sucedio';
    }
}
