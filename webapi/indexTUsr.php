<?php


    include 'BdConn.php';

    $pdo = new bDConn();


if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id']))
		{
			$sql = $pdo->prepare("SELECT * FROM tipo_usuario WHERE id=:id");
			$sql->bindValue(':id', $_GET['id']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM tipo_usuario");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}
	
	
    //if($_SERVER['REQUEST_METHOD'] == 'GET'){

       // $sql = $pdo->prepare("SELECT * FROM tipo_usuario");
       // $sql -> execute();
       // $sql-> setFetchMode(PDO::FETCH_ASSOC);
      //  header("HTTP/1.0 200 OK");
      //  echo json_encode($sql->fetchAll());
      //  exit();

   // }
//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO tipo_usuario (id, nombre) VALUES(:id, :nombre)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $_POST['id']);
		$stmt->bindValue(':nombre', $_POST['nombre']);
	
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
		$sql = "UPDATE tipo_usuario SET nombre=:nombre WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':nombre', $_GET['nombre']);
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM tipo_usuario WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");

?>