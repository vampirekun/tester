<?php 

$db = parse_ini_file("config.ini");

$user = $db['user'];
$pass = $db['pass'];
$name1 = $db['name1'];
$name2 = $db['name2'];
$host = $db['host'];
$type = $db['type'];



//$connection2 = new PDO($type.':host='.$host.';dbname='.$name2.';charset=utf8', $user, $pass);

  try{ 
        $connection1 = new PDO($type.':host='.$host.';dbname='.$name1.';charset=utf8', $user, $pass, [PDO::ATTR_EMULATE_PREPARES => false, 
       	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
        
    } 
    catch(PDOException $exception){ 
       echo "Falla: ".json_encode($exception->getMessage())."<br>"; 
    } 

try{ 
        $connection2= new PDO($type.':host='.$host.';dbname='.$name2.';charset=utf8', $user, $pass,[PDO::ATTR_EMULATE_PREPARES => false, 
       	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
    } 
    catch(PDOException $exception){ 
       echo "Falla: ".json_encode($exception->getMessage())."<br>"; 
    } 

?>
