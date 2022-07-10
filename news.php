<?
include("Connections/criativo.php");
$localidade = anti_invasao('localidade');
include("includes/consulta.php");
$news       = anti_invasao('news');
mysql_select_db($database_criativo, $conexao);
$query_busca_noticia = "SELECT * FROM noticia WHERE id_noticia = '$news'";
$busca_noticia = mysql_query($query_busca_noticia, $conexao) or die(mysql_error());
$row_busca_noticia = mysql_fetch_assoc($busca_noticia);
$totalRows_busca_noticia = mysql_num_rows($busca_noticia);

$datatrans = explode ("-", $row_busca_noticia["data_noticia"]); 
$data = "$datatrans[2]/$datatrans[1]/$datatrans[0]"; 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$row_busca_noticia["titulo_noticia"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?></title>
<meta name="dc.title" content="<?=$row_busca_noticia["titulo_noticia"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta name="description" content="<?=$row_busca_noticia["desc_noticia"];?>">
<meta name="DC.description" content="<?=$row_busca_noticia["desc_noticia"];?>" />
<meta name="keywords" content="<?=$row_busca_noticia["tags_noticia"];?>">
<meta name="DC.subject" content="<?=$row_busca_noticia["tags_noticia"];?>" />
<link rel="image_src" type="image/jpeg" title="<?=$row_busca_noticia["titulo_noticia"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" href="conteudo/img/<?=$row_busca_noticia["imagem_noticia"];?>"/>
<meta content="conteudo/img/<?=$row_busca_noticia["imagem_noticia"];?>" property="twitter:image">
<meta content="<?=$row_busca_noticia["desc_noticia"];?>" property="twitter:description">
<meta content="<?=$row_busca_noticia["titulo_noticia"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" property="twitter:title">
<meta property="og:title" content="<?=$row_busca_noticia["titulo_noticia"];?> | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta property="og:site_name" content="<?=$row_busca_config["titulo_config"];?>"/>
<meta property="og:description" content="<?=$row_busca_noticia["desc_noticia"];?>"/>
<meta property="og:image" content="conteudo/img/<?=$row_busca_noticia["imagem_noticia"];?>"/>
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
        	<!-- publicidade topo news -->
            <?
			/*
            mysql_select_db($database_criativo, $conexao);
            $query_busca_bannerTopoInicial = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 12 AND status_publicidade = 1 ORDER BY RAND()";
            $busca_bannerTopoInicial = mysql_query($query_busca_bannerTopoInicial, $conexao) or die(mysql_error());
            $row_busca_bannerTopoInicial = mysql_fetch_assoc($busca_bannerTopoInicial);
            $totalRows_busca_bannerTopoInicial = mysql_num_rows($busca_bannerTopoInicial);
			*/
            ?>
            <div class="section add inner-add">
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- PÁGINA DE NOTÍCIAS FESTASBRASIL -->
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-client="ca-pub-6954713288488145"
					 data-ad-slot="1662278293"
					 data-ad-format="auto"
					 data-full-width-responsive="true"></ins>
				<script>
					 (adsbygoogle = window.adsbygoogle || []).push({});
				</script>
      			 <? /* if ($row_busca_bannerTopoInicial["imagem_publicidade"]) { ?>
      			   <a href="<?=$row_busca_bannerTopoInicial["url_publicidade"];?>" target="_blank"><img class="img-responsive" src="conteudo/img/<?=$row_busca_bannerTopoInicial["imagem_publicidade"];?>" /></a>
             <? }*/ ?>
             <? /* if ($row_busca_bannerTopoInicial["iframe_publicidade"]) { ?>
      			   <?=$row_busca_bannerTopoInicial["iframe_publicidade"];?>
             <? } */ ?>
			 </div>
            <!-- fim publicidade topo news -->
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
														<?=$row_busca_noticia["titulo_noticia"];?>
													</h2>
                                                    <hr>
                                                    <?=$row_busca_noticia["texto_noticia"];?>
												</div>
											</div><!--/post--> 
										</div><!--/.section-->
									</div><!--/.left-content-->
								</div>
								
							</div>
						</div><!--/#site-content-->
                        
					</div><!--/.col-sm-9 -->	
					
					<div class="col-sm-3">
						<?php include("includes/sidebarNoticia.php"); ?>
					</div>
				</div>				
			</div><!--/.section-->

			<!-- publicidade rodape news -->
            <?
			/*
            mysql_select_db($database_criativo, $conexao);
            $query_busca_bannerTopoInicial = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 13 AND status_publicidade = 1 ORDER BY RAND()";
            $busca_bannerTopoInicial = mysql_query($query_busca_bannerTopoInicial, $conexao) or die(mysql_error());
            $row_busca_bannerTopoInicial = mysql_fetch_assoc($busca_bannerTopoInicial);
            $totalRows_busca_bannerTopoInicial = mysql_num_rows($busca_bannerTopoInicial);
			*/
            ?>
            <div class="section add inner-add">
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-format="autorelaxed"
					 data-ad-client="ca-pub-6954713288488145"
					 data-ad-slot="8612304805"></ins>
				<script>
					 (adsbygoogle = window.adsbygoogle || []).push({});
				</script>
      			 <? /* if ($row_busca_bannerTopoInicial["imagem_publicidade"]) { ?>
      			   <a href="<?=$row_busca_bannerTopoInicial["url_publicidade"];?>" target="_blank"><img class="img-responsive" src="conteudo/img/<?=$row_busca_bannerTopoInicial["imagem_publicidade"];?>" /></a>
             <? } */ ?>
             <? /* if ($row_busca_bannerTopoInicial["iframe_publicidade"]) { ?>
      			   <?=$row_busca_bannerTopoInicial["iframe_publicidade"];?>
             <? } */ ?>
			 </div>
            <!-- fim publicidade rodape news -->

		</div><!--/.container-->
        </div>
		<!-- RodapÃ© -->
		<?php include("includes/rodape.php"); ?>
        <!-- Fim RodapÃ© -->
	</div>
    <!-- Scripts --> 
    <?php include("includes/scripts.php"); ?>
    <!-- .Scripts -->
</body>
</html>
<?php include("Connections/end_criativo.php"); ?>