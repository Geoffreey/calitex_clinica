<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Laboratorio | Consola</title>

  <!-- Fuentes y estilos -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
  <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
  <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
  <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
  <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
  <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
  <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/plugins.css">
  <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>
<body>
  <div id="app">
    <?php include('include/sidebar.php'); ?>
    <div class="app-content">
      <?php include('include/header.php'); ?>

      <div class="main-content">
        <div class="wrap-content container" id="container">

          <!-- start: PAGE TITLE -->
          <section id="page-title">
            <div class="row">
              <div class="col-sm-8">
                <h1 class="mainTitle">Laboratorio | Consola</h1>
              </div>
              <ol class="breadcrumb">
                <li><span>Usuario</span></li>
                <li class="active"><span>Consola</span></li>
              </ol>
            </div>
          </section>
          <!-- end: PAGE TITLE -->

          <!-- start: CARDS -->
          <div class="container-fluid container-fullw bg-white">
            <div class="row g-4">

              <!-- Mi perfil -->
              <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100 text-center p-4">
                  <div class="mb-3">
                    <i class="fas fa-user-circle fa-4x text-hospital mb-3"></i>
                  </div>
                  <h5 class="fw-bold mb-2">Mi perfil</h5>
                  <p class="mb-0">
                    <a href="edit-profile.php" class="text-decoration-none fw-semibold text-primary">
                      Actualizar perfil
                    </a>
                  </p>
                </div>
              </div>

              <!-- Mis citas -->
              <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100 text-center p-4">
                  <div class="mb-3">
                    <i class="fas fa-calendar-check fa-4x text-hospital mb-3"></i>
                  </div>
                  <h5 class="fw-bold mb-2">Mis citas</h5>
                  <p class="mb-0">
                    <a href="appointment-history.php" class="text-decoration-none fw-semibold text-primary">
                      Ver historial de citas
                    </a>
                  </p>
                </div>
              </div>

              <!-- Resultados (opcional) -->
              <!--
              <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100 text-center p-4">
                  <div class="mb-3">
                    <i class="fas fa-vials fa-4x text-hospital mb-3"></i>
                  </div>
                  <h5 class="fw-bold mb-2">Resultados</h5>
                  <p class="mb-0">
                    <a href="resultados.php" class="text-decoration-none fw-semibold text-primary">
                      Ver resultados
                    </a>
                  </p>
                </div>
              </div>
              -->

            </div>
          </div>
          <!-- end: CARDS -->

        </div>
      </div>
    </div>

    <!-- start: FOOTER -->
    <?php include('include/footer.php'); ?>
    <!-- end: FOOTER -->

    <!-- start: SETTINGS -->
    <?php include('include/setting.php'); ?>
    <!-- end: SETTINGS -->

  </div>

  <!-- start: SCRIPTS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/modernizr/modernizr.js"></script>
  <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
  <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="vendor/switchery/switchery.min.js"></script>

  <!-- page-specific -->
  <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
  <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
  <script src="vendor/autosize/autosize.min.js"></script>
  <script src="vendor/selectFx/classie.js"></script>
  <script src="vendor/selectFx/selectFx.js"></script>
  <script src="vendor/select2/select2.min.js"></script>
  <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>

  <!-- main scripts -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/form-elements.js"></script>
  <script>
    jQuery(document).ready(function () {
      Main.init();
      FormElements.init();
    });
  </script>
</body>
</html>