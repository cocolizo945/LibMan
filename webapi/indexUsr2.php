<?php


    include 'BdConn.php';

    $pdo = new bDConn();
    
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id_user']))
		{
			$sql = $pdo->prepare("SELECT * FROM tb_usuarios WHERE id_user=:id");
			$sql->bindValue(':id', $_GET['id_user']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM tb_usuarios");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}

   // if($_SERVER['REQUEST_METHOD'] == 'GET'){

      //  $sql = $pdo->prepare("SELECT * FROM tb_usuarios");
      //  $sql -> execute();
      //  $sql-> setFetchMode(PDO::FETCH_ASSOC);
     //   echo json_encode($sql->fetchAll());
      //  exit();

    //}
//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO tb_usuarios (id_user, tipo_user, nom_user, clave) VALUES(:id_user, :tipo_user, :nom_user, :clave)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_user', $_POST['id_user']);
		$stmt->bindValue(':tipo_user', $_POST['tipo_user']);
		$stmt->bindValue(':nom_user', $_POST['nom_user']);
		$stmt->bindValue(':clave', $_POST['clave']);
	
		$stmt->execute();
		$idPost = $pdo->lastInsertId(); 
		if($idPost)
		{
			header("HTTP/1.1 200 Ok");
			echo json_encode($idPost);
			exit;
		}
	}
	
	//Actualizar registro
	if($_SERVER['REQUEST_METHOD'] == 'PUT')
	{		
		$sql = "UPDATE tb_usuarios SET tipo_user=:tipo_user, nom_user=:nom_user, clave=:clave WHERE id_user=:id_user";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':tipo_user', $_GET['tipo_user']);
		$stmt->bindValue(':nom_user', $_GET['nom_user']);
		$stmt->bindValue(':clave', $_GET['clave']);
		$stmt->bindValue(':id_user', $_GET['id_user']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM tb_usuarios WHERE id_user=:id_user";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_user', $_GET['id_user']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");

?>