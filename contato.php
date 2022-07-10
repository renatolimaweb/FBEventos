<?
include("Connections/criativo.php");
$localidade = anti_invasao('localidade');
include("includes/consulta.php");

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$inserir = anti_invasao("MM_insert");
if (isset($inserir) && $inserir == "form1") {
	$nome 	  		 = anti_invasao('nome');
	$assunto	  	 = anti_invasao('assunto');
	$email	  		 = anti_invasao('email');
	$texto    		 = anti_invasao('mensagem');
	$email_empresa 	 = anti_invasao('email_empresa');
	$data_hora		 = date("d/m/Y - H:i:s");
	
	$destinatario = $email_empresa;
	$assunto = $assunto;
	$remetente = $email;
	$data_envio = date("d/m/Y");
	$headers = "From: $remetente";
	$msg   = "Data do Envio: $data_hora \n";
	$msg  .= "Nome: $nome \n";
	$msg  .= "Mensagem: ". $texto;
	
	mail($destinatario, $assunto, $msg, $headers) or die ("Impossivel enviar email!");	
	?>
	<SCRIPT language="JavaScript">
		alert("Sua Mensagem foi enviada com sucesso!");
		location.href="contato.php";
	</script>
	<?
}

$codigoLocalidade = $row_busca_localidade["id_localidade"];
$enderecoLocalidade = $row_busca_localidade["endereco_localidade"];
$bairroLocalidade = $row_busca_localidade["bairro_localidade"];
$emailLocalidade = $row_busca_localidade["email_localidade"];
$telefoneLocalidade = $row_busca_localidade["telefone_localidade"];
$facebookLocalidade = $row_busca_localidade["facebook_localidade"];
$whatsappLocalidade = $row_busca_localidade["whatsapp_localidade"];
$twitterLocalidade = $row_busca_localidade["twitter_localidade"];
$instagramLocalidade = $row_busca_localidade["instagram_localidade"];
$latitudeLocalidade = $row_busca_localidade["latitude_localidade"];
$longetudeLocalidade = $row_busca_localidade["longetude_localidade"];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fale Conosco | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?></title>
<meta name="dc.title" content="Fale Conosco | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
<meta name="description" content="<?=$row_busca_config["desc_config"];?>">
<meta name="DC.description" content="<?=$row_busca_config["desc_config"];?>" />
<meta name="keywords" content="<?=$row_busca_config["tags_config"];?>">
<meta name="DC.subject" content="<?=$row_busca_config["tags_config"];?>" />
<link rel="image_src" type="image/jpeg" title="Fale Conosco | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" href="conteudo/img/<?=$row_busca_interfaceweb["open_graph"];?>"/>
<meta content="conteudo/img/<?=$row_busca_interfaceweb["open_graph"];?>" property="twitter:image">
<meta content="<?=$row_busca_config["desc_config"];?>" property="twitter:description">
<meta content="Fale Conosco | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>" property="twitter:title">
<meta property="og:title" content="Fale Conosco | <?=$row_busca_config["titulo_config"];?> | <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?>"/>
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
					<div class="col-md-9">
					<div class="contact-us">
						
						<div class="contact-info">	
							<h1 class="section-title title">Informações de Localização</h1>
							<ul class="list-inline">
								<li>
									<h2>Contato Localidade</h2>
									<address>
										<p><i class="fa fa-map-marker" style="min-width:15px;"></i><?=$enderecoLocalidade;?> <br><?=$bairroLocalidade;?> - <?=$row_busca_localidade["titulo_localidade"];?> - <?=$row_busca_localidade["titulo_estado"];?></p>
										<p><i class="fa fa-envelope" style="min-width:15px;"></i> <a href="#"><?=$emailLocalidade;?></a></p>
										<p><i class="fa fa-phone" style="min-width:15px;"></i> <?=$telefoneLocalidade;?></p>
									</address>
								</li>
                                <li>
									<h2>Redes Socias</h2>
									<address>
										<p><i class="fa fa-facebook" style="min-width:15px;"></i> <a href="#"><?=$facebookLocalidade;?></a></p>
										<p><i class="fa fa-twitter" style="min-width:15px;"></i> <a href="#"><?=$twitterLocalidade;?></a></p>
										<p><i class="fa fa-instagram" style="min-width:15px;"></i> <a href="#"><?=$instagramLocalidade;?></a></p>
                                        <p><i class="fa fa-whatsapp" style="min-width:15px;"></i> <a href="#"><?=$whatsappLocalidade;?></a></p>
									</address>
								</li>
                                <li>
									<h2>Matriz</h2>
									<address>
										<p><i class="fa fa-map-marker" style="min-width:15px;"></i> <?=$row_busca_config["endereco_config"];?> <br><?=$row_busca_config["bairro_config"];?> - <?=$row_busca_config["cidade_config"];?> - <?=$row_busca_config["estado_config"];?></p>
										<p><i class="fa fa-envelope" style="min-width:15px;"></i> <a href="#"><?=$row_busca_config["email_config"];?></a></p>
										<p><i class="fa fa-phone" style="min-width:15px;"></i> <?=$row_busca_config["telefone_config"];?></p>
									</address>
								</li>
							</ul>
						</div>
						<div class="message-box">
							<h1 class="section-title title">Formulário de Contato</h1>
							<form id="comment-form" name="formcontato" method="post" action="<?php echo $editFormAction; ?>">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label for="name">Nome</label>
											<input type="text" name="nome" class="form-control" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="email">E-mail</label>
											<input type="email" name="email" class="form-control" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="subject">Assunto</label>
											<input type="assunto" name="assunto" class="form-control">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="comment" >Mensagem</label>
											<textarea name="mensagem" id="mensagem" required class="form-control" rows="5"></textarea>
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-primary">Enviar Mensagem</button>
										</div>
									</div>
								</div>
                                <input id="email_empresa" name="email_empresa" type="hidden" value="<?=$row_busca_config["email_config"];?>" />
                                <input name="MM_insert" type="hidden" value="form1"/>
							</form>
						</div>
					</div><!-- contact-us -->
                    <h1 class="section-title title">Localização</h1>
                    <div class="map-section">
						<div id="gmap"></div>
					</div>
				</div>	
					
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
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  	<script type="text/javascript" src="js/gmaps.js"></script>
    <script type="text/javascript">
		(function(){

			var map;

			map = new GMaps({
				el: '#gmap',
				lat: <?=$latitudeLocalidade;?>,
				lng: <?=$longetudeLocalidade;?>,
				scrollwheel:false,
				zoom: 16,
				zoomControl : true,
				panControl : false,
				streetViewControl : false,
				mapTypeControl: false,
				overviewMapControl: false,
				clickable: false
			});

			var image = '';
			map.addMarker({
				lat: <?=$latitudeLocalidade;?>,
				lng: <?=$longetudeLocalidade;?>,
				icon: image,
				animation: google.maps.Animation.DROP,
				verticalAlign: 'bottom',
				horizontalAlign: 'center',
				backgroundColor: '#d3cfcf',
				 infoWindow: {
					content: '<div class="map-info"><address><?=$enderecoLocalidade;?><br /><?=$bairroLocalidade;?> <br /><?=$titulo_localidade;?> - <?=$titulo_estado;?></address></div>',
					borderColor: 'red',
				}
			});
			  
			var styles = [ 

				{
				  "featureType": "road",
				  "stylers": [
					{ "color": "#c1c1c1" }
				  ]
				  },{
				  "featureType": "water",
				  "stylers": [
					{ "color": "#f1f1f1" }
				  ]
				  },{
				  "featureType": "landscape",
				  "stylers": [
					{ "color": "#e3e3e3" }
				  ]
				  },{
				  "elementType": "labels.text.fill",
				  "stylers": [
					{ "color": "#808080" }
				  ]
				  },{
				  "featureType": "poi",
				  "stylers": [
					{ "color": "#dddddd" }
				  ]
				  },{
				  "elementType": "labels.text",
				  "stylers": [
					{ "saturation": 1 },
					{ "weight": 0.1 },
					{ "color": "#7f8080" }
				  ]
				}
		  
			];

		map.addStyle({
				styledMapName:"Styled Map",
				styles: styles,
				mapTypeId: "map_style"  
			});

			map.setStyle("map_style");
		}());
	</script>
    <!-- .Scripts -->
</body>
</html>