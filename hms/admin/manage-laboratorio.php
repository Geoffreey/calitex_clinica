<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();

if (isset($_GET['del'])) {
    mysqli_query($con, "delete from tecnico_lab where id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "data deleted !!";
}
$limit = 8; // Número de tecnicos de laboratorio por página
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM tecnico_lab LIMIT $start, $limit";
$result = mysqli_query($con, $sql);

// Contar el total de registros para la paginación
$total_results = mysqli_query($con, "SELECT COUNT(id) AS count FROM tecnico_lab");
$total_rows = mysqli_fetch_assoc($total_results)['count'];
$total_pages = ceil($total_rows / $limit);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin | Administrar laboratorio</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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
                                <h1 class="mainTitle">Admin | Administrar laboratorio</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Administrar laboratorio</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15">Lista<span class="text-bold"> técnicos</span></h5>
                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="sample-table-1">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="center">No.</th>
                                                <th class="hidden-xs">Nombre técnico</th>
                                                <th>Teléfono</th>
                                                <th>Correo Electrónico</th>
                                                <th>Dirección</th>
                                                <th>Fecha de creación</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = mysqli_query($con, "SELECT * FROM tecnico_lab");
                                                $cnt = $start + 1;
                                                     while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <tr>
                                                <td class="center" data-label="No."><?php echo $cnt; ?>.</td>
                                                <td data-label="Nombre técnico"><?php echo $row['tecnicoName']; ?></td>
                                                <td data-label="Teléfono"><?php echo $row['contactno']; ?></td>
                                                <td data-label="Correo Electrónico"><?php echo $row['labEmail']; ?></td>
                                                <td data-label="Dirección"><?php echo $row['address']; ?></td>
                                                <td data-label="Fecha de creación"><?php echo $row['creationDate']; ?></td>
                                                <td data-label="Acción">
                                                    <div class="btn-group1">
                                                        <a href="edit-tecnicolab.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary2" title="Editar"><i class="fa fa-pencil"></i></a>
                                                        <a href="manage-laboratorio.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('¿Estás seguro de que quieres eliminar?')" class="btn btn-sm btn-outline-danger2" title="Eliminar"><i class="fa fa-times"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                $cnt++;
                                            } ?>
                                        </tbody>
                                    </table>
                                    <div class="pagination1">
    										<?php if ($total_pages > 1): ?>
        									<?php if ($page > 1): ?>
            								<a href="?page=<?php echo $page - 1; ?>" class="btn1 btn-sm1 btn-outline-primary1">&laquo;</a>
        									<?php endif; ?>

       		 								<?php for ($i = 1; $i <= $total_pages; $i++): ?>
            								<a href="?page=<?php echo $i; ?>" class="btn1 btn-sm1 <?php echo ($i == $page) ? 'btn-primary1' : 'btn-outline-primary1'; ?>">
                							<?php echo $i; ?>
            								</a>
        									<?php endfor; ?>

        									<?php if ($page < $total_pages): ?>
            								<a href="?page=<?php echo $page + 1; ?>" class="btn1 btn-sm1 btn-outline-primary1">&raquo;</a>
       										<?php endif; ?>
    										<?php endif; ?>
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


