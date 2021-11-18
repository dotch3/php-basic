<?php
require_once __DIR__ . '/../db/conn.inc.php';
$sql = 'select post_id,title,description,create_date,modify_date from post order by create_date desc';
$stmt = $conn->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <title>App</title>
</head>

<?php
include __DIR__ . '/Header.php';
?>

<body>
    <?php
    //Getting the data from database
    if (!empty($_GET["categoriaId"])) {
        $categoria_id = $_GET['categoriaId'];

        $sql = 'select post.*, categoria.categoria_id,categoria.name from post,categoria WHERE post.categoria_id=:categoria_id AND categoria.categoria_id = post.categoria_id ORDER BY post.create_date DESC;';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
    } else {

        $sql = 'select post.*,categoria.name from post,categoria WHERE post.categoria_id=categoria.categoria_id ORDER BY post.create_date DESC limit 10;';
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    //storing the results found
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <h2>Lista de Posts <?php echo (isset($categoria_id) && sizeOf($posts) > 0) ? ' - ' . $posts[0]['name'] : ''; ?> </h2>
    <?php
    if (!$posts) {
        exit("Nenhum post encontrado nesta categoria");
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php
                foreach ($posts as $post) {
                ?>

                    <div class="card">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php
                                    if (!isset($post['title'])) {
                                        echo 'Post invalid';
                                    } else {
                                        echo '<img src="../storage/add.png" id="imgPost-' . $post['post_id'] . '" class="profile" style="width: 100px;height: 80px; " alt="image Post-' . $post['post_id'] . '" title="imgage post-' . $post['post_id'] . '">';
                                    }
                                    ?>

                                </div>
                                <div class="container col-md-8  post_item">
                                    <div class="form-group post_item">
                                        <label for="title"> <?php echo $post['title'] ?>:</label>

                                        <p><?php echo $post['description'] ?></p>
                                    </div>

                                </div>
                            </div>
                            </br>
                        </div>
                        <div class="col-md-12 post-link">
                            <?php echo '<p><a href="./post/ViewPost.php?id=' . $post['post_id'] . '">Leia mais </a> </p>'; ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <!-- Div para a publicidade -->
            <div class="col-md-3">
                <div class="card publicidade">
                    <h3>Publicidade</h3>
                    <a href="https://www.fiap.com.br/online/graduacao/bacharelado/sistemas-de-informacao/"> <img class="image" src="../storage/fiapSchool.png" id="imgPublicidade" alt=" image Publicidade" title="pulicidade">
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include __DIR__ . "/app/Footer.php";
?>


</html>