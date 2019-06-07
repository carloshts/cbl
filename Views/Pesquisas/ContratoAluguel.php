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
                        <h2 class="h2 text-center">CONTRATO DE LOCAÇÃO DE EQUIPAMENTOS</h2>
                        <br><br>
                        <p class="text-justify">NOME(<?php echo $AluguelSelecionado["nome_cliente"]; ?>), residente em(<?php echo $AluguelSelecionado["endereco_cliente"]; ?>), no bairro (XXX), inscrito no Cadastro das Pessoas Físicas ou das Pessoas Jurídicas do Ministério da Fazenda sob n.º (<?php echo $AluguelSelecionado["identificador_cliente"]; ?>), doravante denominado LOCADOR e,
                            NOME(<font color="red">Empresa Fictícia.LTDA</font>),residente em(<font color="red">XXX</font>), no bairro (<font color="red">XXX</font>), inscrito no Cadastro das Pessoas Jurídicas do Ministério da Fazenda sob n.º (<font color="red">CNPJ da Empresa Fictícia</font>),  doravante denominada LOCATÁRIO, ambas as partes aqui representadas por quem de direito, temjusto e contratado entre si a locação dos equipamentos abaixodiscriminados; mediante as cláusulas e condições a seguir estipuladas.
                        </p>
                        <h4 class="text-justify">1. OBJETO/VALOR</h4>

                        <p class="text-justify">Pelo presente instrumento o locador aluga à locatária os equipamentos abaixo
                            discriminados, e se obriga locá-los nas condições estabelecidas neste contrato.</p>
                        <br>
                           <table class="table table-striped">
                            <tr>
                                <td>Item</td>
                                <td>Quantidade</td>
                                <td>Descrição</td>
                                <td>Preço</td>
                            </tr>
                            <?Php
                            foreach ($apks as $apk) {
                                echo "<tr>";
                                if ($apk["nome_kit_produtos"] != "Nulo" && ($apk["nome_produto"] == "Nulo")) {
                                    echo "      <td>" . $apk["nome_kit_produtos"] . "</td>";
                                    echo "      <td>" . $apk["quantidade_item"] . "</td>";
                                    echo "      <td>" . $apk["descricao_kit_produtos"] . "</td>";
                                    echo "      <td>" . $apk["preco_kit_produtos"] . "</td>";
                                    } else if ($apk["nome_kit_produtos"] == "Nulo" && ($apk["nome_produto"] != "Nulo")) {
                                    echo "      <td>" . $apk["nome_produto"] . "</td>";
                                    echo "      <td>" . $apk["quantidade_item"] . "</td>";
                                    echo "      <td>" . $apk["descricao_produto"] . "</td>";
                                    echo "      <td>" . $apk["preco_produto"] . "</td>";
                                    
                                }
                                echo "</tr>";
                            }
                            ?>
                        </table>






                        <h5 class="text-justify">1.1 O equipamento ora locado, será utilizado pelo próprio Locador para exercer
                            suas funções de entretenimento.</h5>

                        <h4 >2. MANUTENÇÃO, ASSISTÊNCIA TÉCNICA/SEGURO</h4>

                        <h5 class="text-justify">2.1 A manutenção do equipamento, inclusive a troca de peças oriundas do desgaste natural de sua utilização, objeto do presente contrato, é de total
                            responsabilidade do locador.</h5>
                        <h5 class="text-justify">2.2 O locador deve manter o equipamento seguro, pois a locatária não terá
                            nenhuma responsabilidade no que se refere a danos, roubo, ou perda do
                            equipamento.</h5>
                        <h5 class="text-justify">2.3 O locador deverá manter o equipamento em perfeitas condições de uso. Sendo responsável por qualquer dano ao equipamento, independente de culpa, fato atípico ou fato natural.
                            Obs: Conforme o tipo de equipamento há possibilidade de instituir um seguro para o equipamento a ser locado.</h5>

                        <h4>3. PRAZO DE VIGÊNCIA DO CONTRATO</h4>

                        <h5 class="text-justify">3.1 O presente contrato é estabelecido por prazo de (3 meses).</h5>



                        <h4>4. RESCISÃO</h4>

                        <h5 class="text-justify">4.1 O locatário ou o Locador poderão rescindir o presente contrato a qualquer época, desde que comunique por escrito, com antecedência de 30 (trinta) dias. Findo tal prazo o Locador de devolver os equipamentos, objeto do presente contrato, em perfeitas condições, respondendo por quaisquer danos, sejam oriundos do uso ou transporte.
                            Fica eleito o Foro da cidade Brasília, Distrito Federal, como único competente, com renúncia a qualquer outro, por mais privilegiado que seja, para dirimir as questões que surgirem na execução deste contrato.
                            E por estarem justos e contratados assinam o presente contrato em 2 (duas) vias
                            de igual teor e forma, para os mesmos efeitos, com as testemunhas a seguir.</h5>
                        <?php 
                        date_default_timezone_set('America/Sao_Paulo');
                            $dataAtual = date('Y-m-d'); 
                            $data = explode('-', $dataAtual)?>
                        <h4 class="text-justify">Cidade (Brasília), dia (<?php echo $data[2]; ?>) de mês (<?php echo $data[1]; ?>) de ano (<?php echo $data[0]; ?>).</h4>



                        <p class="text-left">


                            Ass:<br><br>
                            LOCADOR
                            <br><br><br>
                            Ass:<br><br>
                            LOCATÁRIO
                            <br><br><br>
                            TESTEMUNHAS:
                            <br><br>


                            1- Testemunha Ass:
                            <br><br>
                            2- Testemunha Ass:
                            <br><br>

                        </p>
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
