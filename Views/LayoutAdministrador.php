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
    <body style="padding-top: 55px;">
        <div class="container">
            
            <?php
            switch ($_SESSION["tipo"]){
            case "Administrador":
                include './menuAdmin.php';
                break;
            case "Funcionário":
                include './menuFuncionario.php';
                break;
            case "Suporte":
                include './menuAdmin.php';
                break;
            }
            
            
            ?>
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
