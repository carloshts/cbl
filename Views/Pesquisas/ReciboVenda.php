<!DOCTYPE html>
<!-- Página reservada para o recibo da venda -->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link media="print" href="../../css/bootstrap.min.css" rel="stylesheet">
        <link media="screen" href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/estilo.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <?php
        //Conexão com a classe VendaProdutoDAO e VendaProdutoDTO
        require_once '../../Conexao/VendaProdutoDAO.php';
        require_once '../../Classes/VendaProdutoDTO.php';
        
        //Novo objeto da classe VendaProdutoDAO e VendaProdutoDTO
        $VendaProdutoDTO = new VendaProdutoDTO();
        $VendaProdutoDAO = new VendaProdutoDAO();
        
        if(isset($_GET['idvenda'])){
            //Metodo que seta o codigo da venda
            $VendaProdutoDTO->setVenda($_GET['idvenda']);
            //Metodo que pesquisa todos os produtos da venda selecionada
            $itens = $VendaProdutoDAO->PesquisarVendaProdutoByID($VendaProdutoDTO);
            
            ?>
        <div class="container" id="reciboVenda">
            <div class="row">
                <div class="col-xs-12">
                    <img class="img-responsive" src="../../Imagens/logoEmpresaFictícia1.png" alt="Empresa fictícia">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-responsive">
                        <tr>
                            <td>Cliente</td>
                            <td>Item</td>
                            <td>Quantidade</td>
                            <td>Descrição</td>
                            <td>Preço</td>
                        </tr>
            <?php       $total = 0;
                        foreach ($itens as $item){
                            echo "<tr>";
                            echo "      <td>" . $item["nome_cliente"] . "</td>";
                            echo "      <td>" . $item["nome_produto"] . "</td>";
                            echo "      <td>" . $item["quantidade_item"] . "</td>";
                            echo "      <td>" . $item["descricao_produto"] . "</td>";
                                    $precoproduto = $item["preco_produto"] * $item["quantidade_item"];
                            echo "      <td>" . $precoproduto . "</td>";
                            echo "</tr>";
                                    $total +=$precoproduto;
                        }
            ?>      
                        <tr>
                            <td colspan="5">Preço total: <?php echo $total; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
            <?php
        } else {
            ?>
        <h1 class="h1 alert-danger">Venda não selecionada. Volte e refaça o processo.</h1>
        <?php
        }
        
        ?>
        <script src="../../js/jquery-3.1.0.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/main.js"></script>
        <script>
            printDiv('reciboVenda');
            function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            }
        </script>
    </body>
</html>
