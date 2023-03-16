<?php

    echo '<pre>';
        print_r($_POST);
    echo '</pre>';

    if($_POST['titulo'] == "" || $_POST['descricao'] == ""){

        // campos em branco
        header('Location: abrir_chamado.php?envio=invalido');

    } else{
        // todos os campos preenchidos
        session_start();

        $titulo = str_replace('#', '-', $_POST['titulo']);
        $categoria = str_replace('#', '-', $_POST['categoria']);
        $descricao = str_replace('#', '-', $_POST['descricao']);

        // PHP_EOL = Quebra de linha
        $texto = $_SESSION['id'] . '#' . $titulo . '#' . $categoria . '#' .  $descricao . PHP_EOL;

        // abrir para a escrita
        $arquivo = fopen('arquivo.txt', 'a');
        // escrever no arquivo
        fwrite($arquivo, $texto);
        // fechar arquivo
        fclose($arquivo);

        header('Location: abrir_chamado.php?envio=ok');

    }

?>