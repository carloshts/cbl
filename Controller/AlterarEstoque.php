<?php

//Conexão com a classe EstoqueDTO
require_once '../Classes/EstoqueDTO.php';
//Conexão com a classe EstoqueDAO
require_once '../Conexao/EstoqueDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$nome = $_POST['estoque'];
$capacidade = $_POST['capacidade'];
$idestoque = $_POST['idestoque'];
//Novo objeto da classe EstoqueDTO
$EstoqueDTO = new EstoqueDTO();

//Metodos que setam os atributos da classe EstoqueDTO
$EstoqueDTO->setNome($nome);
$EstoqueDTO->setCapacidade($capacidade);
$EstoqueDTO->setIdestoque($idestoque);

//Novo objeto da classe EstoqueDAO
$EstoqueDAO = new EstoqueDAO();

//Metodo de alterar um estoque no Banco de dados
$EstoqueDAO->AlterarEstoque($EstoqueDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=estoques';";
echo "</script>";