<!DOCTYPE html>
<!-- Página reservada para formulário de alteração de cadastro de produtos -->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <table class="table table-bordered">
            <form class="form-control-static" action="<?php if(isset($_GET['idproduto'])){echo "../Controller/AlterarProduto.php";} else {echo "../Controller/InserirProduto.php";} ?>" method="post">
                <?php
                //Conexão com a classe ProdutoDTO
                require_once '../Classes/ProdutoDTO.php';
                //Conexão com a classe ProdutoDAO
                require_once '../Conexao/ProdutoDAO.php';
                //Conexão com a classe CategoriaDAO
                require_once '../Conexao/CategoriaDAO.php';
                //Conexão com a classe KitProdutosDAO
                require_once '../Conexao/KitProdutosDAO.php';
                //Conexão com a classe EstoqueDAO
                require_once '../Conexao/EstoqueDAO.php';

                //Novo objeto da classe ProdutoDTO
                $ProdutoDTO = new ProdutoDTO();
                //Novo objeto da classe ProdutoDAO
                $ProdutoDAO = new ProdutoDAO();
                //Novo objeto da classe CategoriaDAO
                $CategoriaDAO = new CategoriaDAO();
                //Novo objeto da classe KitProdutosDAO
                $KitProdutosDAO = new KitProdutosDAO();
                //Novo objeto da classe EstoqueDAO
                $EstoqueDAO = new EstoqueDAO();
                if(isset($_GET['idproduto'])){
                $ProdutoDTO->setIdproduto($_GET['idproduto']);
                $produto = $ProdutoDAO->PesquisarProdutoByID($ProdutoDTO);
                }
                ?>
                <tr>
                    <td><label class="pull-right">Nome:</label></td>
                    <td><input type="hidden" name="idproduto" value="<?php if(isset($_GET['idproduto'])){echo $_GET['idproduto'];}?>">
                        <input class="form-control" type="text" value="<?php if (isset($_GET['idproduto'])) { echo $produto["nome_produto"];}?>"name="nome"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Preço de compra:</label></td>
                    <td><input type="text" class="form-control" value="<?php if (isset($_GET['idproduto'])) { echo $produto["preco_compra_p"];}?>" name="precoCompra"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Preço de venda:</label></td>
                    <td><input type="text" class="form-control" value="<?php if (isset($_GET['idproduto'])) { echo $produto["preco_produto"];}?>" name="preco"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Disponibilidade:</label></td>
                    <td><?php if (isset($_GET['idproduto'])) {?>
                        <select name="disponibilidade" class="form-control">
                            <option selected value="<?php echo $produto["disponibilidade_produto"];?>"><?php echo $produto["disponibilidade_produto"];?></option>
                            <option class="bg-success" value="Disponivel">Disponível</option>
                            <option class="bg-danger" value="Indisponível">Indisponível</option>
                            <option class="bg-warning" value="Alugado">Alugado</option>
                        </select>
                        <?php }else{ echo"<input type='hidden' name='disponibilidade' value='Disponível'>Disponível";}?>
                    </td>
                </tr>
                <tr>
                    <td><label class="pull-right">Permissão:</label></td>
                    <td>
                        <select name="permissao" class="form-control">
                            <?php if (isset($_GET['idproduto'])) { ?>
                            <option selected value="<?php echo $produto["tipo_permissao"];?>"><?php 
                                    switch ($produto["tipo_permissao"]){
                                        case 1:
                                            echo "Venda";
                                            break;
                                        case 2:
                                            echo "Locação";
                                            break;
                                        default :
                                            echo "Locação e venda";
                                            break;
                                    }
                            ?></option>
                            <?php } else { ?>
                            <option selected>Selecione</option>
                            <?php } ?>
                            <option value="1">Venda</option>
                            <option value="2">Locação</option>
                            <option value="3">Locação e venda</option>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td><label class="pull-right">Descrição:</label></td>
                    <td><input class="form-control" value="<?php if (isset($_GET['idproduto'])) { echo $produto["descricao_produto"];}?>" type="textarea" name="descricao"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Quantidade:</label></td>
                    <td><input class="form-control" value="<?php if (isset($_GET['idproduto'])) { echo $produto["quantidade"];}?>" type="number" name="quantidade"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Categoria:</label></td>
                    <td>
                        <select class="form-control" name="categoria">
                            <?php
                            if (isset($_GET['idproduto'])) {
                                $categorias = $CategoriaDAO->PesquisarTodos();

                                foreach ($categorias as $categoria) {

                                    $idproduto = $_GET['idproduto'];
                                    $ProdutoDTO->setIdproduto($idproduto);
                                    $produto = $ProdutoDAO->PesquisarProdutoByID($ProdutoDTO);
                                    if ($produto["categoria"] == $categoria["id_categoria"]) {
                                        echo "<option selected value='" . $categoria["id_categoria"] . "'>" . $categoria["nome_categoria"] . "</option>";
                                    }
                                    echo "<option value='" . $categoria["id_categoria"] . "'>" . $categoria["nome_categoria"] . "</option>";
                                }
                            } else {
                                $categorias = $CategoriaDAO->PesquisarTodos();
                                echo "<option selected>Selecione</option>";
                                foreach ($categorias as $categoria) {
                                    echo "<option value='" . $categoria["id_categoria"] . "'>" . $categoria["nome_categoria"] . "</option>";
                                }
                            }
                            ?>

                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td><label class="pull-right">Kit:</label></td>
                    <td>
                        <select class="form-control" name="kit">
                            <?php
                            if (isset($_GET['idproduto'])) {
                                $kps = $KitProdutosDAO->PesquisarTodos();

                                foreach ($kps as $kp) {

                                    $idproduto = $_GET['idproduto'];
                                    $ProdutoDTO->setIdproduto($idproduto);
                                    $produto = $ProdutoDAO->PesquisarProdutoByID($ProdutoDTO);
                                    if ($produto["kit_produtos"] == $kp["id_kit_produtos"]) {
                                        echo "<option selected value='" . $kp["id_kit_produtos"] . "'>" . $kp["nome_kit_produtos"] . "</option>";
                                    } 
                                    echo "<option value='" . $kp["id_kit_produtos"] . "'>" . $kp["nome_kit_produtos"] . "</option>";
                                }
                            } else {
                                $kps = $KitProdutosDAO->PesquisarTodos();
                                echo "<option selected>Selecione</option>";
                                foreach ($kps as $kp) {
                                    echo "<option value='" . $kp["id_kit_produtos"] . "'>" . $kp["nome_kit_produtos"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label class="pull-right">Estoque:</label></td>
                    <td>
                        <select class="form-control" name="estoque">
                            <?php
                            if (isset($_GET['idproduto'])) {
                                $estoques = $EstoqueDAO->PesquisarTodos();

                                foreach ($estoques as $estoque) {

                                    $idproduto = $_GET['idproduto'];
                                    $ProdutoDTO->setIdproduto($idproduto);
                                    $produto = $ProdutoDAO->PesquisarProdutoByID($ProdutoDTO);
                                    if ($produto["estoque"] == $estoque["id_estoque"]) {
                                        echo "<option selected value='" . $estoque["id_estoque"] . "'>" . $estoque["nome_estoque"] . "</option>";
                                    }
                                    echo "<option value='" . $estoque["id_estoque"] . "'>" . $estoque["nome_estoque"] . "</option>";
                                }
                            } else {
                                $estoques = $EstoqueDAO->PesquisarTodos();
                                echo "<option selected>Selecione</option>";
                                foreach ($estoques as $estoque) {
                                    echo "<option value='" . $estoque["id_estoque"] . "'>" . $estoque["nome_estoque"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><a href="LayoutAdministrador.php?link=produtos"><button type="button" class="btn btn-primary">Voltar <span class="glyphicon glyphicon-backward"></span></button></a><input type="submit" class="btn btn-default" value="<?php if (isset($_GET['idproduto'])) {
    echo "Alterar";
} else {
    echo "Cadastrar";
    } ?>" <?php if (isset($_GET['idproduto'])) {
    echo "onclick='return confirmaralteracao()'";
} else {
    echo "onclick='return confirmarcadastro()'";
    } ?>></td>
                </tr>
            </form>
        </table>
        <script src="../../js/jquery-3.1.0.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/main.js"></script>
    </body>
</html>
