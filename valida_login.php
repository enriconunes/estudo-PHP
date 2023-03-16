<?php

    /*
    LEITURA DO FORMULARIO PELA URL - $_GET
    *É possivel visualizar a senha, por isso, neste caso, nao vai ser utilizado.

    
    // $_GET retorna toda a url em forma de array
    // O valor de cada input do site é passado para a url e o seu 'name' passa a ser um índice do array.
    print_r($_GET);

    echo '<br/>';

    echo $_GET["email"] . '<br/>';
    echo $_GET["senha"];
    

    // LEITURA DO FORMULARIO COM $_POST
    // Com $_POST os valores nao sao exibidos na url
    // configurar form com 'method="post"'
    print_r($_POST);

    echo '<br/>';

    echo $_POST["email"] . '<br/>';
    echo $_POST["senha"];
    */

    session_start();


    $perfis = array(1 => 'Administrativo', 2 => 'Usuario');

    $usuarios_app = array(
        array('id' => 1, 'email' => 'adm@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
        array('id' => 2, 'email' => 'user@teste.com.br', 'senha' => 'guest', 'perfil_id' => 2),
        array('id' => 3, 'email' => 'jose@teste.com.br', 'senha' => 'guest', 'perfil_id' => 2),
        array('id' => 4, 'email' => 'maria@teste.com.br', 'senha' => 'guest', 'perfil_id' => 2)
    );

    // Listar perfis existentes e comparar com o user do form
    echo 'Perfis Catalogados: <br/>';

    $autenticado = false;
    $usuario_id = null;
    $usuario_perfil_id = null;

    foreach($usuarios_app as $user){
        echo $user['email'] . ' / ' . $user['senha'] . '<br/>';

        // Comparacao
        if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']){
            $autenticado = true;
            // recupera o id do usuario encontrado
            $usuario_id = $user['id'];
            $usuario_perfil_id = $user['perfil_id'];
        }
    }

    if($autenticado){
        echo 'Perfil Autenticado!';
        // cria um index 'autenticado' na variavel de seçao
        $_SESSION['autenticado'] = 'SIM';
        // 'id' passa a ser o id do usuario autenticado nesta seçao
        $_SESSION['id'] = $usuario_id;
        header('Location: home.php');
        $_SESSION['perfil_id'] = $usuario_perfil_id;
    } else{
        $_SESSION['autenticado'] = 'NAO';
        header('Location: index.php?login=erro');
    }

    // print_r($_SESSION['id']);
    

?>