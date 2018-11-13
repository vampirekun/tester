<?php
//echo $_SERVER['REQUEST_METHOD'];
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once('connection.php');


if($_SERVER['SERVER_ADDR'] != $_SERVER['REMOTE_ADDR']){
	
	echo json_encode(array('status' => 'ERROR', 'msg' => 'No Remote Access Allowed'));

}else{
	
	if(!is_null($_POST["token"])){

			switch($_POST['metodo']){
					case 1:
						//Insert						
						$stmt = $connection1->prepare("SELECT * FROM userData WHERE email= ?");
					    try{
								$stmt->execute(array($_POST['email']));
								$mails = $stmt->fetchAll(\PDO::FETCH_ASSOC);
					    }catch(PDOException $exception){
					    		$exception->getMessage();
								echo json_encode(array('status' => 'ERROR', 'msg' => $exception));
					    }
					    
					    
					    if( count($mails) > 0){		
				       			die(json_encode(array('status' => 'ERROR', 'msg' => 'Correo registrado')));
				       			echo "<script>$('#mail').focus();</script>";
				   				
				       	}else{
				       	
						       	$stmt = $connection1->prepare("INSERT INTO userData (email, pass, phone, company, fecha) VALUES (:email, :pass, :phone, :company, :fecha)");
						       							       	
						       	try{ 
								        
								      $stmt->execute(array(
								      			':email'   => $_POST['email'], 
								      			':pass'    => $_POST['pass'], 
								      			':phone'   => $_POST['phone'], 
								      			':company' => $_POST['company'], 
								      			':fecha'   => $_POST['fecha']
						       					));  
								      echo "<script>$(':input').val('');</script>";
								      
								}catch(PDOException $exception){ 
								       $exception->getMessage();
								       echo json_encode(array('status' => 'ERROR', 'msg' => $exception));
								      	
								 } 
				       	}
						
						break;
					
					case 2:
						//Delete
						$stmt = $connection1->prepare("UPDATE userData SET status='0' where idUser=?");
						       						       	
						       	try{ 
								        
								      $stmt->execute(array($_POST['id'])); 
								      echo json_encode(array('status' => 'SUCCESS', 'msg' => 'Se ha dado de baja'));
								      echo "<script>reload();</script>";
								      								      
								}catch(PDOException $exception){ 
								       $exception->getMessage();
								       echo json_encode(array('status' => 'ERROR', 'msg' => $exception));
								      	
								 } 
						break;
					
					case 3:
						//Update
						$stmt = $connection1->prepare("UPDATE userData SET email=:email, pass=:pass, phone=:phone, company=:company, fecha=:fecha where idUser=:idUser") ;
						       	//$connection1->exec('INSERT INTO userData (mail, pass, phone, company, fecha) VALUES ($_POST[email], $_POST[pass], $_POST[phone], $_POST[company], $_POST[fecha])');
						       	
						       	try{ 
								        
								      $stmt->execute(array(
								      			':email'   => $_POST['email'], 
								      			':pass'    => $_POST['pass'], 
								      			':phone'   => $_POST['phone'], 
								      			':company' => $_POST['company'], 
								      			':fecha'   => $_POST['fecha'],
								      			':idUser'   => $_POST['id']
						       					));  
								      echo "<script>$(':input').val('');</script>";

								      echo json_encode(array('status' => 'Success', 'msg' => 'Cambios guardados'));
								      
								}catch(PDOException $exception){ 
								       $exception->getMessage();
								       echo json_encode(array('status' => 'ERROR', 'msg' => $exception));
								      	
								 }
						break;
		}

	}
}
?>