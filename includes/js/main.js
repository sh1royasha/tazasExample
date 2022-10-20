$(document).ready(function (){

  const path = window.location.pathname;

  if(path === "/newproyect/index.php"){
    
    log();

    registerusers();

    login();
    
  }else if(path === "/newproyect/dashboard.php"){

    logout();

    inputfile()

    modalOC();

    getproducts(); 

    showProducts();

    addOrders();

    getordersuser();
    

  }else if(path === "/newproyect/admin.php"){
    logout();

    inputfile();
    
    getproducts();

    modalOC();

    addPO();

    deleteProducts();

    getorders();

    users();

    let cont = document.getElementById('modal_container');
    let updfro = document.getElementById('form_updest');
    let close = document.querySelector('.btn_close')
    close.addEventListener("click", () => {
      cont.classList.remove("show");
      updfro.reset()
    });
  }

  /* FUNCIONES  */
  function  showProducts(){
    $.ajax({
      url: "includes/php/actions.php",
      type: "GET",
      dataType: "json",
      data: {action: "getproducts"},
      success: function(response){
        let obj = jQuery.isEmptyObject(response);
        if(obj != true){
          $.each(response,function(index, value){
            $('#options').append(
              $('<option>').val(value.name).text(value.name)
            )
          })
        }else{
        console.log(response);
      }
      }
    })
  }

  /* FUNCION ELIMINAR PRODUCTOS */
  function deleteProducts(){
    $("#product-gallery").on("click", ".del", function() {
      const indice = $(this).val();
      const url = $(this).parent().find('.url-photo').val();
      Swal.fire({
        title: 'Deseas eliminar el producto?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si',
        denyButtonText: `cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "includes/php/actions.php",
            type: "GET",
            dataType: "json",
            data:{action: "delproducts", id:indice, url:url},
            success: function(response){
              Swal.fire({
                text: 'Producto Eliminado Correctamente!',
                icon: 'success',
                timer: 1500,    
                showConfirmButton: false
              }).then(function (result){
                $("#product-gallery").empty();
                getproducts();
              })
            }
          })
        } 
      })
    })
  }

  /* Ajax para obtener productos */
  function getproducts(){
    $.ajax({
      url: "includes/php/actions.php",
      type: "GET",
      dataType: "json",
      data: {action: "getproducts"},
      success: function(response){
        if(response.length>=1){
          if(path === "/newproyect/dashboard.php"){
            $.each(response,function(index, value){
              $('#product-gallery').append(
                $('<article class="gallery-img">').append(
                  $('<img>').attr('src','assets/uploads/'+value.photo),
                    $('<div class="transparent-box">').append(
                      $('<div class="caption">').append(
                        $('<p class="caption-title">').text(value.name),
                        $('<p class="caption-description">').text(value.description), 
                    )
                  )
                )
              );
            })
          }else{
            $.each(response,function(index, value){
              $('#product-gallery').append(
                $('<article class="gallery-img">').append(
                  $('<img>').attr('src','assets/uploads/'+value.photo),
                    $('<div class="transparent-box">').append(
                      $('<div class="caption">').append(
                        $('<p class="caption-title">').text(value.name),
                        $('<p class="caption-description">').text(value.description),
                        $('<button type="hidden" class="material-symbols-rounded del"> ').val(value.id).text("delete"),
                        $('<input type="hidden" class="url-photo">').val(value.photo),   
                        $('<p class="caption-description">').text(value.estado), 
                    )
                  )
                )
              );
            })
          }
        }else{
          $('#product-gallery').append(
            $('<h1>').text(""),
            $('<h1>').text("No hay ningun producto agregado")
          )
        }
      }
    })
  }

  /* OBTENER ORDENES */
  function getorders(){
    $.ajax({
      url: "includes/php/actions.php",
      type: "GET",
      dataType: "json",
      data: {action: "getorders"},
      success: function(response){
        if(response.length>=1){
              $.each(response,function(index, value){
              $('#task_table').append(
                $('<tr>').append(
                  $('<td>').text(value.id),
                  $('<td>').text(value.name),
                  $('<td>').text(value.email),
                  $('<td>').text(value.phone),
                  $('<td>').text(value.product),
                  $('<td>').text(value.description),
                  $('<td>').append(
                    $('<img>').attr('src','assets/uploads/'+value.model),
                  ),
                  $('<td>').text(value.estado),
                  $('<td>').append(
                    $('<button class="btn-estado material-symbols-rounded  icon"></button>').val(value.id).text("calendar_month")
                  )
                )
              )
              })
              updateEstado();
        }else{
          $('#task_table').append(
            $('<td COLSPAN="6" class="empty">').text('No hay ordenes disponibles')
          )
        }

      }
    })
  }

  function getordersuser(){
    var username = document.getElementById('username').value;
    $.ajax({
      url: "includes/php/actions.php",
      type: "GET",
      dataType: "json",
      data: {action: "getordersuser",user:username},
      success: function(response){
        console.log(response);
        if(response.length>=1){
              $.each(response,function(index, value){
              $('#task_table').append(
                $('<tr>').append(
                  $('<td>').text(value.id),
                  $('<td>').text(value.product),
                  $('<td>').text(value.description),
                  $('<td>').append(
                    $('<img>').attr('src','assets/uploads/'+value.model),
                  ),
                  $('<td>').text(value.estado)
                )
              )
              })
        }
      }
    })
  }

   /* LIMPIAR FORMULARIO PRODUCT */
   function cleanModal(){
    $('#form-product')[0].reset();
    $("#fichero").empty();
    $("#fichero").append(
      $("#fichero").text("imagen"),
      $('<span class="material-symbols-rounded  icon">').text("Upload_file")
    )
  }

    /* Tab Login */
  function log(){
      /* LOGIN */
      $('#btn-login').click(function(e) {
        $('#btn-register').removeClass('active');
        $('#btn-login').addClass('active');
        $('#form_register').addClass('disabled');
        $('#form_login').removeClass('disabled');
      });

      $('#btn-register').click(function(e) {
        $('#btn-login').removeClass('active');
        $('#btn-register').addClass('active');       
        $('#form_login').addClass('disabled');
        $('#form_register').removeClass('disabled');
      });
  }

  /* AGREGAR USUARIOS AJAX */
  function registerusers(){
    $(document).on("submit", "#form_register", function (event){
      event.preventDefault();
      let status = false
      let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/
      
      const name = document.getElementById("name");
      const email = document.getElementById("email");
      const password = document.getElementById("password");
      const phone = document.getElementById("phone");
      
      if(name.value === '' ){
        status = true;
        name.classList.add('error');
      }else{
        name.classList.remove('error');
      }

      if(phone.value === '' ){
        status = true;
        phone.classList.add('error');
      }else{
        phone.classList.remove('error');
      }

      if(!regexEmail.test(email.value)){
        status = true
        email.classList.add('error');
      }else{
        email.classList.remove('error');
      }

      if(password.value === '' ){
        status = true;
        password.classList.add('error');
      }else{
        password.classList.remove('error');
      }

      if(status){
        Swal.fire({
          title: 'Faltan Campos Por Rellenar!',
          icon: 'error',
          timer: 1500,    
          showConfirmButton: false
        })
      }else{
        $.ajax({
            url: "includes/php/actions.php",
            type: "POST",
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response){
                if(response){
                    Swal.fire({
                      text: 'Usuario Agregado Correctamente!',
                      icon: 'success',
                      timer: 1500,    
                      showConfirmButton: false
                    }).then(function (result){
                      $('#form_register')[0].reset();
                    })
                }
            },
            error: function(){
               Swal.fire({
                text: 'El Usuario Ya Se Encuentra Registrado',
                icon: 'error',
                timer: 1500,    
                showConfirmButton: false
              })
            }    
        })
      }
    })
  }

  /* INICIAR SESIÓN AJAX */
  function login(){
    $(document).on("submit", "#form_login", function (e){
      e.preventDefault();
      const Iemail = document.getElementById("LogEmail");
      const Ipassword = document.getElementById("LogPassword");
      let status = false;

      if(Iemail.value === '' ){
        status = true;
        Iemail.classList.add('error');
      }else{
        Iemail.classList.remove('error');
      }

      if(Ipassword.value === '' ){
        status = true;
        Ipassword.classList.add('error');
      }else{
        Ipassword.classList.remove('error');
      }
      
      if(status){
        Swal.fire({
          title: 'Faltan Campos Por Rellenar!',
          icon: 'error',
          timer: 1500,    
          showConfirmButton: false
        })
      }else{
        $.ajax({
          url: "includes/php/actions.php",
          type: "POST",
          dataType: "json",
          data: new FormData(this),
          processData: false,
          contentType: false,
          success: function(response){
            let obj = jQuery.isEmptyObject(response);
            if(obj != true){
              let id = response['id'];
              let name = response['name'];
              let rol = response['role'];
              let phone = response['phone'];
              let email = response['email'];
              $.ajax({
                url:'includes/php/sessiones.php',
                type: "POST",
                data:{
                  idusuario: id,
                  nombre: name,
                  rol: rol,
                  telefono: phone,
                  email: email
                }
              }).done(function(response){
                  Swal.fire({
                    title: 'Usuario Correcto!',
                    icon: 'success',
                    timer: 1500,    
                    showConfirmButton: false
                  }).then(function (result){
                    location.reload(true);
                  })
              })
            }else{
              Swal.fire({
                title: 'Usuario Incorrecto!',
                text: 'El usuario o contraseña son incorrectos',
                icon: 'error',
                timer: 1500,
                showConfirmButton: false
              })
            }
          },
          error: function(){
            Swal.fire({
              title: 'Usuario Incorrecto!',
              text: 'El usuario o contraseña son incorrectos',
              icon: 'error',
              showCloseButton: true,
              showConfirmButton: false
            })
          }    
        })
      }  
    })
  }

  /* Ajax para cerrar sesión */
  function logout(){
    $('#logout').click(function(){
      $.ajax({
        url: "includes/php/logout.php",
        type: "GET",
        data: {action: "out"},
          beforeSend: function(){
            console.log("waiting.....");
          },
          success: function(response){
            Swal.fire({
              title: 'Cerrar Sesión!',
              icon: 'success',
              timer: 1500,    
              showConfirmButton: false
            }).then(function (result){
              location.reload(true);
            })
          }
      });
    })
  }

  /* Funcion agrega nombre del archivo a input */
  function inputfile(){
    /* NOMBRE INPUT FILE */
    document.getElementById('file').onchange = function () {
      document.getElementById('fichero').innerHTML = document.getElementById('file').files[0].name;
    }
  }

  /* Funcion para abrir y cerrar modal */
  function modalOC(){
    $('.button').click(function(){
      var buttonId = $(this).attr('id');
      $('#modal-container').removeAttr('class').addClass(buttonId);
      $('body').addClass('modal-active');
      if(path === "/newproyect/dashboard.php"){
        /* agregar datos a la orden */
        let nombre = $('#card-title').text();
        let telefono = $('#profile-phone').text();
        let email = $('#profile-email').text();
        $('#name').val(nombre);
        $('#email').val(email);
        $('#phone').val(telefono);
      }
    })

    $('.btn-clo').click(function(){
      $('#modal-container').addClass('out');
      $('body').removeClass('modal-active');
      cleanModal();
    });
  }

  /* AGREGAR PRODUCTOS AJAX */
  function addPO(){
    $(document).on("submit", "#form-product", function (event){
      event.preventDefault();
      var name = document.getElementById('name')
      var description = document.getElementById('description')
      var file = document.getElementById('file')
      var fiche = document.getElementById('fichero')
      var status = false

      
      console.log(file.value)

      if(name.value == ''){
        status = true
        name.classList.add('error');
      }else{
        name.classList.remove('error');
      }

      if(description.value == ''){
        status = true
        description.classList.add('error');
      }else{
        description.classList.remove('error');
      }

      if(file.value == ''){
        status = true
        fiche.classList.add('error');
      }else{
        fiche.classList.remove('error');        
      }

      if(status){
        Swal.fire({
          text: 'Faltan campos por llenar',
          icon: 'error',
          timer: 1500,    
          showConfirmButton: false
        })
      }else{
        $.ajax({
          url: "includes/php/actions.php",
          type: "POST",
          dataType: "json",
          data: new FormData(this),
          processData: false,
          contentType: false,
          success: function(response){
            if(response){
              Swal.fire({
                text: 'Producto Agregado Correctamente!',
                icon: 'success',
                timer: 1500,    
                showConfirmButton: false
              }).then(function (result){
                $('#modal-container').addClass('out');
                $('body').removeClass('modal-active');
                /* clear modal */
                cleanModal();
                /* mandamos llamar la funcion producyttos */
                $("#product-gallery").empty();
                getproducts();
              })  
              }
            },
            error: function(response){
              console.log("No jalo");
              console.log(response)
              },
        })
      }
        
    });
  }

  /* AGREGAR ORDENES */
  function addOrders(){
    $(document).on("submit" , "#form-product",function (event){
      event.preventDefault()
      let name = document.getElementById("name")
      let email = document.getElementById("email")
      let phone = document.getElementById("phone")
      let producto = document.getElementById("options")
      let description = document.getElementById("description")
      let img = document.getElementById('file')
      var filel = document.getElementById('fichero')
      let status = false;

      if(name.value === '' ){
        status = true;
        name.classList.add('error');
      }else{
        name.classList.remove('error');
      }
      if(email.value === '' ){
        status = true;
        email.classList.add('error');
      }else{
        email.classList.remove('error');
      }
      if(phone.value === '' ){
        status = true;
        phone.classList.add('error');
      }else{
        phone.classList.remove('error');
      }
      if(producto.value == 0 ){
        status = true;
        producto.classList.add('error');
      }else{
        producto.classList.remove('error');
      }
      if(description.value === '' ){
        status = true;
        description.classList.add('error');
      }else{
        description.classList.remove('error');
      }
      if(img.value === '' ){
        status = true;
        filel.classList.add('error');
      }else{
        filel.classList.remove('error');
      }
      
      if(status){
        Swal.fire({
          title: 'Faltan Campos Por Rellenar!',
          icon: 'error',
          timer: 1500,    
          showConfirmButton: false
        })
      }else{
        $.ajax({
          url: "includes/php/actions.php",
          type: "POST",
          dataType: "json",
          data: new FormData(this),
          processData: false,
          contentType: false,
          success: function(response){
            Swal.fire({
              text: 'Orden Creada Correctamente!',
              icon: 'success',
              timer: 1500,    
              showConfirmButton: false
            }).then(function (result){
              $('#modal-container').addClass('out');
              $('body').removeClass('modal-active');
              cleanModal();
            })  
          }
        })
      }

    })
  }

  function users(){
    $.ajax({
      url: "includes/php/actions.php",
      type: "GET",
      dataType: "json",
      data: {action: "show"},
      success: function(response){
        if(response.length>=1){
              $.each(response,function(index, value){
              $('#last-orders').append(
                $('<tr>').append(
                  $('<td>').text(value.id),
                  $('<td>').text(value.name),
                  $('<td>').text(value.email),
                  $('<td>').text(value.phone),
                  $('<td>').text(value.role),
                )
              )
              })
        }
      }
    })
  }
  
  function updateEstado(){
    let btns = document.querySelectorAll('.btn-estado');
    btns.forEach(upd=>{
      upd.addEventListener('click',function(){
        let modal = document.getElementById("modal_container");
        modal.classList.add('show')
        addEstado(upd.value)
      })
    });
  }

  function addEstado(id){
    let date = new Date();
    let output = String(date.getDate()).padStart(2, '0') + '/' + String(date.getMonth() + 1).padStart(2, '0') + '/' + date.getFullYear();
    let formup = document.getElementById('form_updest')
    let salir = document.getElementById('modal_container')
    $(document).on("submit", "#form_updest", function (event){
      event.preventDefault();
      let dateEntrega = document.getElementById('inpdate');
      let status = true;

      if(dateEntrega.value === '' ){
        status = false;
        dateEntrega.classList.add('error');
        Swal.fire({
          text: 'Faltan llenar el campo',
          icon: 'error',
          timer: 1500,    
          showConfirmButton: false
        })
      }else{
        dateEntrega.classList.remove('error');
      }

      if(status){
        $.ajax({
          url: "includes/php/actions.php",
          type: "GET",
          dataType: "json",
          data: { action: "updEstado", id: id, date: dateEntrega.value},
          success: function(response){
            if(response){
                  salir.classList.remove("show");
                  formup.reset();
                  $("#table_body").empty();
                  getorders();
                }
          },
          error: function(response){
          }    
      })
      }

    })
  }
  
})


