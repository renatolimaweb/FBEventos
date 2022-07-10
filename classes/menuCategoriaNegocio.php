<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
//$descricao = anti_invasao('descricao');
//$localidade = anti_invasao('localidade');
//Abertura da Tag de Classe
$xml->openTag('lista');
//Controle do Loop
$pag_views = 30; //TOTAL DE REGISTROS POR PÁGINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
	
	$sql = "SELECT * FROM categoria_negocio WHERE status_categoria_negocio = 1 ORDER BY id_categoria_negocio ASC";
    $resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
    $linhas = mysql_num_rows($resultado); // N&uacute;mero de linha da consulta
    $limita = "$sql LIMIT $inicio,$pag_views";
    $executa = mysql_query($limita);  //Limitando a sele&ccedil;&atilde;o
    $paginas = $linhas / $pag_views; //Calculando o total de p&aacute;ginas
    $volta = $pagina - 1; // Valores do Bot&atilde;o Voltar
    $proxima = $pagina + 1;  // Valores do Bot&atilde;o Pr&oacute;ximo
    while ($linha=mysql_fetch_array($executa)) {
	   $reg = mysql_fetch_object($resultado);
	   $xml->openTag('categoria');
	   $xml->addTag('id_categoria_negocio', $reg->id_categoria_negocio);
	   $xml->addTag('titulo_categoria_negocio',   $reg->titulo_categoria_negocio);
	   $xml->closeTag('categoria');
	}
	
$xml->closeTag('lista');

echo $xml;
require_once("../Connections/end_criativo.php");
?>