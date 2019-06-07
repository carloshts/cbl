<?php

//Conexão com a classe UsuarioDTO
require_once '../Classes/UsuarioDTO.php';
//Conexão com a classe UsuarioDAO
require_once '../Conexao/UsuarioDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$usuario = $_POST['usuario'];

$tipo = $_POST['tipo'];
$senha = md5($_POST['senha']);
//Novo objeto da classe UsuarioDAO
$UsuarioDAO = new UsuarioDAO();

//Novo objeto da classe UsuarioDTO
$UsuarioDTO = new UsuarioDTO();


//Metodos que setam os atributos da classe UsuarioDTO
$UsuarioDTO->setUsuario($usuario);
$UsuarioDTO->setSenha($senha);
$UsuarioDTO->setTipo($tipo);


$existe = $UsuarioDAO->PesquisarUsuarioExistente($UsuarioDTO);

if($existe == FALSE){
//Metodo de inserir um  novo usuario no Banco de dados
$UsuarioDAO->InserirUsuario($UsuarioDTO);

//Script em JavaScript que envia um alerta de conclusão de cadastro
echo "<script>";
echo "  window.location ='../Views/Formularios/formUsuario.php';";
echo "  alert('Cadastro realizado com sucesso!');";
echo "</script>";
}  else {
    //Script em JavaScript que envia um alerta de erro de cadastro
echo "<script>";
echo "  window.location ='../Views/Formularios/formUsuario.php';";
echo "  alert('Usúario existente. Tente novamente!');";
echo "  history.back();";
echo "</script>";
}