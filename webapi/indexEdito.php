<?php


    include 'BdConn.php';

    $pdo = new bDConn();
    
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id_edito']))
		{
			$sql = $pdo->prepare("SELECT * FROM tb_editoriales WHERE id_edito=:id");
			$sql->bindValue(':id', $_GET['id_edito']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM tb_editoriales");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}

   //if($_SERVER['REQUEST_METHOD'] == 'GET'){

     //   $sql = $pdo->prepare("SELECT * FROM tb_editoriales");
     //   $sql -> execute();
     //   $sql-> setFetchMode(PDO::FETCH_ASSOC);
      //  header("HTTP/1.0 200 OK");
      //  echo json_encode($sql->fetchAll());
      //exit();

  //  }
//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO tb_editoriales (id_edito, nom_tema, direcc , email, tel) VALUES(:id_tema, :nom_tema, :direcc, :email, :tel)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_edito', $_POST['id_edito']);
		$stmt->bindValue(':nom_edito', $_POST['nom_edito']);
		$stmt->bindValue(':direcc', $_POST['direcc']);
		$stmt->bindValue(':email', $_POST['email']);
		$stmt->bindValue(':tel', $_POST['tel']);
	
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
		$sql = "UPDATE tb_editoriales SET nom_edito, direcc , email, tel WHERE id_edito=:id_edito";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_edito', $_GET['id_edito']);
		$stmt->bindValue(':nom_edito', $_GET['nom_edito']);
		$stmt->bindValue(':direcc', $_GET['direcc']);
		$stmt->bindValue(':tel', $_GET['tel']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM tb_editoriales WHERE id_edito=:id_edito";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_edito', $_GET['id_edito']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");

?>