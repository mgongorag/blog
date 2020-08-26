<?php
if(isset($_POST)){
     require_once('includes/conexion.php');
     
     $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($DB, $_POST['nombre']): false;

     //Arreglo de errores
     $errores = array();

     //Validar los datos antes de guardarlos en la DB
     //validar campo nombre
     if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
          $nombre_validado = true;
     }else{
          $nombre_validado = false;
          $errores['nombre'] = "La categoria no es valida";
     }

     if(count($errores) == 0){
          $sql = "INSERT INTO CATEGORIAS VALUES(null, '$nombre')";
          $guardar = mysqli_query($DB, $sql);
     }

}

header("Location: index.php");