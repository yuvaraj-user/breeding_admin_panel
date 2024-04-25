


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
.dt-buttons{

  display: none;
}

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
    }.dt-buttons{
        display: none;
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

}.dt-buttons{

  display: none;
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

<style>

.vijaylogo {
    height: 51px !important;
 
}
#ajax_loader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #f5f5f5;
    z-index: 9999999;
    opacity: 0.8;
}
  </style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">


<div id="ajax_loader" style="display: none;"><div id="status"><div class="spinner"></div></div></div>


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




                                    <form method="POST"  class="Assumptionwisemalefemale" >


                  <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  

                  <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    


                  <input type="hidden" class="Autonumloc" name="Autonumloc" >   

                  <input type="hidden" class="Autonumid" name="Autonumid" >     




   


                    




                                <h4 class="header-title mt-0">Labour Count  </h4>

                                 
                                
                                <div class="row">
                                    <div class="col-md-2">
                                        <h6 class="input-title mt-0">Location</h6>
                                        <select class="select2 mb-3 select2-single locationvalue" name="location" id="location"   style="width: 100%; height:36px;" >

                                          <option value="">Choose Location</option>

                                           <?php



 $Sql   = "SELECT  DISTINCT BreedingAdmin_Location.BreedingLocation   from BreedingAdmin_Location

LEFT Join BreedingAdmin_Project On BreedingAdmin_Project.Docid=BreedingAdmin_Location.Docid



Left Join BreedingAdmin_Assumption On BreedingAdmin_Assumption.AssumProject=BreedingAdmin_Project.Project  and BreedingAdmin_Location.BreedingLocation=BreedingAdmin_Assumption.AssumLocation


where BreedingAdmin_Location.CreatedBy='" . @$_SESSION['EmpID']. "'  and BreedingAdmin_Assumption.AssumProject is NULL and BreedingAdmin_project.Rejectionstatus is NULL";
                                                                    $Sql_Connection = sqlsrv_query($conn,$Sql);
                                                                    while($row = sqlsrv_fetch_array($Sql_Connection)){
                                                                    ?>

                                                                      
                                                                    <option value="<?php echo trim($row['BreedingLocation']); ?>"> <?php echo $row['BreedingLocation']; ?> </option>
                                                                    <?php } ?>
                                            
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <h6 class="mt-lg-0 input-title">Project</h6>

                                        <!-- <select class="select2 mb-3 select2-multiple locbaseprojectvalue" name="project[]" id="project" style="width: 100%" multiple="multiple" data-placeholder="Choose"> -->

                                            <select class="locbaseprojectvalue" name="project[]" id="project" style="width: 100%" multiple="multiple" data-placeholder="Choose">

                                            <?php
                                                                    $Sql   = "SELECT  DISTINCT BPM.internal_Order_Description FROM Budget_project_Master AS BPM";
                                                                    $Sql_Connection = sqlsrv_query($conn,$Sql);
                                                                    while($row = sqlsrv_fetch_array($Sql_Connection)){
                                                                    ?>
                                                                    <option value="<?php echo trim($row['internal_Order_Description']); ?>"> <?php echo $row['internal_Order_Description']; ?> </option>
                                                                    <?php } ?>
                                            
                                        </select> 
                                    </div>   



                                      <div class="col-md-2">
                                        <h6 class="mt-lg-0 input-title">Activity</h6>

                                        <!-- <select class="select2 mb-3 select2-multiple WorkActivity" name="WorkActivity[]" id="WorkActivity" style="width: 100%" multiple="multiple" data-placeholder="Choose"> -->

                                            <select class="WorkActivity" name="WorkActivity[]" id="WorkActivity" style="width: 100%" multiple="multiple" data-placeholder="Choose">


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



                                                                       <button type="button" class="btn btn-primary addbtn" id="addbtn" style="margin-top: 20px;"> Single </button>

                                                                       <button type="button" class="btn btn-info singleseletion" id="singleseletion" style="margin-top: 20px;"> Bulk </button>



                                                                        <!--<button type="button" class="btn btn-secondary resetbtn" style="margin-top: 20px;"> Reset </button> -->


                                                                         <button type="button" class="btn btn-warning completedrecord" style="margin-top: 20px;"> Completed </button>  




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



                     <button type='button' class='btn btn-default closebutton' data-bs-dismiss='modal'>Close</button>

                    </div>
                                                
                                            </form>
                                        </div>


                                        <div>
                                                        <br><br>

                                                    </div>
                                   

            </div>
        </div>

      </div>
    </div>

  </form>


  </div>



  <form method="POST" class="tablewisedataassumption">   

                       <div class="row">


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title ml-5">Mandays Per Acre</h4>
                              

                                <div class="table-responsive">


                                  

                            

                                      <table  class="table table-bordered  nowrap assumptionwise" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                
                            </div>
                        </div>
                    </div> <!-- end col -->

                  





<!--   <div class="col-lg-5">
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
                    </div> --> <!-- end col -->
                    



                </div>



 
</form>






                 <div align="center">
                    <button type="button" class="btn btn-sm btn-success finalassumptionsubmit">Submit</button>



                    <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>

                    </div>


                        </div>                                
                    </div>
                </div> <!-- end row --> 

         






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

                                
                              

                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">MANDAYS PER ACRE</a>
                                    </li>
                                  <!--   <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link labourratedesign" data-toggle="tab" href="#profile-1" role="tab">LABOUR RATE PER MONTH</a>
                                    </li> -->
                                  
                                </ul>

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



                    <button type="button" class="btn btn-sm btn-danger " data-bs-dismiss='modal'>Cancel</button>

                  

                    </div>
        </div>

      </div>
    </div>

  </form>


  </div>   


                    


                    </div>    
                </div>

            </div>
                <!-- End Page-content -->

                
                
               <?php include "footer.php"; ?>
            </div>
            <!-- end main content-->

        </div>

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

        <script src="assets/libs/select2/js/select2.min.js"></script>
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



        $(document).on("click",".addbtn",function(){

//alert("Hai");

//return false;


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
         // return false;

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

       // assumptionwiseprojectDetails_month_amount("yes",user_input);


       window.location.href ='Assumptions.php';


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





function assumptionwiseprojectDetails(destroy_status,user_input)
{

Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='assumptionwise'
   if(destroy_status == "yes")
  {
    $('.'+data_table).DataTable().destroy();
  }
 var table = $('.' + data_table).DataTable({

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
      "data": {Action:"AssumptionEnrty"}         
    }
  });

}



function assumptionwiseprojectDetails_month_amount(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

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
      "data": {Action:"AssumptionEnrty_malefemaleamount"}
    }
  });
}




  $(document).ready(function(){

   //$('.btn.btn-default.multiselect-clear-filter').css('display', 'none');

     $('.locbaseprojectvalue').multiselect({
        includeSelectAllOption: true,
         enableCaseInsensitiveFiltering: true,
        enableFiltering: true,
         maxHeight: 250,
          buttonWidth: 150,
        buttonText: function(options, select) {
            if (options.length === 0) {
                return 'Select Projects';
            } else {
                return options.length + ' selected';
            }
        }
    });

     $('.WorkActivity').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
         enableCaseInsensitiveFiltering: true,
        maxHeight: 250,
          buttonWidth: 150,
        buttonText: function(options, select) {
            if (options.length === 0) {
                return 'Select Activity';
            } else {
                return options.length + ' selected';
            }
        }
    });

     $('.js-example-basic-single').select2();


  


   var user_input={};

  
      assumptionwiseprojectDetails("no",user_input);
     // assumptionwiseprojectDetails_month_amount("no",user_input);



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


          window.location.href ='Assumptions.php';
  

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






        $(document).on("click",".savemalefemale",function(){

//alert("Hai");

//return false;


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
         // return false;

 let Uset_Input=$(".Assumptionwisemalefemale").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"singlemalefemale"});
    
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

   $(".closebutton").trigger("click");
  
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


$(document).on("click",".finalassumptionsubmit",function(){
    $('#ajax_loader').show();
   $('.assumptionwise').DataTable().page.len(50000).draw();
   // $('.assumptionwise_Amount').DataTable().page.len(50000).draw();
   
   var table = $('.assumptionwise').DataTable();
   // var table1 = $('.assumptionwise_Amount').DataTable();
   table.on('draw.dt', function () {
    // table1.on('draw.dt', function () {
       let Uset_Input=$(".tablewisedataassumption").serializeArray();

       Uset_Input.push({"name":"Action","value":"finalassumptiondata"});
       assumption_submit(Uset_Input);
   // });
  

});
    

});



$(document).on("click",".finalsubmittioncompleted",function(){
   $('#ajax_loader').show();
   $('.assumptionwisecompleted').DataTable().page.len(50000).draw();
   
   var table = $('.assumptionwisecompleted').DataTable();
   table.on('draw.dt', function () {
       let Uset_Input=$(".Completedrecordpopup").serializeArray();
       Uset_Input.push({"name":"Action","value":"finalassumptiondata"});
       assumption_submit(Uset_Input);

});
    

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
            window.location.href ='Assumptions.php';
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            assumptionwiseprojectDetails("yes",user_input);

            // assumptionwiseprojectDetails_month_amount("yes",user_input);


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



