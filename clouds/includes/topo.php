<meta charset="iso-8859-1">
<header class="header">
				<div class="logo-container">
					<a href="inicial.php" class="logo">
						<img src="img/logo_empresa.png" height="35" alt="TemNegócio" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
				<!-- start: search & user box -->
				<div class="header-right">
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="../conteudo/img/<?=$imagem_usuario_autentica;?>" alt="<?=$nome_usuario_logado;?>" class="img-responsive" data-lock-picture="../conteudo/img/!<?=$imagem_usuario_autentica;?>" />
							</figure>
							<div class="profile-info" data-lock-name="<?=$nome_usuario_logado;?>" data-lock-email="<?=$email_usuario_autentica;?>">
								<span class="name"><?=$nome_usuario_logado;?></span>
								<span class="role"><?=$categoria_usuario_logado;?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="ControleUsuario.php?cod=<?=$id_usuario_autentica;?>"><i class="fa fa-user"></i> Meus Dados</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo $_SERVER['PHP_SELF']."?doLogout=true"; ?>"><i class="fa fa-power-off"></i> Sair</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>