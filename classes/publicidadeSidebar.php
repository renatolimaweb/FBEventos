<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$localidade = anti_invasao('localidade');
//Abertura da Tag de Classe
$xml->openTag('publicidade');
//Controlador do Loop
$pag_views = 2; //TOTAL DE REGISTROS POR PÁGINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
	//Consulta SQL
	$sql = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 11 AND status_publicidade = 1 ORDER BY RAND()";
    $resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
    $linhas = mysql_num_rows($resultado); // N&uacute;mero de linha da consulta
    $limita = "$sql LIMIT $inicio,$pag_views";
    $executa = mysql_query($limita);  //Limitando a sele&ccedil;&atilde;o
    $paginas = $linhas / $pag_views; //Calculando o total de p&aacute;ginas
    $volta = $pagina - 1; // Valores do Bot&atilde;o Voltar
    $proxima = $pagina + 1;  // Valores do Bot&atilde;o Pr&oacute;ximo
    while ($linha=mysql_fetch_array($executa)) {
	   $reg = mysql_fetch_object($resultado);
	   $xml->openTag('anuncio');
	   $xml->addTag('imagem_publicidade', $reg->imagem_publicidade);
	   $xml->addTag('url_publicidade', $reg->url_publicidade);
	   $xml->addTag('iframe_publicidade', $reg->iframe_publicidade);
	   $xml->addTag('id_publicidade', $reg->id_publicidade);
	   $xml->addTag('titulo_publicidade', $reg->titulo_publicidade);
	   $xml->closeTag('anuncio');
	}
//Fechamento da Tag de Classe
$xml->closeTag('publicidade');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>