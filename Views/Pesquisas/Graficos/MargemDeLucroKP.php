<?php

// Importar o módulo
require("phplot-6.2.0/phplot.php");
//Conexão com a classe KitProdutosDTO e ProdutoDAO
require_once '../../../Classes/KitProdutosDTO.php';
require_once '../../../Conexao/KitProdutosDAO.php';

//Novo objeto da classe KitProdutosDTO e KitProdutosDAO
$KitProdutosDTO = new KitProdutosDTO();
$KitProdutosDAO = new KitProdutosDAO();

date_default_timezone_set('America/Sao_Paulo');
$dataAtual = date('Y-m-d');
$dataAtualFM = explode('-', $dataAtual);
if ($dataAtualFM[1] > 1) {
    $mes = $dataAtualFM[1] - 1;
} else {
    $mes = 12;
}
//variavel com o array do banco
$kps = $KitProdutosDAO->PesquisarTodos();
$dados = array();
$aux = array("Margem de lucro");

$qtdalugada = 0;
$ValorAlugado = 0;
$margem = 0;
foreach ($kps as $kp) {
$qtdalugados = 0;
$qtdgeral = 0;
    if ($kp["nome_kit_produtos"] != 'Nulo') {
        $KitProdutosDTO->setIdkitprodutos($kp["id_kit_produtos"]);
        $alugueis = $KitProdutosDAO->PesquisarKitProdutosAlugadoGrafico($KitProdutosDTO, $mes);
        foreach ($alugueis as $aluguel) {
            $qtdalugada += $aluguel["quantidade_item"];
        }
        $ValorAlugado = $kp["preco_kit_produtos"] * $qtdalugada;
        $margem = $ValorAlugado - ($kp["preco_compra_kp"] * $kp["quantidade_kit_produtos"]);
        array_push($aux,$margem);
    }
    
    
    
    
}
array_push($dados, $aux);


// Instanciar o gráfico com tamanho pré-definido
// Deixar em branco faz com que o gráfico encaixe na janela
$grafico = new PHPlot(1000, 700);
// Definindo o formato final da imagem
$grafico->SetFileFormat("png");
//tamanho e posição do grafico
$grafico->SetPlotAreaPixels(100, 150, 600, 600);

// Definindo o título do gráfico
$grafico->SetTitle("Valorização do estoque dos kits alugados no ultimo mês");
// Tipo do gráfico
// Por ser: lines, bars, boxes, bubbles, candelesticks, candelesticks2, linepoints, ohlc, pie, points, squared, stackedarea, stackedbars, thinbarline
$grafico->SetPlotType("thinbarline");
//Largura do 3d
$grafico->SetShading(4);
// Título dos dados no eixo X
$grafico->SetXTitle($dataAtualFM[1]-1 . '/' . $dataAtualFM[0]);
//cor do titulo do eixo x
$grafico->SetXTitleColor("#535457");
//cor do titulo do eixo y
$grafico->SetYTitleColor("#535457");
//fonte padrão
$grafico->SetDefaultTTFont('Arial.ttf');
//tamanho e fonte do eixo x
$grafico->SetFontTTF('x_title', null, 22);
//tamanho e fonte do eixo x
$grafico->SetFontTTF('x_label', null, 14);
$grafico->SetFontTTF('y_label', null, 18);
// dados do gráfico
//atribuindo os valores
$grafico->SetDataValues($dados);
$legenda = array();
foreach ($kps as $kp) {

    if ($kp["nome_kit_produtos"] != 'Nulo') {
        
        array_push($legenda, $kp["nome_kit_produtos"]);
    }
    
}
// Gera uma legenda
$grafico->SetLegend($legenda);
// Tamanho da fonte
$grafico->SetFont('legend', null, 13);
//posicao da legenda
$grafico->SetLegendPosition(1, 0, 'image', 1, 0, 5, 25);
//Exibimos o gráfico
$grafico->DrawGraph();
?>
