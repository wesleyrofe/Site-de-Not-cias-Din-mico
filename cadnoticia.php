<?php
	require_once('conexao.php');


?>
<!DOCTYPE html>
<html>
<head>
	<title>Caadastro de notícias</title>
	<meta charset="utf-8">
</head>
<body>
	<form action="" method="post">
		Titulo: <input type="text" name="titulo" maxlenght="150"><br />
		Subtitulo: <input type="text" name="subtitulo" maxlenght="350"><br />
		Data: <input type="datetime-local" name="data"><br />
		Descrição: <textarea type="textarea" name="descricao" maxlenght="7000" col="" style="width:100%;height:400px"></textarea><br />
		Autor: <input type="text" name="autor"><br />
		Fonte: <input type="text" name="fonte"><br />
		Categoria: <select name="categ">
			<option>Selecione</option>
			<?php
				$query = "select idCategoria, nomeCategoria from tb_categoriaNoticias";
				$result = mysqli_query($conn,$query);
				if($result){
					while($row = mysqli_fetch_assoc($result)){
						echo"<option value='".$row['idCategoria']."'>".$row['nomeCategoria']."</option>";
					}
				}

			?>
		</select><br />
		Imagem: <input type="text" name="img"><br />
		<input type="hidden" name="bt">
		<input type="submit" class="btn">
	</form>
	<?php
		if(isset($_POST['bt'])){
			$titulo = $_POST['titulo'];
			$subtitulo = $_POST['subtitulo'];
			$descricao = str_replace("'", '"', $_POST['descricao']);
			$autor = $_POST['autor'];
			$fonte = $_POST['fonte'];	
			$categ = $_POST['categ'];
			$data = substr($_POST['data'],0,10);
			$time = substr($_POST['data'],11);

			$img = $_POST['img'];
			$query = "INSERT INTO `tb_noticia`(`tituloNoticia`, `subtituloNoticia`, `dataNoticia`, `descricaoNoticia`, `autorNoticia`, `fonteNoticia`, `idCategoria`) 
					  VALUES (
					  	'".$titulo."',
					  	'".$subtitulo."',
					  	'".$data." ".$time.":00',
					  	'".$descricao."',
					  	'".$autor."',
					  	'".$fonte."',
					  	".$categ."
					  )";
			$result = mysqli_query($conn,$query);

			if($result){

				$query = "select max(idNoticia) as idNoticia from tb_noticia";

				$result = mysqli_query($conn, $query);
				if($row = mysqli_fetch_assoc($result)){
					
					$idNoticia = $row["idNoticia"];

					$result = mysqli_query($conn, "INSERT INTO `tb_galeria`(`idNoticia`, `imagem`) VALUES (".$idNoticia.",'".$img."')");

					if($result){
						echo "Cadastrado";
						@mysqli_free_result($result);
						mysqli_close($conn);
					}else{
						echo "Falha";
						mysqli_close($conn);
					}
				}else{
					echo "Falha";
					mysqli_close($conn);
				}
			}else{
				echo "Falha";
				mysqli_close($conn);
			}

		}
	?>
</body>
</body>
</html>