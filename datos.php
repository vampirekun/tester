<?php
 require_once('connection.php');
	$stmt = $connection1->prepare("SELECT * FROM userData WHERE idUser= ?");
					    // execute/run the statement. 
	try{
		$stmt->execute(array($_POST['id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	}catch(PDOException $exception){
		echo "Falla: ".json_encode($exception->getMessage())."<br>";
	}

?>


	<p><input type="email" id="mail" placeholder="Email" value="<?php echo $row[email]; ?>"></p>
		<input type="hidden" id="idUser" value="<?php echo $row[idUser]; ?>">
    <p><input type="password" id="pass" placeholder="Password" value="password"></p>
    <p><input type="text" id="phone" placeholder="Phone" value="<?php echo $row[phone]; ?>"></p>
    <p><input type="text" id="company" placeholder="Company Name" value="<?php echo $row[company]; ?>"></p> 
    <p><input type="text" id="datepicker" placeholder="Date" value="<?php echo $row[fecha]; ?>"></p>
    <button onclick="database(2,12345,<?php echo $row[idUser]; ?>)">
      Delete
    </button>
    <button onclick="database(3,12325,<?php echo $row[idUser]; ?>)">
      Update
    </button>
    <button onclick="newUser()">
      Add new
    </button>