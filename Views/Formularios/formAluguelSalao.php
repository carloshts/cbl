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
                    //Conexão com a classe AluguelSalaoDTO
                    require_once '../Classes/AluguelSalaoDTO.php';
                    //Conexão com a classe AluguelSalaoDAO
                    require_once '../Conexao/AluguelSalaoDAO.php';
                    //Conexão com a classe ClienteDAO
                    require_once '../Conexao/ClienteDAO.php';
                    //Conexão com a classe SalaoDAO
                    require_once '../Conexao/SalaoDAO.php';
                    //Conexão com a classe SalaoDTO
                    require_once '../Classes/SalaoDTO.php';
                    
                    //Novo objeto da classe AluguelSalaoDTO
                    $AluguelSalaoDTO = new AluguelSalaoDTO();
                    //Novo objeto da classe AluguelSalaoDAO
                    $AluguelSalaoDAO = new AluguelSalaoDAO();

                    if (isset($_GET['salao'])&&isset($_GET['datareserva'])) {
                        $salao = $_GET['salao'];
                        $datareserva = $_GET['datareserva'];
                        
                        $AluguelSalaoDTO->setDatareserva($datareserva);
                        $AluguelSalaoDTO->setSalao($salao);
                        $aluguel = $AluguelSalaoDAO->PesquisarAluguelSalaoByID($AluguelSalaoDTO);
                    } else {
                        $salao = NULL;
                        $datareserva = NULL;
                        date_default_timezone_set('America/Sao_Paulo');
                        $dataAtual = date('Y-m-d');
                    }
                    ?>
                    <form action="<?php if ($salao == NULL || $datareserva == NULL) {
                        echo "../Controller/InserirAluguelSalao.php";
                    } else {
                        echo "../Controller/AlterarAluguelSalao.php";
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
                                   if($salao == NULL && $datareserva == NULL){
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
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pull-right">Salão:</label></td>
                                <td>
                                    <select class="form-control" name="salao">
                                    <?php 
                                    
                                    //Novo objeto da classe SalaoDAO    
                                    $SalaoDAO = new SalaoDAO;
                                    //Variavel que guarda o array com os dados da tabela salao
                                   $saloes = $SalaoDAO->PesquisarTodos();
                                   if($salao == NULL || $datareserva == NULL){
                                    ?>                                    
                                        <option selected>Selecione</option>
                                    <?php 
                                    
                                    
                                    foreach ($saloes as $salaox){
                                    ?>                                    
                                        <option value="<?php echo $salaox["id_salao"]?>"><?php echo $salaox["nome_salao"];?></option>
                                   <?php } }else{ 
                                    foreach ($saloes as $salaox){
                                    if($salaox ["id_salao"]==$aluguel["salao"]){
                                    
                                   ?>
                                        <option selected value="<?php echo $salaox["id_salao"]; ?>"><?php echo $salaox["nome_salao"]?></option>
?>                                  <?php
                                    }else {
                                    ?>
                                        <option value="<?php echo $salaox["id_salao"]; ?>"><?php echo $salaox["nome_salao"]?></option>
                                    <?php
                                    }
                                    }
                                    }?>
                                    </select>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pull-right">Status:</label></td>
                                <td>
                                    <?php if($salao == NULL || $datareserva == NULL){ ?>
                                    <input type="hidden" name="status" value="Pendente">Pendente
                                    <?php } else { ?>
                                    <select class="form-control" name="status">
                                        <option selected value="<?php echo $aluguel["status"]; ?>"><?php echo $aluguel["status"]; ?></option>
                                        <option class="bg-success" value="Fechado">Fechado</option>
                                        <option class="bg-warning" value="Pendente">Pendente</option>
                                        <option class="bg-danger" value="Sob-Aviso">Sob-Aviso</option>
                                    <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pull-right">Data de reserva:</label></td>
                                <td>
                                    <?php if($salao == NULL || $datareserva == NULL){ ?>
                                    <input type="date" class="form-control" name="datareserva">
                                    <?php } else { ?>
                                    <input type="date" class="form-control" name="datareserva" value="<?php echo $aluguel["data_reserva"]?>">
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label class="pull-right">Data de entrega:</label></td>
                                <td>
                                    <?php if($salao == NULL || $datareserva == NULL){ ?>
                                    <input type="date" class="form-control" name="dataentrega">
                                    <?php } else { ?>
                                    <input type="date" class="form-control" name="dataentrega" value="<?php echo $aluguel["data_entrega"]?>">
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="LayoutAdministrador.php?link=aluguelsalao"><button type="button" class="btn btn-primary">Voltar <span class="glyphicon glyphicon-backward"></span></button></a>
                                    <?php if($salao == NULL || $datareserva == NULL){ ?>
                                    <input class="btn btn-default" onclick="return confirmarcadastro()" type="submit" value="Inserir">
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
