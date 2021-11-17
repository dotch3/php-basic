<?php

if (empty($_GET["id"])) {
    exit('Post id invalido');
}
$id = $_GET['id'];
// echo __DIR__;
require_once __DIR__ . '/../../db/conn.inc.php';
// $sql = 'select * from post where post_id =' . $id . ';';
$sql = 'select * from post where post_id =:post_id';

$stmt = $conn->prepare($sql);
$stmt->bindParam(':post_id', $id, PDO::PARAM_INT);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$post) {
    echo  '<h2 class="display-4">Post id invalido</h2>';
    // exit("Post id invalido");
    exit();
}

?>
<html>

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
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <link rel="stylesheet" href="../../public/css/main.css">




    <title>Ver Post</title>
</head>

<body>
    <h2><?php echo $post['title'] ?></h2>
    <div class="container">

        <div class="container row card">
            <div class="col-sm-12 ">
                <!-- <h2 class="display-4">Detalhe post</h2> -->
                <div class=" col-md-12">
                    <div class="row ">
                        <div class="col-md-4">
                            <?php
                            if (!isset($post['title'])) {
                                echo 'Post invalid';
                            } else {

                                echo '<img src="../../storage/add.png" id="imgPost-' . $id . '" class="profile" style="width: 180px;height: 170px; ">';
                                // echo '<img src="' . $id . '" id="imgPost-' . $id . '" class="profile" style="width: 180px;height: 170px; ">';
                            }
                            ?>

                        </div>
                        <div class="container col-md-8  post_item">
                            <div class="form-group post_item">
                                <label style="color: #a60356;" for="title"> Titulo:</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $post['title'] ?>" disabled />
                            </div>
                            <div class="form-group post_item">
                                <label style="color: #a60356;" for="description">Descrição:</label>
                                <textarea disabled type="text" class="form-control" name="description" id="description"><?php echo $post['description'] ?> </textarea>
                            </div>
                            <div class="form-group post_item">
                                <label style="color: #a60356;" for="create_date">Data de criação:</label>
                                <input type="text" class="form-control" name="create_date" id="create_date" value="<?php echo $post['create_date'] ?>" disabled />
                            </div>
                            <div class="form-group post_item">
                                <label style="color: #a60356;" for="modify_date">Ultima modificação:</label>
                                <input type="text" class="form-control" name="modify_date" id="modify_date" value="<?php echo $post['modify_date'] ?>" disabled />
                            </div>
                        </div>
                    </div>

                    </br>

                    <div class="row col-md-12>">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6 btn-group btn-group-lg">
                            <button type="button" onclick="window.location.href='javascript:history.back()'" class="btn btn-secondary btn-lg " style="background-color: #a60356;">Atras</button>

                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>