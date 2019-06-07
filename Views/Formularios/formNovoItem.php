<!DOCTYPE html>
<!-- Página reservada para formulário de adição de novo item no aluguel -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulário de novo Item</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        
        <?php
        //Conexão com a classe ProdutoDTO e ProdutoDAO
        require_once '../Classes/ProdutoDTO.php';
        require_once '../Conexao/ProdutoDAO.php';
        
        //Conexão com a classe KitProdutosDTO e KitProdutosDAO
        require_once '../Classes/KitProdutosDTO.php';
        require_once '../Conexao/KitProdutosDAO.php';
        
        //Novos objetos das classes ProdutoDTO e ProdutoDAO
        $ProdutoDTO = new ProdutoDTO();
        $ProdutoDAO = new ProdutoDAO();
        
        //Novos objetos das classes KitProdutosDTO e KitProdutosDAO
        $KitProdutosDTO = new KitProdutosDTO();
        $KitProdutosDAO = new KitProdutosDAO();
        
        if(isset($_GET['idaluguel'])){
            $idaluguel = $_GET['idaluguel'];
        } else{
            echo "<h1 class='text-danger text-center'>ERRO Volte e refaça o processo</h1>";           
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <form action="" method="post">
                        <label>Escolha o tipo do novo item:</label>
                        <select name="tipo" class="form-control" onchange="this.form.submit()">
                            <option selected>Selecione</option>
                            <option value="produto">Produto</option>
                            <option value="Kit">Kit</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="row">
                <?php
                if(isset($_POST['tipo'])){
                    $tipo = $_POST['tipo'];
                    
                    switch ($tipo){
                        case "produto":
                            ?>
                <form action="../Controller/InserirNovoItem.php" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <td><label class="pull-right">Produto:</label></td>
                            <td><input type="hidden" name="aluguel" value="<?php echo $idaluguel; ?>">
                                <select name="produto" class="form-control">
                                    <option selected>Selecione</option>
                                    <?php
                                    $produtos = $ProdutoDAO->PesquisarTodos();
                                    $quantidadetotal = 0;
                                    foreach ($produtos as $produto){
                                        $ProdutoDTO->setIdproduto($produto["id_produto"]);
                                        $alugados = $ProdutoDAO->PesquisarProdutoAlugado($ProdutoDTO);
                                        
                                        foreach ($alugados as $alugado){
                                            $quantidadetotal += $alugado["quantidade_item"];
                                        }
                                        if($produto["nome_produto"]!="Nulo" && $quantidadetotal < $produto["quantidade"]){
                                    ?>
                                    <option value="<?php echo $produto["id_produto"]; ?>"><?php echo $produto["nome_produto"]; ?></option>
                                    <?php
                                        }
                                    }
                                    $KitProdutosDTO->setNome("Nulo");
                                    $kps = $KitProdutosDAO->PesquisarKitProdutoByNome($KitProdutosDTO);
                                    foreach ($kps as $kp){ ?>
                                    <input type="hidden" name="kit" value="<?php echo $kp["id_kit_produtos"]; ?>">
                                    <?php
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
                            <td colspan="2"><a href="LayoutAdministrador.php?link=alugueis&idaluguel=<?php $idaluguel ?>"><button class="btn btn-info" type="button">Voltar <span class="glyphicon glyphicon-backward"></span></button></a><input type="submit" value="Inserir Novo Item" onclick='return confirmarcadastro()' class="btn btn-success"/></td>
                        </tr>
                    </table>
                </form>
                            <?php
                            break;
                        case "Kit":
                            ?>
                <form action="../Controller/InserirNovoItem.php" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <td><label class="pull-right">Kit:</label></td>
                            <td><input type="hidden" name="aluguel" value="<?php echo $idaluguel; ?>">
                                <select name="kit" class="form-control">
                                    <option selected>Selecione</option>
                                    <?php
                                    $kps = $KitProdutosDAO->PesquisarTodos();
                                    $quantidadetotal = 0;
                                    foreach ($kps as $kp){
                                        $KitProdutosDTO->setIdkitprodutos($kp["id_kit_produtos"]);
                                        $alugados = $KitProdutosDAO->PesquisarKitProdutosAlugado($KitProdutosDTO);
                                        
                                        foreach ($alugados as $alugado){
                                            $quantidadetotal += $alugado["quantidade_item"];
                                        }
                                        
                                        if($kp["nome_kit_produtos"]!="Nulo" && $quantidadetotal < $kp["quantidade_kit_produtos"]){
                                    ?>
                                    <option value="<?php echo $kp["id_kit_produtos"]; ?>"><?php echo $kp["nome_kit_produtos"]; ?></option>
                                    <?php
                                        }
                                    }
                                    
                                    $ProdutoDTO->setNome("Nulo");
                                    $produtos = $ProdutoDAO->PesquisarProdutoByNome($ProdutoDTO);
                                    foreach ($produtos as $produto){ ?>
                                    <input type="hidden" name="produto" value="<?php echo $produto["id_produto"]; ?>">
                                    <?php
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
                            <td colspan="2"><a href="LayoutAdministrador.php?link=alugueis&idaluguel=<?php $idaluguel ?>"><button class="btn btn-info" type="button">Voltar <span class="glyphicon glyphicon-backward"></span></button></a><input type="submit" value="Inserir Novo Item" onclick='return confirmarcadastro()' class="btn btn-success"/></td>
                        </tr>
                    </table>
                </form>
                            <?php
                            break;
                        default :
                            break;
                    }
                }  else { ?>
                
                    <a href="LayoutAdministrador.php?link=alugueis&idaluguel=<?php $idaluguel ?>"><button class="btn btn-info" type="button">Voltar <span class="glyphicon glyphicon-backward"></span></button></a>
                
                <?php            
                }
                ?>
            </div>
        </div>
        
        <script src="../../js/jquery-3.1.0.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/main.js"></script>
    </body>
</html>
