<?php

//Conexão com a classe SalaoDTO
require_once '../Classes/SalaoDTO.php';
//Conexão com a classe SalaoDAO
require_once '../Conexao/SalaoDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$idsalao = $_POST['idsalao'];
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
$SalaoDTO->setIdsalao($idsalao);
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

//Metodo de alterar os dados do salao com idsalao correspondente no Banco de dados
$SalaoDAO->AlterarSalao($SalaoDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=saloes';";
echo "</script>";