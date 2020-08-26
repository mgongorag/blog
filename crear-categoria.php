<?php require_once 'includes/redireccion.php'?>
<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<div id="principal">
     <h1>Crear Categorias</h1>
     <p>Agrega nuevas categorias al blog</p>
     <form action="guardar-categoria.php" method="POST">
          <label for="nombre">Nombre de la categoria</label>
          <input type="text" name="nombre">

          <input type="submit" value="Guardar">
     </form>

</div> <!--FIN PRINCIPAL

<?php require_once 'includes/pie.php';?>