<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    
  
        if(isset($_POST['submit'])){
        require_once 'includes/conexion.php';
        if(!isset($_SESSION)){
            session_start();
        }
    
        $errores = array();
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($DB, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($DB, $_POST['apellido']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($DB, trim($_POST['email'])) : false;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($DB, $_POST['password']) : false;


        //Validar datos antes de guardar en la DB

        //Validacion del nombre
        if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
            $nombre_validado = true;
        }else{
            $errores['nombre'] = "El nombre no es valido";
            $nombre_validado = false;
        }
        //Validacion del apellido
        if (!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
            $apellido_validado = true;
        }else{
            $errores['apellido'] = "El apellido no es valido";
            $apellido_validado = false;
        }

        //validacion email
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_validado = true;
        }else{
            $errores['email'] = "El email no es valido";
            $email_validado = false;
        }

        if(!empty($password)){
            $password_validado = true;
        }else{
            $password_validado = false;
            $errores['password'] = 'La password esta vacia';
        }

        if(count($errores) == 0){
            $guardar_usuario = true;
            //Cifrar password
            $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
            $sql = "INSERT INTO USUARIO VALUES(null, '$nombre', '$apellido', '$email', '$password_segura', CURDATE());";
            $guadar = mysqli_query($DB, $sql);
            if($guadar){
                $_SESSION['completado'] = "El registro se ha completado con exito ";

            }else{
                $_SESSION['errores']['general'] = 'Fallo al guardar el usuario';
            }
        }else{
            $_SESSION['errores'] = $errores;
            header('Location: index.php');
        }
    }
header('Location: index.php');


/*
    if(!isset($_POST['submit'])){
        require_once 'includes/conexion.php';

        // LA FORMA DE LOS DIOSES CON JS
        $nombre =  isset($_POST['nombre'])? mysqli_real_escape_string($DB, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($DB, $_POST['apellido']): false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($DB, $_POST['email']) : false;
        $pass = isset($_POST['password']) ? mysqli_real_escape_string($DB, $_POST['password']) : false;
        echo $nombre;
        echo $apellido;
        echo $email;
        echo $pass;
        $errores = array();

        if(validarNombre($nombre) && validarApellido($apellido) &&
            validarEmail($email) && validarPassword($pass)){
                //CIFRAMOS LA PASSWORD
                
                echo 'hola chavales';

                $passEncrypt = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
                $stm = "INSERT INTO USUARIO VALUES(null, '$nombre', '$apellido', '$email', '$passEncrypt', CURDATE())";
                $rs = mysqli_query($DB, $stm);

                if($rs){
                    $errores['exito'] = "Registro Exitoso";
                    echo json_encode($errores);
                    
                }

            }else{
                echo 'hola chavales';
                echo json_encode($errores);
            }

}
//header('Location: registro.php');

function validarNombre($nombre){
    $validado = false;
    if(!preg_match("^[\w'\-,.][^0-9_!¡?÷?¿\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$", $nombre)){
        $validado = true;
    }else{
        $errores['nombre'] ="Nombre Invalido"; 
        
    }
    return $validado;
}

function validarApellido($apellido){
    $validado = false;
    if(!preg_match("^[\w'\-,.][^0-9_!¡?÷?¿\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$", $apellido)){
        $validado = true;
    }else{
        $errores['apellido'] ="Apellido invalido"; 
        
    }
    return $validado;
}

function validarEmail($email){
    $validado = false;
    if(!preg_match("[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}", $email)){
        $sqlQuery = "SELECT 1 FROM usuario WHERE email='$email' LIMIT 1;";
        $rs = mysqli_query($DB, $sqlQuery);


        if(!mysqli_num_rows($rs) > 0){
            $validado = true;
        }else{
            $errores['email'] = "Este correo ya existe";
        }
    }else{
        $errores['email'] = "Email invalido";
    }
    return $validado;
}

function validarPassword($pass){
    $validado = false;

    if(strlen($pass) > 5 ){
       $validado = true; 
    }
    return $validado;
}

*/