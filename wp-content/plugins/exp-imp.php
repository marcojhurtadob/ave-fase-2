<?php
/*
Plugin Name: Importar/Exportar Entradas
Description: Agrega un botón para importar y exportar entradas en el menú de la administración de WordPress.
Version: 1.0
Author: Marco Hurtado
*/

// Añade un botón "Importar/Exportar Entradas" en el menú de la administración de WordPress.
function add_import_export_entries_button_to_admin_menu() {
  if ( current_user_can( 'manage_options' ) ) {
    add_menu_page( 'Importar/Exportar Entradas', 'Importar/Exportar Entradas', 'manage_options', 'import_export_entries', 'render_import_export_entries_page', 'dashicons-admin-tools', 80 );
  }
}
add_action( 'admin_menu', 'add_import_export_entries_button_to_admin_menu' );

// Muestra la página de importar/exportar entradas.
function render_import_export_entries_page() {
  ?>
  <div class="wrap">
    <h1>Importar/Exportar Entradas</h1>
    <p>Selecciona una acción:</p>
    <p>
      <a class="button button-primary" href="#" id="exportar">Exportar Entradas</a>
      <a class="button button-secondary" href="#" id="importar">Importar Entradas</a>
    </p>
  </div>

<!-- Modal -->
<div id="modal1" class="modal">
  <div class="modal-content">
    <span class="closeexp">&times;</span>
    <h2>Lista de Entradas</h2>
    <button id="select-all-btn-2">Seleccionar todo</button>
    <table id="entry-table">
      <thead>
        <tr>
          <th>Título de la entrada</th>
          <th>Seleccionar</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $entries = get_posts(array(
          'post_type' => 'post',
          'posts_per_page' => -1,
        ));
        foreach ($entries as $entry) { ?>
          <tr>
            <td><?php echo $entry->post_title; ?></td>
            <td><input type="checkbox" class="entry-checkbox"></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <p>
      <button class="button button-primary" id="export-selected">Exportar Seleccionados</button>
    </p>
  </div>
</div>

<script type="text/javascript">
// Obtener el botón y el modal
var btn = document.getElementById("exportar");
var modal = document.getElementById("modal1");
// Obtener el elemento span que cierra el modal
var span = document.getElementsByClassName("closeexp")[0];
// Obtener el botón de seleccionar todo
var selectAllBtn2 = document.getElementById("select-all-btn-2");
// Obtener los elementos de casilla de verificación de entrada
var entryCheckboxes = document.querySelectorAll(".entry-checkbox");
// Cuando el usuario hace clic en el botón, abre el modal
btn.onclick = function() {
  modal.style.display = "block";
}
// Cuando el usuario hace clic en el span (x), cierra el modal
span.onclick = function() {
  modal.style.display = "none";
}

// Agregar el controlador de eventos para el botón Seleccionar todo
selectAllBtn2.addEventListener("click", function() {
  if (selectAllBtn2.textContent === "Seleccionar todo") {
    entryCheckboxes.forEach(checkbox => checkbox.checked = true);
    selectAllBtn2.textContent = "Deseleccionar todo";
  } else {
    entryCheckboxes.forEach(checkbox => checkbox.checked = false);
    selectAllBtn2.textContent = "Seleccionar todo";
  }
});

// Agregar el controlador de eventos para el botón Exportar seleccionados
document.getElementById("export-selected").addEventListener("click", function() {
  var selectedEntries = [];
  entryCheckboxes.forEach(function(checkbox, index) {
    if (checkbox.checked) {
      selectedEntries.push(<?php echo $entries[$index]->ID; ?>);
    }
  });
  console.log(selectedEntries);
  // Agregue el código aquí para exportar las entradas seleccionadas
});
  window.addEventListener("click", function(event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
    if (event.target === modal2) {
      modal2.style.display = "none";
    }
  });
</script>




<div id="modal2" class="modal2">
  <div class="modal-content">
    <span class="closeimp">&times;</span>
    <button id="select-all-btn">Seleccionar todo</button>
    <button id="importar-entrada">Importar lo seleccionado</button>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th scope="col" id="checkbox-header"></th>
          <th scope="col" id="title" class="manage-column column-title">Producto</th>
          <th scope="col" id="price" class="manage-column column-price">Precio</th>
        </tr>
      </thead>
      <tbody id="product-list">
      </tbody>
    </table>
  </div>
</div>
<script>
  // Obtener el botón y el modal
  var btn2 = document.getElementById("importar");
  var modal2 = document.getElementById("modal2");
  // Obtener el elemento span que cierra el modal
  var span2 = document.getElementsByClassName("closeimp")[0];
  // Cuando el usuario hace clic en el botón, abre el modal
  btn2.onclick = function() {
    modal2.style.display = "block";
    // Realizar la llamada a la API para obtener los productos
    fetch('https://fakestoreapi.com/products')
      .then(response => response.json())
      .then(products => {
        var productList = document.getElementById("product-list");
        products.forEach(product => {
          var productRow = document.createElement("tr");
          var productCheckbox = document.createElement("input");
          productCheckbox.type = "checkbox";
          var productName = document.createElement("td");
          var productPrice = document.createElement("td");
          productName.textContent = product.title;
          productPrice.textContent = product.price;
          productRow.appendChild(productCheckbox);
          productRow.appendChild(productName);
          productRow.appendChild(productPrice);
          productList.appendChild(productRow);
        });
      });
  }
  // Cuando el usuario hace clic en el span (x), cierra el modal
  span2.onclick = function() {
    modal2.style.display = "none";
  }
  // Agregar evento al botón "Seleccionar todo"
  var selectAllBtn = document.getElementById("select-all-btn");
  selectAllBtn.addEventListener("click", function() {
    var productCheckboxes = document.querySelectorAll("#product-list input[type='checkbox']");
    if (selectAllBtn.textContent === "Seleccionar todo") {
      productCheckboxes.forEach(checkbox => checkbox.checked = true);
      selectAllBtn.textContent = "Deseleccionar todo";
    } else {
      productCheckboxes.forEach(checkbox => checkbox.checked = false);
      selectAllBtn.textContent = "Seleccionar todo";
    }
  });

  // Agregar evento al botón "Importar lo seleccionado"
var importBtn = document.getElementById("importar-entrada");
importBtn.addEventListener("click", function() {
  var productCheckboxes = document.querySelectorAll("#product-list input[type='checkbox']:checked");
  productCheckboxes.forEach(function(checkbox) {
    var productName = checkbox.parentNode.nextElementSibling.textContent;
    var newPost = {
      title: productName,
      status: 'publish'
    };
    fetch('https://tu-sitio.com/wp-json/wp/v2/posts', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
      },
      body: JSON.stringify(newPost)
    }).then(response => response.json())
      .then(data => console.log(data));
  });
  modal2.style.display = "none";
});

</script>



<style>
.modal {
  display: none; 
  position: fixed; 
  z-index: 10000; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}
.modal2 {
  display: none; 
  position: fixed; 
  z-index: 10000; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
  margin-top: auto;
  margin-bottom: auto;
}

.modal-content {
  background-color: #fefefe; 
  margin: 15% auto; 
  padding: 20px; 
  border: 1px solid #888; 
  width: 80%; 
}

.closeexp, .closeimp {
  color: #aaa; 
  float: right; 
  font-size: 28px; 
  font-weight: bold; 
}

.close:hover, .close:focus {
  color: black; 
  text-decoration: none; 
  cursor: pointer; 
}
</style>

  <?php
}


