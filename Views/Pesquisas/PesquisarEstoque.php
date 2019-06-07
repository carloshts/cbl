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
        //Conexão com a classe EstoqueDTO
        require_once '../Classes/EstoqueDTO.php';
        //Conexão com a classe EstoqueDAO
        require_once '../Conexao/EstoqueDAO.php';
        
        //Novo objeto da classe EstoqueDTO
        $EstoqueDTO = new EstoqueDTO();
        //Novo objeto da classe CategoriaDAO
        $EstoqueDAO = new EstoqueDAO();
        ?>
        <div class="container">
            <div class="row">
                        <?php
                        if(isset($_GET['idestoque'])){
                        $idestoque = $_GET['idestoque'];
                        $EstoqueDTO->setIdestoque($idestoque);
                        $estoqueAlt = $EstoqueDAO->PesquisarEstoqueByID($EstoqueDTO);
                        } else {
                            $idestoque = null;
                        }
                        ?>
                <form class="form-inline-static" action="<?php if($idestoque!=null){echo "../Controller/AlterarEstoque.php";}else{echo "../Controller/InserirEstoque.php";} ?>" method="post">
                    <div class="col-xs-12 col-sm-4">
                        <input type="hidden" name="idestoque" value="<?php if($idestoque!=null)  {echo $estoqueAlt['id_estoque'];}?>">
                        <input type="text" name="estoque" class="form-control" <?php if($idestoque!=null)  {echo "value='".$estoqueAlt['nome_estoque']."'";}?> placeholder="Nome do estoque">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <input type="number" class="form-control" name="capacidade" <?php if($idestoque!=null)  {echo "value='".$estoqueAlt['capacidade']."'";}?> placeholder="Capacidade">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <button type="submit" class="btn btn-success btn-block" <?php if($idestoque!=null){
                        echo "onclick='return confirmaralteracao()'";} else {echo "onclick='return confirmarcadastro()'";} ?> > <?php if($idestoque!=null)  {echo "Alterar Estoque";}else{
        echo "Inserir Estoque <span class='glyphicon glyphicon-plus'></span>";}?></button>
                    </div>
                </form>
                <form class="form-inline-static" action="" method="post">
                    <div class="col-xs-12 col-sm-6">
                        <input type="number" name="capacidade" class="form-control" placeholder="Capacidade">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <button type="submit" class="btn btn-default btn-block">Pesquisar <span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </form>

            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dropdown open">
                        <button class="btn btn-default btn-block dropdown-toggle" type="button" id="estoques" data-toggle="dropdown">
                            Estoques<span class="caret"></span>
                        </button>
                        <table class="table table-bordered table-responsive dropdown-menu h2" role="menu" aria-labeledby="estoques">
                            <tr class="bg-info">
                                <td>Nome do estoque</td>
                                <td>Capacidade</td>
                                <td>Alterar</td>
                                <td>Excluir</td>
                            </tr>
                            <?php
                            
                            
                            if(empty($_POST['capacidade'])){
                            //Array que recebe os valores da consulta retornados pelo metodo da classe EstoqueDAO
                            $estoques = $EstoqueDAO->PesquisarTodos();
                            }else{
                                $capacidade = $_POST['capacidade'];
                                $EstoqueDTO->setCapacidade($capacidade);
                                $estoques = $EstoqueDAO->PesquisarEstoqueByCapacidade($EstoqueDTO);
                            }
                            foreach ($estoques as $estoque){
                                echo "<tr>";
                                echo "      <td>" . $estoque["nome_estoque"] . "</td>";
                                echo "      <td>" . $estoque["capacidade"] . "</td>";
                                echo "      <td><a href='LayoutAdministrador.php?link=estoques&idestoque=" . $estoque["id_estoque"] . "'><button type='button' class='btn btn-warning'><span  class='glyphicon glyphicon-pencil'></span></button></button></a></td>";
                                echo "      <td><a href='../Controller/ExcluirEstoque.php?idestoque=" . $estoque["id_estoque"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>";
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
