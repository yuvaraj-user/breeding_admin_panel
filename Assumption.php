<?php
include "Header.php";


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

  <link rel="stylesheet" href="../assets/vendors/select2/select2.min.css" />
    <link rel="stylesheet" href="../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />



  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

   

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">               

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
  font-size: 28px;
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
  }.btn-default{
  background-color: #bb0e0e;
  color: white;
}input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}input[type=number] {
  width: 100%;

  box-sizing: border-box;
  border: 3px solid #94d18c;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}.card .card-body {
    padding: 30px 15px !important;
}

</style>

<script>
function Alert_Msg(Msg,Type){
    swal({
  title: Msg,
  icon: Type,
});
}

</script>


  <body>
    <div class="container-scroller">
  
      <!-- Top Side Menu Bar -->
    <?php include "topsidemenu.php";?>
      <!-- Body Content -->

      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">


    
          <div class="content-wrapper pb-0">
           
          
            <div class="row">

                      <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                  <div class="card-body">

                    
                     <form method="POST"  class="Assumptionwisemalefemale" >



                  <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  

                  <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    


                  <input type="hidden" class="Autonumloc" name="Autonumloc" >   

                  <input type="hidden" class="Autonumid" name="Autonumid" >     



                        <div class="col-xl-12 col-lg-12 col-md-12  DistDetails_Hide">
                                                    <div class="card">
                                                        <div class="card-header bg-secondary text-white header-elements-inline">
                                                            <div class="card-title" style="text-align: center;">ASSUMPTIONS  - FARM LABOUR<span></div>

                                                            
                                                        </div>
                                                        <div class="card-body">
                                                             <div class="col-md-5">
                         <!-- <div class="form-group row">
                            
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="breedingloc" id="check"  value="breeding"  /> Breeding Location </label>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="breedingloc" id="check"  value="trail" /> Trial Location </label>
                              </div>
                            </div>


             


                          </div>-->
                        </div>
                                                            <div class="row">
                                                             
                                                                <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                                    <label>Location </label>
                                                                    <select class="js-example-basic-single locationvalue"  name="location" id="location" style="width: 100%;">

                                                                      <option value="">select</option>
                                                                    <?php
                                                                    $Sql   = "SELECT  DISTINCT BreedingLocation from BreedingAdmin_Location where CreatedBy='" . @$_SESSION['EmpID']. "'";
                                                                    $Sql_Connection = sqlsrv_query($conn,$Sql);
                                                                    while($row = sqlsrv_fetch_array($Sql_Connection)){
                                                                    ?>
                                                                    <option value="<?php echo trim($row['BreedingLocation']); ?>"> <?php echo $row['BreedingLocation']; ?> </option>
                                                                    <?php } ?>
                                                                    </select>                             
                                                                </div>
                                                                <div class="form-group col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                                    <label>Project </label>
                                                                    <select class="js-example-basic-multiple locbaseprojectvalue" multiple="multiple" name="project[]" id="project" style="width: 100%;">
                                                                   
                                                                    </select>                             
                                                                </div>

                                                                <div class="form-group col-xl-2 col-lg-2 col-md-4 col-sm-12">

                                                                  
                                                                       <button type="button" class="btn btn-primary addbtn" style="margin-top: 20px;"> Add </button>


               <!-- <button type="button" class="add_value_click btn btn-primary FinishedMaterialChecking" style="margin-top: 20px;" onclick="return addRow();">Add</button>-->

                                                                        <button type="button" class="btn btn-secondary resetbtn" style="margin-top: 20px;"> Reset </button>                           
                                                                </div>


                                                                  </div>
               


                                                               
                                                            
                                                            </div>
                                                        </div>
                                                    </div>


 </form>

                                                    <div class="col-xl-12 col-lg-12 col-md-12  projectwisehide" >
                                                    <div class="card">
                                                        <div class="card-header bg-secondary text-white header-elements-inline">
                                                            <div class="card-title" style="text-align: center;">ASSUMPTIONS - FARM LABOUR </div>
                                                        </div>

                                                        <br>
                                                   
          <div class="row">                                                   
                                                          
  <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Male Femal Count Project Wise</h4>


                  <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="assumptionwise" style='border: 1px solid rgb(187 187 187)' data-loaded='no'>
              <thead class="" >
                  <tr>                    
                   
                    <th style="font-size: 13px !important;">Location</th>
                    <th style="font-size: 13px !important;"> Project</th>
                    <th style="font-size: 13px !important;"> Activity</th>

                    <th style="font-size: 13px !important;"> Male</th>
                    <th style="font-size: 13px !important;"> Female</th>

                   



                 
                   
        
                    
                  </tr>
              </thead >


              <tbody class="OpenBidding">


              </tbody>
             
              </table>


                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="font-size: 14px;">Male Female Labour Amount in Month Wise</h4><br>

                    <div id="loadingpoints" >
                   
                            <div class="form-group">
                        <label for="exampleInputUsername1">Location</label>
                        <input type="text"  id="Locationamount" style="width: 120px!important;" />

                        <label for="exampleInputUsername1">From</label>
                      
                        <input type="month" id="locationmonthfrom" name="locationmonthfrom" style="width: 120px!important;">

                          <label for="exampleInputUsername1">To</label>
                      
                        <input type="month" id="locationmonthfrom" name="locationmonthfrom" style="width: 120px!important;">
                        
                      </div>




                     



                      <div class="form-group">
                        <label for="exampleInputUsername1">Male</label>
                        <input type="text"  id="Locationamount"   style="width: 134px!important;">

                        <label for="exampleInputUsername1">Female</label>
                        <input type="text"  id="Locationamount"  style="width: 160px!important;">

                            <button type="button" onclick ='add_row_loading()' class="btn-sm btn-success" style="height:;">ADD</button>
                      </div>

                    </div>


                  
                  </div>
                </div>
              </div>

            </div>
<!--
                 <div class="panel-body ReportTablediv" id="ReportTablediv">
    <div class="tab-content">
        <div class="tab-pane restabpanel active" id="DivisionRes"  role="tabpanel">
          <div class="row">
 
</div>
          <div class="row">

          
 

              <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="locationwise" style='border: 1px solid rgb(187 187 187)' data-loaded='no'>
              <thead class="head_font_size">
                  <tr>                    
                    <th>S.No</th>
                    <th>Location</th>
                    <th>Project</th>
                    <th> Type</th>
                    <th>Acrage</th>       
                    <th>Sowing and <br> Harvesting<br>(Month Wise)</th>
                    <th>Land Block<br> Selection</th>
                    <th>Responsible<br>Person</th>



                 
                   
        
                    
                  </tr>
              </thead >


              <tbody class="OpenBidding">


              </tbody>
             
              </table>
            </div>
            </div>
           </div>
         </div>-->





                                    <!-- Modal -->
     <!-- <div class="modal" id="monthwisedetails" role="dialog">


    <form method="POST" class="monthwisedetails">

    <div class="modal-dialog modal-lg" style="max-width: 1200px !important">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss='modal'>&times;</button>
          <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 465px;">Sowing and  Harvesting(Month Wise)</h6> 
        </div>
        <div class="Conformation-body">
        </div>

      </div>
    </div>

  </form>


  </div>-->


              


           


                                                               
                                                            
                                                          
                                                        </div>
                                                    </div>




                                                </div>
                     


                        



                                                

                        
                     



                    
                   
                    
                     
                      
                    
                   
                  </div>
                </div>
              </div>
             
            
            </div>
       
         
          </div>
         
     

           <?php include "Footer.php"; ?>

   </div>

 </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.stack.js"></script>
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>

  
    <script src="../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../../assets/js/file-upload.js"></script>
    <script src="../../assets/js/typeahead.js"></script>
   
    <!-- End custom js for this page -->



    <script>



        $(document).on("click",".addbtn",function(){

//alert("Hai");

//return false;




           // var breedingtype=$("#check").val();


         

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








$(document).on("change",".locationvalue",function(){
    ///$(this).closest("tr").find(".QtyInBag").removeAttr("readonly");
    var locbaseproject=$(this).val();
    //var curren_tr=$(this).closest("tr");
     $.ajax 
      ({
      type: "POST",
      url: "AutoFill_Details.php",
      data:{"Action":"Get_Location_Based_Project","locbaseproject":locbaseproject},
       async:false,
     

       success: function(html){

          $(".locbaseprojectvalue").html(html);
        
        }


    });
   });









function assumptionwiseprojectDetails(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='assumptionwise'
   if(destroy_status == "yes")
  {
    $('#'+data_table).DataTable().destroy();
  }
 $('#' + data_table).DataTable({

    "dom": 'Bfrtip',

 
  
  //"columnDefs": [{ "className":"y desine", "targets": [1,2,3,4,5] }],
    "scrollX": true,
   // "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
    "bprocessing": true,
    "serverSide": true,
    "pageLength": 5,
      "searching": false,
    "ajax": 
    {
      "url": "Common_Ajax.php", 
      "type": "POST",
      "data": {Action:"AssumptionEnrty"}
    },drawCallback: function() {
     $('.dt-select2').select2();
  }
  });
}





  $(document).ready(function(){
     $('.js-example-basic-single').select2();


  


   var user_input={};

  
   assumptionwiseprojectDetails("no",user_input);



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


    </script>

<script src="../assets/vendors/select2/select2.min.js"></script>
 <script src="../assets/js/select2.js"></script>

     <script src="../../global/vendor/datatables.net/jquery.dataTablesfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-bs4/dataTables.bootstrap4fd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-rowgroup/dataTables.rowGroup.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-scroller/dataTables.scroller.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-responsive/dataTables.responsive.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-buttons/dataTables.buttons.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-buttons/buttons.html5.minfd53.js?v4.0.1"></script>
  <!-- <script src="../../global/vendor/datatables.net-buttons/buttons.flash.minfd53.js?v4.0.1"></script> -->
  <script src="../../global/vendor/datatables.net-buttons/buttons.print.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-buttons/buttons.colVis.minfd53.js?v4.0.1"></script>
  <script src="../../global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.minfd53.js?v4.0.1"></script>

  <script src="../../global/js/Plugin/datatables.minfd53.js?v4.0.1"></script>
<script src="../../assets/js/menu.js?v4.0.1"></script>

<script src="../../common/checkSession.js"></script>



  </body>
</html>