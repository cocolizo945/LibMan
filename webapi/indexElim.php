<?php


    include 'BdConn.php';

    $pdo = new bDConn();
    
   if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id']))
		{
			$sql = $pdo->prepare("SELECT * FROM tb_eliminados WHERE id=:id");
			$sql->bindValue(':id', $_GET['id']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM tb_eliminados");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}

   // if($_SERVER['REQUEST_METHOD'] == 'GET'){

     //  $sql = $pdo->prepare("SELECT * FROM tb_eliminados");
     //  $sql -> execute();
      //  $sql-> setFetchMode(PDO::FETCH_ASSOC);
      //  header("HTTP/1.0 200 OK");
      //  echo json_encode($sql->fetchAll());
      //  exit();

   // }
//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO tb_eliminados (id, usuario, evento, fecha, id_eliminado, dato_eliminado) VALUES(:id, :usuario, :evento, :fecha, :id_elimnado, :dato_eliminado)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $_POST['id']);
        $stmt->bindValue(':usuario', $_POST['usuario']);
        $stmt->bindValue(':evento', $_POST['evento']);
		$stmt->bindValue(':fecha', $_POST['fecha']);
		$stmt->bindValue(':id_eliminado', $_POST['id_eliminado']);
		$stmt->bindValue(':dato_eliminado', $_POST['dato_eliminado']);
	
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
		$sql = "UPDATE tb_auditoria SET usuario=:usuario, evento=:evento, fecha=:fecha, id_eliminado=id_elimnado, dato_eliminado=:dato_eliminado: WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':usuario', $_GET['usuario']);
        $stmt->bindValue(':evento', $_GET['evento']);
        $stmt->bindValue(':fecha', $_GET['fecha']);
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->bindValue(':id_eliminado', $_GET['id_eliminado']);
		$stmt->bindValue(':dato_eliminado', $_GET['dato_eliminado']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM tb_eliminados WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");

?>