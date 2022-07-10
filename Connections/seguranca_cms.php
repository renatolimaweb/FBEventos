<?php
/*
	if (!isset($_SESSION)) {
	  session_start();
	}

	if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
	  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
	}
	
	if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
		session_unregister('email_usuario');
		session_unregister('senha_usuario');
		session_destroy();
			
	  header("Location: index.php"); 
	}  

  if(!isset($_SESSION["email_usuario"]) || !isset($_SESSION["senha_usuario"])) 
  { 
    header("Location: index.php"); 
    exit; 
  } else {
	  require_once('criativo.php');
	  $loginUsername = $_SESSION["email_usuario"];
	  $password		 = $_SESSION["senha_usuario"];
	  $MM_redirectLoginFailed = "index.php";
	  mysql_select_db($database_criativo, $conexao);
	  $LoginRS__query=sprintf("SELECT * FROM usuarios WHERE email_usuario='%s' AND senha_usuario='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
	  $LoginRS = mysql_query($LoginRS__query, $conexao) or die(mysql_error());
	  $loginFoundUser = mysql_num_rows($LoginRS);
	  if (!$loginFoundUser) {
		session_unregister('email_usuario');
		session_unregister('senha_usuario');
		session_destroy();
		
        header("Location: ". $MM_redirectLoginFailed );
	  }
  }
*/
?>
<?php
session_start();
	// ** Logout the current user. **
	if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
	  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
	}
	if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
	  //to fully log out a visitor we need to clear the session varialbles
	  setcookie("email_usuario","",time()-86400);
	  setcookie("senha_usuario","",time()-86400);
	  
	  session_destroy();

	  header("Location: index.php"); 
	}  
	
  if(!isset($_COOKIE["email_usuario"]) || !isset($_COOKIE["senha_usuario"])) 
  { 
    // Usuário não logado! Redireciona para a página de login 
    header("Location: index.php"); 
    exit; 
  } else {
	  require_once('criativo.php');
	  $loginUsername = $_COOKIE["email_usuario"];
	  $password		 = $_COOKIE["senha_usuario"];
	  
	  
	  $MM_redirectLoginFailed = "index.php";
	  mysql_select_db($database_criativo, $conexao);

	  $LoginRS__query=sprintf("SELECT * FROM usuarios WHERE email_usuario='%s' AND senha_usuario='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
	  $LoginRS = mysql_query($LoginRS__query, $conexao) or die(mysql_error());
	  $loginFoundUser = mysql_num_rows($LoginRS);
	  $loginUser = mysql_fetch_assoc($LoginRS);
	  $nome_usuario_autentica        = $loginUser["nome_usuario"];
	  $id_usuario_autentica          = $loginUser["id_usuario"];
	  $categoria_usuario_autentica   = $loginUser["id_categoria_usuario"];
	  $imagem_usuario_autentica      = $loginUser["imagem_usuario"];
	  $email_usuario_autentica       = $loginUser["email_usuario"];
	  $localidade_usuario_autentica  = $loginUser["id_localidade"];
	  if (!$loginFoundUser) {
		  setcookie("email_usuario","",time()-86400);
		  setcookie("senha_usuario","",time()-86400);
	      header("Location: ". $MM_redirectLoginFailed );
	  }
  }
  
 mysql_select_db($database_criativo, $conexao);
$query_busca_usuario_logado = "SELECT usuarios.nome_usuario, usuarios.id_categoria_usuario, usuarios.status_usuario, usuarios.email_usuario, categoria_usuario.id_categoria_usuario, categoria_usuario.titulo_categoria_usuario FROM usuarios, categoria_usuario WHERE id_usuario = '$id_usuario_autentica'";
$busca_usuario_logado = mysql_query($query_busca_usuario_logado, $conexao) or die(mysql_error());
$row_busca_usuario_logado = mysql_fetch_assoc($busca_usuario_logado);
$totalRows_busca_usuario_logado = mysql_num_rows($busca_usuario_logado);
$nome_usuario_logado = $row_busca_usuario_logado["nome_usuario"];
$codigo_usuario_logado = $row_busca_usuario_logado["id_usuario"];
$categoria_usuario_logado = $row_busca_usuario_logado["titulo_categoria_usuario"];
?>