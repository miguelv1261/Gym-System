<div id="sidebar"><a href="#" class="visible-phone"><i class="fas fa-home"></i> Dashboard</a>
  <ul>
    <li class="<?php if($page=='dashboard'){ echo 'active'; }?>"><a href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Escritorio</span></a> </li>
    <li class="submenu"> <a href="#"><i class="fas fa-users"></i> <span>Usuarios</span> <span class="label label-important"><?php include 'dashboard-usercount.php';?> </span></a>
      <ul>
        <li class="<?php if($page=='members'){ echo 'active'; }?>"><a href="members.php"><i class="fas fa-arrow-right"></i> Ver Usuarios</a></li>
        <!--
        <li class="<?php //if($page=='members-entry'){ echo 'active'; }?>"><a href="member-entry.php"><i class="fas fa-arrow-right"></i> Registrar Usuarios</a></li>
        <li class="<?php //if($page=='members-remove'){ echo 'active'; }?>"><a href="remove-member.php"><i class="fas fa-arrow-right"></i> Eliminar Usuarios</a></li>
        <li class="<?php //if($page=='members-update'){ echo 'active'; }?>"><a href="edit-member.php"><i class="fas fa-arrow-right"></i> Editar Usuarios</a></li>
        -->
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="fas fa-list"></i> <span>Planes</span> <span class="label label-important"><?php include 'dashboard-plancount.php';?> </span></a>
      <ul>
        <li class="<?php if($page=='members'){ echo 'active'; }?>"><a href="plan.php"><i class="fas fa-arrow-right"></i> Ver Planes</a></li>
        <!--
        <li class="<?php if($page=='members-entry'){ echo 'active'; }?>"><a href="plan-entry.php"><i class="fas fa-arrow-right"></i> Registrar Plan</a></li>
        <li class="<?php if($page=='members-remove'){ echo 'active'; }?>"><a href="remove-member.php"><i class="fas fa-arrow-right"></i> Eliminar Plan</a></li>
        <li class="<?php if($page=='members-update'){ echo 'active'; }?>"><a href="edit-member.php"><i class="fas fa-arrow-right"></i> Editar Plan</a></li>
        -->
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="fas fa-dumbbell"></i> <span>Equipo</span> <span class="label label-important"><?php include 'dashboard-equipcount.php';?> </span></a>
    <ul>
        <li class="<?php if($page=='list-equip'){ echo 'active'; }?>"><a href="equipment.php"><i class="fas fa-arrow-right"></i> Ver Equipo </a></li>
       <!-- 
          <li class="<?php //if($page=='add-equip'){ echo 'active'; }?>"><a href="equipment-entry.php"><i class="fas fa-arrow-right"></i> Agregar Equipo</a></li>
          <li class="<?php //if($page=='remove-equip'){ echo 'active'; }?>"><a href="remove-equipment.php"><i class="fas fa-arrow-right"></i> Eliminar Equipo</a></li>
          <li class="<?php //if($page=='update-equip'){ echo 'active'; }?>"><a href="edit-equipment.php"><i class="fas fa-arrow-right"></i> Actualizar</a></li>
        -->
      </ul>
    </li>
      <!--
        <li class="<?php //if($page=='attendance'){ echo 'submenu active'; } else { echo 'submenu';}?>"> <a href="#"><i class="fas fa-calendar-alt"></i> <span>Attendance</span></a>
          <ul>
            <li class="<?php //if($page=='attendance'){ echo 'active'; }?>"><a href="attendance.php"><i class="fas fa-arrow-right"></i> Check In/Out</a></li>
            <li class="<?php //if($page=='view-attendance'){ echo 'active'; }?>"><a href="view-attendance.php"><i class="fas fa-arrow-right"></i> View</a></li>
          </ul>
        </li>
      -->
    <li class="<?php if($page=='manage-customer-progress'){ echo 'active'; }?>"><a href="customer-progress.php"><i class="fas fa-tasks"></i> <span>Progreso de Usuarios</span></a></li>
    <!-- 
    <li class="<?php //if($page=='member-status'){ echo 'active'; }?>"><a href="member-status.php"><i class="fas fa-eye"></i> <span>Member's Status</span></a></li>
    <li class="<?php //if($page=='payment'){ echo 'active'; }?>"><a href="payment.php"><i class="fas fa-hand-holding-usd"></i> <span>Payments</span></a></li>
    <li class="<?php //if($page=='announcement'){ echo 'active'; }?>"><a href="announcement.php"><i class="fas fa-bullhorn"></i> <span>Announcement</span></a></li>
    -->
    <li class="<?php if($page=='cobro'){ echo 'active'; }?>"><a href="caja.php"><i class="fas fa-briefcase"></i> <span>Caja</span></a></li>
    <li class="<?php if($page=='staff-management'){ echo 'active'; }?>"><a href="staffs.php"><i class="fas fa-briefcase"></i> <span>Staff</span></a></li>
    <li class="submenu"> <a href="#"><i class="fas fa-file"></i> <span>Reportes</span></a>
      <ul>
         <!-- 
        <li class="<?php if($page=='member-repo'){ echo 'active'; }?>"><a href="members-report.php"><i class="fas fa-arrow-right"></i> Members Report</a></li>
        -->
        <li class="<?php if($page=='c-p-r'){ echo 'active'; }?>"><a href="progress-report.php"><i class="fas fa-arrow-right"></i> Reporte de Progreso</a></li>
        <li class="<?php if($page=='c-p-r'){ echo 'active'; }?>"><a href="progress-report.php"><i class="fas fa-arrow-right"></i> Reporte de Caja</a></li>
      </ul>
    </li>
      <div id="clock" style="color: white; font-size: 35px; position: absolute; bottom: -150px; left: 35px;"></div>
      <li>
  <form action="ver-member.php" method="get" id="scan-form">
    <input type="text" name="cedula" placeholder="Escanea o ingresa la cédula" id="scan-input">
    <button type="submit">Buscar</button>
  </form>
  </li>
    </ul>
  <ul>

  </ul>

</div>

<script>
function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    var timeString = hours + ':' + minutes + ':' + seconds;
    document.getElementById('clock').textContent = timeString;
}

setInterval(updateClock, 1000);  // Actualiza el reloj cada segundo
updateClock();  // Llama a la función para mostrar el reloj inmediatamente
//
document.getElementById('scan-input').focus(); // El campo está siempre enfocado

document.getElementById('scan-input').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Evita el envío automático del formulario
        document.getElementById('scan-form').submit(); // Envía el formulario manualmente
    }
});

</script>