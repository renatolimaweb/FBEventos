<?php
include("../Connections/criativo.php");
include ("../Connections/seguranca_cms.php");

$pagina = $_REQUEST['pagina'];
$pag_views = 12; //TOTAL DE REGISTROS POR P?GINA//
if (!$pagina) {
   $pagina = 1;
} else {
   $pagina = $pagina;
}
$mat = $pagina - 1; 
$inicio = $mat * $pag_views;
?>
<!doctype html>
<html class="fixed">
	<head>
        <meta charset="iso-8859-1">
		<title>Publicidade | FestasBrasil | Clouds | Sistema Gerenciador</title>
        <link rel="shortcut icon" href="img/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		<script src="assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include("includes/topo.php"); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include("includes/menu.php"); ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Publicidades</h2>
					</header>

					<!-- start: page -->

					<section class="panel">
						<div class="panel-body" style="padding-bottom:0;">
                        <form action="<?php echo $editFormAction; ?>" method="get" name="form1" class="search-line block" role="form">
							<div class="input-group mb-md">
						     <input name="pesquisa" value="<?PHP echo $descpesquisa;?>" type="text" placeholder="Pesquise por titulo..." class="form-control">
                             <input name="tp" type="hidden" id="tp" value="<?=$tipo_conteudo?>" />
                             <input type="hidden" name="Consulta" value="form1">
							 <span class="input-group-btn">
							  <button class="btn btn-primary" type="button">Pesquisar</button>
							 </span>
							</div>
                        </form>    
						</div>
					</section>
                    
                    <section class="panel">
						<div class="panel-body" style="padding-bottom:0;">
							<div class="input-group mb-md">
                             <a href="ControlePublicidade.php?tp=<?=$tipo_conteudo;?>"><span class="btn btn-lg btn-success"><i class="fa fa-check"></i> Cadastrar</span></a>
							</div>
						</div>
					</section>
                    
                    <?
				if ($_REQUEST["Consulta"] != "") {
					$descpesquisa = $_REQUEST['pesquisa'];
					    if ($categoria_usuario_autentica == 1) {
						$sql = "SELECT * FROM publicidade, localidade, estado WHERE (titulo_pagina like '%$descpesquisa%') AND publicidade.id_localidade = localidade.id_localidade AND localidade.id_estado = estado.id_estado ORDER BY titulo_publicidade DESC";
						}
						if ($categoria_usuario_autentica <> 1) {
						$sql = "SELECT * FROM publicidade, localidade, estado WHERE (titulo_pagina like '%$descpesquisa%') AND publicidade.id_localidade = localidade.id_localidade AND localidade.id_estado = estado.id_estado AND publicidade.id_localidade = $localidade_usuario_autentica ORDER BY titulo_publicidade DESC";	
						}
				} else { 
				    
					if ($_REQUEST['Del'] == "del") {
						$codigo = $_REQUEST['codigo'];
						$sql = "DELETE FROM publicidade WHERE id_publicidade = '$codigo'";
						$resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
					}
					    if ($categoria_usuario_autentica == 1) {
						$sql = "SELECT * FROM publicidade, localidade, estado WHERE publicidade.id_localidade = localidade.id_localidade AND localidade.id_estado = estado.id_estado ORDER BY id_publicidade DESC";
						}
						if ($categoria_usuario_autentica <> 1) {
					    $sql = "SELECT * FROM publicidade, localidade, estado WHERE publicidade.id_localidade = localidade.id_localidade AND localidade.id_estado = estado.id_estado AND publicidade.id_localidade = $localidade_usuario_autentica ORDER BY id_publicidade DESC";
						}
				}
		
				$resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
				$linhas = mysql_num_rows($resultado); //NUMERO DE LINHAS DA CONSULTA.//
				$limita = "$sql LIMIT $inicio,$pag_views";
				$executa = mysql_query($limita);  //LIMITANDO//
				$paginas = $linhas / $pag_views; //CALCULANDO O TOTAL DE P?GINAS.//
				$volta = $pagina - 1; //VALORES DO BOT?O VOLTAR.//
				$proxima = $pagina + 1;  //VALORES DO BOT?O PR?XIMO.//
				while ($linha=mysql_fetch_array($executa)) {
				
				$codigo 			= $linha["id_publicidade"];
				$titulo	        	= $linha["titulo_publicidade"];
				$imagem	            = $linha["imagem_publicidade"];
				$localidade	        = $linha["titulo_localidade"];
				$estado	            = $linha["titulo_estado"];
				$status             = $linha["status_publicidade"];
				
				?>
                             <section class="panel">
									<div class="panel-body pt-none pl-sm pr-sm pb-none">
                                    <div class="row">
                                    <div class="col-md-3">
                                    <? if ($imagem){ ?>
                                    <img src="../conteudo/img/<?=$imagem;?>" class="img-responsive mt-sm mb-sm" alt="<?=$titulo;?>">
                                    <? } ?>
                                    </div>
                                    <div class="col-md-9 pt-sm pb-sm">
                                        <p class="pull-right">
                                         <a href="ControlePublicidade.php?cod=<?=$codigo;?>" title="Editar"><span class="btn btn-warning"><i class="fa fa-pencil-square"></i></span></a>
                                         <a href="ConsultaPublicidade.php?Del=del&amp;codigo=<?=$codigo?>" onclick="return confirm('Deseja excluir ?')" title="Excluir"><span class="btn btn-danger"><i class="fa fa-trash-o"></i></span></a>
                                        </p>
                                        <p class="pt-sm"><i class="fa fa-database"></i> #<?=$codigo;?></p>
										<h4 class="text-semibold mt-none pt-none"><?=$titulo;?></h4>
                                        <p class="col-md-12 p-none"><i class="fa fa-map-marker"></i> <?=$localidade;?> - <?=$estado;?></p>
                                        <p>
                                        <? if($status == 1){ ?>
                                        <span class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i> ATIVO</span>
                                        <? } ?>
                                        <? if($status == 2){ ?>
                                        <span class="btn btn-sm btn-default"><i class="fa fa-minus-circle"></i> INATIVO</span>
                                        <? } ?>
                                        </p>
									</div>
                                   </div>
                                   </div>
					         </section>
                             
                             <hr>
                             <? } ?>
                             
                             <section class="panel">
						      <div class="panel-body" style="padding-bottom:0;">
							   <div class="input-group mb-md">
                                <div class="btn-group">
                                <?
		//P?GINA??O//
		For ($i = 0; $i <= $paginas; $i++){
		$pag =  $i +1;							
		if ($pag <> $pagina) {
		echo "<a href=$PHP_SELF?pagina=$pag><span class=\"btn btn-default\">$pag</span></a>";
		} else {
		echo "<a href=\"#\"><span class=\"btn btn-primary\">$pag</span></a>";
		}
		}
		//FIM DA P?GINA??O.//
		?>
                                    </div>
							   </div>
						      </div>
					         </section>

					<!-- end: page -->
				</section>
			</div>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>
<?php include("../Connections/end_criativo.php"); ?>