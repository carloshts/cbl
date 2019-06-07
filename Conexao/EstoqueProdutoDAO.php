<?php

/*Classe com os metodos de manipulação de dados da tabela estoque_produto */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class EstoqueProdutoDAO {
    //Metodo de inserção de dados na tabela estoque_produto
    public function InserirEstoqueProduto(EstoqueProdutoDTO $EstoqueProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela estoque
            $sql = "INSERT INTO estoque_produto(produto,estoque,quantidade) VALUES (?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe EstoqueProdutoDTO
            $stmt->bindValue(1, $EstoqueProdutoDTO->getProduto());
            $stmt->bindValue(2, $EstoqueProdutoDTO->getEstoque());
            $stmt->bindValue(3, $EstoqueProdutoDTO->getQuantidade());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela estoque_produto
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela estoque_produto
            $sql = "SELECT * FROM estoque_produto ep INNER JOIN produto p ON(ep.produto=p.id_produto) INNER JOIN estoque e ON(ep.estoque=e.id_estoque)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $estoqueprodutos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $estoqueprodutos;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela estoque_produto cujo o id seja igual ao setado no atributo produto da classe EstoqueProdutoDTO
    public function PesquisarEstoqueProdutoByID(EstoqueProdutoDTO $EstoqueProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela estoqueproduto
            $sql = "SELECT * FROM estoque_produto ep INNER JOIN produto p ON(ep.produto=p.id_produto) INNER JOIN estoque e ON(ep.estoque=e.id_estoque) WHERE p.produto LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo produto
            $stmt->bindValue(1, $EstoqueProdutoDTO->getProduto());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $estoqueproduto = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $estoqueproduto;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de inserção de dados na tabela estoque_produto
    public function AlterarEstoqueProduto(EstoqueProdutoDTO $EstoqueProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela estoque_produto
            $sql = "UPDATE estoque_produto SET estoque=?,quantidade WHERE produto=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe EstoqueProdutoDTO
            $stmt->bindValue(1, $EstoqueProdutoDTO->getEstoque());
            $stmt->bindValue(2, $EstoqueProdutoDTO->getQuantidade());
            $stmt->bindValue(3, $EstoqueProdutoDTO->getProduto());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela estoque_produto cujo o id seja igual ao setado no atributo produto da classe EstoqueProdutoDTO
    public function ExcluirEstoqueProdutoById(EstoqueProdutoDTO $EstoqueProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela estoque_produto cujo o id seja igual ao do bind
            $sql = "DELETE FROM estoque_produto WHERE produto = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo produto
            $stmt->bindValue(1, $EstoqueProdutoDTO->getProduto());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
