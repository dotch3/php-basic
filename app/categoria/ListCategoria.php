<?php
require_once __DIR__ . '/../../db/conn.inc.php';
$sql = 'select categoria_id,name,description,create_date,modify_date from categoria order by categoria_id asc';

$stmt = $conn->prepare($sql);
$stmt->execute();

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
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <title>Categorias</title>
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
                    <a href="../../index.php"> <img src="../../public/images/dollybot.png" width="90" height="80" alt="Home" title="Home" class="logo"></a>
                </li>
                <!-- Codigo para carregar as categorias  -->
                <?php
                if (!$results) {
                    exit("Nenhuma categoria encontrada");
                }

                if (sizeOf($results) <= 5) {
                    foreach ($results as $row) {
                        echo '<li class="nav-item col-2 mt-2">';
                        echo '<a href="../post/ListPost.php?posts=' . $row['name'] . '"> ' . $row['name'] . '</a>';
                        echo '</li>';
                    }
                } else {
                    //show the "Mais"opcao
                    for ($i = 0; $i <= 4; $i++) {
                        # code...
                        $row = $results[$i];
                        echo '<li class="nav-item col-2 mt-2">';
                        echo '<a  href="../post/ListPost.php?categoriaId=' . $row['categoria_id'] . '">Categoria ' . $row['categoria_id'] . '</a>';
                        echo '</li>';
                    }
                    echo '<li class="nav-item col-1 mt-2 outro">';
                    echo '<a   href="../post/ListPost.php" title="Mais Posts"> + </a>';
                    echo '</li>';
                }

                ?>

            </ul>
        </nav>
    </header>
</div>
<!-- End NAv -->

<body>
    <h2>Posts por categorias</h2>
    <div class="container">

        <?php
        if (!$results) {
            exit("Nenhum registro encontrado");
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <?php
                foreach ($results as $categoria) {
                ?>
                    <div class="card">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="container col-md-8  post_item categoria-item">
                                    <div class="form-group post_item">
                                        <label for="name"> <?php echo $categoria['name'] ?>:</label>

                                        <p><?php echo $categoria['description'] ?></p>
                                    </div>
                                </div>
                                <div class="container col-md-2  post_item">
                                    <?php echo '<a class="btn btn-dark" href="../post/ListPost.php?categoriaId=' . $categoria['categoria_id'] . '">Ver Posts</a>' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>



            </div>


        </div>
    </div>
</body>

<footer class="estilo_footer">
    <p>© 2021 - 2025, FIAP ON - todos direitos reservados</p>
</footer>

</html>