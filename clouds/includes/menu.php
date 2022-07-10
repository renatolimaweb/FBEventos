<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<meta charset="iso-8859-1">
<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li>
										<a href="inicial.php">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Painel</span>
										</a>
									</li>
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-camera" aria-hidden="true"></i>
											<span>Galerias de Fotos</span>
										</a>
										<ul class="nav nav-children">
											<li><a href="ConsultaEvento.php"><i style="font-size:13px;" class="fa fa-eye" aria-hidden="true"></i> Consultar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ControleEvento.php"><i style="font-size:13px;" class="fa fa-check" aria-hidden="true"></i> Cadastrar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ConsultaCategoriaEvento.php"><i style="font-size:13px;" class="fa fa-tag" aria-hidden="true"></i> Categorias</a></li>
										</ul>
									</li>
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-calendar" aria-hidden="true"></i>
											<span>Agenda</span>
										</a>
										<ul class="nav nav-children">
											<li><a href="ConsultaAgenda.php"><i style="font-size:13px;" class="fa fa-eye" aria-hidden="true"></i> Consultar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ControleAgenda.php"><i style="font-size:13px;" class="fa fa-check" aria-hidden="true"></i> Cadastrar</a></li>
										</ul>
									</li>
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-bullhorn" aria-hidden="true"></i>
											<span>Publicidade</span>
										</a>
										<ul class="nav nav-children">
											<li><a href="ConsultaPublicidade.php"><i style="font-size:13px;" class="fa fa-eye" aria-hidden="true"></i> Consultar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ControlePublicidade.php"><i style="font-size:13px;" class="fa fa-check" aria-hidden="true"></i> Cadastrar</a></li>
										</ul>
									</li>
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-align-left" aria-hidden="true"></i>
											<span>Notícias</span>
										</a>
										<ul class="nav nav-children">
											<li><a href="ConsultaNoticia.php"><i style="font-size:13px;" class="fa fa-eye" aria-hidden="true"></i> Consultar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ControleNoticia.php"><i style="font-size:13px;" class="fa fa-check" aria-hidden="true"></i> Cadastrar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ConsultaCategoriaNoticia.php"><i style="font-size:13px;" class="fa fa-tag" aria-hidden="true"></i> Categorias</a></li>
										</ul>
									</li>
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-briefcase" aria-hidden="true"></i>
											<span>Estabelecimentos</span>
										</a>
										<ul class="nav nav-children">
											<li><a href="ConsultaNegocio.php"><i style="font-size:13px;" class="fa fa-eye" aria-hidden="true"></i> Consultar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ControleNegocio.php"><i style="font-size:13px;" class="fa fa-check" aria-hidden="true"></i> Cadastrar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ConsultaCategoriaNegocio.php"><i style="font-size:13px;" class="fa fa-tag" aria-hidden="true"></i> Categorias</a></li>
										</ul>
									</li>
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-file-text-o" aria-hidden="true"></i>
											<span>Páginas</span>
										</a>
										<ul class="nav nav-children">
											<li><a href="ConsultaPagina.php"><i style="font-size:13px;" class="fa fa-eye" aria-hidden="true"></i> Consultar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ControlePagina.php"><i style="font-size:13px;" class="fa fa-check" aria-hidden="true"></i> Cadastrar</a></li>
										</ul>
									</li>
                                    <? if($categoria_usuario_autentica == 1) { ?>
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-map-marker" aria-hidden="true"></i>
											<span>Localidades</span>
										</a>
										<ul class="nav nav-children">
											<li><a href="ConsultaLocalidade.php"><i style="font-size:13px;" class="fa fa-eye" aria-hidden="true"></i> Consultar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ControleLocalidade.php"><i style="font-size:13px;" class="fa fa-check" aria-hidden="true"></i> Cadastrar</a></li>
										</ul>
									</li>
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-user" aria-hidden="true"></i>
											<span>Usu&aacute;rios</span>
										</a>
										<ul class="nav nav-children">
											<li><a href="ConsultaUsuario.php"><i style="font-size:13px;" class="fa fa-eye" aria-hidden="true"></i> Consultar</a></li>
                                            <hr style="margin-top:5px; margin-bottom:5px;">
											<li><a href="ControleUsuario.php"><i style="font-size:13px;" class="fa fa-check" aria-hidden="true"></i> Cadastrar</a></li>
										</ul>
									</li>
									<li>
										<a href="InterfaceWeb.php?cod=1">
											<i class="fa fa-desktop" aria-hidden="true"></i>
											<span>Interface Web</span>
										</a>
									</li>
                                    <li>
										<a href="InterfaceMovel.php?cod=1">
											<i class="fa fa-mobile" aria-hidden="true"></i>
											<span>Interface Mobile</span>
										</a>
									</li>
                                    <li>
										<a href="#">
											<i class="fa fa-code" aria-hidden="true"></i>
											<span>Desenvolvedor</span>
										</a>
									</li>
                                    <li>
										<a href="Config.php?cod=1">
											<i class="fa fa-cogs" aria-hidden="true"></i>
											<span>Configura&ccedil;&otilde;es</span>
										</a>
									</li>
                                    <? } ?>
								</ul>
							</nav>
						</div>
				
					</div>
				
				</aside>