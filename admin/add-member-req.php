<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
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
  <?php include 'includes/topheader.php' ?>
  <!--close-top-Header-menu-->
  <!--start-top-serch-->
  <!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
  <!--close-top-serch-->

  <!--sidebar-menu-->
  <?php $page = 'members-entry';
 include 'includes/sidebar.php' ?>
 <!--sidebar-menu-->
 <div id="content">

   <form role="form" action="index.php" method="POST">
     <?php
     require '../libs/BarcodeGenerator.php';
     require '../libs/BarcodeGeneratorPNG.php';
     require '../libs/BarcodeGeneratorJPG.php';

     use Picqer\Barcode\BarcodeGenerator;
     use Picqer\Barcode\BarcodeGeneratorPNG;
     use Picqer\Barcode\BarcodeGeneratorJPG;

     require_once  '../libs/Types/TypeCode128.php';

     if (isset($_POST['fullname'])) {
       $fullname = $_POST["fullname"];
       $username = $_POST["username"];
       $password = '';
       $dor = $_POST["dor"];
       $gender = $_POST["gender"];
       $services = '';
       $amount = 1;
       $p_year = date('Y');
       $paid_date = date("Y-m-d");
       $plan = $_POST["plan"];
       $address = $_POST["address"];
       $contact = $_POST["contact"];

       $password = md5($password);

       // Consultar el valor del plan antes de insertar (sin imprimir nada)
       include 'dbcon.php';
       $qry_plan = "SELECT * FROM rates WHERE name = '$plan' LIMIT 1";
       $result_plan = mysqli_query($conn, $qry_plan);
       $row_plan = mysqli_fetch_assoc($result_plan);
       $totalamount = $row_plan ? $row_plan['charge'] : '20';  // Asigna un valor por defecto si no se encuentra el plan
       $idplan = $row_plan['id'];
       // Inserción de los datos del miembro
       $qry = "INSERT INTO members(fullname, username, password, dor, gender, services, amount, p_year, paid_date, plan, address, contact) 
               VALUES ('$fullname','$username','$password','$dor','$gender','$services','$totalamount','$p_year','$paid_date','$plan','$address','$contact')";
       $result = mysqli_query($conn, $qry);

       // Inserción en la tabla de pagos
       $qry2 = "INSERT INTO pagos(id_plan, valor,id_user , fecha) VALUES ('$idplan','$totalamount','$username','$paid_date')";
       mysqli_query($conn, $qry2);

       if (!$result) {
         // Mostrar mensaje de error
         echo "<div class='container-fluid'>
                 <div class='row-fluid'>
                   <div class='span12'>
                     <div class='widget-box'>
                       <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                         <h5>Error</h5>
                       </div>
                       <div class='widget-content'>
                         <div class='error_ex'>
                           <h1 style='color:maroon;'>Error 404</h1>
                           <p>Por favor, inténtalo nuevamente.</p>
                           <a class='btn btn-warning btn-big' href='edit-member.php'>Regresar</a>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>";
       } else {
         $user_id = mysqli_insert_id($conn);
         $ced = $_POST["username"];

         // Generar el código de barras
         if (!file_exists('barcodes')) {
           mkdir('barcodes', 0777, true);
         }
         $barcodePath = 'barcodes/' . $ced . '.png';
         $generator = new BarcodeGeneratorJPG();
         $barcodeWidth = 180;
         $barcodeHeight = 30;
         $barcodeTextHeight = 50;

         $barcode = $generator->getBarcode($ced, $generator::TYPE_CODE_128);
         $totalHeight = $barcodeHeight + $barcodeTextHeight;
         $im = imagecreatetruecolor($barcodeWidth, $totalHeight);
         $white = imagecolorallocate($im, 255, 255, 255);
         $black = imagecolorallocate($im, 0, 0, 0);
         imagefill($im, 0, 0, $white);
         $barcodeImage = imagecreatefromstring($barcode);
         imagecopy($im, $barcodeImage, 0, 0, 0, 0, $barcodeWidth, $barcodeHeight);

         $fontPath = __DIR__ . '/fonts/arial.ttf';
         $fontSize = 12;
         $cedTextX = 45;
         $cedTextY = $barcodeHeight + 10;

         if (file_exists($fontPath)) {
           imagettftext($im, $fontSize, 0, $cedTextX, $cedTextY, $black, $fontPath, $ced);
         } else {
           imagestring($im, 5, $cedTextX, $cedTextY, $ced, $black);
         }

         imagepng($im, $barcodePath);
         imagedestroy($barcodeImage);
         imagedestroy($im);

         // Mensaje de éxito
         echo "<div class='container-fluid'>
                 <div class='row-fluid'>
                   <div class='span12'>
                     <div class='widget-box'>
                       <div class='widget-content'>
                         <div class='error_ex'>
                           <h1>Registrado</h1>
                           <h3>Usuario Registrado con Éxito!</h3>
                           <img src='$barcodePath'/>
                           <hr>
                           <a class='btn btn-inverse btn-big' href='members.php'>Regresar</a>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>";
       }
     } else {
       echo "<h3>NO ESTÁS AUTORIZADO PARA ESTAR EN ESTA PÁGINA. REGRESA A <a href='index.php'>DASHBOARD</a></h3>";
     }


      ?>




    </form>
  </div>
  </div>
  </div>
  </div>

  <!--end-main-container-part-->


  <?php include 'includes/scripts.php'; ?>

  <script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage(newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

        // if url is "-", it is this page -- reset the menu:
        if (newURL == "-") {
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