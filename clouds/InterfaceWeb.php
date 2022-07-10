<?
//DOCUMENTAÇÃO DO SOFTWARE "CloudS - INTERATIVO | SISTEMAS NA NUVEM"
/*
TODA E QUALQUER DISTRIBUIÇÃO OU ALTERAÇÃO DESSE MÓDULO SEM AUTORIZAÇÃO POR ESCRITO E DOCUMENTADA PODERÁ SER INTERPRETADA COMO QUEBRA DE DIREITO DE PROPRIEDADE INTELECTUAL POR DIREITO DO ANALISTA DE DESENVOLVIMENTO E PROGRAMADOR RENATO NASCIMENTO DE LIMA CEO DA INTERATIVO NEGÓCIOS.

CONTATOS PARA INFORMAÇÕES DE DISTRIBUIÇÃO +55 (69) 9239-5959 / contato@interativo.net
*/
include("../Connections/criativo.php");
include ("../Connections/seguranca_cms.php");
//COMANDO CONTROLE//
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "controle")) {
  $arquivo = isset($_FILES["logo"]) ? $_FILES["logo"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = $arquivo["name"];
	 $extensao = substr($arquivo["name"], $imagem);
     $logo = $imagem;
  	 $imagem_dir = "../conteudo/img/".$logo;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
	 
	 $apagar = "../conteudo/img/".$_POST["logo"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	 
	 
  } else {
	 $logo = $_POST["logo_original"];
  }
  
  $arquivo = isset($_FILES["favicon"]) ? $_FILES["favicon"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = $arquivo["name"];
	 $extensao = substr($arquivo["name"], $imagem);
     $favicon = $imagem;
  	 $imagem_dir = "../conteudo/img/".$favicon;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
	 
	 $apagar = "../conteudo/img/".$_POST["favicon"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	 
	 
  } else {
	 $favicon = $_POST["favicon_original"];
  }
  
  $arquivo = isset($_FILES["open_graph"]) ? $_FILES["open_graph"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = $arquivo["name"];
	 $extensao = substr($arquivo["name"], $imagem);
     $open_graph = $imagem;
  	 $imagem_dir = "../conteudo/img/".$open_graph;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
	 
	 $apagar = "../conteudo/img/".$_POST["open_graph"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	 
	 
  } else {
	 $open_graph = $_POST["open_graph_original"];
  }
	
  $updateSQL = sprintf("UPDATE interface_web SET logo=%s, favicon=%s, open_graph=%s, google_analytics=%s, scripts_head=%s WHERE id_interface=%s",
					   GetSQLValueString($logo, "text"),
					   GetSQLValueString($favicon, "text"),
					   GetSQLValueString($open_graph, "text"),
					   GetSQLValueString($_POST['google_analytics'],"text"),
					   GetSQLValueString($_POST['scripts_head'],"text"),
					   GetSQLValueString($_POST['id_interface'],"int"));
					   
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Atualizado com Sucesso");
		location.href="inicial.php";
	</script>
	<?
}

$operacao = "MM_insert";
$botao = "<button type=\"submit\" class=\"btn btn-primary\">Cadastrar</button>";

if (isset($_GET['cod'])) {
  $colname_busca_dados = $_GET['cod'];
}
mysql_select_db($database_criativo, $conexao);
if ($colname_busca_dados) {
	$query_busca_dados = sprintf("SELECT * FROM interface_web WHERE id_interface = %s", GetSQLValueString($colname_busca_dados, "int"));
	$busca_dados = mysql_query($query_busca_dados) or die(mysql_error());
	$row_busca_dados = mysql_fetch_assoc($busca_dados);
	$totalRows_busca_dados = mysql_num_rows($busca_dados);
	$operacao = "MM_update";
	$botao = "<button type=\"submit\" class=\"btn btn-primary\">Atualizar</button>";
}
//FIM DO COMANDO CONTROLE//
?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
        <meta charset="iso-8859-1">

		<title>Interface Web | FestasBrasil | Clouds | Sistema Gerenciador</title>
        <link rel="shortcut icon" href="img/favicon.ico">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
        
        <!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
        <link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
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
						<h2>Controle de Interface Web</h2>
					</header>

					<!-- start: page -->
                    <div class="panel-body">
					<form method="post" name="controle" class="form-horizontal" role="form" action="<?php echo $editFormAction; ?>" onSubmit="return checkForm(this)" ENCTYPE="multipart/form-data">
                    
                                            <div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["logo"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../conteudo/img/<?=$row_busca_dados["logo"];?>" border="0" />
											 <? } ?>
                                             </div>
                                            </div>
											<div class="form-group">
												<label class="col-md-3 control-label">Logo</label>
												<div class="col-md-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Trocar</span>
																<span class="fileupload-new">Selecionar Arquivo</span>
																<input id="logo" name="logo" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
											</div>
                                            
                                            <div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["favicon"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../conteudo/img/<?=$row_busca_dados["favicon"];?>" border="0" />
											 <? } ?>
                                             </div>
                                            </div>
											<div class="form-group">
												<label class="col-md-3 control-label">Favicon</label>
												<div class="col-md-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Trocar</span>
																<span class="fileupload-new">Selecionar Arquivo</span>
																<input id="favicon" name="favicon" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
											</div>
                                            
                                            <div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["open_graph"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../conteudo/img/<?=$row_busca_dados["open_graph"];?>" border="0" />
											 <? } ?>
                                             </div>
                                            </div>
											<div class="form-group">
												<label class="col-md-3 control-label">Imagem Open Graph</label>
												<div class="col-md-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Trocar</span>
																<span class="fileupload-new">Selecionar Arquivo</span>
																<input id="open_graph" name="open_graph" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Código Google Analytics</label>
												<div class="col-md-6">
													<textarea id="google_analytics" name="google_analytics" class="form-control" rows="3" placeholder="Coloque aqui o Código do Google Analytics"><?=$row_busca_dados["google_analytics"];?></textarea>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Scripts e API Adicionais</label>
												<div class="col-md-6">
													<textarea id="scripts_head" name="scripts_head" class="form-control" rows="3" placeholder="Coloque aqui Códigos de rastreamento robots, verificações de páginas API e demais scripts"><?=$row_busca_dados["scripts_head"];?></textarea>
												</div>
											</div>
					
                                            <div class="form-group">
                                             <div class="pull-right">
                                              <?=$botao;?>
                                             </div>
                                            </div>
                                            <input type="hidden" name="<?=$operacao;?>" value="controle" />
      <input name="logo_original" type="hidden" id="logo_original" value="<?=$row_busca_dados["logo"];?>" />
      <input name="favicon_original" type="hidden" id="favicon_original" value="<?=$row_busca_dados["favicon"];?>" />
      <input name="open_graph_original" type="hidden" id="open_graph_original" value="<?=$row_busca_dados["open_graph"];?>" />
      <input name="id_interface" type="hidden" id="id_interface" value="<?=$row_busca_dados["id_interface"];?>" />
										</form>
									</div>
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
        <script src="assets/vendor/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
        
        <!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>
<?php include("../Connections/end_criativo.php"); ?>