<?php
require_once __DIR__ . '/../../db/conn.inc.php';
if (!empty($_GET["id"])) {
    $id = $_GET['id'];
    $sql = 'select * from categoria where categoria_id =:categoria_id';

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':categoria_id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$categoria) {
        echo  '<h2 class="display-4">Categoria id invalido</h2>';
        exit();
    }
}



//updating the record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errName = '';
    $errDesc = '';
    if (!empty($_POST)) {
        $valid = True;


        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
        } else {
            $errName = 'Ingresse um nome!';
            $valid = False;
        }


        if (!empty($_POST['description'])) {
            $description = $_POST['description'];
        } else {
            $errDesc = 'Ingresse uma descrição!';
            $valid = False;
        }



        if ($valid) {
            $stmt = $conn->prepare("update categoria set name=:name, description=:description where categoria_id=:id");
            $name = $_POST['name'];
            $description = $_POST['description'];

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);

            if ($stmt->execute()) {
                echo '<div class="alert alert-success" role="alert">';
                echo 'Dados atualizados com sucesso!! </br>';
                echo 'Atualize sua pagina para ver os cambios';
                echo '</div>';
                // header("Location: ./Editar.php?id=$id");

            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo 'Oops.Algo deu errado:  2+2 =5!';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo "$errDesc. </br>";
            echo "$errName";
            echo '</div>';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="lib/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <title>Editar Categoria</title>
</head>

<body>
    <h2>Editar categoria <?php echo !empty($categoria['categoria_id']) ?  $categoria['categoria_id']  : ''; ?></h2>

    <div class="container row" style="margin: auto;">
        <div class="col-sm-2">
        </div>
        <div class="container col-sm-8 card">
            <form action="Editar.php?id=<?php echo $id ?>" method="post">
                <div class="form-group">
                    <label for="name"> Nome:</label>
                    <input type="text" class="form-control form-custom" name="name" value="<?php echo !empty($categoria['name']) ?  $categoria['name']  : ''; ?>" />
                </div>

                <div class=" form-group">
                    <label for="description">Descrição:</label>
                    <textarea class="form-control  form-custom" name="description" id="description"><?php echo !empty($categoria['description']) ?  $categoria['description']  : ''; ?></textarea>
                </div>

                <div class=" form-group">
                    <label for="create">Criado em:</label>
                    <input type="text" class="form-control  form-custom" name="create" id="create" value="<?php echo !empty($categoria['create_date']) ?  $categoria['create_date']  : ''; ?>" disabled />
                </div>

                <div class=" form-group">
                    <label for="modify">Modificado em:</label>
                    <input type="text" class="form-control  form-custom" name="modify" id="modify" value="<?php echo !empty($categoria['modify_date']) ?  $categoria['modify_date']  : ''; ?>" disabled />
                </div>



                </br>
                <div class="col-12 btn-group btn-group-lg">
                    <button type="submit" class="btn btn-outline-warning btn-lg">Editar categoria</button>
                </div>
                </br>
                <div class="col-md-12 btn-group btn-group-lg">
                    <button type="button" onclick="window.location.href='./AdminListCategoria.php'" class="btn btn-secondary btn-lg " style="background-color: #a60356;">Voltar</button>
                </div>

            </form>

        </div>
        <div class="col-sm-2">
        </div>
    </div>
</body>

</html>