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
$pag_views = 8; //TOTAL DE REGISTROS POR PÁGINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
	//Consulta SQL
	$sql = "SELECT * FROM evento WHERE id_localidade = '$localidade' AND status_evento = 1 ORDER BY id_evento DESC";
    $resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
    $linhas = mysql_num_rows($resultado); // N&uacute;mero de linha da consulta
    $limita = "$sql LIMIT $inicio,$pag_views";
    $executa = mysql_query($limita);  //Limitando a sele&ccedil;&atilde;o
    $paginas = $linhas / $pag_views; //Calculando o total de p&aacute;ginas
    $volta = $pagina - 1; // Valores do Bot&atilde;o Voltar
    $proxima = $pagina + 1;  // Valores do Bot&atilde;o Pr&oacute;ximo
    while ($linha=mysql_fetch_array($executa)) {
	   $reg = mysql_fetch_object($resultado);
	   $xml->openTag('evento');
	   $xml->addTag('data_evento', $reg->data_evento);
	   $xml->addTag('id_evento', $reg->id_evento);
	   $xml->addTag('imagem_evento', $reg->imagem_evento);
	   $xml->addTag('desc_evento', $reg->desc_evento);
	   $xml->addTag('titulo_evento', $reg->titulo_evento);
	   $xml->closeTag('evento');
	}
//Fechamento da Tag de Classe
$xml->closeTag('lista');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>