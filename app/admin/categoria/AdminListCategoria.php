<?php
require_once __DIR__ . '/../../../db/conn.inc.php';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="lib/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../../public/css/header.css">
    <link rel="stylesheet" href="../../../public/css/footer.css">
    <link rel="stylesheet" href="../../../public/css/main.css">
    <title>Admin - Categorias</title>
</head>

<div class="row">
    <header class="header">
        <nav>
            <ul class="nav">
                <li class="nav-item col-1">
                    <img src="../../../public/images/dollybot.png" width="90" height="80" alt="logo" title="logo" class="logo">
                </li>
                <li class="nav-item col-2 mt-2">
                    <a href="../index.php">Home</a>
                </li>
                <li class="nav-item col-2 mt-2">
                    <a href="../categoria/AdminListCategoria.php">Categorias</a>
                </li>
                <li class="nav-item col-2 mt-2">
                    <a href="../post/AdminListPost.php">Posts</a>
                </li>
            </ul>
        </nav>
    </header>
</div>

<body>
    <h2>Admin - Categorias</h2>
    <div class="container">
        <div class="container-fluid" style="text-align:center;">
            <a href="./Create.php" class="btn btn-info" style="color: #fff;
                background-color: #a60356;
                border-color: #d1dbdd;">
                Criar Categoria
            </a>
        </div>
        </br>
    </div>
    <div class=" container">
        <table class="table" style="text-align: center;">
            <thead>
                <tr>
                    <th scope="col">categoria_id</th>
                    <!-- <th scope="col">ID</th> -->
                    <th scope="col">name</th>
                    <th scope="col">description</th>
                    <th scope="col">create date</th>
                    <th scope="col">modify date</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$results) {
                    exit("Nenhum registro encontrado");
                }

                // echo sizeOf($results) . "<br/>";

                foreach ($results as $row) {
                    echo '<tr>';
                    echo '<th scope="row">' . $row['categoria_id'] . '</th>';
                    // echo '<td>' . $row['categoria_id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['create_date'] . '</td>';
                    echo '<td>' . $row['modify_date'] . '</td>';
                    echo '<td width=250>';
                    echo '<a class="btn btn-primary" href="read.php?id=' . $row['categoria_id'] . '">Ver</a>';
                    echo ' ';
                    echo '<a class="btn btn-warning" href="Editar.php?id=' . $row['categoria_id'] . '">Editar</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="delete.php?id=' . $row['categoria_id'] . '">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

<footer class="estilo_footer">
    <p>© 2021 - 2025, FIAP ON - todos direitos reservados</p>
</footer>

</html>