<?
include("../Connections/criativo.php");
include("../Connections/seguranca_cms.php");
//COMANDO CONTROLE//
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

$operacao = "MM_insert";
$botao = "<button type=\"button\" onClick=\"javascript:$('#uploadify').uploadifyUpload();\" class=\"btn btn-lg btn-success\"><i class=\"fa fa-upload\"></i> Enviar</button>";
?>
<!doctype html>
<html class="fixed">
	<head>
        <meta charset="iso-8859-1">
		<title>Controle de Envio de Imagens | FestasBrasil | Clouds | Sistema Gerenciador</title>
        <link rel="shortcut icon" href="img/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<script src="assets/vendor/modernizr/modernizr.js"></script>

<link href="jquery/css/default.css" rel="stylesheet" type="text/css" />
<link href="jquery/css/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="jquery/swfobject.js"></script>
<script type="text/javascript" src="jquery/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#uploadify").uploadify({
		'uploader'       : 'jquery/uploadify.swf',
		'script'         : 'jquery/uploadify.php',
		'cancelImg'      : 'jquery/cancel.png',
		'folder'         : '../imagensGaleria/<?=$row_busca_evento["pasta_evento"];?>',
		'buttonText'	 : 'Selecionar',
		'fileDesc'		 : 'Imagens',
		'fileExt'		 : '*.jpg;*.jpeg;*.png;*.gif',
		'queueID'        : 'fileQueue',
		'auto'           : false,
		'multi'          : true
	});
});
</script>
<!--
<script type="text/javascript">

//SuckerTree Vertical Menu 1.1 (Nov 8th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["suckertree1"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
    ultags[t].parentNode.getElementsByTagName("a")[0].className="subfolderstyle"
		if (ultags[t].parentNode.parentNode.id==menuids[i]) //if this is a first level submenu
			ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px" //dynamically position first level submenus to be width of main menu item
		else //else if this is a sub level submenu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }
    }
		for (var t=ultags.length-1; t>-1; t--){ //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
		ultags[t].style.visibility="visible"
		ultags[t].style.display="none"
		}
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus)

</script>
-->
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
						<h2>Controle de Envio de Imagens</h2>
					</header>

					<!-- start: page -->
                    <div class="panel-body">
					<form method="post" name="controle" action="<?php echo $editFormAction; ?>" ENCTYPE="multipart/form-data">
                    <div class="row">
                     <div class="col-md-12">
				     <input type="file" name="uploadify" id="uploadify" /><br/><br/>                
                     <div id="fileQueue" style="border:1px solid #CCC; border-radius:4px; padding:10px; margin-bottom:30px;"></div>
                     <a href="javascript:$('#uploadify').uploadifyUpload();"><?=$botao;?></a>
                     </div>
                    </div>
              <input type="hidden" name="<?=$operacao;?>" value="controle">
              <input name="id_evento" type="hidden" id="id_evento" value="<?=$colname_busca_evento;?>" />
            </form> 
					</div>
					<!-- end: page -->
				</section>
			</div>
		</section>

<!--
		<script src="assets/vendor/jquery/jquery.js"></script>
        -->
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/vendor/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
        

        <!-- Specific Page Vendor -->

		<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
        <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
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
		
		<script src="assets/javascripts/theme.js"></script>
		
		<script src="assets/javascripts/theme.custom.js"></script>
		
		
		<script src="assets/javascripts/theme.init.js"></script>


	</body>
</html>
<?php include("../Connections/end_criativo.php"); ?>