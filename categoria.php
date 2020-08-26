<?php require_once 'includes/redireccion.php'?>
<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<?php
$categoria = conseguirCategoria($DB, $_GET['id']);
if(!isset($categoria['id'])){
     header("Location: index.php");
}
?>

<div id="principal">

     
    <h1>Ultimas Entradas de <?= $categoria['nombre'];?></h1>
    <?php 
    $entradas = conseguirTodasLasEntradas($DB, $categoria['id']);
    
    
    
    if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
        while($entrada = mysqli_fetch_assoc($entradas)):?>
            
             <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id'];?>">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><?=$entrada['Categoria'] . ' ' . $entrada['fecha'];?></span>
                    <p><?=substr($entrada['descripcion'], 0, 200)."..."?></p>
                 </a>
            </article>
    <?php
        endwhile;
        else:
    ?>
        <div class="alerta">No hay entradas en esta categoria :(</div>

    <?php endif;?>

    <div id="ver-todas">
        <a href="entradas.php">Ver todas</a>
    </div>
</div>

<?php require_once 'includes/pie.php';?>