<?php
require 'conexaobanco.class.php';
 class ProjDAO {
   private $conexao = null;

   public function __construct(){
     $this->conexao = ConexaoBanco::getInstance();
   }

   public function __destruct(){}

   public function cadastrarProj($proj){
     try{
       $stat=$this->conexao->prepare("insert into projetos
                                    (idProj,nomeproj,responsavel,duracao,tipoproj,devproj)
                                    values(null,?,?,?,?,?)");
       $stat->bindValue(1, $proj->nomeproj);
       $stat->bindValue(2, $proj->responsavel);
       $stat->bindValue(3, $proj->duracao);
       $stat->bindValue(4, $proj->tipoproj);
       $stat->bindValue(5, $proj->devproj);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }
   }

   public function buscarProj(){
     try{
       $stat = $this->conexao->query("select * from projetos");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Proj');
       return $array;
       echo "Erro ao buscar Projetos! ".$e;
     }catch(PDOException $e){
     }
   }

   public function filtrar($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos": $query = "";
         break;

         case "id": $query = "where idProj = ".$pesquisa;
         break;

         case "nome": $query = "where nomeproj like '%".$pesquisa."%'";
         break;

         case "duracao": $query = "where duracao like '%".$pesquisa."%'";
         break;

         case "responsavel": $query = "where responsavel like '%".$pesquisa."%'";
         break;

         case "tipo": $query = "where tipoproj like '%".$pesquisa."%'";
         break;

         case "dev": $query = "where devproj like '%".$pesquisa."%'";
         break;
       }

       $stat = $this->conexao->query("select * from projetos {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Proj');
       return $array;

     }catch(PDOException $e){
       echo "Erro ao filtrar projetos. ".$e;
     }
   }

   public function alterarProj($proj){
     try{
       $stat = $this->conexao->prepare("update projetos set nomeproj=?, responsavel=?, duracao=?, tipoproj=?, devproj=? where idProj=?");

       $stat->bindValue(1, $proj->nomeproj);
       $stat->bindValue(2, $proj->responsavel);
       $stat->bindValue(3, $proj->duracao);
       $stat->bindValue(4, $proj->tipoproj);
       $stat->bindValue(5, $proj->devproj);
       $stat->bindValue(6, $proj->idProj);
       $stat->execute();

     }catch(PDOException $e){
       echo "Erro ao alterar Projeto! ".$e;
     }
   }

   public function deletarProj($idProj){
     try{
       $stat = $this->conexao->prepare("delete from projetos where idProj = ?");
       $stat->bindValue(1, $idProj);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao excluir projeto! ".$e;
     }
   }
 }
