<?
include("Connections/criativo.php");
$localidade = anti_invasao('localidade');
include("includes/consulta.php");
$evento = anti_invasao('evento');
mysql_select_db($database_criativo, $conexao);
$query_busca_evento = "SELECT * FROM evento, negocio, localidade, estado WHERE evento.id_negocio = negocio.id_negocio AND negocio.id_localidade = localidade.id_localidade AND localidade.id_estado = estado.id_estado AND evento.id_evento = '$evento'";
$busca_evento = mysql_query($query_busca_evento, $conexao) or die(mysql_error());
$row_busca_evento = mysql_fetch_assoc($busca_evento);
$totalRows_busca_evento = mysql_num_rows($busca_evento);

$datatrans = explode ("-", $row_busca_evento["data_evento"]); 
$data = "$datatrans[2]/$datatrans[1]/$datatrans[0]"; 
$pasta = $row_busca_evento["pasta_evento"];

/*
$inicio			   = anti_invasao('inicio');
if (!$inicio) {
   $inicio = 1;
}
$pagina 		   = anti_invasao('pagina');
if (!$pagina) {
   $pagina = 1;
}
$fim			   = anti_invasao('fim');
if (!$fim) {
   $fim = 5;
}
*/

if (!$pagina) {
   $pagina = 1;
}


$ponteiro  = opendir("imagensGaleria/".$pasta);
$total_itens=1;
while ($nome_itens = readdir($ponteiro)) {
	$itens[] = $nome_itens;
	$total_itens++;
}
sort($itens);

$QuantidadeImagens = $total_itens - 3;
$QuantidadePaginas = $QuantidadeImagens / 5;


$inicio = (($pagina-1)  * 5) + 1;
$fim    = $inicio + (5 - 1);

$local_foto 			= "";
$contador = 0;
$foto = array();
$nome_foto_compra = array();
													
for ($i = $inicio; $i <= $fim; $i++){ 
$foto[$contador] = $local_foto."/(".$i.").jpg";
$nome_foto_compra[$contador] = "(".$i.").jpg";
$contador++;
}
$totFotos = sizeof($foto);

if (!$inicial) {
   $inicial = 1;
}

if ($inicial > 1) {
	$anterior = $inicial;
	$inicial_anterior = ($anterior - 9);
	
	if ($inicial_anterior <= 0) {
		$inicial_anterior = 1;
	}
				
	$botaoAnterior = "<li><a href=\"http://".$_SERVER['SERVER_NAME']."/album.php?evento=$evento&pagina=$inicial_anterior&localidade=$localidade\" class=\"prevnext\">« anterior</a></li> \n";
}
$paginacao = "";

for ($i = 0; $i <= $QuantidadePaginas; $i++){ 
	$pag =  $i + 1;
	 if ($pag >= $inicial) {
		 $cont++;
		 if ($cont > $QuantidadePaginas) {
			 $botaoProximo = ".. <li><a href=\"http://".$_SERVER['SERVER_NAME']."/album.php?evento=$evento&pagina=$pag\"> de $QuantidadePaginas</a></li> <li><a href=\"http://".$_SERVER['SERVER_NAME']."/album.php?evento=$evento&pagina=$pag\" class=\"prevnext\">avançar »</a></li> \n";
			 break;
		 }
	
		if ($pag > $QuantidadePaginas) {
			break;
		}	
		if ($pag != $pagina) {
			$paginacao .= "<li><a href=\"http://".$_SERVER['SERVER_NAME']."/album.php?evento=$evento&pagina=$pag&localidade=$localidade\">".str_pad($pag, 3, "0", STR_PAD_LEFT)."</a></li> \n";
		} else {
			$paginacao.= "<li class=\"active\"><a href=\"#\">".str_pad($pag, 3, "0", STR_PAD_LEFT)."</a></li> \n";
		}
	 }
}
if ($QuantidadePaginas < 1) {
	$paginacao = "<li><a href=\"#\">".str_pad(1, 3, "0", STR_PAD_LEFT)."</a></li> \n";
}


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$row_busca_evento["titulo_evento"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?></title>
<meta name="dc.title" content="<?=$row_busca_evento["titulo_evento"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta name="description" content="<?=$row_busca_evento["desc_evento"];?>">
<meta name="DC.description" content="<?=$row_busca_evento["desc_evento"];?>" />
<meta name="keywords" content="<?=$row_busca_evento["tags_evento"];?>">
<meta name="DC.subject" content="<?=$row_busca_evento["tags_evento"];?>" />
<link rel="image_src" type="image/jpeg" title="<?=$row_busca_evento["titulo_evento"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" href="imagensGaleria/<?=$row_busca_evento["imagem_evento"];?>"/>
<meta content="imagensGaleria/<?=$row_busca_evento["imagem_evento"];?>" property="twitter:image">
<meta content="<?=$row_busca_evento["desc_evento"];?>" property="twitter:description">
<meta content="<?=$row_busca_evento["titulo_evento"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" property="twitter:title">
<meta property="og:title" content="<?=$row_busca_evento["titulo_evento"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta property="og:site_name" content="<?=$row_busca_config["titulo_config"];?>"/>
<meta property="og:description" content="<?=$row_busca_evento["desc_evento"];?>"/>
<meta property="og:image" content="imagensGaleria/<?=$row_busca_evento["imagem_evento"];?>"/>
<meta property="og:locale" content="pt_br"/>
<meta property="og:type" content="article" />
<?php include("includes/seo.php"); ?>
<?php include("includes/css.php"); ?>
<?php include("includes/mobile.php"); ?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-583525b785d4c985"></script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-6954713288488145",
          enable_page_level_ads: true
     });
</script>
</head><!--/head-->
<body>
<?php include_once("analyticstracking.php") ?>
	<div id="main-wrapper" class="homepage-five" style="background-image:url(img/bg-topo.jpg); background-position:top; background-repeat:no-repeat; background-color:#1B1614;">
    <div style="background-image:url(img/grid.png); background-repeat:repeat;">
		<!-- Topo -->
		<?php include("includes/topo.php"); ?>
		<!-- .Topo -->
		<div class="container">
        	<!-- publicidade topo album -->
            <?
            mysql_select_db($database_criativo, $conexao);
            $query_busca_bannerTopoInicial = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 7 AND status_publicidade = 1 ORDER BY RAND()";
            $busca_bannerTopoInicial = mysql_query($query_busca_bannerTopoInicial, $conexao) or die(mysql_error());
            $row_busca_bannerTopoInicial = mysql_fetch_assoc($busca_bannerTopoInicial);
            $totalRows_busca_bannerTopoInicial = mysql_num_rows($busca_bannerTopoInicial);
            ?>
            <div class="section add inner-add">
      			 <? if ($row_busca_bannerTopoInicial["imagem_publicidade"]) { ?>
      			   <a href="<?=$row_busca_bannerTopoInicial["url_publicidade"];?>" target="_blank"><img class="img-responsive" src="conteudo/img/<?=$row_busca_bannerTopoInicial["imagem_publicidade"];?>" /></a>
             <? } ?>
             <? if ($row_busca_bannerTopoInicial["iframe_publicidade"]) { ?>
      			   <?=$row_busca_bannerTopoInicial["iframe_publicidade"];?>
             <? } ?>
			 </div>
            <!-- fim publicidade topo album -->
        <!--/.section add-->                                
			<div class="section">
				<div class="row">
					<div class="col-sm-9">
						<div id="site-content" class="site-content">
							<div class="row">
								<div class="col-sm-12">
									<div class="left-content">
										<div class="details-news">											
											<div class="post">
												<div class="post-content">								
													<div class="entry-meta">
														<ul class="list-inline">
															<li class="publish-date"><a href="#"><i class="fa fa-calendar"></i> <?=$data;?> </a></li>
														</ul>
													</div>
													<h2 class="entry-title">
														<?=$row_busca_evento["titulo_evento"];?>
													</h2>
                                                    <p><?=$row_busca_evento["titulo_negocio"];?> | <?=$row_busca_evento["titulo_localidade"];?> - <?=$row_busca_evento["titulo_estado"];?></p>
                                                    <p><?=$row_busca_evento["desc_evento"];?></p>
                                                    <hr>
                                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
													<div class="addthis_inline_share_toolbox"></div>
                                                    <hr>
                                                    <?
													/*
													$ponteiro  = opendir("imagensGaleria/".$pasta);
													$total_itens=1;
													while ($nome_itens = readdir($ponteiro)) {
														$itens[] = $nome_itens;
														$total_itens++;
													}
													sort($itens);
													$total_itens = $total_itens - 2;
													$contador = 1;
													foreach ($itens as $listar) {
													 if ($listar !="." && $listar !=".."){ 
														if (!is_dir($listar)) { 
														  if ($contador >= $inicio ) {
															 if ($contador > $fim) {
																break;
															 }
															 $arquivos[]=$listar;
														  }
														  $contador++;
														}
														
													 }
													}
													if ($arquivos != "") {
													foreach($arquivos as $listar){
												    */
													
												   ?>
                                                   <?php 
													  for ($i = 0; $i < $totFotos; $i++){ 
													  echo "<img style=\"margin-bottom:40px\" class=\"img-responsive\" src=\"imagensGaleria/".$pasta.$foto[$i]."\" />";
													  } 
													  ?>
                                                  
												   <? /* }  } */ ?>
												   <hr>
                       
												</div>
											</div><!--/post--> 
										</div><!--/.section-->
									</div><!--/.left-content-->
								</div>
								
							</div>
						</div><!--/#site-content-->
                        
                        <div class="pagination-wrapper">
							<ul class="pagination">
                            <?
							/*
							$quantidade_pagina = ($total_itens / 5);
							$reg_inicio = 1;
							$reg_fim = $reg_inicio + (5 - 1);
							for ($i = 0; $i <= $quantidade_pagina; $i++){ 
								$pag =  $i + 1;
								
								if ($pag != $pagina) {
									print "<li><a href=\"$PHP_SELF?pagina=$pag&inicio=$reg_inicio&fim=$reg_fim&evento=$evento&localidade=$localidade\">$pag</a></li>";
										  
								} else {
									print "<li class=\"active\"><a href=\"#\">$pag</a></li>";
								}
								
								$reg_inicio = $reg_fim + 1;
								$reg_fim = $reg_inicio + (5 - 1);
							}
							*/
							?>
                            <? 
                                echo $paginacao;
                                
                            ?>
							</ul>
						</div>
                        
					</div><!--/.col-sm-9 -->	
					
					<div class="col-sm-3">
						<?php include("includes/sidebarAlbum.php"); ?>
					</div>
				</div>				
			</div><!--/.section-->

			<!-- publicidade rodape album -->
            <?
            mysql_select_db($database_criativo, $conexao);
            $query_busca_bannerTopoInicial = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 8 AND status_publicidade = 1 ORDER BY RAND()";
            $busca_bannerTopoInicial = mysql_query($query_busca_bannerTopoInicial, $conexao) or die(mysql_error());
            $row_busca_bannerTopoInicial = mysql_fetch_assoc($busca_bannerTopoInicial);
            $totalRows_busca_bannerTopoInicial = mysql_num_rows($busca_bannerTopoInicial);
            ?>
            <div class="section add inner-add">
      			 <? if ($row_busca_bannerTopoInicial["imagem_publicidade"]) { ?>
      			   <a href="<?=$row_busca_bannerTopoInicial["url_publicidade"];?>" target="_blank"><img class="img-responsive" src="conteudo/img/<?=$row_busca_bannerTopoInicial["imagem_publicidade"];?>" /></a>
             <? } ?>
             <? if ($row_busca_bannerTopoInicial["iframe_publicidade"]) { ?>
      			   <?=$row_busca_bannerTopoInicial["iframe_publicidade"];?>
             <? } ?>
			 </div>
            <!-- fim publicidade rodape album -->
        
		</div><!--/.container-->
        </div>
		<!-- Rodapé -->
		<?php include("includes/rodape.php"); ?>
        <!-- Fim Rodapé -->
	</div>
    <!-- Scripts --> 
    <?php include("includes/scripts.php"); ?>
    <!-- .Scripts -->
</body>
</html>
<?php include("Connections/end_criativo.php"); ?>