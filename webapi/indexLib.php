<?php


    include 'BdConn.php';

    $pdo = new bDConn();
    
    
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id_libro']))
		{
			$sql = $pdo->prepare("SELECT * FROM tb_libros WHERE id_libro=:id");
			$sql->bindValue(':id', $_GET['id_libro']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM tb_libros");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.0 200 OK");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	}

   // if($_SERVER['REQUEST_METHOD'] == 'GET'){

       // $sql = $pdo->prepare("SELECT * FROM tb_libros");
       // $sql -> execute();
       // $sql-> setFetchMode(PDO::FETCH_ASSOC);
      // header("HTTP/1.0 200 OK");
      // echo json_encode($sql->fetchAll());
      //  exit();

    
//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO tb_libros (id_libro, titulo) VALUES(:id_libro, :titulo)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_libro', $_POST['id_libro']);
		$stmt->bindValue(':titulo', $_POST['titulo']);
		$stmt->bindValue(':anio_edic', $_POST['anio_edic']);
		$stmt->bindValue(':n_pag', $_POST['n_pag']);
		$stmt->bindValue(':id_aut', $_POST['id_aut']);
		$stmt->bindValue(':precii', $_POST['precio']);
		$stmt->bindValue(':id_edito', $_POST['id_edito']);
		$stmt->bindValue(':id_tema', $_POST['id_tema']);	
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
		$sql = "UPDATE tb_libros SET titulo=:titulo WHERE id_libro=:id_libro";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':titulo', $_GET['titulo']);
		$stmt->bindValue(':id_libro', $_GET['id_libro']);
		$stmt->bindValue(':anio_edic', $_GET['anio_edic']);
		$stmt->bindValue(':n_pag', $_GET['n_pag']);
		$stmt->bindValue(':precio', $_GET['precio']);
		$stmt->bindValue(':id_edito', $_GET['id_edito']);
		$stmt->bindValue(':id_tema', $_GET['id_tema']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM tb_libros WHERE id_libro=:id_libro";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_libro', $_GET['id_libro']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");

?>