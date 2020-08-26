<?php require_once 'includes/redireccion.php'?>
<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<?php 

     $entradaSeleccionada = conseguirEntrada($DB, $_GET['id']);
     if(empty($entradaSeleccionada)){
          header("Location: index.php");
     }
?>


<div id="principal">

<h2><?= $entradaSeleccionada['titulo'];?></h2>
<span class="fecha"><?=$entradaSeleccionada['categoria'] . " " . $entradaSeleccionada['fecha'];?></span>
<p><?=$entradaSeleccionada['descripcion'];?></p>
<span class="fecha">Escrita por: <?= $entradaSeleccionada['nombre'] . " " . $entradaSeleccionada['apellido'];?></span>




</div>





<?php require_once 'includes/pie.php';?>