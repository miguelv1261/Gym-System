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
<title>94 Fitness Center</title>
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
  <h1><a href="">94 Fitness Center</a></h1>
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
<?php $page='payment'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<?php
include 'dbcon.php';
$id = $_GET['id'];

// Primera consulta: Recuperar datos del miembro
$qry = "SELECT * FROM members WHERE user_id='$id'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 

    </div>
    <h1>Registrar Pago</h1>
  </div>
  <div class="container-fluid" style="margin-top:-38px;">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> 
            <span class="icon"> <i class="fas fa-money"></i> </span>
            <h5>Pago</h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span5">
                <table class="">
                  <tbody>
                    <tr>
                      <td><img src="../img/94logo.png" alt="Gym Logo" width="175"></td>
                    </tr>
                    <tr>
                      <td><h4>94 Fitness Center</h4></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="span7">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <!-- Inicia el formulario -->
                    <form action="userpay.php" method="POST">
                      <tr>
                        <td class="width30">Usuario:</td>
                        <input type="hidden" name="fullname" value="<?php echo $row['fullname']; ?>">
                        <td class="width70"><strong><?php echo $row['fullname']; ?></strong></td>
                      </tr>
                        <input type="hidden" name="paid_date" value="<?php echo $row['paid_date']; ?>">
                        <tr>
                          <td class="width30">Plan:</td>
                          <td class="width70">
                              <div class="control-group">
                                  <div class="controls">
                                      <?php
                                      $defaultCharge = 0;
                                      // Segunda consulta: Recuperar los planes
                                      $qry2 = "SELECT * FROM rates";
                                      $result2 = mysqli_query($conn, $qry2);
                                      if (mysqli_num_rows($result2) > 0) {
                                          echo '<select name="plan" id="plan" onchange="updatePrice(this)">';
                                          while ($rate = mysqli_fetch_assoc($result2)) {
                                              echo '<option value="' . $rate['id'] . '-' . $rate['charge'] . '-' . $rate['name'] . '">' . $rate['name'] . '</option>';
                                          }
                                          echo '</select>';
                                      } else {
                                          echo 'No se encontraron tarifas.';
                                      }
                                      ?>
                                  </div>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td class="width30">Precio:</td>
                          <td class="width70"><strong id="planPrice"><?php echo $defaultCharge; ?></strong></td>
                      </tr>
                      <tr>
                        <td class="width30">Member's Status:</td>
                        <td class="width70">
                          <div class="controls">
                            <select name="status" required="required" id="select">
                              <option value="Active" selected="selected">Activo</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <!-- Campo oculto para el ID del miembro -->
                      <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">
                      <!-- Botón para enviar el formulario -->
                      <tr>
                        <td colspan="2" class="text-center">
                          <button class="btn btn-success btn-large" type="submit">Hacer el Pago</button>
                        </td>
                      </tr>
                    </form>
                    <!-- Fin del formulario -->
                  </tbody>
                </table>
              </div>
            </div> <!-- row-fluid ends here -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
mysqli_close($conn);
?>




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
function updatePrice(selectElement) {
        // Obtener el valor del plan seleccionado
        const selectedValue = selectElement.value;
        // Extraer el precio (el segundo valor en la cadena separada por '-')
        const price = selectedValue.split('-')[1];
        // Actualizar el campo del precio
        document.getElementById('planPrice').textContent =  price + '$';
    }
</script>
</body>
</html>