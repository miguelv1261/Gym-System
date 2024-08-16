<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<title>Gym System Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/fullcalendar.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part--> 
<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->

<!--sidebar-menu-->
<?php $page='members-entry'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
<div id="content-header">  
  <h1>Registrar Usuario</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Información Personal</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="add-member-req.php" method="POST" class="form-horizontal">
          <div class="control-group">
              <label class="control-label">Cedula :</label>
              <div class="controls">
                <input type="text" class="span11" id="cedula" name="username"  />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nombre :</label>
              <div class="controls">
                <input type="text" class="span11" id="nombre" name="fullname" placeholder="Nombre Completo" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Genero :</label>
              <div class="controls">
              <select name="gender" required="required" id="select">
                  <option value="Masculino" selected="selected">Masculino</option>
                  <option value="Femenino">Femenino</option>
                  <option value="Otro">Otro</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Fecha de Registro :</label>
              <div class="controls">
                <input type="date" name="dor" class="span11" />
              </div>
            </div>
            
          
        </div>
     
        
      </div>
	  
	
    </div>

    
    
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Detalles de Contacto</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
            <div class="control-group">
              <label for="normal" class="control-label">Celular</label>
              <div class="controls">
                <input type="number" id="mask-phone" name="contact" placeholder="9876543210" class="span8 mask text">
                </div>
            </div>
            <div class="control-group">
              <label class="control-label">Dirección :</label>
              <div class="controls">
                <input type="text" class="span11" name="address" placeholder="Salcedo" />
              </div>
            </div>
          </div>

              <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Detalle Servicio</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
          <div class="control-group">
          
          <label class="control-label">Plan :</label>
          <div class="controls" >
            <?php
              include 'dbcon.php';

              $qry = "SELECT * FROM rates";
              $result = mysqli_query($conn, $qry);

              if (mysqli_num_rows($result) > 0) {
                  echo '<select name="plan" id="plan">';
                  while ($row = mysqli_fetch_assoc($result)) {
                      // Mostrar solo el nombre en el select
                      echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                  }
                  echo '</select>';
              } else {
                  echo 'No se encontraron tarifas.';
              }

              mysqli_close($conn);
              ?>
              </div>
            </div>
            <div class="form-actions text-center">
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            
            </form>

          </div>



        </div>

        </div>
      </div>

	</div>
  </div>
  
  
</div></div>


<!--end-main-container-part-->



<script src="../js/excanvas.min.js"></script> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.flot.min.js"></script> 
<script src="../js/jquery.flot.resize.min.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/fullcalendar.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.dashboard.js"></script> 
<script src="../js/jquery.gritter.min.js"></script> 
<script src="../js/matrix.interface.js"></script> 
<script src="../js/matrix.chat.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/matrix.form_validation.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.popover.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
$(document).ready(function() {
        $('#cedula').on('blur', function() {
            var cedula = $('#cedula').val();
            var url = "https://srienlinea.sri.gob.ec/movil-servicios/api/v1.0/deudas/porIdentificacion/" + cedula + "/?tipoPersona=N";

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    if(data && data.contribuyente && data.contribuyente.nombreComercial) {
                        $("#nombre").val(data.contribuyente.nombreComercial);
                    } else {
                        alert('No se encontró el nombre comercial para la cédula proporcionada.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error al realizar la consulta:", status, error);
                    alert('Ocurrió un error al consultar el nombre. Verifica la cédula y vuelve a intentar.');
                }
            });
        });
    });


                


</script>
</body>
</html>
