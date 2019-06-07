<?php
//Conexão com a classe VendaProdutoDTO
require_once '../Classes/VendaProdutoDTO.php';
//Conexão com a classe VendaProdutoDAO
require_once '../Conexao/VendaProdutoDAO.php';

//Variáveis que recebem os valores pela url
$venda = $_GET['venda'];
$produto = $_GET['produto'];


//Novo objeto da classe VendaProdutoDTO
$VendaProdutoDTO = new VendaProdutoDTO();

//Metodos que setam os atributos da classe VendaProdutoDTO
$VendaProdutoDTO->setVenda($venda);
$VendaProdutoDTO->setProduto($produto);
//Novo objeto da classe VendaProdutoDAO
$VendaProdutoDAO = new VendaProdutoDAO();

//Metodo de excluir um item da venda no Banco de dados
$VendaProdutoDAO->ExcluirVendaProdutoById($VendaProdutoDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=vendas&idvenda=$venda';";
echo "</script>";

