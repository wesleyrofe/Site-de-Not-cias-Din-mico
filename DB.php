	<?php
	
	function listaDestaque($conn){
		
		//$query = "SELECT idNoticia, tituloNoticia, descricaoNoticia, dataNoticia, nomeCategoria FROM tb_noticia n, tb_categoriaNoticias c WHERE idNoticia = (SELECT MAX( idNoticia ) FROM tb_noticia ) and n.idCategoria = c.idCategoria";
		$query = "
					SELECT n.idNoticia, tituloNoticia, subtituloNoticia, descricaoNoticia, dataNoticia, nomeCategoria, imagem
					FROM tb_noticia AS n
					RIGHT JOIN tb_categoriaNoticias AS c ON n.idCategoria = c.idCategoria
					RIGHT JOIN tb_galeria AS g ON n.idNoticia = g.idNoticia
					ORDER BY (dataNoticia) DESC

					";
		$result = mysqli_query($conn,$query);	
		if($result != null){		
			$i=1;
			while($i <= 2 && $destaque = mysqli_fetch_assoc($result)){
				$id = strval($destaque['idNoticia']);
				$titulo = $destaque['tituloNoticia'];
				$subtitulo = $destaque['subtituloNoticia'];
				$descricao = $destaque['descricaoNoticia'];
				$ctg = strtolower($destaque['nomeCategoria']);
				$imagem = $destaque['imagem'];


				$a = substr($destaque['dataNoticia'], 0,4);
				$m = substr($destaque['dataNoticia'], 5,2);			
				$d = substr($destaque['dataNoticia'], 8,2); 
				$data = $d."/".$m."/".$a;
				echo"<div class='caixa-conteudo justify'>";
				echo"<img src='".$imagem."' width='100%' height='220'>";
				echo"<h2 class='ctg".$ctg."'><a href='".$ctg.".php?id=".$id."'>".$titulo."</a></h2><h5 class='data ctg".$ctg."'>postado em ".$data."</h5>";
				//<img class="img-destaque" src="imagens/tecnologia.jpg">
				echo"<p>".$subtitulo."</p>";
				echo"</div>";
				$i++;
			}
		}else{
			echo"<center><strong>Atualizando notícias...</strong></center>";
		}
	}
	
	function listarNoticias($conn){
		$query = "
					SELECT n.idNoticia, tituloNoticia, subtituloNoticia, descricaoNoticia, dataNoticia, nomeCategoria, imagem
					FROM tb_noticia AS n
					RIGHT JOIN tb_categoriaNoticias AS c ON n.idCategoria = c.idCategoria
					RIGHT JOIN tb_galeria AS g ON n.idNoticia = g.idNoticia
					ORDER BY dataNoticia desc";

		$result = mysqli_query($conn,$query);	
		
		while($noticia = mysqli_fetch_assoc($result)){
			$id = $noticia['idNoticia'];
			$ctg = $noticia['nomeCategoria'];
			$titulo = $noticia['tituloNoticia'];
			$subtitulo = $noticia['subtituloNoticia'];
			$descricao = $noticia['descricaoNoticia'];
			$imagem = $noticia['imagem'];
			// Formata a data
			$a = substr($noticia['dataNoticia'], 0,4);
			$m = substr($noticia['dataNoticia'], 5,2);			
			$d = substr($noticia['dataNoticia'], 8,2); 
			$data = $d."/".$m."/".$a;
			//Formata a hora
			$time = substr($noticia['dataNoticia'], 11, 5);
			$time = str_replace(":","h",$time);

			
			echo"<li>";
					echo"<a href='".$ctg.".php?id=".$id."'>";
						echo"<div id='div-img'><img src='".$imagem."' width='130'></div>";
						echo"<div id='div-noticia'><h3>".resume($titulo,"tit")."</h3>".$data." às ".$time;
						echo"<p style=''>".resume($subtitulo,"sub")."</p></div>";
					echo"</a>";
			echo"</li>";
			if($id == 3 || $id == 8 || $id == 6 ){
				echo"<div style='padding:10px 25px;max-height:200px;'>";
				include_once("publicidade/pub1/index.html/index.html");
				echo"</div>";
			}
		}			
	}

	function listarNoticiasLateral($conn){
		$query = "
					SELECT n.idNoticia, tituloNoticia, subtituloNoticia, descricaoNoticia, dataNoticia, nomeCategoria, imagem
					FROM tb_noticia AS n
					RIGHT JOIN tb_categoriaNoticias AS c ON n.idCategoria = c.idCategoria
					RIGHT JOIN tb_galeria AS g ON n.idNoticia = g.idNoticia
					ORDER BY dataNoticia desc";

		$result = mysqli_query($conn,$query);	
		
		while($noticia = mysqli_fetch_assoc($result)){
			$id = $noticia['idNoticia'];
			$ctg = $noticia['nomeCategoria'];
			$titulo = $noticia['tituloNoticia'];
			$subtitulo = $noticia['subtituloNoticia'];
			$descricao = $noticia['descricaoNoticia'];
			$imagem = $noticia['imagem'];
			// Formata a data
			$a = substr($noticia['dataNoticia'], 0,4);
			$m = substr($noticia['dataNoticia'], 5,2);			
			$d = substr($noticia['dataNoticia'], 8,2); 
			$data = $d."/".$m."/".$a;
			//Formata a hora
			$time = substr($noticia['dataNoticia'], 11, 5);
			$time = str_replace(":","h",$time);
			if($id == 3 || $id == 6 || $id == 9){
				echo"<div style='width:100px;height:70px'>";
				echo"Olá olá olá Olá olá oláOlá olá oláOlá olá oláOlá olá oláOlá olá olá";
				echo"</div>";
			}
			echo"<li>";
					echo"<a href='".$ctg.".php?id=".$id."'>";
						echo"<img src='".$imagem."' width='130'>";
						echo"<h3>".resume($titulo,"tit")."</h3>".$data." às ".$time;
						echo"<p style=''>".resume($subtitulo,"sub")."</p>";
					echo"</a>";
			echo"</li>";
		}
	}

	function listarNoticiaBrasil($conn, $qtd){
		$idCategoria =  mysqli_query($conn, "select idCategoria from tb_categoriaNoticias where nomeCategoria = 'Brasil'");
		$idCategoria = mysqli_fetch_assoc($idCategoria);
		$idCategoria =  $idCategoria['idCategoria'];
		$query = "	SELECT n.idNoticia, tituloNoticia, subtituloNoticia, descricaoNoticia, dataNoticia, nomeCategoria, imagem
					FROM tb_noticia AS n
					RIGHT JOIN tb_categoriaNoticias AS c ON n.idCategoria = c.idCategoria
					RIGHT JOIN tb_galeria AS g ON n.idNoticia = g.idNoticia
					WHERE n.idCategoria = '".$idCategoria."'
					ORDER BY dataNoticia desc";
		$result = mysqli_query($conn,$query);	
		if($result != null){		
			$i=0;
			$cont = mysqli_query($conn,"select count(idNoticia) from tb_noticia as n where n.idCategoria = ".$idCategoria);
			$total = mysqli_fetch_row($cont);

			if($qtd == 0){
				$qtd = $total[0];
			}
			while($i <= $qtd && $noticia = mysqli_fetch_assoc($result)){
				$id = $noticia['idNoticia'];
				$ctg = $noticia['nomeCategoria'];
				$titulo = $noticia['tituloNoticia'];
				$subtitulo = $noticia['subtituloNoticia'];
				$descricao = $noticia['descricaoNoticia'];
				$imagem = $noticia['imagem'];
				
				// Formata a data
				$a = substr($noticia['dataNoticia'], 0,4);
				$m = substr($noticia['dataNoticia'], 5,2);			
				$d = substr($noticia['dataNoticia'], 8,2); 
				$data = $d."/".$m."/".$a;
				//Formata a hora
				$time = substr($noticia['dataNoticia'], 11, 5);
				$time = str_replace(":","h",$time);

				echo"<li>";
						echo"<a href='".$ctg.".php?id=".$id."'>";
							echo"<div id='div-img'><img src='".$imagem."' width='170'></div>";
							echo"<div id='div-noticia'><h3>".resume($titulo,"tit")."</h3>".$data." às ".$time."<br>";
							echo"<p style=''>".resume($subtitulo,"sub")."</p></div>";
						echo"</a>";
				echo"</li>";
				$i++;
			}			
			echo"<div style='padding:10px 35px;max-height:200px'>";
			include_once "publicidade/pub1/index.html/index.html";
			echo"</div>";
		}
	}

	function listarNoticiaMundo($conn, $qtd){
		$idCategoria =  mysqli_query($conn, "select idCategoria from tb_categoriaNoticias where nomeCategoria = 'Mundo'");
		$idCategoria = mysqli_fetch_assoc($idCategoria);
		$idCategoria =  $idCategoria['idCategoria'];

		$query = "	SELECT n.idNoticia, tituloNoticia, subtituloNoticia, descricaoNoticia, dataNoticia, nomeCategoria, imagem
					FROM tb_noticia AS n
					RIGHT JOIN tb_categoriaNoticias AS c ON n.idCategoria = c.idCategoria
					RIGHT JOIN tb_galeria AS g ON n.idNoticia = g.idNoticia
					WHERE n.idCategoria = '".$idCategoria."'
					ORDER BY dataNoticia desc";		

		$result = mysqli_query($conn,$query);	

		if($result != null){

			$i=0;
			$cont = mysqli_query($conn,"select count(idNoticia) from tb_noticia as n where n.idCategoria = ".$idCategoria);
			$total = mysqli_fetch_row($cont);

			if($qtd == 0){
				$qtd = $total[0];
			}

			while($i <= $qtd && $noticia = mysqli_fetch_assoc($result)){
				$result_ctg = mysqli_query($conn, "select nomeCategoria from tb_categoriaNoticias where idCategoria = $idCategoria");
				if($row = mysqli_fetch_assoc($result_ctg)){
					$noticia['nomeCategoria'] = $row['nomeCategoria'];
				}


				$id = $noticia['idNoticia'];
				$ctg = $noticia['nomeCategoria'];
				$titulo = $noticia['tituloNoticia'];
				$subtitulo = $noticia['subtituloNoticia'];
				$descricao = $noticia['descricaoNoticia'];
				$imagem = $noticia['imagem'];
				// Formata a data
				$a = substr($noticia['dataNoticia'], 0,4);
				$m = substr($noticia['dataNoticia'], 5,2);			
				$d = substr($noticia['dataNoticia'], 8,2); 
				$data = $d."/".$m."/".$a;
				//Formata a hora
				$time = substr($noticia['dataNoticia'], 11, 5);
				$time = str_replace(":","h",$time);

				echo"<li>";
						echo"<a href='".$ctg.".php?id=".$id."'>";
							echo"<div id='div-img'><img src='".$imagem."' width='170'></div>";
							echo"<div id='div-noticia'><h3>".resume($titulo,"tit")."</h3>".$data." às ".$time."<br>";
							echo"<p style=''>".resume($subtitulo,"sub")."</p></div>";
						echo"</a>";
				echo"</li>";
				$i++;
			}
			echo"<div style='padding:10px 35px;max-height:200px'>";
			include_once "publicidade/pub1/index.html/index.html";
			echo"</div>";
		}
	}

	function listarNoticiaEconomia($conn, $qtd){
		$idCategoria =  mysqli_query($conn, "select idCategoria from tb_categoriaNoticias where nomeCategoria = 'Economia'");
		$idCategoria = mysqli_fetch_assoc($idCategoria);
		$idCategoria =  $idCategoria['idCategoria'];

		$query = "	SELECT n.idNoticia, tituloNoticia, subtituloNoticia, descricaoNoticia, dataNoticia, nomeCategoria, imagem
					FROM tb_noticia AS n
					RIGHT JOIN tb_categoriaNoticias AS c ON n.idCategoria = c.idCategoria
					RIGHT JOIN tb_galeria AS g ON n.idNoticia = g.idNoticia
					WHERE n.idCategoria = '".$idCategoria."'
					ORDER BY dataNoticia desc";			
		$result = mysqli_query($conn,$query);	
		if($result != null){
			$i=0;
			$cont = mysqli_query($conn,"select count(idNoticia) from tb_noticia as n where n.idCategoria = ".$idCategoria);
			$total = mysqli_fetch_row($cont);

			if($qtd == 0){
				$qtd = $total[0];
			}
			while($i <= $qtd && $noticia = mysqli_fetch_assoc($result)){
				$result_ctg = mysqli_query($conn, "select nomeCategoria from tb_categoriaNoticias where idCategoria = $idCategoria");
				if($row = mysqli_fetch_assoc($result_ctg)){
					$noticia['nomeCategoria'] = $row['nomeCategoria'];
				}


				$id = $noticia['idNoticia'];
				$ctg = $noticia['nomeCategoria'];
				$titulo = $noticia['tituloNoticia'];
				$subtitulo = $noticia['subtituloNoticia'];
				$descricao = $noticia['descricaoNoticia'];
				$imagem = $noticia['imagem'];
				// Formata a data
				$a = substr($noticia['dataNoticia'], 0,4);
				$m = substr($noticia['dataNoticia'], 5,2);			
				$d = substr($noticia['dataNoticia'], 8,2); 
				$data = $d."/".$m."/".$a;
				//Formata a hora
				$time = substr($noticia['dataNoticia'], 11, 5);
				$time = str_replace(":","h",$time);

				echo"<li>";
						echo"<a href='".$ctg.".php?id=".$id."'>";
							echo"<div id='div-img'><img src='".$imagem."' width='170'></div>";
							echo"<div id='div-noticia'><h3>".resume($titulo,"tit")."</h3>".$data." às ".$time."<br>";
							echo"<p style=''>".resume($subtitulo,"sub")."</p></div>";
						echo"</a>";
				echo"</li>";
				$i++;
			}
			echo"<div style='padding:10px 35px;max-height:200px'>";
			include_once "publicidade/pub1/index.html/index.html";
			echo"</div>";
				
		}
	}

	function abreNoticia($conn,$id){
		$query = "
				SELECT tituloNoticia, subtituloNoticia,descricaoNoticia, autorNoticia, fonteNoticia, dataNoticia, nomeCategoria, imagem 
				FROM tb_noticia AS n 
				RIGHT JOIN tb_categoriaNoticias AS c ON n.idCategoria = c.idCategoria
				RIGHT JOIN tb_galeria AS g ON n.idNoticia = g.idNoticia
				WHERE n.idNoticia = ".$id;
		$result = mysqli_query($conn,$query);	
				
		if($noticia = mysqli_fetch_assoc($result)){
			$ctg = $noticia['nomeCategoria'];
			$titulo = $noticia['tituloNoticia'];
			$subtitulo = $noticia['subtituloNoticia'];
			$descricao = $noticia['descricaoNoticia'];
			$autor = $noticia['autorNoticia'];
			$fonte = $noticia['fonteNoticia'];
			$imagem = $noticia['imagem'];
			// Formata a data
			$a = substr($noticia['dataNoticia'], 0,4);
			$m = substr($noticia['dataNoticia'], 5,2);			
			$d = substr($noticia['dataNoticia'], 8,2); 
			$data = $d."/".$m."/".$a;
			//Formata a hora
			$time = substr($noticia['dataNoticia'], 11, 5);
			$time = str_replace(":","h",$time);

			//Fonte
			$arr = explode("/",$fonte);

			echo"<div class='caixa-conteudo justify'>";
			echo"<h1 class='ctg".$ctg."'>".$titulo."</h1>";
			echo"<h2>".$subtitulo."</h2>";
			echo"<h4 class='data'>".$data."  às ".$time." postado por ".$autor."</h4>";
			echo"<img class='img-destaque' src='".$imagem."'>";
			echo"<div style='padding:10px 35px;max-height:200px'>";
			include "publicidade/pub1/index.html/index.html";
			echo"</div>";
			echo"<p>".$descricao."</p>";
			echo"Fonte: <a href='".$fonte."'>".$arr[2]."</a>";
			echo"</div>";
		}
	}
    
    function listarGaleria($conn){
        $query = "SELECT g.idNoticia, imagem, nomeCategoria 
                  FROM tb_noticia AS n
                  RIGHT JOIN tb_galeria AS g ON n.idNoticia = g.idNoticia
                  RIGHT JOIN tb_categoriaNoticias AS c ON n.idCategoria = c.idCategoria";
        $result = mysqli_query($conn,$query);
        
        if($result != null){
            while($galeria = mysqli_fetch_assoc($result)){
            
                $idNoticia = $galeria['idNoticia'];
                $imagem = $galeria['imagem'];
                $pagina = strtolower($galeria['nomeCategoria']);
                echo"<div class='item-galeria'>";
                    echo"<a href='".$pagina.".php?id=".$idNoticia."'>";
                        echo"<div>";
                            echo"<img src='".$imagem."'>";
                        echo"</div>";
                    echo"</a>";

                echo"</div>";
            }
            
        }else{
            echo"<center>0 fotos encontradas</center>";
        }
    }

	function resume( $var, $tipo){
		if($tipo == "sub"){
			$limite = 150;	
		}elseif($tipo == "tit"){
			$limite = 82;
		}
		// Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.	
		if (strlen($var) > $limite)	{		
			$var = substr($var, 0, $limite);		
			$var = trim($var) . "...";	
		}
		return $var;
	}


?>