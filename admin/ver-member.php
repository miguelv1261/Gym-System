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
<?php $page='members-update'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<?php
include 'dbcon.php';
if (isset($_GET['cedula'])) {
  $ced = $_GET['cedula'];
  $qry= "select * from members where username='$ced'";
  
  // Continúa con el procesamiento
} else {
  $id=$_GET['id'];
  $qry= "select * from members where username='$id'";
}


$result=mysqli_query($conn,$qry);
while($row=mysqli_fetch_array($result)){
  $id = $row['user_id'];
?> 
 
<div id="content">
<div id="content-header">
  <h1>Informacion de Usuario</h1>
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

          <form action="edit-member-req.php" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Cedula :</label>
              <div class="controls">
                <input type="text" class="span11" name="username" readonly value='<?php echo $row['username']; ?>' />
              </div>
            </div>  
            <div class="control-group">
              <label class="control-label">Nombre :</label>
              <div class="controls">
                <input type="text" class="span11" name="fullname" readonly value='<?php echo $row['fullname']; ?>' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Genero :</label>
              <div class="controls">
              <input type="text" class="span11" name="username" readonly value='<?php echo $row['gender']; ?>' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Fecha de Registro :</label>
              <div class="controls">
                <input type="date" name="dor" class="span11" readonly value='<?php echo $row['dor']; ?>' />
                
               </div>
            </div>
            
          
        </div>
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Detalles de Contacto</h5>
        </div>
        <div class="widget-content nopadding">
        <div class="form-horizontal">
            <div class="control-group">
              <label for="normal" class="control-label">Telefono :</label>
              <div class="controls">
                <input type="number" id="mask-phone" name="contact" readonly value='<?php echo $row['contact']; ?>' class="span8 mask text">
                </div>
            </div>
            <div class="control-group">
              <label class="control-label">Direccion :</label>
              <div class="controls">
                <input type="text" class="span11" name="address" readonly value='<?php echo $row['address']; ?>' />
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	
    </div>

    
     
    <div class="span6">
      <div class="widget-box">

        <div class="widget-content nopadding">
          

              <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Detalle de Servicio</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
            
            
            <div class="control-group">
              <label class="control-label">Plan :</label>
              <div class="controls">
              <input type="text" class="span11" name="address" readonly value='<?php echo $row['plan']; ?>' />
              </div>
            </div>
            <?php
                include 'dbcon.php';


                // Consulta para obtener el nombre del plan del usuario

                $query = "SELECT plan, paid_date FROM members WHERE user_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    $plan_name = $user['plan'];
                    $subscription_start_date = $user['paid_date'];

                    // Consulta para obtener la duración del plan en meses
                    $query = "SELECT timepo FROM rates WHERE name = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $plan_name);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $plan = $result->fetch_assoc();
                        $duration_months = $plan['timepo'];

                        // Calcula la fecha de expiración del plan
                        $subscription_start_date = new DateTime($subscription_start_date);
                        $expiration_date = $subscription_start_date->add(new DateInterval('P' . $duration_months . 'M'));

                        // Calcula el tiempo restante
                        $today = new DateTime();
                        $interval = $today->diff($expiration_date);

                        if ($today > $expiration_date) {
                            $result1 = 'El plan ha expirado.';
                            $qry = "update members set status='Expired' where user_id='$id'";
                            $result2 = mysqli_query($conn,$qry);
                            
                        } else {
                            $result1 = '' . $interval->y . ' años, ' . $interval->m . ' meses, ' . $interval->d . ' días';
                            
                        }
                    } else {
                      $result1 =  'No se encontró información del plan.';
                        
                    }
                } else {
                  $result1 = 'No se encontró el usuario.';
                    
                }

                $stmt->close();
                $conn->close();
                ?>
              <div class="control-group">
              <label class="control-label">Duración Plan :</label>
              <div class="controls">
              <input type="text" class="span11" name="address" readonly value='<?php echo $plan['timepo']; ?> Meses' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tiempo Restante :</label>
              <div class="controls">
              <input type="text" class="span11" name="address" readonly value='<?php echo $result1; ?>' />
              </div>
            </div>

            </form>
            <div class="form-actions text-center">
              <td><div class='text-center'><a href='user-payment.php?id=<?php echo $id?>'><button class='btn btn-success btn'><i class='fas fa-dollar-sign'></i> Registrar Pago</button></a></div></td>
            </div>
          </div>
          <td>
    <div class='text-center'>
      <?php
        
        // URL de la imagen QR almacenada en tu servidor local
        $image_url = "http://localhost/Gym-System/admin/qrcodes/".$row['username'].".png"; 
        // Texto del mensaje que quieres enviar junto con la imagen
        $message = urlencode("Hola ".$row['fullname']. ",  bienvenid@ a la Familia *94 Fitness Center* ");
        $phone_number = '+593' . substr($row['contact'], 1);
      ?>
         <a href='https://web.whatsapp.com/send?phone=<?php echo $phone_number; ?>&text=<?php echo $message; ?>' target='_blank'>
        <button class='btn btn-primary btn'><i class='fab fa-whatsapp'></i> Enviar QR por WhatsApp</button>
      </a>
      <?php

// Consulta para obtener el nombre del archivo QR basado en el ID del usuario
$query = "SELECT username FROM members WHERE user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

// Ruta completa de la imagen QR
$qr_path = "qrcodes/" . $username . ".png";
?>
    <img src="<?php echo $qr_path; ?>" alt="Código QR">
    </div>
  </td>
<?php
}
?>
      

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
</script>
</body>
</html>