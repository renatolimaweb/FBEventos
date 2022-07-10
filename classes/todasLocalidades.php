<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
//$localidade = anti_invasao('localidade');
//Abertura da Tag de Classe
$xml->openTag('lista');
//Controle do Loop
$pag_views = 1000; //TOTAL DE REGISTROS POR PÁGINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
	
	$sql = "SELECT * FROM localidade, estado WHERE localidade.id_estado = estado.id_estado AND id_localidade <> 0 AND status_localidade = 1 ORDER BY titulo_localidade ASC";
    $resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
    $linhas = mysql_num_rows($resultado); // N&uacute;mero de linha da consulta
    $limita = "$sql LIMIT $inicio,$pag_views";
    $executa = mysql_query($limita);  //Limitando a sele&ccedil;&atilde;o
    $paginas = $linhas / $pag_views; //Calculando o total de p&aacute;ginas
    $volta = $pagina - 1; // Valores do Bot&atilde;o Voltar
    $proxima = $pagina + 1;  // Valores do Bot&atilde;o Pr&oacute;ximo
    while ($linha=mysql_fetch_array($executa)) {
	   $reg = mysql_fetch_object($resultado);
	   $xml->openTag('localidade');
	   $xml->addTag('id_localidade', $reg->id_localidade);
	   $xml->addTag('titulo_localidade',   $reg->titulo_localidade);
	   $xml->addTag('titulo_estado', $reg->titulo_estado);
	   $xml->closeTag('localidade');
	}
	
$xml->closeTag('lista');

echo $xml;
require_once("../Connections/end_criativo.php");
?>