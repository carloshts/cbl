<?php

/*Classe com os metodos de manipulação de dados da tabela aluguel */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class AluguelSalaoDAO {
    //Metodo de inserção de dados na tabela aluguel_salao
    public function InserirAluguelSalao(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela aluguel_salao
            $sql = "INSERT INTO aluguel_salao(cliente,salao,data_reserva,data_entrega,status,usuario) VALUES (?,?,?,?,'Pendente',?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe AluguelSalaoDTO
            
            $stmt->bindValue(1, $AluguelSalaoDTO->getCliente());
            $stmt->bindValue(2, $AluguelSalaoDTO->getSalao());
            $stmt->bindValue(3, $AluguelSalaoDTO->getDatareserva());
            $stmt->bindValue(4, $AluguelSalaoDTO->getDataentrega());
            $stmt->bindValue(5, $AluguelSalaoDTO->getUsuario());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela aluguel_salao
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel_salao
            $sql = "SELECT * FROM aluguel_salao a INNER JOIN cliente c ON (a.cliente=c.id_cliente)INNER JOIN salao s ON (a.salao=s.id_salao) INNER JOIN usuario u ON(a.usuario=u.id_usuario)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueisSalao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $alugueisSalao;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que retorna a pesquisa com a quantidade de alugueis de salao pendentes
    public function PesquisarAlugueisSalaoPendentes(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel_salao a INNER JOIN cliente c ON (a.cliente=c.id_cliente)INNER JOIN salao s ON (a.salao=s.id_salao) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.status='Pendente'";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueisSalao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Recebe a quantidade de status pendentes
            $pendentes = count($alugueisSalao);
            
            //Retorna a variavel com a quantidade
            return $pendentes;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela aluguel_salao cujo o valor seja igual ao setado nos atributos datareserva e salao da classe AluguelSalaoDTO
    public function PesquisarAluguelSalaoByID(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel_salao
            $sql = "SELECT * FROM aluguel_salao a INNER JOIN cliente c ON (a.cliente=c.id_cliente)INNER JOIN salao s ON (a.salao=s.id_salao) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.salao LIKE ? AND a.data_reserva LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado nos atributos
            $stmt->bindValue(1, $AluguelSalaoDTO->getSalao());
            $stmt->bindValue(2, $AluguelSalaoDTO->getDatareserva());
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
    public function PesquisarAluguelByCliente(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel_salao
            $sql = "SELECT * FROM aluguel_salao a INNER JOIN cliente c ON (a.cliente=c.id_cliente)INNER JOIN salao s ON (a.salao=s.id_salao) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE c.nome_cliente LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo cliente
            $stmt->bindValue(1, $AluguelSalaoDTO->getCliente());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueisSalao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $alugueisSalao;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarAlugueisSalaoParaHoje(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel
            $sql = "SELECT * FROM aluguel_salao a INNER JOIN cliente c ON (a.cliente=c.id_cliente)INNER JOIN salao s ON (a.salao=s.id_salao) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.data_reserva LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo dataentrada
            $stmt->bindValue(1, $AluguelSalaoDTO->getDatareserva());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueisSalao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Recebe a quantidade de alugueis para hoje
            $alugueisparahoje = count($alugueisSalao);
            //Retorna a variavel com a quantidade
            return $alugueisparahoje;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarDevolucaoSalao(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel_salao
            $sql = "SELECT * FROM aluguel_salao a INNER JOIN cliente c ON (a.cliente=c.id_cliente)INNER JOIN salao s ON (a.salao=s.id_salao) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.data_entrega LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo dataentega
            $stmt->bindValue(1, $AluguelSalaoDTO->getDataentrega());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueisSalao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            //Retorna a variavel com o array
            return $alugueisSalao;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarDataReserva(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel_salao
            $sql = "SELECT * FROM aluguel_salao a INNER JOIN cliente c ON (a.cliente=c.id_cliente)INNER JOIN salao s ON (a.salao=s.id_salao) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.data_reserva LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo datareserva
            $stmt->bindValue(1, $AluguelSalaoDTO->getDatareserva());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueisSalao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            //Retorna a variavel com o array
            return $alugueisSalao;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function PesquisarDevolucoesSalaoParaHoje(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela aluguel_salao
            $sql = "SELECT * FROM aluguel_salao a INNER JOIN cliente c ON (a.cliente=c.id_cliente)INNER JOIN salao s ON (a.salao=s.id_salao) INNER JOIN usuario u ON(a.usuario=u.id_usuario) WHERE a.data_entrega LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo datasaida
            $stmt->bindValue(1, $AluguelSalaoDTO->getDataentrega());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $alugueisSalao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Recebe a quantidade de devoluções para hoje
            $devolucoesparahoje = count($alugueisSalao);
            //Retorna a variavel com a quantidade
            return $devolucoesparahoje;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    public function CalcularDatasSalao($data1,$data2){
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
    //Metodo de Alterar de dados na tabela aluguel_salao
    public function AlterarAluguelSalao(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela aluguel_salao
            $sql = "UPDATE aluguel_salao SET status=?,data_reserva=?,data_entrega=?,cliente=? WHERE salao=? AND data_reserva=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe AluguelSalaoDTO
            $stmt->bindValue(1, $AluguelSalaoDTO->getStatus());
            $stmt->bindValue(2, $AluguelSalaoDTO->getDatareserva());
            $stmt->bindValue(3, $AluguelSalaoDTO->getDataentrega());
            $stmt->bindValue(4, $AluguelSalaoDTO->getCliente());
            $stmt->bindValue(5, $AluguelSalaoDTO->getSalao());
            $stmt->bindValue(6, $AluguelSalaoDTO->getDatareserva());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de Alterar status de um aluguel_salao
    public function AlterarStatusSalao(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela aluguel_salao
            $sql = "UPDATE aluguel_salao SET status=? WHERE salao=? AND data_reserva = ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe AluguelSalaoDTO
            $stmt->bindValue(1, $AluguelSalaoDTO->getStatus());
            $stmt->bindValue(2, $AluguelSalaoDTO->getSalao());
            $stmt->bindValue(3, $AluguelSalaoDTO->getDatareserva());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela aluguel_salao cujo os valores sejam iguais aos setados nos atributos datareserva e salao da classe AluguelSalaoDTO
    public function ExcluirAluguelSalaoById(AluguelSalaoDTO $AluguelSalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela aluguel cujo o valor seja igual ao do bind
            $sql = "DELETE FROM aluguel_salao WHERE salao = ? AND data_reserva = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado nos atributos
            $stmt->bindValue(1, $AluguelSalaoDTO->getSalao());
            $stmt->bindValue(2, $AluguelSalaoDTO->getDatareserva());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
