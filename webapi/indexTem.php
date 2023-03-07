<?php


    include 'BdConn.php';

    $pdo = new bDConn();
    
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id_tema']))
		{
			$sql = $pdo->prepare("SELECT * FROM tb_temas WHERE id_tema=:id");
			$sql->bindValue(':id', $_GET['id_tema']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM tb_temas");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}

   //if($_SERVER['REQUEST_METHOD'] == 'GET'){

      //  $sql = $pdo->prepare("SELECT * FROM tb_temas");
      //  $sql -> execute();
       // $sql-> setFetchMode(PDO::FETCH_ASSOC);
       // header("HTTP/1.0 200 OK");
      //  echo json_encode($sql->fetchAll());
      //  exit();
//   }
//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO tb_temas (id_tema, nom_tema) VALUES(:id_tema, :nom_tema)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_tema', $_POST['id_tema']);
		$stmt->bindValue(':nom_tema', $_POST['nom_tema']);
	
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
		$sql = "UPDATE tb_temas SET nom_tema=:nom_tema WHERE id_tema=:id_tema";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':nom_tema', $_GET['nom_tema']);
		$stmt->bindValue(':id_tema', $_GET['id_tema']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM tb_temas WHERE id_tema=:id_tema";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_tema', $_GET['id_tema']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");

?>