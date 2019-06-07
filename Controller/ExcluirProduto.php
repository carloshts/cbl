<?php
//Conexão com a classe ProdutoDTO
require_once '../Classes/ProdutoDTO.php';
//Conexão com a classe ProdutoDAO
require_once '../Conexao/ProdutoDAO.php';

//Variável que recebe o id do produto por url
$idproduto = $_GET['idproduto'];

//Novo objeto da classe ProdutoDTO
$ProdutoDTO = new ProdutoDTO();

//Metodo que seta o atributo idproduto da classe ProdutoDTO
$ProdutoDTO->setIdproduto($idproduto);

//Novo objeto da classe ProdutoDAO
$ProdutoDAO = new ProdutoDAO();

//Metodo que exclui os dados da tabela produto cujo o  id_produto seja igual ao setado na variável
$ProdutoDAO->ExcluirProdutoById($ProdutoDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=produtos'";
echo "</script>";

