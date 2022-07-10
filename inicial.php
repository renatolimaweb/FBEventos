<?
include("Connections/criativo.php");
$localidade = anti_invasao('localidade');
include("includes/consulta.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?></title>
<meta name="dc.title" content="<?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta name="description" content="<?=$row_busca_config["desc_config"];?>">
<meta name="DC.description" content="<?=$row_busca_config["desc_config"];?>" />
<meta name="keywords" content="<?=$row_busca_config["tags_config"];?>">
<meta name="DC.subject" content="<?=$row_busca_config["tags_config"];?>" />
<link rel="image_src" type="image/jpeg" title="<?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" href="conteudo/img/<?=$row_busca_interfaceweb["open_graph"];?>"/>
<meta content="conteudo/img/<?=$row_busca_interfaceweb["open_graph"];?>" property="twitter:image">
<meta content="<?=$row_busca_config["desc_config"];?>" property="twitter:description">
<meta content="<?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" property="twitter:title">
<meta property="og:title" content="<?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
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
        <!-- Conteúdo Destaque -->
        <div class="section">

            <!-- publicidade topo pagina inicial -->
            <div id="home-slider6">
            <?
				
              $sql_banner = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 1 AND status_publicidade = 1 ORDER BY RAND() LIMIT 0,5";
              $resultado_banner = mysql_query($sql_banner) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
              while($linha_banner=mysql_fetch_array($resultado_banner)) {
			  
            ?>
            <div class="section add inner-add">
				
      			 <? if ($linha_banner["imagem_publicidade"]) { ?>
      			   <a href="<?=$linha_banner["url_publicidade"];?>" target="_blank"><img class="img-responsive" src="conteudo/img/<?=$linha_banner["imagem_publicidade"];?>" /></a>
             <? }  ?>
             <? if ($linha_banner["iframe_publicidade"]) { ?>
      			   <?=$linha_banner["iframe_publicidade"];?>
             <? } ?>
			      </div>
            <? }  ?>
            </div>
           <!-- fim publicidade topo pagina inicial -->
				<div class="row">
					<div class="site-content col-md-9">
						<div class="row">
							
              <div class="col-sm-4">
                <!-- destaque esquerda -->
								<?php include("includes/destaque.php"); ?>
                <!-- fim destaque esquerda -->
							</div>
							
              <div class="col-sm-4">
                <!-- central destaque -->
								<?php include("includes/lateral_destaque.php"); ?>
							  <!-- fim central destaque -->
              </div>
              
              <div class="col-sm-4">
                <!-- destaque direita -->
								<?php include("includes/destaque2.php"); ?>
                <!-- fim destaque direita -->
							</div>

						</div>
						
            <div class="row">
							<?php include("includes/noticias_destaque.php"); ?>
						</div>
            
					</div> 
					
					<div class="col-md-3 visible-md visible-lg">

            <!-- publicidade destaque coluna pagina inicial -->
            <div id="home-slider5">
            <?
              $sql_banner = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 3 AND status_publicidade = 1 ORDER BY RAND() LIMIT 0,5";
              $resultado_banner = mysql_query($sql_banner) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
              while($linha_banner=mysql_fetch_array($resultado_banner)) {
            ?>
            <div class="section add inner-add" style="margin-top:10px;">
             <? if ($linha_banner["imagem_publicidade"]) { ?>
               <a href="<?=$linha_banner["url_publicidade"];?>" target="_blank"><img class="img-responsive" src="conteudo/img/<?=$linha_banner["imagem_publicidade"];?>" /></a>
             <? } ?>
             <? if ($linha_banner["iframe_publicidade"]) { ?>
               <?=$linha_banner["iframe_publicidade"];?>
             <? } ?>
            </div>
            <? } ?>
            </div>
            <!-- fim publicidade destaque coluna pagina inicial -->
                     
					</div>
                    
				</div>
			</div>
            <!-- .Conteúdo Destaque -->
		</div>

	
		<div class="container">

            <!-- publicidade abaixo destaque pagina inicial -->
            <div id="home-slider3">
              <?
              $sql_banner = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 4 AND status_publicidade = 1 ORDER BY RAND() LIMIT 0,5";
              $resultado_banner = mysql_query($sql_banner) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
              while($linha_banner=mysql_fetch_array($resultado_banner)) {
              ?>
              <div class="section add inner-add">
                  <? if ($linha_banner["imagem_publicidade"]) { ?>
                    <a href="<?=$linha_banner["url_publicidade"];?>" target="_blank">
                      <img class="img-responsive" src="conteudo/img/<?=$linha_banner["imagem_publicidade"];?>" />
                    </a>
                  <? } ?>
                  <? if ($linha_banner["iframe_publicidade"]) { ?>
                    <?=$linha_banner["iframe_publicidade"];?>
                  <? } ?>
              </div>  
              <? } ?>
            </div>
            <!-- fim publicidade abaixo destaque pagina inicial -->
            
            <div class="section">
             <div class="row">
              <!-- agenda pagina inicial -->
			        <?php include("includes/agenda.php"); ?>
              <!-- fim agenda pagina inicial -->
              <!-- Categoria Esquerda -->
              <?php include("includes/categoriaInicialEsquerda.php"); ?>
              <!-- .Categoria Esquerda -->
              <!-- Categoria Direita -->
              <?php include("includes/categoriaInicialDireita.php"); ?>
              <!-- .Categoria Direita -->
              <!-- Categoria Esquerda Rodapé -->
              <?php include("includes/categoriaInicialEsquerdaRodape.php"); ?>
              <!-- .Categoria Esquerda Rodapé -->
              <?php include("includes/categoriaInicialDireitaRodape.php"); ?>
             </div>
            </div>

            <!-- publicidade rodape pagina inicial -->
            <div id="home-slider4">
            <?
				/*
              $sql_banner = "SELECT * FROM publicidade WHERE (id_localidade = '$localidade' OR id_localidade = 0) AND posicao_publicidade = 2 AND status_publicidade = 1 ORDER BY RAND() LIMIT 0,5";
              $resultado_banner = mysql_query($sql_banner) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
              while($linha_banner=mysql_fetch_array($resultado_banner)) {
			  */
            ?>
            <div class="section add inner-add">
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- P�GINA INICIAL FESTASBRASIL -->
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-client="ca-pub-6954713288488145"
					 data-ad-slot="5986141464"
					 data-ad-format="auto"
					 data-full-width-responsive="true"></ins>
				<script>
					 (adsbygoogle = window.adsbygoogle || []).push({});
				</script>
             <? /* if ($linha_banner["imagem_publicidade"]) { ?>
               <a href="<?=$linha_banner["url_publicidade"];?>" target="_blank">
                <img class="img-responsive" src="conteudo/img/<?=$linha_banner["imagem_publicidade"];?>" />
              </a>
             <? } ?>
             <? if ($linha_banner["iframe_publicidade"]) { ?>
               <?=$linha_banner["iframe_publicidade"];?>
             <? } ?>
            </div>
            <? } */ ?>
            </div>
            <!-- fim publicidade rodape pagina inicial -->
           
        </div>
        </div>
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