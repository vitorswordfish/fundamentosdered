<?php

	session_start();

	require_once('db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();


	$email = $_POST['email'];
	$senha = sha1($_POST['senha']);

	$sql = " select * from `usuario` where email = '$email' AND senha = '$senha' ";
	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if(isset($dados_usuario['privilegio'])){

      $arr = explode(' ',trim($dados_usuario['nome']));
      echo $arr[0];

			$_SESSION['privilegio'] = $dados_usuario['privilegio'];
			$_SESSION['email'] = $dados_usuario['email'];
			$_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
      $_SESSION['nome_completo'] = $dados_usuario['nome'];
			$_SESSION['nome'] = $arr[0];

			if($_SESSION['privilegio'] == 00){
					header('Location: ../../../zilla/sistema/cliente/');
			} else {
          header('Location: ../../../zilla/sistema/membro/')
      }

		} else {
			header('Location: ../../../zilla/index.php?critico=1');
		}
	} else {
		header('Location: ../../../zilla/index.php?critico=1');
	}
?>
