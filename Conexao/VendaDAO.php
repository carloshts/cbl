<?php

/*Classe com os metodos de manipulação de dados da tabela venda */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class VendaDAO {
    //Metodo de inserção de dados na tabela venda
    public function InserirVenda(VendaDTO $VendaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela venda
            $sql = "INSERT INTO venda(cliente,data_venda,status,usuario) VALUES (?,?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe VendaDTO
            $stmt->bindValue(1, $VendaDTO->getCliente());
            $stmt->bindValue(2, $VendaDTO->getData());
            $stmt->bindValue(3, $VendaDTO->getStatus());
            $stmt->bindValue(4, $VendaDTO->getUsuario());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela venda
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela venda
            $sql = "SELECT * FROM venda v INNER JOIN cliente c ON(v.cliente=c.id_cliente) INNER JOIN usuario u ON(v.usuario=u.id_usuario)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $vendas;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela venda cujo o valor seja igual ao setado no atributo id da classeVendaDTO
    public function PesquisarVendaByID(VendaDTO $VendaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela venda
            $sql = "SELECT * FROM venda v INNER JOIN cliente c ON(v.cliente=c.id_cliente) INNER JOIN usuario u ON(v.usuario=u.id_usuario) WHERE id_venda LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idvenda
            $stmt->bindValue(1, $VendaDTO->getIdvenda());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $venda = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $venda;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarVendaByCliente(VendaDTO $VendaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela venda
            $sql = "SELECT * FROM venda v INNER JOIN cliente c ON(v.cliente=c.id_cliente) INNER JOIN usuario u ON(v.usuario=u.id_usuario) WHERE c.nome_cliente LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo cliente
            $stmt->bindValue(1, $VendaDTO->getCliente()."%");
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $vendas;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function CalcularDatas($data1,$data2){
        try {
            $data1FM = explode('-', $data1);
            $data2FM = explode('-', $data2);
            
            if($data1FM[1]==$data2FM[1]){
                $op = $data1FM[2] - $data2FM[2];
                
                if($op > 0){
                    return "maior";
                }  else {
                    return "menor";
                }
            }  else {
                $opm = $data1FM[1] - $data2FM[1];
                if($opm > 0){
                    return "maior";
                }  else {
                    return "menor";
                }
                
            }
        } catch (Exception $ex) {
            echo "".$ex;
        }
    } 
    
    //Metodo que altera o status na tabela venda
    public function AlterarStatusVenda(VendaDTO $VendaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela venda
            $sql = "UPDATE Venda SET status='Fechada' WHERE id_venda=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe VendaDTO
            $stmt->bindValue(1, $VendaDTO->getIdvenda());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela venda cujo os atributos chave sejam iguais aos setados nos atributos da classe VendaDTO
    public function ExcluirVendaById(VendaDTO $VendaDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela venda cujo os atributos chave sejam iguais ao do bind
            $sql = "DELETE FROM venda WHERE id_venda = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado nos atributos
            $stmt->bindValue(1, $VendaDTO->getIdvenda());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
}
}