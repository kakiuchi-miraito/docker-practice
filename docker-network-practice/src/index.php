<?php

$host = 'db';
$port = '3306';
$database = 'docker-practice-db';
$dsn = sprintf('mysql:host=%s; port=%s; dbname=%s;', $host, $port, $database);

$username = 'root';
$password = 'root';

$pdo = new PDO($dsn, $username, $password);

$detail = filter_input(INPUT_POST, 'detail');


if (!empty($detail)) {
    $insert = $pdo->prepare('insert into memo values (null, :details)');
    $insert->bindParam( ':details', $detail);
    $insert->execute();
}

$select = $pdo->prepare('select * from memo');
$results = $select->execute();

?>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Docker Practice</title>
</head>
<body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container mt-5">
    <form method="post" action="">
        <div class="card shadow-lg">
            <div class="m-4">
                <label for="exampleFormControlInput1" class="form-label">Memo</label>
                <input type="text" name="detail" class="form-control" id="exampleFormControlInput1" placeholder="">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>

            <ul class="list-group list-group-flush">
                <?php foreach ($select as $row):?>
                    <li class="list-group-item"><?= htmlspecialchars($row['detail'], ENT_QUOTES) ?></li>
                <?php endforeach; ?>
            </ul>

        </div>
    </form>
</div>
</body>
</html>
