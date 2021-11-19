<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo '<link rel="stylesheet" href="' . dirname(__DIR__) . '/public/css/header.css">'
    ?>
</head>
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
                    <a href="./index.php"> <img src="../public/images/dollybot.png" width="90" height="80" alt="Home" title="Home" class="logo"></a>
                </li>
                <!-- Codigo para carregar as categorias  -->
                <?php
                require_once __DIR__ . '/../db/conn.inc.php';
                $sql = 'select categoria_id,name,description,create_date,modify_date from categoria order by categoria_id asc';

                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!$results) {
                    exit("Nenhuma categoria encontrada");
                }


                if (sizeOf($results) <= 5) {
                    foreach ($results as $row) {
                        echo '<li class="nav-item col-2 mt-2">';
                        echo '<a href="post/ListPost.php?categoriaId=' . $row['name'] . '"> ' . $row['name'] . '</a>';
                        echo '</li>';
                    }
                } else {
                    //show the "Mais" opcao
                    for ($i = 0; $i <= 4; $i++) {
                        # code...
                        $row = $results[$i];
                        echo '<li class="nav-item col-2 mt-2">';
                        echo '<a  href="post/ListPost.php?categoriaId=' . $row['categoria_id'] . '">Categoria ' . $row['categoria_id'] . '</a>';
                        echo '</li>';
                    }
                    echo '<li class="nav-item col-1 mt-2 outro">';
                    echo '<a   href="categoria/ListCategoria.php" title="Mais Posts"> + </a>';
                    echo '</li>';
                }

                ?>
            </ul>
        </nav>

    </header>
</div>