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

escreveTabuada($_POST['numero']);


?>
