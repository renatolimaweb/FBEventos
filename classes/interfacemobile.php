<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
//$localidade = anti_invasao('localidade');
//Abertura da Tag de Classe
$xml->openTag('interface');
//Consulta SQL
    $rs = mysql_query("SELECT * FROM interface_movel WHERE id_interface_movel = '1' LIMIT 0,1");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->openTag('mobile');
		$xml->addTag('titulo_interface_movel', $reg->titulo_interface_movel);
		$xml->addTag('icone_57x57', $reg->icone_57x57);
		$xml->addTag('icone_60x60', $reg->icone_60x60);
		$xml->addTag('icone_72x72', $reg->icone_72x72);
		$xml->addTag('icone_76x76', $reg->icone_76x76);
		$xml->addTag('icone_114x114', $reg->icone_114x114);
		$xml->addTag('icone_120x120', $reg->icone_120x120);
		$xml->addTag('icone_144x144', $reg->icone_144x144);
		$xml->addTag('icone_152x152', $reg->icone_152x152);
		$xml->addTag('icone_180x180', $reg->icone_180x180);
		$xml->addTag('icone_16x16', $reg->icone_16x16);
		$xml->addTag('icone_32x32', $reg->icone_32x32);
		$xml->addTag('icone_96x96', $reg->icone_96x96);
		$xml->addTag('icone_192x192', $reg->icone_192x192);
		$xml->closeTag('mobile');
	} else {
		//$erro = 2;
		//$msgerro = 'Produto não encontrado!';
	}
//Fechamento da Tag de Classe
$xml->closeTag('interface');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>