<?php
//Conexão com a classe UsuarioDTO
require_once '../Classes/UsuarioDTO.php';
//Conexão com a classe UsuarioDAO
require_once '../Conexao/UsuarioDAO.php';

//Variável que recebe o id do usuario por url
$idusuario = $_GET['idusuario'];

//Novo objeto da classe UsuarioDTO
$UsuarioDTO = new UsuarioDTO();

//Metodo que seta o atributo idusuario da classe UsuarioDTO
$UsuarioDTO->setIdusuario($idusuario);

//Novo objeto da classe UsuarioDAO
$UsuarioDAO = new UsuarioDAO();

//Metodo que exclui os dados da tabela usuario cujo o  id_usuario seja igual ao setado na variável
$UsuarioDAO->ExcluirUsuarioById($UsuarioDTO);

//Script do tipo JavaScript
echo "<script>";
//Metodo JavaScript que redireciona de volta para a página de pesquisa
echo "  window.location ='../Views/Suporte.php'";
echo "</script>";

