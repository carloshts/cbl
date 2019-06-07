<?php
//Conexão com a classe AluguelDTO
require_once '../Classes/AluguelDTO.php';
//Conexão com a classe AluguelDAO
require_once '../Conexao/AluguelDAO.php';

//Variável que recebe o id do aluguel por url
$idaluguel = $_GET['idaluguel'];

//Novo objeto da classe AluguelDTO
$AluguelDTO = new AluguelDTO();

//Metodo que seta o atributo idvenda da classe VendaDTO
$AluguelDTO->setIdaluguel($idaluguel);

//Novo objeto da classe AluguelDAO
$AluguelDAO = new AluguelDAO();

//Metodo que exclui os dados da tabela venda cujo o  id_venda seja igual ao setado na variável
$AluguelDAO->ExcluirAluguelById($AluguelDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=alugueis'";
echo "</script>";