       <header id="page-topbar">
    <div class="d-flex">
        <div class="navbar-brand-box text-center">
            <a href="index.php" class="logo logo-light">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="22">
                </span>
               <span class="logo-lg">
                    <h6 style="color: white;line-height: 80px;"><img src="assets/images/logo-sm.png" alt="" height="22"> Budget Portal</h6>





                </span>
            </a>
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <!--<img src="assets/images/logo-sm.png" alt="" height="22">-->
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo_dark.png" alt="" height="20">
                </span>
            </a>
        </div>

        <div class="navbar-header">    
            <button type="button" class="button-menu-mobile waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button> 


             <a class="brand" href="index.php" style="font-weight: 600;
    position: relative;
    top: -15px!important;padding: 0px 19px 1px !important;
">  <a href="../../pages/landing.php"><img class="img-responsive brand logo_rasi" style="width: 100px;" src="../../global/photos/logo.png" alt="#"  /></a>

   </a><img class="img-responsive brand vijayrasiseeds vijaylogo" src="../../global/photos/VijayRasiSeedsLogo.png" alt="#" />


                </span>
            </a>
            <div class="d-flex ms-auto">
                <!-- Search input -->
                



                <div class="dropdown">
                    <button type="button" class="btn header-item toggle-search noti-icon waves-effect" data-target="#search-wrap">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                </div>

              

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user me-2" src="assets/images/users/avatar-1.png" alt="Header Avatar"> 
                        <span class="d-none d-md-inline-block ms-1"><?=@$_SESSION['Name'] ?><i class="mdi mdi-chevron-down"></i> </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                       
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../logout.php" role="menuitem"><i class="dripicons-power-off font-size-16 align-middle me-1 text-danger"></i> Logout</a>
                    </div>
                </div>


            </div>
        </div>    
    </div>    
</header>