<!DOCTYPE html>
<!-- Página reservada para uso da pesquisa de salões -->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <a href="LayoutAdministrador.php?link=formSalao"><button type="button" class="btn btn-success btn-block">Novo Salão <span class="glyphicon glyphicon-plus"></span></button></a>
                </div>
                <form action="LayoutAdministrador.php?link=saloes" method="post" class="form-inline-static">
                    <div class="col-xs-12 col-sm-3">
                        <input type="text" name="pesquisa" class="form-control"/>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <select name="opcao" class="form-control">
                            <option selected>Selecione</option>
                            <option value="nome">Nome</option>
                            <option value="cep">CEP</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-default btn-block">Pesquisar <span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </form>
                
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dropdown open">
                        <button class="btn btn-default btn-block dropdown-toggle" type="button" id="clientes" data-toggle="dropdown">
                            Salões<span class="caret"></span>
                        </button>

                        <table class="table table-bordered table-responsive dropdown-menu" role="menu" aria-labeledby="clientes">
                            
                            <tr class="bg-info">
                                <td>Nome</td>
                                <td>Telefone</td>
                                <td>Status</td>
                                <td>Cep</td>
                                <td>Rua</td>
                                <td>Numero</td>
                                <td>Bairro</td>
                                <td>Cidade</td>
                                <td>Estado</td>
                                <td>Alterar</td>
                                <td>Excluir</td>
                            </tr>

                            <?php
                            //Conexão com a classe SalaoDAO
                            require_once '../Conexao/SalaoDAO.php';
                            //Conexão com a classe SalaoDTO
                            require_once '../Classes/SalaoDTO.php';
    
                            $SalaoDTO =new SalaoDTO();
                            if(isset($_POST['opcao'])){
                                $opcao = $_POST['opcao'];
                            } else {
                                $opcao = null;
                            }
                            
                            $SalaoDAO = new SalaoDAO();
                            
                            if($opcao=="nome"){
                            
                                $SalaoDTO->setNome($_POST['pesquisa']);
                                $saloes = $SalaoDAO->PesquisarSalaoByNome($SalaoDTO);
                            }else if($opcao=="cep"){
                            
                                $SalaoDTO->setCep($_POST['pesquisa']);
                                $saloes = $SalaoDAO->PesquisarSalaoByCep($SalaoDTO);
                                
                            }  else {
                                $saloes = $SalaoDAO->PesquisarTodos();
                            }
                                
                            
                            
                            
                            foreach ($saloes as $salao) {
                                echo "<tr>";
                                echo "<td>" . $salao["nome_salao"] . "</td>";
                                echo "<td>" . $salao["telefone_salao"] . "</td>";
                                echo "<td>" . $salao["status_salao"] . "</td>";
                                echo "<td>" . $salao["cep"] . "</td>";
                                echo "<td>" . $salao["rua"] . "</td>";
                                echo "<td>" . $salao["numero"] . "</td>";
                                echo "<td>" . $salao["bairro"] . "</td>";
                                echo "<td>" . $salao["cidade"] . "</td>";
                                echo "<td>" . $salao["estado"] . "</td>";
                                echo "<td><a href='LayoutAdministrador.php?idsalao=" . $salao["id_salao"] . "&link=formSalao'><button class='btn btn-warning'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
                                echo "<td><a href='../Controller/ExcluirCliente.php?idsalao=" . $salao["id_salao"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
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
