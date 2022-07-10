<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$localidade = anti_invasao('localidade');
//Abertura da Tag de Classe
$xml->openTag('publicidade');
//Consulta SQL
    $rs = mysql_query("SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 7 AND status_publicidade = 1 ORDER BY RAND()");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->openTag('anuncio');
		$xml->addTag('titulo_anuncio', $reg->titulo_anuncio);
		$xml->addTag('imagem_publicidade', $reg->imagem_publicidade);
		$xml->addTag('url_publicidade', $reg->url_publicidade);
		$xml->addTag('iframe_publicidade', $reg->iframe_publicidade);
		$xml->closeTag('anuncio');
	} else {
		//$erro = 2;
		//$msgerro = 'Produto não encontrado!';
	}
//Fechamento da Tag de Classe
$xml->closeTag('publicidade');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>