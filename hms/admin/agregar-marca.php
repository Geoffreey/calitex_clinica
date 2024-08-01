<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];

    $query = "INSERT INTO marcas (nombre) VALUES ('$nombre')";
    if (mysqli_query($con, $query)) {
        $_SESSION['msg'] = "Marca agregada exitosamente.";
    } else {
        $_SESSION['msg'] = "Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin | Farmacia</title>
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
                                <h1 class="mainTitle">Admin | Farmacia</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Marcas</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-12 col-md-12">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBrandModal">
                                            Agregar Marca
                                        </button>
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Lista de marcas</h5>
                                            </div>
                                            <div class="panel-body">
                                                <p style="color:red;">
                                                    <?php echo htmlentities($_SESSION['msg']); ?>
                                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                                </p>
                                                <table class="table table-hover" id="sample-table-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">No.</th>
                                                            <th>Nombre</th>
                                                            <th>Fecha de creación</th>
                                                            <th>Última actualización</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = mysqli_query($con, "SELECT * FROM marcas");
                                                        $cnt = 1;
                                                        while ($row = mysqli_fetch_array($sql)) {
                                                        ?>
                                                            <tr>
                                                                <td class="center"><?php echo $cnt; ?>.</td>
                                                                <td><?php echo $row['nombre']; ?></td>
                                                                <td><?php echo $row['created_at']; ?></td>
                                                                <td><?php echo $row['updated_at']; ?></td>
                                                                <td>
                                                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                                        <a href="edit-marca.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Editar"><i class="fa fa-pencil"></i></a>
                                                                        <a href="manage-marcas.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('¿Estás seguro de que deseas eliminar esta marca?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Eliminar"><i class="fa fa-times fa fa-white"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            $cnt = $cnt + 1;
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'include/footer.php'; ?>
        <?php include 'include/setting.php'; ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalLabel">Agregar Marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" name="marcaForm" action="agregar-marca.php">
                        <div class='form-group'>
                            <input type="text" class='form-control' name="nombre" placeholder="Nombre de la Marca" required>
                        </div>
                        <button type="submit" class='btn btn-primary'>Agregar Marca</button>
                    </form>
                </div>
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


