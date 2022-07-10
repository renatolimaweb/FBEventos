<?php
include("../Connections/criativo.php");
include ("../Connections/seguranca_cms.php");

$pagina = $_REQUEST['pagina'];
$pag_views = 12; //TOTAL DE REGISTROS POR P�GINA//
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
		<title>Usu�rios | FestasBrasil | Clouds | Sistema Gerenciador</title>
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
						<h2>Usu�rios</h2>
					</header>

					<!-- start: page -->

					<section class="panel">
						<div class="panel-body" style="padding-bottom:0;">
                        <form action="<?php echo $editFormAction; ?>" method="get" name="form1" class="search-line block" role="form">
							<div class="input-group mb-md">
						     <input name="pesquisa" value="<?PHP echo $descpesquisa;?>" type="text" placeholder="Pesquise por titulo, categoria, data..." class="form-control">
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
                             <a href="ControleUsuario.php?tp=<?=$tipo_conteudo;?>"><span class="btn btn-lg btn-success"><i class="fa fa-check"></i> Cadastrar</span></a>
							</div>
						</div>
					</section>
                    
                    <?
				if ($_REQUEST["Consulta"] != "") {
					$descpesquisa = $_REQUEST['pesquisa'];
						$sql = "SELECT * FROM usuarios, categoria_usuario WHERE (usuarios.nome_usuario like '%$descpesquisa%' OR categoria_usuario.titulo_categoria_usuario like '%$descpesquisa%' OR usuarios.email_usuario like '%$descpesquisa%') AND usuarios.id_categoria_usuario = categoria_usuario.id_categoria_usuario ORDER BY id_usuario DESC";
				} else { 
				    
					if ($_REQUEST['Del'] == "del") {
						$codigo = $_REQUEST['codigo'];
						$sql = "DELETE FROM usuarios WHERE id_usuario = '$codigo'";
						$resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
					}
						$sql = "SELECT * FROM usuarios, categoria_usuario WHERE usuarios.id_categoria_usuario = categoria_usuario.id_categoria_usuario ORDER BY id_usuario DESC";
				}
		
				$resultado = mysql_query($sql) or die ("N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados");
				$linhas = mysql_num_rows($resultado); //NUMERO DE LINHAS DA CONSULTA.//
				$limita = "$sql LIMIT $inicio,$pag_views";
				$executa = mysql_query($limita);  //LIMITANDO//
				$paginas = $linhas / $pag_views; //CALCULANDO O TOTAL DE P�GINAS.//
				$volta = $pagina - 1; //VALORES DO BOT�O VOLTAR.//
				$proxima = $pagina + 1;  //VALORES DO BOT�O PR�XIMO.//
				while ($linha=mysql_fetch_array($executa)) {
				
				$codigo 			= $linha["id_usuario"];
				$titulo	        	= $linha["nome_usuario"];
				$categoria          = $linha["titulo_categoria_usuario"];
				$email              = $linha["email_usuario"];
				$telefone           = $linha["telefone"];
				$imagem             = $linha["imagem_usuario"];
				$status             = $linha["status_usuario"];
				$hora               = $linha["hora_cad_usuario"];
				$data	    	    = $linha["data_cad_usuario"];
				$datatrans = explode ("-", $data); 
				$data = "$datatrans[2]/$datatrans[1]/$datatrans[0]"; 
				
				?>
                             <section class="panel">
									<div class="panel-body pt-none pl-sm pr-sm pb-none">
                                    <div class="row">
                                    <div class="col-md-3">
                                    <img src="../conteudo/img/<?=$imagem;?>" class="img-responsive mt-sm mb-sm" alt="<?=$titulo;?>">
                                    </div>
                                    <div class="col-md-9 pt-sm pb-sm">
                                        <p class="pull-right pt-sm">
                                         <a href="ControleUsuario.php?cod=<?=$codigo;?>" title="Editar"><span class="btn btn-warning"><i class="fa fa-pencil-square"></i></span></a>
                                         <a href="ConsultaUsuario.php?Del=del&amp;codigo=<?=$codigo?>" onclick="return confirm('Deseja excluir ?')" title="Excluir"><span class="btn btn-danger"><i class="fa fa-trash-o"></i></span></a>
                                        </p>
                                        <p class="pt-sm"><i class="fa fa-database"></i> #<?=$codigo;?> | <i class="fa fa-calendar"></i> <?=$data;?> | <i class="fa fa-clock-o"></i> <?=$hora;?></p>
										<h4 class="text-semibold mt-none pt-none"><?=$titulo;?></h4>
										<p class="mb-none"><i class="fa fa-tags"></i> <?=$categoria;?></p>
                                        <p class="mt-none"><i class="fa fa-envelope"></i> <?=$email;?> | <i class="fa fa-phone"></i> <?=$telefone;?></p>
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
		//P�GINA��O//
		For ($i = 0; $i <= $paginas; $i++){
		$pag =  $i +1;							
		if ($pag <> $pagina) {
		echo "<a href=$PHP_SELF?pagina=$pag><span class=\"btn btn-default\">$pag</span></a>";
		} else {
		echo "<a href=\"#\"><span class=\"btn btn-primary\">$pag</span></a>";
		}
		}
		//FIM DA P�GINA��O.//
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