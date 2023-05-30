<?php

function escreveTabuada($num)
{
    echo '<ul>';

    for ($i = 0; $i <= 10; $i++) {
        $result = $i * $num;
        echo "<li>$i x $num = $result </li>";
    }

    echo '</ul>';
}

$numeroSelecionado = null;

?>

    <form method="POST">

        Escreva um numero:
        <input type="number" name="numero">

        <button type="submit">Enviar</button>

    </form>

    <form style="margin-top:200px" method="POST" action="processa_tabuada.php">
        <b>
            Processa o form num ficheiro à parte
            <br>
        </b>
        Escreva um numero:
        <input type="number" name="numero">

        <button type="submit">Enviar</button>

    </form>

<?php
if (!empty($_POST)) {
    $numeroSelecionado = $_POST['numero'];

    ?>

    <div style="background-color:cyan; padding:40px;">
        <h3>A tabuada é:</h3>
        <h1> <?php escreveTabuada($numeroSelecionado); ?> </h1>
    </div>

    <?php
}
?>