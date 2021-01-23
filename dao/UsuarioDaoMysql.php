<?php
require_once 'models/Usuario.php'; // Puxando o arquivo da interface

class UsuarioDaoMysql implements UsuarioDAO { // Implementando a interface
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function add(Usuario $u) {    // Para adicionar(criar) usuarios (Recebe o usuario e implementa no DB)
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
        $sql->bindValue(':nome', $u->getNome());
        $sql->bindValue(':email', $u->getEmail());
        $sql->execute();

        $u->setId( $this->pdo->lastInsertId() );  // utilizando um método do pdo para pegar o último id que foi inserido na requisição e jogando no setId
        return $u; // Retornando o id, para completar as informações

    }

    public function findAll() {          // Retorna uma lista de todos os usuarios criados(facilitando pesquisa)
        $array = [];
        
        $sql = $this->pdo->query("SELECT * FROM usuarios"); // Realizando uma consulta ao BD
        if($sql->rowCount() > 0) {       // verificando se tem itens 
            $data = $sql->fetchAll();

            foreach($data as $item) { // 
                $u = new Usuario();     // Criando um usuario
                $u->setId($item['id']); // Preenchendo o usuario criado com o id
                $u->setNome($item['nome']); // Preenchendo o usuario criado com o nome
                $u->setEmail($item['email']); // Preenchendo o usuario criado com o email

                $array[] = $u;
            }
        }
        
        return $array;
    }

    public function findByEmail($email) {
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();
        if($sql->rowCount() > 0){ // verificando se tem usuario com o email
            $data = $sql->fetch();

            $u = new Usuario();
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);

            return $u; // Retornando o objeto
        }else{
            return false;
        }
    }

    public function findById($id) {      // Para quando quiser encontrar algun id

    }

    public function update(Usuario $u) { // Para atualizar o banco de dados

    }

    public function delete($id) {         // Para deletar é preciso somente o id

    } 
}

?>