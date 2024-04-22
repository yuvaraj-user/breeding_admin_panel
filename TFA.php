

<?php include "Header.php"; 

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




  /*$sql="SELECT COUNT(*) as count FROM BreedingAdmin_Type Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Currentstatus ='1'";
$stmt = sqlsrv_query($conn, $sql);
   $Header_data = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

*/



   ?>

   <link rel="stylesheet"
   href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.min.css">
   <link rel="stylesheet"
   href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css">


   <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <link href="assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />

   <!-- DataTables -->
   <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
   <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
   <!-- Responsive datatable examples -->
   <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


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
}.btn-default{
  background-color: #bb0e0e;
  color: white;
}input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  margin: 0; 
}table tr{

  color: black;
}.fontdesign{

  font-size: 9px !important;
}.swal-text {
  font-size: 13px !important;

}table td{
  font-size: 10px;
}table th{
  font-size: 11px;
}.nav {
  display: -ms-flexbox;
  display: contents !important;
  -ms-flex-wrap: wrap;
  flex-wrap: nowrap;
  padding-left: 0;
  margin-bottom: 0;
  list-style: none;
  flex-direction: column;
}

#select2-location-container {
  margin-top: 6px;
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

<!-- Modal -->
<div class="modal fade" id="labour_rate_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 2000;">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 1200px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 465px;">Labour Rate(Month Wise)</h6>
      </div>
      <div class="modal-body" id="labour_rate_modal_body">

      </div>
      <div class="modal-footer">
       <button type='button'  class='btn  btn-success tfa_month_det_save Addmonthvaue'>Add</button>
       <button type='button' class='btn btn-default close' data-dismiss='modal'>Close</button>
     </div>
   </div>
 </div>
</div>


<!-- Modal -->
<div class="modal fade" id="Completedrecordpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 1200px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 465px;">Completed Data</h6>
      </div>
      <div class="modal-body">
       <form method="POST" class="Completed_TFA_tablewisedata">   
         <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">

                <h4 class="mt-0 header-title ml-5">Labour rate</h4>

                <div class="table-responsive">
                  <table class="table table-bordered" id="TFA_completed_table" style="border-collapse: collapse; border-spacing: 0; width: 100%!important;">
                    <thead >
                      <tr>                    
                        <th style="font-size: 11px !important;">S.No</th>
                        <th style="font-size: 11px !important;">Location</th>
                        <th style="font-size: 11px !important;">Name</th>
                        <th style="font-size: 11px !important;">No of persons</th>
                        <th style="font-size: 11px !important;">Labour Rate</th>
                      </tr>
                    </thead >


                    <tbody class="Completed_TFA_tablewisedata_body">


                    </tbody>

                  </table>
                </div>

              </div>
            </div>
          </div> <!-- end col -->

        </div> <!-- end row -->
      </form>
      </div>
   </div>
 </div>
</div>



<div class="wrapper">
  <div class="container-fluid">

    <!-- Page-Title -->


    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <div class="float-right hide-phone">
            <ul class="list-inline">


            </ul>                                
          </div>

          <div class="btn-group mt-2">
            <ol class="breadcrumb hide-phone p-0 m-0">
              <li class="breadcrumb-item"><a href="#">Breeding</a></li>
              <li class="breadcrumb-item active">TFA/PCL</li>
            </ol>
          </div>

        </div>
      </div>
    </div>



    <!-- end page title end breadcrumb -->



    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body bootstrap-select-1">

            <form method="POST"  class="TFA_add_form" >  

              <!-- <h4 class="header-title mt-0">Activity Wise  </h4> -->


              <div class="row">
                <div class="col-md-4">
                  <h6 class="input-title mt-0">Location</h6>
                  <select class="select2 mb-3" name="location" id="location" style="width: 100%; height:36px;" data-placeholder="Choose">
                    <option value="">Choose Loaction</option>

                    <?php
                    $Sql   = "SELECT Distinct Territory from Budget_CostCenter_Mapping_Finance where Territory!='-'";
                    $Sql_Connection = sqlsrv_query($conn,$Sql);
                    while($row = sqlsrv_fetch_array($Sql_Connection)){
                      ?>
                      <option value="<?php echo trim($row['Territory']); ?>"> <?php echo $row['Territory']; ?> </option>
                    <?php } ?>

                  </select>
                </div>     

                <div class="row">
                  <div class="col-md-12">
                    <h6 class="input-title mt-0">Name</h6>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" autocomplete="off">
                  </div>
                </div>     

                <div class="row ml-1">
                  <div class="col-md-12">
                    <h6 class="input-title mt-0">No of Persons</h6>
                    <input type="number" class="form-control" name="no_of_persons" id="no_of_persons" placeholder="Enter no of persons">
                  </div>
                </div>                             


                <div class="col-md-4">



                 <button type="button" class="btn btn-primary addbtn" id="addbtn" style="margin-top: 20px;"> Add </button>

                 <!-- <button type="button" class="btn btn-info singleseletion" id="singleseletion" style="margin-top: 20px;"> Single </button> -->



                 <button type="reset" class="btn btn-secondary resetbtn" style="margin-top: 20px;"> Reset </button> 


                 <button type="button" class="btn btn-danger completedrecord" style="margin-top: 20px;"> Completed </button>  



               </form>
             </div>                                             
           </div>
         </div>
       </div>



       <form method="POST" class="TFA_tablewisedata">   

         <div class="row">


          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">

                <h4 class="mt-0 header-title ml-5">Labour rate</h4>


                <div class="table-responsive">
                  <table class="table table-bordered nowrap" id="TFA_labour_rate_tbl" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead >
                      <tr>                    
                        <th style="font-size: 11px !important;">S.No</th>
                        <th style="font-size: 11px !important;">Location</th>
                        <th style="font-size: 11px !important;">Name</th>
                        <th style="font-size: 11px !important;">No of persons</th>
                        <th style="font-size: 11px !important;">Labour Rate</th>
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


      <div align="center">
        <button type="button" class="btn btn-sm btn-success finalassumptionsubmit">Submit</button>
        <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>
      </div>


    </div>                                
  </div> <!-- end col -->
</div> <!-- end row --> 





</div> <!-- end container -->
</div>



<!-- end wrapper -->







<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>

<!-- KNOB JS -->
<script src="assets/plugins/jquery-knob/excanvas.js"></script>
<script src="assets/plugins/jquery-knob/jquery.knob.js"></script> 

<!-- Plugins js -->
<script src="assets/plugins/timepicker/moment.js"></script>
<script src="assets/plugins/timepicker/tempusdominus-bootstrap-4.js"></script>
<script src="assets/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
<script src="assets/plugins/clockpicker/jquery-clockpicker.min.js"></script>
<script src="assets/plugins/colorpicker/jquery-asColor.js"></script>
<script src="assets/plugins/colorpicker/jquery-asGradient.js"></script>
<script src="assets/plugins/colorpicker/jquery-asColorPicker.min.js"></script>
<script src="assets/plugins/select2/select2.min.js"></script>

<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>


<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>
<script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Plugins Init js -->
<script src="assets/pages/form-advanced.js"></script> 

<!-- App js -->
<script src="assets/js/app.js"></script>

<script src="../../../common/checkSession.js"></script>

<!-- Required datatable js -->




<script>



  $(document).on("click",".addbtn",function(){

    var locationvalue=$("#location").val();

    var name=$("#name").val();

    var no_of_persons=$("#no_of_persons").val();

    if(locationvalue ==''){

     Alert_Msg("Please Select Location.","warning");
     return false;
   }

   if(name ==''){

     Alert_Msg("Please enter name.","warning");
     return false;
   }
   if(no_of_persons ==''){

     Alert_Msg("Please enter no of persons.","warning");
     return false;
   }

   let Uset_Input=$(".TFA_add_form").serializeArray();

   Uset_Input.push({"name":"Action","value":"Add_TFA"});

   $.ajax 
   ({
    type: "POST",
    url: "Common_Ajax.php",
    data:Uset_Input,
       async:false,//
       success: function(data){


         result=JSON.parse(data);
         
         if(result.Status == 1){


          Alert_Msg("Added.","success");

          var user_input={};

          Get_TFA_Details("yes");

          window.location.href ='TFA.php';

        }else{
         Alert_Msg("Something Went Wrong.","error");
         return false;
       }
     }
   });

   return false;
 });



  function Get_TFA_Details(destroy_status)
  {

    // Autoincnum=user_input.Autoincnum;
    // autoid=user_input.autoid;

    var data_table='TFA_labour_rate_tbl'
    if(destroy_status == "yes")
    {
      $('#'+data_table).DataTable().destroy();
    }
    var table = $('#'+data_table).DataTable({

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
        "data": {Action:"Get_TFA_Details"}         
      }
    });

  }


  $(document).on('click','.labour_rate_add',function(){
    var tfa_id = $(this).data('tfaid');
    var location = $(this).data('loc');
    var name = $(this).data('name');
    var no_of_persons = $(this).data('nop');
    var action = $(this).data('action');

    
    var html =  `<form method="POST" class="monthwisedetails"><input type="hidden" name="tfa_id" value="${ tfa_id }">`;
    html += `<div class='row pop-req'>
    <div class='col-md-4 py-7' style='text-align: center;'> <span > Location : </span>${ location }</div>
    <div class='col-md-5 py-7' style='text-align: center;'> <span> Name : </span>${ name }</div>
    <div class='col-md-3 py-7' style='text-align: center;'> <span> No of persons : </span>${ no_of_persons }</div>

    </div>
    <div>
    <br>
    </div>

    <div style='overflow-x:auto'>
    <table class='table table-bordered table  table-hover' cellspacing='0' width='100%'  >

    <thead>

    <tr>

    <td colspan='4' valign='bottom'>
    JUN
    </td>

    <td colspan='4' valign='bottom'>
    JUL
    </td>

    <td colspan='4' valign='bottom'>
    AUG
    </td>


    <td colspan='4' valign='bottom'>
    SEP
    </td>

    <td colspan='4' valign='bottom'>
    OCT
    </td>

    <td colspan='4' valign='bottom'>
    NOV
    </td>

    <td colspan='4' valign='bottom'>
    DEC
    </td>

    <td colspan='4' valign='bottom'>
    JAN
    </td>

    <td colspan='4' valign='bottom'>
    FEB
    </td>

    <td colspan='4' valign='bottom'>
    MAR
    </td>

    <td colspan='4' valign='bottom'>
    APR
    </td>

    <td colspan='4' valign='bottom'>
    MAY
    </td>

    </tr>

    </thead>

    <tbody>

    <tr>

    <td colspan='4' valign='bottom'>
    <input type='number' class='jun_rate monthinputbox validatetotalacr' name='jun_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='jul_rate monthinputbox validatetotalacr' name='jul_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='aug_rate monthinputbox validatetotalacr' name='aug_rate' autocomplete="off" style='width:60px'>
    </td>


    <td colspan='4' valign='bottom'>
    <input type='number' class='sep_rate monthinputbox validatetotalacr' name='sep_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='oct_rate monthinputbox validatetotalacr' name='oct_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='nov_rate monthinputbox validatetotalacr' name='nov_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='dec_rate monthinputbox validatetotalacr' name='dec_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='jan_rate monthinputbox validatetotalacr' name='jan_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='feb_rate monthinputbox validatetotalacr' name='feb_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='mar_rate monthinputbox validatetotalacr' name='mar_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='apr_rate monthinputbox validatetotalacr' name='apr_rate' autocomplete="off" style='width:60px'>
    </td>

    <td colspan='4' valign='bottom'>
    <input type='number' class='may_rate monthinputbox validatetotalacr' name='may_rate' autocomplete="off" style='width:60px'>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    </form>`;  

    $('#labour_rate_modal_body').html(html);
    var text = "Add"; 
    $('.tfa_month_det_save').removeClass('Editmonthvaue');
    $('.tfa_month_det_save').addClass('Addmonthvaue');
    $('.tfa_month_det_save').text(text);
    if(action == 'edit') {
      text = "Edit"; 
      $('.tfa_month_det_save').removeClass('Addmonthvaue');
      $('.tfa_month_det_save').addClass('Editmonthvaue');
      $('.tfa_month_det_save').text(text);
    }

    $('#labour_rate_modal').modal('show');

  });


$(document).on('click','.labour_rate_edit',function(){
  var tfa_id = $(this).data('tfaid');
  var location = $(this).data('loc');
  var name = $(this).data('name');
  var no_of_persons = $(this).data('nop');
  var action = $(this).data('action');
  var from_action = $(this).data('fromaction');

  $.ajax 
  ({
    type: "POST",
    url: "Common_Ajax.php",
    data: { Action: "Get_TFA_labour_rate",tfa_id : tfa_id,function : from_action},
    success: function(data){
     result=JSON.parse(data);
     
     if(result.Status == 1){

      var html =  `<form method="POST" class="monthwisedetails"><input type="hidden" name="tfa_id" value="${ tfa_id }">`;
      html += `<div class='row pop-req'>
      <div class='col-md-4 py-7' style='text-align: center;'> <span > Location : </span>${ location }</div>
      <div class='col-md-5 py-7' style='text-align: center;'> <span> Name : </span>${ name }</div>
      <div class='col-md-3 py-7' style='text-align: center;'> <span> No of persons : </span>${ no_of_persons }</div>

      </div>
      <div>
      <br>
      </div>

      <div style='overflow-x:auto'>
      <table class='table table-bordered table  table-hover' cellspacing='0' width='100%'  >

      <thead>

      <tr>

      <td colspan='4' valign='bottom'>
      JUN
      </td>

      <td colspan='4' valign='bottom'>
      JUL
      </td>

      <td colspan='4' valign='bottom'>
      AUG
      </td>


      <td colspan='4' valign='bottom'>
      SEP
      </td>

      <td colspan='4' valign='bottom'>
      OCT
      </td>

      <td colspan='4' valign='bottom'>
      NOV
      </td>

      <td colspan='4' valign='bottom'>
      DEC
      </td>

      <td colspan='4' valign='bottom'>
      JAN
      </td>

      <td colspan='4' valign='bottom'>
      FEB
      </td>

      <td colspan='4' valign='bottom'>
      MAR
      </td>

      <td colspan='4' valign='bottom'>
      APR
      </td>

      <td colspan='4' valign='bottom'>
      MAY
      </td>

      </tr>

      </thead>

      <tbody>

      <tr>

      <td colspan='4' valign='bottom'>
      <input type='number' class='jun_rate monthinputbox validatetotalacr' name='jun_rate' autocomplete="off" style='width:60px' value="${ result.data.Jun }">
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='jul_rate monthinputbox validatetotalacr' name='jul_rate' autocomplete="off" style='width:60px' value="${ result.data.Jul }">
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='aug_rate monthinputbox validatetotalacr' name='aug_rate' autocomplete="off" style='width:60px' value="${ result.data.Aug }">
      </td>


      <td colspan='4' valign='bottom'>
      <input type='number' class='sep_rate monthinputbox validatetotalacr' name='sep_rate' autocomplete="off" style='width:60px' value="${ result.data.Sep }">
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='oct_rate monthinputbox validatetotalacr' name='oct_rate' autocomplete="off" style='width:60px' value="${ result.data.Oct }">
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='nov_rate monthinputbox validatetotalacr' name='nov_rate' autocomplete="off" style='width:60px' value="${ result.data.Nov }">
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='dec_rate monthinputbox validatetotalacr' name='dec_rate' autocomplete="off" style='width:60px' value="${ result.data.Dec }"> 
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='jan_rate monthinputbox validatetotalacr' name='jan_rate' autocomplete="off" style='width:60px' value="${ result.data.Jan }">
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='feb_rate monthinputbox validatetotalacr' name='feb_rate' autocomplete="off" style='width:60px' value="${ result.data.Feb }">
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='mar_rate monthinputbox validatetotalacr' name='mar_rate' autocomplete="off" style='width:60px' value="${ result.data.Mar }">
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='apr_rate monthinputbox validatetotalacr' name='apr_rate' autocomplete="off" style='width:60px' value="${ result.data.Apr }">
      </td>

      <td colspan='4' valign='bottom'>
      <input type='number' class='may_rate monthinputbox validatetotalacr' name='may_rate' autocomplete="off" style='width:60px' value="${ result.data.May }">
      </td>
      </tr>
      </tbody>
      </table>
      </div>
      </form>`;  

      $('#labour_rate_modal_body').html(html);
      var text = "Add"; 
      $('.tfa_month_det_save').removeClass('Editmonthvaue');
      $('.tfa_month_det_save').addClass('Addmonthvaue');
      $('.tfa_month_det_save').text(text);
      if(action == 'edit') {
        text = "Edit"; 
        $('.tfa_month_det_save').removeClass('Addmonthvaue');
        $('.tfa_month_det_save').addClass('Editmonthvaue');
        $('.tfa_month_det_save').text(text);
      }

      $('#labour_rate_modal').modal('show');


    }else{
      $('#labour_rate_modal').modal('hide');
      Alert_Msg("Something Went Wrong.","error");
      return false;
    }
  }
});


});


$(document).on('click','.Addmonthvaue',function(){
  let Uset_Input=$(".monthwisedetails").serializeArray();

  Uset_Input.push({"name":"Action","value":"Add_TFA_labour_rate"},{"name":"function","value":"Add"}); 

  $.ajax 
  ({
    type: "POST",
    url: "Common_Ajax.php",
    data:Uset_Input,
    success: function(data){
     result=JSON.parse(data);

     if(result.Status == 1){

      $('#labour_rate_modal').modal('hide');

      Alert_Msg("Labour rate added successfully.","success");

      window.location.href ='TFA.php';

    }else{
      $('#labour_rate_modal').modal('hide');
      Alert_Msg("Something Went Wrong.","error");
      return false;
    }
  }
});
});

$(document).on('click','.Editmonthvaue',function(){
  let Uset_Input=$(".monthwisedetails").serializeArray();

  Uset_Input.push({"name":"Action","value":"Add_TFA_labour_rate"},{"name":"function","value":"Edit"}); 

  $.ajax 
  ({
    type: "POST",
    url: "Common_Ajax.php",
    data:Uset_Input,
    success: function(data){
     result=JSON.parse(data);

     if(result.Status == 1){

      $('#labour_rate_modal').modal('hide');

      Alert_Msg("Labour rate updated successfully.","success");

      window.location.href ='TFA.php';

    }else{
      $('#labour_rate_modal').modal('hide');
      Alert_Msg("Something Went Wrong.","error");
      return false;
    }
  }
});
});


$(document).on('click','.labour_rate_delete',function(){
  var tfa_id = $(this).data('tfaid');

  $.ajax 
  ({
    type: "POST",
    url: "Common_Ajax.php",
    data: { Action: "Delete_TFA_labour_rate", tfa_id : tfa_id },
    success: function(data){
     result=JSON.parse(data);

     if(result.Status == 1){

      Alert_Msg("Labour rate deleted successfully.","success");

      window.location.href ='TFA.php';

    }else{
      Alert_Msg("Something Went Wrong.","error");
      return false;
    }
  }
});
});


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
 $('.js-example-basic-single').select2();


 var user_input={};


 Get_TFA_Details("no");
 Get_Completed_TFA_Details("no");

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

 var passing_total_rate=$(this).parents('tr').find(".acragevaluemain").val();

      // var CTC_Value = $(this).parents('tr').find(".CTC_Value").val();

      // alert(passing_total_rate);

       //return false;

 if(passing_total_rate ==''){

  var passing_total_rate=0;


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

    $(".Total_rate").val(passing_total_rate);
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

          $(".close").trigger('closebutton'); 

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

   let Uset_Input=$(".TFA_tablewisedata").serializeArray();

   Uset_Input.push({"name":"Action","value":"TFA_finaldata"});

    $.ajax 
    ({
      type: "POST",
      url: "Common_Ajax.php",
      data:Uset_Input,
      success: function(data){

         result=JSON.parse(data);
         
         if(result.Status == 1){


          Alert_Msg("Submitted.","success");

         window.location.href ='TFA.php';


          return false;
        }else{
         Alert_Msg("Something Went Wrong.","error");
         return false;
       }
     }
   });

 return false;

});




$(document).on("click", ".completedrecord", function (){


  Get_Completed_TFA_Details("yes");

  $("#Completedrecordpopup").modal('show');

});

  function Get_Completed_TFA_Details(destroy_status)
  {
    var data_table='TFA_completed_table'
    if(destroy_status == "yes")
    {
      $('#'+data_table).DataTable().destroy();
    }

    // setTimeout(function(){ 
      var table = $('#'+data_table).DataTable({
        "dom": 'Bfrtip',
        // "scrollX": true,
        "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
        "bprocessing": true,
        "serverSide": true,
        "pageLength": 5,
        "searching": false,
        "ajax": 
        {
          "url": "Common_Ajax.php", 
          "type": "POST",
          "data": {Action:"Get_TFA_Details",function: "get_completed_TFA"}         
        }
      });
    // },500);


  }


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
<!-- jQuery  -->


<!-- Required datatable js -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>
<script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>




<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>



<?php include "footer.php"; ?>






