<?php
// Code for getting the Categories created and use them for the navigation options
require_once __DIR__ . '/../../db/conn.inc.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'select categoria.categoria_id,post.post_id,post.title,post.description
            from categoria,post 
            where categoria.categoria_id=post.categoria_id
            order by post.post_id desc  limit 10;';
} else {
    //Returning ALL categories if the ID was not found in the URL
    $sql = 'select categoria_id,name,description,create_date,modify_date from categoria order by categoria_id asc limit 10;';
}

$stmt = $conn->prepare($sql);
$stmt->execute();
//List of Categories
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="./public/css/footer.css">
    <!-- Theme style -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <title> Posts </title>
</head>

<!-- Header -->
<div class="date">
    <?php
    // timezone
    date_default_timezone_set('America/Sao_Paulo'); //Brasilia

    $localDate = date('d/m/Y  H:i:s', time());
    echo $localDate;
    ?>
</div>
<div class="row">
    <header class="header">
        <nav>
            <ul class="nav">
                <li class="nav-item col-1">
                    <a href="../index.php"> <img src="../../public/images/dollybot.png" width="90" height="80" alt="Home" title="Home" class="logo"></a>
                </li>
                <!-- Codigo para carregar as categorias  -->
                <?php
                if (!$results) {
                    exit("Nenhuma categoria encontrada");
                }
                // echo sizeOf($results) . "<br />";

                if (sizeOf($results) <= 5) {
                    foreach ($results as $row) {
                        echo '<li class="nav-item col-2 mt-2">';
                        echo '<a href="ListPost.php?posts=' . $row['name'] . '"> ' . $row['name'] . '</a>';
                        echo '</li>';
                    }
                } else {
                    //show the "Mais"opcao
                    for ($i = 0; $i <= 4; $i++) {
                        $row = $results[$i];
                        echo '<li class="nav-item col-2 mt-2">';
                        echo '<a  href="ListPost.php?categoriaId=' . $row['categoria_id'] . '">Categoria ' . $row['categoria_id'] . '</a>';
                        echo '</li>';
                    }
                    echo '<li class="nav-item col-1 mt-2 outro">';
                    echo '<a   href="../categoria/ListCategoria.php" title="Mais Posts"> + </a>';
                    echo '</li>';
                }

                ?>

            </ul>
        </nav>
    </header>
</div>
<!-- End NAv -->

<body>
    <?php
    //Getting the data from database
    if (!empty($_GET["categoriaId"])) {
        $categoria_id = $_GET['categoriaId'];

        $sql = 'select post.*, categoria.categoria_id,categoria.name from post,categoria WHERE post.categoria_id=:categoria_id AND categoria.categoria_id = post.categoria_id ORDER BY post.create_date DESC limit 10;';
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

    <h2><?php echo (isset($categoria_id) && sizeOf($posts) > 0) ? 'Posts - ' . $posts[0]['name'] : 'Posts  '; ?> </h2>
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
                                    if (!isset($post['image_path'])) {

                                        echo '<img src="../../storage/add.png" id="imgPost-' . $post['post_id'] . '" alt="image-' . $post['post_id'] . '"  class="profile" style="width: 180px;height: 170px; ">';
                                    } else {
                                        echo '<img src="../../storage/uploads/' . $post['image_path'] . '" id="imgPost-' . $post['post_id']  . '" class="profile">';
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
                        </div>
                        <div class="col-md-12 post-link">
                            <?php echo '<p><a href="ViewPost.php?id=' . $post['post_id'] . '">Leia mais </a> </p>'; ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <!-- Div para a publicidade -->
            <div class="col-md-3">
                <div class="card publicidade">
                    <h3>Publicidade</h3>
                    <a href="https://www.fiap.com.br/online/graduacao/bacharelado/sistemas-de-informacao/"> <img class="image" src="../../storage/fiapSchool.png" id="imgPublicidade" alt=" image Publicidade" title="pulicidade"> </a>

                </div>
            </div>
        </div>
    </div>
</body>

<footer class="estilo_footer">
    <p>© 2021 - 2025, FIAP ON - todos direitos reservados</p>
</footer>

</html>