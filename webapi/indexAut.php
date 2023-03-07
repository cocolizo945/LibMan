<?php


    include 'BdConn.php';

    $pdo = new bDConn();
    
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id_aut']))
		{
			$sql = $pdo->prepare("SELECT * FROM tb_autores WHERE id_aut=:id");
			$sql->bindValue(':id', $_GET['id_aut']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM tb_autores");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}

    //if($_SERVER['REQUEST_METHOD'] == 'GET'){

       // $sql = $pdo->prepare("SELECT * FROM tb_autores");
      //  $sql -> execute();
       // $sql-> setFetchMode(PDO::FETCH_ASSOC);
       // header("HTTP/1.0 200 OK");
      //  echo json_encode($sql->fetchAll());
      //  exit();

   // }
//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO tb_autores (id_aut, nombre, ap, id_nac VALUES(:id_aut, :nombre, :ap, :id_nac)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_aut', $_POST['id_aut']);
		$stmt->bindValue(':nombre', $_POST['nombre']);
		$stmt->bindValue(':ap', $_POST['ap']);
		$stmt->bindValue(':id_nac', $_POST['id_nac']);
		
	
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
		$sql = "UPDATE tb_autores SET nombre=:nombre, ap=:ap, id_nac=:id_nac WHERE id_aut=:id_aut";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':nombre', $_GET['nombre']);
		$stmt->bindValue(':id_aut', $_GET['id_aut']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM tb_autores WHERE id_aut=:id_aut";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_aut', $_GET['id_aut']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");

?>