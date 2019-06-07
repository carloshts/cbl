<!DOCTYPE html>
<!-- Página reservada para uso do formulário de salão -->
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
                <div class="col-xs-12">
                    <?php
                    //Conexão com a classe SalaoDAO
                    require_once '../Conexao/SalaoDAO.php';
                    //Conexão com a classe SalaoDTO
                    require_once '../Classes/SalaoDTO.php';
                    if(isset($_GET['idsalao'])){
                        $idsalao = $_GET['idsalao'];
                    } else {
                        $idsalao = NULL;
                    }
                    
                    
                        //Novo objeto da classe SalaoDAO
                        $SalaoDAO = new SalaoDAO();
                        //Novo objeto da classe SalaoDTO
                        $SalaoDTO = new SalaoDTO();
                        
                        //Setando id no atributo id da classe SalaoDTO
                        $SalaoDTO->setIdsalao($idsalao);
                        $salao = $SalaoDAO->PesquisarSalaoByID($SalaoDTO);
                    
                    ?>
                    <form action="<?php if($idsalao==null){
                    echo "../Controller/InserirSalao.php";}  else {
    
    echo "../Controller/AlterarSalao.php";}?>" method="post" class="form-control-static">

                        <table class="table table-bordered table-condensed">
                            <tr hidden>
                                <td><input type="hidden" name="idsalao" value="<?php echo $idsalao;?>"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Nome:</label></td>
                                <td><input type="text" name="nome" value="<?php echo $salao["nome_salao"]; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Cep:</label></td>
                                <td><input type="text" id="cep" name="cep" maxlength="8" value="<?php echo $salao["cep"]; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Telefone:</label></td>
                                <td><input type="text" name="tel" value="<?php echo $salao["telefone_salao"]; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Status:</label></td>
                                <td>
                                    <select name="status" class="form-control">
                                        <?php if($idsalao!=null){ ?>
                                        <option selected value="<?php echo $salao["status_salao"]; ?>"><?php echo $salao["status_salao"]; ?></option>
                                        <?php }else{ ?>
                                        <option selected>Selecione</option>
                                        <?php } ?>
                                        <option class="bg-warning" value="Em manutenção">Em manutenção</option>
                                        <option class="bg-danger" value="Alugado">Alugado</option>
                                        <option class="bg-success" value="Livre">Livre</option>
                                    </select>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Rua:</label></td>
                                <td><input type="text" id="rua" name="rua" value="<?php echo $salao["rua"]; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Número:</label></td>
                                <td><input type="text" name="numero" value="<?php echo $salao["numero"]; ?>" class="form-control pull-right"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Bairro:</label></td>
                                <td><input type="text" id="bairro" name="bairro" value="<?php echo $salao["bairro"]; ?>" class="form-control pull-right"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Cidade:</label></td>
                                <td><input type="text" id="cidade" name="cidade" value="<?php echo $salao["cidade"]; ?>" class="form-control pull-right"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Estado:</label></td>
                                <td><input type="text" id="estado" name="estado" value="<?php echo $salao["estado"]; ?>" class="form-control pull-right"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><a href="LayoutAdministrador.php?link=saloes"><button class="btn btn-primary" type="button">Voltar <span class="glyphicon glyphicon-backward"></span></button></a><input type="submit" value="<?php if ($idsalao != null) {
    echo "Alterar";
} else {
    echo "Cadastrar";
    } ?>" <?php if ($idsalao != null) {
    echo "onclick='return confirmaralteracao()'";
} else {
    echo "onclick='return confirmarcadastro()'";
    } ?> class="btn btn-default"/></td>

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
