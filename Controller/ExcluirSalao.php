<?php
//Conexão com a classe SalaoDTO
require_once '../Classes/SalaoDTO.php';
//Conexão com a classe SalaoDAO
require_once '../Conexao/SalaoDAO.php';

//Variável que recebe o id do salao por url
$idsalao = $_GET['idsalao'];

//Novo objeto da classe SalaoDTO
$SalaoDTO = new SalaoDTO();

//Metodo que seta o atributo idsalao da classe SalaoDTO
$SalaoDTO->setIdsalao($idsalao);

//Novo objeto da classe SalaoDAO
$SalaoDAO = new SalaoDAO();

//Metodo que exclui os dados da tabela salao cujo o  id_salao seja igual ao setado na variável
$SalaoDAO->ExcluirSalaoById($SalaoDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=saloes';";
echo "</script>";

