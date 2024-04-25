


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




$sql="SELECT COUNT(*) as count FROM BreedingAdmin_Type Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Currentstatus ='1'";
$stmt = sqlsrv_query($conn, $sql);
$Header_data = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);


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

    .toggle-label {
  position: relative;
  display: block;
  width: 300px;
  height: 100px;
  margin-top: 8px;
  border: 1px solid #808080;
margin: 200px auto;
}
.toggle-label input[type=checkbox] { 
  opacity: 0;
  position: absolute;
  width: 100%;
  height: 100%;
}
.toggle-label input[type=checkbox]+.back {
  position: absolute;
  width: 100%;
  height: 100%;
  background: #ed1c24;
  transition: background 150ms linear;  
}
.toggle-label input[type=checkbox]:checked+.back {
  background: #00a651; /*green*/
}

.toggle-label input[type=checkbox]+.back .toggle {
  display: block;
  position: absolute;
  content: ' ';
  background: #fff;
  width: 50%; 
  height: 100%;
  transition: margin 150ms linear;
  border: 1px solid #808080;
  border-radius: 0;
}
.toggle-label input[type=checkbox]:checked+.back .toggle {
  margin-left: 150px;
}
.toggle-label .label {
  display: block;
  position: absolute;
  width: 50%;
  color: #ddd;
  line-height: 80px;
  text-align: center;
  font-size: 2em;
}
.toggle-label .label.on { left: 0px; }
.toggle-label .label.off { right: 0px; }

.toggle-label input[type=checkbox]:checked+.back .label.on {
  color: #fff;
}
.toggle-label input[type=checkbox]+.back .label.off {
  color: #fff;
}
.toggle-label input[type=checkbox]:checked+.back .label.off {
  color: #ddd;
}
.switch3{
  position: relative;
  display: inline-block;
  width: 105px;
  height: 37px;
  border-radius: 37px;
  background-color: #9cedc8;
  cursor: pointer;
  transition: all .3s;
  overflow: hidden;
  box-shadow: 0px 0px 2px rgba(0,0,0, .3);
}
.switch3 input{
  display: none;
}
.switch3 input:checked + div{
  left: calc(99px - 42px);
  box-shadow: 0px 0px 0px white;
}
.switch3 div{
  position: absolute;
  width: 46px;
  height: 27px;
  border-radius: 27px;
  background-color: white;
  top: 5px;
  left: 5px;
  box-shadow: 0px 0px 1px rgb(150,150,150);
  transition: all .3s;
}
.switch3 div:before, .switch3 div:after{
  position: absolute;
  content: 'Entry';
  width: calc(99px - 54px);
  height: 37px;
  line-height: 37px;
  font-family: 'Varela Round';
  font-size: 14px;
  font-weight: bold;
  top: -5px;
}
.switch3 div:before{
  content: 'Report';
  color: rgb(120,120,120);
  left: 100%;
}
.switch3 div:after{
  content: 'Entry';
  right: 100%;
  color: white;
}

.switch3-checked{
  background-color : #e74c3c;
  box-shadow: none;
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

                    

  
<div class="card-body bootstrap-select-1">




                                    <form method="POST"  class="Consumablesallvalues" >


                  <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  

                  <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    


                  <input type="hidden" class="Autonumloc" name="Autonumloc" >   

                  <input type="hidden" class="Autonumid" name="Autonumid" >     




   


                    




                                <h4 class="header-title mt-0">Consumables </h4>

                                 
                                
                                <div class="row  ">
                                    <div class="col-md-2">
                                        <h6 class="input-title mt-0">Location</h6>
                                        <select class="select2 mb-3 select2-single locationvalue" name="location" id="location"   style="width: 100%; height:36px;" >

                                          <option value="">Choose Location</option>

                                           <?php



 $Sql   = "SELECT  DISTINCT BreedingAdmin_Location.BreedingLocation  from BreedingAdmin_Location


LEFT Join BreedingAdmin_Project On BreedingAdmin_Project.Docid=BreedingAdmin_Location.Docid

LEFT JOIN (Select * from BreedingAdmin_Consumables Where Rejectionstatus is NULL)BreedingAdmin_Consumables On BreedingAdmin_Consumables.ConsumLocation=BreedingAdmin_Location.BreedingLocation and BreedingAdmin_Project.Project=BreedingAdmin_Consumables.ConsumProject
where BreedingAdmin_Location.CreatedBy='" . @$_SESSION['EmpID']. "'  and BreedingAdmin_Consumables.ConsumProject is NULL and BreedingAdmin_Consumables.Rejectionstatus is NULL and BreedingAdmin_Location.Currentstatus='2'


";
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
                                        <h6 class="mt-lg-0 input-title">Consumables</h6>

                                        <!-- <select class="select2 mb-3 select2-multiple WorkActivity" name="WorkActivity[]" id="WorkActivity" style="width: 100%" multiple="multiple" data-placeholder="Choose"> -->

                                            <select class="Consumables" name="Consumables[]" id="Consumables" style="width: 100%" multiple="multiple" data-placeholder="Choose">


                                           <?php
                                                                    $Sql   = "Select DISTINCT Material_Description from Farm_Onhand_Stock";
                                                                    $Sql_Connection = sqlsrv_query($conn,$Sql);
                                                                    while($row = sqlsrv_fetch_array($Sql_Connection)){
                                                                    ?>
                                                                    <option value="<?php echo trim($row['Material_Description']); ?>"> <?php echo $row['Material_Description']; ?> </option>
                                                                    <?php } ?>
                                            
                                        </select> 
                                    </div>  








                                     <div class="col-md-4">



                                                                       <button type="button" class="btn btn-primary addbtn" id="addbtn" style="margin-top: 20px;"> Add </button>

                                                                    



                                                                       <!-- <button type="button" class="btn btn-secondary resetbtn" style="margin-top: 20px;"> Reset </button> -->


                                                                         <button type="button" class="btn btn-warning completedrecord" style="margin-top: 20px;"> Completed </button> 

                                                                <!--<div style=" margin-top: -38px;
                                                                margin-left: 229px;">   <label class="switch3 switch3-checked " >
                                                                <input type="checkbox" class="onofbutton" checked />
                                                                <div></div>
                                                                </label> 

                                                                </div>-->




                                     </div>                                             
                                </div>
                            </div>


                           



</form>


  <form method="POST" class="tablewisedataconsumtion">   

                       <div class="row Mainvalueshow">


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Consumables Per Acreage</h4>
                              

                                <div class="table-responsive">


                                  

                            

                                      <table  class="table table-bordered  nowrap consumablesentry" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead  >
                  <tr>                    
                   
                    <th style="font-size: 11px !important;">Location</th>
                    <th style="font-size: 11px !important;"> Project</th>
                    <th style="font-size: 11px !important;"> Consumables</th>

                    <th style="font-size: 11px !important;"><span>Consumables<span><br> Acreage</th>
                        <th>Action</th>
                    


                   



                 
                   
        
                    
                  </tr>
              </thead >


              <tbody class="">


              </tbody>
             
              </table>
                           

                           
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div> <!-- end col -->



                   <!-- <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">UOM</h4>
                              

                                <div class="table-responsive">


                                  

                            

                                      <table  class="table table-bordered  nowrap consumablesentryuom" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead  >
                  <tr>                    
                   
                    <th style="font-size: 11px !important;">Consumables</th>
                   
                    <th style="font-size: 11px !important;"> Rate Per UOM</th>
                    


                   



                 
                   
        
                    
                  </tr>
              </thead >


              <tbody class="">


              </tbody>
             
              </table>
                           

                           
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div> -->

                  




 
 
                    



                </div> <!-- end row -->




                 <div class="row hiddenalueshow">


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Consumables Per Acreage</h4>
                              

                                <div class="table-responsive">


                                  

                            

                                      <table  class="table table-bordered  nowrap consumablesreport" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead  >
                  <tr>                    
                   
                    <th style="font-size: 11px !important;">Location</th>
                    <th style="font-size: 11px !important;"> Project</th>
                    <th style="font-size: 11px !important;"> Consumables</th>

                    <th style="font-size: 11px !important;"><span>Consumables<span><br> Acreage</th>
                    <th style="font-size: 11px !important;"> Acreage</th>
                    <th style="font-size: 11px !important;"> Total</th>
                    <th style="font-size: 11px !important;"> Action</th>


                    


                   



                 
                   
        
                    
                  </tr>
              </thead >


              <tbody class="">


              </tbody>
             
              </table>
                           

                           
                                   
                                </div>
                                
                            </div>
                        </div>
                    </div> <!-- end col -->




                  




 
  
                    



                </div> <!-- end row -->









 
</form>



 <div align="center" class="Mainvalueshowbutton">
                    <button type="button" class="btn btn-sm btn-success finalassumptionsubmit">Submit</button>



                    <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>

                    </div>







                                    <!-- Modal -->


                
 <div class="modal" id="monthwisedetails" role="dialog">


    <form method="POST" class="monthwisedetails">

        <div class="modal-dialog modal-lg" style="max-width: 1200px !important">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-bs-dismiss='modal'>&times;</button>
              <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 465px;">Consumables(Month Wise)</h6> 
          </div>
          <div class="Conformation-body">






          </div>

      </div>
  </div>

</form>


</div>




                        </div>                                
                    </div> <!-- end col -->
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

                                
                              

                                <!-- Nav tabs -->
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">CONSUMABLES PER ACREAGE</a>
                                    </li>
                                  
                                  
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                                   


                                    <div class="table-responsive">


                                  

                            

                                      <table  class="table table-bordered  nowrap consumablesentry_confirm" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead  >
                  <tr>                    
                   
                    <th style="font-size: 11px !important;">Location</th>
                    <th style="font-size: 11px !important;"> Project</th>
                    <th style="font-size: 11px !important;"> Consumables</th>

                    <th style="font-size: 11px !important;"><span>Consumables<span><br> Acreage</th>
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















                    
                        <!-- end row -->
        
                        <!-- end row -->
        
                   
                        <!-- end row -->

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

 let Uset_Input=$(".Consumablesallvalues").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"Consumablesallvalues"});
    
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


  
   Consumbaleslocationwisetable("yes",user_input);
   Consumbaleslocationwisetableuom("yes",user_input);

       


       window.location.href ='Consumables.php';


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









function Consumbaleslocationwisetable(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='consumablesentry'
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
      "data": {Action:"consumablesentry"}
    }
  });
}








function Consumbaleslocationwisereporttable(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='consumablesreport'
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
      "data": {Action:"consumablesreport"}
    }
  });
}




function Consumbaleslocationwisetableuom(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='consumablesentryuom'
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
      "data": {Action:"consumablesentryuom"}
    }
  });
}





function Consumbaleslocationwisetable_confirm(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='consumablesentry_confirm'
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
      "data": {Action:"consumablesentry_confirm"}
    }
  });
}



function Consumbaleslocationwisetableuom_confirm(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='consumablesentryuom_confirm'
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
      "data": {Action:"consumablesentryuom_confirm"}
    }
  });
}


  $(document).ready(function(){
     $('.js-example-basic-single').select2();


  


   var user_input={};

  
   Consumbaleslocationwisetable("no",user_input);

    Consumbaleslocationwisetableuom("yes",user_input);
     
 //Consumbaleslocationwisereporttable("yes",user_input);


  });

var rowdloa=2;





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


 let Uset_Input=$(".tablewisedataconsumtion").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"tablewisedataconsumtion"});
    
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


          window.location.href ='Consumables.php';
  

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






       


$(document).on("click",".finalassumptionsubmit",function(){


    

 let Uset_Input=$(".tablewisedataconsumtion").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"tablewisedataconsumtion"});
    
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


            $(".close").trigger('click'); 


        var Autoincnum=$(".Autonumloc").val();
      var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
   var user_input={};


 user_input.Autoincnum=Autoincnum;
 user_input.autoid=autoid;
  
  Consumbaleslocationwisetable("yes",user_input);

   Consumbaleslocationwisetableuom("yes",user_input);

       


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




$(document).on("click", ".completedrecord", function (){

    

    $("#Completedrecordpopup").modal('show');
var user_input={};


 user_input.Autoincnum=Autoincnum;
 user_input.autoid=autoid;
  
  //Consumbaleslocationwisetable("yes",user_input);

  /// Consumbaleslocationwisetableuom("yes",user_input);



     Consumbaleslocationwisetable_confirm("yes",user_input);

    //Consumbaleslocationwisetableuom_confirm("yes",user_input);



    });


$(document).on("click", ".labourratedesign", function (){

    

    ///$("#Completedrecordpopup").modal('show');
var user_input={};


 user_input.Autoincnum=Autoincnum;
 user_input.autoid=autoid;
  
 

///Consumbaleslocationwisetableuom_confirm("yes",user_input);

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





$(document).on("keyup", ".acraege,.UOM", function (){

var Total=0;
var acraegeval=parseFloat($(this).closest('tr').find('.acraege').val(),10);

if (isNaN(acraegeval) ) {
var acraegeval=0;
}
var UOMval=parseFloat($(this).closest('tr').find('.UOM').val(),10);

if (isNaN(UOMval) ) {
var UOMval=0;
}
var amt=(acraegeval)+(UOMval);



 $(this).closest('tr').find('.totalconsum').empty();
 $(this).closest('tr').find('.totalconsum').append(amt);

$(this).closest('tr').find('.appendtotalvalue').val(amt);


     });





$('.switch3 input').on('change', function(){
  var dad = $(this).parent();
  if($(this).is(':checked')){




    dad.addClass('switch3-checked');

$(".Mainvalueshow").css("display","flex");
$(".Mainvalueshowbutton").css("display","block");
$(".hiddenalueshow").css("display","none");

    }else{
    dad.removeClass('switch3-checked');

$(".hiddenalueshow").css("display","flex");
$(".Mainvalueshow").css("display","none");
$(".Mainvalueshowbutton").css("display","none");


   var user_input={};
Consumbaleslocationwisereporttable("yes",user_input);



}


//$(".Mainvalueshow").("display","block");
});



$('.onofbutton').on('change', function(){
  //alert("Hai");

  //var content=$(".switch3").css( "content" );
///alert(content);

});


  $(document).ready(function(){

$(".hiddenalueshow").css("display","none");

});







    $(document).on("click", ".Add_Consmables_monthwise", function (){

   // $("#monthwisedetails").modal('show'); 
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
       
        action_type:"monthwiseconsumbales"
    },
    success: function (output) {
      var rowdata = JSON.parse(output);
      $("#monthwisedetails").modal('show');
      $(".Conformation-body").html(rowdata);

      //$(".Total_acrage").val(passing_total_acrage);
  }
});




});



$(document).on("click",".Savemonthvalue",function(){




   let Uset_Input=$(".monthwisedetails").serializeArray();

   Uset_Input.push({"name":"Action","value":"monthwisestoreconsumables"});

   $.ajax 
   ({
      type: "POST",
      url: "Common_Ajax.php",
      data:Uset_Input,
       async:false,//
       success: function(data){

           result=JSON.parse(data);

           if(result.Status == 1){


            Alert_Msg("Added Month Wise.","success");


            $(".close").trigger('click'); 


            var Autoincnum=$(".Autonumloc").val();
            var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            //LocationwiseprojectDetails("yes",user_input);


            return false;
        }else if(result.Status == 2){


            Alert_Msg("Updated Month Wise.","success");


            $(".close").trigger('click'); 



            return false;
        }


        else{

           // alert("Wrong");
         Alert_Msg("Something Went Wrong.","error");
         return false;
     }
 }
});

   return false;

});








  $(document).ready(function(){

   //$('.btn.btn-default.multiselect-clear-filter').css('display', 'none');

     $('.locbaseprojectvalue').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
         enableCaseInsensitiveFiltering: true,
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



      $('.Consumables').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
         enableCaseInsensitiveFiltering: true,
        maxHeight: 250,
          buttonWidth: 150,
        buttonText: function(options, select) {
            if (options.length === 0) {
                return 'Select Consumables';
            } else {
                return options.length + ' selected';
            }
        }
    });


     $('.js-example-basic-single').select2();


  


   var user_input={};

  
     /// assumptionwiseprojectDetails("no",user_input);
     // assumptionwiseprojectDetails_month_amount("no",user_input);



     // Handle change event on .locationvalue
    $(document).on("change", ".locationvalue", function() {
        var locbaseproject = $(this).val();

        // Make AJAX request to fetch updated options
        $.ajax({
            type: "POST",
            url: "AutoFill_Details.php",
            data: {
                "Action": "Get_Location_Based_Project_Consumables",
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


$(document).on("click",".deletebutton",function(){


  var passing_id=$(this).parents('tr').find(".ConsumId").val();
  


  
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
   
    action_type:"deleterowwisedata_consumables"
},
success: function (output) {
  var rowdata = JSON.parse(output);

  if(rowdata==1){



      Alert_Msg("Deleted.","success");

window.location.href ='Consumables.php';
      var Autoincnum=$(".Autonumloc").val();
      var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
      var user_input={};


      user_input.Autoincnum=Autoincnum;
      user_input.autoid=autoid;

     // LocationwiseprojectDetails("yes",user_input);
///LocationwiscompletedeprojectDetails("yes",user_input);





  }else{


   Alert_Msg("Something Went Wrong.","error");
   return false;




}

}
});





});






$(document).on("change",".acraege",function(){


  var passing_id=$(this).parents('tr').find(".type_id").val();
  var acraege=$(this).parents('tr').find(".acraege").val();
  


  
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
    acraege: acraege,
   
    action_type:"save_consumablesdata"
},
success: function (output) {
  var rowdata = JSON.parse(output);

  if(rowdata==1){



     // Alert_Msg("Added.","success");





  }else{


   Alert_Msg("Something Went Wrong.","error");
   return false;




}

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



