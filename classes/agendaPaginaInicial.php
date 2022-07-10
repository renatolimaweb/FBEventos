<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$localidade = anti_invasao('localidade');
//Funcao para controle de data
$hoje = date('Y-m-d');
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
	$sql = "SELECT * FROM agenda WHERE (agenda.id_localidade = '$localidade' OR agenda.id_localidade = 0) AND posicao_agenda = 1 AND status_agenda = 1 ORDER BY data_agenda ASC";
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
	   $xml->addTag('data_agenda', $reg->data_agenda);
	   $xml->addTag('id_agenda', $reg->id_agenda);
	   $xml->addTag('imagem_inicial_agenda', $reg->imagem_inicial_agenda);
	   $xml->addTag('titulo_agenda', $reg->titulo_agenda);
	   $xml->closeTag('agenda');
	}
//Fechamento da Tag de Classe
$xml->closeTag('lista');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>