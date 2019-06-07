<?php

/*Classe com os metodos de manipulação de dados da tabela kit_produtos */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class KitProdutosDAO {
    //Metodo de inserção de dados na tabela kit_produtos
    public function InserirKitProdutos(KitProdutosDTO $KitProdutosDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela kitprodutos
            $sql = "INSERT INTO kit_produtos(nome_kit_produtos,descricao_kit_produtos,quantidade_kit_produtos,disponibilidade_kit_produtos,preco_kit_produtos,categoria_kit_produtos,preco_compra_kp) VALUES (?,?,?,?,?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe KitProdutosDTO
            $stmt->bindValue(1, $KitProdutosDTO->getNome());
            $stmt->bindValue(2, $KitProdutosDTO->getDescricao());
            $stmt->bindValue(3, $KitProdutosDTO->getQuantidade());
            $stmt->bindValue(4, $KitProdutosDTO->getDisponibilidade());
            $stmt->bindValue(5, $KitProdutosDTO->getPreco());
            $stmt->bindValue(6, $KitProdutosDTO->getCategoria());
            $stmt->bindValue(7, $KitProdutosDTO->getPrecoCompra());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela kit_produtos
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela kit_produtos
            $sql = "SELECT * FROM kit_produtos k INNER JOIN categoria c ON(k.categoria_kit_produtos=c.id_categoria)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $kps = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $kps;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela kit_produtos
    public function PesquisarDiferenteDeNulo(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela kit_produtos
            $sql = "SELECT * FROM kit_produtos k INNER JOIN categoria c ON(k.categoria_kit_produtos=c.id_categoria) WHERE nome_kit_produtos != 'Nulo'";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $kps = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $kps;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela kit_produtos cujo o id seja igual ao setado no atributo id_kit_produtos da classe KitProdutosDTO
    public function PesquisarKitProdutosByID(KitProdutosDTO $KitProdutosDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela kitprodutos
            $sql = "SELECT * FROM kit_produtos k INNER JOIN categoria c ON(k.categoria_kit_produtos=c.id_categoria)"
                    . " WHERE id_kit_produtos LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idkitprodutos
            $stmt->bindValue(1, $KitProdutosDTO->getIdkitprodutos());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $kitsprodutos = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $kitsprodutos;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa a quantidade de um kit alugado
    public function PesquisarKitProdutosAlugado(KitProdutosDTO $KitProdutosDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela kitprodutos
            $sql = "SELECT * FROM aluguel_kit_produto apk INNER JOIN aluguel a ON(apk.aluguel=a.id_aluguel)"
                    . " WHERE apk.kit_produtos LIKE ? AND a.status!='Fechado'";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idkitprodutos
            $stmt->bindValue(1, $KitProdutosDTO->getIdkitprodutos());
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
    //Metodo que pesquisa a quantidade de um kit alugado
    public function PesquisarKitProdutosAlugadoGrafico(KitProdutosDTO $KitProdutosDTO,$mes){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela kitprodutos
            $sql = "SELECT * FROM aluguel_kit_produto apk INNER JOIN aluguel a ON(apk.aluguel=a.id_aluguel)"
                    . " WHERE apk.kit_produtos LIKE ? AND YEAR(a.data_entrada) = YEAR(now()) 
AND MONTH(a.data_entrada) =  $mes";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idkitprodutos
            $stmt->bindValue(1, $KitProdutosDTO->getIdkitprodutos());
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
    //Metodo que pesquisa os dados na tabela kit_produtos cujo o nome seja igual ao setado no atributo nome da classe KitProdutosDTO
    public function PesquisarKitProdutoByNome(KitProdutosDTO $KitProdutosDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela kitprodutos
            $sql = "SELECT * FROM kit_produtos k INNER JOIN categoria c ON(k.categoria_kit_produtos=c.id_categoria)"
                    . " WHERE nome_kit_produtos LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo nome
            $stmt->bindValue(1, $KitProdutosDTO->getNome());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $kitsprodutos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $kitsprodutos;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa os dados na tabela kit_produtos cujo a categoria seja igual ao setado no atributo categoria da classe KitProdutosDTO
    public function PesquisarKitProdutoByCategoria(KitProdutosDTO $KitProdutosDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela kitprodutos
            $sql = "SELECT * FROM kit_produtos k INNER JOIN categoria c ON(k.categoria_kit_produtos=c.id_categoria)"
                    . " WHERE k.categoria_kit_produtos LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo categoria
            $stmt->bindValue(1, $KitProdutosDTO->getCategoria());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $kitsprodutos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $kitsprodutos;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de inserção de dados na tabela kit_produtos
    public function AlterarKitProduto(KitProdutosDTO $KitProdutosDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela kit_produtos
            $sql = "UPDATE kit_produtos SET nome_kit_produtos=?,descricao_kit_produtos=?,quantidade_kit_produtos=?,disponibilidade_kit_produtos=?,preco_kit_produtos=?,categoria_kit_produtos=?,preco_compra_kp=? WHERE id_kit_produtos=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe KitProdutosDTO
            $stmt->bindValue(1, $KitProdutosDTO->getNome());
            $stmt->bindValue(2, $KitProdutosDTO->getDescricao());
            $stmt->bindValue(3, $KitProdutosDTO->getQuantidade());
            $stmt->bindValue(4, $KitProdutosDTO->getDisponibilidade());
            $stmt->bindValue(5, $KitProdutosDTO->getPreco());
            $stmt->bindValue(6, $KitProdutosDTO->getCategoria());
            $stmt->bindValue(7, $KitProdutosDTO->getPrecoCompra());
            $stmt->bindValue(8, $KitProdutosDTO->getIdkitprodutos());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela kit_produtos cujo o id seja igual ao setado no atributo idkitprodutos da classe KitProdutosDTO
    public function ExcluirKitProdutosById(KitProdutosDTO $KitProdutosDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela kit_produtos cujo o id seja igual ao do bind
            $sql = "DELETE FROM kit_produtos WHERE id_kit_produtos = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idkitprodutos
            $stmt->bindValue(1, $KitProdutosDTO->getIdkitprodutos());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
