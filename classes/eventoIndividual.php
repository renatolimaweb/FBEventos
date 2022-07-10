<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$evento = anti_invasao('evento');
//Abertura da Tag de Classe
$xml->openTag('pagina');
//Consulta SQL
    $rs = mysql_query("SELECT * FROM evento, negocio, localidade, estado WHERE evento.id_negocio = negocio.id_negocio AND negocio.id_localidade = localidade.id_localidade AND localidade.id_estado = estado.id_estado AND evento.id_evento = '$evento'");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->addTag('id_evento', $reg->id_evento);
	    $xml->addTag('titulo_evento',   $reg->titulo_evento);
		$xml->addTag('titulo_negocio',   $reg->titulo_negocio);
		$xml->addTag('titulo_localidade',   $reg->titulo_localidade);
		$xml->addTag('titulo_estado',   $reg->titulo_estado);
		$xml->addTag('tags_evento',   $reg->tags_evento);
	    $xml->addTag('desc_evento',   $reg->desc_evento);
	    $xml->addTag('data_evento',   $reg->data_evento);
	    $xml->addTag('pasta_evento',   $reg->pasta_evento);
	    $xml->addTag('imagem_evento', $reg->imagem_evento);
	} else {
		//$erro = 2;
		//$msgerro = 'Produto não encontrado!';
	}
//Fechamento da Tag de Classe
$xml->closeTag('pagina');
//Gerador do XML
echo $xml;

require_once("../Connections/end_criativo.php");
?>