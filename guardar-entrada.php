<?php
if(isset($_POST)){
     require_once('includes/conexion.php');
     $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($DB, $_POST['titulo']) : false;

     $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($DB, $_POST['descripcion']): false;

     $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria']:false;

     $usuario = isset($_SESSION['usuario']['id']);

     //Validacion

     $errores = array();

     if(empty($titulo)){
          $errores['titulo'] = 'El titulo no es valido';
     }

     if(empty($descripcion)){
          $errores['descripcion'] = 'La descripcion no es valida';
     }
     
     if(empty($categoria) && !is_numeric($categoria)){
          $errores['categoria'] = 'La categoria no es valida';
     }

    
     if(count($errores) == 0){
          $sql = "INSERT INTO ENTRADAS VALUES(null, '$usuario', '$categoria', '$titulo', '$descripcion', curdate());";
          $result = mysqli_query($DB, $sql);
          header('Location: index.php');
     }else{
          $_SESSION['errores_entrada'] = $errores;
          header('Location: crear-entradas.php');
          
     }     
}
