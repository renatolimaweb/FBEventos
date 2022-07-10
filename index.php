<?
require_once('Connections/sentinela.php');
require_once("includes/webserviceparametronulo.php");

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$inserir = anti_invasao("MM_insert");
if (isset($inserir) && $inserir == "form1") {
	$nome 	  		 = anti_invasao('nome');
	$assunto	  	 = anti_invasao('assunto');
	$email	  		 = anti_invasao('email');
	$telefone	     = anti_invasao('telefone');
	$whatsapp	     = anti_invasao('whatsapp');
	$skype	         = anti_invasao('skype');
	$cidade    		 = anti_invasao('cidade');
	$estado    		 = anti_invasao('estado');
	$email_empresa 	 = anti_invasao('email_empresa');
	$data_hora		 = date("d/m/Y - H:i:s");
	
	$destinatario = $email_empresa;
	$assunto = $assunto;
	$remetente = $email;
	$data_envio = date("d/m/Y");
	$headers = "From: $remetente";
	$msg   = "Data do Envio: $data_hora \n";
	$msg  .= "Nome: $nome \n";
	$msg  .= "E-mail: $email \n";
	$msg  .= "Cidade: $cidade \n";
	$msg  .= "Estado: $estado \n";
	$msg  .= "Telefone: $telefone \n";
	$msg  .= "WhatsApp: $whatsapp \n";
	$msg  .= "Skype: ". $skype;
	
	mail($destinatario, $assunto, $msg, $headers) or die ("Impossivel enviar email!");	
	?>
	<SCRIPT language="JavaScript">
		alert("Seus dados Foram enviados! Em breve entraremos em contato.");
		location.href="index.php";
	</script>
	<?
	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$xmlConfiguracao->configuracao->titulo_config;?></title>
<meta name="dc.title" content="<?=$xmlConfiguracao->configuracao->titulo_config;?>"/>
<meta name="description" content="<?=$xmlConfiguracao->configuracao->desc_config;?>">
<meta name="DC.description" content="<?=$xmlConfiguracao->configuracao->desc_config;?>" />
<meta name="keywords" content="<?=$xmlConfiguracao->configuracao->tags_config;?>">
<meta name="DC.subject" content="<?=$xmlConfiguracao->configuracao->tags_config;?>" />
<link rel="image_src" type="image/jpeg" title="<?=$xmlConfiguracao->configuracao->titulo_config;?>" href="conteudo/img/<?=$xmlInterfaceWeb->web->open_graph;?>"/>
<meta content="conteudo/img/<?=$xmlInterfaceWeb->web->open_graph;?>" property="twitter:image">
<meta content="<?=$xmlConfiguracao->configuracao->desc_config;?>" property="twitter:description">
<meta content="<?=$xmlConfiguracao->configuracao->titulo_config;?>" property="twitter:title">
<meta property="og:title" content="<?=$xmlConfiguracao->configuracao->titulo_config;?>"/>
<meta property="og:site_name" content="<?=$xmlConfiguracao->configuracao->titulo_config;?>"/>
<meta property="og:description" content="<?=$xmlConfiguracao->configuracao->desc_config;?>"/>
<meta property="og:image" content="conteudo/img/<?=$xmlInterfaceWeb->web->open_graph;?>"/>
<meta property="og:locale" content="pt_br"/>
<meta property="og:type" content="article" />
<?php include("includes/seo.php"); ?>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700">
<link href="entrada/css/bootstrap.css" rel="stylesheet">
<link href="entrada/css/font-awesome.min.css" rel="stylesheet">
<link href="entrada/css/owl.carousel.css" rel="stylesheet">
<link href="entrada/css/magic.min.css" rel="stylesheet">		
<link href="entrada/css/style.css" rel="stylesheet">
<!--Color Scheme -->
<link rel="stylesheet" type="text/css" id="color" href="entrada/css/colors/color2.css"/>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
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

       <!-- PRELOADER-->
		<div id="preloader">
			<div id="status"><svg class="circular" viewBox="25 25 50 50">
			  <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
			</svg></div>
		</div> 
		
		<!-- END PRELOADER -->

        <div id="overlay"></div>
        <div class="col-md-6 content-column-background"></div>
        <div class="col-md-6 content-column">                
            <!-- Header starts -->
            <div class="content-inner">
				 <!-- Header -->
                 <style type="text/css">
		@media (min-width: 1210px) {
		.mapaBrasil{
			max-width:400px;
		}
		}
		@media (max-width: 980px){
		.parceiro {
			min-height:90px;
		}
		.parceiro img{
			margin-left:auto;
			margin-right:auto;
		}
		}
		@media (min-width: 981px){
		.parceiro {
			min-height:60px;
		}
		.parceiro img{
			margin-top:auto;
			margin-bottom:auto;
			margin-left:auto;
			margin-right:auto;
		}
		}
		@media (max-width: 479px){
		.textoMenu {
			font-size:12px;
			text-transform:uppercase;
			float:left;
			font-weight:400;
			color:#B75942;
			padding-left:5px;
			padding-right:5px;
			margin-top:25px;
			padding-bottom:10px;
		}
		}
		@media (min-width: 480px){
		.textoMenu {
			text-transform:uppercase;
			float:left;
			font-size:22px;
			font-weight:400;
			color:#B75942;
			padding-left:20px;
			padding-right:20px;
			margin-top:15px;
			padding-bottom:10px;
		}
		}
        </style>
                <header class="banner">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="nav-container">
                            <div class="textoMenu">Escolha sua Localidade&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-right"></i></div>
                                <div class="nav-handle"><i class="fa fa-map-marker"></i></div>
                                <nav role="navigation">
                                    <ul role="menu">
                                    <?
                    $j = 0;
	        while ($j < count( $xmlTodasLocalidades )) {
                    ?>
                                        <li><a href="inicial.php?localidade=<?=$xmlTodasLocalidades->localidade[$j]->id_localidade;?>"><?=$xmlTodasLocalidades->localidade[$j]->titulo_localidade;?> - <?=$xmlTodasLocalidades->localidade[$j]->titulo_estado;?></a></li>
                                        <? $j++; } ?>
                                    </ul>
                                </nav>
                            </div><!--nav-container -->
                            
                        </div>
                    </div>
                </header>
                <!-- Header ends -->

                <!-- Left column content starts -->
				<div class="row">
					<div class="clearfix">
						<section>
							<div class="col-xs-12">
							<img style="margin-left:auto; margin-right:auto;" src="entrada/images/logo-entrada.png" class="img-responsive">
							</div>
						</section>
					</div>
				</div>
            </div>
			
            <!-- Footer starts -->
            <footer class="contentinfo clearfix">
            <p style="font-size:12px;">Parceiros</p>
                <div class="row">
                    <!--
                    <div class="col-md-4 parceiro">
                    <img class="img-responsive" src="entrada/images/logo-qpreco.png">
                    </div>
                    -->
                    <!--
                    <div class="col-md-4 parceiro">
                    <img class="img-responsive" src="entrada/images/logo-inegocio.png">
                    </div>
                    -->
                    <!--
                    <div class="col-md-4 parceiro">
                    <img class="img-responsive" src="entrada/images/logo-guiapvh.png">
                    </div>
                    -->
                    <!--
                    <div class="col-md-4 parceiro">
                    <img class="img-responsive" src="entrada/images/logo-tem-negocio.png">
                    </div>
                    -->
                    <div class="col-md-4 parceiro">
                    <a target="_blank" href="http://www.neerd.com.br"><img class="img-responsive" src="entrada/images/logo-neerd.png"></a>
                    </div>
                    <!--
                    <div class="col-md-4 parceiro">
                    <a target="_blank" href="http://www.gentepop.com.br"><img class="img-responsive" src="entrada/images/logo-gentepop.png"></a>
                    </div>
                    -->
              </div>
            </footer>
            <!-- Footer ends -->
        </div>
		
		<div class="col-md-6 cbox">
				<div class="row">
					<div class="col-xs-12 text-center">
                    <h4 style="text-shadow: 2px 2px 4px #000000;">Eventos</h4>
				    <img src="entrada/images/mapa-brasil.png" style="margin-left:auto; margin-right:auto;" class="img-responsive mapaBrasil">
                    </div>
                    <button style="margin-top:20px;" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;Seja um Representante</button>
			   </div>
        </div>
	   <!-- Right column content ends -->
        <!-- Scripts -->
        <script src="entrada/js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="entrada/js/jquery-migrate-1.2.1.min.js"></script>
		<script src="entrada/js/jquery.easing.1.3.js"></script>
		<script src="entrada/js/jquery.lwtCountdown-1.0.js"></script>
		<script src="entrada/js/jquery.backstretch.min.js"></script>
        <script src="entrada/js/owl.carousel.min.js"></script>
        <script src="entrada/js/bootstrap.min.js"></script>
        <!--[if lte IE 9]>
		    <script src="js/jquery.placeholder.js"></script>
		    <script type="text/javascript">$('input, textarea').placeholder();</script>
	    <![endif]-->
        <script src="entrada/js/script.js"></script>
		<script type="text/javascript" src="entrada/js/switcher.js"></script>
		<script>
			$(document).ready(function () {
				"use strict";
				// Background images slider
				// Duration is the amount of time in between slides,
				// and fade is value that determines how quickly the next image will fade in
				$.backstretch([
				  "entrada/images/Background.jpg"
				  ,"entrada/images/Background2.jpg"
				],
				{ duration: 8000, fade: 800 });
				
				$(".owl-carousel").owlCarousel({		 
			navigation: false,
			pagination:true, 
			slideSpeed : 300,
			autoPlay : 5000,
			singleItem:true	 
		});
			});
		</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel" style="color:#333;">Formulário de Representante</h4>
            </div>
            <div class="modal-body">
            <form name="formcontato" method="post" action="<?php echo $editFormAction; ?>">
            <div class="row">
             <div class="col-md-12">
             <div class="form-group">
              <input class="col-md-12" name="nome" type="text" placeholder="*Nome:" required>
             </div>
             </div>
            </div> 
            <div class="row">
             <div class="col-md-12">
             <div class="form-group">
              <input class="col-md-12" name="telefone" type="text" placeholder="*Telefone:" required>
             </div>
             </div>
            </div>
            <div class="row">
             <div class="col-md-6">
             <div class="form-group">
              <input class="col-md-12" name="whatsapp" type="text" placeholder="WhatsApp:">
             </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
              <input class="col-md-12" name="skype" type="text" placeholder="Skype:">
             </div>
             </div>
            </div>
            <div class="row">
             <div class="col-md-12">
              <div class="form-group">
               <input class="col-md-12" name="email" type="text" placeholder="*E-mail:" required>
              </div>
             </div>
            </div>
            <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <input class="col-md-12" name="cidade" type="text" placeholder="*Cidade:" required>
             </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <input class="col-md-12" name="estado" type="text" placeholder="*Estado:" required>
             </div>
            </div>
            </div>
            <p>*Campos Obrigatórios</p>
            <input id="email_empresa" name="email_empresa" type="hidden" value="<?=$xmlConfiguracao->configuracao->email_config;?>" />
            <input id="assunto" name="assunto" type="hidden" value="Solicitação de Representação FestasBrasil" />
            <input name="MM_insert" type="hidden" value="form1"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
        </div>
    </div>
</div>
    </body>
</html>