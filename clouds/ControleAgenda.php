<?
include("../Connections/criativo.php");
include("../Connections/seguranca_cms.php");
//COMANDO CONTROLE//
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "controle")) {
  $arquivo = isset($_FILES["imagem_agenda"]) ? $_FILES["imagem_agenda"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $nome_arquivo = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$nome_arquivo;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
  }
  $arquivo = isset($_FILES["imagem_inicial_agenda"]) ? $_FILES["imagem_inicial_agenda"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $imagem_inicial_agenda = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$imagem_inicial_agenda;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
  }
  $data = substr($_POST['data_agenda'],6,4).'-'.substr($_POST['data_agenda'],3,2).'-'.substr($_POST['data_agenda'],0,2);
  $insertSQL = sprintf("INSERT INTO agenda (id_localidade, data_agenda, titulo_agenda, desc_agenda, tags_agenda, link_agenda, texto_agenda, imagem_agenda, imagem_inicial_agenda, posicao_agenda, status_agenda) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_localidade'],"int"),
					   GetSQLValueString($data, "date"),
					   GetSQLValueString($_POST['titulo_agenda'],"text"),
					   GetSQLValueString($_POST['desc_agenda'],"text"),
					   GetSQLValueString($_POST['tags_agenda'],"text"),
					   GetSQLValueString($_POST['link_agenda'],"text"),
					   GetSQLValueString($_POST['texto_agenda'],"text"),
					   GetSQLValueString($nome_arquivo, "text"),
					   GetSQLValueString($imagem_inicial_agenda, "text"),
					   GetSQLValueString($_POST['posicao_agenda'],"int"),
					   GetSQLValueString($_POST['status_agenda'],"int"));
  
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Realizado com sucesso");
		location.href="ConsultaAgenda.php";
	</script>
	<?
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "controle")) {
  $arquivo = isset($_FILES["imagem_agenda"]) ? $_FILES["imagem_agenda"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $nome_arquivo = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$nome_arquivo;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
	 
	 $apagar = "../conteudo/img/".$_POST["imagem_agenda_original"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	
  } else {
	  $nome_arquivo = $_POST["imagem_agenda_original"];
  }
  
  $arquivo = isset($_FILES["imagem_inicial_agenda"]) ? $_FILES["imagem_inicial_agenda"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $imagem_inicial_agenda = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$imagem_inicial_agenda;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
	 
	 $apagar = "../conteudo/img/".$_POST["imagem_inicial_agenda_original"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	
  } else {
	  $imagem_inicial_agenda = $_POST["imagem_inicial_agenda_original"];
  }
  $data = substr($_POST['data_agenda'],6,4).'-'.substr($_POST['data_agenda'],3,2).'-'.substr($_POST['data_agenda'],0,2);
  $updateSQL = sprintf("UPDATE agenda SET id_localidade=%s, data_agenda=%s, titulo_agenda=%s, desc_agenda=%s, tags_agenda=%s, link_agenda=%s, texto_agenda=%s, imagem_agenda=%s, imagem_inicial_agenda=%s, posicao_agenda=%s, status_agenda=%s WHERE id_agenda=%s",
                       GetSQLValueString($_POST['id_localidade'],"int"),
					   GetSQLValueString($data, "date"),
					   GetSQLValueString($_POST['titulo_agenda'],"text"),
					   GetSQLValueString($_POST['desc_agenda'],"text"),
					   GetSQLValueString($_POST['tags_agenda'],"text"),
					   GetSQLValueString($_POST['link_agenda'],"text"),
					   GetSQLValueString($_POST['texto_agenda'],"text"),
					   GetSQLValueString($nome_arquivo, "text"),
					   GetSQLValueString($imagem_inicial_agenda, "text"),
					   GetSQLValueString($_POST['posicao_agenda'],"int"),
					   GetSQLValueString($_POST['status_agenda'],"int"),
					   GetSQLValueString($_POST['id_agenda'], "int"));
					   
					   
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Atualizado com Sucesso");
		location.href="ConsultaAgenda.php";
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
	$query_busca_dados = sprintf("SELECT * FROM agenda WHERE id_agenda = %s", GetSQLValueString($colname_busca_dados, "int"));
	$busca_dados = mysql_query($query_busca_dados) or die(mysql_error());
	$row_busca_dados = mysql_fetch_assoc($busca_dados);
	$totalRows_busca_dados = mysql_num_rows($busca_dados);
	$operacao = "MM_update";
	$botao = "<button type=\"submit\" class=\"btn btn-primary btn-lg mr-md\" value=\"Cadastrar\"><i class=\"fa fa-check\"></i> Atualizar</button>";
}
//FIM DO COMANDO CONTROLE//

mysql_select_db($database_criativo, $conexao);
$query_busca_localidade = "SELECT localidade.id_localidade, localidade.titulo_localidade, localidade.id_estado, estado.id_estado, estado.titulo_estado FROM localidade, estado WHERE localidade.id_estado = estado.id_estado ORDER BY titulo_localidade ASC";
$busca_localidade = mysql_query($query_busca_localidade, $conexao) or die(mysql_error());
$row_busca_localidade = mysql_fetch_assoc($busca_localidade);
$totalRows_busca_localidade = mysql_num_rows($busca_localidade);
?>
<!doctype html>
<html class="fixed">
	<head>
        <meta charset="iso-8859-1">
		<title>Controle de Agenda | FestasBrasil | Clouds | Sistema Gerenciador</title>
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
						<h2>Controle de Agenda</h2>
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
													<label class="col-md-3 control-label">Data</label>
													<div class="col-md-6">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</span>
															<input name="data_agenda" id="date" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control" value="<? if ($row_busca_dados["data_agenda"]) {
					$datatrans = explode ("-", $row_busca_dados["data_agenda"]); 
					$data = "$datatrans[2]/$datatrans[1]/$datatrans[0]"; 
				  	echo $data;
				  } else {
				  	echo date("d/m/Y");
				  }?>">
														</div>
													</div>
											</div>
                                            
                                            
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Título</label>
												<div class="col-md-6">
													<input name="titulo_agenda" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="200" value="<?=$row_busca_dados["titulo_agenda"];?>" required>
												</div>
											</div>
                                            
                                            
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Descri&ccedil;&atilde;o</label>
												<div class="col-md-6">
													<textarea id="desc_agenda" name="desc_agenda" class="form-control" rows="3" data-plugin-maxlength maxlength="240"><?=$row_busca_dados["desc_agenda"];?></textarea>
												</div>
											</div>
						
											<div class="form-group">
												<label for="tags-input" class="col-md-3 control-label">Tags</label>
												<div class="col-md-6">
													<input name="tags_agenda" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" value="<?=$row_busca_dados["tags_agenda"];?>" />
													<p>palavras-chave para mecanismos de busca externos e internos.</p>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Link Externo</label>
												<div class="col-md-6">
													<input name="link_agenda" type="text" class="form-control" id="inputDefault" value="<?=$row_busca_dados["link_agenda"];?>">
												</div>
											</div>
                                            
                                            <div class="form-group">
												<div class="col-md-12">
													<?php
					    include("FCKeditor/fckeditor.php");
					    $oFCKeditor = new FCKeditor('texto_agenda');
						$oFCKeditor->BasePath = 'FCKeditor/';
						$oFCKeditor->Value = $row_busca_dados["texto_agenda"];
						$oFCKeditor->Width  = '100%';
						$oFCKeditor->Height = '300';
						$oFCKeditor->Create();
			  	     ?>
												</div>
											</div>
                                            
                                            <div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["imagem_agenda"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../conteudo/img/<?=$row_busca_dados["imagem_agenda"];?>" border="0" />
											 <? } ?>
                                             </div>
                                            </div>
											<div class="form-group">
												<label class="col-md-3 control-label">Imagem de Exibi&ccedil;&atilde;o Padrão</label>
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
																<input id="imagem_agenda" name="imagem_agenda" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
                                                <div class="col-md-12">
                                                <p>Tamanho Exibição (600x315 Pixels)</p>
                                                </div>
											</div>
                                            
                                            <div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["imagem_inicial_agenda"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../conteudo/img/<?=$row_busca_dados["imagem_inicial_agenda"];?>" border="0" />
											 <? } ?>
                                             </div>
                                            </div>
											<div class="form-group">
												<label class="col-md-3 control-label">Imagem de Exibi&ccedil;&atilde;o Página Inicial</label>
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
																<input id="imagem_inicial_agenda" name="imagem_inicial_agenda" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
                                                <div class="col-md-12">
                                                <p>Tamanho Agenda Inicial (600x553 Pixels)</p>
                                                </div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Posição</label>
												<div class="col-md-6">
													<select id="posicao_agenda" name="posicao_agenda" class="form-control mb-md">
														<option value="1" <?php if (!(strcmp(1, $row_busca_dados['posicao_agenda']))) {echo "selected=\"selected\"";} ?>>Página Inicial</option>
                                                        <option value="2" <?php if (!(strcmp(2, $row_busca_dados['posicao_agenda']))) {echo "selected=\"selected\"";} ?>>Internas</option>
													</select>
												</div>
											</div>
                                            
                                            <div class="form-group">
                                             <label class="col-md-3 control-label">Status</label>
                                             <div class="col-md-9">
                                              <div class="switch switch-sm switch-success">
											  <input id="status_agenda" name="status_agenda" value="1" type="checkbox" name="switch" data-plugin-ios-switch <?php if (!(strcmp(1, $row_busca_dados['status_agenda']))) {echo "checked=\"checked\"";} else{ echo ""; } ?>/>
                                              </div>
											 </div>
                                            </div>
                                            <div class="form-group">
                                             <div class="pull-right">
                                              <?=$botao;?>
                                             </div>
                                            </div>
                                            <input type="hidden" name="<?=$operacao;?>" value="controle" />
                                            <input name="imagem_inicial_agenda_original" type="hidden" id="imagem_inicial_agenda_original" value="<?=$row_busca_dados["imagem_inicial_agenda"];?>" />
                                            <input name="imagem_agenda_original" type="hidden" id="imagem_agenda_original" value="<?=$row_busca_dados["imagem_agenda"];?>" />
      <input name="id_agenda" type="hidden" id="id_agenda" value="<?=$row_busca_dados["id_agenda"];?>" />
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