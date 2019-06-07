<?php

/*Classe com os metodos de manipulação de dados da tabela aluguel_produto_kit_produtos */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class AluguelProdutosKitProdutosDAO {
    //Metodo de inserção de dados na tabela aluguel_produto_kit_produtos
    public function InserirAluguelProdutosKitProdutos(AluguelProdutosKitProdutosDTO $APKDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela aluguel_produto_kit_produtos
            $sql = "INSERT INTO aluguel_kit_produto(aluguel,produto,kit_produtos,quantidade_item) VALUES (?,?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe AluguelProdutosKitProdutosDTO
            $stmt->bindValue(1, $APKDTO->getAluguel());
            $stmt->bindValue(2, $APKDTO->getProduto());
            $stmt->bindValue(3, $APKDTO->getKitprodutos());
            $stmt->bindValue(4, $APKDTO->getQuantidadeItem());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela aluguel_produto_kit_produtos
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel_produto_kit_produtos
            $sql = "SELECT * FROM aluguel_kit_produto apk INNER JOIN produto p ON(apk.produto=p.id_produto) INNER JOIN kit_produtos k ON(apk.kit_produtos=k.id_kit_produtos) INNER JOIN aluguel a(apk.aluguel=a.id_aluguel) INNER JOIN cliente c ON(a.cliente=c.id_cliente)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $apks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $apks;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela aluguel_produto_kit_produtos cujo o aluguel seja igual ao setado no atributo aluguel da classe AluguelProdutosKitProdutosDTO
    public function PesquisarAPKByID($aluguel){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel_produto_kit_produtos
            $sql = "SELECT * FROM aluguel_kit_produto apk INNER JOIN produto p ON(apk.produto=p.id_produto) INNER JOIN kit_produtos k ON(apk.kit_produtos=k.id_kit_produtos) INNER JOIN aluguel a ON(apk.aluguel=a.id_aluguel) INNER JOIN cliente c ON(a.cliente=c.id_cliente) WHERE apk.aluguel LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo produto
            $stmt->bindValue(1, $aluguel);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $apks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $apks;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de inserção de dados na tabela aluguel_produto_kit_produtos
    public function AlterarAPK(AluguelProdutosKitProdutosDTO $APKDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela aluguel_kit_produto
            $sql = "UPDATE aluguel_kit_produto SET produto=?,kit_produtos=?,quantidade_item=? WHERE aluguel=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe aluguel_produto_kit_produtosDTO
            $stmt->bindValue(1, $APKDTO->getKitprodutos());
            $stmt->bindValue(2, $APKDTO->getProduto());
            $stmt->bindValue(3, $APKDTO->getQuantidadeItem());
            $stmt->bindValue(4, $APKDTO->getAluguel());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela aluguel_kit_produto cujo os atributos chave sejam iguais aos setados nos atributos da classe AluguelProdutosKitProdutosDTO
    public function ExcluirAPKById(AluguelProdutosKitProdutosDTO $APKDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela aluguel_kit_produto cujo os atributos chave sejam iguais ao do bind
            $sql = "DELETE FROM aluguel_kit_produto WHERE produto = ? AND aluguel = ? AND kit_produtos = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado nos atributos
            $stmt->bindValue(1, $APKDTO->getProduto());
            $stmt->bindValue(2, $APKDTO->getAluguel());
            $stmt->bindValue(3, $APKDTO->getKitprodutos());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
}
}