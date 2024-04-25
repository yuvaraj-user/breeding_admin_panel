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

              <!-- Modal -->
              <div class="modal fade" id="Completedrecordpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="max-width: 1200px !important;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 465px;">Completed Data</h6>
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
                                      <th>Name</th>
                                      <th>No of Acres</th>
                                      <th>Per Acre</th>       
                                      <th>Action</th>
                                    </tr>
                                  </thead>


                                  <tbody>

                                  </tbody>
                                </table>

                              </div>
                            </div>
                          </div> <!-- end col -->

                        </div> <!-- end row -->
                      </form>
                      <div align="center">
                        <button type="button" class="btn btn-sm btn-success completed_finalsubmittion">Submit</button>
                        <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton" data-bs-dismiss='modal'>Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                <div class="card">
                    <div class="card-body bootstrap-select-1">
                        <form method="POST"  class="locationwiseacrageland" >

                          <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  

                          <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    


                          <input type="hidden" class="Autonumloc" name="Autonumloc" >   

                          <input type="hidden" class="Autonumid" name="Autonumid" >     

                          <h4 class="header-title mt-0">Land Lease</h4>

                          <div class="row">
                            <div class="col-md-4">
                                <h6 class="input-title mt-0">Location</h6>
                                <select class="select2 mb-3 select2-multiple" name="location[]" id="location"  multiple="multiple" style="width: 100%; height:36px;" data-placeholder="Choose">
                                   <?php
                                   $Sql   = "SELECT  DISTINCT BreedingAdmin_Location.BreedingLocation from BreedingAdmin_Location
                                   where BreedingAdmin_Location.CreatedBy='".$_SESSION['EmpID']."' AND BreedingAdmin_Location.Rejectionstatus IS NULL";
                                   $Sql_Connection = sqlsrv_query($conn,$Sql);
                                   while($row = sqlsrv_fetch_array($Sql_Connection)){
                                    ?>
                                    <option value="<?php echo trim($row['BreedingLocation']); ?>"> <?php echo $row['BreedingLocation']; ?> </option>
                                    <?php } ?>

                                </select>
                            </div>                                    

                            <div class="col-md-3">

                             <button type="button" class="btn btn-primary addbtn" style="margin-top: 20px;"> Add </button>

                             <button type="button" class="btn btn-secondary resetbtn" style="margin-top: 20px;"> Reset </button>    

                             <button type="button" class="btn btn-warning completedrecord" style="margin-top: 20px;"> Completed </button>  

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
                            <th>Name</th>
                            <th>No of Acres</th>
                            <th>Per Acre</th>       
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>


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
    $(document).on("click",".addbtn",function(){




        var locationvalue=$("#location").val();




//alert(locationvalue);

        if(locationvalue =='' || locationvalue ==null){

           Alert_Msg("Please Select Location.","warning");
           return false;
       }



       let Uset_Input=$(".locationwiseacrageland").serializeArray();

       Uset_Input.push({"name":"Action","value":"locationwiseacrageland"});

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



        $(".Autonumloc").val(result.Autoincnum);
        $(".Autonumid").val(result.autoid);
        // $(".Autonumloc").val(result.autoid);

        if(result.Status == 1){


            Alert_Msg("Added.","success");

            var user_input={};



            window.location.href ='Landlease.php';



            LocationwiseprojectDetailslandlease("yes",user_input);



             //alert("right");
            return false;
        }else if(result.Status == 2){

          Alert_Msg("Already Location Project Available.","error");
          window.location.href ='Landlease.php';

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



    function LocationwiseprojectDetailslandlease(destroy_status,user_input)
    {

        var data_table='locationwisland'
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
              "data": {Action:"landleasedata"}
          }
      });
    }



    $(document).ready(function(){
    // $('.js-example-basic-single').select2();





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
            window.location.href ='Landlease.php';
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            LocationwiseprojectDetailslandlease("yes",user_input);


            return false;
        }else if(result.Status == 2){


         Alert_Msg("Updated.","success");

         var Autoincnum=$(".Autonumloc").val();
         var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
         window.location.href ='Landlease.php';

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
        $('.locationwisland').DataTable().page.len(50000).draw();
        var table = $('.locationwisland').DataTable();
        table.on('draw.dt', function () {
            let Uset_Input=$(".Finaltabledetailsland").serializeArray();

            Uset_Input.push({"name":"Action","value":"Finaltabledetailsland"});

            submitdatafinal(Uset_Input)
            
        });

    });

    $(document).on("click",".completed_finalsubmittion",function(){
        $('.completed_locationwisland').DataTable().page.len(50000).draw();
        var table = $('.completed_locationwisland').DataTable();
        table.on('draw.dt', function () {
            let Uset_Input=$(".Completed_tabledetailsland").serializeArray();

            Uset_Input.push({"name":"Action","value":"Finaltabledetailsland"});

            submitdatafinal(Uset_Input)
        });

    });
    


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
            window.location.href ='Landlease.php';
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            LocationwiseprojectDetailslandlease("yes",user_input);


            return false;
        }else if(result.Status == 2){


         Alert_Msg("Updated.","success");

         var Autoincnum=$(".Autonumloc").val();
         var  autoid=$(".Autonumid").val();
         window.location.href ='Landlease.php';
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


    $(document).on('keyup','.emp_name',function(){
      var emp_name = $(this).val();
      var lease_id = $(this).parents('tr').find('.lease_id').val();
      $.ajax ({
        type: "POST",
        url: "Common_Ajax.php",
        data: { Action: 'land_lease_keyup_update',lease_id : lease_id,emp_name : emp_name,type : 'name' },
        success: function(data){
        }
    });
  });

    $(document).on('keyup','.no_of_acres',function(){
      var no_of_acres = $(this).val();
      var lease_id = $(this).parents('tr').find('.lease_id').val();
      $.ajax ({
        type: "POST",
        url: "Common_Ajax.php",
        data: { Action: 'land_lease_keyup_update',lease_id : lease_id,no_of_acres : no_of_acres,type : 'no_of_acres' },
        success: function(data){
        }
    });
  });

    $(document).on('keyup','.per_acre',function(){
      var per_acre = $(this).val();
      var lease_id = $(this).parents('tr').find('.lease_id').val();
      $.ajax ({
        type: "POST",
        url: "Common_Ajax.php",
        data: { Action: 'land_lease_keyup_update',lease_id : lease_id,per_acre : per_acre,type : 'per_acre' },
        success: function(data){
        }
    });
  });

    $(document).on("click", ".completedrecord", function (){


      Get_Completed_land_Details("yes");

      $("#Completedrecordpopup").modal('show');

  });

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
