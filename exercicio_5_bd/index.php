<?php

require_once "connection.php";

function generateNumbers($min, $max, $length)
{
    $arrayNumbers = [];

    while (sizeof($arrayNumbers) < $length) {
        $randomNumber = rand($min, $max);
        if (!in_array($randomNumber, $arrayNumbers)) {
            array_push($arrayNumbers, $randomNumber);
        }
    }

    return $arrayNumbers;
}

$listKeys = [];

if (!empty($_POST)) {
    // GERAR UMA CHAVE
    if (isset($_POST['createkey'])) {
        $key = [
            'estrelas' => generateNumbers(1, 5, 2),
            'numeros' => generateNumbers(1, 50, 5)
        ];

        // insert chave
        $pdo->query('INSERT INTO `chave` (`id`) VALUES (null)');
        $lastInsertedId_chave = $pdo->lastInsertId();


        // insert estrelas
        foreach ($key['estrelas'] as $star_num) {
            $pdo->query('INSERT INTO `estrelas` (numero, id_chave) VALUES (' . $star_num . ', ' . $lastInsertedId_chave . ')');
        }

        // insert numeros
        foreach ($key['numeros'] as $num) {
            $pdo->query('INSERT INTO `numeros` (numero, id_chave) VALUES (' . $num . ', ' . $lastInsertedId_chave . ')');
        }


    }

    if (isset($_POST['delete'])) {
        $listKeys = [];

        // delete chave
        $pdo->query('DELETE FROM `chave`');
        $pdo->query('DELETE FROM `estrelas`');
        $pdo->query('DELETE FROM `numeros`');

    }
}


$stmt = $pdo->query('SELECT id FROM `chave`');

while ($row = $stmt->fetch())
{
    $idChave = $row['id'];

    $chave = [
        'estrelas' => [],
        'numeros' => []
    ];


    $stmtStars = $pdo->query('SELECT * FROM `estrelas` where id_chave='.$idChave);

    while ($rowStars = $stmtStars->fetch()) {
        $numeroEstrela = $rowStars['numero'];
        array_push($chave['estrelas'],$numeroEstrela);

    }

    $stmtNums = $pdo->query('SELECT * FROM `numeros` where id_chave='.$idChave);

    while ($rowNums = $stmtNums->fetch()) {
        $numero = $rowNums['numero'];
        array_push($chave['numeros'],$numero);
    }

    array_push($listKeys, (object)$chave);

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Euromilhoes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
</head>
<body>

<section class="menu">
    <div class="menu-container">
        <h1>Euro Milhões</h1>

        <table>
            <thead>
            <tr>
                <td>Chave</td>
                <td>Chave ordenada</td>
                <td>Estrelas</td>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($listKeys as $key) {
                    asort($key->numeros);
                    asort($key->estrelas);
                    echo '
                        <tr>
                            <td>' . implode(", ", $key->numeros) . ' => ' . implode(", ", $key->estrelas) . '</td>
                            <td>' . implode(", ", $key->numeros) . '</td>
                            <td>' . implode(", ", $key->estrelas) . '</td>
                        </tr>
                    ';
                }
            ?>

            </tbody>
        </table>

        <br>
        <form method="POST">
            <button name="createkey" value="1">Gerar Chave</button>
            <button name="delete" value="1"> Limpar Chave</button>
        </form>
    </div>
</section>

</body>

</html>

