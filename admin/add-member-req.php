<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>
<!-- Visit codeastro.com for more projects -->
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
<!-- Visit codeastro.com for more projects -->
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
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Manamge Members</a> <a href="#" class="current">Add Members</a> </div>
  <h1>Member Entry Form</h1>
</div>
<form role="form" action="index.php" method="POST">
            <?php 

if(isset($_POST['fullname'])){
  $fullname = $_POST["fullname"];    
  $username = $_POST["username"];
  $password = '';
  $dor = $_POST["dor"];
  $gender = $_POST["gender"];
  $services = '';
  // $paid_date='$curr_date';
  $amount = 1;
  $p_year = date('Y');
  $paid_date = date("Y-m-d");
  $plan = $_POST["plan"];
  $address = $_POST["address"];
  $contact = $_POST["contact"];

  $password = md5($password);

  $totalamount = '5.5';
  include 'dbcon.php';
  // <!-- Visit codeastro.com for more projects -->
  $qry = "INSERT INTO members(fullname,username,password,dor,gender,services,amount,p_year,paid_date,plan,address,contact) values ('$fullname','$username','$password','$dor','$gender','$services','$totalamount','$p_year','$paid_date','$plan','$address','$contact')";
  $result = mysqli_query($conn,$qry); //query executes

if(!$result){
  // Mensaje de error
  echo "<div class='container-fluid'>";
  echo "<div class='row-fluid'>";
  echo "<div class='span12'>";
  echo "<div class='widget-box'>";
  echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
  echo "<h5>Error Message</h5>";
  echo "</div>";
  echo "<div class='widget-content'>";
  echo "<div class='error_ex'>";
  echo "<h1 style='color:maroon;'>Error 404</h1>";
  echo "<h3>Error occured while updating your details</h3>";
  echo "<p>Please Try Again</p>";
  echo "<a class='btn btn-warning btn-big'  href='edit-member.php'>Go Back</a> </div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
} else {
  // Generar el código QR con la cédula del usuario

  $user_id = mysqli_insert_id($conn);

  // Generar la URL del perfil del usuario
  $profileUrl = 'http://localhost/Gym-System/ver-member.php?id=' . urlencode($user_id );
  
  // Generar el código QR con la URL del perfil
  include 'libs/phpqrcode.php'; 
  if (!file_exists('qrcodes')) {
      mkdir('qrcodes', 0777, true);
  }
  $qrPath = 'qrcodes/' . $username . '.png';
  QRcode::png($profileUrl, $qrPath, QR_ECLEVEL_L, 4);



  // Mensaje de éxito
  echo "<div class='container-fluid'>";
  echo "<div class='row-fluid'>";
  echo "<div class='span12'>";
  echo "<div class='widget-box'>";
  echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
  echo "</div>";
  echo "<div class='widget-content'>";
  echo "<div class='error_ex'>";
  echo "<h1>Registrado</h1>";
  echo "<h3>Usuario Registrado con Exito!</h3>";
  echo "<img src='$qrPath' alt='QR Code' />";
  echo "<hr>";
  echo "<a class='btn btn-inverse btn-big'  href='members.php'>Go Back</a> </div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  
  // Supongamos que el archivo PNG ya ha sido generado y está disponible en una URL pública
  $qrPath = 'https://tu-dominio.com/qrcodes/666.png'; // Reemplaza esto con la URL real del archivo PNG
  
  // Número de teléfono en formato internacional sin espacios ni signos de '+'
  $telefono = '593998912139'; // Reemplaza con el número de teléfono real
  
  // Mensaje que incluirá la URL del QR en WhatsApp
  $mensaje = "Hola, aquí está tu código QR: " . urlencode($qrPath);
  
  // Crear el enlace de WhatsApp
  $whatsappUrl = "https://api.whatsapp.com/send?phone=" . $telefono . "&text=" . $mensaje;

}

}else{
    echo"<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='index.php'> DASHBOARD </a></h3>";
}


?>
                                    
                                
                                        
                
                                    </form>
                                </div>
</div></div>
</div>

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
