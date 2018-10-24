<?php
session_start();
ob_start();
include_once 'util/helper.class.php';

if(isset($_GET['id'])){
  include_once "modelo\projeto.class.php";
  include_once "dao\projetodao.class.php";
  $proj = new ProjDAO();
  $array = $proj->filtrar($_GET['id'],"codigo");
  // var_dump($array); //só teste
  $proj = $array[0];
  // echo $dev; //toString
}else{
  header("location:consulta-projs.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Edição de Projetos</title>
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
        <h1 class="jumbotron bg-info">Edição de Projetos</h1>

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
            <input type="text" name="txtnome" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Nome" class="form-control" value="<?php if(isset($proj)){echo $proj->nomeproj; }?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtresponsavel" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Nome do Gerente" class="form-control" value="<?php if(isset($proj)){echo $proj->responsavel; }?>">
          </div>
          <div class="form-group">
            <input type="number" name="numduracao" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Duração" class="form-control" value="<?php if(isset($proj)){echo $proj->duracao; }?>">
          </div>
          <div class="form-group">
            <input type="text" name="txtdev" pattern="[A-zÁ-ü ]{2,50}"  placeholder="Desensolvedor" class="form-control" value="<?php if(isset($proj)){echo $proj->devproj; }?>">
          </div>
          <div class="form-group">
            <select name="seltipo" class="form-control">
              <option value="web" value="<?php if(isset($proj)){echo $proj->tipoproj; }?>">WEB</option>
              <option value="mobile" value="<?php if(isset($proj)){echo $proj->tipoproj; }?>">MOBILE</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
        <?php
          if(isset($_POST['alterar'])){
            include_once 'modelo/projeto.class.php';
            include_once 'dao/projetodao.class.php';
            include 'util/padronizacao.class.php';

            $proj = new Proj();
            $proj->idProj = $_GET['id'];
            $proj->nomeproj = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtnome']));
            $proj->responsavel = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtresponsavel']));
            $proj->duracao = ($_POST['numduracao']);
            $proj->devproj = Padronizacao::antiXSS(Padronizacao::padronizarMaiMin($_POST['txtdev']));
            $proj->tipoproj = Padronizacao::antiXSS($_POST['seltipo']);

            $projDAO = new ProjDAO();
            $projDAO->alterarProj($proj);
            $_SESSION['msg'] = "Projeto alterado com sucesso!";
            header("location:cadastro-proj.php");
            ob_end_flush();
          }
        ?>
      </div>
  </body>
</html>
