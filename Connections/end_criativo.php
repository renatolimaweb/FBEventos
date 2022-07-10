<?
if ($conexao) {
	mysql_close($conexao);
}
if ($busca_config) {
	mysql_free_result($busca_config);
}
if ($busca_interfaceweb) {
	mysql_free_result($busca_interfaceweb);
}
if ($busca_interfacemovel) {
	mysql_free_result($busca_interfacemovel);
}
if ($busca_localidade) {
	mysql_free_result($busca_localidade);
}
if ($resultado) {
	mysql_free_result($resultado);
}
if ($resultado_agenda) {
	mysql_free_result($resultado_agenda);
}
if ($resultado_categoria_evento) {
	mysql_free_result($resultado_categoria_evento);
}
if ($resultado_noticia) {
	mysql_free_result($resultado_noticia);
}
if ($resultado_categoria_negocio) {
	mysql_free_result($resultado_categoria_negocio);
}
if ($resultado_categoria_noticia) {
	mysql_free_result($resultado_categoria_noticia);
}
if ($resultado_evento) {
	mysql_free_result($resultado_evento);
}
if ($resultado_publicidade) {
	mysql_free_result($resultado_publicidade);
}
if ($resultado_pagina) {
	mysql_free_result($resultado_pagina);
}
if ($busca_agenda) {
	mysql_free_result($busca_agenda);
}
if ($busca_publicidade) {
	mysql_free_result($busca_publicidade);
}
if ($busca_noticia) {
	mysql_free_result($busca_noticia);
}
if ($busca_pagina) {
	mysql_free_result($busca_pagina);
}
if ($busca_categoria) {
	mysql_free_result($busca_categoria);
}
if ($busca_evento) {
	mysql_free_result($busca_evento);
}
?>