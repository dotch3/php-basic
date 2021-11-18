<?php
include_once "../../db/conn.inc.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errName = '';
    $errDesc = '';
    $errCat = '';
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

        if (!empty($_POST['categoria_id'])) {
            $categoria_id = $_POST['categoria_id'];
        } else {
            $errCat = 'Seleccione uma categoria!';
            $valid = False;
        }

        //triggering the query

        if ($valid) {
            $stmt = $conn->prepare("insert into post(title,description,categoria_id,create_date,image_path) values(:title,:description,:categoria_id,:create_date,:image_path)");
            $title = $_POST['title'];
            $categoria_id = $_POST['categoria_id'];
            $description = $_POST['description'];
            $create_date = $_POST['create_date'];
            $image_path = $_POST['image_path'];
            // checking date 

            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":categoria_id", $categoria_id);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":create_date", $create_date);
            $stmt->bindParam(":image_path", $image_path);


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
            echo "$errDesc </br>";
            echo "$errName </br>";
            echo "$errCat";
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
    <title>Criar Post</title>
</head>

<body>
    <h2>Criar post <?php echo !empty($post['post_id']) ?  $post['post_id']  : ''; ?></h2>

    <div class="container row" style="margin: auto;">
        <div class="col-sm-2">
        </div>
        <div class="container col-sm-8 card">
            <form action="Create.php" method="post">
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
                    <form method="POST" action="FileUpload.php" enctype="multipart/form-data">
                        <input type="file" name="uploadfile" value="" />
                        <input type="submit" value="Upload" name="Submit1"> <br />

                    </form>

                    <?php
                    if (isset($_POST['Submit1'])) {
                        $filepath = "images/" . $_FILES["file"]["name"];

                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) {
                            echo "<img src=" . $filepath . " height=200 width=300 />";
                        } else {
                            echo "Error !!";
                        }

                        // Now let's move the uploaded image into the folder: image
                        if (move_uploaded_file($tempname, $folder)) {
                            $msg = "Image uploaded successfully";
                        } else {
                            $msg = "Failed to upload image";
                        }
                    }
                    ?>

                </div>
                <div class=" form-group">
                    <label for="create_date">Criado em:</label>
                    <input type="date" class="form-control  form-custom" name="create_date" id="create_date" value="<?php echo !empty($post['create_date']) ?  $post['create_date']  : ''; ?>" />
                </div>

                <div class=" form-group">
                    <label for="modify">Modificado em:</label>
                    <input type="text" class="form-control  form-custom" name="modify" id="modify" value="<?php echo !empty($post['modify_date']) ?  $post['modify_date']  : ''; ?>" disabled />
                </div>

                </br>
                <div class="col-12 btn-group btn-group-lg">
                    <button type="submit" class="btn btn-outline-success btn-lg">Criar post</button>
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