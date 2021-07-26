
<!-- start Nav-bar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light  fixed-top">
   <div class="container">
    <a class="navbar-brand" href="../">
      <span id="company_first_name">Appointment</span><span id="company_last_name">System</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
          <a class="nav-link" href="../">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=='about'){echo "active";} ?>" href="../about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($_SESSION['page']=='contact'){echo "active";} ?>" href="../contact">Contact</a>
        </li>

          <li class="nav-item">
              <a class="nav-link" href="#">Book Appointment</a>
          </li>
        
      </ul>
     
    </div>
  </div>
</nav>



<!-- end Nav-bar-->