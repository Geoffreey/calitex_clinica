<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

// Recuperar proveedores
$proveedores = $con->query("SELECT id, nombre FROM proveedores");

// Recuperar marcas
$marcas = $con->query("SELECT id, nombre FROM marcas");

// Recuperar categorías
$categorias = $con->query("SELECT id, nombre FROM categorias");

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
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">Agregar Producto</button>
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
                                                            <th>Nombre</th>
                                                            <th>Precio</th>
                                                            <th>Categoria</th>
                                                            <th>Marca</th>
                                                            <th>Proveedor</th>
                                                            <th>Descripción</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = "SELECT m.id, m.nombre, m.precio, c.nombre as categoria, b.nombre as marca, p.nombre as proveedor, m.descripcion 
                                                                FROM medicamentos m 
                                                                JOIN categorias c ON m.categoria_id = c.id 
                                                                JOIN marcas b ON m.marca_id = b.id 
                                                                JOIN proveedores p ON m.proveedor_id = p.id";
                                                        $result = mysqli_query($con, $sql);
                                                        $cnt = 1;
                                                        while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                            <tr>
                                                                <td class="center"><?php echo $cnt; ?>.</td>
                                                                <td><?php echo $row['nombre']; ?></td>
                                                                <td><?php echo $row['precio']; ?></td>
                                                                <td><?php echo $row['categoria']; ?></td>
                                                                <td><?php echo $row['marca']; ?></td>
                                                                <td><?php echo $row['proveedor']; ?></td>
                                                                <td><?php echo $row['descripcion']; ?></td>
                                                                <td>
                                                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                                        <a href="edit-medicamento.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Editar"><i class="fa fa-pencil"></i></a>
                                                                        <a href="manage-medicamentos.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('¿Estás seguro de que deseas eliminar este medicamento?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Eliminar"><i class="fa fa-times fa fa-white"></i></a>
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
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addProductModalLabel">Agregar Producto</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" name="dcotorspcl" action="agregar-medicamento.php">
                        <div class='form-group'>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre del Medicamento" required>
                        </div>
                        <div class='form-group'>
                            <input type="number" class="form-control" step="0.01" name="precio" placeholder="Precio" required>
                        </div>
                        <div class='form-group'>
                            <select name="proveedor_id" class="form-control" required>
                                <option value="">Seleccione un Proveedor</option>
                                <?php while ($row = $proveedores->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class='form-group'>
                            <select name="marca_id" class="form-control" required>
                                <option value="">Seleccione una Marca</option>
                                <?php while ($row = $marcas->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class='form-group'>
                            <select name="categoria_id" class="form-control" required>
                                <option value="">Seleccione una Categoría</option>
                                <?php while ($row = $categorias->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class='form-group'>
                            <textarea class="form-control" name="descripcion" placeholder="Descripción"></textarea>
                        </div>
                        <button class='form-group' type="submit">Agregar Medicamento</button>
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


