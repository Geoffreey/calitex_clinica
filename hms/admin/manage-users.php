<?php
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/checklogin.php';
check_login();

if (isset($_GET['del'])) {
    mysqli_query($con, "delete from users where id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "data deleted !!";
}

$limit = 8; // Número de usuarios por página
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM users LIMIT $start, $limit";
$result = mysqli_query($con, $sql);

// Contar el total de registros para la paginación
$total_results = mysqli_query($con, "SELECT COUNT(id) AS count FROM users");
$total_rows = mysqli_fetch_assoc($total_results)['count'];
$total_pages = ceil($total_rows / $limit);

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Admin | Administrar usuarios</title>

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
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<section id="page-title">
							<div class="row">
								<div class="col-sm-10">
									<h1 class="mainTitle">Admin | Administrar usuarios</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Administrar usuarios</span>
									</li>
								</ol>
							</div>
						</section>
						<div class="container-fluid container-fullw bg-white"><div class="row">
						  <div class="col-md-12">
							 <h5 class="over-title margin-bottom-15">Lista<span class="text-bold"> Usuarios</span></h5>
							 <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
							 <div class="table-responsive">
							 	<table class="table table-hover table-bordered" id="sample-table-1">
								 	<thead>
									 	<tr>
										 	<th class="center">No.</th>
										 	<th>No. Admision</th>
										 	<th>Nombre completo</th>
										 	<th>Fecha de nacimiento</th>
										 	<th class="hidden-xs">Direccion</th>
										 	<th>Ciudad</th>
										 	<th>Genero</th>
										 	<th>Email</th>
										 	<th>Fecha de creacion</th>
										 	<th>Fecha de actualizacion</th>
										 	<th>Accion</th>
									  	</tr>
									</thead>
								 	<tbody>
                                     	<?php
                                         	$sql = mysqli_query($con, "select * from users");
											 $cnt = $start + 1;
											 while ($row = mysqli_fetch_array($result)) {
                                        ?>
									    <tr>
										    <td class="center"><?php echo $cnt; ?>.</td>
											<td data-label="PatientAdmision"><?php echo $row['PatientAdmision'];?></td>
											<td data-label="fullName"class="hidden-xs"><?php echo $row['fullName']; ?></td>
											<td data-label="FechaNac"><?php echo $row['FechaNac'];?></td>
											<td data-label="address"><?php echo $row['address']; ?></td>
											<td data-label="city"><?php echo $row['city']; ?></td>
											<td data-label="gender"><?php echo $row['gender']; ?></td>
											<td data-label="email"><?php echo $row['email']; ?></td>
											<td data-label="regDate"><?php echo $row['regDate']; ?></td>
											<td data-label="updationDate"><?php echo $row['updationDate']; ?></td>
											<td data-label="Accion">
												<div class="btn-group1">
													<a href="manage-users.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('¿Estás seguro de que quieres eliminar?')" class="btn btn-sm btn-outline-danger2" title="Eliminar"><i class="fa fa-times fa fa-white"></i></a>
												</div>
												 <!--<div class="visible-xs visible-sm hidden-md hidden-lg">
													 <div class="btn-group" dropdown is-open="status.isopen">
														 <button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
															 <i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
														 </button>
														 <ul class="dropdown-menu pull-right dropdown-light" role="menu">
															 <li><a href="#">Editar</a></li>
															 <li><a href="#">Compartir</a></li>
															 <li><a href="#">ELiminar</a></li>
														  </ul>
													  </div>
										          </div>-->
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
	 </div>
	     <?php include 'include/footer.php';?>
		 <?php include 'include/setting.php';?>
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
