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
$id_cur = $_REQUEST['id_cur'];
$id = $_REQUEST['id'];
$id_mes = $_REQUEST['id_mes'];
$nt = $_REQUEST['nt'];


$registro = $cn->query("SELECT * from curso where id_curso = '$id_cur' ");

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
                    <a href="cursos.php?id=<?php echo $id; ?>&id_mes=<?php echo $id_mes ?>&nt=0" style="color: #06599e;"><strong> <i class="fas fa-arrow-alt-circle-left"></i> VOLVER</strong> </a>
                </div>
                <div class="col-sm-8">
                    <h1 class="m-0" style="color: #06599e;"> <strong> Editar Curso</strong> </h1>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $posicion = 1;
            foreach ($registro as $show) {
            ?>
                <div class="card">
                    <div class="card-header">
                        Insertar un Curso
                    </div>
                    <div class="card-body">
                        <form action="controlador/acciones.php?accion=RegistrarCurso" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputState">Categoria</label>
                                    <select class="form-control" name="categoria" id="categoria" value="">
                                        <option value="" selected>Seleciona una categoria</option>
                                        <?php

                                        $id = $show['categoria'];
                                        foreach ($consulta_categoria as $categoria) {

                                            $id = $categoria['id_cat'];
                                        ?>
                                            <option value="<?php echo  $categoria['id_cat'] ?>">
                                                i <?php echo  $categoria['nombre'] ?></option>

                                        <?php
                                        }
                                        $idcat = $categoria['id_cat'];
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputState">Tipo</label>
                                    <select class="form-control" name="tipo" id="tipo" value="">
                                        <option value="" disabled selected>Selecciona un tipo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Cantidad</label>
                                    <input type="number" class="form-control" name="cantidad" value="<?php echo  $show['cantidad']; ?>">
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
                                    <input type="date" class="form-control" name="fecha" value="<?php echo date("Y-m-d"); ?>" value="">
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="id_pro" id="id_pro" value="<?php echo $id; ?>">
                            <input type="hidden" class="form-control" name="id_mes" id="id_mes" value="<?php echo $id_mes; ?>">

                            <button type="submit" class="btn btn-primary">Insertar</button>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
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