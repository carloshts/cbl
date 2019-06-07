<!DOCTYPE html>
<!-- Página reservada para o formulário do Aluguel -->
<html>
    <head>
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <title>Formulário de cadastro de aluguel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    //Conexão com a classe AluguelDTO
                    require_once '../Classes/AluguelDTO.php';
                    //Conexão com a classe AluguelDAO
                    require_once '../Conexao/AluguelDAO.php';
                    //Conexão com a classe ClienteDAO
                    require_once '../Conexao/ClienteDAO.php';

                    //Novo objeto da classe AluguelDTO
                    $AluguelDTO = new AluguelDTO();
                    //Novo objeto da classe AluguelDAO
                    $AluguelDAO = new AluguelDAO();

                    if (isset($_GET['idaluguel'])) {
                        $idaluguel = $_GET['idaluguel'];
                        $AluguelDTO->setIdaluguel($idaluguel);
                        $aluguel = $AluguelDAO->PesquisarAluguelByID($AluguelDTO);
                    } else {
                        $idaluguel = NULL;
                        date_default_timezone_set('America/Sao_Paulo');
                        $dataAtual = date('Y-m-d');
                    }
                    ?>
                    <form action="<?php if ($idaluguel == NULL) {
                        echo "../Controller/InserirAluguel.php";
                    } else {
                        echo "../Controller/AlterarAluguel.php";
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
                                   if($idaluguel == null){
                                    ?>                                    
                                        <option selected>Selecione</option>
                                    <?php 
                                    
                                    
                                    foreach ($clientes as $cliente){
                                    ?>                                    
                                        <option value="<?php echo $cliente["id_cliente"]?>"><?php echo $cliente["identificador_cliente"];?></option>
                                   <?php } }else{ 
                                    foreach ($clientes as $cliente){
                                    if($cliente ["id_cliente"]==$aluguel["cliente"]){
                                    
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
                                    <input type="hidden" name="idaluguel" value="<?php echo $idaluguel; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pull-right">Status:</label></td>
                                <td>
                                    <?php if($idaluguel==NULL){ ?>
                                    <input type="hidden" name="status" value="Orçamento">Orçamento
                                    <?php } else { ?>
                                    <select class="form-control" name="status">
                                        <option selected value="<?php echo $aluguel["status"]; ?>"><?php echo $aluguel["status"]; ?></option>
                                        <option class="bg-info" value="Orçamento">Orçamento</option>
                                        <option class="bg-success">Contratado</option>
                                        <option class="bg-warning" value="Pendente">Pendente</option>
                                        <option class="bg-danger" value="Sob-Aviso">Sob-Aviso</option>
                                        <option value="Fechado">Fechado</option>
                                    <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pull-right">Data do aluguel:</label></td>
                                <td>
                                    <?php if($idaluguel==NULL){ ?>
                                    <input type="hidden" name="dataentrada" value="<?php echo $dataAtual;?>"><?php echo date('d/m/Y');?>
                                    <?php } else { ?>
                                    <input type="date" class="form-control" name="dataentrada" value="<?php echo $aluguel["data_entrada"]?>">
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pull-right">Data de entrega:</label></td>
                                <td>
                                    <?php if($idaluguel==NULL){ ?>
                                    <input type="date" class="form-control" name="datasaida" value="">
                                    <?php } else { ?>
                                    <input type="date" class="form-control" name="datasaida" value="<?php echo $aluguel["data_saida"]?>">
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="LayoutAdministrador.php?link=alugueis"><button type="button" class="btn btn-primary">Voltar <span class="glyphicon glyphicon-backward"></span></button></a>
                                    <?php if($idaluguel==NULL){ ?>
                                    <input class="btn btn-default" onclick="return confirmarcadastro()" type="submit" value="Inserir Aluguel">
                                    <?php } else { ?>
                                    <input class="btn btn-default" onclick="return confirmaralteracao()" type="submit" value="Alterar">
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
