<?php
include("../Connections/criativo.php");
include ("../Connections/seguranca_cms.php");

$inicio			   = $_REQUEST['inicio'];
if (!$inicio) {
   $inicio = 1;
}
$pagina 		   = $_REQUEST['pagina'];
if (!$pagina) {
   $pagina = 1;
}

$fim			   = $_REQUEST['fim'];
if (!$fim) {
   $fim = 20;
}

if (isset($_REQUEST['evento'])) {
  $colname_busca_evento = $_REQUEST['evento'];
}
mysql_select_db($database_criativo, $conexao);
$query_busca_evento = sprintf("SELECT * FROM evento WHERE id_evento = %s", GetSQLValueString($colname_busca_evento, "int"));
$busca_evento = mysql_query($query_busca_evento, $conexao) or die(mysql_error());
$row_busca_evento = mysql_fetch_assoc($busca_evento);
$totalRows_busca_evento = mysql_num_rows($busca_evento);
$pasta = $row_busca_evento["pasta_evento"];
?>
<!doctype html>
<html class="fixed">
	<head>
        <meta charset="iso-8859-1">
		<title>Galerias de Fotos | FestasBrasil | Clouds | Sistema Gerenciador</title>
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
						<h2>Galerias de Fotos</h2>
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
                             <a href="ControleItemEvento.php?evento=<?=$colname_busca_evento;?>"><span class="btn btn-lg btn-success"><i class="fa fa-image"></i> Enviar + Imagens</span></a>
							</div>
						</div>
					</section>
                    
                             <section class="panel">
									<div class="panel-body pt-none pl-sm pr-sm pb-none">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <div class="table-responsive pb-lg pt-lg">
              <table class="table-responsive">
                
                <tbody>
                <?PHP
				if ($_REQUEST['Del'] == "del") {
					$imagem = $_REQUEST['imagem'];
					$arquivo = "../imagensGaleria/".$pasta."/".$imagem;
					if (is_file($arquivo)) {
						unlink($arquivo);
					}
				}
				?>
      <tr>
        <?
				$ponteiro  = opendir("../imagensGaleria/".$pasta);
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
			   ?>
        <td height="20" class="Texto_Negrito_10_borda" align="center"><img style="padding:10px;" src="../imagensGaleria/<?=$pasta?>/<?=$listar;?>" width="160" height="100" border="0" /><br />
          <br />
          <a class="btn-danger btn" href="ConsultaItemEvento.php?Del=del&amp;imagem=<?=$listar?>&amp;evento=<?=$colname_busca_evento;?>" onclick="return confirm('Deseja excluir ?')">Excluir</a>
          </td>
        <?
					$conta++;
					if ($conta > 4) {
						print "</tr>";
						print "<tr>";
						$conta = 0;
					}
                 }
                }
                ?>
      </tr>
                </tbody>
              </table>
            </div>
                                    </div>
                                    </div>
                                   </div>
					         </section>
                             
                             <hr>
                             
                             <section class="panel">
						      <div class="panel-body" style="padding-bottom:0;">
							   <div class="input-group mb-md">
                                <div class="btn-group">
                                <?PHP
					    $quantidade_pagina      = ($total_itens / 20); 
						$reg_inicio = 1;
						$reg_fim    = $reg_inicio + (20 - 1);
						for ($i = 0; $i <= $quantidade_pagina; $i++){ 
							$pag =  $i + 1;
							
							if ($pag != $pagina) {
								print "<a href=$PHP_SELF?pagina=$pag&inicio=$reg_inicio&fim=$reg_fim&evento=$colname_busca_evento><span class=\"btn btn-default\">$pag</span></a>";
							} else {
								print "<a href=\"#\"><span class=\"btn btn-primary\">$pag</span></a>";
							}
							
							$reg_inicio = $reg_fim + 1;
							$reg_fim = $reg_inicio + (20 - 1);
						}
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