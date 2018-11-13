<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Input</title>
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
  width: 100%;
  height: 100%;
  float: left;
  text-align:center;
}

  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  function editar(){
    document.location.href = "edit.php";
  }

  function database(metodo,token){
        var email = document.getElementById("mail").value;
        var pass = document.getElementById("pass").value;
        var phone = document.getElementById("phone").value;
        var company = document.getElementById("company").value;
        var fecha = document.getElementById("datepicker").value;

        //alert(fecha);

    var parametros = {
          "email" : email,
          "pass" : pass,
          "phone" : phone,
          "company" : company,
          "fecha" : fecha,
          "token": token,
          "metodo" : metodo
      }
      //alert(tipo);
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
</head>
<body>
<div class="container">
  
    <p><input type="email" id="mail" placeholder="Email"></p>
    <p><input type="password" id="pass" placeholder="Password"></p>
    <p><input type="text" id="phone" placeholder="Phone"></p>
    <p><input type="text" id="company" placeholder="Company Name"></p> 
    <p><input type="text" id="datepicker" placeholder="Date"></p>
    <button onclick="database(1,12345)">
      Save
    </button>
    <button onclick="editar()">
      Edit
    </button>
    
</div>
<div id="resultado"></div>
</body>
</html>