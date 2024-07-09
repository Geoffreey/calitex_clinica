<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $tecnicoName = $_POST['tecnicoName'];
    $labaddress = $_POST['address'];
    $contactno = $_POST['contactno'];
    $labemail = $_POST['labEmail'];
    $password = md5($_POST['npass']);
    $sql = mysqli_query($con, "INSERT INTO tecnico_lab(tecnicoName,address,contactno,labEmail,password) VALUES('$tecnicoName','$labaddress','$contactno','$labemail','$password')");
    if ($sql) {
        echo "<script>alert('Información del técnico agregada con éxito'); </script>";
        echo "<script>window.location.href = 'manage-doctors.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin | Agregar Técnico de laboratorio</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Creta+Redondo:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
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
    <script type="text/javascript">
        function valid() {
            if (document.addtec.npass.value != document.addtec.cfpass.value) {
                alert("El campo Contraseña y Confirmar contraseña no coinciden !!");
                document.addtec.cfpass.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkemailAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#labEmail").val(),
                type: "POST",
                success: function(data) {
                    $("#email-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</head>
<body>
    <div id="app">
        <?php include 'include/sidebar.php'; ?>
        <div class="app-content">
            <?php include 'include/header.php'; ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Agregar técnico de laboratorio</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Agregar técnico de laboratorio</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Agregar técnico</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="addtec" method="post" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label for="tecnicoName">Nombre</label>
                                                        <input type="text" name="tecnicoName" class="form-control" placeholder="Nombre completo" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Dirección</label>
                                                        <textarea name="address" class="form-control" placeholder="Dirección de incidencia" required="true"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contactno">Teléfono</label>
                                                        <input type="text" name="contactno" class="form-control" placeholder="No. teléfono" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="labEmail">Correo electrónico</label>
                                                        <input type="email" id="labEmail" name="labEmail" class="form-control" placeholder="Correo electrónico" required="true" onBlur="checkemailAvailability()">
                                                        <span id="email-availability-status"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Contraseña</label>
                                                        <input type="password" name="npass" class="form-control" placeholder="Nueva contraseña" required="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword2">Confirmar contraseña</label>
                                                        <input type="password" name="cfpass" class="form-control" placeholder="Confirmar contraseña" required="required">
                                                    </div>
                                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Crear</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-white"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'include/footer.php'; ?>
                <?php include 'include/setting.php'; ?>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
</body>
</html>



