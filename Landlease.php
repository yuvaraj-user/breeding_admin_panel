

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




$sql="SELECT COUNT(*) as count FROM BreedingAdmin_Type Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Currentstatus ='1'";
$stmt = sqlsrv_query($conn, $sql);
$Header_data = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);





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
                            <li class="breadcrumb-item active">Project Acrage</li>
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




                        <form method="POST"  class="locationwiseacrageland" >



                          <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  

                          <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    


                          <input type="hidden" class="Autonumloc" name="Autonumloc" >   

                          <input type="hidden" class="Autonumid" name="Autonumid" >     












                          <h4 class="header-title mt-0">Land Lease</h4>

                          <div class="form-group row">

                         
                        </div> <!--end row-->    

                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="input-title mt-0">Location</h6>
                                <select class="select2 mb-3 select2-multiple" name="location[]" id="location"  multiple="multiple" style="width: 100%; height:36px;" data-placeholder="Choose">

                                   <?php
                                   $Sql   = "SELECT Distinct Territory from Budget_CostCenter_Mapping_Finance where Territory!='-'";
                                   $Sql_Connection = sqlsrv_query($conn,$Sql);
                                   while($row = sqlsrv_fetch_array($Sql_Connection)){
                                    ?>
                                    <option value="<?php echo trim($row['Territory']); ?>"> <?php echo $row['Territory']; ?> </option>
                                <?php } ?>

                            </select>
                        </div>                                    
                       


                        <div class="col-md-3">



                         <button type="button" class="btn btn-primary addbtn" style="margin-top: 20px;"> Add </button>


                      

                         <button type="button" class="btn btn-secondary resetbtn" style="margin-top: 20px;"> Reset </button>    


                         <button type="button" class="btn btn-danger completedrecord" style="margin-top: 20px;"> Completed Record </button>  


                     </div>                                             
                 </div>
             </div>


         </form>





         <div class="row projectwisehide" >
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Land Lease</h4>

                    </p>

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





                <div class="modal" id="monthwisedetails" role="dialog">


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






                <div align="center">
                    <button type="button" class="btn btn-sm btn-success finalsubmittion">Submit</button>



                    <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>

                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


<!--<div class="modal" id="Completedrecordpopup" role="dialog">


    <form method="POST" class="Completedrecordpopup">

        <div class="modal-dialog modal-lg" style="max-width: 1200px !important">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-bs-dismiss='modal'>&times;</button>
              <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 465px;">Location Wise Project</h6> 
          </div>
          <div class="Conformation-body-completed">

           <form method="post" class="FinaltabledetailsCompleted">
             <table  class="table table-bordered dt-responsive nowrap locationwisecomppleted" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr >                    
                    <th>S.No</th>
                    <th>Location</th>
                    <th>Project</th>
                    <th> Type</th>
                    <th>Acrage</th>       
                    <th>Sowing and <br> Harvesting<br>(Month Wise)</th>
                    <th>Land Block<br> Selection</th>
                    <th>Responsible<br>Person</th>
                    <th></th>






                    
                </tr>
            </thead>


            <tbody>

            </tbody>


        </table>



    </form>


    <div align="center">
        <button type="button" class="btn btn-sm btn-success finalsubmittioncompleted">Submit</button>



        <button type="button" class="btn btn-sm btn-danger " data-dismiss='modal'>Cancel</button>



    </div>
</div>

</div>
</div>

</form>


</div>  -->


<!-- Modal -->
<!--<div class="modal" id="monthwisedetails" role="dialog">


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
</div> <!-- end col -->
</div> <!-- end row --> 


<!-- Modal -->



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


 



            LocationwiseprojectDetailslandlease("yes",user_input);



             //alert("right");
            return false;
        }else if(result.Status == 2){

          Alert_Msg("Already Location Project Available.","error");
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



  });



    $(document).on("click", ".Add_Month_wise_popup", function (){

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
       
        action_type:"landleasemonthwise"
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
         // window.location.href ='VechicleRequest.php';
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




$('.locationwisland').DataTable().page.len(all).draw();


//
   setTimeout(function () {
   submitdatafinal ()
}, 500);

});




function submitdatafinal (){




alert("hai");
   let Uset_Input=$(".Finaltabledetailsland").serializeArray();

   Uset_Input.push({"name":"Action","value":"Finaltabledetailsland"});

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

            LocationwiseprojectDetailslandlease("yes",user_input);


            return false;
        }else if(result.Status == 2){


 Alert_Msg("Updated.","success");

var Autoincnum=$(".Autonumloc").val();
            var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
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


/*



 jQuery.fn.DataTable.Api.register( 'buttons.exportData()', function ( options ){
            if ( this.context.length ) {
                var jsonResult = $.ajax({
                    url: 'Production_CropAge_Table.php',
                    type:'POST',
                    dataType:'json',

                    data: {Crop_Code:Crop_Code,Year_Code:Year_Code,Plant:Plant,Process_code:Process_code,Material_Code:Material_Code,Place_wise:Place_wise,Talk_wise:Talk_wise,Action:'Get_Crop_QC_OutIn_Recod',Season_Code:Season_Code,Type:Type,length:'All'},
                    async: false
                });

                header_array = [];
       

        //header_array.push('"\r\n"');
        header_array.push('S.No');
        header_array.push('Batch Num');
        header_array.push('Material');
        header_array.push('Process Code');
        header_array.push('Qc Lot Num');
        header_array.push('Receipt Date');
        header_array.push('In Date');
        header_array.push('Out Date');

            return {
                  
         body: jsonResult.responseJSON.data,
        header: header_array
        };
            }
        });

*/


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<!-- jQuery  -->
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






