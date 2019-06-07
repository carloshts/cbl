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
        //Conexão com a classe AluguelProdutosKitProdutosDAO e AluguelProdutosKitProdutosDTO
        require_once '../../Conexao/AluguelProdutosKitProdutosDAO.php';
        require_once '../../Classes/AluguelProdutosKitProdutosDTO.php';
        //Conexão com a classe AluguelDAO e AluguelDTO
        require_once '../../Conexao/AluguelDAO.php';
        require_once '../../Classes/AluguelDTO.php';
        //Novo objeto da classe AluguelProdutosKitProdutosDAO e AluguelProdutosKitProdutosDTO
        $APKDTO = new AluguelProdutosKitProdutosDTO();
        $APKDAO = new AluguelProdutosKitProdutosDAO();
        //Novo objeto da classe AluguelDAO e AluguelDTO
        $AluguelDAO = new AluguelDAO();
        $AluguelDTO = new AluguelDTO();


        if (isset($_GET['idaluguel'])) {
            //Metodo que seta o codigo da venda
            $aluguel = $_GET['idaluguel'];
            //Metodo que pesquisa todos os produtos da venda selecionada
            $apks = $APKDAO->PesquisarAPKByID($aluguel);
            $AluguelDTO->setIdaluguel($_GET['idaluguel']);
            $AluguelSelecionado = $AluguelDAO->PesquisarAluguelByID($AluguelDTO);
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
                                <th class="h1" colspan="4">Recibo de Aluguel</th>
                            </tr>
                            <tr>
                                <td colspan="2">Cliente: <?php echo $AluguelSelecionado["nome_cliente"]; ?></td>
                                <td colspan="2">Código do Aluguel: AP<?php echo $AluguelSelecionado["id_aluguel"]; ?></td>
                            </tr>
                            <tr class="bg-info">
                                <td>Data do aluguel:</td>
                                <td><?php echo $AluguelSelecionado["data_entrada"]; ?></td>
                                <td>Data de devolução:</td>
                                <td><?php echo $AluguelSelecionado["data_saida"]; ?></td>
                            </tr>
                            <tr>
                                <td>Item</td>
                                <td>Quantidade</td>
                                <td>Descrição</td>
                                <td>Preço</td>
                            </tr>
                            <?php
                            $total = 0;
                            foreach ($apks as $apk) {
                                echo "<tr>";
                                if ($apk["nome_kit_produtos"] != "Nulo" && ($apk["nome_produto"] == "Nulo")) {
                                    echo "      <td>" . $apk["nome_kit_produtos"] . "</td>";
                                    echo "      <td>" . $apk["quantidade_item"] . "</td>";
                                    echo "      <td>" . $apk["descricao_kit_produtos"] . "</td>";
                                    $precokit = $apk["preco_kit_produtos"] * $apk["quantidade_item"];
                                    $total += $precokit;
                                    echo "      <td>" . $precokit . "</td>";
                                } else if ($apk["nome_kit_produtos"] == "Nulo" && ($apk["nome_produto"] != "Nulo")) {
                                    echo "      <td>" . $apk["nome_produto"] . "</td>";
                                    echo "      <td>" . $apk["quantidade_item"] . "</td>";
                                    echo "      <td>" . $apk["descricao_produto"] . "</td>";
                                    $precoproduto = $apk["preco_produto"] * $apk["quantidade_item"];
                                    $total += $precoproduto;
                                    echo "      <td>" . $precoproduto . "</td>";
                                    echo "</tr>";
                                }
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
