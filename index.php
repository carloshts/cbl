<!DOCTYPE html>
<!-- Página de login versão 1.0 -->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <img src="Imagens/logoEmpresaFictícia1.png" class="text-center img-responsive img-rounded" alt="">
                </div>
                <div class="col-xs-12">
                    <form action="Controller/Login.php" method="post" class="form-control-static">
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2  col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                                <label class="lead">Usuário:</label><input type="text" name="usuario" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2  col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                                <label class="lead">Senha:</label><input type="password" name="senha" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2  col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                                <input type="submit" value="Login" class="btn btn-default">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <script src="js/jquery-3.1.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
