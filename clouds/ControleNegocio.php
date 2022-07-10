<?
include("../Connections/criativo.php");
include("../Connections/seguranca_cms.php");
//COMANDO CONTROLE//
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "controle")) {
  $arquivo = isset($_FILES["imagem_negocio"]) ? $_FILES["imagem_negocio"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $nome_arquivo = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$nome_arquivo;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
  }
  
  $insertSQL = sprintf("INSERT INTO negocio (id_localidade, id_categoria_negocio, titulo_negocio, desc_negocio, tags_negocio, imagem_negocio, status_negocio) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_localidade'], "int"),
					   GetSQLValueString($_POST['id_categoria_negocio'], "int"),
					   GetSQLValueString($_POST['titulo_negocio'],"text"),
					   GetSQLValueString($_POST['desc_negocio'],"text"),
					   GetSQLValueString($_POST['tags_negocio'],"text"),
					   GetSQLValueString($nome_arquivo, "text"),
					   GetSQLValueString($_POST['status_negocio'],"int"));
  
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Realizado com sucesso");
		location.href="ConsultaNegocio.php";
	</script>
	<?
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "controle")) {
  $arquivo = isset($_FILES["imagem_negocio"]) ? $_FILES["imagem_negocio"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $nome_arquivo = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$nome_arquivo;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 

	 $apagar = "../conteudo/img/".$_POST["imagem_negocio_original"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	 
  } else {
	  $nome_arquivo = $_POST["imagem_negocio_original"];
  }
  
  $updateSQL = sprintf("UPDATE negocio SET id_localidade=%s, id_categoria_negocio=%s, titulo_negocio=%s, desc_negocio=%s, tags_negocio=%s, imagem_negocio=%s, status_negocio=%s WHERE id_negocio=%s",
                       GetSQLValueString($_POST['id_localidade'], "int"),
					   GetSQLValueString($_POST['id_categoria_negocio'], "int"),
					   GetSQLValueString($_POST['titulo_negocio'],"text"),
					   GetSQLValueString($_POST['desc_negocio'],"text"),
					   GetSQLValueString($_POST['tags_negocio'],"text"),
					   GetSQLValueString($nome_arquivo, "text"),
					   GetSQLValueString($_POST['status_negocio'],"int"),
					   GetSQLValueString($_POST['id_negocio'], "int"));
					   
					   
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Atualizado com Sucesso");
		location.href="ConsultaNegocio.php";
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
	$query_busca_dados = sprintf("SELECT * FROM negocio WHERE id_negocio = %s", GetSQLValueString($colname_busca_dados, "int"));
	$busca_dados = mysql_query($query_busca_dados) or die(mysql_error());
	$row_busca_dados = mysql_fetch_assoc($busca_dados);
	$totalRows_busca_dados = mysql_num_rows($busca_dados);
	$operacao = "MM_update";
	$botao = "<button type=\"submit\" class=\"btn btn-primary btn-lg mr-md\" value=\"Cadastrar\"><i class=\"fa fa-check\"></i> Atualizar</button>";
	$preco = $row_busca_dados["preco_anuncio"];
}
mysql_select_db($database_criativo, $conexao);
$query_busca_categoria_negocio = "SELECT * FROM categoria_negocio ORDER BY titulo_categoria_negocio ASC";
$busca_categoria_negocio = mysql_query($query_busca_categoria_negocio, $conexao) or die(mysql_error());
$row_busca_categoria_negocio = mysql_fetch_assoc($busca_categoria_negocio);
$totalRows_busca_categoria_negocio = mysql_num_rows($busca_categoria_negocio);

mysql_select_db($database_criativo, $conexao);
$query_busca_localidade = "SELECT localidade.id_localidade, localidade.titulo_localidade, localidade.id_estado, estado.id_estado, estado.titulo_estado FROM localidade, estado WHERE localidade.id_estado = estado.id_estado ORDER BY titulo_localidade ASC";
$busca_localidade = mysql_query($query_busca_localidade, $conexao) or die(mysql_error());
$row_busca_localidade = mysql_fetch_assoc($busca_localidade);
$totalRows_busca_localidade = mysql_num_rows($busca_localidade);

//FIM DO COMANDO CONTROLE//
?>
<!doctype html>
<html class="fixed">
	<head>
        <meta charset="iso-8859-1">
		<title>FestasBrasil | Controle de Neg�cios | Clouds | Sistema Gerenciador</title>
        <link rel="shortcut icon" href="img/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
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
						<h2>Controle de Neg�cios</h2>
					</header>

					<!-- start: page -->
                    <div class="panel-body">
					<form method="post" name="controle" class="form-horizontal" role="form" action="<?php echo $editFormAction; ?>" onSubmit="return checkForm(this)" ENCTYPE="multipart/form-data">
                    
                    <? if($categoria_usuario_autentica == 1) { ?>
                                            <div class="form-group">
												<label class="col-md-3 control-label">Localidade</label>
												<div class="col-md-6">
													<select id="id_localidade" name="id_localidade" data-plugin-selectTwo class="form-control populate placeholder">
             <option value="">Selecione a Localidade</option>
                    <?php
                    do {  
                    ?><option value="<?php echo $row_busca_localidade['id_localidade']?>"<?php if (!(strcmp($row_busca_localidade['id_localidade'], $row_busca_dados['id_localidade']))) {echo "selected=\"selected\"";} ?>><?php echo $row_busca_localidade['titulo_localidade']?> - <?php echo $row_busca_localidade['titulo_estado']?></option>
                                           <?php
                    } while ($row_busca_localidade = mysql_fetch_assoc($busca_localidade));
                      $rows = mysql_num_rows($busca_localidade);
                      if($rows > 0) {
                          mysql_data_seek($busca_localidade, 0);
                          $row_busca_localidade = mysql_fetch_assoc($busca_localidade);
                      }
                    ?> 
													</select>
												</div>
											</div>
                     <? } ?>
                     <? if($categoria_usuario_autentica <> 1) { ?>
                     <input name="id_localidade" id="id_localidade" type="hidden" value="<?php echo $localidade_usuario_autentica;?>">
                     <? } ?>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label">Categoria</label>
												<div class="col-md-6">
													<select id="id_categoria_negocio" name="id_categoria_negocio" data-plugin-selectTwo class="form-control populate placeholder" placeholder="Selecione a Categoria">
                                                    <option value=""></option>
             <?php
                    do {  
                    ?><option value="<?php echo $row_busca_categoria_negocio['id_categoria_negocio']?>"<?php if (!(strcmp($row_busca_categoria_negocio['id_categoria_negocio'], $row_busca_dados['id_categoria_negocio']))) {echo "selected=\"selected\"";} ?>><?php echo $row_busca_categoria_negocio['titulo_categoria_negocio']?></option>
                                           <?php
                    } while ($row_busca_categoria_negocio = mysql_fetch_assoc($busca_categoria_negocio));
                      $rows = mysql_num_rows($busca_categoria_negocio);
                      if($rows > 0) {
                          mysql_data_seek($busca_categoria_negocio, 0);
                          $row_busca_categoria_negocio = mysql_fetch_assoc($busca_categoria_negocio);
                      }
                    ?> 
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">T&iacute;tulo</label>
												<div class="col-md-6">
													<input name="titulo_negocio" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="200" value="<?=$row_busca_dados["titulo_negocio"];?>" required>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Descri&ccedil;&atilde;o</label>
												<div class="col-md-6">
													<textarea id="desc_negocio" name="desc_negocio" class="form-control" rows="3" data-plugin-maxlength maxlength="240"><?=$row_busca_dados["desc_negocio"];?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="tags-input" class="col-md-3 control-label">Tags</label>
												<div class="col-md-6">
													<input name="tags_negocio" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" value="<?=$row_busca_dados["tags_negocio"];?>" />
													<p>palavras-chave para mecanismos de busca externos e internos.</p>
												</div>
											</div>
											<div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["imagem_negocio"]) { ?>
                                             <p>Pr�-Visualiza��o:</p>
                                             <img class="img-responsive" src="../conteudo/img/<?=$row_busca_dados["imagem_negocio"];?>" border="0" />
											 <? } ?>
                                             </div>
                                            </div>
											<div class="form-group">
												<label class="col-md-3 control-label">Imagem de Exibi&ccedil;&atilde;o Principal</label>
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
																<input id="imagem_negocio" name="imagem_negocio" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
											</div>
                                            
                                            <div class="form-group">
                                             <label class="col-md-3 control-label">Status</label>
                                             <div class="col-md-9">
                                              <div class="switch switch-sm switch-success">
											  <input id="status_negocio" name="status_negocio" value="1" type="checkbox" name="switch" data-plugin-ios-switch <?php if (!(strcmp(1, $row_busca_dados['status_negocio']))) {echo "checked=\"checked\"";} else{ echo ""; } ?>/>
                                              </div>
											 </div>
                                            </div>
                                            <div class="form-group">
                                             <div class="pull-right">
                                              <?=$botao;?>
                                             </div>
                                            </div>
                                            <input type="hidden" name="<?=$operacao;?>" value="controle" />
      <input name="imagem_negocio_original" type="hidden" id="imagem_negocio_original" value="<?=$row_busca_dados["imagem_negocio"];?>" />
      <input name="id_negocio" type="hidden" id="id_negocio" value="<?=$row_busca_dados["id_negocio"];?>" />
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