<?php

//Conexão com a classe ClienteDTO
require_once '../Classes/ClienteDTO.php';
//Conexão com a classe ClienteDAO
require_once '../Conexao/ClienteDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$idcliente = $_POST['idcliente'];
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
$ClienteDTO->setIdcliente($idcliente);
$ClienteDTO->setNome($nome);
$ClienteDTO->setTipo($tipo);
$ClienteDTO->setIdentificador($identificador);
$ClienteDTO->setEndereco($endereco);
$ClienteDTO->setTelefone($telefone);
$ClienteDTO->setEmail($email);

//Novo objeto da classe ClienteDAO
$ClienteDAO = new ClienteDAO();

//Metodo de alterar os dados do cliente com idcliente correspondente no Banco de dados
$ClienteDAO->AlterarCliente($ClienteDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=clientes'";
echo "</script>";