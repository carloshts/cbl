<!DOCTYPE html>
<!-- Página reservada para uso do suporte -->
<?php
include '../Controller/ValidarSuporte.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Suporte de usuários</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../css/estilo.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="../js/Alerts.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="#" class="pull-left h3">Usuário: <?php echo $_SESSION["usuario"]; ?></a>
                    <a href="../Controller/Logout.php" class="pull-right h3">Sair <span class="glyphicon glyphicon-log-out"></span></a>                        
                </div>
            </div>
            <div class="row">
                <form action="" method="post" class="form-inline-static">
                    <div class="col-xs-12 col-sm-4">
                        <input type="text" name="pesquisa" class="form-control"/>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <button type="submit" class="btn btn-default btn-block">Pesquisar <span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </form>
                <div class="col-xs-12 col-sm-4">
                    <a href="Formularios/formUsuario.php"><button type="button" class="btn btn-success btn-block">Novo Usuário <span class="glyphicon glyphicon-plus"></span></button></a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dropdown open">
                        <button class="btn btn-default btn-block dropdown-toggle" type="button" id="usuarios" data-toggle="dropdown">
                            Usuários<span class="caret"></span>
                        </button>

                        <table class="table table-bordered table-responsive dropdown-menu" role="menu" aria-labeledby="usuarios">
                            <tr class="bg-primary">
                                <td>Usúario</td>
                                <td>Tipo</td>
                                <td>Alterar</td>
                                <td>Excluir</td>
                            </tr>

                            <?php
                            require_once '../Conexao/UsuarioDAO.php';
                            require_once '../Classes/UsuarioDTO.php';

                            $UsuarioDTO = new UsuarioDTO();


                            $UsuarioDAO = new UsuarioDAO();

                            if (!empty($_POST['pesquisa'])) {

                                $UsuarioDTO->setUsuario($_POST['pesquisa']);
                                $usuarios = $UsuarioDAO->PesquisarUsuarioByUsuario($UsuarioDTO);
                            } else {
                                $usuarios = $UsuarioDAO->PesquisarTodos();
                            }




                            foreach ($usuarios as $usuario) {
                                echo "<tr>";
                                echo "      <td>" . $usuario["usuario"] . "</td>";
                                echo "      <td>" . $usuario["tipo"] . "</td>";
                                echo "      <td><a href='Formularios/formUsuario.php?idusuario=" . $usuario["id_usuario"] . "'><button class='btn btn-warning'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
                                echo "      <td><a href='../Controller/ExcluirUsuario.php?idusuario=" . $usuario["id_usuario"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <script src="../js/jquery-3.1.0.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>
