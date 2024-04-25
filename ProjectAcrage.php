


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

                        <!--<div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                     <h6 class="page-title">Budget</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Budget</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Acreage</li>
                                    </ol>
                                </div>
                             
                            </div>
                        </div>-->

                        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body bootstrap-select-1">




                        <form method="POST"  class="locationwiseacrage" >



                          <input type="hidden" class="autonum" name="autonum" value="<?php echo $Doc_No;  ?>">  

                          <input type="hidden" class="headercount" name="headercount" value="<?=@$Header_data['count']?>">    


                          <input type="hidden" class="Autonumloc" name="Autonumloc" >   

                          <input type="hidden" class="Autonumid" name="Autonumid" >     












                          

                          <div class="form-group row">



                                                    </div> <!--end row-->    

                        <div class="row">
                            <div class="col-md-2">
                                <h6 class="input-title mt-0">Location</h6>
                                <select class="multiselect mb-3" name="location[]" id="location"  multiple="multiple">

                                   <?php
                                   $Sql   = "SELECT Distinct Territory from Budget_CostCenter_Mapping_Finance where Territory!='-'";
                                   $Sql_Connection = sqlsrv_query($conn,$Sql);
                                   while($row = sqlsrv_fetch_array($Sql_Connection)){
                                    ?>
                                    <option value="<?php echo trim($row['Territory']); ?>"> <?php echo $row['Territory']; ?> </option>
                                <?php } ?>

                            </select>
                        </div>                                    
                        <div class="col-md-2">
                            <h6 class="mt-lg-0 input-title">Project</h6>

                            <select class="multiselect mb-3" name="project[]" id="project" multiple="multiple">

                                <?php
                                $Sql   = "SELECT  DISTINCT BPM.internal_Order_Description FROM Budget_project_Master AS BPM";
                                $Sql_Connection = sqlsrv_query($conn,$Sql);
                                while($row = sqlsrv_fetch_array($Sql_Connection)){
                                    ?>
                                    <option value="<?php echo trim($row['internal_Order_Description']); ?>"> <?php echo $row['internal_Order_Description']; ?> </option>
                                <?php } ?>

                            </select> 
                        </div>  


                        <div class="col-md-3">


                                <div class="form-check-inline my-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio4" name="breedingloc" class="custom-control-input" value="breeding">
                                        <label class="custom-control-label" for="customRadio4"> Breeding Location</label>
                                    </div>
                                </div>
                                <div class="form-check-inline my-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio5" name="breedingloc" class="custom-control-input" value="trail">
                                        <label class="custom-control-label" for="customRadio5">Trial Location</label>
                                    </div>
                                </div>

                                  <div class="form-check-inline my-1">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio6" name="breedingloc" class="custom-control-input" value="general">
                                        <label class="custom-control-label" for="customRadio6">General Location</label>
                                    </div>
                                </div>

                            </div>


 


                        <div class="col-md-3">



                         <button type="button" class="btn btn-primary addbtn" style="margin-top: 20px;"> Add </button>


                         <!-- <button type="button" class="add_value_click btn btn-primary FinishedMaterialChecking" style="margin-top: 20px;" onclick="return addRow();">Add</button>-->

                         <!-- <button type="button" class="btn btn-secondary resetbtn" style="margin-top: 20px;"> Reset </button>     -->


                         <button type="button" class="btn btn-warning completedrecord" style="margin-top: 20px;"> Completed</button>  


                     </div>                                             
                 </div>


                   </form>
             </div>


       



     </div>

 </div>

</div>





  <div class="row projectwisehide" >
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                       <!-- <h4 class="mt-0 header-title">Location Wise Acreage</h4>-->

                   

                    <form method="post" class="Finaltabledetails">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap locationwise" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                              <tr >                    
                                <th>S.No</th>
                                <th>Location</th>
                                <th>Project</th>
                                <th>Type</th>
                                <th>Acreage <span class="text-danger" style="font-weight: bold !important;font-size: 18px;">*</span></th>       
                                <th style="line-height:15px;">Sowing and  <span class="text-danger" style="font-weight: bold !important;font-size: 18px;">*</span><br> Harvesting<br>(Month Wise)</th>
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
                    <button type="button" class="btn btn-sm btn-success finalsubmittion" style="cursor:pointer;">Submit</button>



                    <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>

                </div>

            </div>

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

           <form method="post" class="FinaltabledetailsCompleted">
             <table  class="table table-bordered dt-responsive nowrap locationwisecomppleted" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr >                    
                    <th>S.No</th>
                    <th>Location</th>
                    <th>Project</th>
                    <th>Type</th>
                    <th>Acrage <span class="text-danger" style="font-weight: bold !important;font-size: 18px;">*</span></th>       
                    <th style="line-height: 15px;">Sowing and <span class="text-danger" style="font-weight: bold !important;font-size: 18px;">*</span><br> Harvesting<br>(Month Wise)</th>
                    <th>Land Block<br> Selection</th>
                    <th>Responsible<br>Person</th>
                    <th></th>






                    
                </tr>
            </thead>


            <tbody>

            </tbody>

            <tfoot class="completed_Total">


                <td colspan="4">Total Acreage</td>
                <td ></td>
                 <td colspan="4"></td>




            </tfoot>


        </table>



    </form>


    <div align="center">
        <button type="button" class="btn btn-sm btn-success finalsubmittioncompleted">Submit</button>



        <button type="button" class="btn btn-sm btn-danger " data-bs-dismiss='modal'>Cancel</button>



    </div>
</div>

</div>
</div>

</form>


</div>  






<!-- Modal -->
<div class="modal" id="monthwisedetails" role="dialog">


    <form method="POST" class="monthwisedetails">

        <div class="modal-dialog modal-lg" style="max-width: 1350px !important">
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




           // var breedingtype=$("#check").val();


      if ($('input[name="breedingloc"]:checked').length == 0) {
        Alert_Msg("Please Select  Type.","warning");
        return false; }




        var locationvalue=$("#location").val();

        var projectnvalue=$("#project").val();


//alert(locationvalue);

        if(locationvalue =='' || locationvalue ==null){

           Alert_Msg("Please Select Location.","warning");
           return false;
       }

       if(projectnvalue =='' ||  projectnvalue ==null){

           Alert_Msg("Please Select project.","warning");
           return false;
       }

           // alert(breedingtype);


          //  return false;

       let Uset_Input=$(".locationwiseacrage").serializeArray();

       Uset_Input.push({"name":"Action","value":"locationwiseacrage"});

       $.ajax 
       ({
          type: "POST",
          url: "Common_Ajax.php",
          data:Uset_Input,
       async:false,//
       success: function(data){

      //  $(".loadingclasspre").hide()

        $(".projectwisehide").css("display","block")

        result=JSON.parse(data);



        $(".Autonumloc").val(result.Autoincnum);
        $(".Autonumid").val(result.autoid);
        // $(".Autonumloc").val(result.autoid);

        if(result.Status == 1){


            Alert_Msg("Added.","success");

            var Autoincnum=$(".Autonumloc").val();
            var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';

      //alert(Autoincnum);
      //alert(autoid);
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

 //alert(user_input.Autoincnum);
 //alert(user_input.autoid);



            LocationwiseprojectDetails("yes",user_input);



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



    function LocationwiseprojectDetails(destroy_status,user_input)
    {


        Autoincnum=user_input.Autoincnum;
        autoid=user_input.autoid;

        var data_table='locationwise'
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
              "data": {Action:"ProjectWiseDetails",Autoincnum:Autoincnum,autoid:autoid},
              complete: function (data) {
                $('.finalsubmittion').attr('disabled',false);
                if(data['responseJSON'].acrage_completed_status == false) {
                    $('.finalsubmittion').attr('disabled',true);
                } 
            }
          },drawCallback: function() {
           $('.dt-select2').select2();
       }
   });
    }



    function LocationwiscompletedeprojectDetails(destroy_status,user_input)
    {
Get_total_Footer_Value(user_input);

        Autoincnum=user_input.Autoincnum;
        autoid=user_input.autoid;

        var data_table='locationwisecomppleted'
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
              "data": {Action:"CompletedProjectWiseDetails",Autoincnum:Autoincnum,autoid:autoid}
          },drawCallback: function() {
           $('.dt-select2').select2();
       }
   });
    }





 function Get_total_Footer_Value(user_input){


   $.ajax({
              type:'POST',
              url:'Datatable_Footer_total.php',
              "data": {Action:'Get_total_Footer_Value_Acreage'},
              success:function(html){
            $(".completed_Total").html(html);
             
              }
              });
  
}
    


    $(document).ready(function(){
    // $('.js-example-basic-single').select2();
       

        var headercount=$(".headercount").val();

        if(headercount ==0){

           // $(".projectwisehide").css("display","none")
        }else{

         // $(".projectwisehide").css("display","block")
      }




      var Autoincnum=$(".Autonumloc").val();
      var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
      var user_input={};


      user_input.Autoincnum=Autoincnum;
      user_input.autoid=autoid;

      LocationwiseprojectDetails("no",user_input);



  });



    $("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
      var $box = $(this);
      if ($box.is(":checked")) {

        var group = "input:checkbox[name='" + $box.attr("name") + "']";

        $(group).prop("checked", false);
        $box.prop("checked", true);

    //console.log($box.prop("checked", true));


    } else {
        $box.prop("checked", false);
    }
});



    $(document).on("click", ".Add_Month_wise_popup", function (){

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


    $(document).on("blur", ".monthinputbox", function() {
        if(isNaN($(this).val()) || $(this).val() == '') {
            $(this).val('');
        } else {
            var Total=0;

            var Total_standing_1=parseFloat($(".stand_acrage").val(),10);
            if (isNaN(Total_standing_1) ) {
                var Total_standing_1=0;
            }
            var Total_standing_2=parseFloat($(".stand_acrage_harvesting").val(),10);
            if (isNaN(Total_standing_2) ) {
                var Total_standing_2=0;
            }
            var standamt=(Total_standing_1)-(Total_standing_2);
            $(".stand_acrage_netsatanding").val(standamt);



            var Total_1=parseFloat($(".jun_acrage").val(),10);
            if (isNaN(Total_1) ) {
                var Total_1=0;
            }
            var Total_2=parseFloat($(".jun_acrage_harvesting").val(),10);
            if (isNaN(Total_2) ) {
                var Total_2=0;
            }
            var amt=(Total_1)-(Total_2);
    //console.log('amt;'+amt);
            $(".jun_acrage_netsatanding").val(amt);
            var decreased_harvest_count = Total_1 + Total_2;


            var Total_jul_1=parseFloat($(".jul_acrage").val(),10);
            if (isNaN(Total_jul_1) ) {
                var Total_jul_1=0;
            }
            var Total_jul_2=parseFloat($(".jul_acrage_harvesting").val(),10);
            if (isNaN(Total_jul_2) ) {
                var Total_jul_2=0;
            }
            var amtjul=(amt+Total_jul_1)-(Total_jul_2);
    //console.log('jul;'+jul);
            $(".jul_acrage_netsatanding").val(amtjul);
            decreased_harvest_count = Total_jul_1 + Total_jul_2;


            var Total_aug_1=parseFloat($(".aug_acrage").val(),10);
            if (isNaN(Total_aug_1) ) {
                var Total_aug_1=0;
            }
            var Total_aug_2=parseFloat($(".aug_acrage_harvesting").val(),10);
            if (isNaN(Total_aug_2) ) {
                var Total_aug_2=0;
            }
            var amtaug=(amtjul+Total_aug_1)-(Total_aug_2);
    //console.log('aug;'+aug);
            $(".aug_acrage_netsatanding").val(amtaug);
            decreased_harvest_count = Total_aug_1 + Total_aug_2;


            var Total_sep_1=parseFloat($(".sep_acrage").val(),10);
            if (isNaN(Total_sep_1) ) {
                var Total_sep_1=0;
            }
            var Total_sep_2=parseFloat($(".sep_acrage_harvesting").val(),10);
            if (isNaN(Total_sep_2) ) {
                var Total_sep_2=0;
            }
            var amtsep=(amtaug+Total_sep_1)-(Total_sep_2);

            $(".sep_acrage_netsatanding").val(amtsep);
            decreased_harvest_count = Total_sep_1 + Total_sep_2;


            var Total_oct_1=parseFloat($(".oct_acrage").val(),10);
            if (isNaN(Total_oct_1) ) {
                var Total_oct_1=0;
            }
            var Total_oct_2=parseFloat($(".oct_acrage_harvesting").val(),10);
            if (isNaN(Total_oct_2) ) {
                var Total_oct_2=0;
            }
            var amtoct=(amtsep+Total_oct_1)-(Total_oct_2);

            $(".oct_acrage_netsatanding").val(amtoct);
            decreased_harvest_count = Total_oct_1 + Total_oct_2;


            var Total_nov_1=parseFloat($(".nov_acrage").val(),10);
            if (isNaN(Total_nov_1) ) {
                var Total_nov_1=0;
            }
            var Total_nov_2=parseFloat($(".nov_acrage_harvesting").val(),10);
            if (isNaN(Total_nov_2) ) {
                var Total_nov_2=0;
            }
            var amtnov=(amtoct+Total_nov_1)-(Total_nov_2);

            $(".nov_acrage_netsatanding").val(amtnov);
            decreased_harvest_count = Total_nov_1 + Total_nov_2;


            var Total_dec_1=parseFloat($(".dec_acrage").val(),10);
            if (isNaN(Total_dec_1) ) {
                var Total_dec_1=0;
            }
            var Total_dec_2=parseFloat($(".dec_acrage_harvesting").val(),10);
            if (isNaN(Total_dec_2) ) {
                var Total_dec_2=0;
            }
            var amtdec=(amtnov+Total_dec_1)-(Total_dec_2);

            $(".dec_acrage_netsatanding").val(amtdec);
            decreased_harvest_count = Total_dec_1 + Total_dec_2;


            var Total_jan_1=parseFloat($(".jan_acrage").val(),10);
            if (isNaN(Total_jan_1) ) {
                var Total_jan_1=0;
            }
            var Total_jan_2=parseFloat($(".jan_acrage_harvesting").val(),10);
            if (isNaN(Total_jan_2) ) {
                var Total_jan_2=0;
            }
            var amtjan=(amtdec+Total_jan_1)-(Total_jan_2);

            $(".jan_acrage_netsatanding").val(amtjan);
            decreased_harvest_count = Total_jan_1 + Total_jan_2;            


            var Total_feb_1=parseFloat($(".feb_acrage").val(),10);
            if (isNaN(Total_feb_1) ) {
                var Total_feb_1=0;
            }
            var Total_feb_2=parseFloat($(".feb_acrage_harvesting").val(),10);
            if (isNaN(Total_feb_2) ) {
                var Total_feb_2=0;
            }
            var amtfeb=(amtjan+Total_feb_1)-(Total_feb_2);

            $(".feb_acrage_netsatanding").val(amtfeb);
            decreased_harvest_count = Total_feb_1 + Total_feb_2;            


            var Total_mar_1=parseFloat($(".mar_acrage").val(),10);
            if (isNaN(Total_mar_1) ) {
                var Total_mar_1=0;
            }
            var Total_mar_2=parseFloat($(".mar_acrage_harvesting").val(),10);
            if (isNaN(Total_mar_2) ) {
                var Total_mar_2=0;
            }
            var amtmar=(amtfeb+Total_mar_1)-(Total_mar_2);

            $(".mar_acrage_netsatanding").val(amtmar);

            decreased_harvest_count = Total_mar_1 + Total_mar_2;            


            var Total_apr_1=parseFloat($(".apr_acrage").val(),10);
            if (isNaN(Total_apr_1) ) {
                var Total_apr_1=0;
            }
            var Total_apr_2=parseFloat($(".apr_acrage_harvesting").val(),10);
            if (isNaN(Total_apr_2) ) {
                var Total_apr_2=0;
            }
            var amtapr=(amtmar+Total_apr_1)-(Total_apr_2);

            $(".apr_acrage_netsatanding").val(amtapr);
            decreased_harvest_count = Total_apr_1 + Total_apr_2;            



            var Total_may_1=parseFloat($(".may_acrage").val(),10);
            if (isNaN(Total_may_1) ) {
                var Total_may_1=0;
            }
            var Total_may_2=parseFloat($(".may_acrage_harvesting").val(),10);
            if (isNaN(Total_may_2) ) {
                var Total_may_2=0;
            }
            var amtmay=(amtapr+Total_may_1)-(Total_may_2);

            $(".may_acrage_netsatanding").val(amtmay);

            decreased_harvest_count = Total_may_1 + Total_may_2;            
            $('.decreased_harvest_count').val(decreased_harvest_count);

        }



    });




$(document).on("keyup", ".validatetotalacr", function() {
  validatevalue=$(this).val();

  if(validatevalue != '') {
      var Total_acrage  =  $(this).parents('tr').find('.Total_acrage').val();

      var totWgt = 0;

      $(".validatetotalacr").each(function(index, el) {
        wgt =  parseFloat($(el).val(),10);

        if(wgt!="" && !isNaN(wgt) && $(el).val()!="" && !isNaN($(el).val())){
            totWgt += wgt;
        }

    });


      if(totWgt > Total_acrage)
      {
          Alert_Msg("Greater Than Total Acreage Value.Please Check.","warning");
          $(this).val(0);
          $('.net_input').val(Total_acrage);
      }

  }
});

$(document).on('keyup','.Harvesting',function(){
            var input = $(this).data('input'); 
            var Total_acrage  =  $('.'+input+'_acrage').val();

            var Total_standing_1=parseFloat($(".stand_acrage").val(),10);
            if (isNaN(Total_standing_1) ) {
                var Total_standing_1=0;
            }
            var Total_standing_2=parseFloat($(".stand_acrage_harvesting").val(),10);
            if (isNaN(Total_standing_2) ) {
                var Total_standing_2=0;
            }
            var amt=(Total_standing_1)-(Total_standing_2);
            var tot_amount =  amt;
            var decreased_harvest_count = Total_acrage;



            var Total_1=parseFloat($(".jun_acrage").val(),10);
            if (isNaN(Total_1) ) {
                var Total_1=0;
            }
            var Total_2=parseFloat($(".jun_acrage_harvesting").val(),10);
            if (isNaN(Total_2) ) {
                var Total_2=0;
            }
            var amtjun=(Total_1)-(Total_2);
            var tot_amount =  amtjun;

            if(Total_1 > 0 && Total_2 > 0) {
                 decreased_harvest_count = Total_1;
            }


            var Total_jul_1=parseFloat($(".jul_acrage").val(),10);
            if (isNaN(Total_jul_1) ) {
                var Total_jul_1=0;
            }
            var Total_jul_2=parseFloat($(".jul_acrage_harvesting").val(),10);
            if (isNaN(Total_jul_2) ) {
                var Total_jul_2=0;
            }
            var amtjul=(amtjun+Total_jul_1)-(Total_jul_2);
            tot_amount =  amtjul;

            if(Total_jul_1 > 0 && Total_jul_2 > 0) {
                decreased_harvest_count = amtjun+Total_jul_1;
            }


            var Total_aug_1=parseFloat($(".aug_acrage").val(),10);
            if (isNaN(Total_aug_1) ) {
                var Total_aug_1=0;
            }
            var Total_aug_2=parseFloat($(".aug_acrage_harvesting").val(),10);
            if (isNaN(Total_aug_2) ) {
                var Total_aug_2=0;
            }
            var amtaug=(amtjul+Total_aug_1)-(Total_aug_2);
            tot_amount =  amtaug;
            
            if(Total_aug_1 > 0 && Total_aug_2 > 0) {
                decreased_harvest_count = amtjul+Total_aug_1;
            }


            var Total_sep_1=parseFloat($(".sep_acrage").val(),10);
            if (isNaN(Total_sep_1) ) {
                var Total_sep_1=0;
            }
            var Total_sep_2=parseFloat($(".sep_acrage_harvesting").val(),10);
            if (isNaN(Total_sep_2) ) {
                var Total_sep_2=0;
            }
            var amtsep=(amtaug+Total_sep_1)-(Total_sep_2);
            tot_amount =  amtsep;

            if(Total_sep_1 > 0 && Total_sep_2 > 0) {
                decreased_harvest_count = amtaug+Total_sep_1;
            }


            var Total_oct_1=parseFloat($(".oct_acrage").val(),10);
            if (isNaN(Total_oct_1) ) {
                var Total_oct_1=0;
            }
            var Total_oct_2=parseFloat($(".oct_acrage_harvesting").val(),10);
            if (isNaN(Total_oct_2) ) {
                var Total_oct_2=0;
            }
            var amtoct=(amtsep+Total_oct_1)-(Total_oct_2);
            tot_amount =  amtoct;

            if(Total_oct_1 > 0 && Total_oct_2 > 0) {
                decreased_harvest_count = amtsep+Total_oct_1;
            }

            var Total_nov_1=parseFloat($(".nov_acrage").val(),10);
            if (isNaN(Total_nov_1) ) {
                var Total_nov_1=0;
            }
            var Total_nov_2=parseFloat($(".nov_acrage_harvesting").val(),10);
            if (isNaN(Total_nov_2) ) {
                var Total_nov_2=0;
            }
            var amtnov=(amtoct+Total_nov_1)-(Total_nov_2);
            tot_amount =  amtnov;

            if(Total_nov_1 > 0 && Total_nov_1 > 0) {
                decreased_harvest_count = amtoct+Total_nov_1;
            }


            var Total_dec_1=parseFloat($(".dec_acrage").val(),10);
            if (isNaN(Total_dec_1) ) {
                var Total_dec_1=0;
            }
            var Total_dec_2=parseFloat($(".dec_acrage_harvesting").val(),10);
            if (isNaN(Total_dec_2) ) {
                var Total_dec_2=0;
            }
            var amtdec=(amtnov+Total_dec_1)-(Total_dec_2);
            tot_amount =  amtdec;
            
            if(Total_dec_1 > 0 && Total_dec_2 > 0) {
                decreased_harvest_count = amtnov+Total_dec_1;
            }


            var Total_jan_1=parseFloat($(".jan_acrage").val(),10);
            if (isNaN(Total_jan_1) ) {
                var Total_jan_1=0;
            }
            var Total_jan_2=parseFloat($(".jan_acrage_harvesting").val(),10);
            if (isNaN(Total_jan_2) ) {
                var Total_jan_2=0;
            }
            var amtjan=(amtdec+Total_jan_1)-(Total_jan_2);
            tot_amount =  amtjan;

            if(Total_jan_1 > 0 && Total_jan_2 > 0) {
                decreased_harvest_count = amtdec+Total_jan_1;            
            }

            var Total_feb_1=parseFloat($(".feb_acrage").val(),10);
            if (isNaN(Total_feb_1) ) {
                var Total_feb_1=0;
            }
            var Total_feb_2=parseFloat($(".feb_acrage_harvesting").val(),10);
            if (isNaN(Total_feb_2) ) {
                var Total_feb_2=0;
            }
            var amtfeb=(amtjan+Total_feb_1)-(Total_feb_2);
            tot_amount =  amtfeb;

            if(Total_feb_1 > 0 && Total_feb_2 > 0) {
                decreased_harvest_count = amtjan+Total_feb_1;            
            }


            var Total_mar_1=parseFloat($(".mar_acrage").val(),10);
            if (isNaN(Total_mar_1) ) {
                var Total_mar_1=0;
            }
            var Total_mar_2=parseFloat($(".mar_acrage_harvesting").val(),10);
            if (isNaN(Total_mar_2) ) {
                var Total_mar_2=0;
            }
            var amtmar=(amtfeb+Total_mar_1)-(Total_mar_2);
            tot_amount =  amtmar;

            if(Total_mar_1 > 0 && Total_mar_2 > 0) {
                decreased_harvest_count = amtfeb+Total_mar_1; 
            }           


            var Total_apr_1=parseFloat($(".apr_acrage").val(),10);
            if (isNaN(Total_apr_1) ) {
                var Total_apr_1=0;
            }
            var Total_apr_2=parseFloat($(".apr_acrage_harvesting").val(),10);
            if (isNaN(Total_apr_2) ) {
                var Total_apr_2=0;
            }
            var amtapr=(amtmar+Total_apr_1)-(Total_apr_2);
            tot_amount =  amtapr;

            if(Total_apr_1 > 0 && Total_apr_2 > 0) {
                decreased_harvest_count = amtmar+Total_apr_1;            
            }


            var Total_may_1=parseFloat($(".may_acrage").val(),10);
            if (isNaN(Total_may_1) ) {
                var Total_may_1=0;
            }
            var Total_may_2=parseFloat($(".may_acrage_harvesting").val(),10);
            if (isNaN(Total_may_2) ) {
                var Total_may_2=0;
            }
            var amtmay=(amtapr+Total_may_1)-(Total_may_2);
            tot_amount =  amtmay;

            if(Total_may_1 > 0 && Total_may_2 > 0) {
                decreased_harvest_count = amtapr+Total_may_1;    
            }


            $('.decreased_harvest_count').val(decreased_harvest_count);
            var h_count       = parseInt($('.decreased_harvest_count').val());
            var entered_count = parseInt($(this).val());

            if(entered_count > h_count) {
                Alert_Msg("Greater Than available Acreage Value.Please Check.","warning");
                $(this).val(0);
                $('.'+input+'_acrage_netsatanding').val(decreased_harvest_count);
            }

});


$(document).on("click",".Savemonthvalue",function(){

   let Uset_Input=$(".monthwisedetails").serializeArray();

   Uset_Input.push({"name":"Action","value":"monthwisedetails"});

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

            LocationwiseprojectDetails("yes",user_input);


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



$(document).on("click", ".View_Month_wise_popup", function (){

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
    action_type:"monthwisedata_view"
},
success: function (output) {
  var rowdata = JSON.parse(output);
  $("#monthwisedetails").modal('show');
  $(".Conformation-body").html(rowdata);

  $(".Total_acrage").val(passing_total_acrage);
}
});




});




$(document).on("click",".Editmonthvaue",function(){




   let Uset_Input=$(".monthwisedetails").serializeArray();

   Uset_Input.push({"name":"Action","value":"monthwisedetails_Edit"});

   $.ajax 
   ({
      type: "POST",
      url: "Common_Ajax.php",
      data:Uset_Input,
       async:false,//
       success: function(data){

           result=JSON.parse(data);

           if(result.Status == 1){


            Alert_Msg("Updated Month Wise.","success");


            $(".close").trigger('click'); 


            var Autoincnum=$(".Autonumloc").val();
            var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            LocationwiseprojectDetails("yes",user_input);


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


$(document).on("click",".resetbtn",function(){

//alert("jai");


      //$("#location").multiselect("clearSelection");

 //$("#location").multiselect( 'refresh' ); 


 //$("#location").val("");
//$("#location").trigger("change");

//$("#location").val("");
//$("#location").trigger("change");

//$("#location").val('');location
//$("#project").val('');

  //$("#location option:selected").prop("selected", false);
 /// $("#location").multiselect('refresh');
//$("#location").find('select').prop('selectedIndex', -1);

    $("#location option:selected").prop("selected", false);

});



$(document).on("click",".editbutton",function(){

//alert("jai");

    $(".acragevaluemain").prop("readonly", false);

});


$(document).on("click",".finalsubmittion",function(){
    $('.locationwise').DataTable().page.len(50000).draw();
    var table = $('.locationwise').DataTable();
    table.on('draw.dt', function () {
        $('input[name="acragevaluemain[]"]').each(function(){
            if($(this).val() == '') {
                $(this).val(0);
            }
        });
        let Uset_Input=$(".Finaltabledetails").serializeArray();
        Uset_Input.push({"name":"Action","value":"Finalsubmittiondetails"});
        acrage_final_submit(Uset_Input);
    });

   var acrage_is_empty = false;
   var c = 0; 
   $('.Acrage').each(function(){
        if($(this).val() == '') {
            acrage_is_empty = true;
        }
        c++;
   });

   console.log(c);

});

function acrage_final_submit(Uset_Input)
{
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

            LocationwiseprojectDetails("yes",user_input);


            return false;
        }else{

           // alert("Wrong");
           // Alert_Msg("Something Went Wrong.","error");
        swal({
            title: "Something Went Wrong.",
            icon: "error"
          }).then(function(isConfirmed) {
              if(isConfirmed) {
                location.reload();
              }
          });
       }
   }
});
}


$(document).on("click",".finalsubmittioncompleted",function(){


   let Uset_Input=$(".Completedrecordpopup").serializeArray();

   console.log(Uset_Input);

   Uset_Input.push({"name":"Action","value":"Finalsubmittiondetails"});

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

            LocationwiseprojectDetails("yes",user_input);


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


$(document).on("click",".deletebutton",function(){


  var passing_id=$(this).parents('tr').find(".allpassing_id").val();
  var passing_id_proj=$(this).parents('tr').find(".passing_id_proj").val();
  var passing_id_loc=$(this).parents('tr').find(".passing_id_loc").val();


  
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
    action_type:"deleterowwisedata"
},
success: function (output) {
  var rowdata = JSON.parse(output);

  if(rowdata==1){



      Alert_Msg("Deleted.","success");


      var Autoincnum=$(".Autonumloc").val();
      var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
      var user_input={};


      user_input.Autoincnum=Autoincnum;
      user_input.autoid=autoid;

      LocationwiseprojectDetails("yes",user_input);
LocationwiscompletedeprojectDetails("yes",user_input);





  }else{


   Alert_Msg("Something Went Wrong.","error");
   return false;




}

}
});





});


$(document).on("click", ".completedrecord", function (){



    $("#Completedrecordpopup").modal('show');

    var user_input={};
    LocationwiscompletedeprojectDetails("yes",user_input);



});



$(document).on("click", ".View_Month_wise_popup_Completed", function (){

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
    action_type:"monthwisedata_view"
},
success: function (output) {
  var rowdata = JSON.parse(output);
  $("#monthwisedetails").modal('show');
  $(".Conformation-body").html(rowdata);

  $(".Total_acrage").val(passing_total_acrage);
}
});




});




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

$(document).on('change','.Responsible_person',function(){
    var location_id   = $(this).parents('tr').find('.passing_id_loc').val();
    var res_person    = $(this).val();
    $.ajax ({
      type: "POST",
      url: "Common_Ajax.php",
      data: { Action: 'update_location_responsible_person',location_id : location_id,res_person : res_person },
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



