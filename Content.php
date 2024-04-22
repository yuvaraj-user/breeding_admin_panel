 <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-right hide-phone">
                                <ul class="list-inline">
                                    <li class="list-inline-item mr-3">
                                        <input class="knob" data-width="48" data-height="48" data-linecap=round
                                                           data-fgColor="#605daf" value="80" data-skin="tron" data-angleOffset="180"
                                                           data-readOnly=true data-thickness=".1"/>
                                    </li>
                                    <li class="list-inline-item">
                                        <span class="text-muted">Storage used</span>
                                        <h6>400GB/524.84GB</h6>
                                    </li>
                                </ul>                                
                            </div>
                            <h4 class="page-title">Dashboard</h4>
                            <div class="btn-group mt-2">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">Zoogler</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="icon-contain">
                                            <div class="row">
                                                <div class="col-2 align-self-center">
                                                    <i class="fas fa-tasks text-gradient-success"></i>
                                                </div>
                                                <div class="col-10 text-right">
                                                    <h5 class="mt-0 mb-1">190</h5>
                                                    <p class="mb-0 font-12 text-muted">Active Tasks</p>   
                                                </div>
                                            </div>                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body justify-content-center">
                                        <div class="icon-contain">
                                            <div class="row">
                                                <div class="col-2 align-self-center">
                                                    <i class="far fa-gem text-gradient-danger"></i>
                                                </div>
                                                <div class="col-10 text-right">
                                                    <h5 class="mt-0 mb-1">62</h5>
                                                    <p class="mb-0 font-12 text-muted">Project</p>
                                                </div>
                                            </div>                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="icon-contain">
                                            <div class="row">
                                                <div class="col-2 align-self-center">
                                                    <i class="fas fa-users text-gradient-warning"></i>
                                                </div>
                                                <div class="col-10 text-right">
                                                    <h5 class="mt-0 mb-1">14</h5>
                                                    <p class="mb-0 font-12 text-muted">Teams</p>    
                                                </div>
                                            </div>                                                        
                                        </div>                                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="icon-contain">
                                            <div class="row">
                                                <div class="col-2 align-self-center">
                                                    <i class="fas fa-database text-gradient-primary"></i>
                                                </div>
                                                <div class="col-10 text-right">
                                                    <h5 class="mt-0 mb-1">$15562</h5>
                                                    <p class="mb-0 font-12 text-muted">Budget</p>    
                                                </div>
                                            </div>                                                        
                                        </div>                                                    
                                    </div>
                                </div>
                            </div>                                             
                        </div> 
                        <div class="card">
                            <div class="card-body">
                                <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                    <label class="btn btn-primary btn-sm active">
                                        <input type="radio" name="options" id="option1" checked=""> This Week
                                    </label>
                                    <label class="btn btn-primary btn-sm">
                                        <input type="radio" name="options" id="option2"> Last Month
                                    </label>                                                
                                </div>
                                <h5 class="header-title mb-4 mt-0">Weekly Record</h5>
                                <canvas id="lineChart" height="80"></canvas>
                            </div>
                        </div>                                    
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown d-inline-block float-right">
                                    <a class="nav-link dropdown-toggle arrow-none" id="dLabel4" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel4">
                                        <a class="dropdown-item" href="#">Create Project</a>
                                        <a class="dropdown-item" href="#">Open Project</a>
                                        <a class="dropdown-item" href="#">Tasks Details</a>
                                    </div>
                                </div>
                                <h5 class="header-title mb-4 mt-0">Activity</h5>
                                <div>
                                    <canvas id="dash-doughnut" height="200"></canvas>
                                </div>
                                <ul class="list-unstyled list-inline text-center mb-0 mt-3">
                                    <li class="mb-2 list-inline-item text-muted font-13"><i class="mdi mdi-label text-success mr-2"></i>Active</li>
                                    <li class="mb-2 list-inline-item text-muted font-13"><i class="mdi mdi-label text-danger mr-2"></i>Complete</li>
                                    <li class="mb-2 list-inline-item text-muted font-13"><i class="mdi mdi-label text-warning mr-2"></i>Panding</li>
                                </ul>
                            </div>                               
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <p class="mb-0 text-muted font-13"><i class="mdi mdi-album mr-2 text-warning"></i>New Leads</p>                            
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-0 text-muted font-13"><i class="mdi mdi-album mr-2 text-danger"></i>New Leads Target</p>
                                    </div>
                                </div>
                                <div class="progress bg-gradient1 mb-3" style="height:5px;">
                                    <div class="progress-bar bg-gradient3" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <a class="btn btn-primary btn-sm btn-block text-white">Read More</a>
                            </div>
                            
                        </div>
                    </div>                                
                </div>
                <div class="row">
                    
            
             
              
                <!-- end row -->

            </div> <!-- end container -->
        </div>