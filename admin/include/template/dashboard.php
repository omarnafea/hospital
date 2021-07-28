<?php  


$page=$_SESSION['page'];

?>

	<ul class="list-group list-group-flush"> 
    <li class="list-group-item list-group-item-success">
            <a href="#"><i class="fas fa-list"></i></a> 
    </li>
         <li class="list-group-item pagelink">
            <a href="../dashboard.php"><i class="fas fa-list"></i> DASHBOARD</a> 
        </li>


        <li class="list-group-item pagelink <?php if($page=='projects_category'){echo 'active';}?>">
            <a href="../manage_users"> <i class="fas fa-users"></i> Manage Users</a>
        </li>

        <li class="list-group-item pagelink <?php if($page=='clinics'){echo 'active';}?>">
        <a href="../clinics"> <i class="fas fa-sitemap"></i> Clinics</a>
        </li>
        <li class="list-group-item pagelink <?php if($page=='patients'){echo 'active';}?>">
        <a href="../patients"> <i class="fas fa-user"></i> patients</a>
        </li>
        <li class="list-group-item pagelink <?php if($page=='appointments'){echo 'active';}?>">
        <a href="../appointments"> <i class="fas fa-clock"></i> Appointments</a>
        </li>

        <li class="list-group-item pagelink <?php if($page=='change_password'){echo 'active';}?>"> 
           <a href="../change_password"> <i class="fas fa-lock"></i> Change Password</a>
        </li>
        <li class="list-group-item pagelink"> <a href="../logout.php"><i class="fas fa-power-off"></i> LOGOUT</a></li>
      </ul>
