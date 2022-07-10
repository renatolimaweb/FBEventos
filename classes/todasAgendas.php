<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$localidade = anti_invasao('localidade');
//Abertura da Tag de Classe
$xml->openTag('lista');
//Controle do Loop
$pag_views = 10000; //TOTAL DE REGISTROS POR PÁGINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
	
	$sql = "SELECT * FROM agenda WHERE id_localidade = $localidade OR id_localidade = 0 ORDER BY data_agenda DESC, id_agenda DESC";
    $resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
    $linhas = mysql_num_rows($resultado); // N&uacute;mero de linha da consulta
    $limita = "$sql LIMIT $inicio,$pag_views";
    $executa = mysql_query($limita);  //Limitando a sele&ccedil;&atilde;o
    $paginas = $linhas / $pag_views; //Calculando o total de p&aacute;ginas
    $volta = $pagina - 1; // Valores do Bot&atilde;o Voltar
    $proxima = $pagina + 1;  // Valores do Bot&atilde;o Pr&oacute;ximo
    while ($linha=mysql_fetch_array($executa)) {
	   $reg = mysql_fetch_object($resultado);
	   $xml->openTag('agenda');
	   $xml->addTag('id_agenda', $reg->id_agenda);
	   $xml->addTag('data_agenda',   $reg->data_agenda);
	   $xml->addTag('titulo_agenda',   $reg->titulo_agenda);
	   $xml->addTag('desc_agenda',   $reg->desc_agenda);
	   $xml->addTag('imagem_agenda', $reg->imagem_agenda);
	   $xml->closeTag('agenda');
	}
	
$xml->closeTag('lista');

echo $xml;
require_once("../Connections/end_criativo.php");
?>