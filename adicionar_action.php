<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo); // Instanciando a classe UsuarioDaoMysql

// CREATE
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if($name && $email){

    if($usuarioDao->findByEmail($email) === false) { // Caso não tenha nenhum usuario com o email, preencher.
        $novoUsuario = new Usuario(); // Instanciando um novo usuario
        $novoUsuario->setNome($name); // Setando o nome
        $novoUsuario->setEmail($email); // Setando o email

        $usuarioDao->add($novoUsuario); // Mandando(add) o $novoUsuario para $usuarioDao para ser adicionado no DB

        header("Location: index.php");
        exit;
    } else { // Caso não achar o email, renderizando para o arquivo adicionar
        header("Location: adicionar.php");
        exit;
    }

/*  // Código substituído pelo código de cima
    // Realizando uma verificação de campos(email) já existentes
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email"); // Consultando email
    $sql->bindValue(':email', $email);
    $sql->execute();
    // Verificando se já existe o email
    if($sql->rowCount() == 0) {

        // Montando o template para inserção no DB
        $sql = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:name, :email)");
        // Realizando açociações para o template
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        // Executando
        $sql->execute();

        header("Location: index.php");
        exit;
    }else{ // Voltando para o adicionar
        header("Location: adicionar.php");
        exit;
    }    
*/
}else{
    header("Location: adicionar.php");
    exit;
}