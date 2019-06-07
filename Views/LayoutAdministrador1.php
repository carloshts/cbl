<!DOCTYPE html>
<!-- Página de layout de administrador -->
<?php
include '../Controller/ValidaLogin.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrador</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../css/estilo.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="../js/Alerts.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="row bg-primary" style="border-radius: 4px;border-left: 2px solid #1d4567;border-right: 2px solid #1d4567;border-bottom: 2px solid #1d4567;">
                <div class="col-xs-9">
                    <h4 class="h4">Usuário: <?php echo $_SESSION["usuario"]; ?></h4>
                </div>
                <a href="../Controller/Logout.php">
                    <div class="col-xs-3">
                        <img class="img-responsive pull-right" src="../Imagens/logout.png" alt="Logout">
                    </div>
                </a>
            </div>
            <div class="row" style="border-radius: 4px;border-left: 2px solid #1d4567;border-right: 2px solid #1d4567;border-bottom: 2px solid #1d4567">
                
                    <ul class="nav nav-pills nav-justified">
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
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                Controle <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="LayoutAdministrador.php?link=saloes">Salões</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="LayoutAdministrador.php?link=produtos">Produtos</a></li>
                            </ul>
                        </li>
                        <li role="presentation"><a href="LayoutAdministrador.php?link=clientes">Clientes</a></li>
                        <li role="presentation"><a href="LayoutAdministrador.php?link=graficos">Graficos</a></li>
                    </ul>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div col-xs-12>
                            <?php
                            if (isset($_GET['link'])) {
                                $link = $_GET['link'];
                            } else {
                                $link = null;
                            }
                            if (isset($_GET['idcliente'])) {
                                
                            }
                            switch ($link) {
                                case null:
                                    include './Pesquisas/PesquisarAluguel.php';
                                    break;
                                case "vendas":
                                    include './Pesquisas/PesquisarVenda.php';
                                    break;
                                case "formVenda":
                                    include './Formularios/formVenda.php';
                                    break;
                                case "novoItemVenda":
                                    include './Formularios/formNovoItemVenda.php';
                                    break;
                                case "alugueis":
                                    include './Pesquisas/PesquisarAluguel.php';
                                    break;
                                case "formAluguel":
                                    include './Formularios/formAluguel.php';
                                    break;
                                case "novoItem":
                                    include './Formularios/formNovoItem.php';
                                    break;
                                case "produtos":
                                    include './Pesquisas/PesquisarProduto1.php';
                                    break;
                                case "formProduto":
                                    include './Formularios/formProduto.php';
                                    break;
                                case "saloes":
                                    include './Pesquisas/PesquisarSalao.php';
                                    break;
                                case "formaluguelsalao":
                                    include_once './Formularios/formAluguelSalao.php';
                                    break;
                                case "aluguelsalao":
                                    include_once './Pesquisas/PesquisarAluguelSalao.php';
                                    break;
                                case "formSalao":
                                    include './Formularios/formSalao.php';
                                    break;
                                case "formKitProdutos":
                                    include './Formularios/formKitProdutos.php';
                                    break;
                                case "categorias":
                                    include './Pesquisas/PesquisarCategoria.php';
                                    break;
                                case "estoques":
                                    include './Pesquisas/PesquisarEstoque.php';
                                    break;
                                case "clientes":
                                    include './Pesquisas/PesquisarCliente.php';
                                    break;
                                case "formcliente":
                                    include './Formularios/formCliente.php';
                                    break;
                                case "graficos":
                                    include './Pesquisas/Graficos.php';
                                    break;
                                default :
                                    include './Pesquisas/PesquisarAluguel.php';
                                    break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/jquery-3.1.0.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        <script src="Formularios/cep/cep.js"></script>
        <script src="../js/lib/jquery.js"></script>
        <script src="../js/lib/jquery.validate.min.js"></script>
        <script src="../js/validacaoform.js"></script>
        <script src="../js/lib/jquery.maskedinput.js"></script>
        <script src="../js/mascara.js"></script>
        


    </body>
</html>
