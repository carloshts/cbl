 <?php

//Conexão com a classe ProdutoDTO
require_once '../Classes/ProdutoDTO.php';
//Conexão com a classe ProdutoDAO
require_once '../Conexao/ProdutoDAO.php';

//Variáveis que recebem os valores dos campos do formulário
$nome = $_POST['nome'];
$disponibilidade = $_POST['disponibilidade'];
$descricao = $_POST['descricao'];
$permissao = $_POST['permissao'];
$preco = $_POST['preco'];
$precoCompra = $_POST['precoCompra'];
$categoria = $_POST['categoria'];
$kitprodutos = $_POST['kit'];
$quantidade = $_POST['quantidade'];
$estoque = $_POST['estoque'];
$idproduto = $_POST['idproduto'];
//Novo objeto da classe ProdutoDTO
$ProdutoDTO = new ProdutoDTO();

//Metodos que setam os atributos da classe ProdutoDTO
$ProdutoDTO->setNome($nome);
$ProdutoDTO->setDisponibilidade($disponibilidade);
$ProdutoDTO->setQuantidade($quantidade);
$ProdutoDTO->setDescricao($descricao);
$ProdutoDTO->setPermissao($permissao);
$ProdutoDTO->setPreco($preco);
$ProdutoDTO->setPrecoCompra($precoCompra);
$ProdutoDTO->setCategoria($categoria);
$ProdutoDTO->setKitprodutos($kitprodutos);
$ProdutoDTO->setEstoque($estoque);
$ProdutoDTO->setIdproduto($idproduto);
//Novo objeto da classe ProdutoDAO
$ProdutoDAO = new ProdutoDAO();

//Metodo de alterar um produto no Banco de dados
$ProdutoDAO->AlterarProduto($ProdutoDTO);

//Script do tipo JavaScript que redireciona para a página de pesquisa
echo "<script>";
echo "  window.location ='../Views/LayoutAdministrador.php?link=produtos'";
echo "</script>";

