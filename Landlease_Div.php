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
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
/*    line-height: 13px !important;*/
}table thead{

  background-color: #0033c4;
  color: white;
}.header-title{

    color: blue;
    font-weight: 900;
}
input:focus {
        outline: none;
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
  font-size: 14px;
  font-weight: bold;
}

/*.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}*/

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
}

.multiselect.dropdown-toggle{
    width: 100% !important;
    height: 36px !important;
    border: 1px solid #000 !important;
    border-radius: 4px !important;
    background: #fff !important;
  }

.select2.select2-container.select2-container--default
{
  width: 148.6px !important;
}

.datepicker .datepicker-switch {
    width: 257px !important;
}

.datepicker table thead {
    background-color: #f4f4f4;
    color: white !important;
}

.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 1260px !important;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s;
}

.edit-icon{
  border: none;
  background: transparent;
}
.edit-icon i{
  color: #655be6;
  font-size: 14px;
}

.delete-icon{
  border: none;
  background: transparent;
}
.delete-icon i{
  color: #655be6;
  font-size: 14px;
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
              <!-- Modal -->
              <div class="modal" id="monthwisedetails" role="dialog" style="z-index: 2000;">
                <form method="POST" class="monthwisedetails">
                  <div class="modal-dialog modal-lg" style="max-width: 1200px !important">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss='modal'>&times;</button>
                        <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 465px;">Land Lease (Month Wise)</h6> 
                      </div>
                      <div class="Conformation-body">
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <!-- ModalStart -->
              <div class="modal fade" id="Completedrecordpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="max-width: 1200px !important;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 526px;">Completed Data</h6>
                    </div>
                    <div class="modal-body">
                      <form method="POST" class="Completed_tabledetailsland">   
                         <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-body">

                                <h4 class="mt-0 header-title ml-5">Land Lease</h4>

                                <table class="table table-bordered nowrap completed_locationwisland" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                  <thead>
                                    <tr >                    
                                      <th>S.No</th>
                                      <th>Location</th>
                                      <th>Crop</th>
                                      <th>Status</th>
                                      <th>Vendor Name</th>
                                      <th>No of Acres</th>
                                      <th>Per Acre</th>       
                                      <th>From Date</th>
                                      <th>To Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody id="CompletedLocationWiseLandLeaseData">
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div> <!-- end col -->

                        </div> <!-- end row -->
                      </form>
                      <div align="center" style="padding:20px;">
                        <button type="button" class="btn btn-sm btn-success completed_finalsubmittion" disabled>Submit</button>
                        <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton" data-bs-dismiss='modal'>Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ModalEnd -->

              <!-- AddRowModalStart----Divya -->
              <div class="modal fade" id="Addrowrecordpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="max-width: 1200px !important;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 526px;">Add Row</h6>
                    </div>
                    <div class="modal-body">
                      <form method="POST" class="add_rowtable">   
                         <div class="row">
                          <div class="col-lg-12">
                            <div class="card">
                              <div class="card-body">

                                <h4 class="mt-0 header-title ml-5">Add Land Lease</h4>

                                <div class="row">
                                <div class="col-md-3">
                                <h6 class="input-title mt-0">Location</h6>
                                <select class="multiselect mb-3" name="location_add[]" id="location_add"  multiple="multiple" style="width: 100%; height:36px;" data-placeholder="Choose">
                                   <?php
                                   $getFromYear = date('Y');
                                   $getToYear = $getFromYear+1;
                                   $Breeding_Year = $getFromYear."-".$getToYear;
                                   $addQry = "SELECT DISTINCT Location FROM BreedingAdmin_Land_Lease_master WHERE Breeding_Year='".$Breeding_Year."'";
                                   $addExec = sqlsrv_query($conn,$addQry);
                                   while($addRow = sqlsrv_fetch_array($addExec))
                                   {
                              
                                   // $Sql   = "SELECT  DISTINCT BreedingAdmin_Location.BreedingLocation from BreedingAdmin_Location
                                   // where BreedingAdmin_Location.CreatedBy='".$_SESSION['EmpID']."' AND BreedingAdmin_Location.Rejectionstatus IS NULL ";
                                   // $Sql_Connection = sqlsrv_query($conn,$Sql);
                                   // while($row = sqlsrv_fetch_array($Sql_Connection)){
                                   //  if($CompletedLocation!=$row['BreedingLocation'])
                                   //  {
                                    ?>
                                    <option value="<?php echo trim($addRow['Location']); ?>"> <?php echo $addRow['Location']; ?> </option>
                                    <?php } ?>

                                </select>
                            </div>
                            <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="col-md-3">
                             <button type="button" class="btn btn-primary submitAdd" style="margin-top: 28px;"> Add </button>
                             </div>         -->
                          </div>
                          <br>

                                <table class="table table-bordered nowrap addrowtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                  <thead>
                                    <tr >                    
                                      <th>S.No</th>
                                      <th>Location</th>
                                      <th>Crop</th>
                                      <th>Status</th>
                                      <th>Vendor Name</th>
                                      <th>No of Acres</th>
                                      <th>Per Acre</th>       
                                      <th>From Date</th>
                                      <th>To Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody id="AddRowData">
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div> <!-- end col -->

                        </div> <!-- end row -->
                      </form>
                      <div align="center" style="padding:20px;">
                        <button type="button" class="btn btn-sm btn-success addrow_finalsubmission" disabled>Submit</button>
                        <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton" data-bs-dismiss='modal'>Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- AddRowModalEnd----Divya -->

                <div class="card">
                    <div class="card-body bootstrap-select-1">
                        <form method="POST"  class="locationwiseacrageland" >

                          <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  

                          <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    


                          <input type="hidden" class="Autonumloc" name="Autonumloc" >   

                          <input type="hidden" class="Autonumid" name="Autonumid" >     

                          <h4 class="header-title mt-0">Land Lease</h4>

                          <div class="row">
                            <div class="col-md-3">
                                <h6 class="input-title mt-0">Location</h6>
                                <select class="multiselect mb-3" name="location[]" id="location"  multiple="multiple" style="width: 100%; height:36px;" data-placeholder="Choose">
                                   <?php
                                   $getFromYear = date('Y');
                                   $getToYear = $getFromYear+1;
                                   $Breeding_Year = $getFromYear."-".$getToYear;
                                   $optQry = "SELECT DISTINCT Location FROM BreedingAdmin_Land_Lease_master WHERE Breeding_Year='".$Breeding_Year."'";
                                   $optExec = sqlsrv_query($conn,$optQry);
                                   while($optRow = sqlsrv_fetch_array($optExec))
                                   {
                                    $CompletedLocation = $optRow['Location'];
                                   }

                                   $Sql   = "SELECT  DISTINCT BreedingAdmin_Location.BreedingLocation from BreedingAdmin_Location
                                   where BreedingAdmin_Location.CreatedBy='".$_SESSION['EmpID']."' AND BreedingAdmin_Location.Rejectionstatus IS NULL ";
                                   $Sql_Connection = sqlsrv_query($conn,$Sql);
                                   while($row = sqlsrv_fetch_array($Sql_Connection)){
                                    if($CompletedLocation!=$row['BreedingLocation'])
                                    {
                                    ?>
                                    <option value="<?php echo trim($row['BreedingLocation']); ?>"> <?php echo $row['BreedingLocation']; ?> </option>
                                    <?php }} ?>

                                </select>
                            </div>                                    

                            <div class="col-md-3">

                             <button type="button" class="btn btn-primary addbtn" style="margin-top: 28px;"> Add </button>

                             <button type="button" class="btn btn-secondary resetbtn" style="margin-top: 28px;"> Reset </button>    

                             <button type="button" class="btn btn-warning completedrecord" style="margin-top: 28px;"> Completed </button>

                             <button type="button" class="btn btn-info add_row" style="margin-top: 28px;"> AddRow+ </button>  

                            </div>                                             
                          </div>
                        </form>
                    </div>
                </div>


                <div class="card">
                  <div class="card-body">
                    <h4 class="mt-0 header-title">Land Lease</h4>
                    <form method="post" class="Finaltabledetailsland">

                      <table class="table table-bordered nowrap locationwisland" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                          <tr >                    
                            <th>S.No</th>
                            <th>Location</th>
                            <th>Crop</th>
                            <th>Status</th>
                            <th>Vendor Name</th>
                            <th>No of Acres</th>
                            <th>Per Acre</th>       
                            <th>From Date</th>
                            <th>To Date</th>
                          </tr>
                        </thead>
                        <tbody id="LocationWiseLandLeaseData">
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>

<!-- BreedingAdmin_Land_Lease_master -->
                <div align="center">
                  <button type="button" class="btn btn-sm btn-success finalsubmittion">Submit</button>
                  <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>
                </div>


                <?php include "footer.php"; ?>

            </div>

        </div> 

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
//     $(document).on("click",".addbtn",function(){




//         var locationvalue=$("#location").val();




// //alert(locationvalue);

//         if(locationvalue =='' || locationvalue ==null){

//            Alert_Msg("Please Select Location.","warning");
//            return false;
//        }



//        let Uset_Input=$(".locationwiseacrageland").serializeArray();

//        Uset_Input.push({"name":"Action","value":"locationwiseacrageland"});

//        $.ajax 
//        ({
//           type: "POST",
//           url: "Common_Ajax.php",
//           data:Uset_Input,
//        async:false,//
//        success: function(data){

//       //  $(".loadingclasspre").hide()

//         //$(".projectwisehide").css("display","block")

//         result=JSON.parse(data);



//         $(".Autonumloc").val(result.Autoincnum);
//         $(".Autonumid").val(result.autoid);
//         // $(".Autonumloc").val(result.autoid);

//         if(result.Status == 1){


//             Alert_Msg("Added.","success");

//             var user_input={};



//             window.location.href ='Landlease_Div.php';



//             LocationwiseprojectDetailslandlease("yes",user_input);



//              //alert("right");
//             return false;
//         }else if(result.Status == 2){

//           Alert_Msg("Already Location Project Available.","error");
//           window.location.href ='Landlease_Div.php';

//           return false;


//       }else{

//            // alert("Wrong");
//          Alert_Msg("Something Went Wrong.","error");
//          return false;
//      }
//  }
// });

//        return false;

//    });


    $(document).on("click",".addbtn",function(){

        var locationvalue=$("#location").val();
        //alert(locationvalue)
        if(locationvalue =='' || locationvalue ==null){

           Alert_Msg("Please Select Location.","warning");
           return false;
       }
       //console.log('getCurrentFinancialYearStartDate')
      //alert(getCurrentFinancialYearStartDate());

        LocationwiseprojectDetailslandlease("yes",locationvalue);

//        let Uset_Input=$(".locationwiseacrageland").serializeArray();

//        Uset_Input.push({"name":"Action","value":"locationwiseacrageland"});


//        $.ajax 
//        ({
//           type: "POST",
//           url: "Common_Ajax.php",
//           data:Uset_Input,
//        async:false,//
//        success: function(data){
//         result=JSON.parse(data);
//         $(".Autonumloc").val(result.Autoincnum);
//         $(".Autonumid").val(result.autoid);

//         if(result.Status == 1){
//             Alert_Msg("Added.","success");
//             var user_input={};
//             window.location.href ='Landlease_Div.php';
//             LocationwiseprojectDetailslandlease("yes",user_input);
//             return false;
//         }else if(result.Status == 2){
//           Alert_Msg("Already Location Project Available.","error");
//           window.location.href ='Landlease_Div.php';
//           return false;
//       }else{
//            // alert("Wrong");
//          Alert_Msg("Something Went Wrong.","error");
//          return false;
//      }
//  }
// });

       return false;

   });




    function LocationwiseprojectDetailslandlease(destroy_status,user_input)
    {
          $.ajax({
              url: 'Common_Ajax.php',
              type: 'POST',
              dataType: 'json',
              data: { Action: 'getLocationWiseLandLeaseData',Location:user_input },
              success: function(res) {

                console.log(res)
                  var cropData = res.crop;
                  var htmlTable = $(".locationwisland");
                  if ($.fn.DataTable.isDataTable(htmlTable)) {
                      htmlTable.DataTable().destroy();
                  }
                  htmlTable.find('tbody').empty();

                   // Loop through the response data and append rows to the table
                  var sno=1;
                  for (var i = 0; i < res.data.length; i++) {
                      var row = '<tr>';
                      row += '<td>' + sno + '</td>';
                      //row += '<td>' + (res.data[i].Location || '') + '</td>';
                      row += '<td><input type="text" style="border: none; background: transparent;" class="location-input" name="lease_loc[]" value="' + (res.data[i].Location || '') + '" readonly></td>';
                      // row += '<td>' + (res.data[i].Crop || '') + '</td>';

                       // Create the crop dropdown with options from cropData
                          row += '<td><select class="crop-dropdown" name="crop[]" data-index="' + i + '">';
                          row += '<option value="">Select</option>';
                          cropData.forEach(function(cropOption) {
                              row += '<option value="' + cropOption.Crop + '"> '+ cropOption.Crop + '</option>';
                          });

                          row += '</select></td>';

                      row += '<td><select class="status-dropdown" name="status[]" data-index="' + i + '">' +
                              '<option value="">Select</option>' +
                              '<option value="Temporary">Temporary</option>' +
                              '<option value="Permanent">Permanent</option>' +
                              '</select></td>';
                      //row += '<td><select class="status-dropdown" data-index="' + i + '">' +
                              // '<option value="Temporary"' + (res.data[i].Status === 'Temporary' ? ' selected' : '') + '>Temporary</option>' +
                              // '<option value="Permanent"' + (res.data[i].Status === 'Permanent' ? ' selected' : '') + '>Permanent</option>' +
                              // '</select></td>';
                      //row += '<td><input type="text" class="emp_name" name="Employee_name[]" style="border: none; background: transparent; width: 70px;" value="' + (res.data[i].VendorName || '') + '"></td>';
                      //row += '<td>' + (res.data[i].VendorName || '') + '</td>';
                        row += '<td><input type="text" style="border: none; background: transparent;" class="vname-input" name="vendor_name[]" value="' + (res.data[i].VendorName || '') + '" readonly><input type="hidden" name="vendor_code[]" value="' + (res.data[i].VendorCode || '') + '" readonly></td>';

                      row += '<td><input type="number" placeholder="No Of_Acres" style="border: none; background: transparent; width: 70px;" class="no_of_acres" name="no_of_acres[]"</td>';
                      row += '<td><input type="number" placeholder="Per Acre" style="border: none; background: transparent; width: 70px;" class="per_acre" name="per_acre[]"</td>';

                      // row += '<td><input type="number" style="border: none; background: transparent; width: 70px;" class="no_of_acres" name="no_of_acres[]" value="' + (res.data[i].NoOfAcres || '') + '"</td>';
                      // row += '<td><input type="number" style="border: none; background: transparent; width: 70px;" class="per_acre" name="per_acre[]"" value="' + (res.data[i].PerAcre || '') + '"</td>';
                      row += '<td><input type="text" name="from_date[]" style="border: none; background: transparent; width: 70px;" placeholder="From Date" class="datepicker-from" data-index="' + i + '"></td>';
                      row += '<td><input type="text" name="to_date[]" style="border: none; background: transparent; width: 70px;" placeholder="To Date" class="datepicker-to" data-index="' + i + '"></td>';
                      row += '</tr>';
                      sno++;
                      htmlTable.find('tbody').append(row);

                  }

                    htmlTable.DataTable({
                    scrollX: true,
                    paging: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50],
                    order: [],
                    columnDefs: [
                        { targets: '_all', className: 'dt-center' }
                    ],
                    drawCallback: function(settings) {
                        // Reinitialize plugins after each DataTable draw (pagination change)
                      $('.crop-dropdown').select2();
                        $('.status-dropdown').select2();

                        // Get the current date
                        var currentDate = new Date();

                        //var currentMonth = currentDate.getMonth(); // Month index (0 for January, 11 for December)
                        var financialYearStartMonth = 3; // April (zero-based index)
                        var financialYearEndMonth = 4; // May (zero-based index)

                        // Calculate the year for financial year start and end based on current date
                        var currentYear = currentDate.getFullYear();
                        var startYear = currentYear;
                        var endYear = currentYear + 1;

                        //  if (currentDate.getMonth() < financialYearStartMonth) {
                        //     startYear--;
                        // }

                        $('.datepicker-from').datepicker({
                            // dateFormat: 'mm-yyyy',
                            format: 'mm-yyyy', 
                            minViewMode: 1,
                            autoclose: true,
                            todayHighlight: true,
                            startDate: new Date(startYear, financialYearStartMonth),
                            endDate: new Date(endYear, financialYearEndMonth)
                        });
                        $('.datepicker-to').datepicker({
                            format: 'mm-yyyy', 
                            minViewMode: 1,
                            autoclose: true,
                            todayHighlight: true,
                            startDate: new Date(startYear, financialYearStartMonth),
                            endDate: new Date(endYear, financialYearEndMonth)
                        });
                    }
                });

                    // $('.datepicker-from').datepicker('destroy');
                    // alert($('.datepicker-from').datepicker('destroy'))

                    // $('.datepicker-from').datepicker('option', 'minDate', getCurrentFinancialYearStartDate());
                    // $('.datepicker-from').datepicker('option', 'maxDate', getCurrentFinancialYearStartDate());

                    // $('.status-dropdown').select2();

                    // $('.datepicker-from').datepicker({
                    //     dateFormat: 'dd/mm/yyyy',
                    //     changeMonth: true,
                    //     changeYear: true
                    // });

                    // $('.datepicker-to').datepicker({
                    //     dateFormat: 'dd/mm/yyyy', 
                    //     changeMonth: true,
                    //     changeYear: true
                    // });

                }
              });
  


  //       var data_table='locationwisland'
  //       if(destroy_status == "yes")
  //       {
  //           $('.'+data_table).DataTable().destroy();
  //       }
  //       $('.' + data_table).DataTable({

  //           "dom": 'Bfrtip',



  // //"columnDefs": [{ "className":"y desine", "targets": [1,2,3,4,5] }],
  //           "scrollX": true,
  //           "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
  //           "bprocessing": true,
  //           "serverSide": true,
  //           "pageLength": 5,
  //           "searching": false,
  //           "ajax": 
  //           {
  //             "url": "Common_Ajax.php", 
  //             "type": "POST",
  //             "data": {Action:"landleasedata"}
  //         }
  //     });

    }


    



    $(document).ready(function(){

    // $('.js-example-basic-single').select2();
$('.status-dropdown').select2();
      $('.multiselect').multiselect({
          maxHeight: 250,
          buttonWidth: 320,
        // selectAllText:' Select all',
          includeSelectAllOption:true,
          dropdownPosition: 'below',
          enableFiltering: true,
          enableCaseInsensitiveFiltering: true, 
          nonSelectedText: 'Choose Location',
        });





      var Autoincnum=$(".Autonumloc").val();
      var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
      var user_input={};


      user_input.Autoincnum=Autoincnum;
      user_input.autoid=autoid;

      LocationwiseprojectDetailslandlease("no",user_input);
      Get_Completed_land_Details('no');


  });



    $(document).on("click", ".Add_Month_wise_popup", function (){

   // $("#monthwisedetails").modal('show'); 
        var passing_id = $(this).attr("attributeid");
        var type       = $(this).data('from');
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
            action_type:"landleasemonthwise",
            type : type
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

       Uset_Input.push({"name":"Action","value":"monthwiselandleasedata"});

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

            setTimeout(function() {
            window.location.href ='Landlease_Div.php';
        }, 2000);

            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            LocationwiseprojectDetailslandlease("yes",user_input);


            return false;
        }else if(result.Status == 2){


         Alert_Msg("Updated.","success");

         var Autoincnum=$(".Autonumloc").val();
         var  autoid=$(".Autonumid").val();
         
         setTimeout(function(){
          window.location.href ='Landlease_Div.php';
        }, 2000);

         var user_input={};


         user_input.Autoincnum=Autoincnum;
         user_input.autoid=autoid;

         LocationwiseprojectDetailslandlease("yes",user_input);


     } else{

           // alert("Wrong");
         Alert_Msg("Something Went Wrong.","error");
         return false;
     }
 }
});




       return false;



   });



    $(document).on("click",".finalsubmittion",function(){
      //$(".finalsubmittion").trigger('click');
        $('.locationwisland').DataTable().page.len(50000).draw();

        // table.on('draw.dt', function () {
        //     let Uset_Input=$(".Finaltabledetailsland").serializeArray();

        //     console.log(Uset_Input)

              var table = $('.locationwisland').DataTable();

          table.on('draw.dt', function () {
              let Uset_Input = $(".Finaltabledetailsland").serializeArray();

              // Iterate through each row in the table
              table.rows().every(function (index, element) {
                  // Get data for the row
                  let rowData = this.data();

                  // Check if any input field in the row is empty
                  let rowEmpty = false;
                   $(this.node()).find('input[type="text"], input[type="number"]').each(function () {
                      if ($(this).val().trim() === '') {
                          rowEmpty = true;
                          return false;
                      }
                  });

                  // If row has empty fields, display alert with row number
                  if (rowEmpty) {
                      let rowNumber = index + 1; // DataTables row index starts from 0
                      alert('Row ' + rowNumber + ' contains empty fields.');
                      return false; // Exit row iteration
                  }

                  //return true;
              });

               //console.log(Uset_Input)



            Uset_Input.push({"name":"Action","value":"InsertLeaseLandVendorDetails"});

            submitdataLandeaseInsert(Uset_Input)
            
        });

    });

    // $(document).on("click",".completed_finalsubmittion",function(){
    //     $('.completed_locationwisland').DataTable().page.len(50000).draw();
    //     var table = $('.completed_locationwisland').DataTable();
    //     table.on('draw.dt', function () {
    //         let Uset_Input=$(".Completed_tabledetailsland").serializeArray();

    //         Uset_Input.push({"name":"Action","value":"Finaltabledetailsland"});

    //         submitdatafinal(Uset_Input)
    //     });

    // });


    function submitdataLandeaseInsert(Uset_Input){


        $.ajax 
        ({
          type: "POST",
          url: "Common_Ajax.php",
          data:Uset_Input,
       async:false,//
       success: function(data){

           result=JSON.parse(data);

           if(result.Status == 1){


            Alert_Msg("LandLease Details Inserted Successfully.","success");


            $(".close").trigger('click'); 


            var Autoincnum=$(".Autonumloc").val();
            var  autoid=$(".Autonumid").val();
            setTimeout(function(){
              window.location.href ='Landlease_Div.php';
            }, 2000);
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            LocationwiseprojectDetailslandlease("yes",user_input);


            return false;
        }else if(result.Status == 2){
         Alert_Msg("Data Not Insert Please Check.","warning");

        }else if(result.Status == 3){
         Alert_Msg("Please Check Post Data","warning");

       } else{
           Alert_Msg("Something Went Wrong.","error");
           return false;
       }
 }
});
        return false;

    }
    


    function submitdatafinal(Uset_Input){


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
            setTimeout(function(){
              window.location.href ='Landlease_Div.php';
            }, 2000);
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            LocationwiseprojectDetailslandlease("yes",user_input);


            return false;
        }else if(result.Status == 2){


         Alert_Msg("Updated.","success");

         var Autoincnum=$(".Autonumloc").val();
         var  autoid=$(".Autonumid").val();
         setTimeout(function(){
              window.location.href ='Landlease_Div.php';
            }, 2000);
         var user_input={};


         user_input.Autoincnum=Autoincnum;
         user_input.autoid=autoid;

         LocationwiseprojectDetailslandlease("yes",user_input);


     } else{

           // alert("Wrong");
         Alert_Msg("Something Went Wrong.","error");
         return false;
     }
 }
});
        return false;

    }

    $(document).on("click", ".completedrecord", function (){


      Get_Completed_landLease_Details("yes");

      $("#Completedrecordpopup").modal('show');

  });

function Get_Completed_landLease_Details(destroy_status)
{
      $.ajax({
              url: 'Common_Ajax.php',
              type: 'POST',
              dataType: 'json',
              data: { Action: 'getCompletedLocationWiseLandLeaseData'},
              success: function(res) {

                console.log(res)
                  var cropData = res.crop;
                  var htmlTable = $(".completed_locationwisland");
                  if ($.fn.DataTable.isDataTable(htmlTable)) {
                      htmlTable.DataTable().destroy();
                  }
                  htmlTable.find('tbody').empty();

                   // Loop through the response data and append rows to the table
                  var sno=1;
                  for (var i = 0; i < res.data.length; i++) {
                      var row = '<tr>';
                      row += '<td>' + sno + '</td>';
                      //row += '<td>' + (res.data[i].Location || '') + '</td>';
                      row += '<td><input type="text" style="border: none; background: transparent;" class="location-input location" name="lease_loc[]" value="' + (res.data[i].Location || '') + '" readonly><input type="hidden" id="row_id' + i + '" name="Id[]" value="' + (res.data[i].Id || '') + '" readonly></td>';
                      //row += '<td>' + (res.data[i].Crop || '') + '</td>';

                       row += '<td><select class="crop-dropdown crop" id="crop' + i + '" name="crop[]" data-index="' + i + '" disabled>';
                      row += '<option value="">Select</option>';
                      cropData.forEach(function(cropOption) {
                          var isSelected = (cropOption.Crop === res.data[i].Crop) ? 'selected' : '';
                          row += '<option value="' + cropOption.Crop + '" ' + isSelected + '>' + cropOption.Crop + '</option>';
                      });
                      row += '</select></td>';

                      // row += '<td><select class="status-dropdown" name="status[]" data-index="' + i + '">' +
                      //         '<option value="">Select</option>' +
                      //         '<option value="Temporary">Temporary</option>' +
                      //         '<option value="Permanent">Permanent</option>' +
                      //         '</select></td>';
                      row += '<td><select class="status-dropdown status" id="status' + i + '" data-index="' + i + '" disabled>' +
                             '<option value="">Select</option>' +
                              '<option value="Temporary"' + (res.data[i].Status === 'Temporary' ? ' selected' : '') + '>Temporary</option>' +
                              '<option value="Permanent"' + (res.data[i].Status === 'Permanent' ? ' selected' : '') + '>Permanent</option>' +
                              '</select></td>';
                      //row += '<td><input type="text" class="emp_name" name="Employee_name[]" style="border: none; background: transparent; width: 70px;" value="' + (res.data[i].VendorName || '') + '"></td>';
                      //row += '<td>' + (res.data[i].VendorName || '') + '</td>';
                        row += '<td><input type="text" style="border: none; background: transparent;" class="vname-input vendorName" name="vendor_name[]" value="' + (res.data[i].VendorName || '') + '" readonly><input type="hidden" class="vendorCode" name="vendor_code[]" value="' + (res.data[i].VendorCode || '') + '" readonly></td>';

                      // row += '<td><input type="number" placeholder="No Of_Acres" style="border: none; background: transparent; width: 70px;" class="no_of_acres" name="no_of_acres[]"</td>';
                      // row += '<td><input type="number" placeholder="Per Acre" style="border: none; background: transparent; width: 70px;" class="per_acre" name="per_acre[]"</td>';

                      row += '<td><input type="number" id="no_of_acres' + i + '" style="border: none; background: transparent; width: 70px;" class="no_of_acres noOfAcres" name="no_of_acres[]" value="' + (res.data[i].NoOfAcres || '') + '"disabled></td>';
                      row += '<td><input type="number" style="border: none; background: transparent; width: 70px;" class="per_acre perAcre" id="per_acre' + i + '" name="per_acre[]"" value="' + (res.data[i].PerAcre || '') + '"disabled></td>';
                      // row += '<td><input type="text" name="from_date[]" style="border: none; background: transparent; width: 70px;" placeholder="From Date" class="datepicker-from" data-index="' + i + '"></td>';
                      // row += '<td><input type="text" name="to_date[]" style="border: none; background: transparent; width: 70px;" placeholder="To Date" class="datepicker-to" data-index="' + i + '"></td>';

                      row += '<td><input type="text" class="fromMonth" name="from_month[]" style="border: none; background: transparent; width: 70px;" value="' + (res.data[i].Frommonth || '') + '" readonly></td>';
                      row += '<td><input class="toMonth" type="text" name="to_month[]" style="border: none; background: transparent; width: 70px;" value="' + (res.data[i].Tomonth || '') + '" readonly></td>';

                      row += '<td>';
                      row += '<button type="button" class="edit-icon" id="completed_edit" data-index="' + i + '" title="Edit"><i class="fas fa-edit"></i></button>&nbsp;';
                      row += '<button type="button" class="delete-icon" id="completed_delete" data-index="' + i + '" title="Delete"><i class="fas fa-trash-alt"></i></button>';
                      row += '</td>';
                      row += '</tr>';
                      sno++;
                      htmlTable.find('tbody').append(row);

                  }

                  htmlTable.DataTable({
                    //scrollX: true,
                    paging: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50],
                    order: [],
                    columnDefs: [
                        { targets: '_all', className: 'dt-center' }
                    ],
                    drawCallback: function(settings) {
                        // Reinitialize plugins after each DataTable draw (pagination change)
                      $('.crop-dropdown').select2();
                        $('.status-dropdown').select2();
                    }
                });
                }
              });
}

var rowData = {};

$(document).on('click','#completed_edit',function(){

  var id=$(this).data('index');
  $('#crop'+id+',#status'+id+',#no_of_acres'+id+',#per_acre'+id).prop('disabled',false);
  $('.completed_finalsubmittion').prop('disabled',false);

       rowData = {
        location: $('input[name="lease_loc[]"]').eq(id).val(),
        dataId: $('#row_id' + id).val(),
        crop: $('.crop').eq(id).val(),
        status: $('#status' + id).val(),
        vendorName: $('input[name="vendor_name[]"]').eq(id).val(),
        vendorCode: $('input[name="vendor_code[]"]').eq(id).val(),
        no_of_acres: $('#no_of_acres' + id).val(),
        per_acre: $('#per_acre' + id).val(),
        fromMonth: $('input[name="from_month[]"]').eq(id).val(),
        toMonth: $('input[name="to_month[]"]').eq(id).val()
    };

    // Listen for changes in input fields
    $('#crop' + id + ', #status' + id + ', #no_of_acres' + id + ', #per_acre' + id).on('change', function() {
        // Update corresponding property in rowData
        var fieldName = $(this).attr('name');
        var fieldNameWithoutBrackets = fieldName.replace('[]', '');
        var fieldValue = $(this).val();

        console.log(fieldValue)
        rowData[fieldNameWithoutBrackets] = fieldValue;
    });

});

$(document).on("click",".completed_finalsubmittion",function(){
  //console.log(rowData)
  // Check if rowData is populated
    if ($.isEmptyObject(rowData)) {
        alert("No row data available for submission.");
        return;
    }
    submitdatafinalCompleted(rowData);

       
    });

function submitdatafinalCompleted(rowData)
{
 rowData['Action'] = 'FinaltabledetailslandCompleted';
  $.ajax 
        ({
          type: "POST",
          url: "Common_Ajax.php",
          data:rowData,
       async:false,
       success: function(data){

        result=JSON.parse(data);
        if(result.Status == 1){
          Alert_Msg("Changes Updated.","success");
          Get_Completed_landLease_Details("yes");
          return false;
        }else if(result.Status == 2){
         Alert_Msg("Changes Not Updated.","warning");
         } else{
             Alert_Msg("Something Went Wrong.","error");
             return false;
         }

       }
     });
}

$(document).on('click','#completed_delete',function(){
  var id=$(this).data('index');
  var dataId=$('#row_id' + id).val();
  $.ajax 
        ({
          type: "POST",
          url: "Common_Ajax.php",
          data:{Action:"DeleteFinaltabledetailslandCompleted",Id:dataId},
       async:false,
       success: function(data){

          result=JSON.parse(data);
          if(result.Status == 1){
            Alert_Msg("Data Deleted.","success");
            Get_Completed_landLease_Details("yes");
            return false;
          }else if(result.Status == 2){
           Alert_Msg("Not Deleted Please Check.","warning");
           } else{
               Alert_Msg("Something Went Wrong.","error");
               return false;
           }

       }
     });
});

$(document).on("click", ".add_row", function (){


      // Get_AddRow_landLease_Details("yes");

      $("#Addrowrecordpopup").modal('show');

  });
$(document).on("change","#location_add",function(){

        var locationvalue=$("#location_add").val();
        //alert(locationvalue)
        if(locationvalue =='' || locationvalue ==null){

           Alert_Msg("Please Select Location.","warning");
           return false;
       }

         Get_AddRow_landLease_Details("yes",locationvalue);
       return false;

   });

var cropDataAdd='';

function Get_AddRow_landLease_Details(destroy_status,user_input)
    {
          $.ajax({
              url: 'Common_Ajax.php',
              type: 'POST',
              dataType: 'json',
              data: { Action: 'getAddLandLeaseData',Location:user_input },
              success: function(res) {

                console.log(res)
                  cropDataAdd = res.crop;
                  var htmlTable = $(".addrowtable");
                  if ($.fn.DataTable.isDataTable(htmlTable)) {
                      htmlTable.DataTable().destroy();
                  }
                  htmlTable.find('tbody').empty();

                   // Loop through the response data and append rows to the table
                  var sno=1;
                  for (var i = 0; i < res.data.length; i++) {

                    var disableStatus = toggleAddButton(res.data[i].Frommonth,res.data[i].Tomonth,i);
                    //console.log(disableStatus.status==1)
                     var row = '<tr>';
                      row += '<td>' + sno + '</td>';
                      //row += '<td>' + (res.data[i].Location || '') + '</td>';
                      row += '<td><input type="text" style="border: none; background: transparent;" class="location-input location" name="lease_loc[]" value="' + (res.data[i].Location || '') + '" readonly><input type="hidden" id="row_id' + i + '" name="Id[]" value="' + (res.data[i].Id || '') + '" readonly></td>';

                      //row += '<td>' + (res.data[i].Crop || '') + '</td>';

                       row += '<td><input type="text" style="border: none; background: transparent;" class="crop" name="crop[]" value="' + (res.data[i].Crop || '') + '" readonly></td>';

                      //  row += '<td><select class="crop-dropdown crop" id="crop' + i + '" name="crop[]" data-index="' + i + '" disabled>';
                      // row += '<option value="">Select</option>';
                      // cropData.forEach(function(cropOption) {
                      //     var isSelected = (cropOption.Crop === res.data[i].Crop) ? 'selected' : '';
                      //     row += '<option value="' + cropOption.Crop + '" ' + isSelected + '>' + cropOption.Crop + '</option>';
                      // });
                      // row += '</select></td>';

                      // row += '<td><select class="status-dropdown" name="status[]" data-index="' + i + '">' +
                      //         '<option value="">Select</option>' +
                      //         '<option value="Temporary">Temporary</option>' +
                      //         '<option value="Permanent">Permanent</option>' +
                      //         '</select></td>';
                      // row += '<td><select class="status-dropdown status" id="status' + i + '" data-index="' + i + '" disabled>' +
                      //        '<option value="">Select</option>' +
                      //         '<option value="Temporary"' + (res.data[i].Status === 'Temporary' ? ' selected' : '') + '>Temporary</option>' +
                      //         '<option value="Permanent"' + (res.data[i].Status === 'Permanent' ? ' selected' : '') + '>Permanent</option>' +
                      //         '</select></td>';

                       row += '<td><input type="text" style="border: none; background: transparent;" class="status" name="status[]" value="' + (res.data[i].Status || '') + '" readonly></td>';

                      //row += '<td><input type="text" class="emp_name" name="Employee_name[]" style="border: none; background: transparent; width: 70px;" value="' + (res.data[i].VendorName || '') + '"></td>';
                      //row += '<td>' + (res.data[i].VendorName || '') + '</td>';
                        row += '<td><input type="text" style="border: none; background: transparent;" class="vname-input vendorName" name="vendor_name[]" value="' + (res.data[i].VendorName || '') + '" readonly><input type="hidden" class="vendorCode" name="vendor_code[]" value="' + (res.data[i].VendorCode || '') + '" readonly></td>';

                      // row += '<td><input type="number" placeholder="No Of_Acres" style="border: none; background: transparent; width: 70px;" class="no_of_acres" name="no_of_acres[]"</td>';
                      // row += '<td><input type="number" placeholder="Per Acre" style="border: none; background: transparent; width: 70px;" class="per_acre" name="per_acre[]"</td>';

                      row += '<td><input type="number" id="no_of_acres' + i + '" style="border: none; background: transparent; width: 70px;" class="no_of_acres noOfAcres" name="no_of_acres[]" value="' + (res.data[i].NoOfAcres || '') + '"readonly></td>';
                      row += '<td><input type="number" style="border: none; background: transparent; width: 70px;" class="per_acre perAcre" id="per_acre' + i + '" name="per_acre[]"" value="' + (res.data[i].PerAcre || '') + '"readonly></td>';
                      // row += '<td><input type="text" name="from_date[]" style="border: none; background: transparent; width: 70px;" placeholder="From Date" class="datepicker-from" data-index="' + i + '"></td>';
                      // row += '<td><input type="text" name="to_date[]" style="border: none; background: transparent; width: 70px;" placeholder="To Date" class="datepicker-to" data-index="' + i + '"></td>';

                      row += '<td><input type="text" class="fromMonth" name="from_month[]" style="border: none; background: transparent; width: 70px;" value="' + (res.data[i].Frommonth || '') + '" readonly></td>';
                      row += '<td><input class="toMonth" type="text" name="to_month[]" style="border: none; background: transparent; width: 70px;" value="' + (res.data[i].Tomonth || '') + '" readonly></td>';

                      row += '<td>';
                      if(disableStatus.status==1)
                      {
                       row += '<button type="button" class="add-icon add_row_exists" id="add_row_exists' + i + '" data-index="' + i + '" title="Add" disabled><i class="fa fa-plus-square" aria-hidden="true"></i></button>';
                      }
                      else if(disableStatus.status==2)
                      {
                       row += '<button type="button" class="add-icon add_row_exists" id="add_row_exists' + i + '" data-index="' + i + '" title="Add"><i class="fa fa-plus-square" aria-hidden="true"></i></button>';
                      }

                      // row += '<button type="button" class="add-icon add_row_exists" id="add_row_exists' + i + '" data-index="' + i + '" title="Add">Add</button>';
                      row += '</td>';
                      row += '</tr>';
                      if(disableStatus.status==1)
                      {
                      row += '<tr class="add_row_insert" id="add_row_insert' + i + '" data-index="' + i + '"></tr>';
                      }
                      sno++;
                      htmlTable.find('tbody').append(row);

                  }

                    htmlTable.DataTable({
                    scrollX: true,
                    paging: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50],
                    order: [],
                    columnDefs: [
                        { targets: '_all', className: 'dt-center' }
                    ],
                    drawCallback: function(settings) {
                        // Reinitialize plugins after each DataTable draw (pagination change)
                      $('.crop-dropdown').select2();
                        $('.status-dropdown').select2();

                        // Get the current date
                        var currentDate = new Date();

                        //var currentMonth = currentDate.getMonth(); // Month index (0 for January, 11 for December)
                        var financialYearStartMonth = 3; // April (zero-based index)
                        var financialYearEndMonth = 4; // May (zero-based index)

                        // Calculate the year for financial year start and end based on current date
                        var currentYear = currentDate.getFullYear();
                        var startYear = currentYear;
                        var endYear = currentYear + 1;

                        //  if (currentDate.getMonth() < financialYearStartMonth) {
                        //     startYear--;
                        // }

                        $('.datepicker-from').datepicker({
                            // dateFormat: 'mm-yyyy',
                            format: 'mm-yyyy', 
                            minViewMode: 1,
                            autoclose: true,
                            todayHighlight: true,
                            startDate: new Date(startYear, financialYearStartMonth),
                            endDate: new Date(endYear, financialYearEndMonth)
                        });
                        $('.datepicker-to').datepicker({
                            format: 'mm-yyyy', 
                            minViewMode: 1,
                            autoclose: true,
                            todayHighlight: true,
                            startDate: new Date(startYear, financialYearStartMonth),
                            endDate: new Date(endYear, financialYearEndMonth)
                        });
                    }
                });

                }
              });
    }

    function toggleAddButton(fromMonth,toMonth,index)
    {
      // Get the current date
      var currentDate = new Date();
      var myarray = [];

      //var currentMonth = currentDate.getMonth(); // Month index (0 for January, 11 for December)
      var financialYearStartMonth = 3; // April (zero-based index)
      var financialYearEndMonth = 4; // May (zero-based index)

      // Calculate the year for financial year start and end based on current date
      var currentYear = currentDate.getFullYear();
      var startYear = currentYear;
      var endYear = currentYear + 1;

      var startDate = new Date(startYear, financialYearStartMonth);
      var endDate = new Date(endYear, financialYearEndMonth);

      // Format startDate and endDate into MM-yyyy strings
      var formattedStartDate = ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' + startDate.getFullYear();
       //myarray.push(formattedStartDate)
      var formattedEndDate = ('0' + (endDate.getMonth() + 1)).slice(-2) + '-' + endDate.getFullYear();
      //myarray.push(formattedEndDate)
      // console.log(formattedStartDate);
      // console.log(formattedEndDate);
      // console.log(startDate + '--' + endDate)
     //  console.log(formattedStartDate + '--' + formattedEndDate)
     //  console.log(fromMonth + '--' + toMonth)

     // // console.log('#add_row_exists'+index)
      var myarray = [];
      if(fromMonth==formattedStartDate && toMonth==formattedEndDate)
      {
         if (!Array.isArray(myarray['status'])) {
              myarray['status'] = [];
          }
          myarray['status'].push(1);
        // console.log('Yes------------------')
        //  $('#add_row_exists'+index).prop('disabled', true);
      }
      else
      {
        if (!Array.isArray(myarray['status'])) {
              myarray['status'] = [];
          }
          myarray['status'].push(2);
        // $('#add_row_exists'+index).prop('disabled', false);
      }

      //console.log(myarray);
      return myarray
    }

    $(document).on('click','.add_row_exists',function(){
      console.log('Divya')
      var id = $(this).data('index');


      var location = $('input[name="lease_loc[]"]').eq(id).val();
      var crop = $('input[name="crop[]"]').eq(id).val();
      var status = $('input[name="status[]"]').val();
      var vendorName = $('input[name="vendor_name[]"]').eq(id).val();
      var vendorCode = $('input[name="vendor_code[]"]').eq(id).val();
      var no_of_acres = $('#no_of_acres' + id).val();
      var per_acre = $('#per_acre' + id).val();
      var fromMonth = $('input[name="from_month[]"]').eq(id).val();
      var toMonth = $('input[name="to_month[]"]').eq(id).val();

      var htmlTable = $(".addrowtable");
      // if ($.fn.DataTable.isDataTable(htmlTable)) {
      //     htmlTable.DataTable().destroy();
      // }
      htmlTable.find('#add_row_insert'+id).empty();
      var rowApp = '<td></td>';
      rowApp += '<td><input type="text" style="border: none; background: transparent;" class="location-input" name="lease_loc[]" value="' + (location || '') + '" readonly></td>';
                      // row += '<td>' + (res.data[i].Crop || '') + '</td>';

                       // Create the crop dropdown with options from cropData
                          rowApp += '<td><select class="crop-dropdown" name="crop[]" data-index="' + i + '">';
                          rowApp += '<option value="">Select</option>';
                          cropDataAdd.forEach(function(cropOption) {
                            if(cropOption.Crop!=crop)
                            {
                              rowApp += '<option value="' + cropOption.Crop + '"> '+ cropOption.Crop + '</option>';
                            }
                          });

                          rowApp += '</select></td>';

                      rowApp += '<td><select class="status-dropdown" name="status[]" data-index="' + i + '">' +
                              '<option value="">Select</option>' +
                              '<option value="Temporary">Temporary</option>' +
                              '<option value="Permanent">Permanent</option>' +
                              '</select></td>';
                      //row += '<td><select class="status-dropdown" data-index="' + i + '">' +
                              // '<option value="Temporary"' + (res.data[i].Status === 'Temporary' ? ' selected' : '') + '>Temporary</option>' +
                              // '<option value="Permanent"' + (res.data[i].Status === 'Permanent' ? ' selected' : '') + '>Permanent</option>' +
                              // '</select></td>';
                      //row += '<td><input type="text" class="emp_name" name="Employee_name[]" style="border: none; background: transparent; width: 70px;" value="' + (res.data[i].VendorName || '') + '"></td>';
                      //row += '<td>' + (res.data[i].VendorName || '') + '</td>';
                        rowApp += '<td><input type="text" style="border: none; background: transparent;" class="vname-input" name="vendor_name[]" value="' + (VendorName || '') + '" readonly><input type="hidden" name="vendor_code[]" value="' + (VendorCode || '') + '" readonly></td>';

                      rowApp += '<td><input type="number" placeholder="No Of_Acres" style="border: none; background: transparent; width: 70px;" class="no_of_acres" name="no_of_acres[]"</td>';
                      rowApp += '<td><input type="number" placeholder="Per Acre" style="border: none; background: transparent; width: 70px;" class="per_acre" name="per_acre[]"</td>';

                      // row += '<td><input type="number" style="border: none; background: transparent; width: 70px;" class="no_of_acres" name="no_of_acres[]" value="' + (res.data[i].NoOfAcres || '') + '"</td>';
                      // row += '<td><input type="number" style="border: none; background: transparent; width: 70px;" class="per_acre" name="per_acre[]"" value="' + (res.data[i].PerAcre || '') + '"</td>';
                      rowApp += '<td><input type="text" name="from_date[]" style="border: none; background: transparent; width: 70px;" placeholder="From Date" class="datepicker-from" data-index="' + i + '"></td>';
                      rowApp += '<td><input type="text" name="to_date[]" style="border: none; background: transparent; width: 70px;" placeholder="To Date" class="datepicker-to" data-index="' + i + '"></td>';


    });
    

 // $('.completed_locationwisland').DataTable().page.len(50000).draw();
 //        var table = $('.completed_locationwisland').DataTable();
 //        table.on('draw.dt', function () {
 //            let Uset_Input=$(".Completed_tabledetailsland").serializeArray();

 //            Uset_Input.push({"name":"Action","value":"Finaltabledetailsland"});

 //            submitdatafinal(Uset_Input)

            
 //        });


  //   $(document).on('keyup','.emp_name',function(){
  //     var emp_name = $(this).val();
  //     var lease_id = $(this).parents('tr').find('.lease_id').val();
  //     $.ajax ({
  //       type: "POST",
  //       url: "Common_Ajax.php",
  //       data: { Action: 'land_lease_keyup_update',lease_id : lease_id,emp_name : emp_name,type : 'name' },
  //       success: function(data){
  //       }
  //   });
  // });

  //   $(document).on('keyup','.no_of_acres',function(){
  //     var no_of_acres = $(this).val();
  //     var lease_id = $(this).parents('tr').find('.lease_id').val();
  //     $.ajax ({
  //       type: "POST",
  //       url: "Common_Ajax.php",
  //       data: { Action: 'land_lease_keyup_update',lease_id : lease_id,no_of_acres : no_of_acres,type : 'no_of_acres' },
  //       success: function(data){
  //       }
  //   });
  // });

  //   $(document).on('keyup','.per_acre',function(){
  //     var per_acre = $(this).val();
  //     var lease_id = $(this).parents('tr').find('.lease_id').val();
  //     $.ajax ({
  //       type: "POST",
  //       url: "Common_Ajax.php",
  //       data: { Action: 'land_lease_keyup_update',lease_id : lease_id,per_acre : per_acre,type : 'per_acre' },
  //       success: function(data){
  //       }
  //   });
  // });

  //   $(document).on("click", ".completedrecord", function (){


  //     Get_Completed_land_Details("yes");

  //     $("#Completedrecordpopup").modal('show');

  // });

    


    function Get_Completed_land_Details(destroy_status)
    {
        var data_table='completed_locationwisland'
        if(destroy_status == "yes")
        {
          $('.'+data_table).DataTable().destroy();
      }

    // setTimeout(function(){ 
      var table = $('.'+data_table).DataTable({
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
          "data": {Action:"landleasedata",function: "get_completed_landleasedata"}         
      }
  });
    // },500);


  }

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
