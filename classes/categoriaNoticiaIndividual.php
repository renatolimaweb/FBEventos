<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$categoria = anti_invasao('categoria');
//Abertura da Tag de Classe
$xml->openTag('categoria');
//Consulta SQL
    $rs = mysql_query("SELECT * FROM categoria_noticia WHERE id_categoria_noticia = '$categoria'");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->addTag('titulo_categoria_noticia', $reg->titulo_categoria_noticia);
		$xml->addTag('id_categoria_noticia', $reg->id_categoria_noticia);
	} else {
		//$erro = 2;
		//$msgerro = 'Produto não encontrado!';
	}
//Fechamento da Tag de Classe
$xml->closeTag('categoria');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>