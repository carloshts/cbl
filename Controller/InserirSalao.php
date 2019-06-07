<?php

//Conexão com a classe SalaoDTO
require_once '../Classes/SalaoDTO.php';
//Conexão com a classe SalaoDAO
require_once '../Conexao/SalaoDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$nome = $_POST['nome'];
$tel = $_POST['tel'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$status = $_POST['status'];
//Novo objeto da classe SalaoDTO
$SalaoDTO = new SalaoDTO();

//Metodos que setam os atributos da classe SalaoDTO
$SalaoDTO->setNome($nome);
$SalaoDTO->setTel($tel);
$SalaoDTO->setCep($cep);
$SalaoDTO->setRua($rua);
$SalaoDTO->setNumero($numero);
$SalaoDTO->setBairro($bairro);
$SalaoDTO->setCidade($cidade);
$SalaoDTO->setEstado($estado);
$SalaoDTO->setStatus($status);
//Novo objeto da classe SalaoDAO
$SalaoDAO = new SalaoDAO();

//Metodo de inserir um  novo categoria no Banco de dados
$SalaoDAO->InserirSalao($SalaoDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=saloes';";
echo "</script>";