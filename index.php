<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriz Reduzida</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Matriz Reduzida de Dígitos</h1>
        <form method="POST">
            <label for="elements">Elementos da primeira linha (insira uma string):</label>
            <input type="text" id="elements" name="elements" required>

            <button type="submit">Gerar Matriz</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            define('MAX', 100);

            function reduceDigit($num) {
                return 1 + (($num - 1) % 9);
            }

            function printMatrix($M, $rows) {
                echo '<table>';
                for ($i = 0; $i < $rows; $i++) {
                    echo '<tr>';
                    if($i>0){
                        for($x=0;$x<$i;$x++){
                        echo '<td>  </td>';//espaços em branco
                        }        
                    }
                    for ($j = 0; $j < $rows - $i; $j++) {
                        echo '<td>' . $M[$i][$j] . '</td><td>  </td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
            }

            $M = array_fill(0, MAX, array_fill(0, MAX, 0));
            $elements = str_split(trim($_POST['elements'])); // Divide a string em caracteres
            $n = count($elements); // Conta o número de caracteres

            for ($i = 0; $i < $n; $i++) {
                $M[0][$i] = intval($elements[$i]); // Converte cada caractere em um número
            }

            for ($i = 1; $i < $n; $i++) {
                for ($j = 0; $j < $n - $i; $j++) {
                    $M[$i][$j] = $M[$i - 1][$j] + $M[$i - 1][$j + 1];
                    $M[$i][$j] = reduceDigit($M[$i][$j]);
                }
            }

            printMatrix($M, $n);
        }
        ?>
    </div>
</body>
</html>
