<?php
//Iniciar la sesion y la conexion a la DB
require_once 'includes/conexion.php';

//Recoger los datos del formulario
if(isset($_POST)){

     if(isset($_SESSION['error_login'])){
          unset($_SESSION['error_login']);
     }
     
     $email = trim($_POST['email']);
     $password = $_POST['password'];

     //Consulta para comprobar las credenciales
     $sql = "SELECT * FROM USUARIO WHERE email = '$email'";
     $login = mysqli_query($DB, $sql);

     if($login && mysqli_num_rows($login)==1){
          $usuario = mysqli_fetch_assoc($login);
          
          $verify = password_verify($password, $usuario['password']);
          

          if($verify){
               // Utilizar una sesion para guardar los datos del usuario logeado
               $_SESSION['usuario'] = $usuario;

               

          }else{
               $_SESSION['error_login'] = "Login incorrecto";
          }
     }else{
          $_SESSION['error_login'] = "Login incorrecto";
     }

    
}

header('Location: index.php');


