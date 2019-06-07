<?php

//Conexão com a classe AluguelDTO
require_once '../Classes/AluguelDTO.php';
//Conexão com a classe AluguelDAO
require_once '../Conexao/AluguelDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$dataentrada = $_POST['dataentrada'];
$datasaida = $_POST['datasaida'];
$status = $_POST['status'];
$cliente = $_POST['cliente'];
$usuario = $_POST["usuario"];
//Novo objeto da classe AluguelDTO
$AluguelDTO = new AluguelDTO();

//Metodos que setam os atributos da classe AluguelDTO
$AluguelDTO->setCliente($cliente);
$AluguelDTO->setDataentrada($dataentrada);
$AluguelDTO->setDatasaida($datasaida);
$AluguelDTO->setStatus($status);
$AluguelDTO->setUsuario($usuario);
//Novo objeto da classe AluguelDAO
$AluguelDAO = new AluguelDAO();

//Metodo de inserir um  novo aluguel no Banco de dados
$AluguelDAO->InserirAluguel($AluguelDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/LayoutAdministrador.php?link=alugueis'";
echo "</script>";