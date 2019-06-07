<?php
//Conexão com a classe AluguelProdutosKitProdutosDTO
require_once '../Classes/AluguelProdutosKitProdutosDTO.php';
//Conexão com a classe AluguelProdutosKitProdutosDAO
require_once '../Conexao/AluguelProdutosKitProdutosDAO.php';

//Variáveis que recebem os valores pela url
$aluguel = $_GET['aluguel'];
$produto = $_GET['produto'];
$kitprodutos = $_GET['kit'];

//Novo objeto da classe AluguelProdutosKitProdutosDTO
$APKDTO = new AluguelProdutosKitProdutosDTO();

//Metodos que setam os atributos da classe AluguelProdutosKitProdutosDTO
$APKDTO->setAluguel($aluguel);
$APKDTO->setProduto($produto);
$APKDTO->setKitprodutos($kitprodutos);
//Novo objeto da classe AluguelProdutosKitProdutosDAO
$APKDAO = new AluguelProdutosKitProdutosDAO();

//Metodo de excluir um item do aluguel no Banco de dados
$APKDAO->ExcluirAPKById($APKDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=alugueis&idaluguel=$aluguel';";
echo "</script>";

