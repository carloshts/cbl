<?php

//Conexão com a classe KitProdutosDTO
require_once '../Classes/KitProdutosDTO.php';
//Conexão com a classe KitProdutosDAO
require_once '../Conexao/KitProdutosDAO.php';

//Variável que recebe o id pela url
$idkitprodutos = $_GET['idkp'];
//Novo objeto da classe KitProdutosDTO
$KitProdutosDTO = new KitProdutosDTO();

//Metodos que setam os atributos da classe KitProdutosDTO
$KitProdutosDTO->setIdkitprodutos($idkitprodutos);

//Novo objeto da classe KitProdutosDAO
$KitProdutosDAO = new KitProdutosDAO();

//Metodo de exclui um kit do Banco de dados
$KitProdutosDAO->ExcluirKitProdutosById($KitProdutosDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=produtos'";
echo "</script>";
