<?php


    include 'BdConn.php';

    $pdo = new bDConn();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id_nac']))
		{
			$sql = $pdo->prepare("SELECT * FROM tb_nacionalidad WHERE id_nac=:id");
			$sql->bindValue(':id', $_GET['id_nac']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM tb_nacionalidad");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}
   // if($_SERVER['REQUEST_METHOD'] == 'GET'){

      //  $sql = $pdo->prepare("SELECT * FROM tb_nacionalidad");
       // $sql -> execute();
      //  $sql-> setFetchMode(PDO::FETCH_ASSOC);
      //  header("HTTP/1.0 200 OK");
      //  echo json_encode($sql->fetchAll());
       //exit();

  //  }
//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO tb_nacionalidad (id_nac, descri)
		 VALUES(:id_nac, :descri)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_nac', $_POST['id_nac']);
		$stmt->bindValue(':descri', $_POST['descri']);
	
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
		$sql = "UPDATE tb_nacionalidad SET+
		 descri=:descri WHERE id_nac=:id_nac";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':descri', $_GET['descri']);
		$stmt->bindValue(':id_nac', $_GET['id_nac']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM tb_nacionalidad WHERE id_nac=:id_nac";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_nac', $_GET['id_nac']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");

?>