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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="lib/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./public/css/footer.css">
    <!-- Theme style -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../../public/css/main.css">
    <link rel="stylesheet" href="../../../public/css/header.css">
    <link rel="stylesheet" href="../../../public/css/footer.css">
    <title>Lista de Categorias</title>
</head>

<div class="row">
    <header class="header">
        <nav>
            <ul class="nav">
                <li class="nav-item col-1">
                    <img src="../../../public/images/dollybot.png" width="90" height="80" alt="logo" title="logo" class="logo">
                    <!-- <?php echo '<img src="' . dirname(__DIR__) . '/public/images/dollybot.png" width="90" height="80" alt="logo" title="logo" class="logo">' ?> -->
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
                        echo '<a href="categoria.php?id=' . $row['name'] . '"> ' . $row['name'] . '</a>';
                        // echo '<button class="buttonHeader" onclick="window.location.href="./ListCategoria.php?id' . $row['categoria_id'] . '">Categoria ' . $row['categoria_id'] . '</button>';
                        echo '</li>';
                    }
                } else {
                    //show the "Mais"opcao
                    for ($i = 0; $i <= 4; $i++) {
                        # code...
                        $row = $results[$i];
                        echo '<li class="nav-item col-2 mt-2">';
                        echo '<a  href="read.php?id=' . $row['categoria_id'] . '">Categoria ' . $row['categoria_id'] . '</a>';
                        // echo '<button class="buttonHeader" onclick="window.location.href="./ListCategoria.php?id' . $row['categoria_id'] . '">Categoria ' . $row['categoria_id'] . '</button>';
                        echo '</li>';
                    }
                    echo '<li class="nav-item col-1 mt-2 outro">';
                    echo '<a   href="app/views/categoria/ListCategoria.php"> + </a>';
                    // echo '<button class="buttonHeader" onclick="window.location.href="./ListCategoria.php?id' . $row['categoria_id'] . '">Categoria ' . $row['categoria_id'] . '</button>';
                    echo '</li>';
                }

                ?>

                <!-- <li class="nav-item col-2 mt-2">
                    <button onclick="window.location.href='./app/views/admin/categoria/list.php'" class="buttonHeader">Categoria 2</button>\
                </li>
                <li class="nav-item col-2 mt-2">r6f5f
                    <button onclick="window.location.href='./app/views/admin/categoria/list.php'" class="buttonHeader">Categoria 3</button>
                </li>
                <li class="nav-item col-2 mt-2">
                    <button onclick="window.location.href='./app/views/admin/categoria/list.php'" class="buttonHeader">Categoria 4</button>
                </li> -->
            </ul>
        </nav>
    </header>
</div>

<body>
    <h2>Lista de Categorias</h2>
    <div class="container">
        <table class="table" style="text-align: center;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <!-- <th scope="col">ID</th> -->
                    <th scope="col">Name</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Create date</th>
                    <th scope="col">Modify date</th>
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
                    echo '<a class="btn btn-primary" href="read.php?id=' . $row['categoria_id'] . '">Info</a>';
                    echo ' ';
                    echo '<a class="btn btn-warning" href="update.php?id=' . $row['categoria_id'] . '">Atualizar</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="delete.php?id=' . $row['categoria_id'] . '">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';

                    echo "<br/>";
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