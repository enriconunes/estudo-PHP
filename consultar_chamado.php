<?php
  require_once "validador_acesso.php";
?>

<?php
  // LEITURA DOS CHAMADOS
  $chamados = array();

  // abrir para a leitura
  $arquivo = fopen('arquivo.txt', 'r');

  // recuperar todas as linhas ate chegar ao final do arquivo
  // eof = end of file (retorna true no final e false enquanto houver linhas)
  while(!feof($arquivo)){
    $texto_lido = fgets($arquivo);
    // cria sempre um novo indice para armazenar o texto lido
    $chamados[] = $texto_lido;
  }

  fclose($arquivo);
?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav_item">
          <a href="logoff.php" class="nav-ling">Sair</a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">
              
             <!-- $chamados é um array em que seus indices correspondem à uma linha do arquivo lido (linha = chamado) -->
             <!-- Com o foreach, $chamado passa a corresponder à um dos índices de $chamados em cada interaçao do ciclo -->
              <?php foreach($chamados as $chamado) {?>

                <?php
                  //explode recebe uma string e retorna um array com os índices separados por um delimitador. Neste caso, #.
                  $chamado_dados = explode('#', $chamado);

                  // perfil == 2 corresponde ao perfil de usuario
                  if($_SESSION['perfil_id'] == 2){
                    //so exibir o chamado se ele for criado pelo usuario
                    // $chamado_dados[0] contem o id do usuario que escreveu o chamado
                    // $_SESSION['id'] contem o id do usuario que está na seção atual
                    if($_SESSION['id'] != $chamado_dados[0]){
                      // pula todos os proximos comandos do ciclo
                      continue;
                    }
                    
                  }

                  // A ultima linha do arquivo de texto sempre será vazia e essa linha tambem será lida e armazenada no array de chamados. Portan.to, ao fazer a leitura de seus dados [1], [2] e [3], haverá um erro, haja vista que estes índices nao existem. Dessa forma, utiliza-se o if abaixo para observar se existe pelo menos 3 índices em cada linha de chamado e, se não houver, o 'continue' ignora todos os proximos comandos do ciclo e volta ao inicio.
                  if(count($chamado_dados) < 3){
                    continue;
                  }
                ?>

                <!-- Replica este card com o ciclo for -->
                <div class="card mb-3 bg-light">
                  <div class="card-body">
                    <!-- tag de impressao (< ?= ?>) -->
                    <!-- ao analisar o arq. de texto, é possivel visualizar a distribuição das informações em cada índice separado pelo '#' -->
                    <h5 class="card-title"><?=$chamado_dados[1]?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?=$chamado_dados[2]?></h6>
                    <p class="card-text"><?=$chamado_dados[3]?></p>
                  </div>
                </div>

              <?php } ?>

              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" href="home.php">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>