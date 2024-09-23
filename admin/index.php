<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
include "dbcon.php";
mysqli_query($con, "SET lc_time_names = 'es_ES'");
$qry="SELECT plan, count(*) as number FROM members GROUP BY plan";
$result=mysqli_query($con,$qry);
$qry="SELECT gender, count(*) as enumber FROM members GROUP BY gender";
$result3=mysqli_query($con,$qry);
$qry="SELECT DATE_FORMAT(fecha, '%M') AS mes, SUM(valor) AS total_cobrado FROM pagos GROUP BY mes ORDER BY MONTH(fecha)";
$result4=mysqli_query($con,$qry);
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
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Services', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["plan"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      //is3D:true,  
                      pieHole: 0.4 ,
                      
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);
      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Services', 'Total'],
          <?php
            $query="SELECT plan, count(*) as number FROM members GROUP BY plan";
            $res=mysqli_query($con,$query);
            while($data=mysqli_fetch_array($res)){
              $services=$data['plan'];
              $number=$data['number'];
           ?>
           ['<?php echo $services;?>',<?php echo $number;?>],   
           <?php   
            }
           ?> 
        ]);
        var options = {
          // title: 'Chess opening moves',
          width: 710,
          legend: { position: 'none' },
          // chart: { title: 'Chess opening moves',
          //          subtitle: 'popularity by percentage' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Total'} // Top x-axis.
            }
          },
          bar: { groupWidth: "100%" }
        };
        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Valores', 'Cantidad Total',],
          <?php
          $query1 = "SELECT gender FROM members; ";
          $query2 = "SELECT SUM(valor) as numberone FROM pagos; ";
            $rezz=mysqli_query($con,$query2);
            while($data=mysqli_fetch_array($rezz)){
              $services='Ganancias';
              $numberone=$data['numberone'];
              // $numbertwo=$data['numbertwo'];
           ?>
           ['<?php echo $services;?>',<?php echo $numberone;?>,],   
           <?php   
            }
           ?>
          <?php
            $query10 = "SELECT quantity, SUM(amount) as numbert FROM equipment";
            $res1000=mysqli_query($con,$query10);
            while($data=mysqli_fetch_array($res1000)){
              $expenses='Gastos';
              $numbert=$data['numbert'];
              
           ?>
           ['<?php echo $expenses;?>',<?php echo $numbert;?>,],   
           <?php   
            }
           ?>
        ]);
        var options = {
          width: "1050",
          legend: { position: 'none' },
          
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Total'} // Top x-axis.
            }
          },
          bar: { groupWidth: "100%" }
        };
        var chart = new google.charts.Bar(document.getElementById('top_y_div'));
        chart.draw(data, options);
      };
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result3))  
                          {  
                               echo "['".$row["gender"]."', ".$row["enumber"]."],";  
                          }  
                          ?>  
                     ]); 
        var options = {
          pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <script>
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([  
                ['Mes', 'Total Cobrado'],  
                <?php  
                while($row = mysqli_fetch_array($result4))  
                {  
                    echo "['".$row["mes"]."', ".$row["total_cobrado"]."],";  
                }  
                ?>  
            ]); 
            var options = {
                hAxis: {title: 'Mes'},
                legend: { position: 'none' }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('columnchart'));
            chart.draw(data, options);
        }
    </script>
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

 
<!--sidebar-menu-->
<?php $page='dashboard'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->



<!--main-container-part-->
<div id="content">

  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ls span3"> <a  style="font-size: 16px;"> <i class="fas fa-user-check"></i> <span class="label label-important"><?php include'actions/dashboard-activecount.php'?></span> Usuarios Activos </a> </li>
        <li class="bg_lo span3"> <a  style="font-size: 16px;"> <i class="fas fa-users"></i></i><span class="label label-important"><?php include'dashboard-usercount.php'?></span> Usuarios Registrados</a> </li>
        <li class="bg_lg span3"> <a  style="font-size: 16px;"> <i class="fas fa-dumbbell"></i></i><span class="label label-important"><?php include'actions/count-equipments.php' ?></span> Maquinas</a> </li>
      </ul>
    </div>
   
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="fas fa-file"></i></span>
          <h5>Resumen Servicios</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span8">
              <div id="top_x_div" style="width: 700px; height: 290px;"></div>
            </div>
            <div class="span4">
              <ul class="site-stats">
                <li class="bg_lh"><i class="fas fa-users"></i> <strong><?php include 'dashboard-usercount.php';?></strong> <small>Usuarios Totales</small></li>
                <li class="bg_lg"><i class="fas fa-user-clock"></i> <strong><?php include 'actions/dashboard-activecount.php';?></strong> <small>Usuarios Activos</small></li>
                <li class="bg_ls"><i class="fas fa-dollar-sign"></i> <strong><?php include 'income-count.php';?></strong> <small>Total Ingresos</small></li>
                <li class="bg_ly"><i class="fas fa-file-invoice-dollar"></i> <strong>$<?php include 'actions/total-exp.php';?></strong> <small>Total Invertido</small></li>
              </ul>
            </div>
          </div>
        </div>
      </div> 
    </div>
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="fas fa-file"></i></span>
          <h5>Ingresos y Gastos</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span12">
              <div id="top_y_div" style="width: 700px; height: 180px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End of row-fluid -->

    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_ly"><span class="icon"><i class="fas fa-file"></i></span>
            <h5>Usuarios Registrados por Genero</h5>
          </div>
              <div id="donutchart" style="width: 500px; height: 300px;"></div>
        </div>
      </div>
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_ly"><span class="icon"><i class="fas fa-file"></i></span>
            <h5>Ingresos por mes</h5>
          </div>
              <div id="columnchart" style="width: 500px; height: 300px;"></div>
          </div>
      </div>
    </div>

  </div><!-- End of container-fluid -->
</div><!-- End of content-ID -->

<!--end-main-container-part-->

<?php include 'includes/scripts.php'; ?>
<script type="text/javascript">
  function goPage (newURL) {
      if (newURL != "") {
      
          if (newURL == "-" ) {
              resetMenu();            
          } 
          else {  
            document.location.href = newURL;
          }
      }
  }
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
<?php
include 'dbcon.php';

// Consulta para obtener todos los usuarios con sus planes y fechas de pago
$query = "SELECT user_id, plan, paid_date FROM members";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($user = $result->fetch_assoc()) {
        $id = $user['user_id'];
        $plan_name = $user['plan'];
        $subscription_start_date = $user['paid_date'];

        // Consulta para obtener la duración del plan en meses
        $query_plan = "SELECT timepo FROM rates WHERE name = ?";
        $stmt = $conn->prepare($query_plan);
        $stmt->bind_param("s", $plan_name);
        $stmt->execute();
        $result_plan = $stmt->get_result();

        if ($result_plan->num_rows > 0) {
            $plan = $result_plan->fetch_assoc();
            $duration_months = $plan['timepo'];

            // Calcula la fecha de expiración del plan
            $subscription_start_date = new DateTime($subscription_start_date);
            $expiration_date = clone $subscription_start_date;
            $expiration_date->add(new DateInterval('P' . $duration_months . 'M'));

            // Calcula el tiempo restante
            $today = new DateTime();
            $today->setTime(0, 0, 0); // Normaliza la hora actual a medianoche

            // Verifica si el plan ha expirado
            if ($today > $expiration_date) {
                // Actualiza el estado del usuario a 'Expired' si ha expirado
                $qry_update = "UPDATE members SET status='Expired' WHERE user_id=?";
                $stmt_update = $conn->prepare($qry_update);
                $stmt_update->bind_param("i", $id);
                $stmt_update->execute();
            }
        }
        $stmt->close();
    }
}

// Cierra la conexión
$conn->close();
?>
</script>
</body>
</html>
