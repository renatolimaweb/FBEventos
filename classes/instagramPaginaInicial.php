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
$pag_views = 4; //TOTAL DE REGISTROS POR PÁGINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
	//Consulta SQL
	$sql = "SELECT * FROM noticia, categoria_noticia WHERE (noticia.id_localidade = '$localidade' OR noticia.id_localidade = 0) AND noticia.id_categoria_noticia = categoria_noticia.id_categoria_noticia AND noticia.id_categoria_noticia = 30 AND posicao_noticia = 7 AND status_noticia = 1 ORDER BY data_noticia DESC";
    $resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
    $linhas = mysql_num_rows($resultado); // N&uacute;mero de linha da consulta
    $limita = "$sql LIMIT $inicio,$pag_views";
    $executa = mysql_query($limita);  //Limitando a sele&ccedil;&atilde;o
    $paginas = $linhas / $pag_views; //Calculando o total de p&aacute;ginas
    $volta = $pagina - 1; // Valores do Bot&atilde;o Voltar
    $proxima = $pagina + 1;  // Valores do Bot&atilde;o Pr&oacute;ximo
    while ($linha=mysql_fetch_array($executa)) {
	   $reg = mysql_fetch_object($resultado);
	   $xml->openTag('instagram');
	   $xml->openString('<![CDATA[');
	   $xml->addTag('texto_noticia', $reg->texto_noticia);
	   $xml->closeString(']]>');
	   $xml->closeTag('instagram');
	}
//Fechamento da Tag de Classe
$xml->closeTag('lista');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>