<?php

require_once __DIR__ . '/db/conn.inc.php';
$sql = 'select post_id,title,description,create_date,modify_date from post order by post_id desc';
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
    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="stylesheet" href="./public/css/header.css">



    <title>Home</title>
</head>
<?php
include __DIR__ . '/app/views/Header.php';
?>

<body>
    <div class="description">
        <h3>Home></h3>
    </div>
    <div class="container">
        <table class="table" style="text-align: center;">
            <thead>
                <tr>
                    <!-- <th scope="col">ID</th> -->
                    <th scope="col">Img</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Create date</th>
                    <th scope="col">Modify date</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$posts) {
                    exit("Nenhum registro encontrado");
                }
                echo sizeOf($posts);
                foreach ($posts as $row) {
                    echo '<tr>';
                    echo '<th scope="row">' . $row['post_id'] . '</th>';
                    // echo '<td>' . $row['categoria_id'] . '</td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['create_date'] . '</td>';
                    echo '<td>' . $row['modify_date'] . '</td>';
                    echo '<td width=250>';
                    echo '<a  href="app/views/post/ViewPost.php?id=' . $row['post_id'] . '">Leia mais</a>';
                    echo ' ';

                    echo '</tr>';

                    echo "<br/>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
<?php
include __DIR__ . "/app/views/Footer.php";
?>


</html>