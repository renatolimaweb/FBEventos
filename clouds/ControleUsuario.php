<?
include("../Connections/criativo.php");
include("../Connections/seguranca_cms.php");
//COMANDO CONTROLE//
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "controle")) {
  $arquivo = isset($_FILES["imagem_usuario"]) ? $_FILES["imagem_usuario"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $nome_arquivo = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$nome_arquivo;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
  }
  
  $data = substr($_POST['data_cad_usuario'],6,4).'-'.substr($_POST['data_cad_usuario'],3,2).'-'.substr($_POST['data_cad_usuario'],0,2);
  $hora = $_POST["hora_cad_usuario"].":00";
  $insertSQL = sprintf("INSERT INTO usuarios (id_localidade, data_cad_usuario, hora_cad_usuario, id_categoria_usuario, nome_usuario, email_usuario, endereco, bairro, telefone, senha_usuario, imagem_usuario, status_usuario) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_localidade'], "int"),
					   GetSQLValueString($data, "date"),
					   GetSQLValueString($hora, "text"),
					   GetSQLValueString($_POST['id_categoria_usuario'], "int"),
					   GetSQLValueString($_POST['nome_usuario'],"text"),
					   GetSQLValueString($_POST['email_usuario'],"text"),
					   GetSQLValueString($_POST['endereco'],"text"),
					   GetSQLValueString($_POST['bairro'],"text"),
					   GetSQLValueString($_POST['telefone'],"text"),
					   GetSQLValueString($_POST['senha_usuario'],"text"),
					   GetSQLValueString($nome_arquivo, "text"),
					   GetSQLValueString($_POST['status_usuario'],"int"));
  
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Realizado com sucesso");
		location.href="ConsultaUsuario.php";
	</script>
	<?
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "controle")) {
  $arquivo = isset($_FILES["imagem_usuario"]) ? $_FILES["imagem_usuario"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $nome_arquivo = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$nome_arquivo;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
	 
	 $apagar = "../conteudo/img/".$_POST["imagem_usuario_original"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	
  } else {
	  $nome_arquivo = $_POST["imagem_usuario_original"];
  }
  
  
  
  $data = substr($_POST['data_cad_usuario'],6,4).'-'.substr($_POST['data_cad_usuario'],3,2).'-'.substr($_POST['data_cad_usuario'],0,2);
  $hora = $_POST["hora_cad_usuario"].":00";
  $updateSQL = sprintf("UPDATE usuarios SET id_localidade=%s, data_cad_usuario=%s, hora_cad_usuario=%s, id_categoria_usuario=%s, nome_usuario=%s, email_usuario=%s, endereco=%s, bairro=%s, telefone=%s, senha_usuario=%s, imagem_usuario=%s, status_usuario=%s WHERE id_usuario=%s",
                       GetSQLValueString($_POST['id_localidade'], "int"),
					   GetSQLValueString($data, "date"),
					   GetSQLValueString($hora, "text"),
					   GetSQLValueString($_POST['id_categoria_usuario'], "int"),
					   GetSQLValueString($_POST['nome_usuario'],"text"),
					   GetSQLValueString($_POST['email_usuario'],"text"),
					   GetSQLValueString($_POST['endereco'],"text"),
					   GetSQLValueString($_POST['bairro'],"text"),
					   GetSQLValueString($_POST['telefone'],"text"),
					   GetSQLValueString($_POST['senha_usuario'],"text"),
					   GetSQLValueString($nome_arquivo, "text"),
					   GetSQLValueString($_POST['status_usuario'],"int"),
					   GetSQLValueString($_POST['id_usuario'], "int"));
					   
					   
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Atualizado com Sucesso");
		location.href="ConsultaUsuario.php";
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
	$query_busca_dados = sprintf("SELECT * FROM usuarios WHERE id_usuario = %s", GetSQLValueString($colname_busca_dados, "int"));
	$busca_dados = mysql_query($query_busca_dados) or die(mysql_error());
	$row_busca_dados = mysql_fetch_assoc($busca_dados);
	$totalRows_busca_dados = mysql_num_rows($busca_dados);
	$operacao = "MM_update";
	$botao = "<button type=\"submit\" class=\"btn btn-primary btn-lg mr-md\" value=\"Cadastrar\"><i class=\"fa fa-check\"></i> Atualizar</button>";
	$preco = $row_busca_dados["preco_anuncio"];
}
mysql_select_db($database_criativo, $conexao);
$query_busca_categoria_usuario = "SELECT * FROM categoria_usuario ORDER BY titulo_categoria_usuario ASC";
$busca_categoria_usuario = mysql_query($query_busca_categoria_usuario, $conexao) or die(mysql_error());
$row_busca_categoria_usuario = mysql_fetch_assoc($busca_categoria_usuario);
$totalRows_busca_categoria_usuario = mysql_num_rows($busca_categoria_usuario);
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

		<!-- Basic -->
        <meta charset="iso-8859-1">

		<title>Controle de Usuários | FestasBrasil | Clouds | Sistema Gerenciador</title>
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
						<h2>Controle de An&uacute;ncios</h2>
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
												<label class="col-md-3 control-label">Hor&aacute;rio</label>
												<div class="col-md-2">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</span>
														<input id="hora_cad_usuario" name="hora_cad_usuario" type="text" data-plugin-timepicker class="form-control" value="<? if ($row_busca_dados["hora_cad_usuario"]) {
				  	echo $row_busca_dados["hora_cad_usuario"];
				  } else {
				  	echo date("H:i");
				  }?>" data-plugin-options='{ "showMeridian": false }'>
													</div>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-md-3 control-label">Per&iacute;odo do An&uacute;ncio</label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="date" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" value="<? if ($row_busca_dados["data_cad_usuario"]) {
					$datatrans = explode ("-", $row_busca_dados["data_cad_usuario"]); 
					$data = "$datatrans[2]/$datatrans[1]/$datatrans[0]"; 
				  	echo $data;
				  } else {
				  	echo date("d/m/Y");
				  }?>" class="form-control" name="data_cad_usuario">
													</div>
												</div>
											</div>
                                            
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label">Categoria</label>
												<div class="col-md-6">
													<select id="id_categoria_usuario" name="id_categoria_usuario" data-plugin-selectTwo class="form-control populate placeholder">
             <option value=""></option>
             <?php
                    do {  
                    ?><option value="<?php echo $row_busca_categoria_usuario['id_categoria_usuario']?>"<?php if (!(strcmp($row_busca_categoria_usuario['id_categoria_usuario'], $row_busca_dados['id_categoria_usuario']))) {echo "selected=\"selected\"";} ?>><?php echo $row_busca_categoria_usuario['titulo_categoria_usuario']?></option>
                                           <?php
                    } while ($row_busca_categoria_usuario = mysql_fetch_assoc($busca_categoria_usuario));
                      $rows = mysql_num_rows($busca_categoria_usuario);
                      if($rows > 0) {
                          mysql_data_seek($busca_categoria_usuario, 0);
                          $row_busca_categoria_usuario = mysql_fetch_assoc($busca_categoria_usuario);
                      }
                    ?> 
													</select>
												</div>
											</div>
                                            
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Nome</label>
												<div class="col-md-6">
													<input name="nome_usuario" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="200" value="<?=$row_busca_dados["nome_usuario"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Endereço</label>
												<div class="col-md-6">
													<input name="endereco" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="200" value="<?=$row_busca_dados["endereco"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Bairro</label>
												<div class="col-md-6">
													<input name="bairro" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="200" value="<?=$row_busca_dados["bairro"];?>" required>
												</div>
											</div>
                                            
                                            <div class="form-group">
											<label class="col-md-3 control-label">Telefone</label>
												<div class="col-md-6 control-label">
													<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-phone"></i>
													</span>
													<input type="tel" name="telefone" id="phone" data-plugin-masked-input data-input-mask="(99) 9999-9999" placeholder="(12) 1234-1234" class="form-control" value="<?=$row_busca_dados["telefone"];?>" required>
													</div>
												</div>
										    </div>
                                            
                                            <div class="form-group">
											<label class="col-md-3 control-label">E-mail</label>
												<div class="col-md-6 control-label">
													<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-envelope"></i>
													</span>
													<input type="email" name="email_usuario" value="<?=$row_busca_dados["email_usuario"];?>" id="email" placeholder="exemplo@exemplo.com" class="form-control" required>
													</div>
												</div>
										    </div>
                                            
                                            <div class="form-group">
												<label class="control-label col-md-3">Senha</label>
												<div class="col-md-6">
													<section class="form-group-vertical">
														<div class="input-group input-group-icon">
															<span class="input-group-addon">
																<span class="icon"><i class="fa fa-key"></i></span>
															</span>
															<input name="senha_usuario" value="<?=$row_busca_dados["senha_usuario"];?>" class="form-control" type="password" placeholder="Senha">
														</div>
													</section>
												</div>
											</div>
					
											<div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["imagem_usuario"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../conteudo/img/<?=$row_busca_dados["imagem_usuario"];?>" border="0" />
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
																<input id="imagem_usuario" name="imagem_usuario" type="file"/>
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
											  <input id="status_usuario" name="status_usuario" value="1" type="checkbox" name="switch" data-plugin-ios-switch <?php if (!(strcmp(1, $row_busca_dados['status_usuario']))) {echo "checked=\"checked\"";} else{ echo ""; } ?>/>
                                              </div>
											 </div>
                                            </div>
                                            <div class="form-group">
                                             <div class="pull-right">
                                              <?=$botao;?>
                                             </div>
                                            </div>
                                            <input type="hidden" name="<?=$operacao;?>" value="controle" />
      <input name="imagem_usuario_original" type="hidden" id="imagem_usuario_original" value="<?=$row_busca_dados["imagem_usuario"];?>" />
      <input name="id_usuario" type="hidden" id="id_usuario" value="<?=$row_busca_dados["id_usuario"];?>" />
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