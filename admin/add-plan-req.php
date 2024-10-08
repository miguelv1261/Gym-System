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
  <link rel="icon" type="image/png" href="../img/94logo.png">
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
  <?php include 'includes/topheader.php' ?>

  <?php $page = 'members-entry';
  include 'includes/sidebar.php' ?>

  <div id="content">
    <div id="content-header">

    </div>
    <form role="form" action="index.php" method="POST">
      <?php

      if (isset($_POST['nombre'])) {
        $name = $_POST["nombre"];
        $precio = $_POST["precio"];
        $dura = $_POST["dura"];
        include 'dbcon.php';
        //  
        $qry = "INSERT INTO rates(name,charge, timepo) values ('$name','$precio','$dura')";
        $result = mysqli_query($conn, $qry); //query executes

        if (!$result) {
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
          echo "<h3>Plan Registrado con Exito!</h3>";
          echo "<hr>";
          echo "<a class='btn btn-inverse btn-big'  href='members.php'>Regresar</a> </div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }
      } else {
        echo "<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='index.php'> DASHBOARD </a></h3>";
      }


      ?>




    </form>
  </div>
  </div>
  </div>
  </div>

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