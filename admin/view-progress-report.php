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
  <link href="../font-awesome/css/all.css" rel="stylesheet" />
  <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/jquery.gritter.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>

<body>

  <!--Header-part-->
  <div id="header">
    <h1></h1>
  </div>
  <!--close-Header-part-->


  <!--top-Header-menu-->
  <?php include 'includes/topheader.php' ?>
  <?php $page = 'c-p-r';
  include 'includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <div id="content">
    <div id="content-header">
      <h1 class="text-center">Reporte de Progreso <i class="fas fa-tasks"></i></h1>
    </div>
    <div class="container-fluid print-container">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <?php
            include 'dbcon.php';
            $id = $_GET['id'];
            $qry = "select * from members where user_id='$id'";
            $result = mysqli_query($conn, $qry);
            while ($row = mysqli_fetch_array($result)) {
              ?>
              <div class="widget-content">
                <h1 style="text-align: center;">Certificado de Control</h1>
                <div class="row-fluid">
                  <div class="span4">
                    <table class="">
                      <tbody>
                        <tr>
                          <td>
                            <img src="../img/icongym.png" alt="">
                          </td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                  <div class="span6">
                    <br>
                    <h4>Miembro : 
                      <?php echo $row['fullname']; ?> 
                      <br> Variación de Peso 
                        <em style="color:green">
                          <?php include 'actions/progress-percent.php'; ?>%
                        </em> según las actualizaciones actuales! 
                      <br/>
                      <br/>
                      
                    </h4><br /></p>
                  </div>
                  <div class="span10">
                    <table class="table table-bordered table-invoice-full">
                      <thead>
                        <tr>
                          <th class="head0">Cedula</th>
                          <th class="head1 right">Peso Inicial</th>
                          <th class="head0 right">Peso Actual</th>
                          <th class="head1">Plan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="text-center"><?php echo $row['username']; ?></div>
                          </td>
                          <td>
                            <div class="text-center"><?php echo $row['ini_weight']; ?> KG</div>
                          </td>
                          <td>
                            <div class="text-center"><?php echo $row['curr_weight']; ?> KG</div>
                          </td>
                          <td>
                            <div class="text-center"><?php echo $row['plan']; ?></div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table table-bordered table-invoice-full">
                      <tbody>
                        <tr>
                          <td class="msg-invoice" width="55%">
                            <div class="text-center">
                              <h5>Estructura corporal de
                                <?php echo $row['fullname']; ?>: de
                                <?php echo $row['ini_bodytype']; ?> a
                                <?php echo $row['curr_bodytype']; ?>.
                                <br /> Con una diferencia total de peso de
                                <?php include 'actions/weight-diff.php'; ?> KG
                                <br /> Según los registros del
                                <?php echo $row['progress_date']; ?>
                              </h5>
                            </div>
                        </tr>
                      </tbody>
                    </table>
                  </div> <!-- end of span 12 -->
                  <div class="span12">
                    <div class="row-fluid">
                      <div style="text-align: center;">
                        <h4><span>Aprovado por:</h4>
                        <img src="../img/report/stamp-sample.png" width="124px;" alt="">
                        <p class="text-center">Nota:Autogenerado</p>
                      </div>

                    </div>
                  </div>


                </div>

              </div>
            </div>
          </div>
          <?php
            }
            ?>
      </div>
    </div>
    <div class="text-center">
      <button class="btn btn-danger" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    </div>
  </div>

  <!--end-main-container-part-->
  <style>
    @media print {
      body * {
        visibility: hidden;
      }

      .print-container,
      .print-container * {
        visibility: visible;
      }

      .print-container {
        position: absolute;
        left: -200px;
        top: 0px;
        right: 0px;
      }
    }
  </style>

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