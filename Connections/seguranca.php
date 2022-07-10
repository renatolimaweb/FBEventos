<?php
	if (!isset($_SESSION)) {
	  session_start();
	}

	if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
	  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
	}
	
	if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
		session_unregister('email');
		session_unregister('senha');
		session_destroy();
			
	  header("Location: index.php"); 
	}  

  if(!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) 
  { 
    header("Location: index.php"); 
    exit; 
  } else {
	  require_once('criativo.php');
	  $loginUsername = $_SESSION["email"];
	  $password		 = $_SESSION["senha"];
	  $MM_redirectLoginFailed = "index.php";
	  mysql_select_db($database_criativo, $conexao);
	  $LoginRS__query=sprintf("SELECT * FROM usuarios WHERE email='%s' AND senha='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
	  $LoginRS = mysql_query($LoginRS__query, $conexao) or die(mysql_error());
	  $loginFoundUser = mysql_num_rows($LoginRS);
	  if (!$loginFoundUser) {
		session_unregister('email');
		session_unregister('senha');
		session_destroy();
		
        header("Location: ". $MM_redirectLoginFailed );
	  }
  }
?>