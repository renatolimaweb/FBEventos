<meta charset="iso-8859-1" />
<div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-camera"></i>
													</div>
												</div>
                                                <?
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina = "SELECT * FROM evento";
            $busca_total_pagina = mysql_query($query_busca_total_pagina, $conexao) or die(mysql_error());
            $row_busca_total_pagina = mysql_fetch_assoc($busca_total_pagina);
            $totalRows_busca_total_pagina = mysql_num_rows($busca_total_pagina);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_inativo = "SELECT * FROM evento WHERE status_evento <> 1";
            $busca_total_pagina_inativo = mysql_query($query_busca_total_pagina_inativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_inativo = mysql_fetch_assoc($busca_total_pagina_inativo);
            $totalRows_busca_total_pagina_inativo = mysql_num_rows($busca_total_pagina_inativo);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_ativo = "SELECT * FROM evento WHERE status_evento = 1";
            $busca_total_pagina_ativo = mysql_query($query_busca_total_pagina_ativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_ativo = mysql_fetch_assoc($busca_total_pagina_ativo);
            $totalRows_busca_total_pagina_ativo = mysql_num_rows($busca_total_pagina_ativo);
            ?>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Galerias de Fotos</h4>
														<div class="info">
															<strong class="amount"><?=$totalRows_busca_total_pagina;?></strong>
															<span class="text-primary" title="Ativo">(<?=$totalRows_busca_total_pagina_ativo;?>)</span>
                                                            <span class="text-default" title="Inativo">(<?=$totalRows_busca_total_pagina_inativo;?>)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="ConsultaEvento.php"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> Consultar</span></a>
                                                        <a href="ControleEvento.php"><span class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> Cadastrar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-calendar"></i>
													</div>
												</div>
                                                <?
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina = "SELECT * FROM agenda";
            $busca_total_pagina = mysql_query($query_busca_total_pagina, $conexao) or die(mysql_error());
            $row_busca_total_pagina = mysql_fetch_assoc($busca_total_pagina);
            $totalRows_busca_total_pagina = mysql_num_rows($busca_total_pagina);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_inativo = "SELECT * FROM agenda WHERE status_agenda <> 1";
            $busca_total_pagina_inativo = mysql_query($query_busca_total_pagina_inativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_inativo = mysql_fetch_assoc($busca_total_pagina_inativo);
            $totalRows_busca_total_pagina_inativo = mysql_num_rows($busca_total_pagina_inativo);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_ativo = "SELECT * FROM agenda WHERE status_agenda = 1";
            $busca_total_pagina_ativo = mysql_query($query_busca_total_pagina_ativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_ativo = mysql_fetch_assoc($busca_total_pagina_ativo);
            $totalRows_busca_total_pagina_ativo = mysql_num_rows($busca_total_pagina_ativo);
            ?>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Agenda</h4>
														<div class="info">
															<strong class="amount"><?=$totalRows_busca_total_pagina;?></strong>
															<span class="text-primary" title="Ativo">(<?=$totalRows_busca_total_pagina_ativo;?>)</span>
                                                            <span class="text-default" title="Inativo">(<?=$totalRows_busca_total_pagina_inativo;?>)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="ConsultaAgenda.php"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> Consultar</span></a>
                                                        <a href="ControleAgenda.php"><span class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> Cadastrar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                
                                 <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-briefcase"></i>
													</div>
												</div>
                                                <?
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina = "SELECT * FROM negocio";
            $busca_total_pagina = mysql_query($query_busca_total_pagina, $conexao) or die(mysql_error());
            $row_busca_total_pagina = mysql_fetch_assoc($busca_total_pagina);
            $totalRows_busca_total_pagina = mysql_num_rows($busca_total_pagina);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_inativo = "SELECT * FROM negocio WHERE status_negocio <> 1";
            $busca_total_pagina_inativo = mysql_query($query_busca_total_pagina_inativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_inativo = mysql_fetch_assoc($busca_total_pagina_inativo);
            $totalRows_busca_total_pagina_inativo = mysql_num_rows($busca_total_pagina_inativo);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_ativo = "SELECT * FROM negocio WHERE status_negocio = 1";
            $busca_total_pagina_ativo = mysql_query($query_busca_total_pagina_ativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_ativo = mysql_fetch_assoc($busca_total_pagina_ativo);
            $totalRows_busca_total_pagina_ativo = mysql_num_rows($busca_total_pagina_ativo);
            ?>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Estabelecimentos</h4>
														<div class="info">
															<strong class="amount"><?=$totalRows_busca_total_pagina;?></strong>
															<span class="text-primary" title="Ativo">(<?=$totalRows_busca_total_pagina_ativo;?>)</span>
                                                            <span class="text-default" title="Inativo">(<?=$totalRows_busca_total_pagina_inativo;?>)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="ConsultaNegocio.php"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> Consultar</span></a>
                                                        <a href="ControleNegocio.php"><span class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> Cadastrar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-file-text-o"></i>
													</div>
												</div>
                                                <?
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina = "SELECT * FROM pagina";
            $busca_total_pagina = mysql_query($query_busca_total_pagina, $conexao) or die(mysql_error());
            $row_busca_total_pagina = mysql_fetch_assoc($busca_total_pagina);
            $totalRows_busca_total_pagina = mysql_num_rows($busca_total_pagina);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_inativo = "SELECT * FROM pagina WHERE status_pagina <> 1";
            $busca_total_pagina_inativo = mysql_query($query_busca_total_pagina_inativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_inativo = mysql_fetch_assoc($busca_total_pagina_inativo);
            $totalRows_busca_total_pagina_inativo = mysql_num_rows($busca_total_pagina_inativo);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_ativo = "SELECT * FROM pagina WHERE status_pagina = 1";
            $busca_total_pagina_ativo = mysql_query($query_busca_total_pagina_ativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_ativo = mysql_fetch_assoc($busca_total_pagina_ativo);
            $totalRows_busca_total_pagina_ativo = mysql_num_rows($busca_total_pagina_ativo);
            ?>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">P&aacute;ginas</h4>
														<div class="info">
															<strong class="amount"><?=$totalRows_busca_total_pagina;?></strong>
															<span class="text-primary" title="Ativo">(<?=$totalRows_busca_total_pagina_ativo;?>)</span>
                                                            <span class="text-default" title="Inativo">(<?=$totalRows_busca_total_pagina_inativo;?>)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="ConsultaPagina.php"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> Consultar</span></a>
                                                        <a href="ControlePagina.php"><span class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> Cadastrar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-bullhorn"></i>
													</div>
												</div>
                                                <?
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina = "SELECT * FROM publicidade";
            $busca_total_pagina = mysql_query($query_busca_total_pagina, $conexao) or die(mysql_error());
            $row_busca_total_pagina = mysql_fetch_assoc($busca_total_pagina);
            $totalRows_busca_total_pagina = mysql_num_rows($busca_total_pagina);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_inativo = "SELECT * FROM publicidade WHERE status_publicidade <> 1";
            $busca_total_pagina_inativo = mysql_query($query_busca_total_pagina_inativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_inativo = mysql_fetch_assoc($busca_total_pagina_inativo);
            $totalRows_busca_total_pagina_inativo = mysql_num_rows($busca_total_pagina_inativo);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_pagina_ativo = "SELECT * FROM publicidade WHERE status_publicidade = 1";
            $busca_total_pagina_ativo = mysql_query($query_busca_total_pagina_ativo, $conexao) or die(mysql_error());
            $row_busca_total_pagina_ativo = mysql_fetch_assoc($busca_total_pagina_ativo);
            $totalRows_busca_total_pagina_ativo = mysql_num_rows($busca_total_pagina_ativo);
            ?>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Publicidade</h4>
														<div class="info">
															<strong class="amount"><?=$totalRows_busca_total_pagina;?></strong>
															<span class="text-primary" title="Ativo">(<?=$totalRows_busca_total_pagina_ativo;?>)</span>
                                                            <span class="text-default" title="Inativo">(<?=$totalRows_busca_total_pagina_inativo;?>)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="ConsultaPublicidade.php"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> Consultar</span></a>
                                                        <a href="ControlePublicidade.php"><span class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> Cadastrar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-align-left"></i>
													</div>
												</div>
                                                <?
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_noticia = "SELECT * FROM noticia";
            $busca_total_noticia = mysql_query($query_busca_total_noticia, $conexao) or die(mysql_error());
            $row_busca_total_noticia = mysql_fetch_assoc($busca_total_noticia);
            $totalRows_busca_total_noticia = mysql_num_rows($busca_total_noticia);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_noticia_inativo = "SELECT * FROM noticia WHERE status_noticia <> 1";
            $busca_total_noticia_inativo = mysql_query($query_busca_total_noticia_inativo, $conexao) or die(mysql_error());
            $row_busca_total_noticia_inativo = mysql_fetch_assoc($busca_total_noticia_inativo);
            $totalRows_busca_total_noticia_inativo = mysql_num_rows($busca_total_noticia_inativo);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_noticia_ativo = "SELECT * FROM noticia WHERE status_noticia = 1";
            $busca_total_noticia_ativo = mysql_query($query_busca_total_noticia_ativo, $conexao) or die(mysql_error());
            $row_busca_total_noticia_ativo = mysql_fetch_assoc($busca_total_noticia_ativo);
            $totalRows_busca_total_noticia_ativo = mysql_num_rows($busca_total_noticia_ativo);
            ?>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Notícias</h4>
														<div class="info">
															<strong class="amount"><?=$totalRows_busca_total_noticia;?></strong>
															<span class="text-primary" title="Ativo">(<?=$totalRows_busca_total_noticia_ativo;?>)</span>
                                                            <span class="text-default" title="Inativo">(<?=$totalRows_busca_total_noticia_inativo;?>)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="ConsultaNoticia.php"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> Consultar</span></a>
                                                        <a href="ControleNoticia.php"><span class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> Cadastrar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                <? if($categoria_usuario_autentica == 1) { ?>
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-map-marker"></i>
													</div>
												</div>
                                                <?
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_localidade = "SELECT * FROM localidade";
            $busca_total_localidade = mysql_query($query_busca_total_localidade, $conexao) or die(mysql_error());
            $row_busca_total_localidade = mysql_fetch_assoc($busca_total_localidade);
            $totalRows_busca_total_localidade = mysql_num_rows($busca_total_localidade);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_localidade_inativo = "SELECT * FROM localidade WHERE status_localidade <> 1";
            $busca_total_localidade_inativo = mysql_query($query_busca_total_localidade_inativo, $conexao) or die(mysql_error());
            $row_busca_total_localidade_inativo = mysql_fetch_assoc($busca_total_localidade_inativo);
            $totalRows_busca_total_localidade_inativo = mysql_num_rows($busca_total_localidade_inativo);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_localidade_ativo = "SELECT * FROM localidade WHERE status_localidade = 1";
            $busca_total_localidade_ativo = mysql_query($query_busca_total_localidade_ativo, $conexao) or die(mysql_error());
            $row_busca_total_localidade_ativo = mysql_fetch_assoc($busca_total_localidade_ativo);
            $totalRows_busca_total_localidade_ativo = mysql_num_rows($busca_total_localidade_ativo);
            ?>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Localidades</h4>
														<div class="info">
															<strong class="amount"><?=$totalRows_busca_total_localidade;?></strong>
															<span class="text-primary" title="Ativo">(<?=$totalRows_busca_total_localidade_ativo;?>)</span>
                                                            <span class="text-default" title="Inativo">(<?=$totalRows_busca_total_localidade_inativo;?>)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="ConsultaLocalidade.php"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> Consultar</span></a>
                                                        <a href="ControleLocalidade.php"><span class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> Cadastrar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-success">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-success">
														<i class="fa fa-user"></i>
													</div>
												</div>
                                                <?
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_usuario = "SELECT * FROM usuarios";
            $busca_total_usuario = mysql_query($query_busca_total_usuario, $conexao) or die(mysql_error());
            $row_busca_total_usuario = mysql_fetch_assoc($busca_total_usuario);
            $totalRows_busca_total_usuario = mysql_num_rows($busca_total_usuario);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_usuario_inativo = "SELECT * FROM usuarios WHERE status_usuario <> 1";
            $busca_total_usuario_inativo = mysql_query($query_busca_total_usuario_inativo, $conexao) or die(mysql_error());
            $row_busca_total_usuario_inativo = mysql_fetch_assoc($busca_total_usuario_inativo);
            $totalRows_busca_total_usuario_inativo = mysql_num_rows($busca_total_usuario_inativo);
			
			mysql_select_db($database_criativo, $conexao);
            $query_busca_total_usuario_ativo = "SELECT * FROM usuarios WHERE status_usuario = 1";
            $busca_total_usuario_ativo = mysql_query($query_busca_total_usuario_ativo, $conexao) or die(mysql_error());
            $row_busca_total_usuario_ativo = mysql_fetch_assoc($busca_total_usuario_ativo);
            $totalRows_busca_total_usuario_ativo = mysql_num_rows($busca_total_usuario_ativo);
            ?>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Usu&aacute;rios</h4>
														<div class="info">
															<strong class="amount"><?=$totalRows_busca_total_usuario;?></strong>
															<span class="text-primary" title="Ativos">(<?=$totalRows_busca_total_usuario_ativo;?>)</span>
                                                            <span class="text-default" title="Inativos">(<?=$totalRows_busca_total_usuario_inativo;?>)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="ConsultaUsuario.php"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> Consultar</span></a>
                                                        <a href="ControleUsuario.php"><span class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> Cadastrar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-success">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-success">
														<i class="fa fa-desktop"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Interface Web</h4>
                                                        <span class=" text-normal">Controle de scripts adicionais e<br> Integra&ccedil;&atilde;o de API.</span>
													</div>
													<div class="summary-footer">
														<a href="InterfaceWeb.php?cod=1"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-pencil"></i> Editar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-success">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-success">
														<i class="fa fa-mobile"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Interface Mobile</h4>
                                                        <span class=" text-normal">Controle de &iacute;cones e capas splash<br> para dispositivos touch.</span>
													</div>
													<div class="summary-footer">
														<a href="InterfaceMovel.php?cod=1"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-pencil"></i> Editar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-secondary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
														<i class="fa fa-code"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Desenvolvedor</h4>
                                                        <span class=" text-normal">Ferramenta para manipula&ccedil;&atilde;o de c&oacute;digos e<br> algoritmos.</span>
													</div>
													<div class="summary-footer">
														<button type="button" class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> Consultar</button>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                <div class="col-md-6">
									<section class="panel panel-featured-left panel-featured-secondary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
														<i class="fa fa-gears"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Configura&ccedil;&otilde;es</h4>
                                                        <span class=" text-normal">Controle de param&ecirc;tros e dados<br> espec&iacute;ficos.</span>
													</div>
													<div class="summary-footer">
														<a href="Config.php?cod=1"><span class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-pencil"></i> Editar</span></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                <? } ?>