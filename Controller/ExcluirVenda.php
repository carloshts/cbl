<?php
//Conexão com a classe VendaDTO
require_once '../Classes/VendaDTO.php';
//Conexão com a classe VendaDAO
require_once '../Conexao/VendaDAO.php';

//Variável que recebe o id da venda por url
$idvenda = $_GET['idvenda'];

//Novo objeto da classe VendaDTO
$VendaDTO = new VendaDTO();

//Metodo que seta o atributo idvenda da classe VendaDTO
$VendaDTO->setIdvenda($idvenda);

//Novo objeto da classe VendaDAO
$VendaDAO = new VendaDAO();

//Metodo que exclui os dados da tabela venda cujo o  id_venda seja igual ao setado na variável
$VendaDAO->ExcluirVendaById($VendaDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=vendas'";
echo "</script>";