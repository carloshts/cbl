<?php
//Conexão com a classe AluguelSalaoDTO
require_once '../Classes/AluguelSalaoDTO.php';
//Conexão com a classe AluguelSalaoDAO
require_once '../Conexao/AluguelSalaoDAO.php';

//Variável que recebe os atributos do aluguel de salão por url
$datareserva = $_GET['datareserva'];
$salao = $_GET['salao'];

//Novo objeto da classe AluguelSalaoDTO
$AluguelSalaoDTO = new AluguelSalaoDTO();

//Metodo que seta o atributo da classe AluguelSalaoDTO
$AluguelSalaoDTO->setSalao($salao);
$AluguelSalaoDTO->setDatareserva($datareserva);
//Novo objeto da classe AluguelDAO
$AluguelSalaoDAO = new AluguelSalaoDAO();

//Metodo que exclui os dados da tabela aluguel cujo o  id_aluguel seja igual ao setado na variável
$AluguelSalaoDAO->ExcluirAluguelSalaoById($AluguelSalaoDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=aluguelsalao'";
echo "</script>";