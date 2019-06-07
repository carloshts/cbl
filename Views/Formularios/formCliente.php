<!DOCTYPE html>
<!-- Formulário de cadastro de cliente -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulário de cadastro de cliente</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    require_once '../Conexao/ClienteDAO.php';
                    require_once '../Classes/ClienteDTO.php';

                    if (isset($_GET['idcliente'])) {
                        $idcliente = $_GET['idcliente'];
                    } else {
                        $idcliente = null;
                    }
                    $ClienteDTO = new ClienteDTO();
                    $ClienteDTO->setIdcliente($idcliente);
                    $ClienteDAO = new ClienteDAO();
                    $cliente = $ClienteDAO->PesquisarClienteByID($ClienteDTO);
                    ?>
                    <form action="<?php if($idcliente==null){
                    echo "../Controller/InserirCliente.php";}  else {
    
                        echo "../Controller/AlterarCliente.php";}?>" method="post" id="formulario" class="form-control-static">

                        <table class="table table-bordered table-condensed">
                            <tr hidden>
                                <td><input type="hidden" name="idcliente" value="<?php echo $idcliente;?>"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Nome:</label></td>
                                <td><input type="text" name="nome" required value="<?php echo $cliente["nome_cliente"]; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Tipo:</label></td>
                                <td>
                                    <select class="form-control" id="tipo" name="tipo">
                                        <?php if(isset($_GET['idcliente'])){
                                            ?>
                                        <option value="<?php echo $cliente["tipo"]; ?>"><?php echo $cliente["tipo_cliente"]; ?></option>
                                        <?php
                                        }  else { ?>
                                        <option selected>Selecione</option>  
                                        <?php
                                        }
                                            
                                        ?>
                                        
                                        <option value="Pessoa Fisíca">Pessoa Fisíca</option>
                                        <option value="Pessoa Jurídica">Pessoa Jurídica</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="campoCPF" style="display: none">
                                <td><label class="lead pull-right">Cpf:</label></td>
                                <td><input type="text" id="cpf" required name="cpf" value="<?php echo $cliente["identificador_cliente"]; ?>" class="form-control"></td>
                            </tr>
                            <tr id="campoCNPJ" style="display: none">
                                <td><label class="lead pull-right">Cnpj:</label></td>
                                <td><input type="text" id="cnpj" required name="cnpj" value="<?php echo $cliente["identificador_cliente"]; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Telefone:</label></td>
                                <td><input type="text" id="tel" name="tel" required value="<?php echo $cliente["telefone_cliente"]; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">Endereço:</label></td>
                                <td><input type="text" name="end" required value="<?php echo $cliente["endereco_cliente"]; ?>" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label class="lead pull-right">E-mail:</label></td>
                                <td><input type="text" name="email" required value="<?php echo $cliente["email_cliente"]; ?>" class="form-control pull-right"></td>
                            </tr>
<?php ?>
                            <tr>
                                <td colspan="2"><a href="LayoutAdministrador.php?link=clientes"><button class="btn btn-primary" type="button">Voltar <span class="glyphicon glyphicon-backward"></span></button></a><input type="submit" value="<?php if ($idcliente != null) {
    echo "Alterar";
} else {
    echo "Cadastrar";
    } ?>" <?php if ($idcliente != null) {
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
        <script type="text/javascript">
            var select = document.getElementById("tipo");
            
            select.onchange = function () {
                var campoID = select.options[select.selectedIndex].value;
                
                if(campoID=="Pessoa Fisíca"){
                    var campoEscolhido = document.getElementById('campoCPF');
                    var outroCampo = document.getElementById('campoCNPJ');
                    var campoNulo = document.getElementById('cnpj');
                    campoEscolhido.removeAttribute('style');
                    outroCampo.style.display = 'none';
                    campoNulo.removeAttribute('required');
                    campoNulo.removeAttribute('name');
                    campoEscolhido.name = 'cpf';
                    campoEscolhido.required;
                } else {
                    var campoEscolhido = document.getElementById('campoCNPJ');
                    var outroCampo = document.getElementById('campoCPF');
                    var campoNulo = document.getElementById('cpf');
                    campoEscolhido.removeAttribute('style');
                    outroCampo.style.display = 'none';
                    campoNulo.removeAttribute('required');
                    campoNulo.removeAttribute('name');
                    campoEscolhido.name = 'cnpj';
                    campoEscolhido.required;
                }
                
                
                };
        </script>
    </body>
</html>
