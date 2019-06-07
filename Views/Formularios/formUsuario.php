<!DOCTYPE html>
<!-- Formulário de cadastro de cliente -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulário de cadastro de cliente</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    require_once '../../Conexao/UsuarioDAO.php';
                    require_once '../../Classes/UsuarioDTO.php';

                    if (isset($_GET['idusuario'])) {
                        $idusuario = $_GET['idusuario'];
                    } else {
                        $idusuario = null;
                    }
                    $UsuarioDTO = new UsuarioDTO();
                    $UsuarioDTO->setIdusuario($idusuario);
                    $UsuarioDAO = new UsuarioDAO();
                    $usuario = $UsuarioDAO->PesquisarUsuarioByID($UsuarioDTO);
                    ?>
                    <form action="<?php if($idusuario==null){
                    echo "../../Controller/InserirUsuario.php";}  else {
    
                        echo "../../Controller/AlterarUsuario.php";}?>" method="post" id="formulario" class="form-control-static">

                        <table class="table table-bordered table-condensed">
                            <tr hidden>
                                <td><input type="hidden" name="idusuario" value="<?php echo $idusuario;?>"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Usuário:</label></td>
                                <td><input type="text" name="usuario" required value="<?php echo $usuario["usuario"]; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Tipo:</label></td>
                                <td>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <?php if(isset($_GET['idusuario'])){
                                            ?>
                                        <option value="<?php echo $usuario["tipo"]; ?>"><?php echo $usuario["tipo"]; ?></option>
                                        <?php
                                        }  else { ?>
                                        <option selected>Selecione</option>  
                                        <?php
                                        }
                                            
                                        ?>
                                        
                                        <option value="Administrador">Administrador</option>
                                        <option value="Funcionário">Funcionário</option>
                                        <option value="Suporte">Suporte</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Senha:</label></td>
                                <td><input type="password" id="senha" name="senha" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Confirmar senha:</label></td>
                                <td><input type="password" id="confsenha" name="confirmarsenha" required class="form-control"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><a href="../Suporte.php"><button class="btn btn-primary" type="button">Voltar <span class="glyphicon glyphicon-backward"></span></button></a><input type="submit" value="<?php if ($idusuario != null) {
    echo "Alterar";
} else {
    echo "Cadastrar";
    } ?>" <?php if ($idusuario != null) {
    echo "onclick='return confirmaralteracao()'";
} else {
    echo "onclick='return confirmarcadastro()'";
    } ?> class="btn btn-default"/></td>

                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <script src="../../js/jquery-3.1.0.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/main.js"></script>
        <script type="text/javascript">
            var password = document.getElementById("senha"), confirm_password = document.getElementById("confsenha");

            function validatePassword(){
                if(password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Senhas diferentes!");
                } else {
                confirm_password.setCustomValidity('');
                }
            }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        </script>
    </body>
</html>
