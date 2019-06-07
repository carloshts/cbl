<?php

/*Classe com os metodos de manipulação de dados da tabela produto */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class ProdutoDAO {
   //Metodo de inserção de dados na tabela produto
    public function InserirProduto(ProdutoDTO $ProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela produto
            $sql = "INSERT INTO produto(nome_produto,descricao_produto,disponibilidade_produto,preco_produto,categoria,kit_produtos,quantidade,estoque,tipo_permissao,preco_compra_p) VALUES (?,?,?,?,?,?,?,?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe ProdutoDTO
            $stmt->bindValue(1, $ProdutoDTO->getNome());
            $stmt->bindValue(2, $ProdutoDTO->getDescricao());
            $stmt->bindValue(3, $ProdutoDTO->getDisponibilidade());
            $stmt->bindValue(4, $ProdutoDTO->getPreco());
            $stmt->bindValue(5, $ProdutoDTO->getCategoria());
            $stmt->bindValue(6, $ProdutoDTO->getKitprodutos());
            $stmt->bindValue(7, $ProdutoDTO->getQuantidade());
            $stmt->bindValue(8, $ProdutoDTO->getEstoque());
            $stmt->bindValue(9, $ProdutoDTO->getPermissao());
            $stmt->bindValue(10, $ProdutoDTO->getPrecoCompra());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela Produto
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela produto
            $sql = "SELECT * FROM produto p INNER JOIN kit_produtos k ON(p.kit_produtos=k.id_kit_produtos) INNER JOIN categoria c ON(p.categoria=c.id_categoria) INNER JOIN estoque e ON(p.estoque=e.id_estoque)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $produtos;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela Produto
    public function PesquisarDiferenteDeNulo(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela produto
            $sql = "SELECT * FROM produto p INNER JOIN kit_produtos k ON(p.kit_produtos=k.id_kit_produtos) INNER JOIN categoria c ON(p.categoria=c.id_categoria) INNER JOIN estoque e ON(p.estoque=e.id_estoque) WHERE p.nome_produto !='Nulo'";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $produtos;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela produto cujo o id seja igual ao setado no atributo idproduto da classe ProdutoDTO
    public function PesquisarProdutoByID(ProdutoDTO $ProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela produto
            $sql = "SELECT * FROM produto p INNER JOIN kit_produtos k ON(p.kit_produtos=k.id_kit_produtos) INNER JOIN categoria c ON(p.categoria=c.id_categoria) INNER JOIN estoque e ON(p.estoque=e.id_estoque)"
                    . " WHERE id_produto LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idproduto
            $stmt->bindValue(1, $ProdutoDTO->getIdproduto());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $produto;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa a quantidade de um produto alugado
    public function PesquisarProdutoAlugado(ProdutoDTO $ProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela produto
            $sql = "SELECT * FROM aluguel_kit_produto apk INNER JOIN aluguel a ON(apk.aluguel=a.id_aluguel)"
                    . " WHERE apk.produto LIKE ? AND a.status!='Fechado'";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idproduto
            $stmt->bindValue(1, $ProdutoDTO->getIdproduto());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $alugados;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa a quantidade de um produto alugado
    public function PesquisarProdutoAlugadoGrafico(ProdutoDTO $ProdutoDTO,$mes){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela produto
            $sql = "SELECT * FROM aluguel_kit_produto apk INNER JOIN aluguel a ON(apk.aluguel=a.id_aluguel)"
                    . " WHERE apk.produto LIKE ? AND YEAR(a.data_entrada) = YEAR(now()) 
AND MONTH(a.data_entrada) =  $mes";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idproduto
            $stmt->bindValue(1, $ProdutoDTO->getIdproduto());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $alugados;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarProdutoVendidoGrafico(ProdutoDTO $ProdutoDTO,$mes){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela produto
            $sql = "SELECT * FROM venda_produto vp INNER JOIN venda v ON(vp.venda=v.id_venda)"
                    . " WHERE vp.produto LIKE ? AND YEAR(v.data_venda) = YEAR(now()) 
AND MONTH(v.data_venda) =  $mes";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idproduto
            $stmt->bindValue(1, $ProdutoDTO->getIdproduto());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $vendidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $vendidos;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa a quantidade de um produto com permissão para venda
    public function PesquisarProdutoLivre(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela produto
            $sql = "SELECT * FROM produto WHERE tipo_permissao!='2'";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $livres;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa produto pelo nome
    public function PesquisarProdutoByNome(ProdutoDTO $ProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela produto
            $sql = "SELECT * FROM produto p INNER JOIN kit_produtos k ON(p.kit_produtos=k.id_kit_produtos) INNER JOIN categoria c ON(p.categoria=c.id_categoria) INNER JOIN estoque e ON(p.estoque=e.id_estoque)"
                    . " WHERE p.nome_produto LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo nome
            $stmt->bindValue(1, $ProdutoDTO->getNome());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $produto = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $produto;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarProdutoByCategoria(ProdutoDTO $ProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela produto
            $sql = "SELECT * FROM produto p INNER JOIN kit_produtos k ON(p.kit_produtos=k.id_kit_produtos) INNER JOIN categoria c ON(p.categoria=c.id_categoria) INNER JOIN estoque e ON(p.estoque=e.id_estoque)"
                    . " WHERE p.categoria LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo nome
            $stmt->bindValue(1, $ProdutoDTO->getCategoria());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $produto = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $produto;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de inserção de dados na tabela produto
    public function AlterarProduto(ProdutoDTO $ProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela produto
            $sql = "UPDATE produto SET nome_produto=?,descricao_produto=?,disponibilidade_produto=?,preco_produto=?,categoria=?,kit_produtos=?,quantidade=?,estoque=?,tipo_permissao=?,preco_compra_p=? WHERE id_produto=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe ProdutoDTO
            $stmt->bindValue(1, $ProdutoDTO->getNome());
            $stmt->bindValue(2, $ProdutoDTO->getDescricao());
            $stmt->bindValue(3, $ProdutoDTO->getDisponibilidade());
            $stmt->bindValue(4, $ProdutoDTO->getPreco());
            $stmt->bindValue(5, $ProdutoDTO->getCategoria());
            $stmt->bindValue(6, $ProdutoDTO->getKitprodutos());
            $stmt->bindValue(7, $ProdutoDTO->getQuantidade());
            $stmt->bindValue(8, $ProdutoDTO->getEstoque());
            $stmt->bindValue(9, $ProdutoDTO->getPermissao());
            $stmt->bindValue(10, $ProdutoDTO->getPrecoCompra());
            $stmt->bindValue(11, $ProdutoDTO->getIdproduto());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela produto cujo o id seja igual ao setado no atributo idproduto da classe ProdutoDTO
    public function ExcluirProdutoById(ProdutoDTO $ProdutoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela produto cujo o id seja igual ao do bind
            $sql = "DELETE FROM produto WHERE id_produto = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idproduto
            $stmt->bindValue(1, $ProdutoDTO->getIdproduto());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
