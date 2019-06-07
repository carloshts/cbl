<?php

/*Classe com os metodos de manipulação de dados da tabela salao */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class SalaoDAO {
    //Metodo de inserção de dados na tabela salao
    public function InserirSalao(SalaoDTO $SalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela salao
            $sql = "INSERT INTO salao(nome_salao,telefone_salao,cep,rua,numero,bairro,cidade,estado,status_salao) VALUES (?,?,?,?,?,?,?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe SalaoDTO
            $stmt->bindValue(1, $SalaoDTO->getNome());
            $stmt->bindValue(2, $SalaoDTO->getTel());
            $stmt->bindValue(3, $SalaoDTO->getCep());
            $stmt->bindValue(4, $SalaoDTO->getRua());
            $stmt->bindValue(5, $SalaoDTO->getNumero());
            $stmt->bindValue(6, $SalaoDTO->getBairro());
            $stmt->bindValue(7, $SalaoDTO->getCidade());
            $stmt->bindValue(8, $SalaoDTO->getEstado());
            $stmt->bindValue(9, $SalaoDTO->getStatus());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela salao
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela salao
            $sql = "SELECT * FROM salao";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $saloes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $saloes;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela categoria cujo o id seja igual ao setado no atributo idsalao da classe SalaoDTO
    public function PesquisarSalaoByID(SalaoDTO $SalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela salao
            $sql = "SELECT * FROM salao WHERE id_salao LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idsalao
            $stmt->bindValue(1, $SalaoDTO->getIdsalao());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $salao = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $salao;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa os dados na tabela salao cujo o nome seja igual ao setado no atributo nome da classe SalaoDTO
    public function PesquisarSalaoByNome(SalaoDTO $SalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela salao
            $sql = "SELECT * FROM salao WHERE nome_salao LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo nome
            $stmt->bindValue(1, $SalaoDTO->getNome()."%");
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $salao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $salao;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa os dados na tabela salao cujo o cep seja igual ao setado no atributo cep da classe SalaoDTO
    public function PesquisarSalaoByCep(SalaoDTO $SalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela salao
            $sql = "SELECT * FROM salao WHERE cep LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo cep
            $stmt->bindValue(1, $SalaoDTO->getCep()."%");
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $salao = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $salao;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de inserção de dados na tabela salao
    public function AlterarSalao(SalaoDTO $SalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela salao
            $sql = "UPDATE salao SET nome_salao=?,telefone_salao=?,cep=?,"
                    . "rua=?,numero=?,bairro=?,"
                    . "cidade=?,estado=?,status_salao=? WHERE id_salao=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe SalaoDTO
            $stmt->bindValue(1, $SalaoDTO->getNome());
            $stmt->bindValue(2, $SalaoDTO->getTel());
            $stmt->bindValue(3, $SalaoDTO->getCep());
            $stmt->bindValue(4, $SalaoDTO->getRua());
            $stmt->bindValue(5, $SalaoDTO->getNumero());
            $stmt->bindValue(6, $SalaoDTO->getBairro());
            $stmt->bindValue(7, $SalaoDTO->getCidade());
            $stmt->bindValue(8, $SalaoDTO->getEstado());
            $stmt->bindValue(9, $SalaoDTO->getStatus());
            $stmt->bindValue(10,$SalaoDTO->getIdsalao());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela salao cujo o id seja igual ao setado no atributo idsalao da classe SalaoDTO
    public function ExcluirSalaoById(SalaoDTO $SalaoDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela salao cujo o id seja igual ao do bind
            $sql = "DELETE FROM salao WHERE id_salao = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idsalao
            $stmt->bindValue(1, $SalaoDTO->getIdsalao());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
