<?php

/* Basico para conexão

$pdo = new PDO("mysql:dbname=test;host=localhost", "root", ""); // dados iniciais para conexão com DB

// Realizando uma consulta
$sql = $pdo->query('SELECT * FROM usuarios');

// Mostrando a quantidade de registros
echo "TOTAL: ".$sql->rowCount(); // 'rowCount' Contagem de linhas

// Pegando todos os registros e salvando em uma variável
$dados = $sql->fetchAll( PDO::FETCH_ASSOC ); // PDO::FETCH_ASSOC realiza uma açossiação e evita informaçoes duplicadas


echo '<pre>';
// Mostrando os registros
print_r($dados);

*/

/* CRUD
* C - CREATE
* R - READ
* U - UPDATE
* D - DELETE
*/

require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo); // Instanciando a classe UsuarioDaoMysql
$lista = $usuarioDao->findAll(); // Selecionando todos usuarios(no arquivo UsuariodaoMysql), retornando um array com objetos do tipo usuario

/*
// READ (código trocado pelo código de cima)
$lista = []; // Criando uma variável array para armazenar usuários
$sql = $pdo->query("SELECT * FROM usuarios"); // Selecionando todos os usuários
// Verificando se tem itens nos usuário selecionados acima
if($sql->rowCount() > 0){
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC); // Salvando usuários no array, o PDO::FETCH_ASSOC é para evitar informações duplicadas
}
*/
?>

<a href="adicionar.php">ADICIONAR USUÁRIO</a>

<table border='1' width='100%'>
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>EMAIL</th>
        <th>AÇÕES</th>
    </tr>
    <?php foreach($lista as $usuario): ?> <!-- Abrindo foreach, para poder usar html de uma forma mais organizada-->
        <tr>
            <td><?=$usuario->getId(); ?></td>
            <td><?=$usuario->getNome(); ?></td>
            <td><?=$usuario->getEmail(); ?></td>
            <td>
                <!-- Vinculando os link de excluir e editar com o id, para ter a referência de quem se trata -->
                <a href="editar.php?id=<?=$usuario->getId(); ?>">[ EDITAR ]</a>
                <a href="excluir.php?id=<?=$usuario->getId(); ?>" onclick="return confirm('Tem certeza que deseja excluir?')">[ EXCLUIR ]</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
