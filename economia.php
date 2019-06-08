<?php
  require_once("conexao.php");
  require "DB.php";

?>
<html>
	<head>
		<title>
			Notícia cidade - Seu site de notícias
		</title>
		<meta charset="utf-8">
		
		<link rel="stylesheet" href="css/estilo.css" type="text/css">
	</head>
	<body id="duas-colunas" class="economia">

			<!-- Inicio Container -->
		<div id="container">

			<!-- Inicio Topo -->
			<div id="topo">
				<h1 class="logo">Noticias Brasils</h1>
				<ul id="navegacao">
					<li class="primeiro"><a id="home" href="index.php">Home</a></li>
					<li><a id="brasil" href="brasil.php">Brasil</a></li>
					<li><a id="mundo" href="mundo.php">Mundo</a></li>
					<li><a id="economia" href="economia.php">Economia</a></li>
					<li><a id="saude" href="saude.php">Saúde</a></li>
					<li><a id="ciencia" href="ciencia.php">Ciência</a></li>
					<li><a id="fotos" href="fotos.php">Fotos</a></li>
				</ul>
			</div>
			<!-- Fim Topo -->
			<!-- Inicio Conteudo -->
			<div id="conteudo">
				<div id="primario">
					<div class="caixa">						
						<?php   
							$id;

							if(isset($_GET['id'])){
								$id = $_GET['id'];
								abreNoticia($conn,$id);
							}else{?>
								<div class="caixa-conteudo">
									<ul id="lista-noticias" class="clear">
										<?php listarNoticiaEconomia($conn,0);?>
									</ul><!-- Fim Lista Noticias-->	
								</div><!-- Fim Caixa Conteudo-->

					  <?php } ?>
					</div>									
				</div>

				<div id="secundario">						
					<div class="caixa lateral">
						<h2>Mundo</h2>
						<ul>								
							<?php listarNoticiaMundo($conn,2);?>

						</ul>
						<br>
						<h2>Brasil</h2>
						<ul>								
							<?php listarNoticiaBrasil($conn,2);?>
						</ul-->
					</div>

				</div>		
				<!--div id="secundario">Conteudo 2</div-->

				<!-- Início Lateral
				<div id="lateral">

					<div class="caixa lateral">
						<h2>Entrevistas</h2>
						<div class="caixa-conteudo">
							<ul>
								<li><a>José Almeida</a></li>
								<li><a>Felipe Silva</a></li>
								<li><a>Renato Rodrigues</a></li>
								<li><a>Abelardo Silveira</a></li>
							</ul>
						</div>
					</div>
				</div>
				Fim Lateral -->

			</div>
			<!-- Fim Conteudo -->
		</div>
		<!-- Fim Container -->
		<div id="container-rodape" style="clear:both;">
			<div id="rodape">
				Rodapé
			</div>
		</div>
	</body>
</html>