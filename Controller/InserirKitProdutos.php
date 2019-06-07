<?php

//Conexão com a classe KitProdutosDTO
require_once '../Classes/KitProdutosDTO.php';
//Conexão com a classe KitProdutosDAO
require_once '../Conexao/KitProdutosDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$nome = $_POST['nome'];
$disponibilidade = $_POST['disponibilidade'];
$descricao = $_POST['descricao'];
$quantidade = $_POST['quantidade'];
$preco = $_POST['preco'];
$precoCompra = $_POST['precoCompra'];
$categoria = $_POST['categoria'];

//Novo objeto da classe KitProdutosDTO
$KitProdutosDTO = new KitProdutosDTO();

//Metodos que setam os atributos da classe KitProdutosDTO
$KitProdutosDTO->setNome($nome);
$KitProdutosDTO->setDisponibilidade($disponibilidade);
$KitProdutosDTO->setDescricao($descricao);
$KitProdutosDTO->setQuantidade($quantidade);
$KitProdutosDTO->setPreco($preco);
$KitProdutosDTO->setPrecoCompra($precoCompra);
$KitProdutosDTO->setCategoria($categoria);

//Novo objeto da classe KitProdutosDAO
$KitProdutosDAO = new KitProdutosDAO();

//Metodo de inserir um  novo kit no Banco de dados
$KitProdutosDAO->InserirKitProdutos($KitProdutosDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=produtos'";
echo "</script>";
