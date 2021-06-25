<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
<?php
include('vendor/autoload.php');

use Opis\Database\Database;
use Opis\Database\Connection;

$connection = new Connection( //Conexão com o banco de dados
    'mysql:host=localhost;dbname=gabrielusina_teste',
    'gabrielusina_gabrielusina',
    'mdD=i0B{q-)c'
);
$db = new Database($connection);
class Produtos {
  public $id_produtos; //declaração das variáveis que receberão os valores da coluna
  public $nome_produtos;
  public $data_entrada_produtos;
  public $data_validade_produtos;
  public $palavras_chave_produtos;
  public $quantidade_estoque_produtos;
  public $quantidade_vendas_produto;
  
  public $id_fornecedores;
  public $nome_fornecedores;


  public function produtos() { //passagem de valores para a função que monta a view da tabela com os dados dos produtos
    echo 'ID Produto: ' . $this->id_produtos, '<br>';
    echo 'Nome do Produto: ' . $this->nome_produtos, '<br>';
    echo 'Data de Validade: ' . $this->data_validade_produtos, '<br>';
    echo '<br>';
  }

  public function fornecedores() { //passagem de valores para a função que monta a view da tabela com os dados dos fornecedores
    echo 'ID do Fornecedor: ' . $this->id_fornecedores, '<br>';
    echo 'Nome do Fornecedor: ' . $this->nome_fornecedores, '<br>';
    echo '<br>';
  }
}
$result_produtos = $db->from('produtos') //"SELECT id_produtos, nome_produtos, data_validade_produtos FROM produtos"
  ->select(['id_produtos', 'nome_produtos', 'data_validade_produtos'])
  ->fetchClass('Produtos') //Envio dos dados do banco para a classe
  ->all();

$result_fornecedores = $db->from('fornecedores') //"SELECT id_fornecedores, nome_fornecedores FROM produtos" (Chaves estrangeiras da tabela Fornecedores)
  ->select(['id_fornecedores', 'nome_fornecedores'])
  ->fetchClass('Produtos') //Envio dos dados do banco para a classe
  ->all();
  /*
$result = $db->insert(array( /*"INSERT INTO produtos(nome_produtos, data_entrada_produtos, data_validade_produtos, palavras_chave_produtos,
                              quantidade_estoque_produtos, quantidade_vendas_produtos, id_fornecedores, nome_fornecedores VALUES(
                              'Monitor 15 polegadas', "2021-24-06", "2022-24-06", 'Computador', '112', '15', '3', 'Magazineluiza'")*//*
    'nome_produtos' => 'Monitor 15 polegadas', 
    'data_entrada_produtos' => '"2021-24-06"',
    'data_validade_produtos' => '"2022-24-06"',
    'palavras_chave_produtos' => 'Computador',
    'quantidade_estoque_produtos' => '112',
    'quantidade_vendas_produto' => '15',
    'id_fornecedores' => '3',
    'nome_fornecedores' => 'Magazineluiza'
))
->into ('produtos');
*/
?> 
<!-- Envio das informações em PHP para a interface com bootstrap através do HTML -->
<div class="card"> 
  <div clasd="card-body">
    <div class="container", align="center">
      <div class="col">
        Produtos Cadastrados
      </div>
    </div>
  </div>
</div>
<?
foreach($result_produtos as $produtos) {
  $produtos->produtos();
}
?>

<div class="card">
  <div clasd="card-body">
    <div class="container", align="center">
      <div class="col">
        Fornecedores Cadastrados
      </div>
    </div>
  </div>
</div>
<?
foreach($result_fornecedores as $fornecedores) {
  $fornecedores->fornecedores();
}
?>
