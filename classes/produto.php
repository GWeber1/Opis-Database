<?php
namespace Base;

class Produto{
  public function getProdutos() {
    $database = new \Connector();
    $db = $database->getDatabaseConnection();
    $result = $db->from('produtos')
      ->orderBy('id_produtos', 'desc')
      ->distinct()
      ->limit(30)
      ->offset(100)
      ->select()
      ->all();
    return $result;

    function Foo(){
      $this->getProdutos();

    }
  }
}
$produto = new Produto();
$produto->Foo();
?>
