<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$localidade = anti_invasao('localidade');
//Abertura da Tag de Classe
$xml->openTag('lista');
//Controlador do Loop
$pag_views = 1; //TOTAL DE REGISTROS POR PÁGINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
	//Consulta SQL
	$sql = "SELECT * FROM noticia WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND id_categoria_noticia = 15 AND posicao_noticia = 2 AND status_noticia = 1 ORDER BY id_noticia DESC";
    $resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
    $linhas = mysql_num_rows($resultado); // N&uacute;mero de linha da consulta
    $limita = "$sql LIMIT $inicio,$pag_views";
    $executa = mysql_query($limita);  //Limitando a sele&ccedil;&atilde;o
    $paginas = $linhas / $pag_views; //Calculando o total de p&aacute;ginas
    $volta = $pagina - 1; // Valores do Bot&atilde;o Voltar
    $proxima = $pagina + 1;  // Valores do Bot&atilde;o Pr&oacute;ximo
    while ($linha=mysql_fetch_array($executa)) {
	   $reg = mysql_fetch_object($resultado);
	   $xml->openTag('noticia');
	   $xml->addTag('data_noticia', $reg->data_noticia);
	   $xml->addTag('id_noticia', $reg->id_noticia);
	   $xml->addTag('imagem_inicial_noticia', $reg->imagem_inicial_noticia);
	   $xml->addTag('desc_noticia', $reg->desc_noticia);
	   $xml->addTag('titulo_noticia', $reg->titulo_noticia);
	   $xml->closeTag('noticia');
	}
//Fechamento da Tag de Classe
$xml->closeTag('lista');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>