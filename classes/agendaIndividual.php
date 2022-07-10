<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$agenda = anti_invasao('agenda');
//Abertura da Tag de Classe
$xml->openTag('evento');
//Consulta SQL
    $rs = mysql_query("SELECT * FROM agenda WHERE id_agenda = '$agenda'");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->addTag('id_agenda', $reg->id_agenda);
	    $xml->addTag('data_agenda',   $reg->data_agenda);
	    $xml->addTag('titulo_agenda',   $reg->titulo_agenda);
		$xml->openString('<![CDATA[');
	    $xml->addTag('desc_agenda',   $reg->desc_agenda);
		$xml->closeString(']]>');
		$xml->addTag('tags_agenda',   $reg->tags_agenda);
	    $xml->openString('<![CDATA[');
	    $xml->addTag('texto_agenda',   $reg->texto_agenda);
	    $xml->closeString(']]>');
	    $xml->addTag('imagem_agenda', $reg->imagem_agenda);
	} else {
		//$erro = 2;
		//$msgerro = 'Produto não encontrado!';
	}
//Fechamento da Tag de Classe
$xml->closeTag('evento');
//Gerador do XML
echo $xml;

require_once("../Connections/end_criativo.php");
?>