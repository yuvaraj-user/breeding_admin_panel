


<?php include "header.php" ?>


<?php include "topmenubar.php" ?>


<?php include "sidebarmenu.php" ?>
<?php  

function Generate_Document_No($id)
{
    global $conn;
    //$Emp_Id=$Emp_Id !=''? strtoupper(trim($Emp_Id)) : "";
    $Doc_No_Auto_Generation_Sql = "Breeding_Generate_No @Id=" . $id . ",@EmployeeCode=" . @$_SESSION['EmpID']. " ";

    //  echo "Vechicle_Auot_Generate_No @Id=".$id."";
    $Doc_No_Auto_Generation_Dets = sqlsrv_query(
        $conn,
        $Doc_No_Auto_Generation_Sql
    );
    $Doc_No_Auto_Generation_Result = sqlsrv_fetch_array(
        $Doc_No_Auto_Generation_Dets
    );
    return $MC_Doc_No_Generation_Id =
        $Doc_No_Auto_Generation_Result["PrimaryId"];
}
$Doc_No = Generate_Document_No(0);





 ?>

<script>
    function Alert_Msg(Msg,Type){
        swal({
          title: Msg,
          icon: Type,
      });
    }

</script>

<style>

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

	</style>




<style>
    .bg-secondary {
        --bs-bg-opacity: 1;
        background-color: rgb(227 242 255) !important;
    }.tablecolor{

        background-color: #007bff;
        color: white;
    }.monthinputbox{

        border: none;
        background: transparent;
    }.close{

      background-color: red;
  }.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 13px !important;
}table thead{

  background-color: #0033c4;
  color: white;
}.header-title{

    color: blue;
    font-weight: 900;
}
.dt-buttons{

  display: none;
}
</style>


<style>
    body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 100%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 13px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {

  background-color: #ffffff;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 10px 16px;
  background-color: #042649;
  color: white;
}.name_user{

  font-weight: 700;
  padding-left: 1000px;

}.name_Id{

  font-weight: 700;
  padding-left: 1000px;

}.multiselect-container>li>a>label {
    margin: 0;
    height: 100%;
    cursor: pointer;
    font-weight: 400;
    padding: 0px 1px 1px 22px; 
}.select2-container {
    box-sizing: border-box;
    /*  display: inline; */
    margin: 0;
    position: relative;
    vertical-align: middle;
}.closereuest{

  font-size: 11px !important;
}table tr{

    font-size: 11px !important;
}.tripdetails,.pagination{
    font-size: 11px !important;

}.duplicate_row{
    background: floralwhite;
}

/*.btn-default{
  background-color: #bb0e0e;
  color: white;
}


*/
.btn-default{
border-color: #153754;
}

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}table tr{

    color: black;
}

.failed_completion {
    font-size: 30px;
    vertical-align: middle;
    color: grey !important;
}
.success_completion {
    font-size: 30px;
    vertical-align: middle;
    color: #5dd099 !important;  
}
.mismatch_completion {
    font-size: 30px;
    vertical-align: middle;
    color: #f96e5b !important;  
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.css"/>
    <body data-sidebar="colored" class="sidebar-enable vertical-collpsed">


        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="layout-wrapper">

     

         


            


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                      

                        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body bootstrap-select-1">
<h6 style="text-align: center;color: blue;">Labour Amount</h6>


<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                        <!-- Tab List -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link fieldTab active" id="labor-rate-tab" data-toggle="tab" href="#labor-rate" role="tab" aria-controls="labor-rate" aria-selected="true">Labor Rate</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fieldTab" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="false">Activity</a>
                            </li>
                        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            <!-- Labor Rate Tab -->
            <div class="tab-pane fade show active" id="labor-rate" role="tabpanel" aria-labelledby="labor-rate-tab">
                <div class="card-body bootstrap-select-1">
                    <form method="POST" class="Assumptionwisemalefemale">
                         <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  
                                              <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    
                                              <input type="hidden" class="Autonumloc" name="Autonumloc" >   
                                              <input type="hidden" class="Autonumid" name="Autonumid" >  
                        <h4 class="header-title mt-0">Labor Rate</h4>
                         <div class="row">
                                            


                                             <div class="col-md-2">
                                <h6 class="input-title mt-0">Location</h6>
                                <select class="multiselect mb-3 locationvalue" name="location[]" id="location"  multiple="multiple">

                                       <!-- <option value="">Choose Location</option> -->

                                                  <?php
                                                        $Sql12 = "SELECT Location, Id FROM BreedingAdmin_Monthwise_amount WHERE CurrentStatus='2'";
                                                        $params = array();
                                                        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                                        $exec = sqlsrv_query($conn, $Sql12, $params, $options);

                                                        if ($exec === false) {
                                                            die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
                                                        }

                                                        $existing_locations = array();
                                                        while ($rowVal = sqlsrv_fetch_array($exec)) {
                                                            $existing_locations[] = trim($rowVal['Location']);
                                                        }

                                                        $Sql = "SELECT DISTINCT BreedingAdmin_Location.BreedingLocation
                                                                FROM BreedingAdmin_Location
                                                                WHERE BreedingAdmin_Location.CreatedBy = '" . @$_SESSION['EmpID'] . "'";

                                                        $Sql_Connection = sqlsrv_query($conn, $Sql);
                                                        while ($row = sqlsrv_fetch_array($Sql_Connection)) {
                                                            $location = trim($row['BreedingLocation']);

                                                            // Check if the location is not in the existing_locations array
                                                            if (!in_array($location, $existing_locations)) {
                                                                ?>
                                                                <option value="<?php echo htmlspecialchars($location); ?>"><?php echo htmlspecialchars($location); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                    

                            </select>
                        </div>  


                                             <div class="col-md-4">
                                           <button type="button" class="btn btn-primary addbtn" id="addbtn" style="margin-top: 20px;"> Add </button>
                                             <button type="button" class="btn btn-danger completedrecord" style="margin-top: 20px;"> Completed </button>  
                                             </div>                                             
                                        </div>
                    </form>
                </div>
                <form method="POST" class="tablewisedataassumption">   
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Labour Rate Per Month</h4>
                                <div class="table-responsive">
                                    <p><button class='Add_Popup' id="Add_Popup" style="display: none;">Add new row</button></p>
                                         <table  class="table table-bordered  nowrap assumptionwise_Amount" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                              <thead >
                                                  <tr>                    
                                                    <th>Location</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Male</th>
                                                    <th>Female</th>
                                                    <th>Action</th>
                                                  </tr>
                                              </thead >
                                              <tbody class="">
                                              </tbody>
                                             
                                              </table>
                                        </div>                        
                                    </div>
                                </div>
                            </div>
                    </form>
                 <div align="center">
                    <button type="button" class="btn btn-sm btn-success finalassumptionsubmit">Submit</button>
                    <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>
                    </div>

            </div>
            
            <!-- Activity Tab -->
            <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                <div class="card-body bootstrap-select-1">
                    <form method="POST" class="Assumptionwisemalefemaleactivity">
                        <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  
                                              <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    
                                              <input type="hidden" class="Autonumloc" name="Autonumloc" >   
                                              <input type="hidden" class="Autonumid" name="Autonumid" >  
                                                <h4 class="header-title mt-0">Activity</h4>
                                                 <div class="row">
                                            <div class="col-md-2">
                                <h6 class="input-title mt-0">Location</h6>
                                <select class="multiselect mb-3 locationvalue" name="location[]" id="location"  multiple="multiple">

                                       <!-- <option value="">Choose Location</option> -->

                                                  <?php
                                                        $Sql12 = "SELECT Location, Id FROM BreedingAdmin_Monthwise_amount WHERE CurrentStatus='2'";
                                                        $params = array();
                                                        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                                        $exec = sqlsrv_query($conn, $Sql12, $params, $options);

                                                        if ($exec === false) {
                                                            die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
                                                        }

                                                        $existing_locations = array();
                                                        while ($rowVal = sqlsrv_fetch_array($exec)) {
                                                            $existing_locations[] = trim($rowVal['Location']);
                                                        }

                                                        $Sql = "SELECT DISTINCT BreedingAdmin_Location.BreedingLocation
                                                                FROM BreedingAdmin_Location
                                                                WHERE BreedingAdmin_Location.CreatedBy = '" . @$_SESSION['EmpID'] . "'";

                                                        $Sql_Connection = sqlsrv_query($conn, $Sql);
                                                        while ($row = sqlsrv_fetch_array($Sql_Connection)) {
                                                            $location = trim($row['BreedingLocation']);

                                                            // Check if the location is not in the existing_locations array
                                                            if (!in_array($location, $existing_locations)) {
                                                                ?>
                                                                <option value="<?php echo htmlspecialchars($location); ?>"><?php echo htmlspecialchars($location); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                    

                            </select>
                        </div>  



                         <div class="col-md-2">
                                <h6 class="input-title mt-0">Activity</h6>
                                <select class="multiselect mb-3 WorkActivity" name="WorkActivity[]" id="WorkActivity"  multiple="multiple">

                                       <!-- <option value="">Choose Location</option> -->

                                                 <?php
                                                                    $Sql   = "Select DISTINCT work from Farm_DRS_New_Labour_Workcode_DETAILS";
                                                                    $Sql_Connection = sqlsrv_query($conn,$Sql);
                                                                    while($row = sqlsrv_fetch_array($Sql_Connection)){
                                                                    ?>
                                                                    <option value="<?php echo trim($row['work']); ?>"> <?php echo $row['work']; ?> </option>
                                                                    <?php } ?>
                                                    

                            </select>
                        </div>  








                                             <div class="col-md-4">
                                           <button type="button" class="btn btn-primary addbtnactivity" id="addbtnactivity" style="margin-top: 20px;"> Add </button>
                                             <!-- <button type="button" class="btn btn-danger completedrecord" style="margin-top: 20px;"> Completed </button>   -->
                                             </div>                                             
                                        </div>
                    </form>
                </div>

                <form method="POST" class="tablewisedataassumptionactivity">   
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Activity Wise Labour Rate Per Month</h4>
                                <div class="table-responsive">
                                    <p><button class='Add_Popup' id="Add_Popup" style="display: none;">Add new row</button></p>
                                         <table  class="table table-bordered  nowrap assumptionwise_Amount_activity" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                              <thead >
                                                  <tr>                    
                                                    <th>Location</th>
                                                    <th>Activity</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Male</th>
                                                    <th>Female</th>
                                                    <th>Action</th>
                                                  </tr>
                                              </thead >
                                              <tbody class="">
                                              </tbody>
                                             
                                              </table>
                                        </div>                        
                                    </div>
                                </div>
                            </div>
                    </form>
                 <div align="center">
                    <button type="button" class="btn btn-sm btn-success finalassumptionsubmitactivity">Submit</button>
                    <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>
                    </div>
            </div>
        </div>                           


                           




 <div class="modal" id="Assumptionpopup" role="dialog">


    

    <div class="modal-dialog modal-lg" style="max-width: 400px !important">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss='modal'>&times;</button>
          <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 100px;">Male and Female Count</h6> 
        </div>
        <div class="Conformation-body">

          
                                        <div class="general-label">
                                            <form class="form-horizontal">
                                              
                                                                                                               
                                                  
                                                    <div class="col-sm-12 ml-auto input-group input-group-sm mt-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Male Count</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="malecount"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                    </div>


                                                      <div class="col-sm-12 ml-auto input-group input-group-sm mt-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Female Count</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="femalecount" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                    </div>

                                                    <div>
                                                        <br><br>

                                                    </div>
                                            </form>
                                                   
                 <div align="center">
                    <button type="button" class="btn btn-sm btn-success savemalefemale">Submit</button>



                     <button type='button' class='btn btn-default closebutton' data-dismiss='modal'>Close</button>

                    </div> 
                                                
                                            </form>
                                        </div>

            </div>
        </div>

      </div>
    </div>

  </form>


  </div>



<!-- <form method="POST" class="tablewisedataassumption">   

  <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Labour Rate Per Month</h4>
                               

                                <div class="table-responsive">


<p><button class='Add_Popup' id="Add_Popup" style="display: none;">Add new row</button></p>
                                         <table  class="table table-bordered  nowrap assumptionwise_Amount" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead >
                  <tr>                    
                   
                            <th>Location</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Male</th>
                            <th>Female</th>

                  </tr>
              </thead >


              <tbody class="">


              </tbody>
             
              </table>
            </div>                        
        </div>
        </div>
        </div>
</form>
                 <div align="center">
                    <button type="button" class="btn btn-sm btn-success finalassumptionsubmit">Submit</button>
                    <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>

                    </div> -->


                        </div>                                
                    </div> 
                </div>

         







  <div class="modal" id="Completedrecordpopup" role="dialog">


    <form method="POST" class="Completedrecordpopup">

    <div class="modal-dialog modal-lg" style="max-width: 1200px !important">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss='modal'>&times;</button>
          <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 465px;">Completed Record</h6> 
        </div>
        <div class="Conformation-body-completed">

    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                
                              

                                <!-- Nav tabs -->
                                <ul class="nav nav-pills nav-justified navCss" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">MANDAYS PER ACRE</a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link labourratedesign" data-toggle="tab" href="#profile-1" role="tab">LABOUR RATE PER MONTH</a>
                                    </li>
                                  
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                                       
                                      <table  class="table table-bordered  nowrap assumptionwisecompleted" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead  >
                  <tr>                    
                   
                    <th style="font-size: 11px !important;">Location</th>
                    <th style="font-size: 11px !important;"> Project</th>
                    <th style="font-size: 11px !important;"> Activity</th>

                    <th style="font-size: 11px !important;"> Male</th>
                    <th style="font-size: 11px !important;"> Female</th>

                   



                 
                   
        
                    
                  </tr>
              </thead >


              <tbody class="">


              </tbody>
             
              </table>
                                    </div>
                                    <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                         <table  class="table table-bordered  nowrap assumptionwise_Amount_completed" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead >
                  <tr>                    
                   
                            <th>Location</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Male</th>
                            <th>Female</th>

                  </tr>
              </thead >


              <tbody class="">


              </tbody>
             
              </table>
                                    </div>
                                  
                                </div>

                            </div>
                        </div>
                    </div>


                            <div align="center">
                    <button type="button" class="btn btn-sm btn-success finalsubmittioncompleted">Submit</button>



                    <button type="button" class="btn btn-sm btn-danger " data-dismiss='modal'>Cancel</button>

                  

                    </div>
        </div>

      </div>
    </div>

  </form>


  </div>  

             

                    </div>    
                </div>
                <!-- End Page-content -->

                
                
               <?php include "footer.php"; ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

                             
        <!-- JAVASCRIPT -->
         <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

       
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <script src="assets/js/app.js"></script>

       
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>

       <script src="../common/checkSession.js"></script>

<!-- Required datatable js -->


    <script>





    $(document).ready(function(){
    // $('.js-example-basic-single').select2();
        $('.multiselect').multiselect({
          maxHeight: 250,
          buttonWidth: 150,
        // selectAllText:' Select all',
          includeSelectAllOption:true,
          dropdownPosition: 'below',
          enableFiltering: true,
          enableCaseInsensitiveFiltering: true, 
          nonSelectedText: 'Choose ',
        });

    


  });

    </script>


    <script>



$(document).on("click",".addbtn",function(){

var locationvalue=$("#location").val();

console.log(locationvalue)

if(locationvalue ==''){

 Alert_Msg("Please Select Location.","warning");
 return false;
}


  //let Uset_Input=$(".Assumptionwisemalefemale").serializeArray();

  //console.log('outside');

//console.log(Uset_Input)
    
     //Uset_Input.push({"name":"Action","value":"AssumptionEnrty_malefemaleamount"});
     assumptionwiseprojectDetails_month_amount("yes",locationvalue);    
      
});


$(document).on("click",".delete_labour_amount",function(){

var Id      = $(this).data('labourid');
var Location      = $(this).data('labourloc');

      $.ajax 
      ({
      method: "POST",
      url: "Common_Ajax.php",
       data:{"Action":"Delete_Labour_Amount_Entry","Id":Id,"Location":Location},
       async:false,//
      success: function(data){
          
         result=JSON.parse(data);
         
         if(result.Status == 1){
           

            Alert_Msg("Deleted.","success");


          window.location.href ='Assumptions_Div.php';
  

            return false;
         }else{

           // alert("Wrong");
               Alert_Msg("Something Went Wrong.","error");
               return false;
         }
        }
      });




return false;  
      
});


$(document).on("click",".delete_activity_amount",function(){

var Id      = $(this).data('activityid');
var Location      = $(this).data('activityloc');
var Activity      = $(this).data('activity');
    
      $.ajax 
      ({
      method: "POST",
      url: "Common_Ajax.php",
       data:{"Action":"Delete_ActivityWise_Labour_Amount_Entry","Id":Id,"Location":Location,"Activity":Activity},
       async:false,//
      success: function(data){
          
         result=JSON.parse(data);
         
         if(result.Status == 1){
           

            Alert_Msg("Deleted.","success");


          window.location.href ='Assumptions_Div.php';
  

            return false;
         }else{

           // alert("Wrong");
               Alert_Msg("Something Went Wrong.","error");
               return false;
         }
        }
      });




return false; 
      
});

$(document).on("click",".addbtnactivity",function(){

var locationvalue=$("#locationActi").val();
var activityvalue=$("#WorkActivity").val();

if(locationvalue ==''){

 Alert_Msg("Please Select Location.","warning");
 return false;
}

if(activityvalue ==''){

 Alert_Msg("Please Select Location.","warning");
 return false;
}
     assumptionwiseprojectDetails_month_amount_activity("yes",locationvalue,activityvalue);  
      
});



// function assumptionwiseprojectDetails_month_amount(destroy_status, user_input) {
//     // console.log('inside');
//     // console.log(user_input);

//     var Autoincnum = user_input.Autoincnum;
//     var autoid = user_input.autoid;
//     var data_table = 'assumptionwise_Amount';

//     // Destroy existing DataTable if destroy_status is "yes"
//     if (destroy_status === "yes") {
//         $('.' + data_table).DataTable().destroy();
//     }

//     // Initialize DataTable with options
//     $('.' + data_table).DataTable({
//         "dom": 'Bfrtip',
//         "scrollX": true,
//         "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
//         "processing": true,
//         "serverSide": true,
//         "pageLength": 5,
//         "searching": false,
//         "ajax": {
//             "url": "Common_Ajax.php",
//             "type": "POST",
//             "data": {
//                 "Action": "AssumptionEnrty_malefemaleamount",
//                 "user_input": user_input
//             }
            
//         }
//     });
// }


function assumptionwiseprojectDetails_month_amount(destroy_status,user_input)
{


// Autoincnum=user_input.Autoincnum;
// autoid=user_input.autoid;

   var data_table='assumptionwise_Amount'
   if(destroy_status == "yes")
  {
    $('.'+data_table).DataTable().destroy();
  }
 $('.' + data_table).DataTable({

    "dom": 'Bfrtip',

 
  
  //"columnDefs": [{ "className":"y desine", "targets": [1,2,3,4,5] }],
    "scrollX": true,
    "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
    "bprocessing": true,
    "serverSide": true,
    "pageLength": 5,
      "searching": false,
    "ajax": 
    {
      "url": "Common_Ajax.php", 
      "type": "POST",
      "data": {Action:"AssumptionEnrty_malefemaleamount","user_input": user_input}
    }
  });
}

function assumptionwiseprojectDetails_month_amount_activity(destroy_status,location,activity)
{


//Autoincnum=user_input.Autoincnum;
//autoid=user_input.autoid;

   var data_table='assumptionwise_Amount_activity'
   if(destroy_status == "yes")
  {
    $('.'+data_table).DataTable().destroy();
  }
 $('.' + data_table).DataTable({

    "dom": 'Bfrtip',

 
  
  //"columnDefs": [{ "className":"y desine", "targets": [1,2,3,4,5] }],
    //"scrollX": true,
    "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
    "bprocessing": true,
    "serverSide": true,
    "pageLength": 5,
      "searching": false,
    "ajax": 
    {
      "url": "Common_Ajax.php", 
      "type": "POST",
      "data": {Action:"AssumptionEnrty_malefemaleamount_activity","location": location,"activity": activity}
    }
  });
}



/*

 $(document).on("click",".singleseletion",function(){




var locationvalue=$("#location").val();

var projectnvalue=$("#project").val();


//alert(locationvalue);

if(locationvalue ==''){

 Alert_Msg("Please Select Location.","warning");
 return false;
}

if(projectnvalue ==''){

 Alert_Msg("Please Select project.","warning");
 return false;
}

           // alert(breedingtype);

//alert("Hai");
        //  return false;

 let Uset_Input=$(".Assumptionwisemalefemale").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"Assumptionwisemalefemale"});
    
      $.ajax 
      ({
      type: "POST",
      url: "Common_Ajax.php",
       data:Uset_Input,
       async:false,//
      success: function(data){

      //  $(".loadingclasspre").hide()

        //$(".projectwisehide").css("display","block")
          
         result=JSON.parse(data);



         
         if(result.Status == 1){
           

            Alert_Msg("Added.","success");

             var user_input={};


  
   assumptionwiseprojectDetails("yes",user_input);

       assumptionwiseprojectDetails_month_amount("yes",user_input);
            return false;
         }else{

           // alert("Wrong");
               Alert_Msg("Something Went Wrong.","error");
               return false;
         }
        }
      });




return false;



      




   
      
      
});

*/


// $(document).on("change",".locationvalue",function(){
//     ///$(this).closest("tr").find(".QtyInBag").removeAttr("readonly");
//     var locbaseproject=$(this).val();
//     //var curren_tr=$(this).closest("tr");
//      $.ajax 
//       ({
//       type: "POST",
//       url: "AutoFill_Details.php",
//       data:{"Action":"Get_Location_Based_Project","locbaseproject":locbaseproject},
//        async:false,
     

//        success: function(html){

//         console.log(html)

//           $(".locbaseprojectvalue").html(html);
        
//         }


//     });
//    });





// function assumptionwiseprojectDetails(destroy_status,user_input)
// {

// Autoincnum=user_input.Autoincnum;
// autoid=user_input.autoid;

//    var data_table='assumptionwise'
//    if(destroy_status == "yes")
//   {
//     $('.'+data_table).DataTable().destroy();
//   }
//  var table = $('.' + data_table).DataTable({

//     "dom": 'Bfrtip',
  
//    //"columnDefs": [{ "className":"y desine", "targets": [1] }],
//     "scrollX": true,
//     "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
//     "bprocessing": true,
//     "serverSide": true,
//     "pageLength": 5,
//       "searching": false,
//     "ajax": 
//     {
//       "url": "Common_Ajax.php", 
//       "type": "POST",
//       "data": {Action:"AssumptionEnrty"}         
//     }
//   });

// }







  $(document).ready(function(){

   //$('.btn.btn-default.multiselect-clear-filter').css('display', 'none');

     $('.locbaseprojectvalue').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 400,
        buttonText: function(options, select) {
            if (options.length === 0) {
                return 'Select Projects';
            } else {
                return options.length + ' selected';
            }
        }
    });

    //  $('.WorkActivity').multiselect({
    //     includeSelectAllOption: true,
    //     enableFiltering: true,
    //     maxHeight: 400,
    //     buttonText: function(options, select) {
    //         if (options.length === 0) {
    //             return 'Select Projects';
    //         } else {
    //             return options.length + ' selected';
    //         }
    //     }
    // });

     $('.locationvalue').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 400,
        buttonText: function(options, select) {
            if (options.length === 0) {
                return 'Select Location';
            } else {
                return options.length + ' selected';
            }
        }
    });


    //  $('.locationvalueActi').multiselect({
    //     includeSelectAllOption: true,
    //     enableFiltering: true,
    //     maxHeight: 400,
    //     buttonText: function(options, select) {
    //         if (options.length === 0) {
    //             return 'Select Location';
    //         } else {
    //             return options.length + ' selected';
    //         }
    //     }
    // });

     $('.js-example-basic-single').select2();


  


   var user_input={};
    

  
      //assumptionwiseprojectDetails("no",user_input);
     assumptionwiseprojectDetails_month_amount("no",user_input);

     $(document).on('click', '.nav-link.fieldTab', function() {

        var location='';
    var activity='';

    var href = $(this).attr('href');

    if(href == '#activity')
    {
        $('.assumptionwise_Amount_activity').DataTable().destroy();
     assumptionwiseprojectDetails_month_amount_activity("no",location,activity);
    }

   // console.log(href)
});



     // Handle change event on .locationvalue
    $(document).on("change", ".locationvalue", function() {
        var locbaseproject = $(this).val();

        // Make AJAX request to fetch updated options
        $.ajax({
            type: "POST",
            url: "AutoFill_Details.php",
            data: {
                "Action": "Get_Location_Based_Project",
                "locbaseproject": locbaseproject
            },
            success: function(html) {
                // Replace options in the select element
                $('.locbaseprojectvalue').empty().append(html);

                // Update bootstrap-multiselect with new options
                $('.locbaseprojectvalue').multiselect('rebuild');
            }
        });
    });



  });

var rowdloa=2;


    function add_row_loading(){
  
  var new_row = '<div class="form-group"><label for="exampleInputUsername1">Location</label><input type="text"  id="Locationamount" style="width: 120px!important;" /><label for="exampleInputUsername1">From</label><input type="month" id="locationmonthfrom" name="locationmonthfrom" style="width: 120px!important;"><label for="exampleInputUsername1">To</label><input type="month" id="locationmonthfrom" name="locationmonthfrom" style="width: 120px!important;"></div><div class="form-group"><label for="exampleInputUsername1">Male</label><input type="text"  id="Locationamount"   style="width: 134px!important;"><label for="exampleInputUsername1">Female</label><input type="text"  id="Locationamount"  style="width: 160px!important;"><button type="button" onclick ="add_row_loading()" class="btn-sm btn-success" style="height:;">ADD</button><button class="delete_row_load btn btn-secondary" style="height: 28px;"><i class="fa fa-trash" aria-hidden="true" ></i></button></div>';
   // alert(new_row);
  $('#loadingpoints').append(new_row);
   // alert(rowdloa);
//s_no_loa()
  rowdloa++;

 $('.js-example-basic-single').select2();
       $.each($(".loadsno"),function (i,el){

              ///alert("Hai22222---" +i);
        $(this).find("td:first input").val(i + 1); // Simply couse the first "prototype" is not counted in the list
    });


  return false;
  }

 function delete_row_load(){

if(rowdel>1) {
      $(this).closest('div').remove();
      rowdel--;
    }


   

  return false;


    }





$(document).on("click", ".Add_Popup", function (){

      //  alert("Hai");

       var passing_total_acrage=$(this).parents('tr').find(".acragevaluemain").val();

      // var CTC_Value = $(this).parents('tr').find(".CTC_Value").val();

      // alert(passing_total_acrage);

       //return false;

       if(passing_total_acrage ==''){

        var passing_total_acrage=0;


       }

    $("#monthwisedetails").modal('show');
 var passing_id_loc=$(this).closest('td').find('.passing_id_loc').val();
 var passing_id_proj=$(this).closest('td').find('.passing_id_proj').val();






 

     var passing_id = $(this).attr("attributeid");
       var currentRequest = $.ajax({
            type: "POST",
            url: "ajax_popup_details_View.php",
            beforeSend: function() {
                var sdata = checkSession();
                if(sdata.status=='expired')
                  currentRequest.abort();
            },
            data: {
                passing_id: passing_id,
                passing_id_loc: passing_id_loc,
                passing_id_proj: passing_id_proj,
                action_type:"monthwisedata"
            },
            success: function (output) {
              var rowdata = JSON.parse(output);
              $("#monthwisedetails").modal('show');
              $(".Conformation-body").html(rowdata);

              $(".Total_acrage").val(passing_total_acrage);
            }
        });




    });
    





$(document).on("click",".finalsubmittion",function(){

 let Uset_Input=$(".tablewisedataassumption").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"FinalsubmittionAssumption"});
    
      $.ajax 
      ({
      type: "POST",
      url: "Common_Ajax.php",
       data:Uset_Input,
       async:false,//
      success: function(data){
          
         result=JSON.parse(data);
         
         if(result.Status == 1){
           

            Alert_Msg("Submitted.","success");


          window.location.href ='Assumptions_Div.php';
  

            return false;
         }else{

           // alert("Wrong");
               Alert_Msg("Something Went Wrong.","error");
               return false;
         }
        }
      });




return false;



      


});




$(document).on("click",".singleseletion",function(){

    //alert("hai");



var locationvalue=$("#location").val();

var projectnvalue=$("#project").val();


//alert(locationvalue);

if(locationvalue ==''){

 Alert_Msg("Please Select Location.","warning");
 return false;
}

if(projectnvalue ==''){

 Alert_Msg("Please Select project.","warning");
 return false;
}



    $("#Assumptionpopup").modal('show');



});






//         $(document).on("click",".savemalefemale",function(){

// //alert("Hai");

// //return false;


// var locationvalue=$("#location").val();

// var projectnvalue=$("#project").val();


// //alert(locationvalue);

// if(locationvalue ==''){

//  Alert_Msg("Please Select Location.","warning");
//  return false;
// }

// if(projectnvalue ==''){

//  Alert_Msg("Please Select project.","warning");
//  return false;
// }

//            // alert(breedingtype);

// //alert("Hai");
//          // return false;

//   let Uset_Input=$(".Assumptionwisemalefemale").serializeArray();
//   Uset_Input.push({"name":"Action","value":"singlemalefemale"});
// assumptionwiseprojectDetails_month_amount("yes",user_input);
    
//  //    Uset_Input.push({"name":"Action","value":"singlemalefemale"});
    
//  //      $.ajax 
//  //      ({
//  //      type: "POST",
//  //      url: "Common_Ajax.php",
//  //       data:Uset_Input,
//  //       async:false,//
//  //      success: function(data){

//  //      //  $(".loadingclasspre").hide()

//  //        //$(".projectwisehide").css("display","block")
          
//  //         result=JSON.parse(data);



         
//  //         if(result.Status == 1){
           

//  //            Alert_Msg("Added.","success");

//  //             var user_input={};

//  //   $(".close").trigger('closebutton'); 
  
//  //   //assumptionwiseprojectDetails("yes",user_input);

//  //       assumptionwiseprojectDetails_month_amount("yes",user_input);



//  //            return false;
//  //         }else{

//  //           // alert("Wrong");
//  //               Alert_Msg("Something Went Wrong.","error");
//  //               return false;
//  //         }
//  //        }
//  //      });




// return false;      
// });


$(document).on("click",".finalassumptionsubmit",function(){
   $('#ajax_loader').show();
   //$('.assumptionwise').DataTable().page.len(50000).draw();
   $('.assumptionwise_Amount').DataTable().page.len(50000).draw();
   
   //var table = $('.assumptionwise').DataTable();
   var table1 = $('.assumptionwise_Amount').DataTable();
   //table.on('draw.dt', function () {
    table1.on('draw.dt', function () {
       let Uset_Input=$(".tablewisedataassumption").serializeArray();

       console.log(Uset_Input)

       Uset_Input.push({"name":"Action","value":"finalmalefemaleamountdata"});
       assumption_submit(Uset_Input);
   });

//});
    

});

function assumption_submit(Uset_Input)
{
  $.ajax 
  ({
      type: "POST",
      url: "Common_Ajax.php",
      data:Uset_Input,
       async:false,//
       success: function(data){
            $('#ajax_loader').hide();

           result=JSON.parse(data);

           if(result.Status == 1){


            Alert_Msg("Submitted.","success");


            $(".close").trigger('click'); 


            var Autoincnum=$(".Autonumloc").val();
            var  autoid=$(".Autonumid").val();
            window.location.href ='Assumptions_Div.php';
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

           // assumptionwiseprojectDetails("yes",user_input);

            assumptionwiseprojectDetails_month_amount("yes",user_input);


            return false;
        }else{

           // alert("Wrong");
         Alert_Msg("Something Went Wrong.","error");
         return false;
     }
 }
});
}


$(document).on("click",".finalassumptionsubmitactivity",function(){
   $('#ajax_loader').show();
   //$('.assumptionwise').DataTable().page.len(50000).draw();
   $('.assumptionwise_Amount_activity').DataTable().page.len(50000).draw();
   
   //var table = $('.assumptionwise').DataTable();
   var table1 = $('.assumptionwise_Amount_activity').DataTable();
   //table.on('draw.dt', function () {
    table1.on('draw.dt', function () {
       let Uset_Input=$(".tablewisedataassumptionactivity").serializeArray();

       console.log(Uset_Input)

       Uset_Input.push({"name":"Action","value":"finalmalefemaleamountdataactivity"});
       assumption_submit_activity(Uset_Input);
   });

//});
    

});


function assumption_submit_activity(Uset_Input)
{
  $.ajax 
  ({
      type: "POST",
      url: "Common_Ajax.php",
      data:Uset_Input,
       async:false,//
       success: function(data){
            $('#ajax_loader').hide();

           result=JSON.parse(data);

           if(result.Status == 1){


            Alert_Msg("Submitted.","success");


            $(".close").trigger('click'); 


            var Autoincnum=$(".Autonumloc").val();
            var  autoid=$(".Autonumid").val();
            window.location.href ='Assumptions_Div.php';
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

           // assumptionwiseprojectDetails("yes",user_input);

            assumptionwiseprojectDetails_month_amount_activity("yes",user_input);


            return false;
        }else{

           // alert("Wrong");
         Alert_Msg("Something Went Wrong.","error");
         return false;
     }
 }
});
}




$(document).on("click", ".completedrecord", function (){

    

    $("#Completedrecordpopup").modal('show');
var user_input={};


 user_input.Autoincnum=Autoincnum;
 user_input.autoid=autoid;
  
  assumptionwiseCompletedprojectDetails("yes",user_input);

assumptionwiseprojectDetails_month_amount_Completed("yes",user_input);

    });


$(document).on("click", ".labourratedesign", function (){

    

    ///$("#Completedrecordpopup").modal('show');
var user_input={};


 user_input.Autoincnum=Autoincnum;
 user_input.autoid=autoid;
  
 

assumptionwiseprojectDetails_month_amount_Completed("yes",user_input);

    });







function assumptionwiseCompletedprojectDetails(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='assumptionwisecompleted'
   if(destroy_status == "yes")
  {
    $('.'+data_table).DataTable().destroy();
  }
 $('.' + data_table).DataTable({

    "dom": 'Bfrtip',

 
  
   //"columnDefs": [{ "className":"y desine", "targets": [1] }],
    "scrollX": true,
    "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
    "bprocessing": true,
    "serverSide": true,
    "pageLength": 5,
      "searching": false,
    "ajax": 
    {
      "url": "Common_Ajax.php", 
      "type": "POST",
      "data": {Action:"AssumptionEnrtyCompleted"}
    }
  });
}







function assumptionwiseprojectDetails_month_amount_Completed(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='assumptionwise_Amount_completed'
   if(destroy_status == "yes")
  {
    $('.'+data_table).DataTable().destroy();
  }
 $('.' + data_table).DataTable({

    "dom": 'Bfrtip',

 
  
  //"columnDefs": [{ "className":"y desine", "targets": [1,2,3,4,5] }],
    "scrollX": true,
    "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
    "bprocessing": true,
    "serverSide": true,
    "pageLength": 5,
      "searching": false,
    "ajax": 
    {
      "url": "Common_Ajax.php", 
      "type": "POST",
      "data": {Action:"AssumptionEnrty_malefemaleamount_completed"}
    }
  });
}

$(document).on('keyup','.count_num',function(){
    var gender = $(this).data('gender');
    var activity_id = $(this).parents('tr').find('.activeid').val();
    var count = $(this).val();
    $.ajax ({
      type: "POST",
      url: "Common_Ajax.php",
      data: { Action: 'assumption_malefemale_count_update',id : activity_id,count : count,gender : gender },
      success: function(data){
      }
    });

});

$(document).on('change','.month',function(){
    var m_type      = $(this).data('monthtype');
    var id          = $(this).parents('tr').find('.monthwise_amt_id').val();
    var date        = $(this).val();
    $.ajax ({
      type: "POST",
      url: "Common_Ajax.php",
      data: { Action: 'assumption_malefemale_amount_update',id : id,date : date,month_type : m_type },
      success: function(data){
      }
    });

});

$(document).on('keyup','.amount',function(){
    var gender      = $(this).data('gender');
    var id          = $(this).parents('tr').find('.monthwise_amt_id').val();
    var amount      = $(this).val();
    $.ajax ({
      type: "POST",
      url: "Common_Ajax.php",
      data: { Action: 'assumption_malefemale_amount_update',id : id,amount : amount,gender : gender },
      success: function(data){
      }
    });

});

$(document).on('change','.month_act',function(){
    var m_type      = $(this).data('monthtype_act');
    var id          = $(this).parents('tr').find('.monthwise_amt_id_act').val();
    var date        = $(this).val();
    $.ajax ({
      type: "POST",
      url: "Common_Ajax.php",
      data: { Action: 'assumption_malefemale_amount_update_activity',id : id,date : date,month_type : m_type },
      success: function(data){
      }
    });

});

$(document).on('keyup','.amount_act',function(){
    var gender      = $(this).data('gender_act');
    var id          = $(this).parents('tr').find('.monthwise_amt_id_act').val();
    var amount      = $(this).val();
    $.ajax ({
      type: "POST",
      url: "Common_Ajax.php",
      data: { Action: 'assumption_malefemale_amount_update_activity',id : id,amount : amount,gender : gender },
      success: function(data){
      }
    });

});

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script> 
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js"></script>-->


   <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script> 

    </body>
</html>



