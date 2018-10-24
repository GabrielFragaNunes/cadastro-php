<?php
Class Proj{
  private $idProj;
  private $nomeproj;
  private $responsavel;
  private $duracao;
  private $tipoproj;
  private $devproj;

  public function __construt(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}

  public function __toString(){
    return nl2br("
                  Nome: $this->$nomeproj
                  Responsável: $this->$responsavel
                  Duração: $this->$duracao
                  Tipo: $this->$tipoproj
                  Dev: $this->$devproj");
  }
}
