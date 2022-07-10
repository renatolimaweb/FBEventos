<?
setcookie("email_usuario","",time()-86400);
setcookie("senha_usuario","",time()-86400);

require_once('../Connections/criativo.php');
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($accesscheck)) {
  $GLOBALS['PrevUrl'] = $accesscheck;
  session_register('PrevUrl');
}
if (isset($_POST['email_usuario'])) {
  $loginUsername = anti_invasao('email_usuario');
  $password 	 = anti_invasao('senha_usuario');
  
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "inicial.php";
  $MM_redirecttoReferrer = true;
  
  mysql_select_db($database_criativo, $conexao);
  $LoginRS__query=sprintf("SELECT * FROM usuarios WHERE email_usuario='%s' AND senha_usuario='%s'",
	get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), 
	get_magic_quotes_gpc() ? $password : addslashes($password)); 
  $LoginRS = mysql_query($LoginRS__query, $conexao) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  $loginUser = mysql_fetch_assoc($LoginRS);
  if ($loginFoundUser) {
	  setcookie("email_usuario",$loginUsername,time()+86400);
	  setcookie("senha_usuario",$password,time()+86400);
	  
	  header("Location: " . $MM_redirectLoginSuccess );
  } else { 
	?>
	<script language="JavaScript"> 
	<!-- 
	window.alert("Voce nao tem acesso!"); 
	location.href("index.php");
	//--> 
	</script> 
	<?  	
  }
}
?>
<script language="javascript" charset="utf-8">
function validaracesso(){
	    d = document.form1;
		erro=0;
		if (d.email_usuario.value == ""){
			alert("O login deve ser preenchido!");
			d.email_usuario.focus();
			return false;
		}

		if (d.senha_usuario.value == ""){
			alert("A senha deve ser preenchido!");
			d.senha_usuario.focus();
			return false;
		}

		return true;
}
</script>
<!doctype html>
<html class="fixed">
	<head>
        <meta charset="iso-8859-1">
        <title>FestasBrasil | Clouds | Sistema Gerenciador</title>
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
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="#" class="logo pull-left">
					<img src="img/logo_empresa.png" height="40" alt="TemNegócio" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-none text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Logar</h2>
					</div>
					<div class="panel-body">
						<form id="formulario_login" role="form" name="form1" action="<?php echo $loginFormAction; ?>" method="POST" onSubmit="return validaracesso()">
							<div class="form-group mb-lg">
								<label>E-mail</label>
								<div class="input-group input-group-icon">
									<input name="email_usuario" id="email_usuario" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Senha</label>
									<a href="#" class="pull-right">Esqueceu sua senha?</a>
								</div>
								<div class="input-group input-group-icon">
									<input name="senha_usuario" id="senha_usuario" type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4 text-right pull-right">
									<button type="submit" class="btn btn-primary hidden-xs">Entrar</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Entrar</button>
								</div>
							</div>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">Interativo Tecnologia &copy; Copyright. Todos os direitos reservados.</p>
			</div>
		</section>
		<!-- end: page -->

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