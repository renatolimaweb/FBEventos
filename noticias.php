<?
include("Connections/criativo.php");
$localidade = anti_invasao('localidade');
$pagina     = anti_invasao('pagina');
include("includes/consulta.php");
$pag_views = 9; //TOTAL DE REGISTROS POR PÁGINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notícias | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?></title>
<meta name="dc.title" content="Notícias | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta name="description" content="<?=$row_busca_config["desc_config"];?>">
<meta name="DC.description" content="<?=$row_busca_config["desc_config"];?>" />
<meta name="keywords" content="<?=$row_busca_config["tags_config"];?>">
<meta name="DC.subject" content="<?=$row_busca_config["tags_config"];?>" />
<link rel="image_src" type="image/jpeg" title="Notícias | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" href="conteudo/img/<?=$row_busca_interfaceweb["open_graph"];?>"/>
<meta content="conteudo/img/<?=$row_busca_interfaceweb["open_graph"];?>" property="twitter:image">
<meta content="<?=$row_busca_config["desc_config"];?>" property="twitter:description">
<meta content="Notícias | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" property="twitter:title">
<meta property="og:title" content="Notícias | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta property="og:site_name" content="<?=$row_busca_config["titulo_config"];?>"/>
<meta property="og:description" content="<?=$row_busca_config["desc_config"];?>"/>
<meta property="og:image" content="conteudo/img/<?=$row_busca_interfaceweb["open_graph"];?>"/>
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
</head>
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
                                        
			<div class="section">
                <h1 class="section-title title">Notícias</h1>
				<div class="row">
                    <?php include("includes/categoriaNoticia.php"); ?>
					<div class="col-sm-9">
						<div id="site-content" class="site-content">
                        
							<div class="row">
							<div class="col-sm-12">
                            
							<div class="left-content">
                                    
                               <div class="section listing-news">

                                <?
                                    $sql = "SELECT * FROM noticia WHERE id_localidade = $localidade OR id_localidade = 0 ORDER BY data_noticia DESC, id_noticia DESC";
                                    $resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
                                    $linhas = mysql_num_rows($resultado); // N&uacute;mero de linha da consulta
                                    $limita = "$sql LIMIT $inicio,$pag_views";
                                    $executa = mysql_query($limita);  //Limitando a sele&ccedil;&atilde;o
                                    $paginas = $linhas / $pag_views; //Calculando o total de p&aacute;ginas
                                    $volta = $pagina - 1; // Valores do Bot&atilde;o Voltar
                                    $proxima = $pagina + 1;  // Valores do Bot&atilde;o Pr&oacute;ximo
                                    while ($linha=mysql_fetch_array($executa)) {
                                    $datatrans = explode ("-", $linha["data_noticia"]); 
                                    $data = "$datatrans[2]/$datatrans[1]/$datatrans[0]";
                                ?>
								<div class="post">
									<div class="entry-header">
										<div class="entry-thumbnail">
                                        <a href="news.php?news=<?=$linha["id_noticia"];?>&localidade=<?=$localidade;?>">
											<img class="img-responsive" src="conteudo/img/<?=$linha["imagem_noticia"];?>" />
										</a>
                                        </div>
									</div>
									<div class="post-content">								
										<div class="entry-meta">
											<ul class="list-inline">
												<li class="publish-date"><a href="#"><i class="fa fa-calendar"></i> <?=$data;?> </a></li>
											</ul>
										</div>
										<h2 class="entry-title">
											<a href="news.php?news=<?=$linha["id_noticia"];?>&localidade=<?=$localidade;?>"><?=$linha["titulo_noticia"];?></a>
										</h2>
										<div class="entry-content">
											<p><?=substr($linha["desc_noticia"],0,140); ?>...</p>
										</div>
									</div>
								</div><!--/post-->
                                <? } ?>
                                
                               </div>
                                    
									</div><!--/.left-content-->
								</div>
								
							</div>
						</div><!--/#site-content-->
                        
                        <div class="pagination-wrapper">
							<ul class="pagination">
                            <?
							//PÁGINAÇÃO//
							For ($i = 0; $i <= $paginas; $i++){
					        $pag =  $i +1;							
					        if ($pag <> $pagina) {
					 			 print "<li><a href=\"$PHP_SELF?pagina=$pag&localidade=$localidade\">$pag</a></li>";
					             } else {
					             print "<li class=\"active\"><a href=\"#\">$pag</a></li>";
					             }
					        }
							//FIM DA PÁGINAÇÃO.//
							?>
							</ul>
						</div>
                        
					</div><!--/.col-sm-9 -->	
					
					
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