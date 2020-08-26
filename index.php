<?php require_once 'includes/cabecera.php'; ?>


<?php require_once 'includes/lateral.php'; ?>
<!--CAJA PRINCIPAL -->
<div id="principal">
    <h1>Ultimas Entradas</h1>
    <?php 
    $entradas = conseguirUltimasEntradas($DB);
    
    
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

<div class="clearfix"></div>
    
</div>

<!--PIE DE PAGINA -->
<?php require_once 'includes/pie.php'; ?>