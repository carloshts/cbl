<?php
//Conexão com a classe ClienteDTO
require_once '../Classes/ClienteDTO.php';
//Conexão com a classe ClienteDAO
require_once '../Conexao/ClienteDAO.php';

//Variável que recebe o id do cliente por url
$idcliente = $_GET['idcliente'];

//Novo objeto da classe ClienteDTO
$ClienteDTO = new ClienteDTO();

//Metodo que seta o atributo idcliente da classe ClienteDTO
$ClienteDTO->setIdcliente($idcliente);

//Novo objeto da classe ClienteDAO
$ClienteDAO = new ClienteDAO();

//Metodo que exclui os dados da tabela cliente cujo o  id_cliente seja igual ao setado na variável
$ClienteDAO->ExcluirClienteById($ClienteDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=clientes'";
echo "</script>";

