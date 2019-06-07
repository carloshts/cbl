<?php

//Conexão com a classe VendaDTO
require_once '../Classes/VendaDTO.php';
//Conexão com a classe VendaDAO
require_once '../Conexao/VendaDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$data = $_POST['data'];
$status = $_POST['status'];
$cliente = $_POST['cliente'];
$usuario = $_POST["usuario"];
//Novo objeto da classe VendaDTO
$VendaDTO = new VendaDTO();

//Metodos que setam os atributos da classe VendaDTO
$VendaDTO->setCliente($cliente);
$VendaDTO->setData($data);
$VendaDTO->setStatus($status);
$VendaDTO->setUsuario($usuario);
//Novo objeto da classe VendaDAO
$VendaDAO = new VendaDAO();

//Metodo de inserir uma  nova venda no Banco de dados
$VendaDAO->InserirVenda($VendaDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=vendas'";
echo "</script>";