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

<div id="header">
  <h1><a href="dashboard.html">94 Fitness Center</a></h1>
</div>
<?php include 'includes/topheader.php'?>
<?php $page="members"; include 'includes/sidebar.php'?>
<div id="content">
  <div id="content-header">
    <h1 class="text-center">Usuarios Registrados <i class="fas fa-group"></i></h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
      <a href="member-entry.php"><button class="btn btn-primary">Nuevo Usuario <i class="fas fa-plus"></i></button></a>
      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Tabla de Usuarios</h5>
          </div>
          <div class='widget-content nopadding'>
	  <?php
      include "dbcon.php";
      $qry="select * from members";
      $cnt = 1;
        $result=mysqli_query($conn,$qry);

        
          echo"<table  class='table table-striped table-bordered'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Cedula</th>
                  <th>Genero</th>
                  <th>Teléfono</th>
                  <th>Fecha de Registro</th>
                  <th>Dirección</th>
                  <th>Estado</th>
                  <th>Plan</th>
                  <th>Acción</th>
                </tr>
              </thead>";
              
            while($row=mysqli_fetch_array($result)){?>
            
            <tbody> 
               
                <td><div class='text-center'><?php echo $cnt?></div></td>
                <td><div class='text-center'><?php echo $row['fullname']?></div></td>
                <td><div class='text-center'><?php echo $row['username']?></div></td>
                <td><div class='text-center'><?php echo $row['gender']?></div></td>
                <td><div class='text-center'><?php echo $row['contact']?></div></td>
                <td><div class='text-center'><?php echo $row['dor']?></div></td>
                <td><div class='text-center'><?php echo $row['address']?></div></td>
                <td><div class='text-center'><?php if( $row['status'] == 'Active' ){ echo '<i class="fas fa-circle" style="color:green;"></i> Activo';} else if ($row['status'] == 'Expired') { echo '<i class="fas fa-circle" style="color:red;"></i> Expirado';} else { echo '<i class="fas fa-circle" style="color:orange;"></i> Pending Reg';}?></div></td>
                
                <td><div class='text-center'><?php echo $row['plan'];?></div></td>
                <td>
                  <div class='text-center'><a href='ver-member.php?id=<?php echo $row['user_id']?>&cedula=<?php echo urlencode($row['username']); ?>'><i class='fas fa-eye'></i> Ver</a></div>  
                  <div class='text-center'><a href='edit-memberform.php?id=<?php echo $row['user_id']?>'><i class='fas fa-edit'></i> Editar</a></div>
                  <div class='text-center'>
                    <a href='actions/delete-member.php?id=<?php echo $row['user_id']?>
                    ' style='color:#F66;'><i class='fas fa-trash'></i>Eliminar</a>
                  </div>                 
                </td>
                
              </tbody>
              <?php
          $cnt++;  }
            ?>

            </table>
          </div>
        </div>
   
		
	
      </div>
    </div>
  </div>
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
