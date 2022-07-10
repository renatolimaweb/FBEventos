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
$pag_views = 10; //TOTAL DE REGISTROS POR PÁGINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
	//Consulta SQL
	$sql = "SELECT * FROM evento, categoria_evento WHERE (evento.id_localidade = '$localidade' OR evento.id_localidade = 0) AND evento.id_categoria_evento = categoria_evento.id_categoria_evento AND evento.posicao_evento = 1 AND evento.status_evento = 1 ORDER BY evento.data_evento DESC";
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
	   $xml->addTag('imagem_inicial_evento', $reg->imagem_inicial_evento);
	   $xml->addTag('id_categoria_evento', $reg->id_categoria_evento);
	   $xml->addTag('titulo_evento', $reg->titulo_evento);
	   $xml->addTag('titulo_categoria_evento', $reg->titulo_categoria_evento);
	   $xml->closeTag('evento');
	}
//Fechamento da Tag de Classe
$xml->closeTag('lista');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>