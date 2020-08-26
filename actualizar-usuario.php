<?php
     if(isset($_POST)){

          //conexion a la base de datos

          require_once 'includes/conexion.php';

          //Formulario de actualizacion

          $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($DB, $_POST['nombre']) : false;
          $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($DB, $_POST['apellido']) :  false;
          $email = isset($_POST['email']) ? mysqli_real_escape_string($DB, $_POST['email']) : false;


          //Array de errores
          $errores = array();

          //Validar los datos antes de guardar en la base de datos

          if(!empty($nombre) && !is_numeric($nombre)){
               $nombre_validado = true;
          }else{
               $nombre_validado = false;
               $errores['nombre'] = "El nombre no es valido";
          }

          if(!empty($apellido) && !is_numeric($apellido)){
               $apellido_validado = true;
          }else{
               $apellido_validado = false;
               $errores['apellido'] = "El apellido no es valido";
          }

          if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
               $email_validado = true;
          }else{
               $email_validado = false;
               $errores['email'] = "El email no es valido";
          }

          if(count($errores) == 0){
               $guardar_usuario = true;

               //Comprobar si el email ya existe
               $sql = "SELECT id, email FROM USUARIO WHERE email = '$email'";
               $isset_email = mysqli_query($DB, $sql);
               $isset_user = mysqli_fetch_assoc($isset_email);
               
               if($isset_user['id'] == $_SESSION['usuario']['id'] || empty($isset_user)){

               
               $id = $_SESSION['usuario']['id'];
               $sql = "UPDATE USUARIO SET nombre = '$nombre', apellido = '$apellido', email = '$email' WHERE id = '$id'";

               $guardar = mysqli_query($DB, $sql);

               if($guardar){
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellido'] = $apellido;
                    $_SESSION['usuario']['email'] = $email;
                    $_SESSION['completado'] = 'La actualizacion se ha completado con exito';
               }else{
                    $_SESSION['errores']['general'] = 'La actualizacion tuvo error';
               }

          }else{
               $_SESSION['errores']['general'] = 'El email ya existe';
               }
          }else{
               $_SESSION['errores'] = $errores;
          }

     }
     header("Location: mis-datos.php");