<?php 
include "header.php";
include "topmenubar.php";
include "sidebarmenu.php";
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

  #select2-location-container {
    margin-top: 7px;
  }

  table th {
    font-weight: bold !important;
  }

  .UOM {
    border: 1px solid #b8b8eb;
  }

  .multiselect.dropdown-toggle {
    width: 217px !important;
    background-color: white !important;
    border: 1px solid #ddd !important;
    color: #444 !important;
    padding: 3px !important;
  }

  .main-content {
    height: 100vh;
  }

</style>


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
                    <div class="card">
                        <div class="card-body bootstrap-select-1">

                            <form method="POST"  class="Consumablesallvalues" >

                                <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  

                                <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    

                                <input type="hidden" class="Autonumloc" name="Autonumloc" >   

                                <input type="hidden" class="Autonumid" name="Autonumid" >     

                                <h4 class="header-title mt-0">Consumables UOM</h4>

                                <div class="row">
                                    <div class="col-md-2">
                                        <h6 class="input-title mt-0">Location</h6>
                                        <select class="form-control form-select select2 mb-3 select2-single locationvalue" name="location" id="location"   style="width: 100%; height:36px;" >

                                          <option value="">Choose Location</option>

                                          <?php

                                          $Sql   = "SELECT DISTINCT ConsumLocation from BreedingAdmin_Consumables 
                                            inner join BreedingAdmin_Consumablestype ON BreedingAdmin_Consumables.Id = BreedingAdmin_Consumablestype.Docid
                                            where BreedingAdmin_Consumables.Rejectionstatus IS NULL AND BreedingAdmin_Consumables.CreatedBy = '".$_SESSION['EmpID']."'";
                                          $Sql_Connection = sqlsrv_query($conn,$Sql);
                                          while($row = sqlsrv_fetch_array($Sql_Connection)){
                                            ?>


                                            <option value="<?php echo trim($row['ConsumLocation']); ?>"> <?php echo $row['ConsumLocation']; ?> </option>
                                        <?php } ?>

                                        </select>
                                    </div>                                 
                                    <div class="col-md-2">
                                       <h6 class="mt-lg-0 input-title">Project</h6>

                                        <select class="locbaseprojectvalue" name="project[]" id="project" style="width: 100%" multiple="multiple" data-placeholder="Choose">

                                            <?php
                                            $Sql   = "SELECT DISTINCT ConsumProject from BreedingAdmin_Consumables 
                                            inner join BreedingAdmin_Consumablestype ON BreedingAdmin_Consumables.Id = BreedingAdmin_Consumablestype.Docid
                                            where BreedingAdmin_Consumables.Rejectionstatus IS NULL AND BreedingAdmin_Consumables.CreatedBy = '".$_SESSION['EmpID']."'";
                                            $Sql_Connection = sqlsrv_query($conn,$Sql);
                                            while($row = sqlsrv_fetch_array($Sql_Connection)){
                                                ?>
                                                <option value="<?php echo trim($row['ConsumProject']); ?>"> <?php echo $row['ConsumProject']; ?> </option>
                                            <?php } ?>

                                        </select> 
                                    </div>  
                                    <div class="col-md-2">
                                        <h6 class="mt-lg-0 input-title">Consumables</h6>
                                            <select class="Consumables" name="Consumables[]" id="Consumables" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                             <?php
                                             $Sql   = "SELECT DISTINCT Breedingconsumables from BreedingAdmin_Consumables 
                                            inner join BreedingAdmin_Consumablestype ON BreedingAdmin_Consumables.Id = BreedingAdmin_Consumablestype.Docid
                                            where BreedingAdmin_Consumables.Rejectionstatus IS NULL AND BreedingAdmin_Consumables.CreatedBy = '".$_SESSION['EmpID']."'";
                                             $Sql_Connection = sqlsrv_query($conn,$Sql);
                                             while($row = sqlsrv_fetch_array($Sql_Connection)){
                                                ?>
                                                <option value="<?php echo trim($row['Breedingconsumables']); ?>"> <?php echo $row['Breedingconsumables']; ?> </option>
                                            <?php } ?>
                                        </select> 
                                    </div>  
                                    <div class="col-md-4">
                                         <!-- <button type="button" class="btn btn-secondary addbtn" id="addbtn" style="margin-top: 20px;">Add</button> -->
                                         <button type="button" class="btn btn-primary" id="addbtn" style="margin-top: 20px;">Single</button>
                                         <button type="button" class="btn btn-info bulk_entry" style="margin-top: 20px;">Bulk</button> 
                                         <!-- <button type="button" class="btn btn-secondary resetbtn" style="margin-top: 20px;"> Reset </button> -->
                                    </div>                                             
                                </div>
                            </form>
                        </div>
                    </div>


                    <form method="POST" class="tablewisedataconsumtion">   

                        <div class="row Mainvalueshow">

                            <div class="col-lg-12 mt-3">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title">UOM</h4>
                                        <div class="table-responsive">
                                            <table  class="table table-bordered  nowrap consumablesentryuom" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead  >
                                                    <tr>                    
                                                        <th style="font-size: 11px !important;">Location</th>
                                                        <th style="font-size: 11px !important;">Project</th>
                                                        <th style="font-size: 11px !important;">Consumables</th>
                                                        <th style="font-size: 11px !important;">Rate Per UOM</th>
                                                    </tr>
                                                </thead >
                                                <tbody class="">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end row -->
                    </form>


                    <!-- BULK UOM MODAL START -->
                    <div class="modal" id="bulk_uom_modal" role="dialog">
                        <div class="modal-dialog modal-lg" style="max-width: 400px !important">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-bs-dismiss='modal'>&times;</button>
                                  <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 100px;">Consumables UOM</h6> 
                                </div>
                                <div class="Conformation-body p-3">
                                    <div class="general-label">
                                        <form class="form-horizontal">
                                            <div class="col-sm-12 ml-auto input-group input-group-sm mt-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">UOM</span>
                                                </div>
                                                <input type="number" class="form-control" name="uom" id="uom" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <div>
                                                <br><br>
                                            </div>
                                        </form>

                                        <div align="center">
                                            <button type="button" class="btn btn-sm btn-success uom_apply">Apply</button>
                                            <button type='button' class='btn btn-sm btn-danger closebutton' data-bs-dismiss='modal'>Close</button>
                                        </div>
                                    </div>
                                    <div><br><br></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- BULK UOM MODAL END -->


                </div>                                
            <?php include "footer.php"; ?>
            </div> <!-- end col -->

        </div> <!-- end row --> 
<!-- /Right-bar -->

<!-- Right bar overlay-->
<!-- <div class="rightbar-overlay"></div> -->
    </div>  
    <!-- End Page-content -->



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


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.js"></script>

<script src="../common/checkSession.js"></script>

<!-- Required datatable js -->




<script>
    $(document).ready(function(){
       $('.js-example-basic-single').select2();
       $('.locbaseprojectvalue').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 350,
         enableCaseInsensitiveFiltering: true,
        buttonWidth: 250,
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
        maxHeight: 350,
         enableCaseInsensitiveFiltering: true,
        buttonWidth: 250,
        buttonText: function(options, select) {
            if (options.length === 0) {
                return 'Select Consumables';
            } else {
                return options.length + ' selected';
            }
        }
    });

   });

    $(document).on('click','.single_entry',function(){
        $('.UOM').removeAttr('readonly');
        if($(this).hasClass('btn-primary')) {
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-danger');
        } else if($(this).hasClass('btn-danger')) {
            $(this).removeClass('btn-danger');
            $(this).addClass('btn-primary');
            $('.UOM').prop('readonly',true);
        }
    });

    $(document).on("change", "#location", function (){
        var location_name = $(this).val();
        $.ajax ({
          type: "POST",
          url: "Common_Ajax.php",
          data: { Action: 'Get_UOM_Details',location_name : location_name },
          success: function(data){
            var result = JSON.parse(data);
            var html = ''; 
            for(i in result) {
                html += `<option value="${result[i].ConsumProject}">${result[i].ConsumProject}</option>`;
            }
            $('#project').html(html);
            $('#project').multiselect('rebuild');

          }
      });
    });

    $(document).on("change", "#project", function (){
        var location_name = $('#location').val();
        var project_name  = $(this).val();
        $.ajax ({
          type: "POST",
          url: "Common_Ajax.php",
          data: { Action: 'Get_UOM_Details',location_name: location_name,project_name : project_name },
          success: function(data){
            var result = JSON.parse(data);
            var html = ''; 
            for(i in result) {
                html += `<option value="${result[i].Breedingconsumables}">${result[i].Breedingconsumables}</option>`;
            }
            $('#Consumables').html(html);
            $('#Consumables').multiselect('rebuild');

          }
      });
    });

    $(document).on("click", "#addbtn", function (){
        var location_name = $('#location').val();
        var project_name  = $('#project').val();
        var consumables   = $('#Consumables').val();
        if(location_name == '') {
            Alert_Msg("Please Select Location.","warning");
        } else if(project_name.length == 0) {
            Alert_Msg("Please Choose Project.","warning");
        } else if(consumables.length == 0) {
            Alert_Msg("Please Choose Consumables.","warning");
        } else {
            var user_input = {}; 
            user_input.location_name = location_name;
            user_input.project_name = project_name;
            user_input.consumables = consumables;
            Consumbaleslocationwisetableuom("yes",user_input);
        }

    });

    function Consumbaleslocationwisetableuom(destroy_status,user_input)
    {
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
              "data": {Action:"consumablesentryuom",user_input : user_input}
          }
      });
    }


    $(document).on("keyup", ".UOM", function (){
        var consum_type_id = $(this).parents('tr').find('.consumtypeid').val();
        var uom_value      = $(this).val();
        $.ajax ({
          type: "POST",
          url: "Common_Ajax.php",
          data: { Action: 'update_consumables_uom',type : 'single',consum_type_id : consum_type_id,uom_value : uom_value },
          success: function(data){
          }
        });
    });

    $(document).on("click", ".bulk_entry", function (){
        $('#bulk_uom_modal').modal('show');
    });

    $(document).on("click", ".uom_apply", function (){
        var location_name = $('#location').val();
        var project_name  = $('#project').val();
        var consumables   = $('#Consumables').val();
        var uom_value     = $('#uom').val();
        if(location_name == '') {
            Alert_Msg("Please Select Location.","warning");
        } else if(project_name.length == 0) {
            Alert_Msg("Please Choose Project.","warning");
        } else if(consumables.length == 0) {
            Alert_Msg("Please Choose Consumables.","warning");
        } else {
            $.ajax ({
              type: "POST",
              url: "Common_Ajax.php",
              data: { Action: 'update_consumables_uom',type : 'bulk',location_name : location_name,project_name : project_name,consumables : consumables,uom_value : uom_value },
              success: function(data){
                if(data == 1) {
                    $('#bulk_uom_modal').modal('hide');
                    var user_input = {}; 
                    user_input.location_name = location_name;
                    user_input.project_name = project_name;
                    user_input.consumables = consumables;
                    Consumbaleslocationwisetableuom("yes",user_input);
                }
              }
            });
        }
    });
    
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js"></script>

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
