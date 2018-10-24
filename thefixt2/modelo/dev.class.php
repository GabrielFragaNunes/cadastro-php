<?php
Class Dev{
  private $idDev;
  private $nomedev;
  private $projetodev;
  private $salariodev;
  private $idadedev;
  private $emaildev;
  private $tipodev;

  public function __construt(){}
  public function __destruct(){}

  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}

  public function __toString(){
    return nl2br("
                  Nome do desenvolvedor: $this->nomedev
                  Projeto: $this->projetodev
                  Salário: $this->salariodev
                  Idade: $this->idadedev
                  email: $this->emaildev
                  tipo: $this->tipodev");
  }
}
