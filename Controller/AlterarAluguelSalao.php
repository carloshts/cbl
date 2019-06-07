<?php

//Conexão com a classe AluguelSalaoDTO
require_once '../Classes/AluguelSalaoDTO.php';
//Conexão com a classe AluguelSalaoDAO
require_once '../Conexao/AluguelSalaoDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$datareserva = $_POST['datareserva'];
$dataentrega = $_POST['dataentrega'];
$salao = $_POST['salao'];
$status = $_POST['status'];
$cliente = $_POST['cliente'];

//Novo objeto da classe AluguelSalaoDTO
$AluguelSalaoDTO = new AluguelSalaoDTO();

//Metodos que setam os atributos da classe AluguelSalaoDTO
$AluguelSalaoDTO->setCliente($cliente);
$AluguelSalaoDTO->setSalao($salao);
$AluguelSalaoDTO->setStatus($status);
$AluguelSalaoDTO->setDatareserva($datareserva);
$AluguelSalaoDTO->setDataentrega($dataentrega);
//Novo objeto da classe AluguelDAO
$AluguelSalaoDAO = new AluguelSalaoDAO();

//Metodo de alterar os dados do aluguel_salao com atributo correspondente no Banco de dados
$AluguelSalaoDAO->AlterarAluguelSalao($AluguelSalaoDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=aluguelsalao'";
echo "</script>";