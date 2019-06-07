<?php
//Conexão com a classe EstoqueDTO
require_once '../Classes/EstoqueDTO.php';
//Conexão com a classe EstoqueDAO
require_once '../Conexao/EstoqueDAO.php';

//Variável que recebe o id do estoque por url
$idestoque = $_GET['idestoque'];

//Novo objeto da classe EstoqueDTO
$EstoqueDTO = new EstoqueDTO();

//Metodo que seta o atributo idestoque da classe EstoqueDTO
$EstoqueDTO->setIdestoque($idestoque);

//Novo objeto da classe CategoriaDAO
$EstoqueDAO = new EstoqueDAO();

//Metodo que exclui os dados da tabela estoque cujo o  id_estoque seja igual ao setado na variável
$EstoqueDAO->ExcluirEstoqueById($EstoqueDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=estoques';";
echo "</script>";

