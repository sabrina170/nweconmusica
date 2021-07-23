<div class="modal fade" id="exampleModal<?php echo $show['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($show['foto']) ?>" class="img-fluid" width="200" height="200">
            </div>
        </div>
    </div>
</div>