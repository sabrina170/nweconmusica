<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
} ?>

<?php include('header.php'); ?>
<?php
include('controlador/conexion.php');

$id = $_REQUEST['id'];
$pro = $cn->query("SELECT * FROM adminuser WHERE id='$id'")->fetch_assoc();
$registro = $cn->query("SELECT * FROM mes");
?>

<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <a href="profesores.php?nt=0" style="color: #06599e;"><strong> <i class="fas fa-arrow-alt-circle-left"></i> VOLVER</strong> </a>
                </div>
                <div class="col-sm-8">
                    <h1 class="text-center m-0" style="color: #06599e;">Meses de <strong><?php echo $pro['nombres'], ' ', $pro['apellidos']; ?> </strong> </h1>
                </div>

            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3">
        <?php
        $posicion = 1;
        foreach ($registro as $show) {
        ?>

            <div class="col mb-4">
                <a href="cursos.php?id_pro=<?php echo $id; ?>&id_mes=<?php echo $show['id_mes']; ?>&nt=0">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title text-center"><strong> <?php echo utf8_encode($show['nombre']) ?></strong></h5>
                            <br>
                            <?php
                            $idm = $show['id_mes'];
                            $registro2 = $cn->query("SELECT categoria.nombre as categoria, subcategoria.nombre as tipo, sum(cantidad) AS suma, tiempo
                            FROM curso  
                           JOIN categoria ON curso.categoria=categoria.id_cat
                           JOIN subcategoria ON curso.tipo=subcategoria.id_sub where
                                             id_mes = '$idm' and id_pro = '$id' GROUP BY categoria, tipo,tiempo");

                            if (mysqli_num_rows($registro2) == 0) {
                            ?>
                                <span class="text-primary mr-2">Ninguna categoria</span>

                            <?php
                            } else {
                            ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Categoria</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Tiempo</th>
                                                <th scope="col">Total</th>

                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($registro2 as $show) {
                                        ?> <tbody>
                                                <tr>
                                                    <td> <span class="text-primary mr-2"><?php echo $show['categoria']; ?></span> </td>
                                                    <td> <span class="text-primary mr-2"><?php echo $show['tipo']; ?></span> </td>
                                                    <td> <span class="text-primary mr-2"><?php echo $show['tiempo']; ?> " </span> </td>
                                                    <td> <span class="text-primary mr-2"><?php echo $show['suma']; ?></span> </td>
                                                </tr>
                                            <?php

                                        }
                                            ?>
                                    </table>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include('footer.php');
?>