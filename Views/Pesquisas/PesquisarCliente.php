<!DOCTYPE html>
<!-- Página de pesquisa de clientes -->
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
                <form action="LayoutAdministrador.php?link=clientes" method="post" class="form-inline-static">
                    <div class="col-xs-12 col-sm-3">
                        <input type="text" name="pesquisa" class="form-control"/>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <select name="opcao" class="form-control">
                            <option selected>Selecione</option>
                            <option value="nome">Nome</option>
                            <option value="identificador">CPF/CNPJ</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <button type="submit" class="btn btn-default btn-block">Pesquisar <span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </form>
                <div class="col-xs-12 col-sm-3">
                    <a href="LayoutAdministrador.php?link=formcliente"><button type="button" class="btn btn-success btn-block">Novo Cliente <span class="glyphicon glyphicon-plus"></span></button></a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dropdown open">
                        <button class="btn btn-default btn-block dropdown-toggle" type="button" id="clientes" data-toggle="dropdown">
                            Clientes<span class="caret"></span>
                        </button>

                        <table class="table table-bordered table-responsive dropdown-menu" role="menu" aria-labeledby="clientes">
                            <tr class="bg-primary">
                                <td>Nome</td>
                                <td>Tipo</td>
                                <td>CPF/CNPJ</td>
                                <td>Endereço</td>
                                <td>Telefone</td>
                                <td>E-mail</td>
                                <td>Alterar</td>
                                <td>Excluir</td>
                            </tr>

                            <?php
                            require_once '../Conexao/ClienteDAO.php';
                            require_once '../Classes/ClienteDTO.php';
                            
                            $ClienteDTO =new ClienteDTO();
                            if(isset($_POST['opcao'])){
                                $opcao = $_POST['opcao'];
                            } else {
                                $opcao = null;
                            }
                            
                            $ClienteDAO = new ClienteDAO();
                            
                            if($opcao=="nome"){
                            
                                $ClienteDTO->setNome($_POST['pesquisa']);
                                $clientes = $ClienteDAO->PesquisarClienteByNome($ClienteDTO);
                            }else if($opcao=="identificador"){
                            
                                $ClienteDTO->setIdentificador($_POST['pesquisa']);
                                $clientes = $ClienteDAO->PesquisarClienteByIdentificador($ClienteDTO);
                                
                            }  else {
                                $clientes = $ClienteDAO->PesquisarTodos();
                            }
                                
                            
                            
                            
                            foreach ($clientes as $cliente) {
                                echo "<tr>";
                                echo "<td>" . $cliente["nome_cliente"] . "</td>";
                                echo "<td>" . $cliente["tipo_cliente"] . "</td>";
                                echo "<td>" . $cliente["identificador_cliente"] . "</td>";
                                echo "<td>" . $cliente["endereco_cliente"] . "</td>";
                                echo "<td>" . $cliente["telefone_cliente"] . "</td>";
                                echo "<td>" . $cliente["email_cliente"] . "</td>";
                                echo "<td><a href='LayoutAdministrador.php?idcliente=" . $cliente["id_cliente"] . "&link=formcliente'><button class='btn btn-warning'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
                                echo "<td><a href='../Controller/ExcluirCliente.php?idcliente=" . $cliente["id_cliente"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
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
