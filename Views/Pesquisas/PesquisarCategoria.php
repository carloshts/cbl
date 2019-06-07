<!DOCTYPE html>
<!-- Página para vizualização das categorias cadastradas-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <?php
        //Conexão com a classe CategoriaDTO
        require_once '../Classes/CategoriaDTO.php';
        //Conexão com a classe CategoriaDAO
        require_once '../Conexao/CategoriaDAO.php';
        
        //Novo objeto da classe CategoriaDTO
        $CategoriaDTO = new CategoriaDTO();
        //Novo objeto da classe CategoriaDAO
        $CategoriaDAO = new CategoriaDAO();
        ?>
        <div class="container">
            <div class="row">
                        <?php
                        if(isset($_GET['idcategoria'])){
                        $idcategoria = $_GET['idcategoria'];
                        $CategoriaDTO->setIdcategoria($idcategoria);
                        $categoriaAlt = $CategoriaDAO->PesquisarCategoriaByID($CategoriaDTO);
                        } else {
                            $idcategoria = null;
                        }
                        ?>
                <form class="form-inline-static" action="<?php if($idcategoria!=null){echo "../Controller/AlterarCategoria.php";}else{echo "../Controller/InserirCategoria.php";} ?>" method="post">
                    <div class="col-xs-12 col-sm-3">
                        <input type="hidden" name="idcategoria" value="<?php if($idcategoria!=null)  {echo $categoriaAlt['id_categoria'];}?>">
                        <input type="text" name="categoria" class="form-control" <?php if($idcategoria!=null)  {echo "value='".$categoriaAlt['nome_categoria']."'";}?> placeholder="Nome da categoria">
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-success btn-block" <?php if($idcategoria!=null){
                        echo "onclick='return confirmaralteracao()'";} else {echo "onclick='return confirmarcadastro()'";} ?> > <?php if($idcategoria!=null)  {echo "Alterar Categoria";}else{
        echo "Inserir categoria <span class='glyphicon glyphicon-plus'></span>";}?></button>
                    </div>
                </form>
                <form class="form-inline-static" action="" method="post">
                    <div class="col-xs-12 col-sm-3">
                        <input type="text" name="categoria" class="form-control" placeholder="Nome da categoria">
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-default btn-block">Pesquisar <span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </form>

            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dropdown open">
                        <button class="btn btn-default btn-block dropdown-toggle" type="button" id="categorias" data-toggle="dropdown">
                            Categorias<span class="caret"></span>
                        </button>
                        <table class="table table-bordered table-responsive dropdown-menu h2" role="menu" aria-labeledby="categorias">
                            <tr class="bg-info">
                                <td>Categoria</td>
                                <td>Alterar</td>
                                <td>Excluir</td>
                            </tr>
                            <?php
                            
                            
                            if(empty($_POST['categoria'])){
                            //Array que recebe os valores da consulta retornados pelo metodo da classe CategoriaDAO
                            $categorias = $CategoriaDAO->PesquisarTodos();
                            }else{
                                $categoria = $_POST['categoria'];
                                $CategoriaDTO->setCategoria($categoria);
                                $categorias = $CategoriaDAO->PesquisarCategoriaByNome($CategoriaDTO);
                            }
                            foreach ($categorias as $categoria){
                                echo "<tr>";
                                echo "      <td>" . $categoria["nome_categoria"] . "</td>";
                                echo "      <td><a href='LayoutAdministrador.php?link=categorias&idcategoria=" . $categoria["id_categoria"] . "'><button type='button' class='btn btn-warning'><span  class='glyphicon glyphicon-pencil'></span></button></button></a></td>";
                                echo "      <td><a href='../Controller/ExcluirCategoria.php?idcategoria=" . $categoria["id_categoria"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>";
                                echo "</tr>";
                            }
                            ?>

                        </table>
                        <a href="LayoutAdministrador.php?link=produtos"><button type="button" class="btn btn-primary">Voltar <span class="glyphicon glyphicon-backward"></span></button></a>
                    </div>
                </div>
                
            </div>
        </div>

        <script src="../../js/jquery-3.1.0.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/main.js"></script>
    </body>
</html>
