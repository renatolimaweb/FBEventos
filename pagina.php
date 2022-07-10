<?
include("Connections/criativo.php");
$localidade = anti_invasao('localidade');
include("includes/consulta.php");
$pagina     = anti_invasao('pagina');
mysql_select_db($database_criativo, $conexao);
$query_busca_pagina = "SELECT * FROM pagina WHERE id_pagina = '$pagina'";
$busca_pagina = mysql_query($query_busca_pagina, $conexao) or die(mysql_error());
$row_busca_pagina = mysql_fetch_assoc($busca_pagina);
$totalRows_busca_pagina = mysql_num_rows($busca_pagina);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$row_busca_pagina["titulo_pagina"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?></title>
<meta name="dc.title" content="<?=$row_busca_pagina["titulo_pagina"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta name="description" content="<?=$row_busca_pagina["desc_pagina"];?>">
<meta name="DC.description" content="<?=$row_busca_pagina["desc_pagina"];?>" />
<meta name="keywords" content="<?=$row_busca_pagina["tags_pagina"];?>">
<meta name="DC.subject" content="<?=$row_busca_pagina["tags_pagina"];?>" />
<link rel="image_src" type="image/jpeg" title="<?=$row_busca_pagina["titulo_pagina"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" href="conteudo/img/<?=$row_busca_pagina["imagem_pagina"];?>"/>
<meta content="conteudo/img/<?=$row_busca_pagina["imagem_pagina"];?>" property="twitter:image">
<meta content="<?=$row_busca_pagina["desc_pagina"];?>" property="twitter:description">
<meta content="<?=$row_busca_pagina["titulo_pagina"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" property="twitter:title">
<meta property="og:title" content="<?=$row_busca_pagina["titulo_pagina"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta property="og:site_name" content="<?=$row_busca_config["titulo_config"];?>"/>
<meta property="og:description" content="<?=$row_busca_pagina["desc_pagina"];?>"/>
<meta property="og:image" content="conteudo/img/<?=$row_busca_pagina["imagem_pagina"];?>"/>
<meta property="og:locale" content="pt_br"/>
<meta property="og:type" content="article" />
<?php include("includes/seo.php"); ?>
<?php include("includes/css.php"); ?>
<?php include("includes/mobile.php"); ?>
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
			
			<!-- publicidade topo internas -->
            <?
            mysql_select_db($database_criativo, $conexao);
            $query_busca_bannerTopoInicial = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 14 AND status_publicidade = 1 ORDER BY RAND()";
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
            <!-- fim publicidade topo internas -->

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
													<h2 class="entry-title">
														<?=$row_busca_pagina["titulo_pagina"];?>
													</h2>
                                                    <hr>
                                                    <?=$row_busca_pagina["texto_pagina"];?>
												</div>
											</div><!--/post--> 
										</div><!--/.section-->
									</div><!--/.left-content-->
								</div>
								
							</div>
						</div><!--/#site-content-->
                        
					</div><!--/.col-sm-9 -->	
					
					<div class="col-sm-3">
						<?php include("includes/sidebar.php"); ?>
					</div>
				</div>				
			</div><!--/.section-->

			<!-- publicidade topo internas -->
            <?
            mysql_select_db($database_criativo, $conexao);
            $query_busca_bannerTopoInicial = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 15 AND status_publicidade = 1 ORDER BY RAND()";
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
            <!-- fim publicidade topo internas -->

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