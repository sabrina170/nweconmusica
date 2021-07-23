<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $dat['id_no'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                <button type="button" onclick="setTimeout(function(){location.reload();}, 3);" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="acciones-admin.php?action=actualizar" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" value="<?php echo $dat['id_no'] ?>" name="id2" id="id2">
                    Titulo
                    <input type="text" class="form-control" value="<?php echo $dat['titulo'] ?>" name="titulo2" id="titulo2">
                    <br>
                    Descripción
                    <textarea class="form-control" id="descripcion2" name="descripcion2" rows="4"><?php echo $dat['descripcion']; ?></textarea><br>
                    Imagen
                    <img id="img1" src="data:image/jpeg;base64,<?php echo base64_encode($dat['foto']) ?>" width="200" height="100"><br><br>
                    <input id="foto2" name="foto2" type="file">
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="setTimeout(function(){location.reload();}, 3);" class="btn btn-secondary" data-dismiss="modal" <?php echo false; ?>>Cerrar</button>
                    <button name="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function init() {
        var inputFile = document.getElementById('foto2');
        inputFile.addEventListener('change', mostrarImagen, false);
    }

    function mostrarImagen(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = document.getElementById('img1');
            img.src = event.target.result;
        }
        reader.readAsDataURL(file);
    }

    window.addEventListener('load', init, false);
</script>