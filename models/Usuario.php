<?php

// Criando classe Usuario
class Usuario{
    private $id;
    private $nome;
    private $email;

    public function getId(){
        return $this->id;
    }
    public function setId($i){
        $this->id = trim($i); // trim - Serve para retirar possíveis espaços em branco
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($n){
        $this->nome = ucwords(trim($n));  // ucwords - Serve para deixar a primeira letra do nome sempre maiuscula
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($e){
        $this->email = strtolower(trim($e)); // strtolower - forçar para que o email fique sempre em letras minusculas
    }
}

// Criando uma interfaçe do DAO para padronizar o código
interface UsuarioDAO{
    public function add(Usuario $u); // Para adicionar(criar) usuarios 
    public function findAll();  // Retorna uma lista de todos os usuarios criados(facilitando pesquisa)
    public function findByEmail($email); // Para quando for encontrar por email
    public function findById($id); // Para quando quiser encontrar algun id
    public function update(Usuario $u); // Para atualizar o banco de dados
    public function delete($id); // Para deletar é preciso somente o id
}

