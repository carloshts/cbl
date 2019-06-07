<?php
//Abre a sessão
session_start();
//Conexão com a classe LoginDAO
require_once '../Conexao/LoginDAO.php';
//Conexão com a classe LoginDTO
require_once '../Classes/LoginDTO.php';

//Variaveis que guardam o login e a senha
$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

//Novo objeto da classe LoginDTO
$LoginDTO = new LoginDTO();
//Metodos de set de usuario e senha
$LoginDTO->setUsuario($usuario);
$LoginDTO->setSenha($senha);
//Novo objeto da classe LoginDAO
$LoginDAO = new LoginDAO();
//Variavel que recebe o array com os dados do usuario logado
$usuariologin = $LoginDAO->Login($LoginDTO);


if(!empty($usuariologin["usuario"])){
    $_SESSION["idusuario"] = $usuariologin["id_usuario"];
    $_SESSION["usuario"] = $usuariologin["usuario"];
    $_SESSION["tipo"] = $usuariologin["tipo"];
    
    if($_SESSION["tipo"]=="Suporte"){
        echo "<script>";
        echo "  window.location='../Views/Suporte.php'";
        echo "</script>";
    }  else {
        echo "<script>";
        echo "  window.location='../Views/LayoutAdministrador.php';";
        echo "  alert('Bem Vindo! \\n Mantenha a data e a hora do seu servidor atualizadas!');";
        echo "</script>";
    }
    
} else {
    echo "<script>";
    echo "  alert('Acesso Negado!');";
    echo "  history.back();";
    echo "</script>";
}
