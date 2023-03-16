<?php
session_start();
// Todas as páginas podem acessar aos índices determinados em outras paginas
// Similar ao Static em Java na POO
// echo $_SESSION['autenticado'];

// SISTEMA DE PROTEÇAO DAS PÁGINAS PROTEGIDAS:
// Após o usuário se autenticar (ou tentar), é criado um índice 'autenticado' na $_SESSION com o valor 'SIM' ou 'NAO'
// Se nao tentar se autenticar, o índice nao é criado e, por isso, é conferido se este índice existe com 'isset' no if abaixo.
// Portanto, se índice existir e se seu valor for igual a 'NAO', o usuario será redirecionado para a página de login, ao mesmo tempo que o parametro 'login=erro2' é inserido na url da página de login.
// É utilizado 'erro2' porque 'erro' ja foi anteriormente definido (utilizado em index.php para deixar a mensagem de erro dinamica).

if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM'){
header('Location: index.php?login=erro2');
}
?>

