<?
include("../Connections/criativo.php");
include("../Connections/seguranca_cms.php");
//COMANDO CONTROLE//
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "controle")) {

  /*
  $arquivo = isset($_FILES["imagem_noticia"]) ? $_FILES["imagem_noticia"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $nome_arquivo = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$nome_arquivo;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
  }
  */

  $imagem = $_FILES['imagem_noticia']['name']; // Nome originai da imagem
    $dir = "../conteudo/img"; // Diretório das imagens
    $salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor
    move_uploaded_file($_FILES['imagem_noticia']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
    $info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
    $nova_imagem = time().rand(1000,5000).".".$info_imagem['extension']; // Nome da imagem redimensionada
    // *** Include the class
    // ESte arquivo está no arquivo ZIPADO do artigo
    require_once "resize-class.php";
    // *** 1) Initialise / load image
    $resizeObj = new resize($salva);
    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
    $resizeObj -> resizeImage(600, 315, 'crop');
    /* Especificando que a nova imagem terá 200 px de largura e altura. E utilizando a opção CROP, que é considerada a melhor
    pois, recorta a imagem na medida sem distorção
    Se quizer ver outras opções, visite o site do desenvolvedor de resize2.php (http://www.jarrodoberto.com/articles/2011/09/image-resizing-made-easy-with-php)
    */
    // *** 3) Save image
    $resizeObj -> saveImage($dir."/".$nova_imagem, 80);
    // O arquivo-base é removido
    unlink($salva);

  /*
  $arquivo = isset($_FILES["imagem_inicial_noticia"]) ? $_FILES["imagem_inicial_noticia"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $imagem_inicial_noticia = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$imagem_inicial_noticia;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
  }
  */

    $imagem = $_FILES['imagem_inicial_noticia']['name']; // Nome originai da imagem
    $dir = "../conteudo/img"; // Diretório das imagens
    $salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor
    move_uploaded_file($_FILES['imagem_inicial_noticia']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
    $info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
    $nova_imagem2 = time().rand(1000,5000).".".$info_imagem['extension']; // Nome da imagem redimensionada
    // *** Include the class
    // ESte arquivo está no arquivo ZIPADO do artigo
    require_once "resize-class.php";
    // *** 1) Initialise / load image
    $resizeObj = new resize($salva);
    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
    $resizeObj -> resizeImage(600, 500, 'crop');
    /* Especificando que a nova imagem terá 200 px de largura e altura. E utilizando a opção CROP, que é considerada a melhor
    pois, recorta a imagem na medida sem distorção
    Se quizer ver outras opções, visite o site do desenvolvedor de resize2.php (http://www.jarrodoberto.com/articles/2011/09/image-resizing-made-easy-with-php)
    */

    // *** 3) Save image
    $resizeObj -> saveImage($dir."/".$nova_imagem2, 80);
    // O arquivo-base é removido
    unlink($salva);

  $data = substr($_POST['data_noticia'],6,4).'-'.substr($_POST['data_noticia'],3,2).'-'.substr($_POST['data_noticia'],0,2);
  $insertSQL = sprintf("INSERT INTO noticia (id_localidade, id_categoria_noticia, data_noticia, titulo_noticia, desc_noticia, tags_noticia, link_noticia, texto_noticia, imagem_noticia, imagem_inicial_noticia, posicao_noticia, status_noticia) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_localidade'],"int"),
					   GetSQLValueString($_POST['id_categoria_noticia'],"int"),
					   GetSQLValueString($data, "date"),
					   GetSQLValueString($_POST['titulo_noticia'],"text"),
					   GetSQLValueString($_POST['desc_noticia'],"text"),
					   GetSQLValueString($_POST['tags_noticia'],"text"),
					   GetSQLValueString($_POST['link_noticia'],"text"),
					   GetSQLValueString($_POST['texto_noticia'],"text"),
					   GetSQLValueString($nova_imagem, "text"),
                       GetSQLValueString($nova_imagem2, "text"),
					   GetSQLValueString($_POST['posicao_noticia'],"int"),
					   GetSQLValueString($_POST['status_noticia'],"int"));
  
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Realizado com sucesso");
		location.href="ConsultaNoticia.php";
	</script>
	<?
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "controle")) {

  /*
  $arquivo = isset($_FILES["imagem_noticia"]) ? $_FILES["imagem_noticia"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $nome_arquivo = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$nome_arquivo;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
	 
	 $apagar = "../conteudo/img/".$_POST["imagem_noticia_original"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	
  } else {
	  $nome_arquivo = $_POST["imagem_noticia_original"];
  }
  */

  $arquivo = isset($_FILES["imagem_noticia"]) ? $_FILES["imagem_noticia"] : FALSE;
  if ($arquivo["name"] != "") {

    $imagem = $_FILES['imagem_noticia']['name']; // Nome originai da imagem
    $dir = "../conteudo/img"; // Diretório das imagens
    $salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor
    move_uploaded_file($_FILES['imagem_noticia']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
    $info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
    $nova_imagem = time().rand(1000,5000).".".$info_imagem['extension']; // Nome da imagem redimensionada
    // *** Include the class
    // ESte arquivo está no arquivo ZIPADO do artigo
    require_once "resize-class.php";
    // *** 1) Initialise / load image
    $resizeObj = new resize($salva);
    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
    $resizeObj -> resizeImage(600, 315, 'crop');
    /* Especificando que a nova imagem terá 200 px de largura e altura. E utilizando a opção CROP, que é considerada a melhor
    pois, recorta a imagem na medida sem distorção
    Se quizer ver outras opções, visite o site do desenvolvedor de resize2.php (http://www.jarrodoberto.com/articles/2011/09/image-resizing-made-easy-with-php)
    */
    // *** 3) Save image
    $resizeObj -> saveImage($dir."/".$nova_imagem, 80);
    // O arquivo-base é removido
    unlink($salva);
	 
  } else {
	 $nova_imagem = $_POST["imagem_noticia_original"];
  }

  /*
  $arquivo = isset($_FILES["imagem_inicial_noticia"]) ? $_FILES["imagem_inicial_noticia"] : FALSE;
  if ($arquivo["name"] != "") {
	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $imagem_inicial_noticia = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../conteudo/img/".$imagem_inicial_noticia;
	 move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
	 
	 $apagar = "../conteudo/img/".$_POST["imagem_inicial_noticia_original"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	
  } else {
	  $imagem_inicial_noticia = $_POST["imagem_inicial_noticia_original"];
  }
  */

  $arquivo = isset($_FILES["imagem_inicial_noticia"]) ? $_FILES["imagem_inicial_noticia"] : FALSE;
  if ($arquivo["name"] != "") {

    $imagem = $_FILES['imagem_inicial_noticia']['name']; // Nome originai da imagem
    $dir = "../conteudo/img"; // Diretório das imagens
    $salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor
    move_uploaded_file($_FILES['imagem_inicial_noticia']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
    $info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
    $nova_imagem2 = time().rand(1000,5000).".".$info_imagem['extension']; // Nome da imagem redimensionada
    // *** Include the class
    // ESte arquivo está no arquivo ZIPADO do artigo
    require_once "resize-class.php";
    // *** 1) Initialise / load image
    $resizeObj = new resize($salva);
    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
    $resizeObj -> resizeImage(600, 500, 'crop');
    /* Especificando que a nova imagem terá 200 px de largura e altura. E utilizando a opção CROP, que é considerada a melhor
    pois, recorta a imagem na medida sem distorção
    Se quizer ver outras opções, visite o site do desenvolvedor de resize2.php (http://www.jarrodoberto.com/articles/2011/09/image-resizing-made-easy-with-php)
    */
    // *** 3) Save image
    $resizeObj -> saveImage($dir."/".$nova_imagem2, 80);
    // O arquivo-base é removido
    unlink($salva);
	 
  } else {
	 $nova_imagem2 = $_POST["imagem_inicial_noticia_original"];
  }

  $data = substr($_POST['data_noticia'],6,4).'-'.substr($_POST['data_noticia'],3,2).'-'.substr($_POST['data_noticia'],0,2);
  $updateSQL = sprintf("UPDATE noticia SET id_localidade=%s, id_categoria_noticia=%s, data_noticia=%s, titulo_noticia=%s, desc_noticia=%s, tags_noticia=%s, link_noticia=%s, texto_noticia=%s, imagem_noticia=%s, imagem_inicial_noticia=%s, posicao_noticia=%s, status_noticia=%s WHERE id_noticia=%s",
                       GetSQLValueString($_POST['id_localidade'],"int"),
					   GetSQLValueString($_POST['id_categoria_noticia'],"int"),
					   GetSQLValueString($data, "date"),
					   GetSQLValueString($_POST['titulo_noticia'],"text"),
					   GetSQLValueString($_POST['desc_noticia'],"text"),
					   GetSQLValueString($_POST['tags_noticia'],"text"),
					   GetSQLValueString($_POST['link_noticia'],"text"),
					   GetSQLValueString($_POST['texto_noticia'],"text"),
					   GetSQLValueString($nova_imagem, "text"),
					   GetSQLValueString($nova_imagem2, "text"),
					   GetSQLValueString($_POST['posicao_noticia'],"int"),
					   GetSQLValueString($_POST['status_noticia'],"int"),
					   GetSQLValueString($_POST['id_noticia'], "int"));
					   
					   
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Atualizado com Sucesso");
		location.href="ConsultaNoticia.php";
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
	$query_busca_dados = sprintf("SELECT * FROM noticia WHERE id_noticia = %s", GetSQLValueString($colname_busca_dados, "int"));
	$busca_dados = mysql_query($query_busca_dados) or die(mysql_error());
	$row_busca_dados = mysql_fetch_assoc($busca_dados);
	$totalRows_busca_dados = mysql_num_rows($busca_dados);
	$operacao = "MM_update";
	$botao = "<button type=\"submit\" class=\"btn btn-primary btn-lg mr-md\" value=\"Cadastrar\"><i class=\"fa fa-check\"></i> Atualizar</button>";
}
//FIM DO COMANDO CONTROLE//
mysql_select_db($database_criativo, $conexao);
$query_busca_categoria_noticia = "SELECT * FROM categoria_noticia ORDER BY titulo_categoria_noticia ASC";
$busca_categoria_noticia = mysql_query($query_busca_categoria_noticia, $conexao) or die(mysql_error());
$row_busca_categoria_noticia = mysql_fetch_assoc($busca_categoria_noticia);
$totalRows_busca_categoria_noticia = mysql_num_rows($busca_categoria_noticia);

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
		<title>Controle de Notícias | FestasBrasil | Clouds | Sistema Gerenciador</title>
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
						<h2>Controle de Notícias</h2>
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
													<select id="id_categoria_noticia" name="id_categoria_noticia" data-plugin-selectTwo class="form-control populate placeholder" placeholder="Selecione a Categoria">
                                                    <option value=""></option>
             <?php
                    do {  
                    ?><option value="<?php echo $row_busca_categoria_noticia['id_categoria_noticia']?>"<?php if (!(strcmp($row_busca_categoria_noticia['id_categoria_noticia'], $row_busca_dados['id_categoria_noticia']))) {echo "selected=\"selected\"";} ?>><?php echo $row_busca_categoria_noticia['titulo_categoria_noticia']?></option>
                                           <?php
                    } while ($row_busca_categoria_noticia = mysql_fetch_assoc($busca_categoria_noticia));
                      $rows = mysql_num_rows($busca_categoria_noticia);
                      if($rows > 0) {
                          mysql_data_seek($busca_categoria_noticia, 0);
                          $row_busca_categoria_noticia = mysql_fetch_assoc($busca_categoria_noticia);
                      }
                    ?> 
													</select>
												</div>
											</div>
                    
                                           <div class="form-group">
													<label class="col-md-3 control-label">Data</label>
													<div class="col-md-6">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</span>
															<input name="data_noticia" id="date" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control" value="<? if ($row_busca_dados["data_noticia"]) {
					$datatrans = explode ("-", $row_busca_dados["data_noticia"]); 
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
													<input name="titulo_noticia" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="200" value="<?=$row_busca_dados["titulo_noticia"];?>" required>
												</div>
											</div>
                                            
                                            
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Descri&ccedil;&atilde;o</label>
												<div class="col-md-6">
													<textarea id="desc_noticia" name="desc_noticia" class="form-control" rows="3" data-plugin-maxlength maxlength="240"><?=$row_busca_dados["desc_noticia"];?></textarea>
												</div>
											</div>
						
											<div class="form-group">
												<label for="tags-input" class="col-md-3 control-label">Tags</label>
												<div class="col-md-6">
													<input name="tags_noticia" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" value="<?=$row_busca_dados["tags_noticia"];?>" />
													<p>palavras-chave para mecanismos de busca externos e internos.</p>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Link Externo</label>
												<div class="col-md-6">
													<input name="link_noticia" type="text" class="form-control" id="inputDefault" value="<?=$row_busca_dados["link_noticia"];?>">
												</div>
											</div>
                                            
                                            <div class="form-group">
												<div class="col-md-12">
													<?php
					    include("FCKeditor/fckeditor.php");
					    $oFCKeditor = new FCKeditor('texto_noticia');
						$oFCKeditor->BasePath = 'FCKeditor/';
						$oFCKeditor->Value = $row_busca_dados["texto_noticia"];
						$oFCKeditor->Width  = '100%';
						$oFCKeditor->Height = '300';
						$oFCKeditor->Create();
			  	     ?>
												</div>
											</div>
                                            
                                            <div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["imagem_noticia"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../conteudo/img/<?=$row_busca_dados["imagem_noticia"];?>" border="0" />
											 <? } ?>
                                             </div>
                                            </div>
											<div class="form-group">
												<label class="col-md-3 control-label">Imagem de Arquivo (Padrão)</label>
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
																<input id="imagem_noticia" name="imagem_noticia" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
                                                <div class="col-md-12">
                                                <p>Tamanho (600x315 Pixels) Sempre carregar essa imagem.</p>
                                                </div>
											</div>
                                            
                                            <div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["imagem_inicial_noticia"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../conteudo/img/<?=$row_busca_dados["imagem_inicial_noticia"];?>" border="0" />
											 <? } ?>
                                             </div>
                                            </div>
											<div class="form-group">
												<label class="col-md-3 control-label">Imagem Principal (Página Inicial)</label>
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
																<input id="imagem_inicial_noticia" name="imagem_inicial_noticia" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
                                                <div class="col-md-12">
                                                <p>Tamanho (600x500 Pixels) (Exibição na Página Inicial)</p>
                                                </div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Posição</label>
												<div class="col-md-6">
													<select id="posicao_noticia" name="posicao_noticia" class="form-control mb-md">
														<option value="1" <?php if (!(strcmp(1, $row_busca_dados['posicao_noticia']))) {echo "selected=\"selected\"";} ?>>Destaque Página Inicial</option>
                                                        <option value="2" <?php if (!(strcmp(2, $row_busca_dados['posicao_noticia']))) {echo "selected=\"selected\"";} ?>>Destaque Central Página Inicial</option>
                                                        <option value="3" <?php if (!(strcmp(3, $row_busca_dados['posicao_noticia']))) {echo "selected=\"selected\"";} ?>>Abaixo do Central da Página Inicial</option>
                                                        <option value="4" <?php if (!(strcmp(4, $row_busca_dados['posicao_noticia']))) {echo "selected=\"selected\"";} ?>>Outras Chamadas na Página Inicial</option>
                                                        <option value="6" <?php if (!(strcmp(6, $row_busca_dados['posicao_noticia']))) {echo "selected=\"selected\"";} ?>>Vídeos na Página Inicial</option>
                                                        <option value="7" <?php if (!(strcmp(7, $row_busca_dados['posicao_noticia']))) {echo "selected=\"selected\"";} ?>>Instagram na Página Inicial</option>
                                                        <option value="5" <?php if (!(strcmp(5, $row_busca_dados['posicao_noticia']))) {echo "selected=\"selected\"";} ?>>Internas</option>
													</select>
												</div>
											</div>
                                            
                                            <div class="form-group">
                                             <label class="col-md-3 control-label">Status</label>
                                             <div class="col-md-9">
                                              <div class="switch switch-sm switch-success">
											  <input id="status_noticia" name="status_noticia" value="1" type="checkbox" name="switch" data-plugin-ios-switch <?php if (!(strcmp(1, $row_busca_dados['status_noticia']))) {echo "checked=\"checked\"";} else{ echo ""; } ?>/>
                                              </div>
											 </div>
                                            </div>
                                            <div class="form-group">
                                             <div class="pull-right">
                                              <?=$botao;?>
                                             </div>
                                            </div>
                                            <input type="hidden" name="<?=$operacao;?>" value="controle" />
                                            <input name="imagem_noticia_original" type="hidden" id="imagem_noticia_original" value="<?=$row_busca_dados["imagem_noticia"];?>" />
                                            <input name="imagem_inicial_noticia_original" type="hidden" id="imagem_inicial_noticia_original" value="<?=$row_busca_dados["imagem_inicial_noticia"];?>" />
      <input name="id_noticia" type="hidden" id="id_noticia" value="<?=$row_busca_dados["id_noticia"];?>" />
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