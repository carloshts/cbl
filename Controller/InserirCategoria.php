<?php

//Conexão com a classe CategoriaDTO
require_once '../Classes/CategoriaDTO.php';
//Conexão com a classe CategoriaDAO
require_once '../Conexao/CategoriaDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$categoria = $_POST['categoria'];

//Novo objeto da classe CategoriaDTO
$CategoriaDTO = new CategoriaDTO();

//Metodos que setam os atributos da classe CategoriaDTO
$CategoriaDTO->setCategoria($categoria);

//Novo objeto da classe CategoriaDAO
$CategoriaDAO = new CategoriaDAO();

//Metodo de inserir um  novo categoria no Banco de dados
$CategoriaDAO->InserirCategoria($CategoriaDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=categorias';";
echo "</script>";