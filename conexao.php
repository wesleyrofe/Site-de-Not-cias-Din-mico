<?php
	

		$conn = mysqli_connect("localhost","root","usbw","noticias");

		if($conn){

			mysqli_set_charset($conn,'utf8');
			return $conn;
		}else{
			echo"Falha ao conectar ao banco de dados";
		}

?>