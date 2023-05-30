<?php

// 1 Defenir um array vazio
// 2  preencher esse array com o que tiver guardado num ficheiro => chavesguardadas.txt
//    -> criar no caso de não existir
// 3 mostrar na tabela as chaves\estrelas que estão criadas
// 4 botão para criar nova chave
// 5  -> Guardar e criar as chaves e estrelas num array associativo [ ['estrelas'=> '1,3', 'chave'=> '1,2,3,4,5,6' ] ]
// 6  -> mostrar na tabela as chaves\estrelas que estão criadas
// 7 botão para delete de todas as chaves
// 8  -> eliminar todo o conteudo do ficheiro, e limpar o array.
// 9  -> mostrar a tabela vazia

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

$_filename = 'chavesguardadas.txt';

if (!file_exists($_filename)) {
    // Criar o ficheiro
    file_put_contents($_filename, json_encode([]));
}

// ver o conteudo do ficheiro num array
$conteudo = file_get_contents($_filename, true);


$listKeys = json_decode($conteudo);

if (!empty($_POST)) {
    if (isset($_POST['createkey'])) {
        $key = [
            'estrelas' => generateNumbers(1, 5, 2),
            'numeros' => generateNumbers(1, 50, 5)
        ];

        array_push($listKeys, (object)$key);


        file_put_contents($_filename, json_encode($listKeys));
    }

    if (isset($_POST['delete'])) {
        $listKeys = [];
        file_put_contents($_filename, json_encode([]));
    }
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

