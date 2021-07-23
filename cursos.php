<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
    if ($_SESSION['user_tipo'] == 2) {
        header('Location:index.php?nt=0');
    } else if ($_SESSION['user_tipo'] == 3) {
        header('Location:index.php?nt=0');
    }
} ?>

<?php include('header.php');
$id = $_REQUEST['id_pro'];
$id_mes = $_REQUEST['id_mes'];
$nt = $_REQUEST['nt'];

$pro = $cn->query("SELECT * FROM adminuser WHERE id='$id'")->fetch_assoc();
$mes = $cn->query("SELECT * FROM mes WHERE id_mes='$id_mes'")->fetch_assoc();

$registro = $cn->query("SELECT id_curso, id_pro, categoria.nombre as categoria, subcategoria.nombre as tipo, cantidad,tiempo,fecha , id_pro,id_mes
FROM curso  
JOIN categoria ON curso.categoria=categoria.id_cat
JOIN subcategoria ON curso.tipo=subcategoria.id_sub
where id_pro = '$id' and id_mes = '$id_mes' ");

$consulta_categoria = $cn->query("SELECT * FROM categoria");
?>

<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">
    <?php
    if ($nt == 1) {
    ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
            Swal.fire(
                'Insertado!',
                'Curso creado correctamente!',
                'success'
            ).then(function() {
                window.location.href = "cursos.php?id_pro=<?php echo $id ?>&id_mes=<?php echo $id_mes; ?>&nt=0";
            });
            // window.location.href = "tutoriales.php ";
        </script>
    <?php
    }
    ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <a href="meses.php?id=<?php echo $id; ?>" style="color: #06599e;"><strong> <i class="fas fa-arrow-alt-circle-left"></i> VOLVER</strong> </a>
                </div>
                <div class="col-sm-8">
                    <h1 class="m-0" style="color: #06599e;">Cursos del mes de <strong><?php echo $mes['nombre']; ?></strong> de <strong> <?php echo $pro['nombres'], ' ', $pro['apellidos']; ?></strong> </h1>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Insertar un Curso
                </div>
                <div class="card-body">
                    <form action="controlador/acciones.php?accion=RegistrarCurso" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputState">Categoria</label>
                                <select class="form-control" name="categoria" id="categoria" required>
                                    <option value="" selected>Seleciona una categoria</option>
                                    <?php
                                    foreach ($consulta_categoria as $categoria) {
                                        echo '<option  value="' . $categoria['id_cat'] . '">' . $categoria['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputState">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo" required>
                                    <option value="" disabled selected>Selecciona un tipo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Tiempo</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tiempo" value="45" checked>
                                    <label class="form-check-label">45</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tiempo" value="60">
                                    <label class="form-check-label">60</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tiempo" value="90">
                                    <label class="form-check-label">90</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Fecha</label>
                                <input type="date" class="form-control" name="fecha" value="<?php echo date("Y-m-d"); ?>" required>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="id_pro" id="id_pro" value="<?php echo $id; ?>">
                        <input type="hidden" class="form-control" name="id_mes" id="id_mes" value="<?php echo $id_mes; ?>">

                        <button type="submit" class="btn btn-primary">Insertar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card" style="padding: 10px;">

                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table" id="usuarios">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nr0</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Tiempo</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $posicion = 1;
                            foreach ($registro as $show) {
                            ?>
                                <tr>
                                    <th>
                                        <?php echo $posicion;
                                        $posicion++ ?>
                                    </th>
                                    <td>
                                        <?php echo $show['categoria'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['tipo'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['cantidad'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['tiempo'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['fecha'] ?>
                                    </td>
                                    <td>
                                        <a href="Edit-curso.php?id_cur=<?php echo $show['id_curso'] ?>&id=<?php echo $show['id_pro'] ?>&id_mes=<?php echo $show['id_mes'] ?>"> <i class="fas fa-edit"></i></a>
                                        <a href="" data-mdb-toggle="modal" data-mdb-target="#eliminar_modal<?php echo $show['id_curso'] ?>"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                            <?php
                                // include('modals/modal-EliminarCurso.php');
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
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
<script>
    $(document).ready(function() {
        $('#categoria').on('change', function() {

            var categoria = $(this).val();

            if ($('#categoria').val() == "") {
                $('#tipo').empty();
                // $('<option value = "">Selecciona un tipo</option>').appendTo('#tipo');
                $('#tipo').attr('disabled', 'disabled');
            } else {
                $('#tipo').removeAttr('disabled', 'disabled');

                $.ajax({
                    type: "POST",
                    url: "acciones.php",
                    data: {
                        accion: "BuscarColegio",
                        idcategoria: categoria
                    },
                    success: function(data) {
                        console.log(data);
                        $('#tipo').html(data);
                    }
                });

                //$('#tipo').load('colegios_get.php?colegio_distrito=' + $('#colegio_distrito').val());
            }
        });

        $('#categoria2').on('change', function() {


            var categoria = $(this).val();

            if ($('#categoria2').val() == "") {
                $('#tipo2').empty();
                // $('<option value = "">Selecciona un tipo</option>').appendTo('#tipo');
                $('#tipo2').attr('disabled', 'disabled');
            } else {
                $('#tipo2').removeAttr('disabled', 'disabled');

                $.ajax({
                    type: "POST",
                    url: "acciones.php",
                    data: {
                        accion: "BuscarColegio",
                        idcategoria: categoria
                    },
                    success: function(data) {
                        console.log(data);
                        $('#tipo2').html(data);
                    }
                });

                //$('#tipo').load('colegios_get.php?colegio_distrito=' + $('#colegio_distrito').val());
            }
        });
    });
</script>