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
        <li class="list-group-item pagelink  <?php if($page=='main_info'){echo 'active';}?>"> 
           <a href="../main_info"><i class="fas fa-info"></i>  Main Info</a> 
        </li>
        <li class="list-group-item pagelink <?php if($page=='home_page'){echo 'active';}?>">
           <a href="../home_page"><i class="fas fa-home"></i>          Home Page</a> 
        </li>
        <li class="list-group-item pagelink <?php if($page=='home_slider'){echo 'active';}?>">
            <a href="../home_slider"><i class="fas fa-photo-video"></i> Home Slider</a> 
        </li>
       
        <li class="list-group-item pagelink <?php if($page=='projects_category'){echo 'active';}?>">
        <a href="../projects_category"> <i class="fas fa-sitemap"></i> Projects Category</a>
        </li>
        <li class="list-group-item pagelink <?php if($page=='manage_projects'){echo 'active';}?>">
         <a href="../manage_projects"><i class="fas fa-tasks"></i>     Manege Projects</a>
        </li>
        <li class="list-group-item pagelink <?php if($page=='manage_services'){echo 'active';}?>"> 
           <a href="../manage_services"><i class="fas fa-tasks"></i> Manege Services</a> 
        </li>
        <li class="list-group-item  pagelink <?php if($page=='manage_clients'){echo 'active';}?>"> 
           <a href="../manage_clients"><i class="fas fa-user-circle"></i> Manege Clients</a> 
        </li>
        <li class="list-group-item pagelink <?php if($page=='manage_videos'){echo 'active';}?>">
        <a href="../manage_videos"> <i class="fas fa-video"></i> Manege Videos</a>
       </li>
        <li class="list-group-item pagelink <?php if($page=='change_password'){echo 'active';}?>"> 
           <a href="../change_password"> <i class="fas fa-lock"></i> Change Password</a>
        </li>
        <li class="list-group-item pagelink"> <a href="../logout.php"><i class="fas fa-power-off"></i> LOGOUT</a></li>
      </ul>
