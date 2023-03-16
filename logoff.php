<?php
    session_start();
    //remover o indice 'autenticado' (indice especifico) da $_SESSION com 'unset()'
    //unset($_SESSION['autenticado']); //remove apenas se existir, nao acontece erro caso nao exista

    //eliminar toda a $_SESSION com todos os seus indices
    session_destroy();
    header('Location: index.php');

?>