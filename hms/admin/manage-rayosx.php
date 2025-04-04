<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();

if (isset($_GET['del'])) {
    mysqli_query($con, "delete from tecnico_rx where id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "data deleted !!";
}

$limit = 8; // Número de tecnicos de rayos X por página
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM tecnico_rx LIMIT $start, $limit";
$result = mysqli_query($con, $sql);

// Contar el total de registros para la paginación
$total_results = mysqli_query($con, "SELECT COUNT(id) AS count FROM tecnico_rx");
$total_rows = mysqli_fetch_assoc($total_results)['count'];
$total_pages = ceil($total_rows / $limit);

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Admin | Administrar rayos X</title>

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
             <?php include 'include/sidebar.php';?>
			<div class="app-content">

						<?php include 'include/header.php';?>

				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Administrar rayos X</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Administrar rayos X</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">


									<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Lista<span class="text-bold"> tecnicos</span></h5>
									<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
									<div class="table-responsive">
										<table class="table table-hover table-bordered" id="sample-table-1">
											<thead>
												<tr>
													<th class="center">No.</th>
													<th class="hidden-xs">Nombre tecnico</th>
													<th class="hidden-xs">Telefono</th>
													<th class="hidden-xs">Correo electronico</th>
													<th class="hidden-xs">Direccion</th>
													<th>Fecha de creacion</th>
													<th>Accion</th>
												</tr>
											</thead>
											<tbody>
                                            	<?php
                                              		$sql = mysqli_query($con, "select * from tecnico_rx");
													  $cnt = $start + 1;
													  while ($row = mysqli_fetch_array($result)) {
                                             	?>
												<tr>
													<td class="center"><?php echo $cnt; ?>.</td>
													<td data-label=""><?php echo $row['tecnicoName']; ?></td>
													<td data-label=""><?php echo $row['contactno']; ?></td>
													<td data-label=""><?php echo $row['labEmail']; ?></td>
													<td data-label=""><?php echo $row['address']; ?></td>
													<td data-label=""><?php echo $row['creationDate']; ?></td>
													<td >
														<div class="btn-group1">
															<a href="edit-tecnirx.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary2" title="Editar"><i class="fa fa-pencil"></i></a>
															<a href="manage-rayosx.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('¿Estás seguro de que quieres eliminar?')"class="btn btn-sm btn-outline-danger2" title="Eliminar"><i class="fa fa-times fa fa-white"></i></a>
														</div>
													</td>
												</tr>
												<?php
                                               		$cnt = $cnt + 1;
                                            	}?>
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
						<!-- end: BASIC EXAMPLE -->
						<!-- end: SELECT BOXES -->
			</div>
					<?php include 'include/footer.php';?>
					<?php include 'include/setting.php';?>
				</div>
			</div>
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
