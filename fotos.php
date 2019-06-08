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
	<body id="uma-coluna" class="fotos">

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
                <?php listarGaleria($conn);?>
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