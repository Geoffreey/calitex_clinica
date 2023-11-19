<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $bp=$_POST['bp'];
    $bs=$_POST['bs'];
    $weight=$_POST['weight'];
    $temp=$_POST['temp'];
    $exf=$_POST['exf'];
   $pres=$_POST['pres'];
   $ord=$_POST['ord'];
   $evo=$_POST['evo'];
   $lab=$_POST['lab'];
   $rayx=$_POST['rayx'];
   
 
      $query.=mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,ExamenFisico,MedicalPres,OrdenesMedicas,Evolucion,Laboratorio,RayosX)value('$vid','$bp','$bs','$weight','$temp','$exf','$pres', '$ord','$evo','$lab','$rayx')");
    if ($query) {
    echo '<script>alert("Medicle history has been added.")</script>';
    echo "<script>window.location.href ='manage-patient.php'</script>";
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Medico | Administrar pacientes</title>
		
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
               <?php include('include/sidebar.php');?>
        <div class="app-content">
               <?php include('include/header.php');?>
           <div class="main-content" >
             <div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
               <section id="page-title">
                 <div class="row">
                    <div class="col-sm-8">
                        <h1 class="mainTitle">Medico | Administrar pacientes</h1>
                    </div>
                    <ol class="breadcrumb">
                       <li>
                        <span>Medico</span>
                       </li>
                       <li class="active">
                        <span>Administrar pacientes</span>
                       </li>
                     </ol>
                  </div>
                </section>
                  <div class="container-fluid container-fullw bg-white" id="printIt">
                      <div class="row">
                         <div class="col-md-12">
                           <h5 class="over-title margin-bottom-15">Administrar<span class="text-bold"> pacientes</span></h5>
                           <?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from tblpatient where ID='$vid'");
                               $cnt=1;
                               while ($row=mysqli_fetch_array($ret)) {
                               ?>
                           <table border="1" class="table table-bordered" >
                               <tr align="center">
                                  <td colspan="5" style="font-size:20px;color:blue">Detalles del paciente</td>
                               </tr>

                               <tr>
                                  <th scope>No. Admision</th>
                                     <td><?php  echo $row['PatientAdmision'];?></td>
                                     <th scope>Nombre pasiente</th>
                                     <td><?php  echo $row['PatientName'];?></td>
                               </tr>

                               <tr>
                                  <th scope>Fecha de nacimiento</th>
                                  <td><?php  echo $row['FechaNac'];?></td>
                                  <th scope>Email</th>
                                  <td><?php  echo $row['PatientEmail'];?></td>
                               </tr>
                               <tr>
                                  <th scope>Telefono</th>
                                  <td><?php  echo $row['PatientContno'];?></td>
                                  <th>Direccion</th>
                                  <td><?php  echo $row['PatientAdd'];?></td>
                               </tr>
                               <tr>
                                  <th>Genero</th>
                                  <td><?php  echo $row['PatientGender'];?></td>
                                  <th>Eda</th>
                                  <td><?php  echo $row['PatientAge'];?></td>
                               </tr>
                               <tr>
                                  <th>Historial médico del paciente(Si aplica)</th>
                                  <td><?php  echo $row['PatientMedhis'];?></td>
                                  <th>Fecha de registro del paciente</th>
                                  <td><?php  echo $row['CreationDate'];?></td>
                               </tr>
 
                               <?php }?>
                           </table>
                               <?php  
                                $ret=mysqli_query($con,"select * from tblmedicalhistory  where PatientID='$vid'");
                               ?>
                  
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                           <tr align="center">
                             <th colspan="13" >Historial medico</th> 
                          </tr>
                          <tr>
                             <th>#</th>
                             <th>Presión arterial</th>
                             <th>Peso</th>
                             <th>Glucosa</th>
                             <th>Temperatura corporal</th>
                             <th>Examen ficico</th>
                             <th>Preescripsion medica</th>
                             <th>Ordenes medicas</th>
                             <th>Evolucion</th>
                             <th>Laboratorio</th>
                             <th>Rayos X</th>
                             <th>Fecha visita</th>
                         </tr>
                           <?php  
                             while ($row=mysqli_fetch_array($ret)) { 
                            ?>
                          <tr>
                             <td><?php echo $cnt;?></td>
                             <td><?php  echo $row['BloodPressure'];?></td>
                             <td><?php  echo $row['Weight'];?></td>
                             <td><?php  echo $row['BloodSugar'];?></td> 
                             <td><?php  echo $row['Temperature'];?></td>
                             <td><?php  echo $row['ExamenFisico'];?></td>
                             <td><?php  echo $row['MedicalPres'];?></td>
                             <td><?php  echo $row['OrdenesMedicas'];?></td>
                             <td><?php  echo $row['Evolucion'];?></td>
                             <td><?php  echo $row['Laboratorio'];?></td>
                             <td><?php  echo $row['RayosX'];?></td>
                             <td><?php  echo $row['CreationDate'];?></td>
                         </tr>
                           <?php $cnt=$cnt+1;} ?>
                      </table>
                  
                      <!--Aca van los botones de agregar historial medico e imprimir-->
                      <?php  ?>
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Agregar historial medico</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                  </div>    
                           <div class="modal-body">
                               <table class="table table-bordered table-hover data-tables">

                               <form method="post" name="submit">

                                   <tr>
                                      <th>Presion arterial:</th>
                                      <td>
                                        <input name="bp" placeholder="Blood Pressure" class="form-control wd-450" required="true">
                                     </td>
                                  </tr>                          
                                  <tr>
                                      <th>Glucosa:</th>
                                      <td>
                                        <input name="bs" placeholder="Blood Sugar" class="form-control wd-450" required="true">
                                     </td>
                                  </tr> 
                                  <tr>
                                     <th>Peso:</th>
                                        <td>
                                           <input name="weight" placeholder="Weight" class="form-control wd-450" required="true">
                                        </td>
                                 </tr>
                                 <tr>
                                     <th>Temperatura corporal:</th>
                                     <td>
                                        <input name="temp" placeholder="Blood Sugar" class="form-control wd-450" required="true">
                                     </td>
                                  </tr>

                                  <tr>
                                      <th>Examen fisico:</th>
                                      <td>
                                      <textarea name="exf" placeholder="examnen fisico" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                                      </td>
                                  </tr>
                         
                                  <tr>
                                     <th>Preescripsion:</th>
                                     <td>
                                        <textarea name="pres" placeholder="Medical Prescription" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                                     </td>
                                  </tr>
                                  <tr>
                                     <th>Ordenes medicas:</th>
                                     <td>
                                        <textarea name="ord" placeholder="Ordenes medicas" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                                     </td>
                                  </tr>
                                  <tr>
                                     <th>Evolucion:</th>
                                     <td>
                                        <textarea name="evo" placeholder="Evolucion" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                                     </td>
                                  </tr>
                                  <tr>
                                      <th>Laboratorio:</th>
                                      <td>
                                        <textarea name="lab" placeholder="laboratorio" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                                      </td>
                                 </tr> 
                                 <tr>
                                      <th>Rayos x:</th>
                                      <td>
                                         <textarea name="rayx" placeholder="rayos x" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                                     </td>
                                  </tr>
   
                              </table>
                       </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="submit" name="submit" class="btn btn-primary">Guardar</button>
  
                              </form>
                      </div>
                  </div>
               </div>
           </div>
       </div>
    </div>
  </div>
                   <p align="center">                            
                     <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Agregar historial medico</button>
                     <button class="btn btn-primary waves-effect waves-light w-lg" onClick="printOut('printIt')">Imprimir</button>
                   </p>
</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
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
