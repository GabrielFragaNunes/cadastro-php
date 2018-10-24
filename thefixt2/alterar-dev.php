<?php
session_start();
ob_start();
include_once 'util/helper.class.php';

if(isset($_GET['id'])){
  include_once "dao/devdao.class.php";
  include_once "modelo/dev.class.php";
  $dev = new DevDAO();
  $array = $dev->filtrar($_GET['id'],"codigo");
  // var_dump($array); //só teste
  $dev = $array[0];
  // echo $dev; //toString
}else{
  header("location:consulta-devs.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title class="title">Edição de Devs</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
  <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script> src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
  <script> src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
  <body>
      <div class="container">
        <h1 class="jumbotron bg-info">Edição de Dev</h1>

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
        <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
        ?>

        <form name="caddev" method="post" action="">
          <div class="form-group">
            <input type="text" name="txtnome" placeholder="Nome do desenvolvedor" class="form-control" value="<?php if(isset($dev)){echo $dev->nomedev; }?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtprojeto" placeholder="Projeto em desenvolvimento" class="form-control" value="<?php if(isset($dev)){echo $dev->projetodev; }?>">
          </div>
          <div class="form-group">
            <input type="number" name="numidade" placeholder="Idade do desenvolvedor" class="form-control" value="<?php if(isset($dev)){echo $dev->idadedev; }?>">
          </div>
          <div class="form-group">
            <input type="number" name="numsalario" placeholder="Salário do desenvolvedor" class="form-control" value="<?php if(isset($dev)){echo $dev->salariodev; }?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtemail" placeholder="Email do desenvolvedor" class="form-control" value="<?php if(isset($dev)){echo $dev->emaildev; }?>">
          </div>
          <div class="form-group">
            <select name="seltipo" class="form-control">
              <option value="web" <?php if(isset($dev)){if($dev->tipodev == "web"){echo "selected='selected'";}} ?>>WEB</option>
              <option value="mobile"  <?php if(isset($dev)){if($dev->tipodev == "mobile"){echo "selected='selected'";}} ?>>MOBILE</option>
            </select>
          </div>

          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          if(isset($_POST['alterar'])){
            include_once 'modelo/dev.class.php';
            include_once 'dao/devdao.class.php';
            include 'util/padronizacao.class.php';

            $dev = new Dev();
            $dev->idDev = $_GET['id'];
            $dev->nomedev = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtnome']));
            $dev->projetodev = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtprojeto']));
            $dev->idadedev = ($_POST['numidade']);
            $dev->salariodev = $_POST['numsalario'];
            $dev->emaildev = Padronizacao::antiXSS(Padronizacao::padronizarMin($_POST['txtemail']));
            $dev->tipodev = Padronizacao::antiXSS($_POST['seltipo']);

            $devDAO = new devDao();
            $devDAO->alterarDev($dev);
            $_SESSION['msg'] = "Desenvolvedor alterado com sucesso!";
            header("location:cadastro-dev.php");
            ob_end_flush();
          }
        ?>
      </div>
  </body>
</html>
