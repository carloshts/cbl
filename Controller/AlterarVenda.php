<?php

//Conexão com a classe VendaDTO
require_once '../Classes/VendaDTO.php';
//Conexão com a classe VendaDAO
require_once '../Conexao/VendaDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$idvenda = $_POST['idvenda'];
$data = $_POST['data'];
$cliente = $_POST['cliente'];
$status = $_POST['status'];

//Novo objeto da classe VendaDTO
$VendaDTO = new VendaDTO();

//Metodos que setam os atributos da classe VendaDTO
$VendaDTO->setIdvenda($idvenda);
$VendaDTO->setCliente($cliente);
$VendaDTO->setData($data);
$VendaDTO->setStatus($status);

//Novo objeto da classe VendaDAO
$VendaDAO = new VendaDAO();

//Metodo de alterar os dados da venda com idvenda correspondente no Banco de dados
$VendaDAO->AlterarVenda($VendaDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=vendas'";
echo "</script>";