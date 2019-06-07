<?php

/*Classe com os metodos de manipulação de dados da tabela categoria */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class CategoriaDAO {
    //Metodo de inserção de dados na tabela categoria
    public function InserirCategoria(CategoriaDTO $CategoriaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela categoria
            $sql = "INSERT INTO categoria(nome_categoria) VALUES (?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe CategoriaDTO
            $stmt->bindValue(1, $CategoriaDTO->getCategoria());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela Categoria
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela categoria
            $sql = "SELECT * FROM categoria";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $categorias;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela categoria cujo o id seja igual ao setado no atributo idcategoria da classe CategoriaDTO
    public function PesquisarCategoriaByID(CategoriaDTO $CategoriaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela categoria
            $sql = "SELECT * FROM categoria WHERE id_categoria LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idcategoria
            $stmt->bindValue(1, $CategoriaDTO->getIdcategoria());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $categoria;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa os dados na tabela categoria cujo o nome seja igual ao setado no atributo categoria da classe CategoriaDTO
    public function PesquisarCategoriaByNome(CategoriaDTO $CategoriaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela categoria
            $sql = "SELECT * FROM categoria WHERE nome_categoria LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo categoria
            $stmt->bindValue(1, $CategoriaDTO->getCategoria()."%");
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $categoria;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de inserção de dados na tabela categoria
    public function AlterarCategoria(CategoriaDTO $CategoriaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela categoria
            $sql = "UPDATE categoria SET nome_categoria=? WHERE id_categoria=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe CategoriaDTO
            $stmt->bindValue(1, $CategoriaDTO->getCategoria());
            $stmt->bindValue(2, $CategoriaDTO->getIdcategoria());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela categoria cujo o id seja igual ao setado no atributo idcategoria da classe CategoriaDTO
    public function ExcluirCategoriaById(CategoriaDTO $CategoriaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela categoria cujo o id seja igual ao do bind
            $sql = "DELETE FROM categoria WHERE id_categoria = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idcategoria
            $stmt->bindValue(1, $CategoriaDTO->getIdcategoria());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
