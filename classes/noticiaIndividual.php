<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$news = anti_invasao('news');
//Abertura da Tag de Classe
$xml->openTag('noticia');
//Consulta SQL
    $rs = mysql_query("SELECT * FROM noticia WHERE id_noticia = '$news'");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->addTag('id_noticia', $reg->id_noticia);
	   $xml->addTag('titulo_noticia',   $reg->titulo_noticia);
	   $xml->addTag('desc_noticia',   $reg->desc_noticia);
	   $xml->addTag('tags_noticia',   $reg->tags_noticia);
	   $xml->openString('<![CDATA[');
	   $xml->addTag('texto_noticia',   $reg->texto_noticia);
	   $xml->closeString(']]>');
	   $xml->addTag('data_noticia',   $reg->data_noticia);
	   $xml->addTag('imagem_noticia', $reg->imagem_noticia);
	}
//Fechamento da Tag de Classe
$xml->closeTag('noticia');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>