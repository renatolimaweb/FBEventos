<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
//$localidade = anti_invasao('localidade');
//Abertura da Tag de Classe
$xml->openTag('parametros');
//Consulta SQL
    $rs = mysql_query("SELECT * FROM config WHERE id_config = '1' LIMIT 0,1");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->openTag('configuracao');
		$xml->addTag('titulo_config', $reg->titulo_config);
		$xml->addTag('email_config', $reg->email_config);
		$xml->addTag('cep_config', $reg->cep_config);
		$xml->addTag('telefone_config', $reg->telefone_config);
		$xml->addTag('titulo_config', $reg->titulo_config);
		$xml->addTag('desc_config', $reg->desc_config);
		$xml->addTag('tags_config', $reg->tags_config);
		$xml->addTag('cidade_config', $reg->cidade_config);
		$xml->addTag('estado_config', $reg->estado_config);
		$xml->addTag('endereco_config', $reg->endereco_config);
		$xml->closeTag('configuracao');
	} else {
		//$erro = 2;
		//$msgerro = 'Produto não encontrado!';
	}
//Fechamento da Tag de Classe
$xml->closeTag('parametros');
//Gerador do XML
echo $xml;
require_once("../Connections/end_criativo.php");
?>