<!DOCTYPE html>
<!-- Página reservada para uso da pesquisa de aluguéis de salão -->
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
                <form class="form-inline-static" action="" method="post">
                    <div class="col-xs-12 col-sm-3">
                        <input type="text" name="nome" class="form-control" placeholder="Nome do cliente">
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <button class="btn btn-default btn-block" type="submit">
                            Pesquisar <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </form>
                <form class="form-inline-static" action="" method="post">
                    <div class="col-xs-12 col-sm-3">
                        <input type="date" name="data" class="form-control">
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <select class="form-control" name="opcao" onchange="this.form.submit()">
                            <option value="" selected>Selecione</option>
                            <option value="reserva">Reserva</option>
                            <option value="devolução">Devolução</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a href="LayoutAdministrador.php?link=formaluguelsalao">
                        <button type="button" class="btn btn-success btn-block">
                            Alugar Salão <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <?php
                    //Conexão com a classe AluguelSalaoDAO
                    require_once '../Conexao/AluguelSalaoDAO.php';
                    //Conexão com a classe AluguelSalaoDTO
                    require_once '../Classes/AluguelSalaoDTO.php';
                        
                    //Intanciando novo objeto da classe AluguelSalaoDAO
                    $AluguelSalaoDAO = new AluguelSalaoDAO();
                    //Instanciando novo objeto da classe AluguelSalaoDTO
                    $AluguelSalaoDTO = new AluguelSalaoDTO();
                    
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataAtual = date('Y-m-d');
                    
                    
                    ?>
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td>Total pendente:</td>
                            <td>
                                <?php
                                $pendentes = $AluguelSalaoDAO->PesquisarAlugueisSalaoPendentes();
                                echo $pendentes;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Devoluções para hoje:</td>
                            <td>
                                <?php
                                $AluguelSalaoDTO->setDataentrega($dataAtual);
                                $devolucoesparahoje = $AluguelSalaoDAO->PesquisarDevolucoesSalaoParaHoje($AluguelSalaoDTO);
                                echo $devolucoesparahoje;
                                ?>
                            </td>
                        </tr>
                        <tr class="bg">
                            <td>Alugueis para hoje:</td>
                            <td>
                                <?php
                                $AluguelSalaoDTO->setDatareserva($dataAtual);
                                $alugueisparahoje = $AluguelSalaoDAO->PesquisarAlugueisSalaoParaHoje($AluguelSalaoDTO);
                                echo $alugueisparahoje;
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-12">
                    <div class="dropdown open">
                        <button class="btn btn-default btn-block dropdown-toggle" type="button" id="alugueis" data-toggle="dropdown">
                            Alugueis<span class="caret"></span>
                        </button>
                        
                    <table class="table table-bordered table-responsive dropdown-menu" role="menu" aria-labeledby="alugueis">
                        <tr class="bg-info">
                            <td>Nome</td>
                            <td>CPF/CNPJ</td>
                            <td>E-mail</td>
                            <td>Telefone</td>
                            <td>Salão</td>
                            <td>Data da reserva</td>
                            <td>Data de devolução</td>
                            <td>Status</td>
                            <td>Atendente</td>
                            <td>Alterar</td>
                            <td>Excluir</td>
                        </tr>
                        <?php
                            //Array que recebe todos os dados retornados pelo metodo
                            if(!empty($_POST['nome'])){
                                $AluguelSalaoDTO->setCliente($_POST['nome']);
                                $alugueis = $AluguelSalaoDAO->PesquisarAluguelByCliente($AluguelSalaoDTO);
                            }else if(!empty ($_POST['opcao'])&&!empty ($_POST['data'])){
                                switch ($_POST['opcao']){
                                    case "reserva":
                                        $AluguelSalaoDTO->setDatareserva($_POST['data']);
                                        $alugueis = $AluguelSalaoDAO->PesquisarDataReserva($AluguelSalaoDTO);
                                        break;
                                    case "devolução":
                                        $AluguelSalaoDTO->setDataentrega($_POST['data']);
                                        $alugueis = $AluguelSalaoDAO->PesquisarDevolucaoSalao($AluguelSalaoDTO);
                                        break;
                                }
                                
                            }  else {
                                $alugueis = $AluguelSalaoDAO->PesquisarTodos();
                            }
                            date_default_timezone_set('America/Sao_Paulo');
                            $dataAtual = date('Y-m-d');
                            $dataAtualFM = new DateTime($dataAtual);
                            foreach ($alugueis as $aluguel) {
                                $datasaidaFM = new DateTime($aluguel["data_entrega"]);
                                $calculo = $AluguelSalaoDAO->CalcularDatasSalao($aluguel["data_entrega"], $dataAtual);
                                
                                if($dataAtual==$aluguel["data_entrega"] && $aluguel["status"]!="Fechado"){
                                    echo "<tr class='bg-success'>" ;
                                    $AluguelSalaoDTO->setSalao($aluguel["salao"]);
                                    $AluguelSalaoDTO->setDatareserva($aluguel["data_reserva"]);
                                    $AluguelSalaoDTO->setStatus("Pendente");
                                    $AluguelSalaoDAO->AlterarStatusSalao($AluguelSalaoDTO);
                                }  
                                else if($calculo=="maior" && ($aluguel["status"]!="Fechado")){
                                    echo "<tr class='bg-warning'>";
                                    $AluguelSalaoDTO->setSalao($aluguel["salao"]);
                                    $AluguelSalaoDTO->setDatareserva($aluguel["data_reserva"]);
                                    $AluguelSalaoDTO->setStatus("Pendente");
                                    $AluguelSalaoDAO->AlterarStatusSalao($AluguelSalaoDTO);
                                }else if ($calculo=="menor" && ($aluguel["status"]!="Fechado")){
                                    echo "<tr class='bg-danger'>";
                                    $AluguelSalaoDTO->setSalao($aluguel["salao"]);
                                    $AluguelSalaoDTO->setDatareserva($aluguel["data_reserva"]);
                                    $AluguelSalaoDTO->setStatus("Sob-Aviso");
                                    $AluguelSalaoDAO->AlterarStatusSalao($AluguelSalaoDTO);
                                }  else {
                                    echo "<tr>";
                                }
                                echo "      <td>" . $aluguel["nome_cliente"] . "</td>";
                                echo "      <td>" . $aluguel["identificador_cliente"] . "</td>";
                                echo "      <td>" . $aluguel["email_cliente"] . "</td>";
                                echo "      <td>" . $aluguel["telefone_cliente"] . "</td>";
                                echo "      <td>" . $aluguel["nome_salao"] . "</td>";
                                $dataentrada = explode('-', $aluguel["data_reserva"]);
                                $datasaida = explode('-', $aluguel["data_entrega"]);
                                echo "      <td>" . $dataentrada[2]. "/" . $dataentrada[1]. "/" . $dataentrada[0] . "</td>"; 
                                echo "      <td>" . $datasaida[2]. "/" . $datasaida[1]. "/" . $datasaida[0] . "</td>"; 
                                echo "      <td>" . $aluguel["status"] . "</td>";
                                echo "      <td>" . $aluguel["usuario"] . "</td>";
                                echo "      <td><a href='LayoutAdministrador.php?link=formaluguelsalao&salao=" . $aluguel["salao"] . "&datareserva=" . $aluguel["data_reserva"] . "'><button type='button' class='btn btn-warning'><span  class='glyphicon glyphicon-pencil'></span></button</td>";
                                echo "      <td><a href='../Controller/ExcluirAluguelSalao.php?salao=" . $aluguel["salao"] . "&datareserva=" . $aluguel["data_reserva"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>";
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
