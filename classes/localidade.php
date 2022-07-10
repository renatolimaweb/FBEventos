<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$localidade = anti_invasao('localidade');
//Abertura da Tag de Classe
$xml->openTag('localidades');
//Consulta SQL
    $rs = mysql_query("SELECT * FROM localidade, estado WHERE localidade.id_estado = estado.id_estado AND localidade.id_localidade = '$localidade'");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->openTag('cidade');
		$xml->addTag('titulo_localidade', $reg->titulo_localidade);
		$xml->addTag('titulo_estado', $reg->titulo_estado);
		$xml->addTag('id_localidade', $reg->id_localidade);
		$xml->addTag('endereco_localidade', $reg->endereco_localidade);
		$xml->addTag('bairro_localidade', $reg->bairro_localidade);
		$xml->addTag('email_localidade', $reg->email_localidade);
		$xml->addTag('telefone_localidade', $reg->telefone_localidade);
		$xml->addTag('facebook_localidade', $reg->facebook_localidade);
		$xml->addTag('whatsapp_localidade', $reg->whatsapp_localidade);
		$xml->addTag('twitter_localidade', $reg->twitter_localidade);
		$xml->addTag('instagram_localidade', $reg->instagram_localidade);
		$xml->addTag('latitude_localidade', $reg->latitude_localidade);
		$xml->addTag('longetude_localidade', $reg->longetude_localidade);
		$xml->closeTag('cidade');
	} else {
		//$erro = 2;
		//$msgerro = 'Produto não encontrado!';
	}
//Fechamento da Tag de Classe
$xml->closeTag('localidades');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>