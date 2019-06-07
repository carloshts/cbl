<?php

//Conexão com a classe CategoriaDTO
require_once '../Classes/CategoriaDTO.php';
//Conexão com a classe CategoriaDAO
require_once '../Conexao/CategoriaDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$idcategoria = $_POST['idcategoria'];
$categoria = $_POST['categoria'];

//Novo objeto da classe CategoriaDTO
$CategoriaDTO = new CategoriaDTO();

//Metodos que setam os atributos da classe CategoriaDTO
$CategoriaDTO->setIdcategoria($idcategoria);
$CategoriaDTO->setCategoria($categoria);

//Novo objeto da classe CategoriaDAO
$CategoriaDAO = new CategoriaDAO();

//Metodo de alterar os dados do categoria com idcategoria correspondente no Banco de dados
$CategoriaDAO->AlterarCategoria($CategoriaDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=categorias';";
echo "</script>";