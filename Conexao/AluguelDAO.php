<?php

/*Classe com os metodos de manipulação de dados da tabela aluguel */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class AluguelDAO {
    //Metodo de inserção de dados na tabela aluguel
    public function InserirAluguel(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela Aluguel
            $sql = "INSERT INTO aluguel(status,cliente,data_entrada,data_saida,usuario) VALUES (?,?,?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe AluguelDTO
            $stmt->bindValue(1, $AluguelDTO->getStatus());
            $stmt->bindValue(2, $AluguelDTO->getCliente());
            $stmt->bindValue(3, $AluguelDTO->getDataentrada());
            $stmt->bindValue(4, $AluguelDTO->getDatasaida());
            $stmt->bindValue(5, $AluguelDTO->getUsuario());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela aluguel
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel a INNER JOIN cliente c ON (a.cliente=c.id_cliente) INNER JOIN usuario u ON(a.usuario=u.id_usuario)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueis = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $alugueis;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que retorna a pesquisa com a quantidade de alugueis pendentes
    public function PesquisarAlugueisPendentes(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel a INNER JOIN cliente c ON (a.cliente=c.id_cliente) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE status='Pendente'";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueis = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Recebe a quantidade de status pendentes
            $pendentes = count($alugueis);
            
            //Retorna a variavel com a quantidade
            return $pendentes;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela aluguel cujo o id seja igual ao setado no atributo idaluguel da classe AluguelDTO
    public function PesquisarAluguelByID(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel a INNER JOIN cliente c ON (a.cliente=c.id_cliente) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.id_aluguel LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idaluguel
            $stmt->bindValue(1, $AluguelDTO->getIdaluguel());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueis = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $alugueis;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarAluguelByCliente(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel a INNER JOIN cliente c ON (a.cliente=c.id_cliente) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE c.nome_cliente LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo cliente
            $stmt->bindValue(1, $AluguelDTO->getCliente()."%");
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueis = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $alugueis;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarAlugueisParaHoje(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel a INNER JOIN cliente c ON (a.cliente=c.id_cliente) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.data_entrada LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo dataentrada
            $stmt->bindValue(1, $AluguelDTO->getDataentrada());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueis = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Recebe a quantidade de alugueis para hoje
            $alugueisparahoje = count($alugueis);
            //Retorna a variavel com a quantidade
            return $alugueisparahoje;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarDevolucao(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel a INNER JOIN cliente c ON (a.cliente=c.id_cliente) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.data_saida LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo datasaida
            $stmt->bindValue(1, $AluguelDTO->getDatasaida());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueis = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            //Retorna a variavel com o array
            return $alugueis;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarDataEntrada(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel a INNER JOIN cliente c ON (a.cliente=c.id_cliente) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.data_entrada LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo dataentrada
            $stmt->bindValue(1, $AluguelDTO->getDataentrada());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueis = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            //Retorna a variavel com o array
            return $alugueis;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarDevolucoesParaHoje(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel a INNER JOIN cliente c ON (a.cliente=c.id_cliente) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.data_saida LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo datasaida
            $stmt->bindValue(1, $AluguelDTO->getDatasaida());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueis = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Recebe a quantidade de devoluções para hoje
            $devolucoesparahoje = count($alugueis);
            //Retorna a variavel com a quantidade
            return $devolucoesparahoje;
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
    
    //Metodo de Alterar de dados na tabela aluguel
    public function AlterarAluguel(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela aluguel
            $sql = "UPDATE aluguel SET status=?,cliente=?,data_entrada=?,data_saida=? WHERE id_aluguel=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe AluguelDTO
            $stmt->bindValue(1, $AluguelDTO->getStatus());
            $stmt->bindValue(2, $AluguelDTO->getCliente());
            $stmt->bindValue(3, $AluguelDTO->getDataentrada());
            $stmt->bindValue(4, $AluguelDTO->getDatasaida());
            $stmt->bindValue(5, $AluguelDTO->getIdaluguel());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de Alterar status de um aluguel
    public function AlterarStatus(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela aluguel
            $sql = "UPDATE aluguel SET status=? WHERE id_aluguel=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe AluguelDTO
            $stmt->bindValue(1, $AluguelDTO->getStatus());
            $stmt->bindValue(2, $AluguelDTO->getIdaluguel());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela aluguel cujo o id seja igual ao setado no atributo idaluguel da classe AluguelDTO
    public function ExcluirAluguelById(AluguelDTO $AluguelDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela aluguel cujo o id seja igual ao do bind
            $sql = "DELETE FROM aluguel WHERE id_aluguel = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idaluguel
            $stmt->bindValue(1, $AluguelDTO->getIdaluguel());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
