<!DOCTYPE html>
<!-- Página de pesquisa de produtos, kit de produtos, categorias e estoques -->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <form action="" method="post" class="form-inline-static">
                    <div class="col-xs-12 col-sm-3">
                        <input class="form-control" type="text" name="pesquisa">
                    </div>
                    <div  class="col-xs-12 col-sm-3">
                        <button class="btn btn-default btn-block" type="submit">Pesquisar<span class="glyphicon glyphicon-search"></span></span></button>
                    </div>
                </form>
                <form action="" method="post" class="form-inline-static">
                    <div class="col-xs-12 col-sm-3">
                        <select class="form-control btn-block" name="categoria">
                            <option selected value="">Selecione</option>
                            <?php require_once '../Conexao/CategoriaDAO.php';
                            $CategoriaDAO = new CategoriaDAO();
                            
                            $categorias = $CategoriaDAO->PesquisarTodos();
                            
                            foreach ($categorias as $categoria){
                            ?>
                            <option value="<?php echo $categoria["id_categoria"];?>"><?php echo $categoria["nome_categoria"];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <button class="btn btn-default btn-block" type="submit">Pesquisar<span class="glyphicon glyphicon-search"></span></span></button>
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-3">
                    <a href="LayoutAdministrador.php?link=formProduto"><button class="btn btn-success btn-block" href="#"type="button">Novo produto <span class="glyphicon glyphicon-plus"></span></span></button></a>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <a href="LayoutAdministrador.php?link=formKitProdutos"><button class="btn btn-success btn-block" href="#"type="button">Novo Kit <span class="glyphicon glyphicon-plus"></span></span></button></a>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <a href="LayoutAdministrador.php?link=categorias"><button class="btn btn-primary btn-block" href="#"type="button">Categorias</button></a>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <a href="LayoutAdministrador.php?link=estoques"><button class="btn btn-primary btn-block" href="#"type="button">Estoques</button></a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 alert alert-warning">
                    <strong>Aviso!</strong>
                    <br>Para pleno funcionamento do sistema é necessário que esteja cadastrado na base de dados pelo menos um produto e um kit com o nome "Nulo".
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dropdown">
                        <button class="btn btn-default btn-block dropdown-toggle" type="button" id="produtos" data-toggle="dropdown">
                            Produtos<span class="caret"></span>
                        </button>
                        <table class="table table-bordered table-responsive dropdown-menu h2" role="menu" aria-labeledby="produtos">
                            
                            <tr class="bg-info">
                                <td>Nome</td>
                                <td>Status</td>
                                <td>Preço de compra</td>
                                <td>Preço de venda</td>
                                <td>Quantidade</td>
                                <td>Estoque</td>
                                <td>Descrição</td>
                                <td>Permissão</td>
                                <td>Categoria</td>
                                <td>Kit</td>
                                <td>Alterar</td>
                                <td>Excluir</td>
                            </tr>
                            <?php
                            //Conexão com a classe ProdutoDAO
                            require_once '../Conexao/ProdutoDAO.php';
                            //Conexão com a classe ProdutoDTO
                            require_once '../Classes/ProdutoDTO.php';
                            //Intanciando novo objeto da classe ProdutoDAO
                            $ProdutoDAO = new ProdutoDAO();
                            //Intanciando novo objeto da classe ProdutoDTO
                            $ProdutoDTO = new ProdutoDTO();
                            
                            if(!empty ($_POST['pesquisa'])){
                                $ProdutoDTO->setNome($_POST['pesquisa']);
                               //Array que recebe todos os dados retornados pelo metodo
                               $produtos = $ProdutoDAO->PesquisarProdutoByNome($ProdutoDTO);
                            }else if(!empty  ($_POST['categoria'])){
                                $ProdutoDTO->setCategoria($_POST['categoria']);
                                //Array que recebe todos os dados retornados pelo metodo
                                $produtos = $ProdutoDAO->PesquisarProdutoByCategoria($ProdutoDTO);
                            }else{
                                //Array que recebe todos os dados retornados pelo metodo
                                $produtos = $ProdutoDAO->PesquisarTodos();
                            }
                            foreach ($produtos as $produto) {
                                echo "<tr>";
                                echo "      <td>" . $produto["nome_produto"] . "</td>";
                                echo "      <td>" . $produto["disponibilidade_produto"] . "</td>";
                                echo "      <td>" . $produto["preco_compra_p"] . "</td>";
                                echo "      <td>" . $produto["preco_produto"] . "</td>";                                
                                echo "      <td>" . $produto["quantidade"] . "</td>";
                                echo "      <td>" . $produto["nome_estoque"] . "</td>";
                                echo "      <td>" . $produto["descricao_produto"] . "</td>";
                                switch ($produto["tipo_permissao"]){
                                        case 1:
                                            echo "<td>Venda</td>";
                                            break;
                                        case 2:
                                            echo "<td>Locação</td>";
                                            break;
                                        case 3:
                                            echo "<td>Locação e venda</td>";
                                            break;
                                        default :
                                            echo "<td>Nulo</td>";
                                }
                               echo "      <td>" . $produto["nome_categoria"] . "</td>";
                                echo "      <td>" . $produto["nome_kit_produtos"] . "</td>";
                                echo "      <td><a href='LayoutAdministrador.php?link=formProduto&idproduto=" . $produto["id_produto"] . "'><button type='button' class='btn btn-warning'><span  class='glyphicon glyphicon-pencil'></span></button></td>";
                                echo "      <td><a href='../Controller/ExcluirProduto.php?idproduto=" . $produto["id_produto"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="dropdown">
                        <button class="btn btn-default btn-block dropdown-toggle" type="button" id="kitprodutos" data-toggle="dropdown">
                            Kit de produtos<span class="caret"></span>
                        </button>
                        <table class="table table-bordered table-responsive dropdown-menu" role="menu" aria-labeledby="kitprodutos">
                            <tr class="bg-info">
                                <td>Nome</td>
                                <td>Status</td>
                                <td>Preço de compra</td>
                                <td>Preço de venda</td>
                                <td>Descrição</td>
                                <td>Quantidade</td>
                                <td>Categoria</td>
                                <td>Alterar</td>
                                <td>Excluir</td>
                            </tr>
                            <?php
                            //Conexão com a classe KitProdutosDAO
                            require_once '../Conexao/KitProdutosDAO.php';
                            //Conexão com a classe ProdutoDTO
                            require_once '../Classes/KitProdutosDTO.php';
                            
                            //Intanciando novo objeto da classe KitProdutosDAO
                            $KitProdutosDAO = new KitProdutosDAO();
                            //Intanciando novo objeto da classe ProdutoDTO
                            $KitProdutosDTO = new KitProdutosDTO();
                            
                            if(!empty ($_POST['pesquisa'])){
                               $KitProdutosDTO->setNome($_POST['pesquisa']);
                               //Array que recebe todos os dados retornados pelo metodo
                               $kps = $KitProdutosDAO->PesquisarKitProdutoByNome($KitProdutosDTO);
                            }else if(!empty ($_POST['categoria'])){
                                $KitProdutosDTO->setCategoria($_POST['categoria']);
                                //Array que recebe todos os dados retornados pelo metodo
                                $kps = $KitProdutosDAO->PesquisarKitProdutoByCategoria($KitProdutosDTO);
                            }else {
                                //Array que recebe todos os dados retornados pelo metodo
                                $kps = $KitProdutosDAO->PesquisarTodos();
                            }

                            foreach ($kps as $kp) {
                                echo "<tr>";
                                echo "      <td>" . $kp["nome_kit_produtos"] . "</td>";
                                echo "      <td>" . $kp["disponibilidade_kit_produtos"] . "</td>";
                                echo "      <td>" . $kp["preco_compra_kp"] . "</td>";
                                echo "      <td>" . $kp["preco_kit_produtos"] . "</td>";
                                echo "      <td>" . $kp["descricao_kit_produtos"] . "</td>";
                                echo "      <td>" . $kp["quantidade_kit_produtos"] . "</td>";
                                echo "      <td>" . $kp["nome_categoria"] . "</td>";
                                echo "      <td><a href='LayoutAdministrador.php?idkp=" . $kp["id_kit_produtos"] . "&link=formKitProdutos'><button type='button' class='btn btn-warning'><span  class='glyphicon glyphicon-pencil'></span></button</td>";
                                echo "      <td><a href='../Controller/ExcluirKitProdutos.php?idkp=" . $kp["id_kit_produtos"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="../../js/jquery-3.1.0.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/main.js"></script>
    </body>
</html>
