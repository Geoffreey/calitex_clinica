<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    $tipo = $_POST['Tipo'];
    $nombre = $_POST['Nombre'];
    $codigo = $_POST['codigo'];
    $costo = $_POST['labFees'];
    
    $query = mysqli_query($con, "INSERT INTO laboratories (tipo, nombre, codigo, costo) 
                                 VALUES ('$tipo', '$nombre', '$codigo', '$costo')");
    
    if ($query) {
        $_SESSION['msg'] = "Laboratorio agregado exitosamente !!";
    } else {
        $_SESSION['msg'] = "Error al agregar laboratorio";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin | Exámenes de laboratorio</title>
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
                                <h1 class="mainTitle">Admin | Exámenes de laboratorio</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Exámenes de laboratorio</span>
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
                                                <h5 class="panel-title">Agregar Examen de Laboratorio</h5>
                                            </div>
                                            <div class="panel-body">
                                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                                <form role="form" name="dcotorspcl" method="post">
                                                    <div class="form-group">
                                                        <label for="Tipo">Tipo de laboratorio</label>
                                                        <input type="text" name="Tipo" class="form-control" placeholder="Tipo de laboratorio" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Nombre">Nombre del examen</label>
                                                        <input type="text" name="Nombre" class="form-control" placeholder="Nombre del examen" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="codigo">Código</label>
                                                        <input type="text" name="codigo" class="form-control" placeholder="Código de laboratorio" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="labFees">Costo del examen</label>
                                                        <input type="text" name="labFees" class="form-control" placeholder="Costo" required="true">
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Crear</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Administrar Exámenes de Laboratorio</h5>
                                            </div>
                                            <div class="panel-body">
                                                <table class="table table-hover" id="sample-table-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">#</th>
                                                            <th>Tipo</th>
                                                            <th>Nombre</th>
                                                            <th>Código</th>
                                                            <th>Costo</th>
                                                            <th>Fecha de creación</th>
                                                            <th>Última actualización</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = mysqli_query($con, "SELECT * FROM laboratories");
                                                        $cnt = 1;
                                                        while ($row = mysqli_fetch_array($sql)) {
                                                        ?>
                                                            <tr>
                                                                <td class="center"><?php echo $cnt; ?>.</td>
                                                                <td><?php echo $row['tipo']; ?></td>
                                                                <td><?php echo $row['nombre']; ?></td>
                                                                <td><?php echo $row['codigo']; ?></td>
                                                                <td><?php echo $row['costo']; ?></td>
                                                                <td><?php echo $row['created_at']; ?></td>
                                                                <td><?php echo $row['updated_at']; ?></td>
                                                                <td>
                                                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                                        <a href="edit-laboratory.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Editar"><i class="fa fa-pencil"></i></a>
                                                                        <a href="manage-laboratories.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('¿Estás seguro de que deseas eliminar este laboratorio?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Eliminar"><i class="fa fa-times fa fa-white"></i></a>
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

