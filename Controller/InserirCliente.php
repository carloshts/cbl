<?php

//Conexão com a classe ClienteDTO
require_once '../Classes/ClienteDTO.php';
//Conexão com a classe ClienteDAO
require_once '../Conexao/ClienteDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$nome = $_POST['nome'];

$tipo = $_POST['tipo'];
if($tipo=="Pessoa Fisíca"){
$identificador = $_POST['cpf'];
} else {
    $identificador = $_POST['cnpj'];
}
$telefone = $_POST['tel'];
$endereco = $_POST['end'];
$email = $_POST['email'];

//Novo objeto da classe ClienteDTO
$ClienteDTO = new ClienteDTO();

//Metodos que setam os atributos da classe ClienteDTO
$ClienteDTO->setNome($nome);
$ClienteDTO->setTipo($tipo);
$ClienteDTO->setIdentificador($identificador);
$ClienteDTO->setEndereco($endereco);
$ClienteDTO->setTelefone($telefone);
$ClienteDTO->setEmail($email);

//Novo objeto da classe ClienteDAO
$ClienteDAO = new ClienteDAO();

//Metodo de inserir um  novo cliente no Banco de dados
$ClienteDAO->InserirCliente($ClienteDTO);

//Script em JavaScript que envia um alerta de conclusão de cadastro
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=formcliente';";
echo "  alert('Cadastro realizado com sucesso!');";
echo "</script>";