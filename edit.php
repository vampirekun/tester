<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  	<style type="text/css">
		    html{
				  width: 100%;
				  height: 400px;
				  margin: 0;
				}
			button{
			  	  border: 0;
			}
			.container{
				  width: 50%;
				  height: 100%;
				  float: left;
				  text-align:right;
			}
			#resultado{
				  width: 50%;
				  height: 100%;
				  float: left;
				  text-align:center;
			}
			.rojo{
				color: red;
			}
			.azul{
				color: blue;
			}

  	</style>
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<script type="text/javascript">
  		function newUser(){
    		document.location.href = "form.php";
  		}
  		function getData(sel)
			{
			    //alert(sel.value);
			    var parametros = {
          			"id" : sel.value
                }
			    $.ajax({
                    data:  parametros, //datos que se envian a traves de ajax
                    url:   'datos.php', //archivo que recibe la peticion
                    type:  'post', //método de envio
                    beforeSend: function () {
                            $("#resultado").html("Procesando, espere por favor...");
                    },
                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                            $("#resultado").html(response);
                            
                    }
          		});
			}
		function database(metodo,token,id){
			        var email   = document.getElementById("mail").value;
			        var pass    = document.getElementById("pass").value;
			        var phone   = document.getElementById("phone").value;
			        var company = document.getElementById("company").value;
			        var fecha   = document.getElementById("datepicker").value;

        		    var parametros = {
				          "email"   : email,
				          "pass"    : pass,
				          "phone"   : phone,
				          "company" : company,
				          "fecha"   : fecha,
				          "token"   : token,
				          "metodo"  : metodo,
				          "id"      : id
				      }
      
			      if(email!="" && pass!="" && phone!="" &&  fecha!=""){
			          $.ajax({
			                    data:  parametros, //datos que se envian a traves de ajax
			                    url:   'api.php', //archivo que recibe la peticion
			                    type:  'post', //método de envio
			                    beforeSend: function () {
			                            $("#resultado").html("Procesando, espere por favor...");
			                    },
			                    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
			                            $("#resultado").html(response);
			                            
			                    }
			          });
			      }else{
			        alert("Rellene todos los campos");
			      }
  		}
  	</script>
  <?php 
  require_once('connection.php');
  $stmt = $connection1->query("SELECT email,idUser, status FROM userData");
  ?>
</head>
<body>
	<div class="container">
  		<select onchange="getData(this);"> 
  			<?php 
  				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  					if($row['status']==1){
  						$estilo="class='azul'";
  					}else{
  						$estilo="class='rojo'";
  					}
					echo "<option value='" . $row['idUser'] . "' ".$estilo.">" . $row['email'] . "</option>";
				}
  			?>
  		</select>
    
	</div>
	<div id="resultado"></div>
</body>
</html>