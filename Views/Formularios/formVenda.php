<!DOCTYPE html>
<!-- Página reservada para o formulário da Venda -->
<html>
    <head>
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <title>Formulário de cadastro de venda</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    //Conexão com a classe VendaDTO
                    require_once '../Classes/VendaDTO.php';
                    //Conexão com a classe VendaDAO
                    require_once '../Conexao/VendaDAO.php';
                    //Conexão com a classe ClienteDAO
                    require_once '../Conexao/ClienteDAO.php';

                    //Novo objeto da classe VendaDTO
                    $VendaDTO = new VendaDTO();
                    //Novo objeto da classe VendaDAO
                    $VendaDAO = new VendaDAO();

                    if (isset($_GET['idvenda'])) {
                        $idvenda = $_GET['idvenda'];
                        $VendaDTO->setIdvenda($idvenda);
                        $venda = $VendaDAO->PesquisarVendaByID($VendaDTO);
                    } else {
                        $idvenda = NULL;
                        date_default_timezone_set('America/Sao_Paulo');
                        $dataAtual = date('Y-m-d');
                    }
                    ?>
                    <form action="<?php if ($idvenda == NULL) {
                        echo "../Controller/InserirVenda.php";
                    } else {
                        echo "../Controller/AlterarVenda.php";
                    } ?>" method="post">
                        <table class="table table-bordered table-condensed">
                            <tr>
                                <td><label class="pull-right">CPF/CNPJ do Cliente:</label></td>
                                <td>
                                    <input type="hidden" name="usuario" value="<?php echo $_SESSION["idusuario"]; ?>">
                                    <select class="form-control" name="cliente">
                                    <?php 
                                    
                                    //Novo objeto da classe ClienteDAO    
                                    $ClienteDAO = new ClienteDAO;
                                    //Variavel que guarda o array com os dados da tabela cliente
                                   $clientes = $ClienteDAO->PesquisarTodos();
                                   if($idvenda == null){
                                    ?>                                    
                                        <option selected>Selecione</option>
                                    <?php 
                                    
                                    
                                    foreach ($clientes as $cliente){
                                    ?>                                    
                                        <option value="<?php echo $cliente["id_cliente"]?>"><?php echo $cliente["identificador_cliente"];?></option>
                                   <?php } }else{ 
                                    foreach ($clientes as $cliente){
                                    if($cliente ["id_cliente"]==$venda["cliente"]){
                                    
                                   ?>
                                        <option selected value="<?php echo $cliente["id_cliente"]; ?>"><?php echo $cliente["identificador_cliente"]?></option>
?>                                  <?php
                                    }else {
                                    ?>
                                        <option value="<?php echo $cliente["id_cliente"]; ?>"><?php echo $cliente["identificador_cliente"]?></option>
                                    <?php
                                    }
                                    }
                                    }?>
                                    </select>
                                    <input type="hidden" name="idvenda" value="<?php echo $idvenda; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pull-right">Status:</label></td>
                                <td>
                                    <?php if($idvenda==NULL){ ?>
                                    <input type="hidden" name="status" value="Aberta">Aberta
                                    <?php } else { ?>
                                    <select class="form-control" name="status">
                                        <option selected value="<?php echo $venda["status"]; ?>"><?php echo $venda["status"]; ?></option>
                                        <option class="bg-danger" value="Fechada">Fechada</option>
                                        <option class="bg-success" value="Aberta">Aberta</option>
                                    <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pull-right">Data:</label></td>
                                <td>
                                    <?php if($idvenda==NULL){ ?>
                                    <input type="hidden" name="data" value="<?php echo $dataAtual;?>"><?php echo date('d/m/Y');?>
                                    <?php } else { ?><input type="hidden" name="data" value="<?php echo $venda["data_venda"]; ?>"><?php echo $venda["data_venda"]; } ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <a href="LayoutAdministrador.php?link=vendas"><button type="button" class="btn btn-primary">Voltar <span class="glyphicon glyphicon-backward"></span></button></a>
                                    <?php if($idvenda==NULL){ ?>
                                    <input class="btn btn-default" onclick="return confirmarcadastro()" type="submit" value="Inserir Venda">
                                    <?php } else { ?>
                                    <input class="btn btn-default" onclick="return confirmaralteracao()" type="submit" value="Alterar Venda">
                                    <?php } ?>
                                    
                                </td>
                            </tr>
                        </table>
                    </form>

                </div>
            </div>
        </div>
        <script src="../../js/jquery-3.1.0.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/main.js"></script>
    </body>
</html>
