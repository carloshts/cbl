<?php

// Importar o módulo
require("phplot-6.2.0/phplot.php");
//Conexão com a classe ProdutoDTO e ProdutoDAO
require_once '../../../Classes/ProdutoDTO.php';
require_once '../../../Conexao/ProdutoDAO.php';

//Novo objeto da classe ProdutoDTO e ProdutoDAO
$ProdutoDTO = new ProdutoDTO();
$ProdutoDAO = new ProdutoDAO();

date_default_timezone_set('America/Sao_Paulo');
$dataAtual = date('Y-m-d');
$dataAtualFM = explode('-', $dataAtual);
if ($dataAtualFM[1] > 1) {
    $mes = $dataAtualFM[1] - 1;
} else {
    $mes = 12;
}
//variavel com o array do banco
$produtos = $ProdutoDAO->PesquisarTodos();
$dados = array();
$auxQ = array("Quantidade alugada");
$auxA = array("Alugueis");
$qtdalugada = 0;

foreach ($produtos as $produto) {

    if ($produto["nome_produto"] != 'Nulo') {
        $ProdutoDTO->setIdproduto($produto["id_produto"]);
        $alugueis = $ProdutoDAO->PesquisarProdutoAlugadoGrafico($ProdutoDTO, $mes);
        foreach ($alugueis as $aluguel) {



            $qtdalugada += $aluguel["quantidade_item"];
            array_push($auxQ, $qtdalugada);
        }
        $qtd = count($alugueis);
        array_push($auxA, $qtd);
    }
    
}
array_push($dados, $auxQ, $auxA);
// Instanciar o gráfico com tamanho pré-definido
// Deixar em branco faz com que o gráfico encaixe na janela
$grafico = new PHPlot(1000, 700);
// Definindo o formato final da imagem
$grafico->SetFileFormat("png");
//tamanho e posição do grafico
$grafico->SetPlotAreaPixels(100, 150, 600, 600);

// Definindo o título do gráfico
$grafico->SetTitle("Produtos mais alugados no ultimo mês");
// Tipo do gráfico
// Por ser: lines, bars, boxes, bubbles, candelesticks, candelesticks2, linepoints, ohlc, pie, points, squared, stackedarea, stackedbars, thinbarline
$grafico->SetPlotType("bars");
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
foreach ($produtos as $produto) {

    if ($produto["nome_produto"] != 'Nulo') {
        
        array_push($legenda, $produto["nome_produto"]);
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
