<div id="modal-container">
  <div class="modal-background">
    <div class="modal order">
      <h1>Orden de Producto</h1>
      <div class="divider"></div>
      <form class="modal-form" method="post" id="form-product" enctype="multipart/form-data">
        <div class="container-order">
          <div class="order">
              <div class="order-item">
                <label class="item-label">Nombre</label>
                <input class="item-input" type="text" name="name" id="name" readonly="readonly">
              </div>
              <div class="order-item">
                <label class="item-label">Productos</label>
                <select class="item-input" name="product" id="options">
                    <option selected="true" disabled="disabled" value="0">Selecciona una opción</option>
                </select>
              </div>
              <div class="order-item">
                <label class="item-label">Foto</label>
                <input type="file" name="file" id="file" class="item-file">
                <label for="file" class="item-label-file" id="fichero" style="width: 240px;
      height: 140px;">
                <span class="material-symbols-rounded  icon">Upload_file</span>
                Imagen</label>
              </div>
            </div>

            <div class="order">
              <div class="order-item">
                <label class="item-label">Email</label>
                <input class="item-input" type="text" name="email" id="email" readonly="readonly">
              </div>
              <div class="order-item">
                <label class="item-label">Telefono</label>
                <input class="item-input" type="text" name="phone" id="phone" readonly="readonly">
              </div> 
              <div class="order-item">
                <label class="item-label">Descripcion</label>
                <textarea class="item-txtarea" name="description" id="description"></textarea>
              </div>
            </div> 
        </div>

        <div class="modal-btns">
          <button class="btn-reg" type="submit">
            Registrar
              <div class="arrow-wrapper">
                <div class="arrow"></div>
              </div>
          </button>
          <button class="btn-clo" type="button" id="close">Cerrar</button>
        </div>
        <input type="hidden" name="action" value="order">

      </form>
    </div>
  </div>
</div>