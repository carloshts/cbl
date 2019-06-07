<?php
//Conexão com a classe AluguelProdutosKitProdutosDTO
require_once '../Classes/AluguelProdutosKitProdutosDTO.php';
//Conexão com a classe AluguelProdutosKitProdutosDAO
require_once '../Conexao/AluguelProdutosKitProdutosDAO.php';

//Variáveis que recebem os valores dos campos do formulário
echo $aluguel = $_POST['aluguel'];
echo $produto = $_POST['produto'];
echo $kitprodutos = $_POST['kit'];
$quantidadeItem = $_POST['quantidade'];

//Novo objeto da classe AluguelProdutosKitProdutosDTO
$APKDTO = new AluguelProdutosKitProdutosDTO();

//Metodos que setam os atributos da classe AluguelProdutosKitProdutosDTO
$APKDTO->setAluguel($aluguel);
$APKDTO->setProduto($produto);
$APKDTO->setKitprodutos($kitprodutos);
$APKDTO->setQuantidadeItem($quantidadeItem);
//Novo objeto da classe AluguelProdutosKitProdutosDAO
$APKDAO = new AluguelProdutosKitProdutosDAO();

//Metodo de inserir um  novo item do aluguel no Banco de dados
$APKDAO->InserirAluguelProdutosKitProdutos($APKDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=alugueis&idaluguel=$aluguel';";
echo "</script>";
