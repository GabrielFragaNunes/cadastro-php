<?php
session_start();
ob_start();
include_once 'dao/devdao.class.php';
include_once 'modelo/dev.class.php';
include_once 'util/helper.class.php';
$devDAO = new DevDao();
$array = $devDAO->buscarDev();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Consulta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/home.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="jumbotron bg-info">Consulta de Devs</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Sistema</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro-dev.php">Cad. Devs <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro-gerente.php">Cad. Gerentes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro-proj.php">Cad. Projetos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-devs.php">Cons. Devs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-gerentes.php">Cons. Gerentes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consulta-projs.php">Cons. Projetos</a>
          </li>
        </ul>
      </div>
    </nav>
    <h2>Consulta de Desenvolvedores!</h2>
    <?php
    if(isset($_SESSION['msg'])){
      Helper::alert($_SESSION['msg']);
      unset($_SESSION['msg']);
    }

    if(count($array) == 0){
        echo "<h2>Não há Devs no banco!</h2>";
        return;
    }
    ?>
    <form name="filtrar" method="post" action="">
      <div class="row">
        <div class="form-group col-md-6">
          <input type="text" name="txtfiltro" placeholder="Digite a sua pesquisa" class="form-control">
        </div>
        <div class="form-group col-md-6">
          <select name="selfiltro" class="form-control">
            <option value="todos">Todos</option>
            <option value="id">Id</option>
            <option value="nome">Nome</option>
            <option value="projeto">Projeto</option>
            <option value="salario">Salário</option>
            <option value="idade">Idade</option>
            <option value="email">Email</option>
            <option value="tipo">Tipo</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary btn-block">
      </div>
    </form>

    <?php
    if(isset($_POST['filtrar'])){
      $pesquisa = $_POST['txtfiltro'];
      $filtro = $_POST['selfiltro'];
      if(!empty($pesquisa)){
        $devDAO = new devDAO();
        $array = $devDAO->filtrar($pesquisa,$filtro);
        if(count($array) == 0){
        }
      }else{
        echo "<h3>Sua pesquisa não retornou nenhum dev!</h3>";
      }
    }
    ?>

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th>Consulta</th>
            <th>Nome</th>
            <th>Projeto</th>
            <th>Salario</th>
            <th>Idade</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Consulta</th>
            <th>Nome</th>
            <th>Projeto</th>
            <th>Salario</th>
            <th>Idade</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Excluir</th>
            <th>Alterar</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach($array as $l){
            echo "<tr>";
              echo "<td>$l->idDev</td>";
              echo "<td>$l->nomedev</td>";
              echo "<td>$l->projetodev</td>";
              echo "<td>$l->salariodev</td>";
              echo "<td>$l->idadedev</td>";
              echo "<td>$l->emaildev</td>";
              echo "<td>$l->tipodev</td>";
              echo "<td><a href='consulta-devs.php?id=$l->idDev' class='btn btn-danger'>Excluir</a></td>";
              echo "<td><a href='alterar-dev.php?id=$l->idDev' class='btn btn-warning'>Alterar</a></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
  if(isset($_GET['id'])){
    $devDAO->deletarDev($_GET['id']);
    $_SESSION['msg'] = "Dev excluído com sucesso!";
      header("location:consulta-devs.php");
  }
  ?>
</body>
</html>
