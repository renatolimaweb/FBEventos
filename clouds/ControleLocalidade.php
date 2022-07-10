<?
include("../Connections/criativo.php");
include("../Connections/seguranca_cms.php");
//COMANDO CONTROLE//
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "controle")) {
  
  $insertSQL = sprintf("INSERT INTO localidade (id_estado, titulo_localidade, endereco_localidade, bairro_localidade, email_localidade, telefone_localidade, facebook_localidade, twitter_localidade, instagram_localidade, whatsapp_localidade, latitude_localidade, longetude_localidade, status_localidade) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
					   GetSQLValueString($_POST['id_estado'],"int"),
					   GetSQLValueString($_POST['titulo_localidade'],"text"),
					   GetSQLValueString($_POST['endereco_localidade'],"text"),
					   GetSQLValueString($_POST['bairro_localidade'],"text"),
					   GetSQLValueString($_POST['email_localidade'],"text"),
					   GetSQLValueString($_POST['telefone_localidade'],"text"),
					   GetSQLValueString($_POST['facebook_localidade'],"text"),
					   GetSQLValueString($_POST['twitter_localidade'],"text"),
					   GetSQLValueString($_POST['instagram_localidade'],"text"),
					   GetSQLValueString($_POST['whatsapp_localidade'],"text"),
					   GetSQLValueString($_POST['latitude_localidade'],"text"),
					   GetSQLValueString($_POST['longetude_localidade'],"text"),
					   GetSQLValueString($_POST['status_localidade'],"int"));
  
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Realizado com sucesso");
		location.href="ConsultaLocalidade.php";
	</script>
	<?
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "controle")) {
  
  $updateSQL = sprintf("UPDATE localidade SET id_estado=%s, titulo_localidade=%s, endereco_localidade=%s, bairro_localidade=%s, email_localidade=%s, telefone_localidade=%s, facebook_localidade=%s, twitter_localidade=%s, instagram_localidade=%s, whatsapp_localidade=%s, latitude_localidade=%s, longetude_localidade=%s, status_localidade=%s WHERE id_localidade=%s",
                       GetSQLValueString($_POST['id_estado'],"text"),
					   GetSQLValueString($_POST['titulo_localidade'],"text"),
					   GetSQLValueString($_POST['endereco_localidade'],"text"),
					   GetSQLValueString($_POST['bairro_localidade'],"text"),
					   GetSQLValueString($_POST['email_localidade'],"text"),
					   GetSQLValueString($_POST['telefone_localidade'],"text"),
					   GetSQLValueString($_POST['facebook_localidade'],"text"),
					   GetSQLValueString($_POST['twitter_localidade'],"text"),
					   GetSQLValueString($_POST['instagram_localidade'],"text"),
					   GetSQLValueString($_POST['whatsapp_localidade'],"text"),
					   GetSQLValueString($_POST['latitude_localidade'],"text"),
					   GetSQLValueString($_POST['longetude_localidade'],"text"),
					   GetSQLValueString($_POST['status_localidade'],"int"),
					   GetSQLValueString($_POST['id_localidade'], "int"));
					   
					   
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Atualizado com Sucesso");
		location.href="ConsultaLocalidade.php";
	</script>
	<?
}

$operacao = "MM_insert";
$botao = "<button type=\"submit\" class=\"btn btn-success btn-lg mr-md\" value=\"Cadastrar\"><i class=\"fa fa-check\"></i> Cadastrar</button>";

if (isset($_GET['cod'])) {
  $colname_busca_dados = $_GET['cod'];
}
mysql_select_db($database_criativo, $conexao);
if ($colname_busca_dados) {
	$query_busca_dados = sprintf("SELECT * FROM localidade WHERE id_localidade = %s", GetSQLValueString($colname_busca_dados, "int"));
	$busca_dados = mysql_query($query_busca_dados) or die(mysql_error());
	$row_busca_dados = mysql_fetch_assoc($busca_dados);
	$totalRows_busca_dados = mysql_num_rows($busca_dados);
	$operacao = "MM_update";
	$botao = "<button type=\"submit\" class=\"btn btn-primary btn-lg mr-md\" value=\"Cadastrar\"><i class=\"fa fa-check\"></i> Atualizar</button>";
}
//FIM DO COMANDO CONTROLE//
mysql_select_db($database_criativo, $conexao);
$query_busca_estado = "SELECT * FROM estado ORDER BY titulo_estado ASC";
$busca_estado = mysql_query($query_busca_estado, $conexao) or die(mysql_error());
$row_busca_estado = mysql_fetch_assoc($busca_estado);
$totalRows_busca_estado = mysql_num_rows($busca_estado);
?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
        <meta charset="iso-8859-1">

		<title>Controle de Localidades | FestasBrasil | Clouds | Sistema Gerenciador</title>
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
						<h2>Controle de Localidades</h2>
					</header>

					<!-- start: page -->
                    <div class="panel-body">
					<form method="post" name="controle" class="form-horizontal" role="form" action="<?php echo $editFormAction; ?>" onSubmit="return checkForm(this)" ENCTYPE="multipart/form-data">
                    
                    
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label">Estado</label>
												<div class="col-md-6">
													<select id="id_estado" name="id_estado" data-plugin-selectTwo class="form-control populate placeholder">
             <option value=""></option>
             <?php
                    do {  
                    ?><option value="<?php echo $row_busca_estado['id_estado']?>"<?php if (!(strcmp($row_busca_estado['id_estado'], $row_busca_dados['id_estado']))) {echo "selected=\"selected\"";} ?>><?php echo $row_busca_estado['titulo_estado']?></option>
                                           <?php
                    } while ($row_busca_estado = mysql_fetch_assoc($busca_estado));
                      $rows = mysql_num_rows($busca_estado);
                      if($rows > 0) {
                          mysql_data_seek($busca_estado, 0);
                          $row_busca_estado = mysql_fetch_assoc($busca_estado);
                      }
                    ?> 
													</select>
												</div>
											</div>
                                            
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Título</label>
												<div class="col-md-6">
													<input name="titulo_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["titulo_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Endereço</label>
												<div class="col-md-6">
													<input name="endereco_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["endereco_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Bairro</label>
												<div class="col-md-6">
													<input name="bairro_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["bairro_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">E-mail</label>
												<div class="col-md-6">
													<input name="email_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["email_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Telefone</label>
												<div class="col-md-6">
													<input name="telefone_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["telefone_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Facebook</label>
												<div class="col-md-6">
													<input name="facebook_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["facebook_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Twitter</label>
												<div class="col-md-6">
													<input name="twitter_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["twitter_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Instagram</label>
												<div class="col-md-6">
													<input name="instagram_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["instagram_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">WhatsApp</label>
												<div class="col-md-6">
													<input name="whatsapp_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["whatsapp_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Latetude</label>
												<div class="col-md-6">
													<input name="latitude_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["latitude_localidade"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Longetude</label>
												<div class="col-md-6">
													<input name="longetude_localidade" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="240" value="<?=$row_busca_dados["longetude_localidade"];?>" required>
												</div>
											</div>
                                            
                                            
                                            
                                            <div class="form-group">
                                             <label class="col-md-3 control-label">Status</label>
                                             <div class="col-md-9">
                                              <div class="switch switch-sm switch-success">
											  <input id="status_localidade" name="status_localidade" value="1" type="checkbox" name="switch" data-plugin-ios-switch <?php if (!(strcmp(1, $row_busca_dados['status_localidade']))) {echo "checked=\"checked\"";} else{ echo ""; } ?>/>
                                              </div>
											 </div>
                                            </div>
                                            <div class="form-group">
                                             <div class="pull-right">
                                              <?=$botao;?>
                                             </div>
                                            </div>
                                            <input type="hidden" name="<?=$operacao;?>" value="controle" />
      <input name="id_localidade" type="hidden" id="id_localidade" value="<?=$row_busca_dados["id_localidade"];?>" />
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