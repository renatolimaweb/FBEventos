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
  $arquivo = isset($_FILES["imagem_evento"]) ? $_FILES["imagem_evento"] : FALSE;
  if ($arquivo["name"] != "") {
  	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $imagem_original = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../imagensGaleria/".$imagem_original;
     move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
  }
  */

  $imagem = $_FILES['imagem_evento']['name']; // Nome originai da imagem
  $dir = "../imagensGaleria/"; // Diretório das imagens
  $salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor
  move_uploaded_file($_FILES['imagem_evento']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
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
  $arquivo = isset($_FILES["imagem_inicial_evento"]) ? $_FILES["imagem_inicial_evento"] : FALSE;
  if ($arquivo["name"] != "") {
  	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $imagem_inicial_evento = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../imagensGaleria/".$imagem_inicial_evento;
     move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 
  }
  */

  $imagem = $_FILES['imagem_inicial_evento']['name']; // Nome originai da imagem
    $dir = "../imagensGaleria/"; // Diretório das imagens
    $salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor
    move_uploaded_file($_FILES['imagem_inicial_evento']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
    $info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
    $nova_imagem2 = time().rand(1000,5000).".".$info_imagem['extension']; // Nome da imagem redimensionada
    // *** Include the class
    // ESte arquivo está no arquivo ZIPADO do artigo
    require_once "resize-class.php";
    // *** 1) Initialise / load image
    $resizeObj = new resize($salva);
    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
    $resizeObj -> resizeImage(600, 768, 'crop');
    /* Especificando que a nova imagem terá 200 px de largura e altura. E utilizando a opção CROP, que é considerada a melhor
    pois, recorta a imagem na medida sem distorção
    Se quizer ver outras opções, visite o site do desenvolvedor de resize2.php (http://www.jarrodoberto.com/articles/2011/09/image-resizing-made-easy-with-php)
    */

    // *** 3) Save image
    $resizeObj -> saveImage($dir."/".$nova_imagem2, 80);
    // O arquivo-base é removido
    unlink($salva);
  
  // Criar a pasta para guardar as imagens
  
  $data  		= date("dmY");
  $hora  		= date("His");
  $nome_pasta   = $data.$hora;
  /*
  include "../Connections/conectaftp.php";	
  $id_conexao = ftp_connect($servidor_ftp);
  $login_ftp = ftp_login($id_conexao, $usuario_ftp, $senha_ftp);
  if (!$conexao) {
	  $msg .= "<br> Nï¿½o foi possivï¿½l abrir conexï¿½o FTP com o servidor $servidor_ftp";
  }
  if ((!$login_ftp)) {
	 $msg .= "<br> Nï¿½o foi possivï¿½l efetuar login no servidor";
  } else {
	  // Acessa a pasta da do site
	 ftp_chdir($id_conexao, "public_html");
	 ftp_chdir($id_conexao, "imagensGaleria");
 
	  // Criar diretorio com nome do usuario
	  ftp_mkdir($id_conexao, $nome_pasta);
	  ftp_site($id_conexao, 'CHMOD 777 '.$nome_pasta);
	  ftp_close($id_conexao);
  }
  */
  mkdir("../imagensGaleria/".$nome_pasta, 0777);
  
  $data_evento = substr($_POST['data_evento'],6,4).'-'.substr($_POST['data_evento'],3,2).'-'.substr($_POST['data_evento'],0,2);
  $insertSQL = sprintf("INSERT INTO evento (id_categoria_evento, id_localidade, id_negocio, data_evento, titulo_evento, desc_evento, tags_evento, imagem_evento, imagem_inicial_evento, pasta_evento, posicao_evento, status_evento) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST["id_categoria_evento"], "int"),
					   GetSQLValueString($_POST["id_localidade"], "int"),
					   GetSQLValueString($_POST["id_negocio"], "int"),
                       GetSQLValueString($data_evento, "date"),
					   GetSQLValueString($_POST["titulo_evento"], "text"),
					   GetSQLValueString($_POST["desc_evento"], "text"),
					   GetSQLValueString($_POST["tags_evento"], "text"),
                       GetSQLValueString($nova_imagem, "text"),
                       GetSQLValueString($nova_imagem2, "text"),
					   GetSQLValueString($nome_pasta, "text"),
					   GetSQLValueString($_POST["posicao_evento"], "int"),
					   GetSQLValueString($_POST["status_evento"], "int"));

  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
  $codigo_cad = mysql_insert_id();
  $url = "ControleItemEvento.php?evento=$codigo_cad";
	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Realizado com sucesso. Você será enviado agora para página onde deve ser postado as fotos!");
		location.href="<?=$url;?>";
	</script>
	<?
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "controle")) {
  
  /*
  $arquivo = isset($_FILES["imagem_evento"]) ? $_FILES["imagem_evento"] : FALSE;
  if ($arquivo["name"] != "") {
  	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $imagem_original = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../imagensGaleria/".$imagem_original;
     move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 

	 $apagar = "../imagensGaleria/".$_POST["imagem_evento_original"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	 
  } else {
	 $imagem_original = $_POST["imagem_evento_original"];
  }
  */

  $arquivo = isset($_FILES["imagem_evento"]) ? $_FILES["imagem_evento"] : FALSE;
  if ($arquivo["name"] != "") {

    $imagem = $_FILES['imagem_evento']['name']; // Nome originai da imagem
    $dir = "../imagensGaleria/"; // Diretório das imagens
    $salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor
    move_uploaded_file($_FILES['imagem_evento']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
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
	 $nova_imagem = $_POST["imagem_evento_original"];
  }
  
  /*
  $arquivo = isset($_FILES["imagem_inicial_evento"]) ? $_FILES["imagem_inicial_evento"] : FALSE;
  if ($arquivo["name"] != "") {
  	 $imagem = strrpos($arquivo["name"] , '.') + 1;
	 $extensao = substr($arquivo["name"], $imagem,3);
     $imagem_inicial_evento = md5(uniqid(time())) . "." . $extensao;
  	 $imagem_dir = "../imagensGaleria/".$imagem_inicial_evento;
     move_uploaded_file($arquivo["tmp_name"], $imagem_dir); 

	 $apagar = "../imagensGaleria/".$_POST["imagem_inicial_evento_original"];
	 if (is_file($apagar)) {
	 	unlink($apagar);
	 }	 
  } else {
	 $imagem_inicial_evento = $_POST["imagem_inicial_evento_original"];
  }
  */

  $arquivo = isset($_FILES["imagem_inicial_evento"]) ? $_FILES["imagem_inicial_evento"] : FALSE;
  if ($arquivo["name"] != "") {

    $imagem = $_FILES['imagem_inicial_evento']['name']; // Nome originai da imagem
    $dir = "../imagensGaleria/"; // Diretório das imagens
    $salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor
    move_uploaded_file($_FILES['imagem_inicial_evento']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
    $info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
    $nova_imagem2 = time().rand(1000,5000).".".$info_imagem['extension']; // Nome da imagem redimensionada
    // *** Include the class
    // ESte arquivo está no arquivo ZIPADO do artigo
    require_once "resize-class.php";
    // *** 1) Initialise / load image
    $resizeObj = new resize($salva);
    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
    $resizeObj -> resizeImage(600, 768, 'crop');
    /* Especificando que a nova imagem terá 200 px de largura e altura. E utilizando a opção CROP, que é considerada a melhor
    pois, recorta a imagem na medida sem distorção
    Se quizer ver outras opções, visite o site do desenvolvedor de resize2.php (http://www.jarrodoberto.com/articles/2011/09/image-resizing-made-easy-with-php)
    */
    // *** 3) Save image
    $resizeObj -> saveImage($dir."/".$nova_imagem2, 80);
    // O arquivo-base é removido
    unlink($salva);
	 
  } else {
	 $nova_imagem2 = $_POST["imagem_inicial_evento_original"];
  }
  

  $data_evento = substr($_POST['data_evento'],6,4).'-'.substr($_POST['data_evento'],3,2).'-'.substr($_POST['data_evento'],0,2);
  $updateSQL = sprintf("UPDATE evento SET id_categoria_evento=%s, id_localidade=%s, id_negocio=%s, data_evento=%s, titulo_evento=%s, desc_evento=%s, tags_evento=%s, imagem_evento=%s, imagem_inicial_evento=%s, posicao_evento=%s, status_evento=%s WHERE id_evento=%s",
                       GetSQLValueString($_POST["id_categoria_evento"], "int"),
					   GetSQLValueString($_POST["id_localidade"], "int"),
					   GetSQLValueString($_POST["id_negocio"], "int"),
                       GetSQLValueString($data_evento, "date"),
					   GetSQLValueString($_POST["titulo_evento"], "text"),
					   GetSQLValueString($_POST["desc_evento"], "text"),
					   GetSQLValueString($_POST["tags_evento"], "text"),
                       GetSQLValueString($nova_imagem, "text"),
                       GetSQLValueString($nova_imagem2, "text"),
					   GetSQLValueString($_POST["posicao_evento"], "int"),
					   GetSQLValueString($_POST["status_evento"], "int"),
					   GetSQLValueString($_POST['id_evento'], "int"));
					   
  mysql_select_db($database_criativo, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
	?>
	<SCRIPT language="JavaScript">
		alert("Cadastro Atualizado com Sucesso");
		location.href="ConsultaEvento.php";
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
	$query_busca_dados = sprintf("SELECT * FROM evento WHERE id_evento = %s", GetSQLValueString($colname_busca_dados, "int"));
	$busca_dados = mysql_query($query_busca_dados) or die(mysql_error());
	$row_busca_dados = mysql_fetch_assoc($busca_dados);
	$totalRows_busca_dados = mysql_num_rows($busca_dados);
	$operacao = "MM_update";
	$botao = "<button type=\"submit\" class=\"btn btn-primary\">Atualizar</button>";
}
//FIM DO COMANDO CONTROLE//
mysql_select_db($database_criativo, $conexao);
$query_busca_categoria_evento = "SELECT * FROM categoria_evento ORDER BY titulo_categoria_evento ASC";
$busca_categoria_evento = mysql_query($query_busca_categoria_evento, $conexao) or die(mysql_error());
$row_busca_categoria_evento = mysql_fetch_assoc($busca_categoria_evento);
$totalRows_busca_categoria_evento = mysql_num_rows($busca_categoria_evento);

if($categoria_usuario_autentica == 1) { 
mysql_select_db($database_criativo, $conexao);
$query_busca_negocio = "SELECT * FROM negocio, localidade, estado WHERE negocio.id_localidade = localidade.id_localidade AND localidade.id_estado = estado.id_estado ORDER BY negocio.titulo_negocio ASC";
$busca_negocio = mysql_query($query_busca_negocio, $conexao) or die(mysql_error());
$row_busca_negocio = mysql_fetch_assoc($busca_negocio);
$totalRows_busca_negocio = mysql_num_rows($busca_negocio);
}
if($categoria_usuario_autentica <> 1) {
mysql_select_db($database_criativo, $conexao);
$query_busca_negocio = "SELECT * FROM negocio, localidade, estado WHERE negocio.id_localidade = localidade.id_localidade AND localidade.id_estado = estado.id_estado AND negocio.id_localidade = '$localidade_usuario_autentica' ORDER BY negocio.titulo_negocio ASC";
$busca_negocio = mysql_query($query_busca_negocio, $conexao) or die(mysql_error());
$row_busca_negocio = mysql_fetch_assoc($busca_negocio);
$totalRows_busca_negocio = mysql_num_rows($busca_negocio);
}

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
		<title>Controle de Galerias de Fotos | FestasBrasil | Clouds | Sistema Gerenciador</title>
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
						<h2>Controle de Galerias de Fotos</h2>
					</header>

					<!-- start: page -->
                    <div class="panel-body">
					<form method="post" name="controle" class="form-horizontal" role="form" action="<?php echo $editFormAction; ?>" onSubmit="return checkForm(this)" ENCTYPE="multipart/form-data">
                    
                                            <? if($categoria_usuario_autentica == 1) { ?>
                                            <div class="form-group">
												<label class="col-md-3 control-label">Localidade</label>
												<div class="col-md-6">
													<select id="id_localidade" name="id_localidade" data-plugin-selectTwo class="form-control populate placeholder" required>
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
													<select id="id_categoria_evento" name="id_categoria_evento" data-plugin-selectTwo class="form-control populate placeholder" placeholder="Selecione a Categoria" required>
                                                    <option value=""></option>
             <?php
                    do {  
                    ?><option value="<?php echo $row_busca_categoria_evento['id_categoria_evento']?>"<?php if (!(strcmp($row_busca_categoria_evento['id_categoria_evento'], $row_busca_dados['id_categoria_evento']))) {echo "selected=\"selected\"";} ?>><?php echo $row_busca_categoria_evento['titulo_categoria_evento']?></option>
                                           <?php
                    } while ($row_busca_categoria_evento = mysql_fetch_assoc($busca_categoria_evento));
                      $rows = mysql_num_rows($busca_categoria_evento);
                      if($rows > 0) {
                          mysql_data_seek($busca_categoria_evento, 0);
                          $row_busca_categoria_evento = mysql_fetch_assoc($busca_categoria_evento);
                      }
                    ?> 
													</select>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label">Estabelecimento</label>
												<div class="col-md-9">
													<select id="id_negocio" name="id_negocio" data-plugin-selectTwo class="form-control populate placeholder" placeholder="Selecione o Estabelecimento" required>
                                                    <option value=""></option>
             <?php
                    do {  
                    ?><option value="<?php echo $row_busca_negocio['id_negocio']?>"<?php if (!(strcmp($row_busca_negocio['id_negocio'], $row_busca_dados['id_negocio']))) {echo "selected=\"selected\"";} ?>><?php echo $row_busca_negocio['titulo_negocio']?> | <?php echo $row_busca_negocio['titulo_localidade']?> - <?php echo $row_busca_negocio['titulo_estado']?></option>
                                           <?php
                    } while ($row_busca_negocio = mysql_fetch_assoc($busca_negocio));
                      $rows = mysql_num_rows($busca_negocio);
                      if($rows > 0) {
                          mysql_data_seek($busca_negocio, 0);
                          $row_busca_negocio = mysql_fetch_assoc($busca_negocio);
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
															<input name="data_evento" id="date" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control" value="<? if ($row_busca_dados["data_evento"]) {
					$datatrans = explode ("-", $row_busca_dados["data_evento"]); 
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
													<input name="titulo_evento" type="text" class="form-control" id="inputDefault" data-plugin-maxlength maxlength="200" value="<?=$row_busca_dados["titulo_evento"];?>" required>
												</div>
											</div>
                                            
                                            
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Descri&ccedil;&atilde;o</label>
												<div class="col-md-6">
													<textarea id="desc_evento" name="desc_evento" class="form-control" rows="3" data-plugin-maxlength maxlength="240"><?=$row_busca_dados["desc_evento"];?></textarea>
												</div>
											</div>
						
											<div class="form-group">
												<label for="tags-input" class="col-md-3 control-label">Tags</label>
												<div class="col-md-6">
													<input name="tags_evento" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" value="<?=$row_busca_dados["tags_evento"];?>" />
													<p>palavras-chave para mecanismos de busca externos e internos.</p>
												</div>
											</div>
                                            
                                            <div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["imagem_evento"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../imagensGaleria/<?=$row_busca_dados["imagem_evento"];?>" border="0" />
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
																<input id="imagem_evento" name="imagem_evento" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
                                                <div class="col-md-12">
                                                <p>Tamanho ideal para a imagem (600x315 Pixels)</p>
                                                </div>
											</div>
                                            
                                            <div class="form-group">
                                             <div class="col-sm-12 text-center">
                                             <? if ($row_busca_dados["imagem_inicial_evento"]) { ?>
                                             <p>Pré-Visualização:</p>
                                             <img class="img-responsive" src="../imagensGaleria/<?=$row_busca_dados["imagem_inicial_evento"];?>" border="0" />
											 <? } ?>
                                             </div>
                                            </div>
											<div class="form-group">
												<label class="col-md-3 control-label">Imagem de Exibi&ccedil;&atilde;o para Página Inicial</label>
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
																<input id="imagem_inicial_evento" name="imagem_inicial_evento" type="file"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
												</div>
                                                <div class="col-md-12">
                                                <p>Tamanho ideal para a imagem (600x768 Pixels)</p>
                                                </div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Posição</label>
												<div class="col-md-6">
													<select name="posicao_evento" id="posicao_evento" class="form-control mb-md" required>
														<option value="1" <?php if (!(strcmp(1, $row_busca_dados['posicao_evento']))) {echo "selected=\"selected\"";} ?>>Destaque Rotativo Esquerda</option>
                                                        <option value="4" <?php if (!(strcmp(4, $row_busca_dados['posicao_evento']))) {echo "selected=\"selected\"";} ?>>Destaque Rotativo Direita</option>
                                                        <option value="2" <?php if (!(strcmp(2, $row_busca_dados['posicao_evento']))) {echo "selected=\"selected\"";} ?>>Destaque Central</option>
                                                        <option value="3" <?php if (!(strcmp(3, $row_busca_dados['posicao_evento']))) {echo "selected=\"selected\"";} ?>>Internas</option>
													</select>
												</div>
											</div>
                                            
                                            <div class="form-group">
                                             <label class="col-md-3 control-label">Status</label>
                                             <div class="col-md-9">
                                              <div class="switch switch-sm switch-success">
											  <input id="status_evento" name="status_evento" value="1" type="checkbox" name="switch" data-plugin-ios-switch <?php if (!(strcmp(1, $row_busca_dados['status_evento']))) {echo "checked=\"checked\"";} else{ echo ""; } ?>/>
                                              </div>
											 </div>
                                            </div>
                                            <div class="form-group">
                                             <div class="pull-right">
                                              <?=$botao;?>
                                             </div>
                                            </div>
                                            <input type="hidden" name="<?=$operacao;?>" value="controle" />
                                            <input name="imagem_evento_original" type="hidden" id="imagem_evento_original" value="<?=$row_busca_dados["imagem_evento"];?>" />
                                            <input name="imagem_inicial_evento_original" type="hidden" id="imagem_inicial_evento_original" value="<?=$row_busca_dados["imagem_inicial_evento"];?>" />
      <input name="id_evento" type="hidden" id="id_evento" value="<?=$row_busca_dados["id_evento"];?>" />
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