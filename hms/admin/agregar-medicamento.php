<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $proveedor_id = $_POST['proveedor_id'];
    $marca_id = $_POST['marca_id'];
    $categoria_id = $_POST['categoria_id'];

    $query = "INSERT INTO medicamentos (nombre, descripcion, precio, proveedor_id, marca_id, categoria_id) VALUES ('$nombre', '$descripcion', '$precio', '$proveedor_id', '$marca_id', '$categoria_id')";
    if (mysqli_query($con, $query)) {
        echo "Medicamento agregado exitosamente.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin | Famacia</title>
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
                                    <span>Productos de farmacia</span>
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
                                                <h5 class="panel-title">Agregar producto</h5>
                                            </div>
                                            <div class="panel-body">
                                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                                
                                                <form role="form" method="post" name="dcotorspcl" action="agregar_medicamento.php">
                                                    <div class='form-group'>
                                                      <input type="text" class="form-control" name="nombre" placeholder="Nombre del Medicamento" required>
                                                    </div>
                                                    <div class='form-group'>
                                                      <input type="number" class="form-control" step="0.01" name="precio" placeholder="Precio" required>
                                                    </div>
                                                    <div class='form-group'>
                                                      <select name="proveedor_id" class="form-control" required>
                                                        <!-- Opciones de proveedores desde la base de datos -->
                                                      </select>
                                                    </div>
                                                    <div class='form-group'>
                                                      <select name="marca_id" class="form-control" required>
                                                            <!-- Opciones de marcas desde la base de datos -->
                                                      </select>
                                                    </div>
                                                    <div class='form-group'>
                                                      <select name="categoria_id" class="form-control" required>
                                                            <!-- Opciones de categorías desde la base de datos -->
                                                      </select>
                                                    </div>
                                                    <div class='form-goup'>
                                                    <textarea name="descripcion" placeholder="Descripción"></textarea>
                                                    </div>
                                                      <button class='form-group' type="submit">Agregar Medicamento</button>
                                                    </form>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Lista de productos</h5>
                                            </div>
                                            <div class="panel-body">
                                                <table class="table table-hover" id="sample-table-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">No.</th>
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
                                                                        <a href="edit-laboratorios.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Editar"><i class="fa fa-pencil"></i></a>
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