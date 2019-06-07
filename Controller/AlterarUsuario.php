<?php

//Conexão com a classe UsuarioDTO
require_once '../Classes/UsuarioDTO.php';
//Conexão com a classe UsuarioDAO
require_once '../Conexao/UsuarioDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$idusuario = $_POST['idusuario'];
$usuario = $_POST['usuario'];
$tipo = $_POST['tipo'];
$senha = md5($_POST['senha']);

//Novo objeto da classe UsuarioDTO
$UsuarioDTO = new UsuarioDTO();

//Metodos que setam os atributos da classe UsuarioDTO
$UsuarioDTO->setIdusuario($idusuario);
$UsuarioDTO->setUsuario($usuario);
$UsuarioDTO->setSenha($senha);
$UsuarioDTO->setTipo($tipo);

//Novo objeto da classe UsuarioDAO
$UsuarioDAO = new UsuarioDAO();

//Metodo de alterar um usuario no Banco de dados
$UsuarioDAO->AlterarUsuario($UsuarioDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/Suporte.php'";
echo "</script>";