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
    $rs = mysql_query("SELECT * FROM interface_web WHERE id_interface = '1' LIMIT 0,1");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->openTag('web');
		$xml->addTag('favicon', $reg->favicon);
		$xml->addTag('google_analytics', $reg->google_analytics);
		$xml->addTag('scripts_head', $reg->scripts_head);
		$xml->addTag('open_graph', $reg->open_graph);
		$xml->closeTag('web');
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