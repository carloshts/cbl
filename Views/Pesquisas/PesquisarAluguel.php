<!DOCTYPE html>
<!-- Página de pesquisa de Aluguéis -->
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
                            <option value="aluguel">Aluguel</option>
                            <option value="devolução">Devolução</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a href="LayoutAdministrador.php?link=formAluguel">
                        <button type="button" class="btn btn-success btn-block">
                            Alugar Produtos <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <?php
                    //Conexão com a classe AluguelDAO
                    require_once '../Conexao/AluguelDAO.php';
                    //Conexão com a classe AluguelDTO
                    require_once '../Classes/AluguelDTO.php';
                        
                    //Intanciando novo objeto da classe AluguelDAO
                    $AluguelDAO = new AluguelDAO();
                    //Instanciando novo objeto da classe AluguelDTO
                    $AluguelDTO = new AluguelDTO();
                    
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataAtual = date('Y-m-d');
                    
                    
                    ?>
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td>Total pendente:</td>
                            <td>
                                <?php
                                $pendentes = $AluguelDAO->PesquisarAlugueisPendentes();
                                echo $pendentes;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Devoluções para hoje:</td>
                            <td>
                                <?php
                                $AluguelDTO->setDatasaida($dataAtual);
                                $devolucoesparahoje = $AluguelDAO->PesquisarDevolucoesParaHoje($AluguelDTO);
                                echo $devolucoesparahoje;
                                ?>
                            </td>
                        </tr>
                        <tr class="bg">
                            <td>Alugueis para hoje:</td>
                            <td>
                                <?php
                                $AluguelDTO->setDataentrada($dataAtual);
                                $alugueisparahoje = $AluguelDAO->PesquisarAlugueisParaHoje($AluguelDTO);
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
                        <?php 
                        require_once '../Conexao/AluguelProdutosKitProdutosDAO.php';
                        require_once '../Classes/AluguelProdutosKitProdutosDTO.php';
                        
                        $APKDTO = new AluguelProdutosKitProdutosDTO();
                        $APKDAO = new AluguelProdutosKitProdutosDAO();
                        
                        if(isset($_GET['idaluguel'])){
                            
                            $AluguelDTO->setIdaluguel($_GET['idaluguel']);
                            $AluguelSelecionado = new AluguelDAO();
                            $aluguelSelecionado = $AluguelSelecionado->PesquisarAluguelByID($AluguelDTO);
                            
                            if($aluguelSelecionado["status"]=="Orçamento"){
                            ?>
                        <tr>
                            <td colspan="7"><a href="LayoutAdministrador.php?link=alugueis&idaluguel=<?php echo $_GET['idaluguel'];?>&fechar=true"><button onclick="return confirmarcadastro()" class="btn btn-success">Contratar aluguel</button></a></td>
                        </tr>
                        <tr>
                            <td colspan="7"><a href="LayoutAdministrador.php?link=novoItem&idaluguel=<?php echo $_GET['idaluguel'];?>"><button class="btn btn-success">Novo item <span class="glyphicon glyphicon-plus"></span></button></a></td>
                        </tr>
                            <?php } else {?>
                        <tr>
                            <td colspan="7"><a target="_blank" href="Pesquisas/ReciboAluguel.php?idaluguel=<?php echo $_GET['idaluguel'];?>"><button class="btn btn-success">Imprimir Recibo <span class="glyphicon glyphicon-print"></span></button></a></td>
                        </tr>
                        <tr>
                            <td colspan="7"><a target="_blank" href="Pesquisas/ContratoAluguel.php?idaluguel=<?php echo $_GET['idaluguel'];?>"><button class="btn btn-success">Imprimir Contrato <span class="glyphicon glyphicon-print"></span></button></a></td>
                        </tr>
                            <?php } ?>
                        <tr>
                            <td>Cliente</td>
                            <td>Item</td>
                            <td>Quantidade</td>
                            <td>Descrição</td>
                            <td>Preço</td>  
                            <?php if($aluguelSelecionado["status"]=="Orçamento"){ ?>
                            <td>Excluir</td>
                            <?php } ?>
                        </tr>
                        <?php
                        
                            $aluguel = $_GET['idaluguel']; 
                            $APKDTO->setAluguel($aluguel);
                            $apks = $APKDAO->PesquisarAPKByID($aluguel);
                            if(isset($_GET['fechar'])){
                                $AluguelDTO->setStatus("Contratado");
                                $AluguelDTO->setIdaluguel($_GET['idaluguel']);
                                $AluguelDAO->AlterarStatus($AluguelDTO);
                            }
                            foreach ($apks as $apk){
                                echo "<tr>";
                                echo "      <td>" . $apk["nome_cliente"] . "</td>";
                                if ($apk["nome_kit_produtos"]!="Nulo" &&($apk["nome_produto"]=="Nulo")){
                                    echo "      <td>" . $apk["nome_kit_produtos"] . "</td>";
                                    echo "      <td>" . $apk["quantidade_item"] . "</td>";
                                    echo "      <td>" . $apk["descricao_kit_produtos"] . "</td>";
                                    $precokit = $apk["preco_kit_produtos"] * $apk["quantidade_item"];
                                    echo "      <td>" . $precokit . "</td>";
                                    if($aluguelSelecionado["status"]!="Fechado"&&$aluguelSelecionado["status"]!="Contratado"){
                                    echo "      <td><a href='../Controller/ExcluirItem.php?aluguel=" . $apk["aluguel"] 
                                            . "&produto=" . $apk["id_produto"]
                                            . "&kit=" . $apk["id_kit_produtos"]
                                            ."' onclick='return confirmarexclusao()'>"
                                            . "<button type='button' class='btn btn-danger'>"
                                            . "<span class='glyphicon glyphicon-trash'></span>"
                                            . "</button>"
                                            . "</td>";
                                    }
                                }  else if($apk["nome_kit_produtos"]=="Nulo" &&($apk["nome_produto"]!="Nulo")){
                                    echo "      <td>" . $apk["nome_produto"] . "</td>";
                                    echo "      <td>" . $apk["quantidade_item"] . "</td>";
                                    echo "      <td>" . $apk["descricao_produto"] . "</td>";
                                    $precoproduto = $apk["preco_produto"] * $apk["quantidade_item"];
                                    echo "      <td>" . $precoproduto . "</td>";
                                    if($aluguelSelecionado["status"]=="Orçamento"){
                                    echo "      <td><a href='../Controller/ExcluirItem.php?aluguel=" . $apk["aluguel"] 
                                            . "&produto=" . $apk["id_produto"]
                                            . "&kit=" . $apk["id_kit_produtos"]
                                            ."' onclick='return confirmarexclusao()'>"
                                            . "<button type='button' class='btn btn-danger'>"
                                            . "<span class='glyphicon glyphicon-trash'></span>"
                                            . "</button>"
                                            . "</td>";
                                    }
                                }
                                
                                echo "</tr>";
                            }?>
                        <tr>
                                <td colspan="7"><a href="LayoutAdministrador.php?link=alugueis"><button class="btn btn-info">Voltar <span class="glyphicon glyphicon-backward"></span></button></a></td>
                        </tr>
                        <?php
                        }                    
                        
                          else {
                            ?>
                        
                        <tr class="bg-info">
                            <td>Nome</td>
                            <td>CPF/CNPJ</td>
                            <td>E-mail</td>
                            <td>Telefone</td>
                            <td>Data do aluguel</td>
                            <td>Data de devolução</td>
                            <td>Status</td>
                            <td>Atendente</td>
                            <td class="bg-primary"></td>
                            <td>Alterar</td>
                            <td>Excluir</td>
                            
                        </tr>
                        <?php
                        

                            
                            
                            //Array que recebe todos os dados retornados pelo metodo
                            if(!empty($_POST['nome'])){
                                $AluguelDTO->setCliente($_POST['nome']);
                                $alugueis = $AluguelDAO->PesquisarAluguelByCliente($AluguelDTO);
                            }else if(!empty ($_POST['opcao'])&&!empty ($_POST['data'])){
                                switch ($_POST['opcao']){
                                    case "aluguel":
                                        $AluguelDTO->setDataentrada($_POST['data']);
                                        $alugueis = $AluguelDAO->PesquisarDataEntrada($AluguelDTO);
                                        break;
                                    case "devolução":
                                        $AluguelDTO->setDatasaida($_POST['data']);
                                        $alugueis = $AluguelDAO->PesquisarDevolucao($AluguelDTO);
                                        break;
                                }
                                
                            }  else {
                                $alugueis = $AluguelDAO->PesquisarTodos();
                            }
                            
                            date_default_timezone_set('America/Sao_Paulo');
                            $dataAtual = date('Y-m-d');
                            $dataAtualFM = new DateTime($dataAtual);
                            foreach ($alugueis as $aluguel) {
                                $datasaidaFM = new DateTime($aluguel["data_saida"]);
                                $calculo = $AluguelDAO->CalcularDatas($aluguel["data_saida"], $dataAtual);
                                
                                if($dataAtual==$aluguel["data_saida"] && ($aluguel["status"]!="Fechado"&&$aluguel["status"]!="Orçamento")){
                                    echo "<tr class='bg-success'>" ;                                    
                                }  
                                else if($calculo=="maior" && ($aluguel["status"]!="Fechado"&&$aluguel["status"]!="Orçamento")){
                                    echo "<tr class='bg-warning'>";
                                    $AluguelDTO->setIdaluguel($aluguel["id_aluguel"]);
                                    $AluguelDTO->setStatus("Pendente");
                                    $AluguelDAO->AlterarStatus($AluguelDTO);
                                }else if ($calculo=="menor" && ($aluguel["status"]!="Fechado"&&$aluguel["status"]!="Orçamento")){
                                    echo "<tr class='bg-danger'>";
                                    $AluguelDTO->setIdaluguel($aluguel["id_aluguel"]);
                                    $AluguelDTO->setStatus("Sob-Aviso");
                                    $AluguelDAO->AlterarStatus($AluguelDTO);
                                }  else {
                                    echo "<tr>";
                                }
                                echo "      <td>" . $aluguel["nome_cliente"] . "</td>";
                                echo "      <td>" . $aluguel["identificador_cliente"] . "</td>";
                                echo "      <td>" . $aluguel["email_cliente"] . "</td>";
                                echo "      <td>" . $aluguel["telefone_cliente"] . "</td>";
                                $dataentrada = explode('-', $aluguel["data_entrada"]);
                                $datasaida = explode('-', $aluguel["data_saida"]);
                                echo "      <td>" . $dataentrada[2]. "/" . $dataentrada[1]. "/" . $dataentrada[0] . "</td>"; 
                                echo "      <td>" . $datasaida[2]. "/" . $datasaida[1]. "/" . $datasaida[0] . "</td>"; 
                                echo "      <td>" . $aluguel["status"] . "</td>";
                                echo "      <td>" . $aluguel["usuario"] . "</td>";
                                echo "      <td><a href='LayoutAdministrador.php?link=alugueis&idaluguel=".$aluguel["id_aluguel"]."'><span class='glyphicon glyphicon-plus'></span></a>";
                                echo "      <td><a href='LayoutAdministrador.php?link=formAluguel&idaluguel=" . $aluguel["id_aluguel"] . "'><button type='button' class='btn btn-warning'><span  class='glyphicon glyphicon-pencil'></span></button</td>";
                                echo "      <td><a href='../Controller/ExcluirAluguel.php?idaluguel=" . $aluguel["id_aluguel"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>";
                                echo "</tr>";
                            }   
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
