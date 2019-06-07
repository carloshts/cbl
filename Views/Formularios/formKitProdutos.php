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
            <form class="form-control-static" action="<?php if(isset($_GET['idkp'])){echo "../Controller/AlterarKitProdutos.php";} else {echo "../Controller/InserirKitProdutos.php";} ?>" method="post">
                <?php
                
                //Conexão com a classe CategoriaDAO
                require_once '../Conexao/CategoriaDAO.php';
                //Conexão com a classe KitProdutosDAO
                require_once '../Conexao/KitProdutosDAO.php';
                //Conexão com a classe KitProdutosDTO
                require_once '../Classes/KitProdutosDTO.php';
                

                //Novo objeto da classe KitProdutosDTO
                $KitProdutosDTO = new KitProdutosDTO();
                //Novo objeto da classe KitProdutosDAO
                $KitProdutosDAO = new KitProdutosDAO();
                //Novo objeto da classe CategoriaDAO
                $CategoriaDAO = new CategoriaDAO();
                if(isset($_GET['idkp'])){
                $KitProdutosDTO->setIdkitprodutos($_GET['idkp']);
                $kp = $KitProdutosDAO->PesquisarKitProdutosByID($KitProdutosDTO);
                }
                ?>
                <tr>
                    <td><label class="pull-right">Nome:</label></td>
                    <td><input type="hidden" name="idkp" value="<?php if(isset($_GET['idkp'])){echo $_GET['idkp'];}?>">
                        <input class="form-control" type="text" value="<?php if (isset($_GET['idkp'])) { echo $kp["nome_kit_produtos"];}?>"name="nome"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Preço de compra:</label></td>
                    <td><input type="text" class="form-control" value="<?php if (isset($_GET['idkp'])) { echo $kp["preco_compra_kp"];}?>" name="precoCompra"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Preço de venda:</label></td>
                    <td><input type="text" class="form-control" value="<?php if (isset($_GET['idkp'])) { echo $kp["preco_kit_produtos"];}?>" name="preco"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Disponibilidade:</label></td>
                    <td><?php if (isset($_GET['idkp'])) {?>
                        <select name="disponibilidade" class="form-control">
                            <option selected value="<?php echo $kp["disponibilidade_kit_produtos"];?>"><?php echo $kp["disponibilidade_kit_produtos"];?></option>
                            <option class="bg-success" value="Disponivel">Disponível</option>
                            <option class="bg-danger" value="Indisponível">Indisponível</option>
                            <option class="bg-warning" value="Alugado">Alugado</option>
                        </select>
                        <?php }else{ echo"<input type='hidden' name='disponibilidade' value='Disponível'>Disponível";}?>
                    </td>
                </tr>
                <tr>
                    <td><label class="pull-right">Descrição:</label></td>
                    <td><input class="form-control" value="<?php if (isset($_GET['idkp'])) { echo $kp["descricao_kit_produtos"];}?>" type="textarea" name="descricao"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Quantidade:</label></td>
                    <td><input class="form-control" value="<?php if (isset($_GET['idkp'])) { echo $kp["quantidade_kit_produtos"];}?>" type="number" name="quantidade"></td>
                </tr>
                <tr>
                    <td><label class="pull-right">Categoria:</label></td>
                    <td>
                        <select class="form-control" name="categoria">
                            <?php
                            if (isset($_GET['idkp'])) {
                                $categorias = $CategoriaDAO->PesquisarTodos();

                                foreach ($categorias as $categoria) {

                                    $idkitprodutos = $_GET['idkp'];
                                    $KitProdutosDTO->setIdkitprodutos($idkitprodutos);
                                    $kp = $KitProdutosDAO->PesquisarKitProdutosByID($KitProdutosDTO);
                                    if ($kp["categoria_kit_produtos"] == $categoria["id_categoria"]) {
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
                    <td colspan="2"><a href="LayoutAdministrador.php?link=produtos"><button type="button" class="btn btn-primary">Voltar <span class="glyphicon glyphicon-backward"></span></button></a><input type="submit" class="btn btn-default" value="<?php if (isset($_GET['idkp'])) {
    echo "Alterar";
} else {
    echo "Cadastrar";
    } ?>" <?php if (isset($_GET['idkp'])) {
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
