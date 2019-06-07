<!DOCTYPE html>
<!-- Página de pesquisa de Vendas -->
<!-- Terminar essa página e o DAO de VendaProduto -->
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
                    <div class="col-xs-12 col-sm-4">
                        <input type="text" name="nome" class="form-control" placeholder="Nome do cliente">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <button class="btn btn-default btn-block" type="submit">
                            Pesquisar <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </form>
                <div class="col-xs-12 col-sm-4">
                    <a href="LayoutAdministrador.php?link=formVenda">
                        <button type="button" class="btn btn-success btn-block">
                            Iniciar compra <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="row">
                
                
                    <?php
                    //Conexão com a classe VendaDAO
                    require_once '../Conexao/VendaDAO.php';
                    //Conexão com a classe VendaDTO
                    require_once '../Classes/VendaDTO.php';
                        
                    //Intanciando novo objeto da classe VendaDAO
                    $VendaDAO = new VendaDAO();
                    //Instanciando novo objeto da classe VendaDTO
                    $VendaDTO = new VendaDTO();
                    
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataAtual = date('Y-m-d');
                    
                    
                    ?>
                    
                <div class="col-xs-12">
                    <div class="dropdown open">
                        <button class="btn btn-default btn-block dropdown-toggle" type="button" id="vendas" data-toggle="dropdown">
                            Vendas<span class="caret"></span>
                        </button>
                        
                    <table class="table table-bordered table-responsive dropdown-menu" role="menu" aria-labeledby="vendas">
                        <?php 
                        require_once '../Conexao/VendaProdutoDAO.php';
                        require_once '../Classes/VendaProdutoDTO.php';
                        
                        $VendaProdutoDTO = new VendaProdutoDTO();
                        $VendaProdutoDAO = new VendaProdutoDAO();
                        
                        if(isset($_GET['idvenda'])){
                            
                            $VendaDTO->setIdvenda($_GET['idvenda']);
                            $VendaSelecionada = new VendaDAO();
                            $VendaSelecionada = $VendaSelecionada->PesquisarVendaByID($VendaDTO);
                            
                            if($VendaSelecionada["status"]!="Fechada"){
                            ?>
                        <tr>
                            <td colspan="7"><a href="LayoutAdministrador.php?link=vendas&idvenda=<?php echo $_GET['idvenda'];?>&fechar=true"><button onclick="return confirmarcadastro()" class="btn btn-success">Finalizar compra</button></a></td>
                        </tr>
                        <tr>
                            <td colspan="7"><a href="LayoutAdministrador.php?link=novoItemVenda&idvenda=<?php echo $_GET['idvenda'];?>"><button class="btn btn-success">Novo item <span class="glyphicon glyphicon-plus"></span></button></a></td>
                        </tr>
                            <?php } else {?>
                        <tr>
                            <td colspan="7"><a target="_blank" href="Pesquisas/ReciboVenda.php?idvenda=<?php echo $_GET['idvenda'];?>"><button class="btn btn-success">Imprimir Recibo <span class="glyphicon glyphicon-print"></span></button></a></td>
                        </tr>
                            <?php } ?>
                        <tr>
                            <td>Cliente</td>
                            <td>Item</td>
                            <td>Quantidade</td>
                            <td>Descrição</td>
                            <td>Preço</td>  
                            <?php if($VendaSelecionada["status"]!="Fechada"){ ?>
                            <td>Excluir</td>
                            <?php } ?>
                        </tr>
                        <?php
                            if(isset($_GET['fechar'])){
                                $VendaDTO->setIdvenda($_GET['idvenda']);
                                $VendaDAO->AlterarStatusVenda($VendaDTO);
                            }
                            $venda = $_GET['idvenda']; 
                            $VendaProdutoDTO->setVenda($venda);
                            $vps = $VendaProdutoDAO->PesquisarVendaProdutoById($VendaProdutoDTO);
                            foreach ($vps as $vp){
                                echo "<tr>";
                                echo "      <td>" . $vp["nome_cliente"] . "</td>";
                                
                                    echo "      <td>" . $vp["nome_produto"] . "</td>";
                                    echo "      <td>" . $vp["quantidade_item"] . "</td>";
                                    echo "      <td>" . $vp["descricao_produto"] . "</td>";
                                    $precoproduto = $vp["preco_produto"] * $vp["quantidade_item"];
                                    echo "      <td>" . $precoproduto . "</td>";
                                    if($VendaSelecionada["status"]!="Fechada"){
                                    echo "      <td><a href='../Controller/ExcluirItemVenda.php?venda=" . $vp["venda"] 
                                            . "&produto=" . $vp["id_produto"]
                                            
                                            ."' onclick='return confirmarexclusao()'>"
                                            . "<button type='button' class='btn btn-danger'>"
                                            . "<span class='glyphicon glyphicon-trash'></span>"
                                            . "</button>"
                                            . "</td>";
                                    }
                                    echo "</tr>";
                                }
                        
                                
                            ?>
                        <tr>
                                <td colspan="7"><a href="LayoutAdministrador.php?link=vendas"><button class="btn btn-info">Voltar <span class="glyphicon glyphicon-backward"></span></button></a></td>
                        </tr>
                        <?php
                        } else {
                            ?>
                        
                        <tr class="bg-info">
                            <td>Nome</td>
                            <td>CPF/CNPJ</td>
                            <td>E-mail</td>
                            <td>Telefone</td>
                            <td>Data</td>
                            <td>Status</td>
                            <td>Atendente</td>
                            <td class="bg-primary"></td>
                            <td>Alterar</td>
                            <td>Excluir</td>
                            
                        </tr>
                        <?php
                        

                            
                            
                            //Array que recebe todos os dados retornados pelo metodo
                            if(!empty($_POST['nome'])){
                                $VendaDTO->setCliente($_POST['nome']);
                                $vendas = $VendaDAO->PesquisarVendaByCliente($VendaDTO);
                            }else {
                                $vendas = $VendaDAO->PesquisarTodos();
                            }
                            date_default_timezone_set('America/Sao_Paulo');
                            $dataAtual = date('Y-m-d');
                            $dataAtualFM = new DateTime($dataAtual);
                            foreach ($vendas as $venda) {
                                
                                
                                echo "<tr>";                                
                                echo "      <td>" . $venda["nome_cliente"] . "</td>";
                                echo "      <td>" . $venda["identificador_cliente"] . "</td>";
                                echo "      <td>" . $venda["email_cliente"] . "</td>";
                                echo "      <td>" . $venda["telefone_cliente"] . "</td>";
                                $data = explode('-', $venda["data_venda"]);
                                echo "      <td>" . $data[2]. "/" . $data[1]. "/" . $data[0] . "</td>"; 
                                echo "      <td>" . $venda["status"] . "</td>";
                                echo "      <td>" . $venda["usuario"] . "</td>";
                                echo "      <td><a href='LayoutAdministrador.php?link=vendas&idvenda=".$venda["id_venda"]."'><span class='glyphicon glyphicon-plus'></span></a>";
                                echo "      <td><a href='LayoutAdministrador.php?link=formVenda&idvenda=" . $venda["id_venda"] . "'><button type='button' class='btn btn-warning'><span  class='glyphicon glyphicon-pencil'></span></button</td>";
                                echo "      <td><a href='../Controller/ExcluirVenda.php?idvenda=" . $venda["id_venda"] . "' onclick='return confirmarexclusao()'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>";
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
