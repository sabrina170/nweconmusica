<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {

    header('Location:index.php?nt=0');
} else {
    if ($_SESSION['user_tipo'] == 2) {
        header('Location:index.php?nt=0');
    }
}

?>

<?php include('header.php');
include('controlador/conexion.php');
$consulta = "SELECT * FROM adminuser where tipo = 2";
$resultado = mysqli_query($cn, $consulta);
?>
<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #06599e;"><strong>Profesores</strong> </h1>
                </div>

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card" style="padding: 10px;">

                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table" id="usuarios">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nr0</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Modificado</th>
                                <th scope="col">Meses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $posicion = 1;
                            foreach ($resultado as $show) {
                            ?>
                                <tr>
                                    <th>
                                        <?php echo $posicion;
                                        $posicion++ ?>
                                    </th>
                                    <td>
                                        <a href="" type="button" data-toggle="modal" data-target="#exampleModal<?php echo $show['id'] ?>">
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($show['foto']) ?>" width="60" height="60" class="d-inline-block align-top">
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $show['nombres'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['apellidos'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['especialidad'] ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($show['estado'] == 1) {
                                            echo '<span class="badge rounded-pill bg-success">Activo</span>';
                                        } else {
                                            echo '<span class="badge rounded-pill bg-danger">Desactivado</span>';
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        Por <strong style="color: #06599e;"><?php echo $show['modificado'] ?></strong>
                                    </td>
                                    <td>
                                        <a href="Meses.php?id=<?php echo $show['id']; ?>&nt=0">Meses <i class="fas fa-calendar-alt"></i></a>
                                    </td>



                                </tr>

                            <?php
                                include('modals/modal-fotoUser.php');
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>
<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {

        $('#usuarios').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },

        });
    });
</script>