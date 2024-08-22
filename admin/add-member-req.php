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
  <h1><a href="dashboard.html">94 Fitness Center</a></h1>
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
  //  
  $qry = "INSERT INTO members(fullname,username,password,dor,gender,services,amount,p_year,paid_date,plan,address,contact) values ('$fullname','$username','$password','$dor','$gender','$services','$totalamount','$p_year','$paid_date','$plan','$address','$contact')";
  $result = mysqli_query($conn,$qry); //query executes

if(!$result){
  // Mensaje de error
  echo "<div class='container-fluid'>";
  echo "<div class='row-fluid'>";
  echo "<div class='span12'>";
  echo "<div class='widget-box'>";
  echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
  echo "<h5>Error</h5>";
  echo "</div>";
  echo "<div class='widget-content'>";
  echo "<div class='error_ex'>";
  echo "<h1 style='color:maroon;'>Error 404</h1>";
  echo "<p>Por favor, Intentalo nuevamente</p>";
  echo "<a class='btn btn-warning btn-big'  href='edit-member.php'>Regresar</a> </div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
} else {
  // Generar el código QR con la cédula del usuario

  $user_id = mysqli_insert_id($conn);

  // Generar la URL del perfil del usuario
  $profileUrl = 'http://localhost/Gym-System/admin/ver-member.php?id=' . urlencode($user_id );
  
  // Generar el código QR con la URL del perfil
  include 'libs/phpqrcode.php'; 
  if (!file_exists('qrcodes')) {
      mkdir('qrcodes', 0777, true);
  }
  $qrPath = 'qrcodes/' . $username . '.png';
  QRcode::png($profileUrl, $qrPath, QR_ECLEVEL_L, 4);

  $qry= "select * from members where user_id='$user_id'";
$result=mysqli_query($conn,$qry);
while($row=mysqli_fetch_array($result)){

  // Mensaje de éxito
  echo "<div class='container-fluid'>";
  echo "<div class='row-fluid'>";
  echo "<div class='span12'>";
  echo "<div class='widget-box'>";
  echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
  echo "</div>";
  echo "<div class='widget-content'>";
  echo "<div class='error_ex'>";
  echo "<h1>Registro Exitoso</h1>";
  echo "<h3>Usuario Registrado con Exito!</h3>";
  echo "<img src='$qrPath' alt='QR Code' />";


    // Texto del mensaje que quieres enviar junto con la imagen
    $message = urlencode("Hola ".$row['fullname']. ",  bienvenid@ a la Familia *94 Fitness Center* ");
    $phone_number = '+593' . substr($row['contact'], 1);

  echo "<a href='https://web.whatsapp.com/send?phone=<?php echo $phone_number; ?>&text= $message' target='_blank'";
  echo " class='btn btn-primary btn'<i class='fab fa-whatsapp'></i> Enviar QR por WhatsApp";
  echo  "</a>";

  echo "<hr>";
  echo "<a class='btn btn-inverse btn-big'  href='members.php'>Regresar</a> </div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  
 }
}

}else{
    echo"<h3>NO ESTAS AUTORIZADO PARA ESTAR EN ESTA PAGINA.REGRESA A  <a href='index.php'> DASHBOARD </a></h3>";
}


?>
                                    
                                
                                        
                
                                    </form>
                                </div>
</div></div>
</div>

<!--end-main-container-part-->


<?php include 'includes/scripts.php'; ?>

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
