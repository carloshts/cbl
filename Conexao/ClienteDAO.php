<?php
/*Classe com os metodos de manipulação de dados da tabela cliente */

//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class ClienteDAO {
    //Metodo de inserção de dados na tabela cliente
    public function InserirCliente(ClienteDTO $ClienteDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para gravar os dados na tabela cliente
            $sql = "INSERT INTO cliente(nome_cliente,identificador_cliente,telefone_cliente,endereco_cliente,email_cliente,tipo_cliente) VALUES (?,?,?,?,?,?)";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe ClienteDTO
            $stmt->bindValue(1, $ClienteDTO->getNome());
            $stmt->bindValue(2, $ClienteDTO->getIdentificador());
            $stmt->bindValue(3, $ClienteDTO->getTelefone());
            $stmt->bindValue(4, $ClienteDTO->getEndereco());
            $stmt->bindValue(5, $ClienteDTO->getEmail());
            $stmt->bindValue(6, $ClienteDTO->getTipo());
            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que retorna a pesquisa com todos os dados da tabela Cliente
    public function PesquisarTodos(){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela cliente
            $sql = "SELECT * FROM cliente";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $clientes;
            
        } catch (PDOException $ex) {
            echo "".$ex;
            
        }
    }
    //Metodo que pesquisa os dados na tabela cliente cujo o id seja igual ao setado no atributo idcliente da classe ClienteDTO
    public function PesquisarClienteByID(ClienteDTO $ClienteDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela cliente
            $sql = "SELECT * FROM cliente WHERE id_cliente LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idcliente
            $stmt->bindValue(1, $ClienteDTO->getIdcliente());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $cliente;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa os dados na tabela cliente cujo o nome seja igual ao setado no atributo nome da classe ClienteDTO
    public function PesquisarClienteByNome(ClienteDTO $ClienteDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela cliente
            $sql = "SELECT * FROM cliente WHERE nome_cliente LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idcliente
            $stmt->bindValue(1, $ClienteDTO->getNome()."%");
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $cliente;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que pesquisa os dados na tabela cliente cujo o cpf seja igual ao setado no atributo cpf da classe ClienteDTO
    public function PesquisarClienteByIdentificador(ClienteDTO $ClienteDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela cliente
            $sql = "SELECT * FROM cliente WHERE identificador_cliente LIKE ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo cpf
            $stmt->bindValue(1, $ClienteDTO->getIdentificador());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $cliente;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo de inserção de dados na tabela cliente
    public function AlterarCliente(ClienteDTO $ClienteDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para Alterar os dados na tabela cliente
            $sql = "UPDATE cliente SET nome_cliente=?,identificador_cliente=?,telefone_cliente=?,endereco_cliente=?,email_cliente=?,tipo_cliente=? WHERE id_cliente=?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda os valores vindos do objeto da classe ClienteDTO
            $stmt->bindValue(1, $ClienteDTO->getNome());
            $stmt->bindValue(2, $ClienteDTO->getIdentificador());
            $stmt->bindValue(3, $ClienteDTO->getTelefone());
            $stmt->bindValue(4, $ClienteDTO->getEndereco());
            $stmt->bindValue(5, $ClienteDTO->getEmail());
            $stmt->bindValue(6, $ClienteDTO->getTipo());
            $stmt->bindValue(7, $ClienteDTO->getIdcliente());

            //Retorna a execução do SQL para saber se funcionou
            return $stmt->execute();
            
            
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
    //Metodo que exclui os dados na tabela cliente cujo o id seja igual ao setado no atributo idcliente da classe ClienteDTO
    public function ExcluirClienteById(ClienteDTO $ClienteDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo = Conexao::getinstance();
            //Comando em SQL para excluir os dados na tabela cliente cujo o id seja igual ao do bind
            $sql = "DELETE FROM cliente WHERE id_cliente = ?";
            //Prepara o sql para receber o bind
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado no atributo idcliente
            $stmt->bindValue(1, $ClienteDTO->getIdcliente());
            //Executa o SQL
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
