<?php

function mostrarError($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty(($campo))) {
        $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . '</div>';
    }
    return $alerta;
}

function borrarErrores()
{
    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        unset($_SESSION['completado']);
    }
    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        unset($_SESSION['errores']);
    }
    if (isset($_SESSION['errores_entrada'])) {
        $_SESSION['errores_entrada'] = null;
    }
}

function conseguirCategorias($conexion)
{
    $sql = "SELECT * FROM CATEGORIAS ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    $result = array();
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $result = $categorias;
    }
    return $result;
}
function conseguirCategoria($conexion, $id)
{
    $sql = "SELECT * FROM CATEGORIAS WHERE id = '$id' ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    $result = array();

    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $result = mysqli_fetch_assoc($categorias);
    }
    return $result;
}

function conseguirUltimasEntradas($conexion)
{
    $sql = "SELECT e.*, c.nombre AS 'Categoria' FROM entradas e " .
        "INNER JOIN CATEGORIAS C ON " .
        "e.categoria_id = c.id " .
        "ORDER BY e.id DESC LIMIT 4";

    $entradas = mysqli_query($conexion, $sql);
    $resultado = array();

    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }
    return $resultado;
}

function conseguirTodasLasEntradas($conexion, $id = null)
{
    $sql = "SELECT e.*, c.nombre AS 'Categoria' FROM entradas e " .
        "INNER JOIN CATEGORIAS C ON " .
        "e.categoria_id = c.id ";


    if (!empty($id)) {
        $sql .= "where e.categoria_id = '$id' ";
    }

    $sql .=  "ORDER BY e.id DESC ";
    // echo $sql;
    // die();

    $entradas = mysqli_query($conexion, $sql);
    $resultado = array();

    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }
    return $resultado;
}

function conseguirEntrada($conexion, $id = null)
{
    
    if (!empty($id)) {
        

        $stm = "SELECT c.nombre as 'categoria', e.titulo, e.fecha, e.descripcion, u.nombre, u.apellido 
            FROM CATEGORIAS C 
            INNER JOIN ENTRADAS E 
            ON e.categoria_id = c.id
            INNER JOIN USUARIO U 
            ON U.id = e.usuario_id
            WHERE e.id = $id";

       
        $entradas = array();
        $result = mysqli_query($conexion, $stm);

        if($result && mysqli_num_rows($result) == 1){
            $entradas = mysqli_fetch_assoc($result);
        }
        
       return $entradas;
    }
}
