<?php

function calculaNumero($num)
{
    if ($num > 0) {
        return 'Valor Positivo';
    }
    if ($num < 0) {
        return 'Valor Negativo';
    }
    if ($num == 0) {
        return 'Valor igual a zero';
    }
}

$resultado = '';
$numeroSelecionado = '';
if (!empty($_POST)) {
    $numeroSelecionado = $_POST['numero'];
    $resultado = calculaNumero($numeroSelecionado);
}

?>

<form method="POST">

    Escreva um numero:
    <input type="number" name="numero">

    <button type="submit"> Enviar</button>

</form>


<div style="background-color:cyan; padding:40px;">
    <h3>Resultado é:</h3>
    <h1> <?php echo $resultado ?> </h1>
    <h5> para o numero: <?php echo $numeroSelecionado; ?> </h5>
</div>