<?php
//Conexão com a classe VendaProdutoDTO
require_once '../Classes/VendaProdutoDTO.php';
//Conexão com a classe VendaProdutoDAO
require_once '../Conexao/VendaProdutoDAO.php';

//Variáveis que recebem os valores dos campos do formulário
echo $venda = $_POST['venda'];
echo $produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];

//Novo objeto da classe VendaProdutoDTO
$VendaProdutoDTO = new VendaProdutoDTO();

//Metodos que setam os atributos da classe VendaProdutoDTO
$VendaProdutoDTO->setVenda($venda);
$VendaProdutoDTO->setProduto($produto);
$VendaProdutoDTO->setQuantidade($quantidade);
//Novo objeto da classe VendaProdutoDAO
$VendaProdutoDAO = new VendaProdutoDAO();

//Metodo de inserir um  novo item da venda no Banco de dados
$VendaProdutoDAO->InserirNovoItem($VendaProdutoDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=vendas&idvenda=$venda';";
echo "</script>";
