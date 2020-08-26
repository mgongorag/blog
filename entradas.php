<?php require_once 'includes/redireccion.php'?>
<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<div id="principal">
    <h1>Ultimas Entradas</h1>
    <?php 
    $entradas = conseguirTodasLasEntradas($DB);
    
    
    if(!empty($entradas)):
        while($entrada = mysqli_fetch_assoc($entradas)):?>
            
             <article class="entrada">
                <a href="#">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><?=$entrada['Categoria'] . ' ' . $entrada['fecha'];?></span>
                    <p><?=substr($entrada['descripcion'], 0, 200)."..."?></p>
                 </a>
            </article>
    <?php
        endwhile;
    endif;
    ?>

    <div id="ver-todas">
        <a href="entradas.php">Ver todas</a>
    </div>
</div>

<?php require_once 'includes/pie.php';?>