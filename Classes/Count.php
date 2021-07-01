<?php 

include('vendor/autoload.php'); /*Diferente do que a documentação diz, 
                                  após instalação das dependências pelo Composer devemos chamar o arquivo autoload gerado automaticamente na pasta 'Vendors'
                                  criada no diretório raíz. */
use Opis/Database/Database;
use Opis/Database/Connection; //Aqui chamamos as funções do Opis Database (Lembrando que estamos usando a versão 4.x)

$connection = new Connection(
  'mysql:host=localhost;dbname=teste', /*chamada do host onde o banco está hospedado e o nome dele, 
                                         como a Connection funciona através de uma DSN, utilizamos o prefixo 'mysql:' */
  'root', //Usuário
  'root'  //Senha
);

$db = new Database($connection);
$count = $sdb->from('produtos')->count(); //SELECT COUNT(*) FROM produtos;
echo 'Há'. $count . 'registros na tabela Produtos'; //Retorno da quantidade de registros dentro da tabela chamada na linha 17;
 ?>
