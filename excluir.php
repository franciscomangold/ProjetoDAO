<?php

// DELETE

require 'config.php';

// Pegando o id
$id = filter_input(INPUT_GET, 'id');
// Verificando se existe id
if($id){
    
    $sql = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    
}

header("Location:index.php");
exit;

?>