<?php 
require "assets/php/conexion.php";
session_start();

if(!isset($_SESSION['usuario'])){
   echo '<script language="javascript">
   window.location = "login.php"
   </script>';
   die();
   session_destroy(); 
 } 

 $cedula = $_SESSION['usuario'];
$query = "SELECT * FROM admins WHERE cedula = '$cedula'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Nombre = $row['nombre'];
   }




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ICar Play</title>
  <!-- plugins:css -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="admin.php"><img src="assets/images/logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="admin.php"><img src="assets/images/logo.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="assets/images/user.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="cerrar_sesion.php">
                <i class="ti-power-off text-primary"></i>
                Cerrar Sesion
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>

          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="admin.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clientes.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Lista de clientes</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mecanicos.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Lista de Mecanicos</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inventario.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Respuestos</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="lista_trabajos.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Trabajos realizados</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vehiculos.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Lista vehiculos</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Lista de Trabajos</h3>
                </div>
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <button type="button" name="trabajo" id="trabajo" class="btn btn-success">Añadir Trabajo</button><br><br>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                  </div>
                 </div>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <div id="table_trabajos" class="table table-striped table-borderless"></div>
             </div>
             </div>
                    </div>
                  </div>
                  </div>
                </div>
          </div>

          <div id="folderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-tittle"><span id="change-title">Añadir nuevo trabajo</span></h4>
            </div>
            <div class="modal-body">
                <p>Ingresa cedula del cliente</p>
                <input type="number" name="cedula_cliente" id="cedula_cliente" class="form-control"> 
                <input type="hidden" name="action" id="action">
                <input type="hidden" name="old_name" id="old_name"><br>
                <p>Ingresa cedula del mecanico</p>
                <input type="number" name="cedula_mecanico" id="cedula_mecanico" class="form-control"> 
                <p>Ingresa una descripcion del trabajo</p>
                <input type="textarea" name="desc_trabajo" id="desc_trabajo" class="form-control"> 
                <label for="estado_trabajo" style="font-size:20px">Estado</label><br>
                <select class="form-select form-select-lg mb-3" style="font-size:20px" name="estado_trabajo" id="estado_trabajo"> 
               <option style="font-size:20px" value="Espera">Espera</option>
               <option style="font-size:20px" value="En Proceso">En Proceso</option>
               <option style="font-size:20px" value="Reparado">Reparado</option>
            </select><br><br>
                <input type="button" name="trabajo_button" id="trabajo_button" class="btn btn-info" value="Create">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="assets/js/vendor.bundle.base.js"></script>
  <script src="assets/js/dashboard.js"></script>

  <script>

$(document).ready(function(){

   load_list();

         function load_list(page)
         {
            var action = "fetch_trabajos";
            $.ajax({
               url:"action.php",
               type:"POST",
               data:{action:action,page:page},
               success:function(data)
               {
                     $('#table_trabajos').html(data);
               }
            });
         }

         $(document).on('click','.pagination_link',function(){
            var page = $(this).attr("id");
            load_list(page);
         });


          $(document).on('click','#trabajo',function(){
            $('#action').val('crear_trabajo');
            $('#cedula_cliente').val('');
            $('#cedula_mecanico').val('');
            $('#desc_trabajo').val('');
            $('#estado_trabajo').val('');
            $('#trabajo_button').val('create');
            $('#old_name').val('');
            $('#change_title').text('Create Folder');
            $('#folderModal').modal('show');
        });   

        $(document).on('click','#trabajo_button',function(){
            var cedula_cliente= $('#cedula_cliente').val();
            var cedula_mecanico= $('#cedula_mecanico').val();
            var desc_trabajo= $('#desc_trabajo').val();
            var estado_trabajo= $('#estado_trabajo').val();
            var action = $('#action').val(); 


            if(cedula_cliente != '' || cedula_mecanico != '' || desc_trabajo != '' || estado_trabajo != ''){
                $.ajax(
                    {
                    url:"action.php",
                    type:"POST",
                    data:{cedula_cliente:cedula_cliente, action:action,cedula_mecanico:cedula_mecanico,desc_trabajo:desc_trabajo,estado_trabajo:estado_trabajo},
                    success:function(data)
                    {
                      $('#folderModal').modal('hide');
                        alert(data);
                        load_list();
                    }
                    }
                )

            }else{
                alert("Ingresa el nombre de la carpeta");
            }

        });
})



   
</script>

  <!-- End custom js for this page-->
</body>

</html>

