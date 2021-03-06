<?php

if (empty($_GET["id"])) {
    exit('Post id invalido');
}
$id = $_GET['id'];

require_once __DIR__ . '/../../db/conn.inc.php';
$sql = 'select post.*, categoria.name from post, categoria where post.categoria_id=categoria.categoria_id and post_id=:post_id order by post_id desc';

$stmt = $conn->prepare($sql);
$stmt->bindParam(':post_id', $id, PDO::PARAM_INT);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$post) {
    echo  '<h2 class="display-4">Post id invalido</h2>';
    // exit("Post id invalido");
    exit();
}

//updating the record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errName = '';
    $errDesc = '';
    if (!empty($_POST)) {
        $valid = True;


        if (!empty($_POST['title'])) {
            $name = $_POST['title'];
        } else {
            $errName = 'Ingresse um titulo!';
            $valid = False;
        }


        if (!empty($_POST['description'])) {
            $description = $_POST['description'];
        } else {
            $errDesc = 'Ingresse uma descrição!';
            $valid = False;
        }



        if ($valid) {
            $stmt = $conn->prepare("update post set title=:title, description=:description, categoria_id=:categoria_id  where post_id=:id");
            $title = $_POST['title'];
            $description = $_POST['description'];
            $categoria_id = $_POST['categoria_id'];

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":categoria_id", $categoria_id);

            // echo "SQL: $id - $title - $description - $categoria_id";

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
    <title>Editar Post</title>
</head>

<body>
    <h2>Editar post <?php echo !empty($post['post_id']) ?  $post['post_id']  : ''; ?></h2>

    <div class="container row" style="margin: auto;">
        <div class="col-sm-2">
        </div>
        <div class="container col-sm-8 card">
            <form action="Editar.php?id=<?php echo $id ?>" method="post">
                <div class="form-group">
                    <label for="title"> Titulo:</label>
                    <input type="text" class="form-control form-custom" name="title" value="<?php echo !empty($post['title']) ?  $post['title']  : ''; ?>" />
                </div>

                <div class=" form-group">
                    <label for="description">Descrição:</label>
                    <textarea class="form-control  form-custom" name="description" id="description"><?php echo !empty($post['description']) ?  $post['description']  : ''; ?></textarea>
                </div>
                <div class="form-group form-custom">
                    <label for="categoria_id">Categoria:</label>
                    <!-- Categorias -->
                    <div class="dropdown form-custom">
                        <select name="categoria_id">
                            <?php
                            echo '<option selected="selected">' . $post['name'] . '</option>';

                            //categories
                            require_once __DIR__ . '/../../db/conn.inc.php';
                            $sql = 'select categoria_id,name from categoria order by categoria_id asc';

                            $stmt = $conn->prepare($sql);
                            $stmt->execute();

                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


                            // Iterating through the product array
                            foreach ($results as $item) {
                                echo "<option value='$item[categoria_id]'>$item[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class=" form-group">
                    <label for="create">Criado em:</label>
                    <input type="text" class="form-control  form-custom" name="create" id="create" value="<?php echo !empty($post['create_date']) ?  $post['create_date']  : ''; ?>" />
                </div>

                <div class=" form-group">
                    <label for="modify">Modificado em:</label>
                    <input type="text" class="form-control  form-custom" name="modify" id="modify" value="<?php echo !empty($post['modify_date']) ?  $post['modify_date']  : ''; ?>" disabled />
                </div>

                </br>
                <div class="col-12 btn-group btn-group-lg">
                    <button type="submit" class="btn btn-outline-warning btn-lg">Editar post</button>
                </div>
                </br>
                <div class="col-md-12 btn-group btn-group-lg">
                    <button type="button" onclick="window.location.href='./AdminListPost.php'" class="btn btn-secondary btn-lg " style="background-color: #a60356;">Voltar</button>
                </div>

            </form>

        </div>
        <div class="col-sm-2">
        </div>
    </div>
</body>

</html>