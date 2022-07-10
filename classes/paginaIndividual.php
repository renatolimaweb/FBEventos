<?php
require_once('Xml.Class.php');
require_once('../Connections/criativo.php');
//Método que abra o chamado para um Novo XML
$xml = new Xml();
//Parametro de valores para a consulta
$pagina = anti_invasao('pagina');
//Abertura da Tag de Classe
$xml->openTag('pagina');
//Consulta SQL
    $rs = mysql_query("SELECT * FROM pagina WHERE id_pagina = '$pagina'");
	if(mysql_num_rows($rs) > 0){
		$reg = mysql_fetch_object($rs);
		$xml->addTag('id_pagina', $reg->id_pagina);
	    $xml->addTag('titulo_pagina',   $reg->titulo_pagina);
	    $xml->addTag('desc_pagina',   $reg->desc_pagina);
	    $xml->addTag('tags_pagina',   $reg->tags_pagina);
	    $xml->openString('<![CDATA[');
	    $xml->addTag('texto_pagina',   $reg->texto_pagina);
	    $xml->closeString(']]>');
	    $xml->addTag('imagem_pagina', $reg->imagem_pagina);
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