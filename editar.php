<?php

// UPDATE

require 'config.php';

$info = []; //Variável para informações de usuário

// Pegando o id
$id = filter_input(INPUT_GET, 'id');
// Verificando se existe id
if($id){

    // Procurando o id
    $sql = $pdo->prepare("SELECT *FROM usuarios WHERE id = :id");
    // Substituindo os dados
    $sql->bindValue(':id', $id);
    $sql->execute();

    // Verificando se existe
    if($sql->rowCount() > 0){

        // Pegando o primeiro item, fetch para pegar um dado especifico, fetchAll parapegar todos.
        $info = $sql->fetch( PDO::FETCH_ASSOC );

    }else{
        header("location: index.php");
        exit;
    }


}else{
    header("Location:index.php");
    exit;
}



?>

<h1>EDITAR USUÁRIO</h1>

<form method='POST' action='editar_action.php'>
    <input type="hidden" name="id" value="<?=$info['id'];?>"

    <label>
        Nome:<br/>
        <input type="text" name="name" value="<?=$info['nome'];?>" />
    </label><br/><br/>

    <label>
        E-mail:<br/>
        <input type="email" name="email" value="<?=$info['email'];?>" />
    </label><br/><br/>

    <input type="submit" value="Salvar" />

</form>