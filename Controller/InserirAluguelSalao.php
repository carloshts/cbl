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
$usuario = $_POST["usuario"];
//Novo objeto da classe AluguelSalaoDTO
$AluguelSalaoDTO = new AluguelSalaoDTO();

//Metodos que setam os atributos da classe AluguelSalaoDTO
$AluguelSalaoDTO->setCliente($cliente);
$AluguelSalaoDTO->setSalao($salao);
$AluguelSalaoDTO->setStatus($status);
$AluguelSalaoDTO->setDatareserva($datareserva);
$AluguelSalaoDTO->setDataentrega($dataentrega);
$AluguelSalaoDTO->setUsuario($usuario);
//Novo objeto da classe AluguelDAO
$AluguelSalaoDAO = new AluguelSalaoDAO();

//Metodo de inserir um  novo aluguel_salao no Banco de dados
$AluguelSalaoDAO->InserirAluguelSalao($AluguelSalaoDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=aluguelsalao'";
echo "</script>";