<div id="modal-container">
  <div class="modal-background">
    <div class="modal">
      <h1>Registro de Producto</h1>
      <div class="divider"></div>
      <form class="modal-form" method="post" id="form-product" enctype="multipart/form-data">
        <div class="modal-item">
          <label class="item-label">Nombre</label>
          <input class="item-input" type="text" name="name" id="name">
        </div>
        <div class="modal-item">
          <label class="item-label">Descripcion</label>
          <textarea class="item-txtarea" name="description" id="description"></textarea>
        </div>
        <div class="modal-item">
          <label class="item-label">Foto</label>
          <input type="file" name="file" id="file" class="item-file">
          <label for="file" class="item-label-file" id="fichero">
            <span class="material-symbols-rounded  icon">Upload_file</span>
            Imagen</label>
        </div>
        <div class="divider"></div>
        <div class="modal-btns">
          <button class="btn-reg" type="submit">
            Registrar
              <div class="arrow-wrapper">
                <div class="arrow"></div>
              </div>
          </button>
          <button class="btn-clo" type="button" id="close">Cerrar</button>
        </div>
        <input type="hidden" name="action" value="product">
      </form>
    </div>
  </div>
</div>