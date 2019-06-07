<!DOCTYPE html>
<!-- Menu do Administrador-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menunav">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="#" class="navbar-brand">Usuário: <?php echo $_SESSION["usuario"]; ?></a>
                    </div>
                    <div class="collapse navbar-collapse" id="menunav">
                        <ul class="nav navbar-nav navbar-right">
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Serviços <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="LayoutAdministrador.php?link=alugueis">Aluguel de produtos</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="LayoutAdministrador.php?link=aluguelsalao">Aluguel de salões</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="LayoutAdministrador.php?link=vendas">Vendas</a></li>
                                </ul>
                            </li>
                            
                            <li role="presentation"><a href="LayoutAdministrador.php?link=clientes">Clientes</a></li>
                            <li role="presentation"><a href="../Controller/Logout.php">Sair <span class="glyphicon glyphicon-log-out"></span></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
    </body>
</html>
