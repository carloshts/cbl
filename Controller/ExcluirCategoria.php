<?php
//Conexão com a classe CategoriaDTO
require_once '../Classes/CategoriaDTO.php';
//Conexão com a classe CategoriaDAO
require_once '../Conexao/CategoriaDAO.php';

//Variável que recebe o id do categoria por url
$idcategoria = $_GET['idcategoria'];

//Novo objeto da classe CategoriaDTO
$CategoriaDTO = new CategoriaDTO();

//Metodo que seta o atributo idcategoria da classe CategoriaDTO
$CategoriaDTO->setIdcategoria($idcategoria);

//Novo objeto da classe CategoriaDAO
$CategoriaDAO = new CategoriaDAO();

//Metodo que exclui os dados da tabela categoria cujo o  id_categoria seja igual ao setado na variável
$CategoriaDAO->ExcluirCategoriaById($CategoriaDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=categorias';";
echo "</script>";

