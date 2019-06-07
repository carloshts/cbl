<?php

/*Classe com os metodos de manipulação de dados da tabela estoque */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class EstoqueDAO {
    //Metodo de inserção de dados na tabela estoque
    public function InserirEstoque(EstoqueDTO $EstoqueDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela estoque
            $sql = "INSERT INTO estoque(nome_estoque,capacidade) VALUES (?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe EstoqueDTO
            $stmt->bindValue(1, $EstoqueDTO->getNome());
            $stmt->bindValue(2, $EstoqueDTO->getCapacidade());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela Estoque
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela estoque
            $sql = "SELECT * FROM estoque";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $estoques = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $estoques;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela estoque cujo o id seja igual ao setado no atributo idestoque da classe EstoqueDTO
    public function PesquisarEstoqueByID(EstoqueDTO $EstoqueDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela estoque
            $sql = "SELECT * FROM estoque WHERE id_estoque LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idestoque
            $stmt->bindValue(1, $EstoqueDTO->getIdestoque());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $estoques = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $estoques;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa os dados na tabela estoque cujo a capacidade seja igual ao setado no atributo capacidade da classe EstoqueDTO
    public function PesquisarEstoqueByCapacidade(EstoqueDTO $EstoqueDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela estoque
            $sql = "SELECT * FROM estoque WHERE capacidade LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo capacidade
            $stmt->bindValue(1, $EstoqueDTO->getCapacidade());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $estoques = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $estoques;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de Alterar dados na tabela estoque
    public function AlterarEstoque(EstoqueDTO $EstoqueDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela estoque
            $sql = "UPDATE estoque SET nome_estoque=?,capacidade=? WHERE id_estoque=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe EstoqueDTO
            $stmt->bindValue(1, $EstoqueDTO->getNome());
            $stmt->bindValue(2, $EstoqueDTO->getCapacidade());
            $stmt->bindValue(3, $EstoqueDTO->getIdestoque());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela estoque cujo o id seja igual ao setado no atributo idestoque da classe EstoqueDTO
    public function ExcluirEstoqueById(EstoqueDTO $EstoqueDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela estoque cujo o id seja igual ao do bind
            $sql = "DELETE FROM estoque WHERE id_estoque = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idestoque
            $stmt->bindValue(1, $EstoqueDTO->getIdestoque());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
