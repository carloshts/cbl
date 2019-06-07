<?php

/*Classe com os metodos de manipulação de dados da tabela venda_produto */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class VendaProdutoDAO {
    //Metodo de inserção de dados na tabela aluguel_produto_kit_produtos
    public function InserirNovoItem(VendaProdutoDTO $VendaProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela venda_produto
            $sql = "INSERT INTO venda_produto(venda,produto,quantidade_item) VALUES (?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe VendaProdutoDTO
            $stmt->bindValue(1, $VendaProdutoDTO->getVenda());
            $stmt->bindValue(2, $VendaProdutoDTO->getProduto());
            $stmt->bindValue(3, $VendaProdutoDTO->getQuantidade());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela venda_produto
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela venda_produto
            $sql = "SELECT * FROM venda_produto vp INNER JOIN produto p ON(vp.produto=p.id_produto) INNER JOIN venda v ON(vp.venda=v.id_venda) INNER JOIN cliente c ON(v.cliente=c.id_cliente)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $vps = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $vps;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela venda_produto cujo o venda seja igual ao setado no atributo venda da classe VendaProdutoDTO
    public function PesquisarVendaProdutoByID(VendaProdutoDTO $VendaProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela venda_produto
            $sql = "SELECT * FROM venda_produto vp INNER JOIN produto p ON(vp.produto=p.id_produto) INNER JOIN venda v ON(vp.venda=v.id_venda) INNER JOIN cliente c ON(v.cliente=c.id_cliente) WHERE vp.venda LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo venda
            $stmt->bindValue(1, $VendaProdutoDTO->getVenda());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $vps = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $vps;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    
    //Metodo que exclui os dados na tabela venda_produto cujo os atributos chave sejam iguais aos setados nos atributos da classe VendaProdutoDTO
    public function ExcluirVendaProdutoById(VendaProdutoDTO $VendaProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela venda_produto cujo os atributos chave sejam iguais ao do bind
            $sql = "DELETE FROM venda_produto WHERE produto = ? AND venda = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado nos atributos
            $stmt->bindValue(1, $VendaProdutoDTO->getProduto());
            $stmt->bindValue(2, $VendaProdutoDTO->getVenda());
            
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
}
}