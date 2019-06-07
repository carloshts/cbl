<?php

/*Classe com os metodos de manipulação de dados da tabela usuario */

//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class UsuarioDAO {
    //Metodo de inserção de dados na tabela usuario
    public function InserirUsuario(UsuarioDTO $UsuarioDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela usuario
            $sql = "INSERT INTO usuario(usuario,senha,tipo) VALUES (?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe UsuarioDTO
            $stmt->bindValue(1, $UsuarioDTO->getUsuario());
            $stmt->bindValue(2, $UsuarioDTO->getSenha());
            $stmt->bindValue(3, $UsuarioDTO->getTipo());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela Usuario
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela usuario
            $sql = "SELECT * FROM usuario";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $usuarios;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela usuario cujo o id seja igual ao setado no atributo idusuario da classe UsuarioDTO
    public function PesquisarUsuarioByID(UsuarioDTO $UsuarioDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela usuario
            $sql = "SELECT * FROM usuario WHERE id_usuario LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idusuario
            $stmt->bindValue(1, $UsuarioDTO->getIdusuario());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $usuario;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa os dados na tabela usuario cujo o usuario seja igual ao setado no atributo usuario da classe UsuarioDTO
    public function PesquisarUsuarioExistente(UsuarioDTO $UsuarioDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela usuario
            $sql = "SELECT * FROM usuario WHERE usuario = ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idcliente
            $stmt->bindValue(1, $UsuarioDTO->getUsuario());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $qtd = count($usuarios);
            //retorna true se existir usuario
            if($qtd != 0){
                return TRUE;
            }  else {
                return FALSE;
            }
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa os dados na tabela usuario cujo o usuario seja igual ao setado no atributo usuario da classe UsuarioDTO
    public function PesquisarUsuarioByUsuario(UsuarioDTO $UsuarioDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela usuario
            $sql = "SELECT * FROM usuario WHERE usuario LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idcliente
            $stmt->bindValue(1, $UsuarioDTO->getUsuario()."%");
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $cliente;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de alteração de dados na tabela usuario
    public function AlterarUsuario(UsuarioDTO $UsuarioDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela usuario
            $sql = "UPDATE usuario SET usuario=?,senha=?,tipo=? WHERE id_usuario=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe UsuarioDTO
            $stmt->bindValue(1, $UsuarioDTO->getUsuario());
            $stmt->bindValue(2, $UsuarioDTO->getSenha());
            $stmt->bindValue(3, $UsuarioDTO->getTipo());
            $stmt->bindValue(4, $UsuarioDTO->getIdusuario());

            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela usuario cujo o id seja igual ao setado no atributo idusuario da classe UsuarioDTO
    public function ExcluirUsuarioById(UsuarioDTO $UsuarioDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela usuario cujo o id seja igual ao do bind
            $sql = "DELETE FROM usuario WHERE id_usuario = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idusuario
            $stmt->bindValue(1, $UsuarioDTO->getIdusuario());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
