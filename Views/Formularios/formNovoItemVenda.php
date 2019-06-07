<!DOCTYPE html>
<!-- Página reservada para formulário de adição de novo item na venda -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulário de novo Item de venda</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        
        <?php
        //Conexão com a classe ProdutoDAO
        require_once '../Conexao/ProdutoDAO.php';
        
        //Novos objetos das classes ProdutoDAO
        $ProdutoDAO = new ProdutoDAO();
        
        
        if(isset($_GET['idvenda'])){
            $idvenda = $_GET['idvenda'];
        } else{
            echo "<h1 class='text-danger text-center'>ERRO Volte e refaça o processo</h1>";           
        }
        ?>
        <div class="container">
            <div class="row">
                
                <form action="../Controller/InserirNovoItemVenda.php" class="form-control-static" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <td><label class="pull-right">Produto:</label></td>
                            <td><input type="hidden" name="venda" value="<?php echo $idvenda; ?>">
                                <select name="produto" class="form-control">
                                    <option selected>Selecione</option>
                                    <?php
                                    $produtos = $ProdutoDAO->PesquisarProdutoLivre();
                                    foreach ($produtos as $produto){
                                        
                                        if($produto["nome_produto"]!="Nulo"){
                                    ?>
                                    <option value="<?php echo $produto["id_produto"]; ?>"><?php echo $produto["nome_produto"]; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="pull-right">Quantidade:</label></td>
                            <td><input type="number" class="form-control" name="quantidade"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="LayoutAdministrador.php?link=vendas&idvenda=<?php $idvenda ?>"><button class="btn btn-info" type="button">Voltar <span class="glyphicon glyphicon-backward"></span></button></a><input type="submit" value="Inserir Novo Item" onclick='return confirmarcadastro()' class="btn btn-success"/></td>
                        </tr>
                    </table>
                </form>               
            </div>
        </div>
        
        <script src="../../js/jquery-3.1.0.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/main.js"></script>
    </body>
</html>
